#!/usr/bin/env php
<?php
/**
 * Build an installable plugin zip for local testing or release uploads.
 *
 * Cross-platform: requires PHP with the Zip extension (no rsync/zip CLI).
 *
 * Usage:
 *   php bin/package-plugin.php
 *   php bin/package-plugin.php --output=/tmp/export-urls-and-meta.zip
 *   composer package
 */

if ( PHP_SAPI !== 'cli' ) {
	fwrite( STDERR, "This script must be run from the command line.\n" );
	exit( 1 );
}

if ( ! class_exists( 'ZipArchive' ) ) {
	fwrite( STDERR, "PHP ZipArchive extension is required. Enable the zip extension and retry.\n" );
	exit( 1 );
}

$repo_root = realpath( dirname( __DIR__ ) );
if ( false === $repo_root ) {
	fwrite( STDERR, "Unable to resolve repository root.\n" );
	exit( 1 );
}

$plugin_slug = 'export-urls-and-meta';
$default_output = $repo_root . DIRECTORY_SEPARATOR . 'dist' . DIRECTORY_SEPARATOR . $plugin_slug . '.zip';
$output_path = $default_output;

foreach ( array_slice( $argv, 1 ) as $arg ) {
	if ( 0 === strpos( $arg, '--output=' ) ) {
		$output_path = substr( $arg, strlen( '--output=' ) );
		continue;
	}
	if ( '--help' === $arg || '-h' === $arg ) {
		fwrite(
			STDOUT,
			"Build an installable {$plugin_slug} zip.\n\n" .
			"Usage:\n" .
			"  php bin/package-plugin.php [--output=path/to/file.zip]\n\n" .
			"Default output:\n" .
			"  dist/{$plugin_slug}.zip\n"
		);
		exit( 0 );
	}
	fwrite( STDERR, "Unknown argument: {$arg}\n" );
	exit( 1 );
}

if ( '' === $output_path ) {
	fwrite( STDERR, "--output cannot be empty.\n" );
	exit( 1 );
}

if ( ! eum_path_is_absolute( $output_path ) ) {
	$output_path = $repo_root . DIRECTORY_SEPARATOR . str_replace( array( '/', '\\' ), DIRECTORY_SEPARATOR, $output_path );
}

$output_dir = dirname( $output_path );
if ( ! is_dir( $output_dir ) && ! mkdir( $output_dir, 0775, true ) && ! is_dir( $output_dir ) ) {
	fwrite( STDERR, "Unable to create output directory: {$output_dir}\n" );
	exit( 1 );
}

$excludes = eum_load_distignore( $repo_root . DIRECTORY_SEPARATOR . '.distignore' );
if ( null === $excludes ) {
	fwrite( STDERR, "Missing or unreadable .distignore in repository root.\n" );
	exit( 1 );
}

if ( is_file( $output_path ) && ! unlink( $output_path ) ) {
	fwrite( STDERR, "Unable to replace existing zip: {$output_path}\n" );
	exit( 1 );
}

$zip = new ZipArchive();
$opened = $zip->open( $output_path, ZipArchive::CREATE | ZipArchive::OVERWRITE );
if ( true !== $opened ) {
	fwrite( STDERR, "Unable to create zip archive (code {$opened}): {$output_path}\n" );
	exit( 1 );
}

$directory = new RecursiveDirectoryIterator( $repo_root, FilesystemIterator::SKIP_DOTS );
$filtered  = new RecursiveCallbackFilterIterator(
	$directory,
	static function ( $current, $key, $iterator ) use ( $repo_root, $excludes ) {
		/** @var SplFileInfo $current */
		$absolute = $current->getPathname();
		$relative = eum_relative_path( $repo_root, $absolute );
		if ( null === $relative ) {
			return false;
		}

		if ( eum_should_exclude( $relative, $current->isDir(), $excludes ) ) {
			return false;
		}

		return true;
	}
);

$iterator = new RecursiveIteratorIterator( $filtered, RecursiveIteratorIterator::SELF_FIRST );

