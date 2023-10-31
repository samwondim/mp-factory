<section>    
    <form action="" method="POST" id="myForm">
        <label for="postdata">post body</label>
        <input type="text" name="postdata" id="post">
        <input type="button" value="submit" id="btn">
    </form>
</section>

<script>
    var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";

    const btn = document.querySelector('#btn');
    let content = document.getElementById('myForm');
    
    jQuery("#btn").click(async function(e) {
        e.preventDefault();

        var queryString = $("#myForm").serializeArray();

        jQuery.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                action: 'mp_add_post_action',
                post_data : queryString[0].value
            },
            success:  function(response) {
                console.log(response);
            },
            error: function () {
                console.log("error");
            }
        });
    });
    
</script>