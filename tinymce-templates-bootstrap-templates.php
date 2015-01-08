<?php
/*
Plugin Name: Tinymce Templates Bootstrap Templates
Version: 1.0.0
Description: Bootstrap3 based templates for the TinyMCE Templates
Author: Takayuki Miyauchi
Author URI: http://miya0001.github.io/tinymce-templates/
Plugin URI: http://miya0001.github.io/tinymce-templates/
Text Domain: tinymce-templates-bootstrap-templates
Domain Path: /languages
*/

$tinymce_templates_bootstrap_templates = new Tinymce_Templates_Bootstrap_Templates();
$tinymce_templates_bootstrap_templates->register();

class Tinymce_Templates_Bootstrap_Templates
{
	public function register()
	{
		add_action( 'plugins_loaded', array( $this, 'plugins_loaded' ) );
	}

	public function plugins_loaded()
	{
		add_filter( 'tinymce_templates_post_objects',
				array( $this, 'tinymce_templates_post_objects' ) );
		add_filter( 'tinymce_templates_content',
				array( $this, 'tinymce_templates_content' ), 9, 3 );

		add_action( 'wp_enqueue_scripts', array( $this, 'wp_enqueue_scripts' ) );
	}

	public function wp_enqueue_scripts()
	{
		wp_enqueue_style(
			'tinymce-templates-bootstrap',
			plugins_url( 'css/bootstrap-custom.css', __FILE__ ),
			array(),
			filemtime( dirname( __FILE__ ) . '/css/bootstrap-custom.css' )
		);
	}

	public function tinymce_templates_post_objects( $posts )
	{
		return $posts + $this->get_templates();
	}

	public function tinymce_templates_content( $template, $p, $content )
	{
		if ( $template ) {
			return $template;
		} else {
			$templates = $this->get_templates();
			if ( isset( $templates[ $p['id'] ] ) && $templates[ $p['id'] ] ) {
				return $templates[ $p['id'] ]['content'];
			}
		}
	}

	public function get_templates()
	{
		return array(
			// Alerts
			'bt001' => array(
				'title'        => 'Alert Success',
				'is_shortcode' => true,
				'content'      => '<div class="tinymce-templates-bootstrap-wrap"><div class="alert alert-success" role="alert">{$content}</div></div>',
			),
			'bt002' => array(
				'title'        => 'Alert Info',
				'is_shortcode' => true,
				'content'      => '<div class="tinymce-templates-bootstrap-wrap"><div class="alert alert-info" role="alert">{$content}</div></div>',
			),
			'bt003' => array(
				'title'        => 'Alert Warning',
				'is_shortcode' => true,
				'content'      => '<div class="tinymce-templates-bootstrap-wrap"><div class="alert alert-warning" role="alert">{$content}</div></div>',
			),
			'bt004' => array(
				'title'        => 'Alert Danger',
				'is_shortcode' => true,
				'content'      => '<div class="tinymce-templates-bootstrap-wrap"><div class="alert alert-danger" role="alert">{$content}</div></div>',
			),
			// Panels
			'bt005' => array(
				'title'        => 'Panel',
				'is_shortcode' => true,
				'content'      => '<div class="tinymce-templates-bootstrap-wrap"><div class="panel panel-default"><div class="panel-heading"><h3 class="panel-title">{$title}</h3></div><div class="panel-body">{$content}</div></div></div>',
			),
			'bt006' => array(
				'title'        => 'Panel Primary',
				'is_shortcode' => true,
				'content'      => '<div class="tinymce-templates-bootstrap-wrap"><div class="panel panel-primary"><div class="panel-heading"><h3 class="panel-title">{$title}</h3></div><div class="panel-body">{$content}</div></div></div>',
			),
			'bt007' => array(
				'title'        => 'Panel Success',
				'is_shortcode' => true,
				'content'      => '<div class="tinymce-templates-bootstrap-wrap"><div class="panel panel-success"><div class="panel-heading"><h3 class="panel-title">{$title}</h3></div><div class="panel-body">{$content}</div></div></div>',
			),
			'bt008' => array(
				'title'        => 'Panel Info',
				'is_shortcode' => true,
				'content'      => '<div class="tinymce-templates-bootstrap-wrap"><div class="panel panel-info"><div class="panel-heading"><h3 class="panel-title">{$title}</h3></div><div class="panel-body">{$content}</div></div></div>',
			),
			'bt009' => array(
				'title'        => 'Panel Warning',
				'is_shortcode' => true,
				'content'      => '<div class="tinymce-templates-bootstrap-wrap"><div class="panel panel-warning"><div class="panel-heading"><h3 class="panel-title">{$title}</h3></div><div class="panel-body">{$content}</div></div></div>',
			),
			'bt010' => array(
				'title'        => 'Panel Danger',
				'is_shortcode' => true,
				'content'      => '<div class="tinymce-templates-bootstrap-wrap"><div class="panel panel-danger"><div class="panel-heading"><h3 class="panel-title">{$title}</h3></div><div class="panel-body">{$content}</div></div></div>',
			),
		);
	}
}
