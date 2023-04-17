<div class="cf-right-section">
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
            <th>No. of Claim</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($requested_articles as $article){?>

          <tr>
            <td data-label="Topic"><?php echo strlen($article->post_title) > 50 ? substr($article->post_title, 0, 50) . '...' : $article->post_title?></td>
            <td data-label="Request Type"><?php echo get_post_meta($article->ID, 'req_type',true)?></td>
            <td data-label="No. of Claim">1 out of <?php echo get_post_meta($article->ID, 'submissions',true)?></td>
            <td data-label="Action">
              <button class="cf-request-btn" postId="<?php echo $article->ID?>">Detail</button>
            </td>
          </tr>

          <?php }?>
          
        </tbody>
      </table>
    </div>
  </div>
</div>

<script>
  window.addEventListener('DOMContentLoaded', () => {
    var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
    const mainContainer = document.querySelector('.cf-requested-top')
    const detailBtn = document.querySelectorAll('.cf-request-btn')


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
          postId: clickedElement.getAttribute('postId')
        },
        success: async function(response) {
          mainContainer.innerHTML = response
          document.querySelector('.cf-requested-top-container').innerHTML = ''
        }
      })
    }
  })
</script>