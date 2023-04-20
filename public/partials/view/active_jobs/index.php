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
      <tr>
          <td data-label="Topic">20</td>
          <td data-label="Request Type">Waiting for moderator</td>
          <td data-label="request-deadline">01-01-2023:12:52:45</td>
          <td data-label="submission-deadline">8</td>
          <td data-label="Action">No action needed</td>
        </tr>
        <?php foreach($active_jobs as $job){?>
        <tr>
          <td data-label="Topic"><?php echo  strlen($job->post_title) > 50 ? substr($job->post_title, 0, 50) . '...' : $job->post_title?></td>
          <td data-label="Request Type">Waiting for moderator</td>
          <td data-label="request-deadline">01-01-2023:12:52:45</td>
          <td data-label="submission-deadline">8</td>
          <td data-label="Action">No action needed</td>
        </tr>
        <?php }?>
        
      </tbody>
    </table>
  </div>
</div>