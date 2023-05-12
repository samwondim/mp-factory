
<link rel="stylesheet" href="<?php echo mp_cf_PLAGIN_URL . 'public/css/mp-factory-home.css' ?>" />

<article class="article-container">

  <div class="cf-dashboard">
  <div class="cf-left-section">
    <div class="cf-left-top-section">
    <?php $avatar_url = get_avatar_url($user->ID, array("size" => 260)); ?>
      <img src="<?php echo $avatar_url?>" alt="userprofile" />
      <div class="cf-left-meta-data">
        <h1 class="cf-meta-data-name">Hello, <?php echo $user->first_name .' '. $user->last_name; ?></h1>
        <div class="cf-meta-contain">
          <p class="cf-meta-data-mpxr">MPXR Balance:</p>
          <span class="cf-mpxr-balance"><?php echo $mpxr;?></span>
        </div>
        <div class="cf-meta-contain">
          <p class="cf-meta-data-desc">
            Currently available MPXR for voting:
          </p>
          <span><?php echo $vote_rep_availabe;?></span>
        </div>
        <div class="cf-meta-contain">
          <p class="cf-meta-data-desc">public address</p>
          <span><?php echo $public_address;?></span>
        </div>
      </div>
    </div>
    <div class="cf-left-bottom-section">
      
      <div class="cf-left-tabs cf-dashboard-tab">
        <?php echo file_get_contents(mp_cf_PLAGIN_DIR . 'public/assets/Category.svg'); 
        ?>

        <a href="<?php echo home_url('mp_cf_plugin/factory-dashboard')?>">
          <span class="cf-left-tabs-title">Factory Dashboard</span>
        </a>
      </div>

      <?php
        $user_data = get_userdata(get_current_user_id());
        $user_roles = $user_data->roles;
        if(in_array('editor', $user_roles)){?> 
          <div class="cf-left-tabs ">
            <?php echo file_get_contents(mp_cf_PLAGIN_DIR . 'public/assets/layer.svg'); 
            ?>

            <a href="<?php echo home_url('mp_cf_plugin/factory-dashboard/?moderate=true')?>">
              <span class="cf-left-tabs-title">Moderate Requests</span>
            </a>
          </div>
      <?php }?>

      <div class="cf-left-tabs cf-active-jobs-tab">
        <?php echo file_get_contents(mp_cf_PLAGIN_DIR . 'public/assets/activity-icon.svg'); ?>

        <a href="<?php echo home_url('mp_cf_plugin/active-jobs')?>">
          <span class="cf-left-tabs-title">Active Jobs</span>
          <?php echo file_get_contents(mp_cf_PLAGIN_DIR . 'public/assets/notification-bing.svg'); 
        ?>
        </a>
        <span class="cf-active-jobs-notif">(<?php do_shortcode('[mp_cf_active_jobs_code display = "count"]')?>)</span>
      </div>

      <div class="cf-left-tabs cf-my-request-tab">
        <?php echo file_get_contents(mp_cf_PLAGIN_DIR . 'public/assets/Edit-Square.svg') ?>
      <a href="<?php echo home_url('mp_cf_plugin/my-requests')?>">

        <span class="cf-left-tabs-title">My requests</span>
        <?php echo file_get_contents(mp_cf_PLAGIN_DIR . 'public/assets/notification-bing.svg'); ?>
      </a>
        <span>(<?php do_shortcode('[mp_cf_my_requests_code display = "count"]')?>)</span>
      </div>

      <div class="cf-left-tabs">
      <?php echo file_get_contents(mp_cf_PLAGIN_DIR . 'public/assets/User.svg') ?>

        <span class="cf-left-tabs-title">My Community Requests</span>
        <?php echo file_get_contents(mp_cf_PLAGIN_DIR . 'public/assets/notification-bing.svg'); ?>

        <span>(0)</span>
      </div>
      <div class="cf-left-tabs">
      <?php echo file_get_contents(mp_cf_PLAGIN_DIR . 'public/assets/money-recive.svg') ?>

        <span class="cf-left-tabs-title">Claim Payment</span>
      </div>
      <div class="cf-left-tabs">
      <?php echo file_get_contents(mp_cf_PLAGIN_DIR . 'public/assets/refresh.svg') ?>

        <span class="cf-left-tabs-title">History</span>
      </div>
    </div>
  </div>
  <?php echo the_content() ?>

  </div> 

</article>

</body>
