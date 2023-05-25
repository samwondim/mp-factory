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
class Mp_cf_submit_content
{
	public function mp_cf_image_upload_hundler($uploadedfile, $image_name, $post_id){
		$upload_overrides = array(
		  'test_form' => false
		);
		$movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
		if($movefile['file']) {
			$filename = $movefile['file'];
			$filetype = wp_check_filetype( basename( $filename ), null );
			$wp_upload_dir = wp_upload_dir();
		
			// Prepare an array of post data for the attachment.
			$attachment = array(
				'guid'           => $wp_upload_dir['url'] . '/' . basename( $filename ), 
				'post_mime_type' => $filetype['type'],
				'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
				'post_content'   => $image_name,
				'post_status'    => 'inherit'
			);
		
			// Insert the attachment.
			$attach_id = wp_insert_attachment( $attachment, $filename, $post_id );
			// Make sure that this file is included, as wp_generate_attachment_metadata() depends on it.
			require_once( ABSPATH . 'wp-admin/includes/image.php' );
		
			// Generate the metadata for the attachment, and update the database record.
			$attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
			wp_update_attachment_metadata( $attach_id, $attach_data );

			if($image_name === 'thumbnailImage'){
				$image_data = array ('src' => $movefile['url']);
				update_post_meta( $post_id, 'thumbnail_image', $image_data );
			}
			else {
				set_post_thumbnail( $post_id, $attach_id );
			} 
			return 'uploaded';
		} 
		return $movefile;
	}

	public function wp_ajax_mp_cf_submit_content(){
		if(
			isset($_POST['postId']) &&
			isset($_POST['userId']) &&
			isset($_POST['contentCategory']) &&
			isset($_POST['submitTitle']) &&
			isset($_POST['submit_content'])
		){

			$insert_id = wp_insert_post(array(
				'post_title'    => $_POST['submitTitle'],
				'post_content'  => $_POST['submit_content'],
				'post_status'   => "pending",//'requested',
				'post_author'   => get_current_user_id(),
				'post_type' => 'cf-submitted-content',
				
			));
			
			if (!is_wp_error($insert_id)) {
				wp_set_post_terms($insert_id, $_POST['contentCategory'], 'category');
				$request_status = get_post_meta($_POST['postId'], 'mp_cf_claim_data_'.get_current_user_id(),true);

				if(!empty($request_status)){

					$request_status['claim_status'] = 'submitted';
					$request_status['post_id'] = $insert_id;
					update_post_meta($_POST['postId'], 'mp_cf_claim_data_'.get_current_user_id(), $request_status);
	
					add_post_meta($insert_id, 'mp_cf_submitted_from', $_POST['postId']);

					update_post_meta($insert_id, 'mp_gl_post_brief_overview', $_POST['contentTeaser']);
					update_post_meta($insert_id, 'mp_gl_post_author_bio', $_POST['contentBio']);
					
					// echo 'done';
				}

				if(isset($_FILES['thumbnailImage'])){
					$uploadedfile = $_FILES['thumbnailImage'];
					$image_name = 'thumbnailImage';
					$is_uploaded = apply_filters('mp_cf_upload', $uploadedfile, $image_name, $insert_id);
				}
				if(isset($_FILES['featureImage'])){
					$uploadedfile = $_FILES['featureImage'];
					$image_name = 'featureImage';
					$is_uploaded = apply_filters('mp_cf_upload', $uploadedfile, $image_name, $insert_id);
				}

			}
		}
	die();
	}

	public function wp_ajax_mp_cf_my_submission_detail(){
		$post_id = $_POST['postId'];
		$post = get_post($post_id);

		if($post){
			$first_name = get_user_meta($post->post_author, 'first_name', true);
			
			$moderator_comment = get_post_meta($post->ID, 'mp_cf_moderator_comment',true);
			
			$request_status = get_post_meta($_POST['requestId'], 'mp_cf_claim_data_'.get_current_user_id(),true);
			
			if($request_status['user_id'] == get_current_user_id()){
				if($request_status['claim_status'] == 'submitted'){
					$claimer_status = 'Waiting for moderator.';
				}
				else if($request_status['claim_status'] ==='moderator_approved'){
					$claimer_status = 'Waiting for requester.';
				}else if($request_status['claim_status'] ==='requester_approved'){
					$claimer_status = 'Waiting for rank.';
				}
			}
			else $claimer_status = 'Active';

			$category = wp_get_post_terms($post_id, 'category',true);
			include_once mp_cf_PLAGIN_DIR . 'public/partials/view/active_jobs/detail.php';
		}
		die();
	}

	public function wp_ajax_mp_cf_requester_submitted_update(){
		$requested_post_id = $_POST['postId'];
		$submitted_post_id = $_POST['submitted_post_id'];
		$author_id = $_POST['userId'];
		$post_status = $_POST['status'];
		$requestor_comment = $_POST['comment'];
		if(get_post($requested_post_id)){

			update_post_meta($submitted_post_id, 'mp_cf_requester_comment', $requestor_comment);
			
			$submitter_status = get_post_meta($requested_post_id, 'mp_cf_claim_data_'.$author_id,true); 
			if(!empty($submitter_status)){

				$submitter_status['claim_status'] = 'requester_'.$post_status;
				update_post_meta($requested_post_id, 'mp_cf_claim_data_'.$author_id, $submitter_status);


			}
			print_r($submitter_status);

		}
		die();
	}
}
