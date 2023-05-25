<link rel="stylesheet" href="<?php echo mp_cf_PLAGIN_URL . 'public/css/mp-factory-active-jobs.css'?>">

  <div class="cf-right-top-section">
    <h1>Publication request detail</h1>
    <div class="cf-right-top-icon-container">
      <img src="<?php echo mp_cf_PLAGIN_URL . 'public/assets/Setting.svg'?>" alt="" />
    </div>
  </div>
  <a href="<?php echo home_url('mp_cf_plugin/review-submissions/?moderate=true')?>">
  <button class="cf-request-content-back">
    <img src="<?php echo mp_cf_PLAGIN_URL . 'public/assets/back.svg'?>" alt="" />
    “<?php echo $post->post_title?>” publication detail
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
        Submission status updated.
      </h1>
      <div class="cf-center-button-container">
      <a href="<?php echo home_url('mp_cf_plugin/review-submissions/?moderate=true')?>">
        <button class="cf-center-button-primary">Review more</button>
      </a>

        <a href="<?php echo home_url('mp_cf_plugin/factory-dashboard/?moderate=true')?>">
          <button class="cf-center-button-secondary">
            Back to Dashboard
          </button>
        </a>
      </div>
    </div>

  </div>

  <div class="cf-requested-bottom-container status-update" data-post-id="<?php echo $post_id?>">
    <table>
      <thead>
        <tr>
          <th>Submitter</th>
          <th>Comment</th>
        </tr>
      </thead>
      <tbody>
        
        <tr>
          <td><?php echo get_user_meta( $post->post_author, 'first_name', true )?></td> 
          <td><textarea name="" id="moderatorSubmitComment" cols="30" rows="10" data-user-id="<?php echo $post->post_author?>" data-post-id="<?php echo $post_id?>"></textarea></td>
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


<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">


<script type='module'>
  window.addEventListener("DOMContentLoaded", () => {

    const quill = new Quill('#cf-my-content', { 
        theme: 'snow'
    });
})
</script>