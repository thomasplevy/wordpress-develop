<?php

/**
 * @group link
 * @covers ::wp_is_internal_link
 */
class Tests_Link_wpIsInternalLink extends WP_UnitTestCase {

	/**
	 * @dataProvider data_links
	 */
	public function test_is_link_internal( $expected, $link ) {
		$this->assertSame( $expected, wp_is_internal_link( $link ) );
	}

	public function data_links() {
		return array(
			array( true, 'https://example.org' ),
			array( true, 'http://example.org' ),
			array( true, 'https://Example.Org' ),
			array( true, 'http://Example.Org' ),
			array( true, 'https://example.org/path/to/page' ),
			array( true, 'http://example.org/path/to/page' ),
			array( false, 'http://external.tld' ),
			array( false, 'https://external.tld' ),
			array( false, 'http://example.com' ),
			array( false, 'https://example.com' ),
		);
	}
}
