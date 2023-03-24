<style>
    .cf-side-text {
        font-size: 18px !important;
    }
</style>
<div id="body_request_content_index">

    <div id="div_request_content_response">

    </div>

    <div id="signupbox" class="mainbox col-md-12 col-md-offset-0 col-sm-12 col-sm-offset-0">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="panel-title">Request Content</div>
                <!-- <div style="float:right; font-size: 85%; position: relative; top:-10px"><a id="signinlink" href="/accounts/login/">Sign In</a></div> -->
            </div>
            <div class="panel-body">
                <form method="post" action="">
                    <input type='hidden' name='csrfmiddlewaretoken' value='XFe2rTYl9WOpV8U6X5CfbIuOZOELJ97S' />

                    <form class="form-horizontal" method="post">

                        <!-- <input type='hidden' name='csrfmiddlewaretoken' value='XFe2rTYl9WOpV8U6X5CfbIuOZOELJ97S' /> -->

                        <div id="div_id_topic" class="form-group required">
                            <label for="id_topic" class="control-label col-md-4  requiredField cf-side-text"> Title </label>
                            <div class="controls col-md-8 ">
                                <input class="input-md  textinput textInput form-control" id="id_topic" maxlength="255" name="topic" placeholder="Enter the title" style="margin-bottom: 10px" type="text" required />
                                <div id="error_id_topic"> </div>
                            </div>
                        </div>

                        <div id="div_id_category" class="form-group required">
                            <label for="id_category" class="control-label col-md-4  requiredField"> Category <span class="asteriskField">*</span> </label>
                            <div class="controls col-md-8 ">

                                <select class="input-md textinput textInput form-control" placeholder="Content category" style="margin-bottom: 10px" id="category">
                                    <option value="">Select Category</option>
                                    <?php
                                    $categories = get_categories(array(
                                        'orderby' => 'name',
                                        'order'   => 'ASC',
                                        'hide_empty' => FALSE
                                    ));

                                    foreach ($categories as $category) {
                                        echo '<option value="' . $category->term_id . '">' . $category->name . '</option>';
                                    }
                                    ?>
                                </select>
                                <div id="error_id_category">
                            </div>
                        </div>
            </div>
            <div id="div_id_min_XREP_val" class="form-group required">
                <label for="id_min_XREP_val" class="control-label col-md-4  requiredField cf-side-text"> Minimum MPXR value </label>
                <div class="controls col-md-8 ">
                    <input class="input-md number input form-control" id="id_min_XREP_val" name="min_XREP_val" placeholder="Min MPXR value to claim" style="margin-bottom: 10px" type="number" max="1000000" required />
                    <div id="error_id_min_XREP_val"> </div>
                </div>
            </div>

            <div id="div_id_req_deadline" class="form-group required">
                <label for="id_req_deadline" class="control-label col-md-4  requiredField cf-side-text">Request Deadline </label>
                <div class="controls col-md-8 ">
                    <input class="input-md textinput textInput form-control" id="id_req_deadline" name="req_deadline" placeholder="Create a req_deadline" style="margin-bottom: 10px" type="date" min="<?php echo date('Y-m-d'); ?>" required />
                    <div id="error_id_req_deadline"> </div>
                </div>
            </div>
            <div id="div_id_desc" class="form-group required">
                <label for="id_desc" class="control-label col-md-4  requiredField cf-side-text"> Description </label>
                <div class="controls col-md-8 ">

                    <!-- <textarea id="id_desc" name="desc" rows="4" cols="50" placeholder="Please describe the requested content" style="margin-bottom: 10px" required></textarea> -->

                    <?php
                    // default settings - Kv_front_editor.php
                    $content = '';
                    $editor_id = 'id_desc';
                    $settings =   array(
                        'wpautop' => true, // use wpautop?
                        'media_buttons' => true, // show insert/upload button(s)
                        'textarea_name' => $editor_id, // set the textarea name to something different, square brackets [] can be used here
                        'textarea_rows' => get_option('default_post_edit_rows', 10), // rows="..."
                        'tabindex' => '',
                        'editor_css' => '', //  extra styles for both visual and HTML editors buttons, 
                        'editor_class' => '', // add extra class(es) to the editor textarea
                        'teeny' => false, // output the minimal editor config used in Press This
                        'dfw' => false, // replace the default fullscreen with DFW (supported on the front-end in WordPress 3.4)
                        'tinymce' => true, // load TinyMCE, can be used to pass settings directly to TinyMCE using an array()
                        'quicktags' => true // load Quicktags, can be used to pass settings directly to Quicktags using an array()
                    );


                    wp_editor($content, $editor_id, $settings = array());

                    ?>

                    <div id="error_id_desc"> </div>
                </div>
            </div>

            <div id="div_id_submission_deadline" class="form-group required">
                <label for="id_submission_deadline" class="control-label col-md-4  requiredField cf-side-text"> Submission Deadline After Claim</label>
                <div class="controls col-md-8 ">
                    <input class="input-md number input form-control" id="id_submission_deadline" name="submission_deadline" placeholder="Submission Deadline in Days" style="margin-bottom: 10px" type="number" min="15" required />
                    <div id="error_id_submission_deadline"> </div>
                </div>
            </div>

            <div id="div_id_media_type" class="form-group required">
                <label for="id_media_type" class="control-label col-md-4  requiredField cf-side-text"> Media type </label>
                <div class="controls col-md-8 " style="margin-bottom: 10px">
                    <label class="radio-inline"> <input type="radio" name="media_type" id="id_media_type_1" value="text" style="margin-bottom: 10px" checked="checked">Text</label>
                    <label class="radio-inline"> <input type="radio" name="media_type" id="id_media_type_2" value="audio" style="margin-bottom: 10px">Audio </label>
                    <label class="radio-inline"> <input type="radio" name="media_type" id="id_media_type_3" value="video" style="margin-bottom: 10px">Video </label>
                    <div id="error_id_media_type"> </div>
                </div>
            </div>
            <div id="div_id_media_length" class="form-group required">
                <label for="id_media_length" class="control-label col-md-4  requiredField"> Media length </label>
                <div class="controls col-md-8 ">
                    <input class="input-md  textinput textInput form-control" id="id_media_length" maxlength="30" name="media_length" placeholder="Media length" style="margin-bottom: 10px" type="number" />
                    <div id="error_id_media_length"> </div>
                </div>
            </div>
            <div id="div_id_req_type" class="form-group required">
                <label for="id_req_type" class="control-label col-md-4  requiredField cf-side-text"> Request type </label>
                <div class="controls col-md-8 " style="margin-bottom: 10px">
                    <label class="radio-inline"> <input type="radio" name="req_type" id="id_req_type_paid" value="paid" style="margin-bottom: 10px" checked="checked">Paid</label>
                    <label class="radio-inline"> <input type="radio" name="req_type" id="id_req_type_free" value="free" style="margin-bottom: 10px">Free </label>
                    <div id="error_id_req_type"> </div>
                </div>
            </div>

            <div id="div_id_license" class="form-group required">
                <label for="id_license" class="control-label col-md-4  requiredField cf-side-text"> License </label>
                <div class="controls col-md-8 ">

                    <select class="input-md textinput textInput form-control" id="id_license" name="license" placeholder="Content License" style="margin-bottom: 10px;padding:0px">
                        <option value="mindplex">Mindplex</option>
                        <option value="mit">MIT</option>
                        <option value="GPL">GPL</option>
                        <option value="LGPL">LGPL</option>
                        <option value="MPL">Mozilla Public License 2.0.</option>
                    </select>
                    <div id="error_id_license"> </div>
                    <!-- <input class="input-md textinput textInput form-control" id="id_license" name="license" placeholder="Content License" style="margin-bottom: 10px" type="text" /> -->
                </div>
            </div>
            <div id="div_id_backing_amount" class="form-group required">
                <label for="id_backing_amount" class="control-label col-md-4  requiredField"> Tip Amount </label>
                <div class="controls col-md-8 ">
                    <input class="input-md number input form-control" id="id_backing_amount" name="backing_amount" placeholder="Content backing amount" style="margin-bottom: 10px" type="number" min="1" max="1000000" />
                    <div id="error_id_backing_amount"> </div>
                </div>
            </div>
            <div id="div_id_submissions" class="form-group required">
                <label for="id_submissions" class="control-label col-md-4  requiredField cf-side-text"> Submissions </label>
                <div class="controls col-md-8 " style="margin-bottom: 10px">
                    <label class="radio-inline"> <input type="radio" name="submissions" id="id_submissions_1" value="single" style="margin-bottom: 10px" checked="checked">Single Submission</label>
                    <label class="radio-inline"> <input type="radio" name="submissions" id="id_submissions_2" value="multi" style="margin-bottom: 10px">Multiple Submissions</label>
                    <div id="error_id_submissions"> </div>
                </div>
            </div>
            <div id="div_id_max_submissions" class="form-group required">
                <label for="id_max_submissions" class="control-label col-md-4  requiredField"> Maximum submissions </label>
                <div class="controls col-md-8 " style="margin-bottom: 10px">
                    <input type="hidden" name="max_submissions" id="id_max_submissions_1" value="1" style="margin-bottom: 10px" checked="checked"></label>
                    <label class="radio-inline"> <input type="radio" name="max_submissions" id="id_max_submissions_2" value="2" style="margin-bottom: 10px">2 claims</label>
                    <label class="radio-inline"> <input type="radio" name="max_submissions" id="id_max_submissions_3" value="3" style="margin-bottom: 10px">3 claims</label>
                    <label class="radio-inline"> <input type="radio" name="max_submissions" id="id_max_submissions_4" value="4" style="margin-bottom: 10px">4 claims</label>
                    <label class="radio-inline"> <input type="radio" name="max_submissions" id="id_max_submissions_5" value="5" style="margin-bottom: 10px">5 claims</label>
                    <div id="error_id_max_submissions"> </div>
                </div>
            </div>
            <div id="div_id_XDOreward" class="form-group required">
                <label for="id_XDOreward" class="control-label col-md-4  requiredField cf-side-text"> MPX reward Value </label>
                <div class="controls col-md-8 ">
                    <input class="input-md number input form-control" id="id_XDOreward" name="XDOreward" placeholder="MPX reward Value " style="margin-bottom: 10px" type="number" min="1" max="1000000" />
                    <div id="error_id_XDOreward"> </div>
                </div>
            </div>
            <div id="div_id_guarantee" class="form-group required">
                <label for="id_guarantee" class="control-label col-md-4  requiredField"> Guarantee value <span class="asteriskField">*</span> </label>
                <div class="controls col-md-8 ">
                    <input class="input-md number input form-control" id="id_guarantee" name="guarantee" placeholder="% Guarantee value" style="margin-bottom: 10px" type="number" max="1000000" required />
                    <div id="error_id_guarantee"> </div>
                </div>
            </div>
            <!-- <div class="form-group">
                        <div class="controls col-md-offset-4 col-md-8 ">
                            <div id="div_id_terms" class="checkbox required">
                                <label for="id_terms" class=" requiredField">
                                    <input class="input-ms checkboxinput" id="id_terms" name="terms" style="margin-bottom: 10px" type="checkbox" required />
                                    Agree with the terms and conditions
                                </label>
                            </div>

                        </div>
                    </div> -->

            <div class="form-group">
                <div class="aab controls col-md-4 "></div>
                <div class="controls col-md-8 ">
                    <!-- <input type="submit" name="submit_art_request_form" value="Submit Request" class="btn btn-primary btn btn-info" id="submit_art_request_id" /> -->
                    <button type="button" class="submit_requested_content " style="background-color: #222a46;border:none;color:#fff;padding:10px;border-radius:5px">Submit Request</button>

                </div>
            </div>

            </form>

            </form>
        </div>
    </div>
