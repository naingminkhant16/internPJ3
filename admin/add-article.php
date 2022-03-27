<?php require_once "header.php" ?>
<?php

if (!empty($_POST)) {

    //check empty input fields
    (!isEmptyInput($_POST)) ? $db = new DB() : $err = isEmptyInput($_POST);
    if (isset($db) && empty($err)) {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $cat_id = $_POST['category'];
        $created_at = $_POST['created_at'];

        //image input filed
        if ($_FILES['image']['error'] == 0) {

            $path = "../images/article_images/" . $_FILES['image']['name'];
            $imageType = pathinfo($path, PATHINFO_EXTENSION);

            if ($imageType != 'jpg' && $imageType != 'jpeg' && $imageType != 'png') {
                echo "<script>alert('Invlaid image type');window.location.href='add-article.php'</script>";
                die();
            }
            //img type check success and start do query
            $query = "INSERT INTO articles(title,description,category_id,image,created_at) VALUES (:title,:description,:category_id,:image,:created_at)";
            $data = [
                ":title" => $title,
                ":description" => $description,
                ":category_id" => $cat_id,
                ":image" => $_FILES['image']['name'],
                ":created_at" => $created_at
            ];
            $result = $db->crud($query, $data);
            move_uploaded_file($_FILES['image']['tmp_name'], $path);
            if ($result) {
                echo "<script>alert('Successfully Created Article.');window.location.href='index.php'</script>";
            } else {
                echo "<script>alert('Failed to create article!');window.location.href='add-article.php'</script>";
            }
        } else {
            $imgErr = "Image is required!";
        }
    } else {
        //found empty input fileds and make ui error message
        $findErrArr = ['title', "description", "category", "image", 'created_at'];
        $err = explode(',', $err);

        $uiErr = [];
        foreach ($findErrArr as $findErr) {
            if (in_array($findErr, $err)) {
                $uiErr[$findErr] = $findErr . " is required!";
            }
        }
    }
}
?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Create New Article</h1>
</div>

<form action="" method="POST" style="max-width: 500px;" class="container mt-4" enctype="multipart/form-data">
    <?php if (isset($catNameDuplicatedErr)) : ?>
        <div class="alert alert-warning">
            <i class="fa-solid fa-triangle-exclamation pe-2"></i>
            <?= $catNameDuplicatedErr ?>
        </div>
    <?php endif; ?>

    <div class="mb-3">
        <label class="form-label">Title :</label>
        <p style="color:#EF1510"><?= isset($uiErr['title']) ? '*' . $uiErr['title'] : '' ?></p>
        <input type="text" name="title" class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">Description :</label>
        <p style="color:#EF1510"><?= isset($uiErr['description']) ? '*' . $uiErr['description'] : '' ?></p>
        <textarea name="description" class="form-control" rows="5"></textarea>

    </div>
    <div class="mb-3">
        <label class="form-label">Category :</label>
        <p style="color:#EF1510"><?= isset($uiErr['category']) ? '*' . $uiErr['category'] : '' ?></p>
        <select class="form-select" name="category">

            <?php
            $cats = new DB();
            $cats = $cats->crud("SELECT * FROM categories", null, null, true);

            foreach ($cats as $cat) :
            ?>
                <option value="<?= $cat->id ?>"><?= $cat->name ?></option>
            <?php endforeach; ?>

        </select>
    </div>
    <div class="mb-4">
        <label class="form-label">Image :</label>
        <p style="color:#EF1510"><?= isset($imgErr) ? '*' . $imgErr : '' ?></p>
        <input type="file" name="image" class="form-control">
    </div>
    <div class="mb-4">
        <label class="form-label">Created At :</label>
        <p style="color:#EF1510"><?= isset($uiErr['created_at']) ? '*' . $uiErr['created_at'] : '' ?></p>
        <input type="date" name="created_at" class="form-control">
    </div>

    <div class="mb-3">
        <button class="btn btn-outline-dark w-100" type="submit">Create</button>
    </div>
</form>

<?php require_once "footer.php" ?>