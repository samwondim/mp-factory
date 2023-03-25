
<link rel="stylesheet" href="<?php echo mp_cf_PLAGIN_URL . 'public/css/mp-factory-home.css' ?>" />
<title>Document</title>
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link
  href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;700&display=swap"
  rel="stylesheet"
/>
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
        <img src="<?php echo mp_cf_PLAGIN_URL . '/public/assets/Category.svg' ?>" alt=" " />
        <span class="cf-left-tabs-title">Factory Dashboard</span>
      </div>
      <div class="cf-left-tabs">
        <img src="<?php echo mp_cf_PLAGIN_URL . '/public/assets/Edit Square.svg'?>" alt=" " />
        <span class="cf-left-tabs-title">My request</span>
        <img src="<?php echo mp_cf_PLAGIN_URL . '/public/assets/notification-bing.svg'?>" alt="" />
        <span>(0)</span>
      </div>
      <div class="cf-left-tabs">
        <img src="<?php echo mp_cf_PLAGIN_URL . '/public/assets/3 User.svg'?>" alt="ICO" />
        <span class="cf-left-tabs-title">My Community Request</span>
        <img src="<?php echo mp_cf_PLAGIN_URL . '/public/assets/notification-bing.svg'?>" alt="" />
        <span>(0)</span>
      </div>
      <div class="cf-left-tabs">
        <img src="<?php echo mp_cf_PLAGIN_URL . '/public/assets/money-recive.svg'?>" alt="ICO" />
        <span class="cf-left-tabs-title">Claim Payment</span>
      </div>
      <div class="cf-left-tabs">
        <img src="<?php echo mp_cf_PLAGIN_URL . '/public/assets/refresh.svg'?>" alt="ICO" />
        <span class="cf-left-tabs-title">History</span>
      </div>
    </div>
  </div>
  <!-- ---------------------------------- Right section ------------------------------------- -->
  <!-- <div class="cf-right-section">
    <div class="cf-right-top-section">
      <h1>Factory Dashboard</h1>
      <div class="cf-right-top-icon-container">
        <img src="< ?php echo mp_cf_PLAGIN_URL . '/public/assets/Setting.svg'?>" alt="" />
      </div>
    </div>
    <div class="cf-right-center-grid">
      <div class="cf-center-grid-card">
        <div class="cf-center-grid-card-top">
          <img
            class="cf-center-grid-card-img"
            src="< ?php echo mp_cf_PLAGIN_URL . '/public/assets/color-swatch.svg'?>"
            alt=""
          />
          <span class="cf-center-grid-card-heading">How it Works</span>
        </div>
        <img src="< ?php echo mp_cf_PLAGIN_URL . '/public/assets/Line 14.svg'?>" class="cf-line" alt="line" />
      </div>
      <div class="cf-center-grid-card">
        <div class="cf-center-grid-card-top">
          <img
            class="cf-center-grid-card-img"
            src="< ?php echo mp_cf_PLAGIN_URL . '/public/assets/personalcard.svg'?>"
            alt=""
          />
          <span class="cf-center-grid-card-heading">View Jobs</span>
        </div>
        <p class="cf-card-notification">Write an article and get Paid</p>
        <p class="cf-card-notification">
          Available jobs: <span>(70)</span>
        </p>
        <img src="< ?php echo mp_cf_PLAGIN_URL . '/public/assets/Line 14.svg'?>" class="cf-line" alt="line" />
      </div>

      <div class="cf-center-grid-card">
        <div class="cf-center-grid-card-top">
          <img
            class="cf-center-grid-card-img"
            src="< ?php echo mp_cf_PLAGIN_URL . '/public/assets/graph.svg'?>"
            alt=""
          />
          <span class="cf-center-grid-card-heading">Requests</span>
        </div>
        <img src="< ?php echo mp_cf_PLAGIN_URL . '/public/assets/Line 14.svg'?>" class="cf-line" alt="line" />
      </div>
      <div class="cf-center-grid-card">
        <div class="cf-center-grid-card-top">
          <img
            class="cf-center-grid-card-img"
            src="< ?php echo mp_cf_PLAGIN_URL . '/public/assets/chart-2.svg'?>"
            alt=""
          />
          <span class="cf-center-grid-card-heading">Vote</span>
        </div>
        <p class="cf-card-notification">Vote on articles</p>
        <img src="< ?php echo mp_cf_PLAGIN_URL . '/public/assets/Line 14.svg'?>" class="cf-line" alt="line" />
      </div>
    </div>
  </div> -->
  <!-- -----------------------------------Request content ----------------------------------- -->
  <div class="cf-right-section">
    <div class="cf-right-top-section">
      <h1>Request content</h1>
      <div class="cf-right-top-icon-container">
        <img src="<?php echo mp_cf_PLAGIN_URL . '/public/assets/Setting.svg'?>" alt="" />
      </div>
    </div>
    <div class="cf-request-center">
      
      <form>
        <div class="cf-form-input">
          <label for="title">Title</label>
          <input type="text" id="idTitle" placeholder="Title" />
        </div>
        

        <div class="cf-form-input">
          <label for="category">Category</label>
          <select name="cf-category" id="cfCategory">
            <option value="" selected disabled >Select Category</option>
            <?php
            foreach ($categories as $category){?>
              <option value="<?php echo $category->term_id?>" ><?php echo $category->name?></option>
            <?php }?>
          </select>
        </div>

        <div class="cf-form-input">
          <label for="minMpxr">Minimum MPXR value</label>
          <input
            type="number"
            id="minMpxr"
            placeholder="Minimum MPXR value to claim"
          />
        </div>

        <div class="cf-form-input">
          <label for="requestDeadline">Request Deadline</label>
          <input type="date" id="requestDeadline" />
        </div>

        <div class="cf-form-input">
          <label for="description">Description</label>
          <!-- <input type="text" id="description" placeholder="Title" /> -->
          <?php
            // default settings - Kv_front_editor.php
            $content = '';
            $editor_id = 'description';
            $settings =   array(
                'wpautop' => true, // use wpautop?
                'media_buttons' => true, // show insert/upload button(s)
                'textarea_name' => $editor_id, // set the textarea name to something different, square brackets [] can be used here
                'textarea_rows' => get_option('default_post_edit_rows', 10), // rows="..."
                'tabindex' => '',
                'editor_css' => '', //  extra styles for both visual and HTML editors buttons, 
                'editor_class' => '', // add extra class(es) to the editor textarea
                'teeny' => false, // output the minimal editor config used in Press This
                'dfw' => false, // replace the default fullscreen with DFW (supported on the front-end in WordPress 3.4)
                'tinymce' => true, // load TinyMCE, can be used to pass settings directly to TinyMCE using an array()
                'quicktags' => true // load Quicktags, can be used to pass settings directly to Quicktags using an array()
            );
            wp_editor($content, $editor_id, $settings);
          ?>
        </div>

        <div class="cf-form-input">
          <label for="submitionDeadline"
            >Submission Deadline After Claim</label>
          <input
            type="number"
            id="submitionDeadline"
            placeholder="Submission Deadline in Days"
          />
        </div>

        <div class="cf-form-input">
          <label for="mediaType">Media type</label>
          <div class="cf-request-mediaType-radio-container">
            <input type="radio" name="mediaType" id="text" value="text" checked="true"/>
            <label for="text">Text</label>
            <input type="radio" name="mediaType" id="audio" value="audio" />
            <label for="audio">Audio</label>
            <input type="radio" name="mediaType" id="video" value="video" />
            <label for="video">Video</label>
          </div>

          <!-- <input type="text" id="mediaType" placeholder="mediaType" /> -->
        </div>
        <div class="cf-form-input">
          <label for="requestType">Request type</label>
          <div class="cf-request-mediaType-radio-container">
            <input type="radio" name="requestType" id="free" value="free" checked="true"/>
            <label for="free">Free</label>
            <input type="radio" name="requestType" id="paid" value="paid" />
            <label for="paid">Paid</label>
          </div>
          <!-- <input type="text" id="requestType" placeholder="requestType" /> -->
        </div>
        <div class="cf-form-input">
          <label for="license">License</label>
          <select>
            <option value="" disabled selected>Choose license</option>
            <option value="mindplex">Mindplex</option>
            <option value="mit">MIT</option>
            <option value="GPL">GPL</option>
            <option value="LGPL">LGPL</option>
            <option value="MPL">Mozilla Public License 2.0.</option>
          </select>
        </div>
        <div class="cf-form-input">
          <label for="submissions">Submissions</label>
          <div class="cf-request-mediaType-radio-container">
            <input
              type="radio"
              name="submissions"
              id="singleSubmission"
              value="singleSubmission"
            />
            <label for="singleSubmission">Single submission</label>
            <input
              type="radio"
              name="submissions"
              id="multipleSubmission"
              value="multipleSubmission"
            />
            <label for="multipleSubmission">Multiple submission</label>
          </div>
        </div>
        <div class="cf-form-input">
          <label for="MPXRewardValue">MPX reward value</label>
          <input
            type="number"
            id="MPXRewardValue"
            placeholder="MPX reward value(MPX)"
          />
        </div>
        <div class="cf-form-input">
          <label for="guaranteeValue">Guarantee Value</label>
          <input type="number" id="guaranteeValue" placeholder="Guarantee value(MPX)" />
        </div>
        <button type="submit" class="cf-submit" id="cf-submit-request" >Submit</button>
      </form>
    </div>
  </div>
