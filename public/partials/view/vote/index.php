<div class="cf-right-section">
  <div class="cf-right-top-section">
    <h1>Vote</h1>
    <div class="cf-right-top-icon-container">
      <img src="<?php echo mp_cf_PLAGIN_URL . 'public/assets/Setting.svg'?>" alt="" />
    </div>
  </div>
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
        <img src="<?php echo mp_cf_PLAGIN_URL . 'public/assets/search.svg'?>" alt="" />
        <input type="text" placeholder="Search" />
      </div>
    </div>

    <div class="cf-request-center">
      <div class="cf-requested-top">
        <table>
          <thead>
            <tr>
              <th>Requested content</th>
              <th>Up vote</th>
              <th>Down vote</th>
              <th>Vote</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($requested_articles as $article){
              $is_user_vote = get_user_meta(get_current_user_id(), 'mp_cf_is_votted_'.$article->ID,true);
              $up_vote = get_post_meta($article->ID, 'post_up_vote', true);
              $down_vote = get_post_meta($article->ID, 'post_down_vote', true);
              $is_claimed = get_post_meta($article->ID, 'mp_cf_claim_article',true);
              $submissions = get_post_meta($article->ID, 'submissions',true);
              if($is_claimed == get_current_user_id() || $submissions <= count(get_post_meta($article->ID, 'mp_cf_claim_article')))
                continue;
              ?>
            <tr> 
              <td data-label="requested-content"><?php echo strlen($article->post_title) > 50 ? substr($article->post_title, 0, 50) . '...' : $article->post_title?></td>
              <td class="cf-up-vote-<?php echo $article->ID?>" data-label="up-vote"><?php echo $up_vote ? $up_vote : '0'?></td>
              <td class="cf-down-vote-<?php echo $article->ID?>" data-label="down-vote"><?php echo $down_vote ? $down_vote : '0'?></td>
              <td data-label="vote" > 
                <span class="cf-vote-input" >
                  <input class="cf-vote-value-<?php echo $article->ID?>" type="number" style="width: 60px;" />
                </span>
                <?php if($is_user_vote !== 'down') {?>
                  <span class="cf-vote" data-vote-type="up" data-user-id="<?php echo get_current_user_id()?>" data-post-id="<?php echo $article->ID?>">Up</span>
                  <?php } ?>
                <?php if($is_user_vote !== 'up') {?>

                <span class="cf-vote" data-vote-type="down" data-user-id="<?php echo get_current_user_id()?>" data-post-id="<?php echo $article->ID?>">Down</span>
                <?php } ?>

              </td>
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
</div>
<script src="<?php echo mp_cf_PLAGIN_URL . 'public/js/validation.js'?>"></script>

<script>
  window.addEventListener('DOMContentLoaded', () => {
    var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
    const mainContainer = document.querySelector('.cf-right-section')
    const detailBtn = document.querySelectorAll('.cf-request-btn')
    const voteEl = document.querySelectorAll('.cf-vote')

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


          var arr = document.getElementsByTagName('script')
          for (var n = 0; n < arr.length; n++)
            eval(arr[n].innerHTML) //run script inside div
        }
      })
    }

    function cfVote(element){
      const voteType = element.target.getAttribute('data-vote-type')
      const postId = element.target.getAttribute('data-post-id')
      const userId = element.target.getAttribute('data-user-id')
      const voteAmount = document.querySelector(`.cf-vote-value-${postId}`)
      
      if (isNaN(parseFloat(voteAmount.value))) {
        console.log('Invalid entry.');
      }
      else {
        jQuery.ajax({
          url: ajaxurl,
          type: 'POST',
          data: {
            action: 'mp_cf_vote',
            postId,
            voteType,userId,
            voteAmount: voteAmount.value,
          },
          success: function(response) {
            console.log(response);
            let status = JSON.parse(response)
            const nextElement = element.target.nextElementSibling
            const previousElement = element.target.previousElementSibling

            document.querySelector(`.cf-${status.vote_type}-vote-${postId}`).innerHTML = status.current_value
            if(voteType == 'up' && nextElement && nextElement.getAttribute('data-vote-type') === 'down'){
              element.target.nextElementSibling.innerHTML = ''
            }else if(voteType == 'down' && previousElement &&previousElement.getAttribute('data-vote-type') === 'up'){
              element.target.previousElementSibling.innerHTML = ''
            }
          }
        })
      }
    }

    detailBtn.forEach(element=>{
      element.addEventListener('click', seeDetail);
    })

    voteEl.forEach(vote=>{
      vote.addEventListener('click',cfVote);
    })


  })
</script>