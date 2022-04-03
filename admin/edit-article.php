<?php require_once "header.php" ?>
<?php
$id = $_GET['id'];

$article = $db->crud("SELECT * FROM articles WHERE id=:id", [':id' => $id], true);
$uiErr = [];

if (!empty($_POST)) {

    (!isEmptyInput($_POST)) ? $noErr = true : $err = isEmptyInput($_POST);
    if ($noErr && empty($err)) {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $category_id = $_POST['category'];
        $updated_at = $_POST['updated_at'];

        if ($_FILES['image']['error'] == 0) {
            //update image
            $path = "../images/article_images/" . $_FILES['image']['name'];
            $imageType = pathinfo($path, PATHINFO_EXTENSION);

            if ($imageType != 'jpg' && $imageType != 'jpeg' && $imageType != 'png') {
                echo "<script>alert('Invlaid image type');window.location.href='edit-article.php?id=" . $id . "'</script>";
                die();
            }
            $query = "UPDATE articles SET title=:title,description=:description,category_id=:category_id,image=:image,updated_at=:updated_at WHERE id=:id";
            $data = [
                ":title" => $title,
                ":description" => $description,
                ":category_id" => $category_id,
                ":image" => $_FILES['image']['name'],
                ":updated_at" => $updated_at,
                ":id" => $id
            ];
            $result = $db->crud($query, $data);
            move_uploaded_file($_FILES['image']['tmp_name'], $path);
            if ($result) {
                echo "<script>alert('Success fully updated aritcle.');window.location.href='index.php'</script>";
            }
        } else {
            //no image update
            $query = "UPDATE articles SET title=:title,description=:description,category_id=:category_id,updated_at=:updated_at WHERE id=:id";
            $data = [
                ":title" => $title,
                ":description" => $description,
                ":category_id" => $category_id,
                ":updated_at" => $updated_at,
                ":id" => $id
            ];
            $result = $db->crud($query, $data);
            if ($result) {
                echo "<script>alert('Success fully updated aritcle.');window.location.href='index.php'</script>";
            }
        }
    } else {
        //found empty input fileds and make ui error message
        $findErrArr = ['title', "description", "updated_at"];
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
    <h1 class="h2">Edit Article</h1>
</div>

<form action="" method="POST" style="max-width: 600px;" class="container mt-4 mb-4" enctype="multipart/form-data">

    <?php if ($currentPswErr) : ?>
        <div class="alert alert-warning">
            <i class="fa-solid fa-triangle-exclamation pe-2"></i>
            <?= $currentPswErr ?>
        </div>
    <?php endif; ?>

    <div class="mb-3">
        <label class="form-label">Title :</label>
        <p style="color:#EF1510"><?= isset($uiErr['title']) ? '*' . $uiErr['title'] : '' ?></p>
        <input type="text" name="title" class="form-control" value="<?= $article->title ?>">
    </div>
    <div class="mb-4">
        <label class="form-label">Description :</label>
        <p style="color:#EF1510"><?= isset($uiErr['description']) ? '*' . $uiErr['description'] : '' ?></p>
        <textarea name="description" rows="6" class="form-control"><?= $article->description ?></textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Category :</label>
        <p style="color:#EF1510"><?= isset($uiErr['category']) ? '*' . $uiErr['category'] : '' ?></p>
        <select class="form-select" name="category">

            <?php
            $cats = $db->crud("SELECT * FROM categories", null, null, true);

            foreach ($cats as $cat) :
            ?>
                <option value="<?= $cat->id ?>" <?= ($cat->id == $article->category_id) ? "selected" : '' ?>><?= $cat->name ?></option>
            <?php endforeach; ?>

        </select>
    </div>
    <div class="mb-4">
        <label class="form-label">Image :</label>
        <p style="color:#EF1510"><?= isset($uiErr['image']) ? '*' . $uiErr['image'] : '' ?></p>
        <img src="../images/article_images/<?= $article->image ?>" class="img-fluid">
        <input type="file" name="image" class="form-control">
    </div>
    <div class="mb-4">
        <label class="form-label">Updated At :</label>
        <p style="color:#EF1510"><?= isset($uiErr['updated_at']) ? '*' . $uiErr['updated_at'] : '' ?></p>
        <input type="date" name="updated_at" class="form-control">
    </div>
    <div class="mb-3">
        <button class="btn btn-outline-dark w-100" type="submit">Submit</button>
    </div>
</form>
<a href="index.php" class="btn btn-sm btn-outline-dark">Back</a>
<?php require_once "footer.php" ?>