</div>
<script src="<?php echo mp_cf_PLAGIN_URL . 'public/js/validation.js'?>"></script>
<script>
  window.addEventListener("DOMContentLoaded", () => {
    var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
    cfTitle = document.querySelector('#idTitle')
    $(".cf-submit").click(async function(e) {
      e.preventDefault();
      var editor_content = tinyMCE.activeEditor.getContent({
          format: 'raw'
      });

      // loader('cf-submit-request',true,'')
      
      // if (!$("#cfCategory").val()) {
      //   showNotification('Please select category!', 'danger')
      //   loader('cf-submit-request',false,'Submit')
      // }

      // window.location.href+'#cfCategory';
      
      // jQuery.ajax({
      //   url: ajaxurl,
      //   type: 'POST',
      //   data: {
      //       action: 'mp_cf_submit_requested_content',
      //       topic: $("#idTitle").val(),
      //       category: $("#cfCategory").val(),
      //       minMpxr: $("#minMpxr").val(),
      //       req_deadline: $("#requestDeadline").val(),
      //       submission_deadline: $("#submitionDeadline").val(),
      //       desc: editor_content,
      //       media_type: $('input[name=mediaType]:checked').val(),
      //       // media_length: $("#id_media_length").val(),
      //       req_type: $('input[name=requestType]:checked').val(),
      //       // license: $("#id_license").val(),
      //       // backing_amount: $("#id_backing_amount").val(),
      //       submissions: $('input[name=submissions]:checked').val(), //$("#id_submissions").val(),
      //       // max_submissions: $('input[name=max_submissions]:checked').val(),
      //       MPXreward: $("#MPXRewardValue").val(),
      //       guarantee_amount: $("#guaranteeValue").val()
      //   },
      //   success: async function(response) {
      //     if(response == 'done'){
      //       showNotification("Request submitted successfully!")
      //     }
      //     else{
      //       console.log(response);
      //     }
      //   }
      // })
    })
  })
</script>