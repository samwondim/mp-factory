<?php
 get_header() ;
 get_sidebar();
if ( is_user_logged_in() ) {
    $user = wp_get_current_user();
    $mp_rep_base_api = get_option('mp_rep_base_api', 'none');
    $mp_rep_community_slug = get_option('mp_rep_community_slug', 'none');
    if ($mp_rep_base_api == "none" || $mp_rep_community_slug == "none") {
        echo "Admin should set reputation settings first!";
    } 
    else {
        $url = $mp_rep_base_api . "core/communities/" . $mp_rep_community_slug . "/users/" . get_current_user_id() . "/";

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
            if (isset($response['vote_rep_availabe'])) $vote_rep_availabe = round($response['vote_rep_availabe'],3);
            else $vote_rep_availabe = 0;
            if (isset($response['public_address'])) $public_address = $response['public_address'];
            else $public_address = 0;
        }
        else{
            $mpxr = 0;
            $vote_rep_availabe = 0;
            $public_address = 0;
        } 
    }
   
    $user_role = array_shift($user->roles);
    if($user_role == 'editor'){
        include_once mp_cf_PLAGIN_DIR . 'public/cf-single-pages/cf_single_editor_page.php';
    }
    else{
        include_once mp_cf_PLAGIN_DIR . 'public/cf-single-pages/cf_single_page.php';
    }
}
else {
    ?>
    <script>
        window.location.href = '<?php echo home_url("/?type=login") ?>'
    </script>
    <?php
}
get_footer();
?>