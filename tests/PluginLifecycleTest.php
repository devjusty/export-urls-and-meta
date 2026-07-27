<?php

use PHPUnit\Framework\TestCase;

require_once dirname( __DIR__ ) . '/includes/export/class-export-manifest.php';
require_once dirname( __DIR__ ) . '/includes/class-plugin-lifecycle.php';

final class PluginLifecycleTest extends TestCase {

	public function test_last_batch_failure_payload_is_normalized(): void {
		$payload = eum_normalize_last_batch_failure( 'Unable to open export file.', 1700000000 );

		$this->assertSame( 1700000000, $payload['time'] );
		$this->assertSame( 'Unable to open export file.', $payload['message'] );
	}

	public function test_record_last_batch_failure_returns_normalized_payload_without_wordpress(): void {
		$payload = eum_record_last_batch_failure( 'Export lock expired. Retry export.' );

		$this->assertArrayHasKey( 'time', $payload );
		$this->assertArrayHasKey( 'message', $payload );
		$this->assertSame( 'Export lock expired. Retry export.', $payload['message'] );
		$this->assertGreaterThan( 0, $payload['time'] );
	}

	public function test_purge_runtime_state_deletes_export_files_in_storage_dir(): void {
		$dir = sys_get_temp_dir() . '/eum-lifecycle-' . uniqid( '', true );
		$this->assertTrue( mkdir( $dir ) );

		$csv      = $dir . '/eum_export_abc123.csv';
		$manifest = $dir . '/eum_export_abc123.manifest';
		$other    = $dir . '/other-plugin.csv';
		file_put_contents( $csv, 'a' );
		file_put_contents( $manifest, "{}\n" );
		file_put_contents( $other, 'keep' );

		$cleared = eum_purge_export_runtime_state( $dir . '/' );

		$this->assertSame( 2, $cleared['files'] );
		$this->assertFileDoesNotExist( $csv );
		$this->assertFileDoesNotExist( $manifest );
		$this->assertFileExists( $other );

		unlink( $other );
		rmdir( $dir );
	}

	public function test_count_export_storage_files_ignores_unrelated_names(): void {
		$dir = sys_get_temp_dir() . '/eum-lifecycle-count-' . uniqid( '', true );
		$this->assertTrue( mkdir( $dir ) );

		file_put_contents( $dir . '/eum_export_xyz.csv', 'a' );
		file_put_contents( $dir . '/readme.txt', 'nope' );

		$this->assertSame( 1, eum_count_export_storage_files( $dir . '/' ) );

		unlink( $dir . '/eum_export_xyz.csv' );
		unlink( $dir . '/readme.txt' );
		rmdir( $dir );
	}
}
