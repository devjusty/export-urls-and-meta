<?php

use PHPUnit\Framework\TestCase;

require_once dirname( __DIR__ ) . '/includes/class-seo-plugin-detector.php';
require_once dirname( __DIR__ ) . '/includes/class-seo-meta.php';
require_once dirname( __DIR__ ) . '/includes/class-export-session.php';

final class ExportRequestTest extends TestCase {

    public function test_numeric_checkbox_values_are_enabled(): void {
        $request = eum_normalize_export_request(
            array(
                'eum_post_types'              => array( 'post' ),
                'include_homepage_latest'     => '1',
                'eum_include_wp_categories'   => '1',
                'eum_include_product_categories' => '1',
                'eum_publish_status'          => array( 'publish' ),
                'eum_character_count'         => '1',
            )
        );

        $this->assertTrue( $request['include_homepage_latest'] );
        $this->assertTrue( $request['include_wp_categories'] );
        $this->assertTrue( $request['include_product_categories'] );
        $this->assertTrue( $request['include_character_count'] );
    }

    public function test_missing_statuses_default_to_publish(): void {
        $request = eum_normalize_export_request( array() );

        $this->assertSame( array( 'publish' ), $request['publish_status'] );
        $this->assertSame( array(), $request['post_types'] );
    }

    public function test_aioseo_is_detected_as_supported_plugin(): void {
        $plugin = eum_detect_seo_plugin_from_active_plugins( array( 'aioseo/aioseo.php' ) );

        $this->assertSame( 'aioseo/aioseo.php', $plugin['plugin_file'] );
        $this->assertSame( 'All in One SEO', $plugin['plugin_name'] );
    }

    public function test_multiple_active_seo_plugins_return_false(): void {
        $plugin = eum_detect_seo_plugin_from_active_plugins(
            array(
                'wordpress-seo/wp-seo.php',
                'seo-by-rank-math/rank-math.php',
            )
        );

        $this->assertFalse( $plugin );
    }

    public function test_aioseo_json_metadata_is_decoded(): void {
        $meta = eum_extract_aioseo_meta( '{"title":"Custom title","description":"Custom description"}' );

        $this->assertSame( 'Custom title', $meta['title'] );
        $this->assertSame( 'Custom description', $meta['description'] );
    }

    public function test_legacy_aioseo_values_are_used_as_fallbacks(): void {
        $meta = eum_extract_aioseo_meta( '', 'Legacy title', 'Legacy description' );

        $this->assertSame( 'Legacy title', $meta['title'] );
        $this->assertSame( 'Legacy description', $meta['description'] );
    }

    public function test_aioseo_homepage_values_are_read_from_options(): void {
        $meta = eum_extract_aioseo_homepage_meta(
            array(
                'searchAppearance' => array(
                    'global' => array(
                        'siteTitle'        => 'Homepage title',
                        'metaDescription'  => 'Homepage description',
                    ),
                ),
            )
        );

        $this->assertSame( 'Homepage title', $meta['title'] );
        $this->assertSame( 'Homepage description', $meta['description'] );
    }

    public function test_legacy_aioseo_homepage_values_are_read_from_options(): void {
        $meta = eum_extract_aioseo_homepage_meta(
            array(
                'home_title'       => 'Legacy homepage title',
                'home_description' => 'Legacy homepage description',
            )
        );

        $this->assertSame( 'Legacy homepage title', $meta['title'] );
        $this->assertSame( 'Legacy homepage description', $meta['description'] );
    }

    public function test_aioseo_custom_homepage_values_override_global_values(): void {
        $meta = eum_extract_aioseo_homepage_meta(
            array(
                'searchAppearance' => array(
                    'homePage' => array(
                        'title'           => 'Custom homepage title',
                        'metaDescription' => 'Custom homepage description',
                    ),
                    'global' => array(
                        'siteTitle'       => 'Global title',
                        'metaDescription' => 'Global description',
                    ),
                ),
            )
        );

        $this->assertSame( 'Custom homepage title', $meta['title'] );
        $this->assertSame( 'Custom homepage description', $meta['description'] );
    }

    public function test_export_session_requires_matching_user(): void {
        $session = array( 'user_id' => 7 );

        $this->assertTrue( eum_export_session_user_can_access( $session, 7 ) );
        $this->assertFalse( eum_export_session_user_can_access( $session, 8 ) );
        $this->assertFalse( eum_export_session_user_can_access( array(), 7 ) );
    }
}
