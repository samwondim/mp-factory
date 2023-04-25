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
    
    <div class="cf-form-input media-type ">
      <label for="mediaType">Media type</label>
      <div class="cf-request-mediaType-radio-container">
        <input type="radio" name="mediaType" id="text" value="text" checked="true"/>
        <label for="text">Text</label>
        <input type="radio" name="mediaType" id="audio" value="audio" />
        <label for="audio">Audio</label>
        <input type="radio" name="mediaType" id="video" value="video" />
        <label for="video">Video</label>
      </div>
    </div>

    <div class="cf-form-input cf-media-length hidden">
      <label for="mediaLength">Media length</label>
      <input type="number" id="mediaLength" name="media_length" placeholder="Media length (min.)"/>
    </div>

    <!-- on free request -->
    <div class="cf-form-input">
      <label for="requestType">Request type</label>
      <div class="cf-request-mediaType-radio-container">
        <input type="radio" name="requestType" id="free" value="free" checked="checked"/>
        <label for="free">Free</label>
        <input type="radio" name="requestType" id="paid" value="paid" />
        <label for="paid">Paid</label>
      </div>
      <!-- <input type="text" id="requestType" placeholder="requestType" /> -->
    </div>
    
    <div class="cf-form-input cf-tip-amount ">
      <label for="MPXRewardValue">Tip Amount</label>
      <input type="number" id="backingAmount" name="backing_amount" placeholder="Content backing amount"/>
    </div>
    
    <div class="cf-form-input license hidden">
      <label for="license">License</label>
      <select name="cf-license" id="cfLicense">
        <option value="" disabled selected>Choose license</option>
        <option value="mindplex">Mindplex</option>
        <option value="mit">MIT</option>
        <option value="GPL">GPL</option>
        <option value="LGPL">LGPL</option>
        <option value="MPL">Mozilla Public License 2.0.</option>
      </select>
    </div>

    <div class="cf-form-input cf-submissions hidden">
      <label for="submissions">Submissions</label>
      <div class="cf-request-mediaType-radio-container">
        <input type="radio" name="submissions" id="singleSubmission" value="singleSubmission"/>
        <label for="singleSubmission">Single submission</label>
        <input type="radio" name="submissions" id="multipleSubmission"  value="multipleSubmission"/>
        <label for="multipleSubmission">Multiple submission</label>
      </div>
    </div>

    <div class="cf-form-input cf-max-submissions hidden">
      <label for="max-submissions"> Maximum submissions</label>
      <div class="cf-request-mediaType-radio-container">
        <input type="radio" class="hidden" name="max-submissions" id="maxSubmission1" value="1" checked="true"/>

        <input type="radio" name="max-submissions" id="maxSubmission2" value="2"/>
        <label for="maxSubmission2">2 claims</label>
        <input type="radio" name="max-submissions" id="maxSubmission3" value="3"/>
        <label for="maxSubmission3">3 claims</label>
        <input type="radio" name="max-submissions" id="maxSubmission4" value="4"/>
        <label for="maxSubmission4">4 claims</label>
        <input type="radio" name="max-submissions" id="maxSubmission5" value="5"/>
        <label for="maxSubmission5">5 claims</label>
      </div>
    </div>

    <div class="cf-form-input cf-MPX-reward-value hidden">
      <label for="MPXRewardValue">MPX reward value</label>
      <input
        type="number"
        id="MPXRewardValue"
        placeholder="MPX reward value(MPX)"
      />
    </div>

    <div class="cf-form-input cf-guarantee-value hidden">
      <label for="guaranteeValue">Guarantee Value (%)</label>
      <input type="number" id="guaranteeValue" placeholder="<?php echo $guarantee_value."%"?>" guarantee="<?php echo $guarantee_value?>" />
    </div>
    
    <button type="submit" class="cf-submit" id="cf-submit-request" >Submit</button>
  </form>
</div>

