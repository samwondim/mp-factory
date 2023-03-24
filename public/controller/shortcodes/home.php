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

	public function mp_cf_home_shortcode()
	{
		$mp_rep_base_api = get_option('mp_rep_base_api', 'none');
		$mp_rep_community = get_option('mp_rep_community', 'none');

		if ($mp_rep_base_api == "none" || $mp_rep_community == "none") {
			echo "Admin should set reputation settings first!";
		} else {


			$url = $mp_rep_base_api . "core/communities/" . $mp_rep_community . "/users/" . get_current_user_id() . "/";

            $server_output = wp_remote_get(
                $url,
                array(
                  'headers' => array(
                    'X-API-Key' => get_option('mp_rep_community_api_key'), 
                    'com-id' => get_option('mp_rep_community_id')  
                  )
                )
              );

            if (!is_wp_error($server_output)){
			$response = json_decode($server_output['body'], true);
            
            if (isset($response['mpxr'])) $mpxr = $response['mpxr'];
			else $mpxr = 0;
			if (isset($response['vote_rep_availabe'])) $vote_rep_availabe = $response['vote_rep_availabe'];
			else $vote_rep_availabe = 0;
			if (isset($response['public_address'])) $public_address = $response['public_address'];
			else $public_address = 0;

        }else{
			$mpxr = 0;
			$vote_rep_availabe = 0;
			$public_address = 0;

            }

			include_once mp_cf_PLAGIN_DIR . 'public/partials/view/home.php';
		}
	}
}
