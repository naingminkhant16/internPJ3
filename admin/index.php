<?php require "header.php" ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Articles Dashboard</h1>
</div>
<div class="container">
  <div class="row row-cols-3">
    <?php
    $articles = new DB();
    $articles = $articles->crud("SELECT * FROM articles", null, null, true);
    foreach ($articles as $article) :
    ?>
      <div class="col">
        <div class="card">
          <div class="card-body">
            <img src="../images/article_images/<?= $article->image ?>" class="card-img-top mb-4 w-100"><br>
            <span class="badge rounded-pill bg-secondary text-light p-2 mb-2"><?php
                                                                              $cat = new DB();
                                                                              $cat = $cat->crud("SELECT * FROM categories WHERE id=:id", [':id' => $article->category_id], true);
                                                                              echo $cat->name
                                                                              ?></span>
            <h5 class="card-title"><?= $article->title ?></h3>
              <p class="card-text scroll"><?= $article->description ?></p>
              <a href="edit-article.php?id=<?= $article->id ?>" class="btn btn-sm btn-outline-dark">Edit</a>
              <a href="delete-article.php?id=<?= $article->id ?>" onclick="return confirm('Are you sure you want to delete?')" class="btn btn-sm btn-outline-danger">Delete</a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>
<?php require "footer.php" ?>