<script src="<?php echo mp_cf_PLAGIN_URL . 'public/js/validation.js'?>"></script>
<script>
  window.addEventListener("DOMContentLoaded", () => {
    var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
    cfTitle = document.querySelector('#idTitle')
    mpxReward = document.querySelector('#MPXRewardValue')
    guaranteeValue = document.querySelector('#guaranteeValue')
    guaranteeAmount = parseInt(guaranteeValue.getAttribute("guarantee"))/100

    // show/hide on free and paid radio buttons
    jQuery("input[name='requestType']").click(function() {
        if(jQuery(this).val() == 'paid'){
          jQuery('.license').removeClass('hidden')
          jQuery('.cf-submissions').removeClass('hidden')
          jQuery('.cf-MPX-reward-value').removeClass('hidden')
          jQuery('.cf-guarantee-value').removeClass('hidden')

          jQuery('.cf-tip-amount').addClass('hidden')
        }
        else if(jQuery(this).val() == 'free'){
          jQuery('.license').addClass('hidden')
          jQuery('.cf-submissions').addClass('hidden')
          jQuery('.cf-MPX-reward-value').addClass('hidden')
          jQuery('.cf-guarantee-value').addClass('hidden')

          jQuery('.cf-tip-amount').removeClass('hidden')
        }

    })

    jQuery("input[name='mediaType']").click(function() {

        if(jQuery(this).val() !== 'text'){
          jQuery('.cf-media-length').removeClass('hidden')
        }
        else {
          jQuery('.cf-media-length').addClass('hidden')
        }

    })
    
    jQuery("input[name='submissions']").click(function() {
      if(jQuery(this).val() == 'multipleSubmission'){
        jQuery('.cf-max-submissions').removeClass('hidden')
      }
      else{
        jQuery('.cf-max-submissions').addClass('hidden')
      }
    })

    mpxReward.addEventListener("keyup", () => {
      guaranteeValue.value = mpxReward.value * guaranteeAmount
    })


    $(".cf-submit").click(async function(e) {
      e.preventDefault();
      var editor_content = tinyMCE.activeEditor.getContent({
          format: 'raw'
      });

      loader('cf-submit-request',true,'')
      
      // if (!$("#cfCategory").val()) {
      //   // showNotification('Please select category!', 'danger')
      //   // loader('cf-submit-request',false,'Submit')
      // }


      var submitRequest = new FormData();
      submitRequest.append('action', 'mp_cf_submit_requested_content');
      submitRequest.append('topic', $("#idTitle").val());
      submitRequest.append('cfCategory',  $("#cfCategory").val());
      submitRequest.append('minMpxr', $("#minMpxr").val());
      submitRequest.append('req_deadline', $("#requestDeadline").val());
      submitRequest.append('submission_deadline',  $("#submitionDeadline").val());
      submitRequest.append('desc', editor_content);
      submitRequest.append('media_type', $('input[name=mediaType]:checked').val());
      submitRequest.append('req_type', $('input[name=requestType]:checked').val());
      
      if($('input[name=mediaType]:checked').val() != 'text')
        submitRequest.append('media_length', $("#mediaLength").val());

      if($('input[name=requestType]:checked').val() == 'paid'){
        submitRequest.append('license',$("#cfLicense").val());

        if($('input[name=submissions]:checked').val() == 'multipleSubmission'){

          submitRequest.append('submissions',  $('input[name=max-submissions]:checked').val());
        }
        else
          submitRequest.append('submissions',  '1');

        submitRequest.append('MPXreward',  $("#MPXRewardValue").val());
        submitRequest.append('guarantee_amount', $("#guaranteeValue").val());
      }
      else {
        submitRequest.append('backing_amount',$("#backingAmount").val());
      }

      jQuery.ajax({
        url: ajaxurl,
        type: 'POST',
        contentType: false,
        processData: false,
        data: submitRequest,
        success: async function(response) {
          if(response == 'done'){
            loader('cf-submit-request',false,'Submit')
            // showNotification("Request submitted successfully!")
          }
          else{
            console.log(response);
          }
        }
      })
    })
  })
</script>