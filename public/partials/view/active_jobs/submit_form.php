
<div class="cf-right-section">
  <div class="cf-right-top-section">
    <h1>Submit your content</h1>
    <div class="cf-right-top-icon-container">
      <img src="<?php echo mp_cf_PLAGIN_URL . 'public/assets/Setting.svg'?>" alt="" />
    </div>
  </div>
  <a href="<?php echo home_url('mp_cf_plugin/active-jobs')?>">
  <button class="cf-request-content-back">
    <img src="<?php echo mp_cf_PLAGIN_URL . 'public/assets/back.svg'?>" alt="" />
    Active jobs
  </button>
  </a>

  <div class="cf-request-center">
    <div class="form-container">     
      <form>
        <div class="cf-form-input">
          <label for="title">Title</label>
          <input type="text" id="contentTitle" placeholder="Title"  value="<?php echo $requested_title?>" />
        </div>
        

        <div class="cf-form-input">
          <label for="category">Category</label>
          <select name="cf-category" id="submitCategory">
            <option value="<?php echo $requested_category->term_id?>" selected><?php echo $requested_category->name?></option>
            <?php
            foreach ($categories as $category){
              if($category->term_id === $requested_category->term_id) continue;?>
              <option value="<?php echo $category->term_id?>" ><?php echo $category->name?></option>
            <?php }?>
          </select>
        </div>

        <div class="cf-form-input">
          <label for="content">Content</label>
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

        <div class="cf-form-input">
          <label for="teaser">Teaser/Deck </label>
          <div class="">
            <div id="cf-teaser-container" class="cf-toolbar-container">
                <button class="ql-bold"></button>
                <button class="ql-italic"></button>
                <button class="ql-underline"></button>
                <button class="ql-link"></button>
                <!-- <button id="custom-button" class="custom-button">
                    &#x1F642;
                </button> -->
            </div>
            <div id="cfTeaserContent"></div>
          </div>
        </div>

        <div class="cf-form-input">
          <label for="bio">Your Brief Bio </label>
          <div class="">
            <div id="cf-EditorBio-container" class="cf-toolbar-container">
                <button class="ql-bold"></button>
                <button class="ql-italic"></button>
                <button class="ql-underline"></button>
                <button class="ql-link"></button>
                <!-- <button id="custom-button" class="custom-button">
                    &#x1F642;
                </button> -->
            </div>
            <div id="cfEditorBioContent"></div>
          </div>
        </div>

        <div class="cf-form-input">
          <label for="featured">Featured image </label>
          <input type="file" class="filepond" name="filepond" id="featured-image" style="display:none" accept="image/png,image/jpg,image/jpeg,video/mp4,image/gif,video/MOV,video/WMV,video/WEBM" data-max-file-size="5MB">
          <div class="form-submit">
              <div class="wall-upload-multi">
                  <div for="featured-image" class="img-container">
                  </div>
                  <div class="video-container">
                  </div>
              </div>
          </div>
        </div>

        <div class="cf-form-input">
          <label for="thumbnail">Thumbnail image </label>
          <input type="file" class="filepond" name="filepond" id="thumbnail-image" style="display:none" accept="image/png,image/jpg,image/jpeg,video/mp4,image/gif,video/MOV,video/WMV,video/WEBM" data-max-file-size="5MB">
          <div class="form-submit">
              <div class="wall-upload-multi">
                  <div for="thumbnail-image" class="img-container">
                  </div>
                  <div class="video-container">
                  </div>
              </div>
          </div>
        </div>
        
          
        <button id ="submitContent" postID="<?php echo $post->ID?>" userId="<?php echo get_current_user_id()?>" type="submit" class="cf-submit cf-submit-content" >Submit</button>
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
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

<script src="<?php echo mp_up_PLAGIN_URL . 'public/js/imageCompress.js' ?>"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/compressorjs/1.1.1/compressor.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/filepond/dist/filepond.min.css" />
<link rel="stylesheet" href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css" />
<link href="https://unpkg.com/filepond-plugin-image-edit/dist/filepond-plugin-image-edit.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/filepond-plugin-media-preview@1.0.11/dist/filepond-plugin-media-preview.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fluent-ffmpeg@2.1.2"></script>
<script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-edit/dist/filepond-plugin-image-edit.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-encode/dist/filepond-plugin-file-encode.min.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.min.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-exif-orientation/dist/filepond-plugin-image-exif-orientation.min.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/filepond-plugin-media-preview@1.0.11/dist/filepond-plugin-media-preview.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/filepond-plugin-file-validate-type@1.2.8/dist/filepond-plugin-file-validate-type.min.js"></script>

