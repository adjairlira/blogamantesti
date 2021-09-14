<?php

namespace ElementsKit_Lite\Libs\Framework\Classes;

defined( 'ABSPATH' ) || exit;

class Onboard_Status {

	private static $optionKey = 'elements_kit_onboard_status';
	private static $optionValue = 'onboarded';

	public static function onboard() {
		add_action('elementskit/admin/after_save', [self, 'ajax_action']);
		
		if ( get_option( static::$optionKey ) ) {
			return true;
		}


		$param      = isset( $_GET['ekit-onboard-steps'] ) ? $_GET['ekit-onboard-steps'] : null;
		$requestUri = ( isset( $_GET['post_type'] ) ? $_GET['post_type'] : '' ) . ( isset( $_GET['page'] ) ? $_GET['page'] : '' );

		if ( strpos( $requestUri, 'elementskit' ) !== false && is_admin() ) {
			if ( $param !== 'loaded' && ! get_option( static::$optionKey ) ) {
				wp_redirect( static::get_onboard_url() );
				exit;
			}
		}

		return true;
	}

	public static function ajax_action(){
		// finish on-boarding
		self::finish_onboard();

		if ( isset( $_POST['settings']['tut_term'] ) && $_POST['settings']['tut_term'] == 'user_agreed' ) {
			Plugin_Data_Sender::instance()->send( 'data-collector' ); // send non-sensitive diagnostic data and details about plugin usage.
		}

		if ( isset( $_POST['settings']['newsletter_email'] ) && $_POST['settings']['newsletter_email']) {
			$data = ['email' => $_POST['settings']['newsletter_email'], 'list_id' => 22] ;
			Plugin_Data_Sender::instance()->sendAutomizyData( 'sync/email', $data);
		}
	}

	private static function get_onboard_url() {
		return add_query_arg(
			array(
				'page'               => 'elementskit',
				'ekit-onboard-steps' => 'loaded'
			),
			admin_url( 'admin.php' )
		);
	}

	public static function redirect_onboard() {
		if ( ! get_option( static::$optionKey ) ) {
			wp_redirect( static::get_onboard_url() );
			exit;
		}
	}

	public static function exit_from_onboard() {
		if ( get_option( static::$optionKey ) ) {
			wp_redirect( static::get_plugin_url() );
			exit;
		}
	}

	private static function get_plugin_url() {
		return add_query_arg(
			array(
				'page' => 'elementskit',
			),
			admin_url( 'admin.php' )
		);
	}

	public static function finish_onboard() {
		if ( ! get_option( static::$optionKey ) ) {
			add_option( static::$optionKey, static::$optionValue );
		}
	}

}