<?php require_once "header.php" ?>
<?php
if (!empty($_POST)) {
    //check empty input fields
    (!isEmptyInput($_POST)) ? $db = new DB() : $err = isEmptyInput($_POST);
    if (isset($db) && empty($err)) {
        $name = $_POST['name'];
        $created_at = $_POST['created_at'];
        $description = $_POST['description'];
        $catNameDuplicated =  $db->crud("SELECT * FROM categories WHERE name=:name", [':name' => $name], true);

        if (!$catNameDuplicated) {
            $query = "INSERT INTO categories(name,description,created_at) VALUES (:name,:description,:created_at)";
            $data = [
                ":name" => $name,
                ":description" => $description,
                ":created_at" => $created_at
            ];
            $result = $db->crud($query, $data);

            if ($result) {
                echo "<script>alert('Successfully Created New Category');window.location.href='category.php'</script>";
                die();
            }
        } else {
            $catNameDuplicatedErr = "Category Name is already exist!";
        }
    } else {
        //found empty input fileds and make ui error message
        $findErrArr = ['name', "description", 'created_at'];
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
    <h1 class="h2">Create New Category</h1>
</div>

<form action="" method="POST" style="max-width: 500px;" class="container mt-4">
    <?php if (isset($catNameDuplicatedErr)) : ?>
        <div class="alert alert-warning">
            <i class="fa-solid fa-triangle-exclamation pe-2"></i>
            <?= $catNameDuplicatedErr ?>
        </div>
    <?php endif; ?>

    <div class="mb-3">
        <label class="form-label">Name :</label>
        <p style="color:#EF1510"><?= isset($uiErr['name']) ? '*' . $uiErr['name'] : '' ?></p>
        <input type="text" name="name" class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">Description :</label>
        <p style="color:#EF1510"><?= isset($uiErr['description']) ? '*' . $uiErr['description'] : '' ?></p>
        <textarea name="description" class="form-control" rows="5"></textarea>

    </div>
    <div class="mb-4">
        <label class="form-label">Created At :</label>
        <p style="color:#EF1510"><?= isset($uiErr['created_at']) ? '*' . $uiErr['created_at'] : '' ?></p>
        <input type="date" name="created_at" class="form-control">
    </div>

    <div class="mb-3">
        <button class="btn btn-outline-dark w-100" type="submit">Submit</button>
    </div>
</form>

<?php require_once "footer.php" ?>