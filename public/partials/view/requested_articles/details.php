<div class="cf-right-section">
  <div class="cf-right-top-section">
    <h1>View all jobs</h1>
    <div class="cf-right-top-icon-container">
      <img src="<?php echo mp_cf_PLAGIN_URL . 'public/assets/Setting.svg'?>" alt="" />
    </div>
  </div>
  <button class="cf-request-content-back">
    <img src="<?php echo mp_cf_PLAGIN_URL . 'public/assets/back.svg'?>" alt="" />
    Back
  </button>
  <div class="cf-request-center">
    <div class="view-jobs-container">     
      <form>
        <div class="cf-form-input">
          <label for="title">Title</label>
          <input type="text" placeholder="Title" value="<?php echo $details->post_title?>" />
        </div>
        

        <div class="cf-form-input">
          <label for="category">Category</label>
          <input type="text"  value="<?php echo isset($category[0])? $category[0]->name:''?>" />
        </div>

        <div class="cf-form-input">
          <label for="minMpxr">Minimum MPXR value</label>
          <input type="text"  value="<?php echo isset($min_mpxr)? $min_mpxr:''?>" />

        </div>

        <div class="cf-form-input">
          <label for="requestDeadline">Request Deadline</label>
          <input type="date" value="<?php echo isset($req_deadline)? $req_deadline:''?>"/>
        </div>

        <div class="cf-form-input">
          <label for="description">Description</label>
          <div id="cf-content"><?php echo $details->post_content?></div>
        
        </div>

        <div class="cf-form-input">
          <label for="submitionDeadline"
            >Submission Deadline After Claim</label>
          <input
            type="text"
            value="<?php echo isset($submission_deadline)? $submission_deadline:''?>"
          />
        </div>
        
        <div class="cf-form-input media-type ">
          <label for="mediaType">Media type</label>
          <div class="cf-request-mediaType-radio-container">
            <label for="text"><?php echo isset($media_type)? ucwords($media_type):''?></label>
          </div>
        </div>

        <?php if(isset($media_length) && $media_length !== ''){?> 
          <div class="cf-form-input cf-media-length">
            <label for="mediaLength">Media length</label>
            <input type="text" value="<?php echo $media_length ?>"/>
          </div>
        <?php } ?>

        <div class="cf-form-input">
          <label for="requestType">Request type</label>
          <div class="cf-request-mediaType-radio-container">
            <label for="free"><?php echo isset($req_type)? ucwords($req_type):''?></label>
          </div>
        </div>
        
        <?php if(isset($backing_amount) && $backing_amount !== ''){?> 
        <div class="cf-form-input cf-tip-amount ">
          <label for="MPXRewardValue">Tip Amount</label>
          <input type="text" value="<?php echo isset($backing_amount)? $backing_amount:''?>"/>
        </div>
        <?php }?>

        <?php if(isset($license) && $license !== ''){?> 
          <div class="cf-form-input cf-max-submissions">
          <label for="submissions">License</label>
          <div class="cf-request-mediaType-radio-container">
            <label for="maxSubmission2"><?php echo $license?></label>
          </div>
        </div>
        <?php }?>

        <?php if(isset($submissions) && $submissions !== ''){?> 
          
        <div class="cf-form-input cf-max-submissions">
          <label for="submissions">Submissions</label>
          <div class="cf-request-mediaType-radio-container">
            <label for="maxSubmission2"><?php echo $submissions?> claims</label>
          </div>
        </div>
        <?php }?>

        <?php if(isset($MPXreward) && $MPXreward !== ''){?> 
        
          <div class="cf-form-input cf-max-submissions">
          <label for="submissions">MPX reward value</label>
          <div class="cf-request-mediaType-radio-container">
            <label for="maxSubmission2"><?php echo $MPXreward?> MPX</label>
          </div>
        </div>
        <?php }?>

        <?php if(isset($guarantee_amount) && $guarantee_amount !== ''){?> 
        
        <div class="cf-form-input cf-max-submissions">
        <label for="submissions">Guarantee Value (%)</label>
        <div class="cf-request-mediaType-radio-container">
          <label for="maxSubmission2"><?php echo $guarantee_amount?></label>
        </div>
      </div>
        <?php }?>
        
        <?php if(get_post_meta($details->ID, 'req_type',true) == 'paid'){ ?>
          <button type="submit" userId="<?php echo get_current_user_id()?>" postId="<?php echo $details->ID?>" class="cf-submit cf-claim" id="cf-claim-request">Claim</button>
        <?php }?>

      </form>
      
    </div>

    <div class="cf-submitted-center hidden">
        <h1 class="cf-submitted-center-heading">
          Your request was submitted
        </h1>
        <div class="cf-center-button-container">
        <a href="<?php echo home_url('mp_cf_plugin/view-all-jobs')?>">
          <button class="cf-center-button-primary">Claim More</button>
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

<script type='module'>
  window.addEventListener("DOMContentLoaded", () => {
    var ajaxurl = "< ?php echo admin_url('admin-ajax.php'); ?>";

    const quill = new Quill('#cf-content', {  
            theme: 'snow'
    });
     
  })
</script>

<script>
  const claimBtn = document.querySelector('.cf-claim')
  const backBtn = document.querySelector('.cf-request-content-back')
  
if(claimBtn){
  claimBtn.addEventListener("click",function(e){
    e.preventDefault()
    loader('cf-claim-request',true,' Loading...')

    jQuery.ajax({
      url: ajaxurl,
      type: 'POST',
      data: {
        action: 'mp_cf_claim_article',
        postId: claimBtn.getAttribute('postId'),
        userId: claimBtn.getAttribute('userId')
      },
      success: async function(response) {
        if(!response){
        loader('cf-claim-request',false,'Claim')
        document.querySelector('.view-jobs-container').classList.add('hidden')
        document.querySelector('.cf-submitted-center').classList.remove('hidden')

        const activeJobsSpan = document.querySelector('.cf-active-jobs-notif')
        const currentValue = parseInt(activeJobsSpan.innerHTML.match(/\d+/)[0]);
        
        activeJobsSpan.innerHTML = `(${currentValue + 1})`;
        }
        else{
        loader('cf-claim-request',false,'Claim')

        }

      }
    })
  })
}

  backBtn.addEventListener("click",function(){
    location.reload()
  })
</script>