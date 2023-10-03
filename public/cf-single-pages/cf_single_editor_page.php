
<link rel="stylesheet" href="<?php echo mp_cf_PLAGIN_URL . 'public/css/mp-factory-home.css' ?>" />
<style>
  .cf-left-tabs{
    border-bottom: 1px solid #FF5C97 !important;
  }
</style>
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
        <?php echo file_get_contents(mp_cf_PLAGIN_DIR . 'public/assets/layer.svg'); 
        ?>

        <a href="<?php echo home_url('mp_cf_plugin/factory-dashboard/?moderate=true')?>">
          <span class="cf-left-tabs-title">MP Content Factory</span>
        </a>
      </div>

      <div class="cf-left-tabs cf-dashboard-tab">
        <?php echo file_get_contents(mp_cf_PLAGIN_DIR . 'public/assets/Category.svg'); 
        ?>

        <a href="<?php echo home_url('mp_cf_plugin/factory-dashboard')?>">
          <span class="cf-left-tabs-title">Goto Factory Dashboard</span>
        </a>
      </div>

      <div class="cf-left-tabs cf-review-requests-tab">
        <?php echo file_get_contents(mp_cf_PLAGIN_DIR . 'public/assets/Edit-Square.svg'); ?>

        <a href="<?php echo home_url('mp_cf_plugin/review-requests/?moderate=true')?>">
          <span class="cf-left-tabs-title">Review Requests</span>
          <?php echo file_get_contents(mp_cf_PLAGIN_DIR . 'public/assets/notification-bing.svg'); 
        ?>
        </a>
        <span>(<?php do_shortcode('[mp_cf_review_requests_code display = "count"]')?>)</span>
      </div>

      <div class="cf-left-tabs cf-review-submissions-tab">
        <?php echo file_get_contents(mp_cf_PLAGIN_DIR . 'public/assets/copy-success.svg'); ?>

        <a href="<?php echo home_url('mp_cf_plugin/review-submissions/?moderate=true')?>">
          <span class="cf-left-tabs-title">Review Submissions</span>
          <?php echo file_get_contents(mp_cf_PLAGIN_DIR . 'public/assets/notification-bing.svg'); 
        ?>
        </a>
        <span>(<?php do_shortcode('[mp_cf_review_submissions_code display = "count"]')?>)</span>
      </div>

      
    </div>
  </div>
  <?php echo the_content() ?>

  </div> 

</article>

</body>
