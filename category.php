<?php require "header.php" ?>
<?php
if (empty($_GET['cat_id'])) {
  header("Location: index.php#categories");
  die();
};
$cat_id = $_GET['cat_id'];
?>

<div class="container my-5">
  <div class="d-flex w-10 justify-content-between">
    <h3 class=""><?php
                  $title = $db->crud("SELECT * FROM categories WHERE id=:id", [':id' => $cat_id], true);
                  echo $title->name;
                  ?>
      <hr style="color:red;">
    </h3>
  </div>
  <div class="row">
    <?php
    $arts = $db->crud("SELECT * FROM articles WHERE category_id=:cat_id", [":cat_id" => $cat_id], null, true);

    foreach ($arts as $art) :
    ?>
      <div class="col-12 col-md-6">
        <img src="./images/article_images/<?= $art->image ?>" class="mb-3 img-fluid">
        <h4><a href="art_detail.php?art_id=<?= $art->id ?>" class="text-decoration-none text-dark"><?= $art->title ?></a></h4>
        <span class="badge bg-dark rounded-pill p-2 mb-2">
          <?php
          $art_name = $db->crud("SELECT name FROM categories WHERE id=$art->category_id", null, true);
          echo $art_name->name;
          ?>
        </span> |
        <small><?= date('l, F d ,y ', strtotime($art->created_at)) ?></small>
        <p><?= substr($art->description, 0, 300) ?> &nbsp;<a href="art_detail.php?art_id=<?= $art->id ?>" class="text-muted text-decoration-none" style="font-size:small">Read more...</a></p>
      </div>
    <?php endforeach; ?>
  </div>

</div>
</div>

<!-- owl carousel -->
<?php require "owl-car-articles.php" ?>


