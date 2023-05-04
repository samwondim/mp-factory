<?php 
$user_data = get_userdata(get_current_user_id());
$user_roles = $user_data->roles;
if(isset($_GET['moderate']) && $_GET['moderate'] === 'true' &&  in_array('editor', $user_roles)) $is_moderator = 'moderator';
else $is_moderator = 'user'
?>
<div class="cf-right-center-grid" data-user ="<?php echo $is_moderator?>">
      <div class="cf-center-grid-card">
        <div class="cf-center-grid-card-top">
          <img
            class="cf-center-grid-card-img"
            src="<?php echo mp_cf_PLAGIN_URL . 'public/assets/color-swatch.svg'?>"
            alt=""
          />
          <span class="cf-center-grid-card-heading">How it Works</span>
        </div>
        <img src="<?php echo mp_cf_PLAGIN_URL . 'public/assets/Line 14.svg'?>" class="cf-line" alt="line" />
      </div>
      <a href="<?php echo home_url('mp_cf_plugin/view-all-jobs/')?>">

        <div class="cf-center-grid-card">
          <div class="cf-center-grid-card-top">
            <img
              class="cf-center-grid-card-img"
              src="<?php echo mp_cf_PLAGIN_URL . 'public/assets/personalcard.svg'?>"
              alt=""
            />
            <span class="cf-center-grid-card-heading">View Jobs</span>
          </div>
          <p class="cf-card-notification">Write an article and get Paid.</p>
          <p class="cf-card-notification">
            <b>Available jobs: <span><?php do_shortcode('[mp_cf_requested_articles_code display = "count"]')?></span></b>
          </p>
          <img src="<?php echo mp_cf_PLAGIN_URL . 'public/assets/Line 14.svg'?>" class="cf-line" alt="line" />
        </div>
      </a>
      <a href="<?php echo home_url('mp_cf_plugin/request-content')?>">
        <div class="cf-center-grid-card">
          <div class="cf-center-grid-card-top">
            <img
              class="cf-center-grid-card-img"
              src="<?php echo mp_cf_PLAGIN_URL . 'public/assets/graph.svg'?>"
              alt=""
            />
            <span class="cf-center-grid-card-heading">Request content</span>
          </div>

          <img src="<?php echo mp_cf_PLAGIN_URL . 'public/assets/Line 14.svg'?>" class="cf-line" alt="line" />
        </div>
      </a>
      <div class="cf-center-grid-card">
        <div class="cf-center-grid-card-top">
          <img
            class="cf-center-grid-card-img"
            src="<?php echo mp_cf_PLAGIN_URL . 'public/assets/chart-2.svg'?>"
            alt=""
          />
          <span class="cf-center-grid-card-heading">Vote</span>
        </div>
        <p class="cf-card-notification">Vote on articles</p>
        <p class="cf-card-notification">
          <b>Active votes: <span>(20)</span></b>
        </p>
        <img src="<?php echo mp_cf_PLAGIN_URL . 'public/assets/Line 14.svg'?>" class="cf-line" alt="line" />
      </div>
    </div>
    
<script>
  window.addEventListener('DOMContentLoaded', () => {
    const userRole = document.querySelector('.cf-right-center-grid')
    console.log(userRole.getAttribute('data-user'));
    
    if( userRole.getAttribute('data-user') == 'moderator'){
      document.querySelector('.cf-dashboard-tab').classList.add('cf-editor-active')
    }else {
      document.querySelector('.cf-dashboard-tab').classList.add('cf-active')
    }
  })
</script>