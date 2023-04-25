
<div class="cf-right-section">
  <div class="cf-right-top-section">
    <h1>Submit content</h1>
    <div class="cf-right-top-icon-container">
      <img src="<?php echo mp_cf_PLAGIN_URL . '/public/assets/Setting.svg'?>" alt="" />
    </div>
  </div>
  <div class="cf-request-center">
    <div class="form-container">     
      <form>
        <div class="cf-form-input">
          <label for="title">Title</label>
          <input type="text" id="idTitle" placeholder="Title"  value="<?php echo $requested_title?>" />
        </div>
        

        <div class="cf-form-input">
          <label for="category">Category</label>
          <select name="cf-category" id="cfCategory">
            <option value="<?php echo $requested_category->term_id?>" selected><?php echo $requested_category->name?></option>
            <?php
            foreach ($categories as $category){
              if($category->term_id === $requested_category->term_id) continue;?>
              <option value="<?php echo $category->term_id?>" ><?php echo $category->name?></option>
            <?php }?>
          </select>
        </div>

        <div class="cf-form-input">
          <label for="description">Description</label>
          <!-- <input type="text" id="description" placeholder="Title" /> -->
          <?php
            // default settings - Kv_front_editor.php
            $content = '';
            $editor_id = 'submit_form';
            $settings =   array(
                'wpautop' => true, // use wpautop?
                'media_buttons' => true, // show insert/upload button(s)
                'textarea_name' => $editor_id, // set the textarea name to something different, square brackets [] can be used here
                'textarea_rows' => get_option('default_post_edit_rows', 20), // rows="..."
                'tabindex' => '',
                'editor_css' => '', //  extra styles for both visual and HTML editors buttons, 
                'editor_class' => '', // add extra class(es) to the editor textarea
                'teeny' => false, // output the minimal editor config used in Press This
                'dfw' => false, // replace the default fullscreen with DFW (supported on the front-end in WordPress 3.4)
                'tinymce' => true, // load TinyMCE, can be used to pass settings directly to TinyMCE using an array()
                'quicktags' => true // load Quicktags, can be used to pass settings directly to Quicktags using an array()
            );
            // wp_editor($content, $editor_id, $settings);
            wp_editor($content, $editor_id, array());
          ?>
        </div>
        
        <button type="submit" class="cf-submit" id="cf-submit-request" >Submit</button>
      </form>
    </div>

    <div class="cf-submitted-center hidden">
      <h1 class="cf-submitted-center-heading">
        Your request was submitted
      </h1>
      <div class="cf-center-button-container">
      <a href="<?php echo home_url('mp_cf_plugin/active-jobs')?>">
        <button class="cf-center-button-primary">Submit more content</button>
      </a>

        <a href="<?php echo home_url('mp_cf_plugin/factory-dashboard')?>">
          <button class="cf-center-button-secondary">
            Back to Dashboard
          </button>
        </a>
      </div>
    </div>
  </div>

  
</div>
<script src="<?php echo mp_cf_PLAGIN_URL . 'public/js/validation.js'?>"></script>
<script>
  window.addEventListener("DOMContentLoaded", () => {
    var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
    
  })
</script>