<script src="<?php echo mp_cf_PLAGIN_URL . 'public/js/validation.js'?>"></script>
<script src="<?php echo mp_cf_PLAGIN_URL . 'public/js/notification.js'?>"></script>
<script>
  window.addEventListener("DOMContentLoaded", () => {
    var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
    const submitBtn = document.querySelector('.cf-submit-content')
    const formContainer = document.querySelector('.form-container')
    const submittedCenter = document.querySelector('.cf-submitted-center')
    const contentTitle = document.getElementById('contentTitle')
    const submitCategory = document.getElementById('submitCategory')

    const cfTeaser = new Quill('#cfTeaserContent', {  
      modules: {
          toolbar: '#cf-teaser-container'
      },
      theme: 'snow'
    });

    const cfEditorBio = new Quill('#cfEditorBioContent', {  
      modules: {
          toolbar: '#cf-EditorBio-container'
      },
      theme: 'snow'
    });

    const regex = /(<([^>]+)>)/ig
    const stripContent = data => data.replaceAll(regex, " ").trim().split(/[\s]+/)
    // const max = 140;
    // const maxWordCount = parseInt(`< ?php echo get_option('mp_cf_max_word_count', true)?>`);
    const maxWordCount = 3;
    let deletingText = false;
    cfTeaser.on('text-change',function(){
       if (deletingText) {
          return; // Skip the event if text deletion is already in progress
      }
      // const text = cfTeaser.getText();
      // const teaserLength = text.trim().split(/\s+/);

      if (cfTeaser.getLength() > maxWordCount) {
        deletingText = true;
            const excessText = cfTeaser.getText(maxWordCount, cfTeaser.getLength());
            cfTeaser.deleteText(maxWordCount, cfTeaser.getLength());
            
            showNotificationCf(`Sorry, the maximum number of words is ${maxWordCount}.`, 'danger')
            deletingText = false;
      }
    })
    cfEditorBio.on('text-change',function(){
       if (deletingText) {
          return; // Skip the event if text deletion is already in progress
      }
      const text = cfTeaser.getText();
      const bioLength = text.trim().split(/\s+/);

      if (cfEditorBio.getLength() > maxWordCount) {
        deletingText = true;
            const excessText = cfEditorBio.getText(maxWordCount, cfEditorBio.getLength());
            cfEditorBio.deleteText(maxWordCount, cfEditorBio.getLength());
            showNotificationCf(`Sorry, the maximum number of words is ${maxWordCount}.`, 'danger')
            deletingText = false;
      }
    })

    
    FilePond.registerPlugin(
      FilePondPluginImagePreview,
      FilePondPluginImageExifOrientation,
      FilePondPluginFileValidateSize,
      FilePondPluginImageEdit,
      FilePondPluginMediaPreview, FilePondPluginFileValidateType
    );

    const pondFeatue = FilePond.create(
      document.querySelector("#featured-image"), {
        labelIdle: `<img src="<?php echo mp_cf_PLAGIN_URL . 'public/assets/Img.svg' ?>" alt="">`,
      }
    );
    const pondThumbnail = FilePond.create(
      document.querySelector("#thumbnail-image"), {
        labelIdle: `<img src="<?php echo mp_cf_PLAGIN_URL . 'public/assets/Img.svg' ?>" alt="">`,
      }
    );


    submitBtn.addEventListener('click', function(e){
      e.preventDefault();
      
      // loader('submitContent',true,'Submit')

      var submit_content = tinyMCE.activeEditor.getContent({
          format: 'raw'
      });

      // getting image files
      const feature = pondFeatue.getFiles();
      const featureImage = feature.length ? feature[0].file : null

      const thumbnail = pondThumbnail.getFiles();
      const thumbnailImage = thumbnail.length ? thumbnail[0].file : null

      if (featureImage && !featureImage?.type?.includes("video") && !featureImage?.type?.includes("image/gif")) {
          compressImage(featureImage).then(res => {
          })
      }

      jQuery.ajax({
        url: ajaxurl,
        type: 'POST',
        contentType: false,
        processData: false,
        data: {
          action: 'mp_cf_submit_content'
          postId: submitBtn.getAttribute('postId')
          userId: submitBtn.getAttribute('userId')
          submitTitle: contentTitle.value
          contentCategory: submitCategory.value
          submit_content: submit_content
          contentTeaser: cfTeaser.root.innerHTML
          contentBio: cfEditorBio.root.innerHTML
          featureImage: featureImage
          thumbnailImage: thumbnailImage
        },
        success: async function(response) {
          console.log(response);
          loader('submitContent',false,'Submit')
          formContainer.classList.add('hidden')
          submittedCenter.classList.remove('hidden')
        },
        error: function(response) {
          loader('submitContent',false,'Submit')
        }
      })

    })

  })
</script>