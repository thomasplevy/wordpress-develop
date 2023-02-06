<?php

/**
 * @group link
 * @covers ::wp_internal_hosts
 */
class Tests_Link_wpInternalHosts extends WP_UnitTestCase {

	public function test_internal_hosts() {
		$expected = array( 'example.org' );
		$this->assertSame( $expected, wp_internal_hosts() );
	}

	/**
	 * @runInSeparateProcess
	 * @preserveGlobalState disabled
	 */
	public function test_internal_hosts_add_host() {
		$expected = array( 'example.org', 'mycustomhost.tld' );

		$add_host = function( $hosts ) {
			$hosts[] = 'MyCustomHost.tld';
			$hosts[] = 'mycustomhost.tld';
			return $hosts;
		};
		add_filter( 'wp_internal_hosts', $add_host );

		$this->assertSame( $expected, wp_internal_hosts() );

		remove_filter( 'wp_internal_hosts', $add_host );
	}

	/**
	 * @runInSeparateProcess
	 * @preserveGlobalState disabled
	 */
	public function test_internal_hosts_remove_host() {
		add_filter( 'wp_internal_hosts', '__return_empty_array' );

		$this->assertSame( array(), wp_internal_hosts() );

		remove_filter( 'wp_internal_hosts', '__return_empty_array' );
	}

}
