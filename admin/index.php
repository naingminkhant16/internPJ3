<?php require "header.php" ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Articles Dashboard</h1>
  <div class="d-flex">
    <?php
    $cats = $db->crud("SELECT * FROM categories", null, null, true);
    foreach ($cats as $cat) :
    ?>
      <a href="index.php?cat_id=<?= $cat->id ?>" class="me-3 p-2 text-decoration-none text-light badge bg-dark rounded-pill"><?= $cat->name ?></a>
    <?php endforeach; ?>
  </div>
</div>
<div class="container">
  <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
    <?php

    if (!empty($_POST['search'])) {

      $searchKey = $_POST['search'];
      $articles = $db->crud("SELECT * FROM articles WHERE description LIKE '%$searchKey%' ORDER BY created_at desc", null, null, true);
    } elseif (!empty($_GET['cat_id'])) {

      $cat_id = $_GET['cat_id'];
      $articles = $db->crud("SELECT * FROM articles WHERE category_id=:cat_id", [':cat_id' => $cat_id], null, true);
    } else {

      $articles = $db->crud("SELECT * FROM articles ORDER BY created_at desc", null, null, true);
    }
    if ($articles) :
      foreach ($articles as $article) :
    ?>
        <div class="col">
          <div class="card">
            <div class="card-body">
              <img src="../images/article_images/<?= $article->image ?>" class="card-img-top mb-4 w-100"><br>
              <span class="badge rounded-pill bg-secondary text-light p-2 mb-2"><?php
                                                                                $cat = $db->crud("SELECT * FROM categories WHERE id=:id", [':id' => $article->category_id], true);
                                                                                echo $cat->name
                                                                                ?></span>
              <h5 class="card-title"><?= $article->title ?></h3>
                <p class="card-text scroll"><?= $article->description ?></p>
                <a href="edit-article.php?id=<?= $article->id ?>" class="btn btn-sm btn-outline-dark">Edit</a>
                <a href="delete-article.php?id=<?= $article->id ?>" onclick="return confirm('Are you sure you want to delete?')" class="btn btn-sm btn-outline-danger">Delete</a>
            </div>
          </div>
        </div>
    <?php endforeach;
    endif; ?>
  </div>
</div>
<?php require "footer.php" ?>