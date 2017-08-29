
<div class="container">
    <br><br><br>
    <h2>List of Job Openings</h2>
    <p><i>Look for these following job openings and be one of us now!</i></p><br>
    <?php foreach($order_det as $order) {?>
    <div class="jumbotron">
        <h3 class="upper"><?php echo $order->jname;?></h3>
        <p><?php echo $order->description; ?></p>
        <p><a href="<?php echo base_url(); ?>home/job_ad_full/<?php echo $order->order_id?>">See more...</a></p>
    </div>
    <?php } ?>
</div>
</body>
</html>