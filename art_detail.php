<?php require "header.php" ?>
<?php
$art_id = $_GET['art_id'];
$art = $db->crud("SELECT * FROM articles WHERE id=:id", [':id' => $art_id], true);
?>

<section id="">
    <div class="bg img-fluid" style="background-image:url('./images/article_images/<?= $art->image ?>')">
        <div class="bg-text">
            <h3><?= $art->title ?></h3>
        </div>
    </div>

    <div class="container py-5 text-justify" style="max-width:800px">
        <?php $divideP = strlen($art->description) / 2; ?>
        <p>
            <?= substr($art->description, 0, $divideP) ?>
        </p>
        <p>
            <?= substr($art->description, $divideP) ?>
        </p>
    </div>
</section>


<!-- Articles Start -->
<?php require "owl-car-articles.php" ?>
<!-- Articles End -->

<!-- Footer Start -->
<?php require "footer.php" ?>