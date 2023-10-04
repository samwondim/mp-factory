<link rel="stylesheet" href="<?php echo mp_cf_PLAGIN_URL . 'public/css/mp-factory-active-jobs.css' ?>">

<div class="cf-right-top-section">
  <h1>Review requests detail</h1>
  <div class="cf-right-top-icon-container">
    <img src="<?php echo mp_cf_PLAGIN_URL . 'public/assets/Setting.svg' ?>" alt="" />
  </div>
</div>
<a href="<?php echo home_url('mp_cf_plugin/review-requests/?moderate=true') ?>">
  <button class="cf-request-content-back">
    <img src="<?php echo mp_cf_PLAGIN_URL . 'public/assets/back.svg' ?>" alt="" />
    “<?php echo $details->post_title ?>” request detail
  </button>
</a>
<div class="cf-request-center">
  <div class="form-container">
    <form>
      <div class="cf-form-input">
        <label for="title">Title</label>
        <input type="text" id="title" placeholder="Title" value="<?php echo $details->post_title ?>" />
      </div>

      <div class="cf-form-input">
        <label for="category">Category</label>
        <input type="text" placeholder="Category" value="<?php echo isset($category[0]->name) ? $category[0]->name : '' ?>" />
      </div>

      <div class="cf-form-input">
        <label for="minMpxr">Minimum MPXR value</label>
        <input type="number" placeholder="Minimum MPXR value to claim" value="<?php echo $min_mpxr ?>" />
      </div>
      <div class="cf-form-input">
        <label for="requestDeadline">Request Deadline</label>
        <input type="date" id="requestDeadline" value="<?php echo $req_deadline ?>" />
      </div>

      <div class="cf-form-input">
        <label for="description">Description</label>
        <div id="cf-my-content">
          <?php echo $details->post_content ?>
        </div>
      </div>

      <div class="cf-form-input">
        <label for="submitionDeadline">Submission Deadline After Claim</label>
        <input type="number" placeholder="Submission Deadline in Days" value="<?php echo $submission_deadline ?>" />
      </div>

      <div class="cf-form-input">
        <label for="mediaType">Media type</label>
        <div class="cf-request-mediaType-radio-container media-type-container" data-media-type="<?php echo $media_type ?>">
          <input type="radio" name="mediaType" checked="true" />
          <label for="text"><?php echo ucfirst($media_type) ?></label>
        </div>
      </div>

      <?php if ($media_type != 'text') { ?>
        <div class="cf-form-input cf-media-length">
          <label for="mediaLength">Media length</label>
          <input type="number" id="mediaLength" name="media_length" placeholder="Media length (min.)" value="<?php echo $media_length ?>" />
        </div>
      <?php } ?>

      <div class="cf-form-input">
        <label for="requestType">Request type</label>
        <div class="cf-request-mediaType-radio-container request-type-container" data-request-type="<?php echo $req_type ?>">
          <input type="radio" name="requestType" checked="true" />
          <label for="paid"><?php echo ucfirst($req_type) ?></label>
        </div>
      </div>

      <div class="cf-form-input ">
        <label for="Submissions">No. of claims</label>
        <input type="text" value="<?php echo $submissions ?> " />
      </div>

      <?php if ($req_type === 'paid') { ?>

        <div class="cf-form-input license hidden">
          <label for="license">License</label>
          <select name="cf-license">
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
          <input type="number" value="<?php echo $MPXreward ?>" />
        </div>

        <div class="cf-form-input">
          <label for="guaranteeValue">Guarantee Value</label>
          <input type="number" value="<?php echo $guarantee_amount ?>" />
        </div>

      <?php } else if (isset($backing_amount) && $backing_amount > 0) { ?>

        <div class="cf-form-input cf-tip-amount ">
          <label for="MPXRewardValue">Backing Amount</label>
          <input type="number" id="backingAmount" name="backing_amount" placeholder="Content backing amount" value="<?php echo $backing_amount ?>" />
        </div>
      <?php } ?>



    </form>
  </div>


  <div class="cf-submitted-center hidden">
    <h1 class="cf-submitted-center-heading">
      Article status updated.
    </h1>
    <div class="cf-center-button-container">
      <a href="<?php echo home_url('mp_cf_plugin/review-requests/?moderate=true') ?>">
        <button class="cf-center-button-primary">Review more</button>
      </a>

      <a href="<?php echo home_url('mp_cf_plugin/factory-dashboard/?moderate=true') ?>">
        <button class="cf-center-button-secondary">
          Back to Dashboard
        </button>
      </a>
    </div>
  </div>

</div>


<div class="cf-requested-bottom-container status-update" data-post-id="<?php echo $details->ID ?>">
  <table style="padding: 23px">
    <thead>
      <tr>
        <th>Requestor</th>
        <th>Comment</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td class="cf-user-status" >
          
          <span style="display: flex;">
            <?php $avatar_url = get_avatar_url($details->post_author, array("size" => 20)); ?>
            <img src="<?php echo $avatar_url?>" style="width: 30px;" alt="authorprofile" />
            <a href="<?php echo home_url('user/'.$user_url)?>" style="padding-inline: 10px;"><?php echo $display_name?></a>
          </span>
          <span style="padding-block: 10px; font-weight: 700;">Status</span>
          <span>
            <select class="cf-textarea cf-punish" name="" id="status" style="width: fit-content !important;">
              <option value="" selected disabled>Select Status</option>
              <option value="hate_speech">Hate speech</option>
              <option value="bullying">Bullying</option>
              <option value="spamming">Spamming</option>
              <option value="profanity">Profanity</option>
              <option value="legally_unacceptable">Legally unacceptable</option>
            </select>
          </span>
      </td>
        <td>
          <textarea class="cf-textarea" name="" id="moderatorComment" cols="30" rows="10" data-post-id="<?php echo $details->ID ?>"></textarea>
        </td>
      </tr>
      <tr>
        <td></td>
        <td style="
                    display: flex;
                    justify-content: center;
                    width: 100%;
                    gap: 10px;
                  ">
          <input type="button" class="cf-request-bottom-button-primary" data-status="approved" value="Approve" />
          <input type="button" class="cf-request-bottom-button-secondary" data-status="declined" value="Decline" />
        </td>
      </tr>
    </tbody>
  </table>
</div>