<!DOCTYPE html>
<html>
<head>
    <title>Captcha implement in CodeIgniter by CodexWorld</title>
    <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
    <script>
    $(document).ready(function(){
        $('.refreshCaptcha').on('click', function(){
            $.get('<?php echo base_url().'captcha/refresh'; ?>', function(data){
                $('#captImg').html(data);
            });
        });
    });
    </script>
</head>
<body>
    <p>Submit the word you see below:</p>
    <p id="captImg"><?php echo $captcha_img; ?></p>
    <!-- <a href="javascript:void(0);" class="refreshCaptcha" ><img src="<?php// echo base_url().'assets/images/refresh.png'; ?>"/></a> -->
    <form method="post" action="<?php echo base_url(); ?>login/check">
        <input type="text" name="captcha" value=""/>
        <input type="submit" name="submit" value="SUBMIT"/>
    </form>
</body>
</html>