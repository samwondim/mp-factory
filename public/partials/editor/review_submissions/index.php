<div class="cf-right-section">
  <div class="cf-right-top-section">
    <h1>Submitted for publication</h1>
    <div class="cf-right-top-icon-container">
      <img src="<?php echo mp_cf_PLAGIN_URL . 'public/assets/Setting.svg'?>" alt="" />
    </div>
  </div>
  <div class="cf-requested-top-container">
    <div class="cf-requested-top-left">
      <span> show</span>
      <select name="entries-number" id="entries">
        <option>10</option>
        <option>20</option>
        <option>50</option>
      </select>
      <span>entries</span>
    </div>
    <div class="cf-requested-top-right cf-search">
      <div class="search-icon-container">
        <img src="<?php echo mp_cf_PLAGIN_URL . 'public/assets/search.svg'?>" alt="" />
      </div>
      <input id="searchReview" type="text" placeholder="Search" />
    </div>
  </div>

  <div class="cf-request-center">
    <div class="cf-requested-top">
      <table>
        <thead>
          <tr>
            <th>Topic</th>
            <th>Request Type</th>
            <th>Category</th>
            <!-- <th>No. of Claim</th> -->
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($review_submissions as $review){
            $parent_post_id = get_post_meta($review->ID, 'mp_cf_submitted_from',true);
            ?>
            <tr>
            <td data-label="Topic"><?php echo strlen($review->post_title) > 50 ? substr($review->post_title, 0, 50) . '...' : $review->post_title?></td>
            <td data-label="request-type"><?php echo get_post_meta($parent_post_id, 'req_type',true)?></td>
            <td data-label="category"><?php echo get_the_category($review->ID)[0]->name;?></td>
            <td data-label="Action">
              <button class="cf-request-btn submission-view-detail" data-post-id="<?php echo $review->ID?>">View Detail</button>
            </td>            
            </tr>
          <?php }?>
          
        </tbody>
      </table>
    </div>
  </div>
</div>
<script src="<?php echo mp_cf_PLAGIN_URL . 'public/js/validation.js'?>"></script>

<script>
  window.addEventListener('DOMContentLoaded', () => {
    var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
    const mainContainer = document.querySelector('.cf-right-section')
    const detailBtn = document.querySelector('.submission-view-detail')
    document.querySelector('.cf-review-submissions-tab').classList.add('cf-editor-active')
    if(detailBtn){
      detailBtn.addEventListener('click', function(){
        jQuery.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
              action: 'mp_cf_detail_submissions',
              postId: detailBtn.getAttribute('data-post-id')
            },
            success: function(response) {
              mainContainer.innerHTML = response
            }
          })
      })
    }
    mainContainer.addEventListener('click', function(event) {
      
      if (event.target.matches('.cf-request-bottom-button-primary') || event.target.matches('.cf-request-bottom-button-secondary')) {

        const commentContent = document.getElementById('moderatorSubmitComment');
        console.log(commentContent.value);

        jQuery.ajax({
          url: ajaxurl,
          type: 'POST',
          data: {
            action: 'mp_cf_review_submitted_update',
            postId: commentContent.getAttribute('data-post-id'),
            userId: commentContent.getAttribute('data-user-id'),
            status: event.target.getAttribute('data-status'),
            comment: commentContent.value
          },
          success: function(response) {
            console.log(response);
            document.querySelector('.cf-requested-bottom-container').classList.add('hidden')
            document.querySelector('.form-container').classList.add('hidden')
            document.querySelector('.cf-submitted-center').classList.remove('hidden')
            
          }
        })
      }
    });
   
  })
</script>