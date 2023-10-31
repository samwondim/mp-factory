<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/samwondim
 * @since      1.0.0
 *
 * @package    Mindplex_Post_Queue
 * @subpackage Mindplex_Post_Queue/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Mindplex_Post_Queue
 * @subpackage Mindplex_Post_Queue/public
 * @author     Samuel Wondimagegnehu <samwondim@gmail.com>
 */

class Mp_pq_Posts 
{
    public function mp_pq_add_post_shortcode() 
    {
		  include_once mp_pq_PLUGIN_DIR . 'public/partials/view/index.php';
    }
}