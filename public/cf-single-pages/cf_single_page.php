<?php get_header() ?>
<?php get_sidebar() ?>

<?php 
if(get_current_user_id() > 0){
		include_once mp_cf_PLAGIN_DIR . 'public/cf-single-pages/dashboard_init.php';?>

<link rel="stylesheet" href="<?php echo mp_cf_PLAGIN_URL . 'public/css/mp-factory-home.css' ?>" />
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link
  href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;700&display=swap"
  rel="stylesheet"
/>

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
          <span><?php echo $mpxr;?></span>
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
      <div class="cf-left-tabs">
        <?php echo file_get_contents(mp_cf_PLAGIN_DIR . 'public/assets/Category.svg'); 
        ?>

        <a href="<?php echo home_url('mp_cf_plugin/factory-dashboard')?>">
          <span class="cf-left-tabs-title">Factory Dashboard</span>
        </a>
      </div>
      <div class="cf-left-tabs">
      <?php echo file_get_contents(mp_cf_PLAGIN_DIR . 'public/assets/Edit-Square.svg') ?>
        <a href="<?php echo home_url('mp_cf_plugin/request-content')?>">
          <span class="cf-left-tabs-title">Request content</span>
        </a>
      </div>
      <div class="cf-left-tabs">
      <a href="<?php echo home_url('mp_cf_plugin/my-requests')?>">

        <?php echo file_get_contents(mp_cf_PLAGIN_DIR . 'public/assets/Edit-Square.svg') ?>
        <!-- <img src="< ?php echo mp_cf_PLAGIN_URL . '/public/assets/Edit Square.svg'?>" alt=" " /> -->
        <span class="cf-left-tabs-title">My request</span>
        <img src="<?php echo mp_cf_PLAGIN_URL . '/public/assets/notification-bing.svg'?>" alt="" />
      </a>
        <span>(0)</span>
      </div>

      <div class="cf-left-tabs">
        <a href="<?php echo home_url('mp_cf_plugin/requested-articles')?>">
          <?php echo file_get_contents(mp_cf_PLAGIN_DIR . 'public/assets/graph-icon.svg') ?>
          <span class="cf-left-tabs-title">Requested articles</span>
          <img src="<?php echo mp_cf_PLAGIN_URL . '/public/assets/notification-bing.svg'?>" alt="" />
        </a>
        <span>(0)</span>
      </div>

      <div class="cf-left-tabs">
      <?php echo file_get_contents(mp_cf_PLAGIN_DIR . 'public/assets/User.svg') ?>
        <!-- <img src="< ?php echo mp_cf_PLAGIN_URL . '/public/assets/3 User.svg'?>" alt="ICO" /> -->
        <span class="cf-left-tabs-title">My Community Request</span>
        <img src="<?php echo mp_cf_PLAGIN_URL . '/public/assets/notification-bing.svg'?>" alt="" />
        <span>(0)</span>
      </div>
      <div class="cf-left-tabs">
      <?php echo file_get_contents(mp_cf_PLAGIN_DIR . 'public/assets/money-recive.svg') ?>
        <!-- <img src="< ?php echo mp_cf_PLAGIN_URL . '/public/assets/money-recive.svg'?>" alt="ICO" /> -->
        <span class="cf-left-tabs-title">Claim Payment</span>
      </div>
      <div class="cf-left-tabs">
      <?php echo file_get_contents(mp_cf_PLAGIN_DIR . 'public/assets/refresh.svg') ?>
        <!-- <img src="< ?php echo mp_cf_PLAGIN_URL . '/public/assets/refresh.svg'?>" alt="ICO" /> -->
        <span class="cf-left-tabs-title">History</span>
      </div>
    </div>
  </div>

    <div class="cf-right-section">
      <div class="cf-right-top-section">
        <h1><?php echo get_the_title()?></h1>
        <div class="cf-right-top-icon-container">
          <img src="<?php echo mp_cf_PLAGIN_URL . '/public/assets/Setting.svg'?>" alt="" />
        </div>
      </div>
      <?php echo the_content() ?>
    </div>
  </div>

</article>

<?php
}
else {
  echo "You must loggin first ";
}

get_footer() ?>

</body>