<link rel="stylesheet" href="<?php echo mp_cf_PLAGIN_URL . 'public/css/mp-factory-active-jobs.css'?>">

  <div class="cf-right-top-section">
    <h1>My Submissions detail</h1>
    <div class="cf-right-top-icon-container">
      <img src="<?php echo mp_cf_PLAGIN_URL . 'public/assets/Setting.svg'?>" alt="" />
    </div>
  </div>
  <a href="<?php echo home_url('mp_cf_plugin/active-jobs')?>">
  <button class="cf-request-content-back">
    <img src="<?php echo mp_cf_PLAGIN_URL . 'public/assets/back.svg'?>" alt="" />
    “<?php echo $post->post_title?>” submission detail
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
          <div id="cf-my-submission">
            <?php echo $post->post_content?>
          </div>
        </div> 
        
      </form>
    </div>

  </div>


  <?php  if(!empty($moderator_comment) && get_post_status($post->ID) !== 'pending'){?>
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
            
            <tr>
              <td data-label="Content Creator"><?php echo $first_name?></td>
              <td data-label="Content Creator"></td>
              <td data-label="Content Creator"><?php echo $request_status['request_time']?></td>
              <td data-label="Content Creator"><?php echo $claimer_status?></td>
              <td data-label="Content Creator">Not set</td>
             
            </tr>

          </tbody>
        </table>
      </div>


<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">


<script type='module'>
  window.addEventListener("DOMContentLoaded", () => {

    const quill = new Quill('#cf-my-submission', { 
        theme: 'snow'
    });
})
</script>