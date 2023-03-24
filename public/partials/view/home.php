<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

<style>
  * {
    padding: 0;
    margin: 0;
    box-sizing: border-box;
  }

  main {
    font-family: "Montserrat", sans-serif;
  }

  .r-title-container {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 1rem;
    margin: 0 1.5rem;
    background-color: #efefef;
    border-radius: 0 0 15px 15px;
    max-width: 300px;
    margin: auto;
  }

  .r-title {
    text-align: center;
    font-weight: 400;
    margin-right: 1rem;
  }

  .grid-container {
    display: grid;
    gap: 2rem;
    place-content: center;
    padding: 1rem;
    max-width: 1400px;
    place-items: center;
  }

  .card {
    background-color: #bdb648;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 1rem;
    padding: 2rem;
    width: 300px;
    cursor: pointer;
    outline: 1px solid #4441954d;
    transition: all 0.3s ease-in-out;
  }

  .card:hover {
    background-color: #dedede82;

  }

  .card-text {
    font-size: 2rem !important;
    color: #222a46 !important;
    font-weight: bold !important;
    line-height: 1 !important;
  }

  .info h1 {
    text-align: center;
    color: #3c434a;
    font-size: 1.8rem;
  }

  .info {
    padding: 5rem;
    background-color: #a09f9f62;
    width: 90%;
    margin: auto;
  }

  .info li {
    line-height: 2rem;
    font-size: 1rem;
  }

  .info span {
    font-weight: bold;
    font-size: 1.2rem;
  }

  .far,
  .fas {
    color: #222a46;
    font-size: 2rem !important;
  }

  @media screen and (min-width: 768px) {
    .grid-container {
      grid-template-columns: repeat(2, 1fr);
      padding: 5rem;
    }
  }
</style>

<?php
global $table_prefix, $wpdb;

$wp_mp_cf_table = $table_prefix . "mp_cf_notification";
$content_req_notifs = $wpdb->get_results("SELECT id, service_id FROM " . $wp_mp_cf_table . " WHERE seen=0  and type='content_req'");

?>

<div id="main_body">

  <!-- <link rel='stylesheet' id='reputation-settings-dashboard' href="<?php //echo mp_rp_PLAGIN_URL . 'admin/css/reputation-settings-dashboard.css' 
                                                                        ?>" media='all' /> -->

  <main>

    <div class="r-title-container">
      <h3 class="r-title">Factory Dashboard</h3>
      <i class="fas fa-cog"></i>
    </div>

			Your MPXR Balance=<?php echo $mpxr?></br>
			Currently availabe MPXR for voting=<?php echo $vote_rep_availabe?></br>
			public_address<?php echo $public_address?></br>

    <div class="grid-container">
      <div class="card" id="howItWorks">
        <i class="fas fa-scroll"></i>
        <h1 class="card-text">
          How it Works

        </h1>
      </div>
      <a href="<?php echo home_url('/cf_request_content') ?>">
        <div class="card" id="request">
          <i class="fas fa-hands-helping"></i>
          <h1 class="card-text">

            Request
          </h1>
        </div>
      </a>
      <a href="<?php echo home_url('/cf_my_requests') ?>">
        <div class="card" id="myRequest">
          <i class="fas fa-user"></i>
          <h1 class="card-text">

            My Requests (<?php echo count($content_req_notifs) ?>)
          </h1>
        </div>
      </a>
      <a href="<?php echo home_url('/cf_view_jobs') ?>">
        <div class="card" id="comment">
          <i class="fas fa-binoculars"></i>
          <h1 class="card-text">

            View Jobs
          </h1>
        </div>
      </a>
      <a href="<?php echo home_url('/cf_active_jobs') ?>">
        <div class="card" id="active">
          <i class="fas fa-chart-line"></i>
          <h1 class="card-text">

            Active Jobs
          </h1>
        </div>
      </a>
      <a href="<?php echo home_url('/cf_my_community') ?>">
        <div class="card" id="communityReq">
          <i class="fas fa-user-friends"></i>
          <h1 class="card-text">

            My Communities Requests

          </h1>
        </div>
      </a>
      <a href="<?php echo home_url('/cf_vote_on_content') ?>">
        <div class="card" id="vote">
          <i class="fas fa-vote-yea"></i>
          <h1 class="card-text">

            Vote on Content Requests
          </h1>
        </div>
      </a>
      <a href="<?php echo home_url('/cf_history') ?>">
        <div class="card" id="history">
          <i class="fas fa-history"></i>
          <h1 class="card-text">

            History</h1>
        </div>

      </a>

      <a href="<?php echo home_url('/cf_claim_payment') ?>">
        <div class="card" id="claim">
          <i class="fas fa-history"></i>
          <h1 class="card-text">

            Claim Payment</h1>
        </div>

      </a>
    </div>

  </main>



  <script>
    var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
  </script>


</div>

<script src="https://kit.fontawesome.com/baea3ca7e2.js" crossorigin="anonymous"></script>
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet" />