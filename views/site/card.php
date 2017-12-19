<?php include ROOT . '/views/layout/header.php';?>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="well well-sm">
                <div class="row">
                    <div class="col-sm-6 col-md-8">
                        <h4><?php echo $info['name']?></h4>
                        <p>
                            <span class="glyphicon glyphicon-envelope"></span>Email:<?php echo $info['email'];?>
                            <br />
                            <span class="glyphicon glyphicon-map-marker"></span>Адресс: <?php echo $info['ter_address'];?></p>
                        <!-- Split button -->
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary" onclick="location.href='/';">
                                На главную</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include ROOT . '/views/layout/footer.php';?>
