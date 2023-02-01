<?php
include_once "inc/header.php";

if (!isset($_GET['slug'])) {
    Helper::redirect("404.php");
} else {
    $slug = $_GET['slug'];
    $article =  Posts::detail($slug);
    // echo "<pre>";
    // print_r($article);
}
?>

<div class="card card-dark">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-dark">
                    <div class="card-body">
                        <div class="row">
                            <!-- icons -->
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-4 text-center">
                                        <i class="fas fa-heart text-warning">
                                        </i>
                                        <small class="text-muted">
                                            <?php echo $article->like_count; ?>
                                        </small>
                                    </div>
                                    <div class="col-md-4 text-center">
                                        <i class="far fa-comment text-dark"></i>
                                        <small class="text-muted"> <?php echo $article->comment_count; ?></small>
                                    </div>

                                </div>
                            </div>
                            <!-- Icons -->

                            <!-- Category -->
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="" class="badge badge-primary">
                                            <?php echo $article->category->name; ?>
                                        </a>

                                    </div>
                                </div>
                            </div>
                            <!-- Category -->


                            <!-- Languages -->
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <?php
                                        foreach ($article->languages as $l) {
                                        ?>
                                            <a href="" class="badge badge-success"><?php echo $l->name ?>
                                            </a>
                                        <?php
                                        }
                                        ?>


                                    </div>
                                </div>
                            </div>
                            <!-- Category -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="col-md-12">
            <h3><?php echo $article->title ?></h3>
            <p>
                <?php echo $article->description ?>
            </p>
        </div>

        <!-- Comments -->
        <div class="card card-dark w-100">
            <div class="card-header">
                <h4>Comments</h4>
            </div>
            <div class="card-body">
                <!-- Loop Comment -->
                <?php
                foreach ($article->comments as $c) {
                ?>
                    <div class="card-dark mt-1">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-1">
                                    <img src="https://s3.amazonaws.com/uifaces/faces/twitter/dancounsell/128.jpg" style="width:50px;border-radius:50%" alt="">
                                </div>
                                <div class="col-md-4 d-flex align-items-center">
                                    <?php echo DB::table("users")->where("id", $c->user_id)->getOne()->name; ?>
                                </div>
                            </div>
                            <hr>
                            <p><?php echo $c->comment ?></p>
                        </div>
                    </div>
                <?php
                }
                ?>


            </div>
        </div>
    </div>
</div>

<?php
include_once "inc/footer.php"
?>