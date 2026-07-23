<?php

use PHPUnit\Framework\TestCase;

require_once dirname( __DIR__ ) . '/includes/admin/class-diagnostics.php';

final class DiagnosticsTest extends TestCase {

    public function test_aioseo_sources_are_reported(): void {
        $sources = eum_get_diagnostics_sources( 'aioseo/aioseo.php' );

        $this->assertStringContainsString( '_aioseo', $sources['posts']['title'] );
        $this->assertStringContainsString( 'aioseo_options', $sources['homepage']['source'] );
    }

    public function test_unknown_plugin_reports_no_detected_source(): void {
        $sources = eum_get_diagnostics_sources( false );

        $this->assertSame( 'n/a', $sources['posts']['title'] );
        $this->assertSame( 'No SEO plugin detected', $sources['posts']['notes'] );
    }

    public function test_multiple_plugins_report_ambiguous_source(): void {
        $sources = eum_get_diagnostics_sources( false, 'multiple' );

        $this->assertSame( 'Multiple SEO plugins detected', $sources['posts']['notes'] );
    }
}
