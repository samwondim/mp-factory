<div class="cf-right-section">
  <div class="cf-right-top-section">
    <h1>Requested articles</h1>
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
    <div class="cf-requested-top-right">
      <img src="<?php echo mp_cf_PLAGIN_URL . 'public/assets/search.svg'?>" alt="" />
      <input type="text" placeholder="Search" />
    </div>
  </div>

  <div class="cf-request-center">
    <div class="cf-requested-top">
      <table>
        <thead>
          <tr>
            <th>Topic</th>
            <th>Request Type</th>
            <th>No. of Claim</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($my_requests as $article){
            $status_object = get_post_status_object( $article->post_status );
            $claimed_count = get_post_meta($article->ID, 'mp_cf_claim_article');
            $total_submissions = get_post_meta($article->ID, 'submissions',true);
            if(isset($status_object->description) ){
              if(empty($claimed_count)){
                $status_message = $status_object->description;
              } 
              else if(count($claimed_count) < $total_submissions)
                $status_message = 'Claiming has begun.';
              else if( count($claimed_count) == $total_submissions)
                $status_message = 'Claimed.';

            }
            else $status_message = 'Waiting for moderator.';
            ?>
          <tr> 
            <td data-label="Topic"><?php echo strlen($article->post_title) > 50 ? substr($article->post_title, 0, 50) . '...' : $article->post_title?></td>
            <td data-label="Request Type"><?php echo get_post_meta($article->ID, 'req_type',true)?></td>
            <td data-label="No. of Claim"> <?php echo count($claimed_count).' out of '. get_post_meta($article->ID, 'submissions',true) ?></td>
            <td data-label="status"><?php echo $status_message?></td>
            <td data-label="Action">
              <button class="cf-request-btn cf-detail-<?php echo $article->ID?>" postId="<?php echo $article->ID?>">Detail</button>
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
    
    document.querySelector('.cf-my-request-tab').classList.add('cf-active')
    const myRequestsSpan = document.querySelector('.cf-my-requests-notif')
    
    myRequestsSpan.innerHTML = `(0)`;

    var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
    const mainContainer = document.querySelector('.cf-right-section')
    const detailBtn = document.querySelectorAll('.cf-request-btn')

    // const cfUrlParams = new URLSearchParams(window.location.search);
    // if (cfUrlParams.has('cf-request')) {
    //   // document.querySelector(`.${cfUrlParams.get('cf-request')}`).click()
      
    // }

    detailBtn.forEach(element=>{
      element.addEventListener('click', seeDetail);
    })

    function seeDetail(event){
      const clickedElement = event.target;
      jQuery.ajax({
        url: ajaxurl,
        type: 'POST',
        data: {
          action: 'mp_cf_details',
          postId: clickedElement.getAttribute('postId'),
          detailType: 'my_request'
        },
        success: async function(response) {
          mainContainer.innerHTML = response
          // document.querySelector('.cf-right-section').innerHTML = ''

          var arr = document.getElementsByTagName('script')
          for (var n = 0; n < arr.length; n++)
            eval(arr[n].innerHTML) //run script inside div
        }
      })
    }
  })
</script>