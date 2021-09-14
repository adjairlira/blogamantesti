<?php

namespace ElementsKit_Lite\Libs\Framework\Classes;

defined( 'ABSPATH' ) || exit;

class Plugin_Data_Sender {

	private static $instance;
	private $installedPlugins = [];
	private $themes = [];
	private $activatedPlugins = [];

	public function __construct() {
		$this->set_activated_plugins();
		$this->set_installed_plugins();
		$this->setThemes();
	}

	private function set_activated_plugins() {
		foreach ( apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) as $plugin ) {
			array_push( $this->activatedPlugins, $plugin );
		}
	}

	private function set_installed_plugins() {
		foreach ( get_plugins() as $key => $plugin ) {
			$status = false;
			if ( in_array( $key, $this->activatedPlugins ) ) {
				$status = true;
			}
			array_push( $this->installedPlugins, [
				'name'      => $plugin['Name'],
				'version'   => $plugin['Version'],
				'is_active' => $status,
			] );
		}
	}

	private function setThemes() {
		foreach ( wp_get_themes() as $key => $theme ) {
			array_push( $this->themes, $key );
		}
	}

	public static function instance() {
		if ( ! static::$instance ) {
			static::$instance = new static();
		}

		return static::$instance;
	}

	public function send( $route ) {
		return wp_remote_post(
            \ElementsKit_Lite::api_url() .$route ,
			[
				'method'      => 'POST',
				'data_format' => 'body',
				'headers'     => [
					'Content-Type' => 'application/json'
				],
				'body'        => json_encode( $this->get_data() )
			]
		);
	}

	public static function sendAutomizyData( $route, $data ) {
		return wp_remote_post(
            \ElementsKit_Lite::api_url().$route,
			[
				'method'      => 'POST',
				'data_format' => 'body',
				'headers'     => [
					'Content-Type' => 'application/json'
				],
				'body'        => json_encode( $data )
			]
		);
	}

	public function get_data() {
		return [
			"plugin_name"         => 'elementskit-lite',
			"domain"              => get_site_url(),
			"total_user"          => count_users()['total_users'],
			"themes"              => $this->themes,
			"active_theme"        => wp_get_theme()->get( 'Name' ),
			"plugins"             => $this->installedPlugins,
			"php_version"         => phpversion(),
			"db_version"          => mysqli_get_client_version(),
			"server_name"         => explode( ' ', $_SERVER['SERVER_SOFTWARE'] )[0],
			"max_execution_time"  => ini_get( 'max_execution_time' ),
			"php_memory_size"     => ini_get( 'memory_limit' ),
			"installed_languages" => wp_get_installed_translations( 'themes' )
		];
	}
}