<?php
require_once "inc/header.php";
$articles = Posts::all();
?>

<div class="card card-dark">
    <div class="card-body">
        <a href="<?php echo $articles['prev_page'] ?>" class="btn btn-danger">Prev Posts</a>
        <a href="<?php echo $articles['next_page'] ?>" class="btn btn-danger float-right">Next Posts</a>
    </div>
</div>
<div class="card card-dark">
    <div class="card-body">
        <div class="row">
            <!-- Loop this -->
            <?php
            // echo "<pre>";
            // print_r($articles);

            foreach ($articles['data'] as $a) {

            ?>
                <div class="col-md-4 mt-2">
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="https://pixinvent.com/demo/vuexy-vuejs-admin-dashboard-template/demo-1/img/content-img-1.228da091.jpg" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="text-dark">
                                <?php echo  $a->title; ?>
                            </h5>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-4 text-center">
                                    <i class="fas fa-heart text-warning">
                                    </i>
                                    <small class="text-muted"> <?php echo  $a->like_count; ?></small>
                                </div>
                                <div class="col-md-4 text-center">
                                    <i class="far fa-comment text-dark"></i>
                                    <small class="text-muted"><?php echo  $a->comment_count; ?></small>
                                </div>
                                <div class="col-md-4 text-center">
                                    <a href="<?php echo "detail.php?slug=$a->slug"; ?>" class="badge badge-warning p-1">View</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            <?php
            }
            ?>

        </div>
    </div>
</div>

<?php
require_once "inc/footer.php";
?>