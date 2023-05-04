<div class="cf-right-section">
  <div class="cf-right-top-section">
    <h1>Your current active jobs</h1>
    <div class="cf-right-top-icon-container">
      <img src="<?php echo mp_cf_PLAGIN_URL . 'public/assets/Setting.svg'?>" alt="" />
    </div>
  </div>
  <div class="cf-request-center">
    <div class="active-jobs-table">
      <table>
        <thead>
          <tr>
            <th>Topic</th>
            <th>status</th>
            <th>Request Deadline</th>
            <th>Submission Deadline</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($active_jobs as $job){
            $request_status = get_post_meta($job->ID, 'mp_cf_claim_data_'.$current_userId,true);

            if($request_status['user_id'] == get_current_user_id() && $request_status['claim_status'] ==='waiting_content'){
              $is_submitted = false;
            }else if($request_status['claim_status'] ==='submitted'){
              $is_submitted = true;
              $status = 'Waiting for moderator.';
            }else if($request_status['claim_status'] ==='moderator_approved'){
              $is_submitted = true;
              $status = 'Waiting for requester.';
            }else if($request_status['claim_status'] ==='requester_approved'){
              $is_submitted = true;
              $status = 'Waiting for rank.';
            }
            
            ?>
          <tr>
            <td data-label="Topic"><?php echo  strlen($job->post_title) > 50 ? substr($job->post_title, 0, 50) . '...' : $job->post_title?></td>
            <td data-label="submission-status"><?php echo !$is_submitted ? 'Waiting for content.': $status?></td>
            <td data-label="request-deadline"><?php echo get_post_meta($job->ID, 'req_deadline',true)?></td>
            <td data-label="submission-deadline"><?php echo get_post_meta($job->ID, 'submission_deadline',true)?></td>

            <td data-label="Action"><?php if(!$is_submitted){?>
              <button class="cf-request-btn cf-submit-content" postId="<?php echo $job->ID?>">Submit your content</button>
              <?php }else {?>
                <button  data-request-id="<?php echo $job->ID?>" data-post-id ="<?php echo $request_status['post_id']?>" class="cf-request-btn cf-view-detail" >Veiw detail</button>
              <?php }?></td>
          </tr>
          <?php }?>
          
        </tbody>
      </table>
      
    </div>
  </div>
</div>

<script>
  window.addEventListener('DOMContentLoaded', () => {
    document.querySelector('.cf-active-jobs-tab').classList.add('cf-active')

    var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
    const mainContainer = document.querySelector('.cf-right-section')
    const submitBtn = document.querySelectorAll('.cf-submit-content')
    const detailBtn = document.querySelector('.cf-view-detail')
    

    submitBtn.forEach(element=>{
      element.addEventListener('click', submitContent)
    })

    function submitContent(event){
      const clickedElement = event.target;
      const currentUrl = window.location.href;
      const postId = clickedElement.getAttribute('postId');
      const url = `<?php echo home_url('mp_cf_plugin/active-jobs/?submit_request=')?>`
      window.location.href = url + postId
    }
    if(detailBtn){
      detailBtn.addEventListener('click', function(){
        jQuery.ajax({
          url: ajaxurl,
          type: 'POST',
          data: {
            action: 'mp_cf_my_submission_detail',
            postId: detailBtn.getAttribute('data-post-id'),
            requestId: detailBtn.getAttribute('data-request-id'),
          },
          success: function(response) {
            mainContainer.innerHTML = response
          },
          error: function(response) {
            console.log(response);
          }
        })
      })
    }
  })
</script>