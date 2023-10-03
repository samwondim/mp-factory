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
      <?php foreach ($searched_reviews as $request){
        
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
