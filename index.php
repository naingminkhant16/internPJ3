<?php require_once "header.php" ?>

<!-- Carousel Start -->
<section class="carousel-container" id="3">
    <div class="carousel slide" data-bs-ride="carousel" id="slide">
        <ol class="carousel-indicators">
            <li data-bs-target="#slide" data-bs-slide-to="0" class="active"></li>
            <li data-bs-target="#slide" data-bs-slide-to="1"></li>
            <li data-bs-target="#slide" data-bs-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="slide1">
                    <div class="carousel-caption">
                        <h3 class="">Don't miss anything related with Rose`!</h3>
                        <div class="p-3">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere, quasi.
                        </div>
                    </div>
                </div>
            </div>

            <div class="carousel-item">
                <div class="slide2 w-100">
                    <div class="carousel-caption">
                        <h3 class="">Who is the Real MVP?</h3>
                        <div class="p-3">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere, quasi.
                        </div>
                    </div>
                </div>
            </div>

            <div class="carousel-item">
                <div class="slide3 w-100">
                    <div class="carousel-caption">
                        <h3 class="">Inspiration of Youth</h3>
                        <div class="p-3">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere, quasi.
                        </div>
                    </div>
                </div>
            </div>
            <a href="#slide" class="carousel-control-prev" data-bs-slide="prev">
                <span class="carousel-control-prev-icon move"></span>
            </a>
            <a href="#slide" class="carousel-control-next" data-bs-slide="next">
                <span class="carousel-control-next-icon move"></span>
            </a>
        </div>
</section>
<!-- <div class="bg img-fluid" style="background-image:url('./images/ab.jpg')">
    <div class="bg-text">
        <h3>LATEST, TRENDING AND RELIABLE NEWS SITE</h3>
    </div>
</div> -->
<!-- Carousel End -->

<!--categories-->

<div class="container mt-5" id="categories">

    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="row ">
                <?php
                $cats = $db->crud("SELECT * FROM categories", null, null, true);
                foreach ($cats as $cat) :
                ?>
                    <div class="col-12 col-lg-6">
                        <div class="d-flex w-10 justify-content-between">
                            <h5 class="mb-1 mt-3"><?= $cat->name ?>
                                <hr style="color:red;">
                            </h5>
                            <a href="category.php?cat_id=<?= $cat->id ?>" class="mt-3 text-decoration-none text-black"><small>VIEW ALL</small></a>
                        </div>
                        <?php
                        $b_art = $db->crud("SELECT * FROM articles WHERE category_id=:cat_id ORDER BY created_at desc LIMIT 1 ", [':cat_id' => $cat->id], true);
                        ?>
                        <img src="./images/article_images/<?= $b_art->image ?>" class="mb-3 img-fluid">
                        <h4><a href="art_detail.php?art_id=<?= $b_art->id ?>" class="text-decoration-none text-dark"><?= $b_art->title ?></a></h4>
                        <span class="badge bg-dark rounded-pill p-2 mb-2">
                            <?php
                            $cat_name = $db->crud("SELECT name FROM categories WHERE id=$b_art->category_id", null, true);
                            echo $cat_name->name;
                            ?>
                        </span> |
                        <small><?= date('l, F d ,y ', strtotime($b_art->created_at)) ?></small>
                        <p><?= substr($b_art->description, 0, 300) ?> &nbsp;<a href="art_detail.php?art_id=<?= $b_art->id ?>" class="text-muted text-decoration-none" style="font-size:small">Read more...</a></p>
                        <h5 class="text-muted" style="font-size: 16px;">Related Aritcles :</h5>
                        <?php
                        $related_arts = $db->crud("SELECT * FROM articles WHERE category_id=:cat_id ORDER BY created_at LIMIT 2 ", [':cat_id' => $cat->id], null, true);
                        ?>
                        <div class="owl1 owl-carousel mt-3">
                            <?php
                            foreach ($related_arts as $art) :
                            ?>
                                <div id="art-img-container"> <img class="art-img img-fluid" width="100%" src="./images/article_images/<?= $art->image ?>">
                                    <a class="middle" href="art_detail.php?art_id=<?= $art->id ?>">
                                        <div class="text">
                                            <p><?= $art->title ?></p>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <!-- latest  -->
        <div class="col-12 col-lg-4">
            <!-- <div class="col-12 col-lg-4 mt-5"> -->
            <div style="padding: 10px;">
                <div class="d-flex w-10 justify-content-center">
                    <h5 class="mb-1">LATEST
                        <hr style="color: red;">
                    </h5>
                </div>
                <?php
                $latest_arts = $db->crud("SELECT * FROM articles ORDER BY created_at desc LIMIT 5", null, null, true);
                foreach ($latest_arts as $l_art) :
                ?>
                    <div class="mb-4">
                        <a href="art_detail.php?art_id=<?= $l_art->id ?>" class="text-decoration-none text-black">
                            <h6><?= $l_art->title ?></h6>
                            <img src="./images/article_images/<?= $l_art->image ?>" class="img-fluid" alt="">
                        </a>
                    </div>
                <?php endforeach; ?>

                <div class="d-flex w-10 justify-content-center">
                    <h5 class="mb-1">FOLLOW US ON
                        <hr style="color: red;">
                    </h5>
                </div>
                <div class="container d-flex justify-content-around fs-2">
                    <a href=""><i class="fa-brands fa-facebook-square" style="color:#3B5998"></i></a>
                    <a href=""><i class="fa-brands fa-youtube" style="color:#bb0000"></i></a>
                    <a href=""><i class="fa-brands fa-linkedin" style="color:#007bb5"></i></a>
                    <a href=""><i class="fa-brands fa-pinterest-square" style="color:#cb2027"></i></a>
                    <a href=""><i class="fa-brands fa-twitter-square" style="color:#55ACEE"></i></a>
                </div>
            </div>

            <!-- </div> -->
        </div>
    </div>



</div><br>
<!-- Information End -->

<?php require "footer.php" ?>