$file_count = 0;
foreach ( $iterator as $file_info ) {
	/** @var SplFileInfo $file_info */
	$absolute = $file_info->getPathname();
	$relative = eum_relative_path( $repo_root, $absolute );
	if ( null === $relative ) {
		continue;
	}

	$zip_path = $plugin_slug . '/' . str_replace( '\\', '/', $relative );
	if ( $file_info->isDir() ) {
		$zip->addEmptyDir( rtrim( $zip_path, '/' ) . '/' );
		continue;
	}

	if ( ! $zip->addFile( $absolute, $zip_path ) ) {
		$zip->close();
		fwrite( STDERR, "Unable to add file to zip: {$relative}\n" );
		exit( 1 );
	}
	$file_count++;
}

if ( ! $zip->close() ) {
	fwrite( STDERR, "Unable to finalize zip archive: {$output_path}\n" );
	exit( 1 );
}

$bytes = filesize( $output_path );
fwrite(
	STDOUT,
	sprintf(
		"Created %s (%s files, %s)\n",
		$output_path,
		number_format( $file_count ),
		eum_format_bytes( false === $bytes ? 0 : $bytes )
	)
);
exit( 0 );

/**
 * Load exclude patterns from .distignore.
 *
 * @param string $path Path to .distignore.
 * @return array<int, string>|null
 */
function eum_load_distignore( $path ) {
	if ( ! is_readable( $path ) ) {
		return null;
	}

	$lines = file( $path, FILE_IGNORE_NEW_LINES );
	if ( false === $lines ) {
		return null;
	}

	$patterns = array();
	foreach ( $lines as $line ) {
		$line = trim( $line );
		if ( '' === $line || 0 === strpos( $line, '#' ) ) {
			continue;
		}
		$pattern = str_replace( '\\', '/', $line );
		if ( 0 === strpos( $pattern, './' ) ) {
			$pattern = substr( $pattern, 2 );
		}
		$patterns[] = $pattern;
	}

	return $patterns;
}

/**
 * Whether a repo-relative path should be excluded.
 *
 * @param string               $relative Relative path using OS separators.
 * @param bool                 $is_dir   Whether path is a directory.
 * @param array<int, string>   $excludes Exclude patterns.
 * @return bool
 */
function eum_should_exclude( $relative, $is_dir, array $excludes ) {
	$normalized = str_replace( '\\', '/', $relative );
	$basename   = basename( $normalized );

	foreach ( $excludes as $pattern ) {
		$pattern = str_replace( '\\', '/', $pattern );

		if ( false !== strpos( $pattern, '*' ) ) {
			if ( fnmatch( $pattern, $normalized ) || fnmatch( $pattern, $basename ) ) {
				return true;
			}
			continue;
		}

		if ( $normalized === $pattern || 0 === strpos( $normalized . '/', $pattern . '/' ) ) {
			return true;
		}
	}

	// Never package the generated dist directory even if .distignore is incomplete.
	if ( 'dist' === $normalized || 0 === strpos( $normalized . '/', 'dist/' ) ) {
		return true;
	}

	return false;
}

/**
 * Build a path relative to the repository root.
 *
 * @param string $root     Repository root.
 * @param string $absolute Absolute path.
 * @return string|null
 */
function eum_relative_path( $root, $absolute ) {
	$root     = rtrim( str_replace( '\\', '/', $root ), '/' );
	$absolute = str_replace( '\\', '/', $absolute );

	if ( $absolute === $root ) {
		return null;
	}

	$prefix = $root . '/';
	if ( 0 !== strpos( $absolute, $prefix ) ) {
		return null;
	}

	return str_replace( '/', DIRECTORY_SEPARATOR, substr( $absolute, strlen( $prefix ) ) );
}

/**
 * Whether a path is absolute on the current OS.
 *
 * @param string $path Path.
 * @return bool
 */
function eum_path_is_absolute( $path ) {
	if ( '' === $path ) {
		return false;
	}

	if ( '/' === $path[0] ) {
		return true;
	}

	return (bool) preg_match( '/^[A-Za-z]:[\\\\\\/]/', $path );
}

/**
 * Human-readable byte size.
 *
 * @param int $bytes Byte count.
 * @return string
 */
function eum_format_bytes( $bytes ) {
	$bytes = (int) $bytes;
	$units = array( 'B', 'KB', 'MB', 'GB' );
	$i     = 0;
	$value = (float) $bytes;

	while ( $value >= 1024 && $i < count( $units ) - 1 ) {
		$value /= 1024;
		$i++;
	}

	return ( $i === 0 ? (string) $bytes : number_format( $value, 1 ) ) . ' ' . $units[ $i ];
}
