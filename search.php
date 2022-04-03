<?php
require "header.php";
?>
<div class="container mt-5">
    <h2>Search Results</h2>
    <hr>
    <div class="row mt-4">
        <?php
        if (empty($_POST['search'])) {
            header("location: index.php");
            die();
        } else {
            $searchKey = $_POST['search'];
        }

        $arts = $db->crud("SELECT * FROM articles WHERE description LIKE '%$searchKey%'", null, null, true);

        if (!empty($arts)) :
            foreach ($arts as $art) :
        ?>
                <div class="col-12 col-md-6">
                    <img src="./images/article_images/<?= $art->image ?>" class="mb-3 img-fluid">
                    <h4><?= $art->title ?></h4>
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
        <?php else : ?>
            <div class="text-center fs-1 " style="height: 43vh">
                <p class="mt-3 mt-sm-0"> NO ARTICLE</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php require "footer.php" ?>