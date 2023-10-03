<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/EsubalewAmenu
 * @since      1.0.0
 *
 * @package    Mp_cf
 * @subpackage Mp_cf/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Mp_cf
 * @subpackage Mp_cf/admin
 * @author     Esubalew A. <esubalew.amenu@singularitynet.io>
 */
class Mp_cf_home_public
{

	public function mp_cf_dashboard_shortcode()
	{
		$min_mpxr = get_option('mp_cf_min_mpxr_to_request',1);
		include_once mp_cf_PLAGIN_DIR . 'public/partials/view/home/index.php';
	}

	public function mp_cf_request_shortcode(){
		$guarantee_value = get_option('mp_cf_guarantee_value','none');
		$categories = get_categories(array(
			'orderby' => 'name',
			'order'   => 'ASC',
			'hide_empty' => FALSE
		));
		wp_enqueue_style( 'mp-factory-request-content-style', mp_cf_PLAGIN_URL . 'public/css/mp-factory-request-content.css', false, '1.0', 'all' ); 

		include_once mp_cf_PLAGIN_DIR . 'public/partials/view/request_content/index.php';
	}

	public function mp_cf_requested_articles_shortcode($data){
		// need more filters
		$current_date = date( 'Y-m-d' ); // Get the current date in YYYY-MM-DD format
		$user_id = get_current_user_id();

		$requested_articles = get_posts(array(
			'post_type' => 'cf-requested-content',
			'post_status' => ['approved','win_vote'],
			'posts_per_page' => -1,
			'author__not_in' => array( $user_id ),
			'meta_query' => array(
				
				array(
					'key' => 'req_deadline', // get requests when its deadline is greater than the current date.
					'value' => $current_date,
					'compare' => '>=',
					'type' => 'DATE'
				),
				array(
					'key' => 'mp_cf_claim_data_'.$user_id,
					'compare' => 'NOT EXISTS',
				)
				
			)
		));
		if(isset($data['display']) && $data['display'] === 'count') echo count($requested_articles);
		
		else {
			wp_enqueue_style( 'mp-factory-request-content-style', mp_cf_PLAGIN_URL . 'public/css/mp-factory-request-content.css', false, '1.0', 'all' ); 

			wp_enqueue_style( 'mp-factory-requested-articles-style', mp_cf_PLAGIN_URL . 'public/css/mp-factory-requested-articles.css', false, '1.0', 'all' ); 
			include_once mp_cf_PLAGIN_DIR . 'public/partials/view/requested_articles/index.php';
		}
	}

	public function mp_cf_my_requests_shortcode($data){
		$user_id =  get_current_user_id();
		$my_requests = get_posts(array(
			'post_type' => 'cf-requested-content',
			'post_status' => ['approved','declined','pending', 'win_vote','pending_vote','lose_vote'],
			'author__in' => $user_id ,
			'posts_per_page' => -1

		));

		if(isset($data['display']) && $data['display'] === 'count'){
			$new_requests = count(get_user_meta($user_id, 'mp_cf_new_request'));
			echo $new_requests;
		}

		else if(isset($_GET['moderate_submission'])){

			$post_id = esc_attr($_GET['moderate_submission']);
			$post = get_post($post_id);
			
			//validate the submitted post id article requester is the current user
			$requested_post_id = get_post_meta($post->ID, 'mp_cf_submitted_from',true);
			$author_id = get_post_field ('post_author', $requested_post_id);

			if($post  && $author_id == get_current_user_id()){
				$category = wp_get_post_terms($post_id, 'category',true);
				include_once mp_cf_PLAGIN_DIR . 'public/partials/view/my_requests/moderate_submission.php';
			}
		}
		
		else{
			delete_user_meta(get_current_user_id(), 'mp_cf_new_request');
			wp_enqueue_style( 'mp-factory-requested-articles-style', mp_cf_PLAGIN_URL . 'public/css/mp-factory-requested-articles.css', false, '1.0', 'all' ); 
			include_once mp_cf_PLAGIN_DIR . 'public/partials/view/my_requests/index.php';
		}
	}
	
	public function mp_cf_active_jobs_shortcode($data){
		$user_id =  get_current_user_id();
		$active_jobs = get_posts(array(
			'post_type' => 'cf-requested-content',
			'post_status' => ['approved','win_vote'],
			'meta_query' => array(
				array(
					'key' => 'mp_cf_claim_article', 
					'value' => $user_id,
				)
			)
		));

		if(isset($data['display']) && $data['display'] === 'count'){
			$new_claim = count(get_user_meta($user_id, 'mp_cf_claimed_count'));
			echo $new_claim;
		}

		else{
			wp_enqueue_style( 'mp-factory-active-jobs-style', mp_cf_PLAGIN_URL . 'public/css/mp-factory-active-jobs.css', false, '1.0', 'all' ); 

			if(isset($_GET['submit_request'])){

				$post_id = esc_attr($_GET['submit_request']);
				$post = get_post($post_id);
				$is_claimed = get_post_meta($post->ID, 'mp_cf_claim_article',get_current_user_id());
				if($post && !empty($is_claimed)){
					$categories = get_categories(array(
						'orderby' => 'name',
						'order'   => 'ASC',
						'hide_empty' => FALSE
					));
					$requested_title = get_the_title($post->ID);
					$requested_category = get_the_category($post->ID);
					include_once mp_cf_PLAGIN_DIR . 'public/partials/view/active_jobs/submit_form.php';
				}
				else {
					
					?>
				 	<script>
						window.location.replace("<?php echo esc_url( home_url('mp_cf_plugin/active-jobs/') ); ?>");
					</script>
					<?php
				}
			}
			else {
				$current_userId = get_current_user_id();
				include_once mp_cf_PLAGIN_DIR . 'public/partials/view/active_jobs/index.php';
			}
		}
	}
}