<!-- Categories Start -->
<!-- <div class="container">
  <div class="row">
    <div class="col-sm">
      <div class="d-flex w-10 justify-content-between">
        <h5 class="mb-1 mt-3">FASHION
          <hr style="color:red;">
        </h5>
        <a href="#" class="mt-3"><small>VIEW ALL</small></a>
      </div>

      <img src="./Images/fashion 1.jpg" alt="">
      <h4>Biggest Designer show in New York</h4>
      <small>March 1 ,2022 | Fashion</small>
      <p class="mt-3">
        Spring is coming...it's time to update our makeup bags with the latest beauty launches.Nordstrom is brining
        the biggest trends from New YOrk Fashion Week and showing us how to update our look in the Spring Beauty Trend
        Event.
      </p>


      <div class="row">
        <div class="col-lg-4 mb-2">
          <img src="./Images/couple.jpg" class="img-fluid" alt="">
        </div>
        <div class="col-lg-8">
          <h5>Best 10 Couple Outfits Ideas That You Should Know</h5>
          <small>Feb 22, 2022</small>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-4 mb-2">
          <img src="./Images/fitness.jpg" class="img-fluid" alt="">
        </div>
        <div class="col-lg-8">
          <h5>Reasons Why Fitness Fashion is Getting Popular</h5>
          <small>Feb 22, 2022</small>
        </div>
      </div>
    </div>

    <div class="col-sm">
      <div class="d-flex w-10 justify-content-between">
        <h5 class="mb-1 mt-3">TECHNOLOGY
          <hr style="color:red;">
        </h5>
        <a href="./technology.html" class="mt-3" style="float: left;"><small>VIEW ALL</small></a>
      </div>

      <img src="./Images/headphone.jpg" class="img-fluid" alt="">
      <h4>The 9 Best Headphones for Music Lovers</h4>
      <small>March 1 ,2022 | Fashion</small>
      <p class="mt-3">
        Spring is coming...it's time to update our makeup bags with the latest beauty launches.Nordstrom is brining
        the biggest trends from New YOrk Fashion Week and showing us how to update our look in the Spring Beauty Trend
        Event.
      </p>


      <div class="row">
        <div class="col-lg-4 mb-2">
          <img src="./Images/productivity.jpg" class="img-fluid" alt="">
        </div>
        <div class="col-lg-8">
          <h5>25 Tricks That Will Increase Your Productivity</h5>
          <small class="mb-2">Feb 22, 2022</small>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-4 mb-2">
          <img src="./Images/couple.jpg" class="img-fluid" alt="">
        </div>
        <div class="col-lg-8">
          <h5>Best 10 Couple Outfits Ideas That You Should Know</h5>
          <small>Feb 22, 2022</small>
        </div>
      </div>
    </div>


    <div class="col-sm">
      <div class="d-flex w-10 justify-content-center">
        <h5 class="mb-1 mt-3">FOLLOW US
          <hr style="color:red;">
        </h5>
      </div>

      <div id="icons" class="mt-3 text-center">
        <a href="" class="bi bi-google"></a>
        <a href="" class="bi bi-facebook"></a>
        <a href="" class="bi bi-twitter"></a>
        <a href="" class="bi bi-instagram"></a>
        <a href="" class="bi bi-linkedin"></a>
        <a href="" class="bi bi-youtube"></a>
        <a href="" class="bi bi-pinterest"></a>
      </div>

      <div class="d-flex w-10 justify-content-center">
        <h5 class="mb-1 mt-5">NEWEST
          <hr style="color: red;">
        </h5>
      </div>

      <div>
        <img src="./Images/fashion.jpg" alt="" class="img-fluid">
        <h5>15 Biggest Fashion Trends for Fall 2017</h5>
        <small class="mb-3">Feb 22, 2022 | Beauty</small>
      </div>

      <div>
        <img src="./Images/photo.jpg" alt="" class="img-fluid">
        <h5>Improve Your Photots With These Photography Tips</h5>
        <small class="mb-3">Feb 22, 2022 | Beauty</small>
      </div>
    </div>

    <div class="row">
      <div class="d-flex w-10 justify-content-between">
        <h5 class="mb-1 mt-3">SPORT
          <hr style="color:red;">
        </h5>
        <a href="#" class="mt-3"><small>VIEW ALL</small></a>
      </div>

      <div class="col-sm-4">
        <img src="./Images/photo.jpg" alt="" class="img-fluid">
      </div>
      <div class="col-sm-4">
        <img src="./Images/hiking.jpg" alt="" class="img-fluid">
      </div>

      <div class="col-sm-4">
        <img src="./Images/Rome.jpg" alt="" class="img-fluid">
        <h5>How to Get The Most Out of Your Rome Trip</h5>
        <small>Feb 22, 2022 | Travel</small>
      </div>

      <div class="col-sm-4">
        <img src="./Images/photo.jpg" alt="" class="img-fluid pb-3">
      </div>
      <div class="col-sm-4">
        <img src="./Images/hiking.jpg" alt="" class="img-fluid pb-3">
      </div>

      <div class="col-sm-4">
        <img src="./Images/fashion 1.jpg" alt="">

      </div>
    </div>

    <div class="row">
      <div class="d-flex w-10 justify-content-between">
        <h5 class="mb-1 mt-3">TECHNOLOGY
          <hr style="color:red;">
        </h5>
        <a href="#" class="mt-3"><small>VIEW ALL</small></a>
      </div>

      <div class="col-sm-2">
        <img src="./Images/productivity.jpg" alt="" class="img-fluid">
      </div>

      <div class="col-sm-6">
        <h5>25 Tricks That Will Increase Your Productivity</h5>
        <small>Feb 22, 2022 | Technology</small>
        <p>
          Far far away, behind the word mountain, far from the countries Vokalia and Consonantia, there live
          the blind texts. Separeated they live in Bookmarksgrove...
        </p>
      </div>

      <div class="col-lg-2">
        <img src="./Images/fashion 1.jpg" alt="" class="img-fluid">
        <h5>Biggest Designer Fashion Show in London</h5>
        <small>Feb 22, 2022</small>
      </div>

      <div class="col-lg-2">
        <img src="./Images/couple.jpg" alt="" class="img-fluid">
        <h5>Best 100 Couple Outfits Ideas That You Should Know</h5>
        <small>Feb 22, 2022</small>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-2">
        <img src="./Images/productivity.jpg" alt="" class="img-fluid">
      </div>

      <div class="col-sm-6">
        <h5>25 Tricks That Will Increase Your Productivity</h5>
        <small>Feb 22, 2022 | Technology</small>
        <p>
          Far far away, behind the word mountain, far from the countries Vokalia and Consonantia, there live
          the blind texts. Separeated they live in Bookmarksgrove...
        </p>
      </div>

      <div class="col-lg-2 p-3">
        <img src="./Images/fitness.jpg" alt="" class="img-fluid">
        <h5>Reasons Why Fitness Fashion is Getting Popular</h5>
        <small>Feb 22, 2022</small>
      </div>

      <div class="col-lg-2 p-3">
        <img src="./Images/fashion.jpg" alt="" class="img-fluid">
        <h5>15 Biggest Fashion Trends for Fall 2017</h5>
        <small>Feb 22, 2022</small>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-2">
        <img src="./Images/productivity.jpg" alt="" class="img-fluid">
      </div>

      <div class="col-sm-6">
        <h5>25 Tricks That Will Increase Your Productivity</h5>
        <small>Feb 22, 2022 | Technology</small>
        <p>
          Far far away, behind the word mountain, far from the countries Vokalia and Consonantia, there live
          the blind texts. Separeated they live in Bookmarksgrove...
        </p>
      </div>

      <div class="col-lg-2 p-3">
        <img src="./Images/fashion 1.jpg" alt="" class="img-fluid">
        <h5>Biggest Designer Fashion Show in London</h5>
        <small>Feb 22, 2022</small>
      </div>

      <div class="col-lg-2 p-3">
        <img src="./Images/couple.jpg" alt="" class="img-fluid">
        <h5>Best 100 Couple Outfits Ideas That You Should Know</h5>
        <small>Feb 22, 2022</small>
      </div>
    </div>
  </div>
</div>
</div> -->
<!-- Categories End -->

<!-- Footer Start -->
<?php require "footer.php" ?>