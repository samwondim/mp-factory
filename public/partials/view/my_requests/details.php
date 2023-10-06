<link rel="stylesheet" href="<?php echo mp_cf_PLAGIN_URL . 'public/css/mp-factory-active-jobs.css'?>">

  <div class="cf-right-top-section">
    <h1>My requests</h1>
    <div class="cf-right-top-icon-container">
      <img src="<?php echo mp_cf_PLAGIN_URL . 'public/assets/Setting.svg'?>" alt="" />
    </div>
  </div>
  <a href="<?php echo home_url('mp_cf_plugin/my-requests')?>">
  <button class="cf-request-content-back">
    <img src="<?php echo mp_cf_PLAGIN_URL . 'public/assets/back.svg'?>" alt="" />
    “<?php echo $details->post_title?>” request detail
  </button>
  </a>
  <div class="cf-request-center">
    <form>
      <div class="cf-form-input">
        <label for="title">Title</label>
        <input type="text" id="title" placeholder="Title" value="<?php echo $details->post_title?>"/>
      </div>

      <div class="cf-form-input">
        <label for="category">Category</label>
        <input type="text"  placeholder="Category" value="<?php echo count($category) == 0 ? 'Uncategorized' : $category[0]->name?>"/>
      </div>
     
      <div class="cf-form-input">
        <label for="minMpxr">Minimum MPXR value</label>
        <input
          type="number" placeholder="Minimum MPXR value to claim"
          value="<?php echo $min_mpxr?>"
        />
      </div>
      <div class="cf-form-input">
        <label for="requestDeadline">Request Deadline</label>
        <input type="date" id="requestDeadline" value="<?php echo $req_deadline?>"/>
      </div>
      
      <div class="cf-form-input">
        <label for="description">Description</label>
        <div id="cf-my-content">
          <?php echo $details->post_content?>
        </div>
      </div> 

      <div class="cf-form-input">
        <label for="submitionDeadline"
          >Submission Deadline After Claim</label
        >
        <input
          type="number"
          placeholder="Submission Deadline in Days"
          value="<?php echo $submission_deadline?>"
        />
      </div>

      <div class="cf-form-input">
        <label for="mediaType">Media type</label>
        <div class="cf-request-mediaType-radio-container media-type-container" data-media-type="<?php echo $media_type?>">
          <input type="radio" name="mediaType" id="text" value="text" />
          <label for="text">Text</label>
          <input type="radio" name="mediaType" id="audio" value="audio" />
          <label for="audio">Audio</label>
          <input type="radio" name="mediaType" id="video" value="video" />
          <label for="video">Video</label>
        </div>
      </div>
      
      <?php if($media_type != 'text'){?>
      <div class="cf-form-input cf-media-length">
        <label for="mediaLength">Media length</label>
        <input type="number" id="mediaLength" name="media_length" placeholder="Media length (min.)" value="<?php echo $media_length?>"/>
      </div>
      <?php }?>

      <div class="cf-form-input">
        <label for="requestType">Request type</label>
        <div class="cf-request-mediaType-radio-container request-type-container" data-request-type="<?php echo $req_type?>">
          <input type="radio" name="requestType" id="paid" value="paid" />
          <label for="paid">Paid</label>
          <input type="radio" name="requestType" id="free" value="free" />
          <label for="free">Free</label>
        </div>
      </div>

      <div class="cf-form-input ">
        <label for="Submissions">No. of claims</label>
        <input type="text" value="<?php echo $submissions?> "/>
      </div>

      <?php if($req_type === 'paid'){?>

      <div class="cf-form-input license hidden">
        <label for="license">License</label>
        <select name="cf-license" >
          <option value="" disabled selected>Choose license</option>
          <option value="mindplex">Mindplex</option>
          <option value="mit">MIT</option>
          <option value="GPL">GPL</option>
          <option value="LGPL">LGPL</option>
          <option value="MPL">Mozilla Public License 2.0.</option>
        </select>
      </div>

      <div class="cf-form-input">
        <label for="MPXRewardValue">MPX reward value</label>
        <input
          type="number"
          value="<?php echo $MPXreward?>"
        />
      </div>

      <div class="cf-form-input">
        <label for="guaranteeValue">Guarantee Value</label>
        <input type="number" value="<?php echo $guarantee_amount?>" />
      </div>

      <?php } else if(isset($backing_amount) && $backing_amount > 0) {?>

      <div class="cf-form-input cf-tip-amount ">
        <label for="MPXRewardValue">Backing Amount</label>
        <input type="number" id="backingAmount" name="backing_amount" placeholder="Content backing amount" value="<?php echo $backing_amount?>"/>
      </div>
      <?php }?>


      
      
    </form>
    
  </div>
  
  <?php if(!empty($moderator_comment) && get_post_status($details->ID) !== 'pending'){?>
  <div class="cf-request-center" style="margin-top: 23px;">
    <div class="cf-form-input">
    
      <p><?php echo $moderator_comment?></p>
      </div>
  </div>
  <?php }?>

  
  <div class="cf-requested-bottom-container">
        <table>
          <thead>
            <tr>
              <th>Claimer name</th>
              <th>Public_address</th>
              <th>Claimed Time</th>
              <th>Status</th>
              <th>Rank</th>
            </tr>
          </thead>
          <tbody>
            <?php 

            foreach($all_claimers as $claimer){
              $claimer_data = get_post_meta($details->ID, 'mp_cf_claim_data_'.$claimer,true);
              $claimer_fname = get_user_meta($claimer, 'first_name', true);
              $claimer_lname = get_user_meta($claimer, 'last_name', true);
              $claimer_username = get_user_by('id',$claimer)?get_user_by('id',$claimer)->user_login:null;
              
              if(!empty($claimer_data)){
                if($claimer_data['claim_status'] === 'waiting_content'){
                  $status = "Waiting for claimer to submit a content."; 
                } 
                else if($claimer_data['claim_status'] === 'submitted'){
                  $status = "Waiting for moderator approval."; 
                }else if($claimer_data['claim_status'] === 'moderator_approved'){
                  $status = "moderate"; 
                }else $status = 'Active';

              }else $status = 'Active'
              ?>
            <tr>
              <td data-label="claimer_name">
                <a target="_blanck" href="<?php echo home_url('/user/') . $claimer_username; ?>">
                  <?php echo !empty($claimer_fname) ? $claimer_fname. ' '. $claimer_lname: $claimer_username?>
                </a>
              </td>
              <td data-label="public-0address">user public address</td>
              <td data-label="claimed-time"><?php echo $claimer == $claimer_data['user_id'] ? $claimer_data['request_time']:''?></td>
              <td data-label="Status">
                <?php 
                if ($status !== 'moderate') echo $status;
                else {?>
                  <a href="<?php echo home_url('mp_cf_plugin/my-requests/?moderate_submission=').$claimer_data['post_id']?>">
                    <button class="cf-request-bottom-button-primary" >Moderate</button>
                  </a>
                <?php }?>
              </td>
              <td data-label="Status">Not yet</td>
            </tr>

            <?php }?>

          </tbody>
        </table>
      </div>


<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">


<script type='module'>
  window.addEventListener("DOMContentLoaded", () => {

    const quill = new Quill('#cf-my-content', { 
        theme: 'snow'
    });
})
</script>

<script>
    const mediaTypeEl = document.querySelector('.media-type-container') 
    SELECTED_MEDIA_TYPE = mediaTypeEl.getAttribute('data-media-type')
    const selectedMediaRadio = document.querySelector(`input[name="mediaType"][value="${SELECTED_MEDIA_TYPE}"]`);

    const requestTypeEl = document.querySelector('.request-type-container') 
    SELECTED_REQUEST_TYPE = requestTypeEl.getAttribute('data-request-type')
    const selectedRequestRadio = document.querySelector(`input[name="requestType"][value="${SELECTED_REQUEST_TYPE}"]`);

    if (selectedMediaRadio) {
      selectedMediaRadio.checked = true;
    }
    if (selectedRequestRadio) {
      selectedRequestRadio.checked = true;
    }
   
</script>