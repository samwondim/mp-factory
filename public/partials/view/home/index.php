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
    <div class="cf-center-grid-card">
      <div class="cf-center-grid-card-top">
        <img
          class="cf-center-grid-card-img"
          src="<?php echo mp_cf_PLAGIN_URL . 'public/assets/graph.svg'?>"
          alt=""
        />
        <span class="cf-request-content cf-center-grid-card-heading" data-min-mpxr="<?php echo $min_mpxr?>">Request content</span>
      </div>

      <img src="<?php echo mp_cf_PLAGIN_URL . 'public/assets/Line 14.svg'?>" class="cf-line" alt="line" />
    </div>

  <a href="<?php echo home_url('mp_cf_plugin/vote')?>">
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
        <b>Active votes: <span><?php do_shortcode('[mp_cf_vote_code display = "count"]')?></span></b>
      </p>
      <img src="<?php echo mp_cf_PLAGIN_URL . 'public/assets/Line 14.svg'?>" class="cf-line" alt="line" />
    </div>
  </a>

    
  <div class="popup" id="popup-cf">
    <div class="popcard" style="top: 30%" >
        <div class="popup-wrapper">
            <p class="popup-close" id="cf-close">&#10005;</p>
            <div class="cf-popup-content">
                
            </div>
        </div>
    </div>
  </div>
</div>
    
<script>
  window.addEventListener('DOMContentLoaded', () => {
    const userRole = document.querySelector('.cf-right-center-grid')
    const requestBtn = document.querySelector('.cf-request-content')
    const mpxrBalance = parseInt(document.querySelector('.cf-mpxr-balance').innerHTML)
    const cfPopup = document.querySelector('#popup-cf')
    const cfPopupClose = document.querySelector('#cf-close')
    
    if( userRole.getAttribute('data-user') == 'moderator'){
      document.querySelector('.cf-dashboard-tab').classList.add('cf-editor-active')
    }else {
      document.querySelector('.cf-dashboard-tab').classList.add('cf-active')
    }
    
    requestBtn.addEventListener('click',function(){
      const minMPXR = requestBtn.getAttribute('data-min-mpxr')
      if(mpxrBalance >= parseInt(minMPXR)){
        window.location.href = `<?php echo home_url('mp_cf_plugin/request-content')?>`
      }
      else{
        cfPopup.style.display = 'block'
        document.querySelector('.cf-popup-content').innerHTML = `You need Minimum ${minMPXR}MPXR to request content.`
      }
    })
    window.addEventListener('click', function(e) {
      if (e.target == cfPopup) {
        cfPopup.style.display = 'none'
      }
    })
    cfPopupClose.addEventListener('click',function() {
      cfPopup.style.display = 'none'
    })
  })
</script>