
<div class="cf-request-center">
        
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
      <label for="maxSubmission2"><?php echo $guarantee_amount?> MPX</label>
    </div>
  </div>
  <?php }?>

    <button type="submit" class="cf-submit" id="cf-submit-request" >Claim</button>
  </form>
</div>


<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

<script type='module'>
  window.addEventListener("DOMContentLoaded", () => {
      const quill = new Quill('#bioEditor', {  
              modules: {
                  toolbar: '#cf-content'
              },
              theme: 'snow'
      });
    })
</script>