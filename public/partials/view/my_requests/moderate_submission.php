<link rel="stylesheet" href="<?php echo mp_cf_PLAGIN_URL . 'public/css/mp-factory-active-jobs.css'?>">

<div class="cf-right-section">
  <div class="cf-right-top-section">
    <h1>Review submitted content for your article </h1>
    <div class="cf-right-top-icon-container">
      <img src="<?php echo mp_cf_PLAGIN_URL . 'public/assets/Setting.svg'?>" alt="" />
    </div>
  </div>
  <a href="<?php echo home_url('mp_cf_plugin/my-requests')?>">
  <button class="cf-request-content-back">
    <img src="<?php echo mp_cf_PLAGIN_URL . 'public/assets/back.svg'?>" alt="" />
    My requests
  </button>
  </a>

  <div class="cf-request-center">
    <div class="form-container">     
      <form>
        <div class="cf-form-input">
          <label for="title">Title</label>
          <input type="text" id="title" placeholder="Title" value="<?php echo $post->post_title?>"/>
        </div>

        <div class="cf-form-input">
          <label for="category">Category</label>
          <input type="text"  placeholder="Title" value="<?php echo $category[0]->name?>"/>
        </div>

        <div class="cf-form-input">
          <label for="description">Description</label>
          <div id="cf-my-content">
            <?php echo $post->post_content?>
          </div>
        </div> 

      </form>
    </div>

    <div class="cf-submitted-center hidden">
      <h1 class="cf-submitted-center-heading">
        Your request was submitted
      </h1>
      <div class="cf-center-button-container">
      <a href="<?php echo home_url('mp_cf_plugin/my-requests')?>">
        <button class="cf-center-button-primary">Review more submissions</button>
      </a>

        <a href="<?php echo home_url('mp_cf_plugin/factory-dashboard')?>">
          <button class="cf-center-button-secondary">
            Back to Dashboard
          </button>
        </a>
      </div>
    </div>
  </div>

  <div class="cf-requested-bottom-container requester-update-status" data-post-id="<?php echo $post_id?>">
    <table>
      <thead>
        <tr>
          <th>Content creator</th>
          <th>Comment</th>
        </tr>
      </thead>
      <tbody>
        
        <tr>
          <td><?php echo get_user_meta( $post->post_author, 'first_name', true )?></td> 
          <td><textarea name="" id="requesterSubmitComment" cols="30" rows="10" data-user-id="<?php echo $post->post_author?>"  data-requested-post-id="<?php echo $requested_post_id?>"></textarea></td>
        </tr>
        <tr>
          <td>
            <input type="button" class="cf-request-bottom-button-primary" data-status="approved" value="Approve"/>
            <input type="button" class="cf-request-bottom-button-secondary" data-status="declined" value="Decline"/>
          </td>
        </tr>

      </tbody>
    </table> 
  </div>

  
</div>
<script src="<?php echo mp_cf_PLAGIN_URL . 'public/js/validation.js'?>"></script>
<script>
  window.addEventListener("DOMContentLoaded", () => {
    var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
    const requesterComment = document.getElementById('requesterSubmitComment')
    const statusUpdate = document.querySelector('.requester-update-status')
    statusUpdate.addEventListener('click', function(event){
      if (event.target.matches('.cf-request-bottom-button-primary') || event.target.matches('.cf-request-bottom-button-secondary')) {
       
          jQuery.ajax({
          url: ajaxurl,
          type: 'POST',
          data: {
            action: 'mp_cf_requester_submitted_update',
            postId:  requesterComment.getAttribute('data-requested-post-id'),
            submitted_post_id:  statusUpdate.getAttribute('data-post-id'),
            userId: requesterComment.getAttribute('data-user-id'),
            status: event.target.getAttribute('data-status'),
            comment: requesterComment.value
          },
          success: function(response) {
            console.log(response);
            document.querySelector('.cf-requested-bottom-container').classList.add('hidden')
            document.querySelector('.form-container').classList.add('hidden')
            document.querySelector('.cf-submitted-center').classList.remove('hidden')
            
          }
        })
      }

    })

  })
</script>