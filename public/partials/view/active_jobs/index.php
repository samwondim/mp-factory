<div class="cf-right-section">
  <div class="cf-right-top-section">
    <h1>Your current active jobs</h1>
    <div class="cf-right-top-icon-container">
      <img src="<?php echo mp_cf_PLAGIN_URL . '/public/assets/Setting.svg'?>" alt="" />
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
            $status = get_post_meta($job->ID, 'mp_cf_claimed_status'.get_current_user_id(),true)?>
          <tr>
            <td data-label="Topic"><?php echo  strlen($job->post_title) > 50 ? substr($job->post_title, 0, 50) . '...' : $job->post_title?></td>
            <td data-label="Request Type"><?php echo $status === 'submit'? 'Waiting for content': 'Waiting for moderator'?></td>
            <td data-label="request-deadline"><?php echo get_post_meta($job->ID, 'req_deadline',true)?></td>
            <td data-label="submission-deadline"><?php echo get_post_meta($job->ID, 'submission_deadline',true)?></td>

            <td data-label="Action"><?php if($status==='submit'){?>
              <button  data-postSlug="<?php echo $job->post_name?>"class="cf-request-btn cf-submit-content" postId="<?php echo $job->ID?>">Submit your content</button>
              <?php }else echo 'No action needed'?></td>
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

    submitBtn.forEach(element=>{
      element.addEventListener('click', submitContent)
    })

    function submitContent(event){
      const clickedElement = event.target;
      const currentUrl = window.location.href;
      const postSlug = clickedElement.getAttribute('data-postSlug');
      window.location.href = `<?php echo home_url('mp_cf_plugin/active-jobs/?submit_request=')?>${postSlug}`;
    }
  })
</script>