</div>

<!-- <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script> -->
<script>
    //   tinymce.init({
    //     selector: '#mytextarea' });

    let smart_contract_utils
    let wallet
    let user_balance
    let selected_account
    
    $(document).ready(function() {
        var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";

        $("#div_id_backing_amount").hide();

        // $("#submit_art_request_id").click(function(e) {

        //     $("div.bhoechie-tab-menu>div.list-group>a").siblings('a.active').removeClass("active");
        //     $("div.bhoechie-tab-menu>div.list-group>a").eq(1).addClass("active");

        //         $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
        //         $("div.bhoechie-tab>div.bhoechie-tab-content").eq(1).addClass("active");
        //     alert ("signup clickedkj ");

        // });

        $("#div_id_media_length").hide();
        $("#div_id_max_submissions").hide();

        $("input[name='media_type']").change(function() {

            media_type = $("input[name='media_type']:checked").val();

            if (media_type != 'text') {
                $("#div_id_media_length").show();
            } else {
                $("#div_id_media_length").hide();
            }

        });

        $("input[name='req_type']").change(function() {

            req_type = $("input[name='req_type']:checked").val();

            togglePaidInfo(req_type);
            // toggleIndividInfo();
        });


        // $("input[name='max_submissions']").change(function() {
        // 	max_submissions = $("input[name='max_submissions']:checked").val();

        // // alert ("max_submissions " + max_submissions);
        // });

        $("input[name='submissions']").change(function() {
            max_submissions = $("input[name='submissions']:checked").val();

            if (max_submissions == 'multi') {
                $("#div_id_max_submissions").show();
                $("#id_max_submissions_1").prop("checked", false);
            } else {
                $("#id_max_submissions_1").prop("checked", true);
                $("#div_id_max_submissions").hide();
            }
        });

        function togglePaidInfo(req_type) {
            // alert ("toggle " + req_type);
            if (req_type == 'paid') {
                $("#div_id_license").show();
                $("#div_id_backing_amount").hide();
                $("#div_id_XDOreward").show();
                $("#div_id_submissions").show();
                $("#div_id_guarantee").show();

                max_submissions = $("input[name='submissions']:checked").val();

                // alert("lkdsfj");
                // alert(max_submissions);

                if (max_submissions == 'multi') {
                    $("#div_id_max_submissions").show();
                }

            } else {
                $("#div_id_license").hide();
                $("#div_id_backing_amount").show();
                $("#div_id_max_submissions").hide();
                $("#div_id_XDOreward").hide();
                $("#div_id_submissions").hide();
                $("#div_id_guarantee").hide();

            }
        }

            $("#id_req_type_free").prop("checked", true);
            // $("#div_id_req_type").hide();
            togglePaidInfo("free");
            $("#div_id_backing_amount").hide();

        function isAllFiled() {
            $filled = true;

            claim_xrep = "<?php echo $claim_xrep; ?>";

            if (!$("#id_topic").val()) {

                $("#error_id_topic").html('This filed is required');
                $filled = false;
            } else $("#error_id_topic").html('');
            if (!$("#category").val()) {

                $("#error_id_category").html('This filed is required');
                $filled = false;
            } else $("#error_id_category").html('');
            if (!$("#id_min_XREP_val").val()) {
                $("#error_id_min_XREP_val").html('This filed is required');
                $filled = false;
            } else $("#error_id_min_XREP_val").html('');
            if (parseInt($("#id_min_XREP_val").val()) < parseInt(claim_xrep)) {
                $("#error_id_min_XREP_val").html('Minimum is ' + claim_xrep);
                $filled = false;
            } else $("#error_id_min_XREP_val").html('');
            if (!$("#id_req_deadline").val()) {
                $("#error_id_req_deadline").html('This filed is required');
                $filled = false;
            } else $("#error_id_req_deadline").html('');
            if (!$("#id_submission_deadline").val()) {
                $("#error_id_submission_deadline").html('This filed is required');
                $filled = false;
            } else $("#error_id_submission_deadline").html('');

            ////////

            // if (!$("#id_desc").val()) { //quill.container.innerHTML){
            //     $("#error_id_desc").html('This filed is required');
            //     $filled = false;
            // } else $("#error_id_desc").html('');
            if (tinyMCE.activeEditor.getContent({
                    format: 'raw'
                }) === '<p><br data-mce-bogus="1"></p>') {

                $("#error_id_desc").html('This filed is required');
                $filled = false;
            } else $("#error_id_desc").html('');

            // tinyMCE.activeEditor.getContent({format : 'raw'})
            // <p><br data-mce-bogus="1"></p>

            if ($('input[name=media_type]:checked').val() != "text") {

                if (!$("#id_media_length").val()) {
                    $("#error_id_media_length").html('This filed is required');
                    $filled = false;
                } else $("#error_id_media_length").html('');
            }

            if ($('input[name=req_type]:checked').val() == "paid") {
                if (!$("#id_license").val()) {
                    $("#error_id_license").html('This filed is required');
                    $filled = false;
                } else $("#error_id_license").html('');


                if (!$("#id_XDOreward").val()) {
                    $("#error_id_XDOreward").html('MPX filed is required');
                    $filled = false;
                } else {
                    if (parseFloat($("#id_XDOreward").val()) <= 0) {
                        $("#error_id_XDOreward").html('MPX Reward should be greater than 0');
                        $filled = false;
                    } else $("#error_id_XDOreward").html('');

                }
                if (!$("#id_guarantee").val()) {
                    $("#error_id_guarantee").html('Guarantee filed is required');
                    $filled = false;
                } else {
                    if (parseFloat($("#id_guarantee").val()) < 15) {

                        $("#error_id_guarantee").html('Guarantee should not be less than 15% of XDOreward');
                        $filled = false;
                    } else if (parseFloat($("#id_guarantee").val()) > 100) {
                        $("#error_id_guarantee").html('Guarantee should not exceed 100%');
                        $filled = false;
                    }
                }
            } else {

                // if (!$("#id_backing_amount").val()) {
                //     $("#error_id_backing_amount").html('This filed is required');
                //     $filled = false;
                // } else $("#error_id_backing_amount").html('');
            }



            return $filled;
        }
        $(".submit_requested_content").click(async function() {

            // Get the HTML contents of the currently active editor
            // console.log( tinyMCE.activeEditor.getContent() );
            // Get the raw contents of the currently active editor
            // console.log("start")
            // console.log( tinyMCE.activeEditor.getContent({format : 'raw'}) );
            // console.log("end")

            if (isAllFiled()) {
                if ($('input[name=req_type]:checked').val() == "free" && $("#id_backing_amount").val() == "0") {
                    // alert("free free");
                    onCompleteFree();
                } else {
                    // alert("paid");
                    onPaid()
                }
            }
        });

         function fetchBalance() {
        
    if(selected_account){
        jQuery.ajax({
            url:ajaxurl,
            type:'GET',
            data:{
                action:'get_users_balance',
                public_address:selected_account},
            success: (res)=>{
                const response = JSON.parse(res)
                if(response['status']=='success'){
                    user_balance = response['result']
                    onAccountConnect(selected_account)
                }
                else {

                     Swal.fire({
                    html: '<img src="<?php echo MP_BC_PLAGIN_URL . '/public/assets/loading.svg' ?>" width="100px"/>',
                    title: "User should deposit mpx first to request content",
                    showConfirmButton: false,
                });
                    
                }
            }
        })
}
          

        }


        function onCompleteFree() {

            var editor_content = tinyMCE.activeEditor.getContent({
                format: 'raw'
            }); //$("#id_desc").val();

            jQuery.ajax({
                url: ajaxurl,
                type: 'POST',
                data: {
                    action: 'submit_requested_content',
                    topic: $("#id_topic").val(),
                    category: $("#category").val(),
                    min_XREP_val: $("#id_min_XREP_val").val(),
                    req_deadline: $("#id_req_deadline").val(),
                    submission_deadline: $("#id_submission_deadline").val(),
                    desc: editor_content, //$("#id_desc").val(),
                    media_type: $('input[name=media_type]:checked').val(),
                    media_length: $("#id_media_length").val(),
                    req_type: $('input[name=req_type]:checked').val(),
                    license: $("#id_license").val(),
                    backing_amount: $("#id_backing_amount").val(),
                    submissions: $('input[name=submissions]:checked').val(), //$("#id_submissions").val(),
                    max_submissions: $('input[name=max_submissions]:checked').val(),
                    XDOreward: $("#id_XDOreward").val(),
                    guarantee_amount: $("#id_guarantee").val()
                },
                success: async function(response) {
                    $("#div_request_content_response").html(response);
                    cleanFileds();

                }
            });

        }

        function proccedToSave(signature,uuid) {

            var editor_content = tinyMCE.activeEditor.getContent({
                format: 'raw'
            }); //$("#id_desc").val();

            jQuery.ajax({
                url: ajaxurl,
                type: 'POST',
                data: {
                    action: 'submit_requested_content',

                    topic: $("#id_topic").val(),
                    category: $("#category").val(),
                    min_XREP_val: $("#id_min_XREP_val").val(),
                    req_deadline: $("#id_req_deadline").val(),
                    submission_deadline: $("#id_submission_deadline").val(),
                    desc: editor_content, //$("#id_desc").val(),
                    media_type: $('input[name=media_type]:checked').val(),
                    media_length: $("#id_media_length").val(),
                    req_type: $('input[name=req_type]:checked').val(),
                    license: $("#id_license").val(),
                    backing_amount: $("#id_backing_amount").val(),
                    submissions: $('input[name=submissions]:checked').val(), //$("#id_submissions").val(),
                    max_submissions: $('input[name=max_submissions]:checked').val(),
                    XDOreward: $("#id_XDOreward").val(),
                    guarantee_amount: $("#id_guarantee").val(),
                    signature: signature,
                    uuid:uuid
                },
                success: async function(res) {
                     console.log(res)
                     const response =  JSON.parse(res)
                      console.log(response)
                  if(response['status']=='success'){

                    let rewardPrice = 0;
                    try {
                        //
                      //  $("#div_request_content_response").html(response);

                    } catch (error) {
                        $("#div_request_content_response").html(response);
                        Swal.close()
                    }

                    if ($('input[name=req_type]:checked').val() == "free")
                        rewardPrice = $("#id_backing_amount").val()
                    else
                        rewardPrice = $("#id_XDOreward").val()
                    // console.log("startd" + response + "end");
                    $("#div_request_content_response").html(response);

                    if ($('input[name=req_type]:checked').val() == "free" && $("#id_backing_amount").val() < 1) {

                    } else {

                        cleanFileds();

                    }
                    cleanFileds();
                    window.location.replace("<?php echo home_url('/cf_my_requests') ?>");
                }
             
               else if(response['status']=='failure'){

                    console.log("triggered")
                     Swal.fire({ title: "Request Failure",
                            showConfirmButton: false,
                        });
                }
                }
            });


        }

        function cleanFileds() {

            $("#id_topic").val("");
            $("#id_min_XREP_val").val("");
            $("#id_req_deadline").val("");
            $("#id_submission_deadline").val("");
            $("#id_media_length").val("");
            $("#id_license").val("");
            $("#id_backing_amount").val("");
            $("#id_XDOreward").val("");
            $("#id_guarantee").val("");

        }

        function onAccountConnect(account) {
            const amount = parseInt($("#id_XDOreward").val()*1000000);     
            const guarantee = parseInt($("#id_guarantee").val()*$("#id_XDOreward").val()*10000);
            console.log(user_balance) 
            if(user_balance && amount <= user_balance*1000000){
            jQuery.ajax({
                url: ajaxurl,
                type: 'POST',
                data: {
                    action: 'submit_public_address',
                    public_address: selected_account,
                },
                success: async function(res) {
                      const response =  JSON.parse(res)
                      if(response['status']=='success'){
                          const uuid = response['result']
try {
        proccedToSave(signature.result,uuid)
                    } catch (error) {
                        console.error(error)
                    }



                      }

                      else if(response['status']=='failure'){
                         
                      }
                                      }
            })
            }
        }

    });
</script>

</div>