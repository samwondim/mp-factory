<div class="cf-right-section">
  <div class="cf-right-top-section">
    <h1>Review articles</h1>
    <div class="cf-right-top-icon-container">
      <img src="<?php echo mp_cf_PLAGIN_URL . '/public/assets/Setting.svg'?>" alt="" />
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
      <img src="<?php echo mp_cf_PLAGIN_URL . '/public/assets/search.svg'?>" alt="" />
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
            <th>Min MPX value</th>
            <!-- <th>No. of Claim</th> -->
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($review_requests as $request){
            
            $is_claimed = get_post_meta($request->ID, 'mp_cf_claim_article',true);
            $submissions = get_post_meta($request->ID, 'submissions',true);
            if($is_claimed == get_current_user_id() || $submissions <= count(get_post_meta($request->ID, 'mp_cf_claim_article')))
              continue;
              
            ?>
          <tr> 
            <td data-label="Topic"><?php echo strlen($request->post_title) > 50 ? substr($request->post_title, 0, 50) . '...' : $request->post_title?></td>
            <td data-label="Request Type"><?php echo get_post_meta($request->ID, 'req_type',true)?></td>
            <td data-label="Min MPX value"><?php echo get_post_meta($request->ID, 'minMpxr',true)?></td>
            <!-- <td data-label="No. of Claim"> < ?php echo count(get_post_meta($request->ID, 'mp_cf_claim_article')) . ' out of '. $submissions?></td> -->
            <td data-label="Action">
              <button class="cf-request-btn" postId="<?php echo $request->ID?>">Detail</button>
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
    const detailBtn = document.querySelectorAll('.cf-request-btn')

    document.querySelector('.cf-review-requests-tab').classList.add('cf-editor-active')

    detailBtn.forEach(element=>{
      element.addEventListener('click', seeDetail);
    })

    function seeDetail(event){
      const clickedElement = event.target;
      jQuery.ajax({
        url: ajaxurl,
        type: 'POST',
        data: {
          action: 'mp_cf_review_request',
          postId: clickedElement.getAttribute('postId')
        },
        success: async function(response) {
          // document.querySelector('.cf-requested-top-container').innerHTML = ''
          mainContainer.innerHTML = response

          var arr = document.getElementsByTagName('script')
          for (var n = 0; n < arr.length; n++)
            eval(arr[n].innerHTML) //run script inside div
        }
      })
    }
  })
</script>