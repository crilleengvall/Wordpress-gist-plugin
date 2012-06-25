<?php
/**
 * @package GistPlugin
 * @version 0.1
 */
/*
Plugin Name: Gist plugin
Plugin URI: 
Description: When linking to a gist on github this plugin shows the code from that gist
Author: Christian Engvall
Version: 0.1
Author URI: http://www.christianengvall.se
*/

class GistPlugin
{
	public function __construct()
	{
		$this->registerEmbedHandler();
		$this->loadTextDomain();
	}

	public function displayGist($matches, $attr, $url, $rawattr)
	{
		$embed = sprintf('<script src="https://gist.github.com/%1$s.js%2$s"></script><noscript><i>'.__( 'javascript not activated', 'wordpress-gist-plugin' ). ' <a href="https://gist.github.com/%1$s">https://gist.github.com/%1$s</a></i></noscript>', esc_attr($matches[1]), esc_attr($matches[2]));
		return apply_filters( 'embed_gist', $embed, $matches, $attr, $url, $rawattr );
	}

	protected function registerEmbedHandler()
	{
		wp_embed_register_handler( 'gist', '/https:\/\/gist\.github\.com\/(\d+)(\?file=.*)?/i', array($this, 'displayGist'));
	}

	protected function loadTextDomain()
	{
		load_plugin_textdomain('wordpress-gist-plugin', false, basename( dirname( __FILE__ ) ) . '/languages' );
	}
}

$gistPlugin = new GistPlugin();

?>