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

class MP_pq_Post_Queue_mgr 
{
    function wp_ajax_mp_pq_add_post_to_queue() 
    {
        global $table_prefix, $wpdb;
        $table_name = $table_prefix . 'post_queue';
        
        $post_data = $_POST['post_data'];

        if(!empty($post_data)) {
            $wpdb->insert($table_name, array('post_data' => $post_data, 'status' => 'status one'));
            
            return 'Post added to the queue.';
        } else {
            
            return 'Invalid post data.';
        }
    }

    function wp_ajax_mp_pq_post_status_update()
    {
        global $table_prefix, $wpdb;
        $table_name = $table_prefix . 'post_queue';

        // pre update tasks will go here.

        
        if(!wp_next_scheduled('mp_pq_process_posts_in_batch')) {
            //update the post status every 1 minute.
            wp_schedule_event(time() + 6, '1min', 'mp_pq_process_posts_in_batch');
        }
    }

    function mp_pq_process_posts_in_batch()
    {
        global $table_prefix, $wpdb;
        $table_name = $table_prefix . 'post_queue';

        $batch_size = 2;
        $new_status = "status two";

        $posts = $wpdb->get_results("SELECT * FROM $table_name WHERE status = 'status one' LIMIT $batch_size");
        if(!empty($posts)) {
            foreach($posts as $post) {
                $wpdb->update($table_name, ['status' => $new_status], ['id' => $post->id]);
            }
        }
        
    }

    public function cron_jobs($schedules)
	{
        if(!isset($schedules["0.5min"])){
			$schedules["0.5"] = array(
				'interval' => 30,
				'display' => __('Twice every 1 minute'));
		}
		if(!isset($schedules["2min"])){
			$schedules["2min"] = array(
				'interval' => 2*60,
				'display' => __('Once every 2 minute'));
		}
		return $schedules;

	}
}