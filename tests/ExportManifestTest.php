<?php

use PHPUnit\Framework\TestCase;

require_once dirname( __DIR__ ) . '/includes/export/class-export-manifest.php';

final class ExportManifestTest extends TestCase {

    public function test_manifest_record_is_encoded_as_one_json_line(): void {
        $line = eum_encode_export_manifest_record( array( 'type' => 'post', 'id' => 42 ) );

        $this->assertSame( "{\"type\":\"post\",\"id\":42}\n", $line );
    }

    public function test_manifest_line_is_decoded_and_rejects_invalid_records(): void {
        $this->assertSame(
            array( 'type' => 'term', 'taxonomy' => 'category', 'id' => 9 ),
            eum_decode_export_manifest_record( "{\"type\":\"term\",\"taxonomy\":\"category\",\"id\":9}\n" )
        );
        $this->assertNull( eum_decode_export_manifest_record( "not-json\n" ) );
        $this->assertNull( eum_decode_export_manifest_record( "{\"type\":\"post\"}\n" ) );
        $this->assertSame( array( 'type' => 'homepage', 'id' => 0 ), eum_decode_export_manifest_record( "{\"type\":\"homepage\",\"id\":0}\n" ) );
    }

    public function test_manifest_filename_is_bound_to_export_id(): void {
        $paths = eum_get_export_manifest_paths( 'eum_export_abc123' );

        $this->assertStringEndsWith( 'eum_export_abc123.manifest', $paths['manifest'] );
        $this->assertStringEndsWith( 'eum_export_abc123.csv', $paths['csv'] );
        $this->assertStringEndsWith( '/', eum_get_export_storage_dir() );
    }

    public function test_manifest_writer_tracks_record_count_and_byte_offset(): void {
        $handle = fopen( 'php://temp', 'w+' );
        $result = eum_write_export_manifest_records(
            $handle,
            array(
                array( 'type' => 'post', 'id' => 3 ),
                array( 'type' => 'homepage', 'id' => 0 ),
            )
        );

        $this->assertSame( 2, $result['count'] );
        $this->assertGreaterThan( 0, $result['bytes'] );
    }

    public function test_manifest_reader_advances_by_byte_offset(): void {
        $handle = fopen( 'php://temp', 'w+' );
        fwrite( $handle, "{\"type\":\"post\",\"id\":1}\n" );
        fwrite( $handle, "{\"type\":\"post\",\"id\":2}\n" );
        rewind( $handle );

        $first  = eum_read_export_manifest_batch( $handle, 0, 1 );
        $second = eum_read_export_manifest_batch( $handle, $first['offset'], 1 );

        $this->assertSame( 1, $first['records'][0]['id'] );
        $this->assertSame( 2, $second['records'][0]['id'] );
        $this->assertGreaterThan( $first['offset'], $second['offset'] );
    }

    public function test_cleanup_file_id_is_derived_from_plugin_filename(): void {
        $this->assertSame( 'eum_export_abc123', eum_get_export_id_from_temp_filename( '/tmp/eum_export_abc123.csv' ) );
        $this->assertSame( 'eum_export_abc123', eum_get_export_id_from_temp_filename( '/tmp/eum_export_abc123.manifest' ) );
        $this->assertNull( eum_get_export_id_from_temp_filename( '/tmp/other-plugin.csv' ) );
    }

    public function test_csv_formula_values_are_neutralized(): void {
        $this->assertSame( "\t=SUM(A1:A2)", eum_escape_csv_formula( '=SUM(A1:A2)' ) );
        $this->assertSame( 'Normal title', eum_escape_csv_formula( 'Normal title' ) );
        $this->assertSame( 42, eum_escape_csv_formula( 42 ) );
    }
}
