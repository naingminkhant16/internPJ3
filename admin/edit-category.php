<?php require_once "header.php" ?>
<?php
$id = $_GET['id'];
$cat = new DB();
$cat = $cat->crud("SELECT * FROM categories WHERE id=:id", [':id' => $id], true);
$uiErr = [];

if (!empty($_POST)) {
    //check change psw or not
    (!isEmptyInput($_POST)) ? $db = new DB() : $err = isEmptyInput($_POST);
    if (isset($db) && empty($err)) {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $updated_at = $_POST['updated_at'];

        $query = "UPDATE categories SET name=:name,description=:description,updated_at=:updated_at WHERE id=:id";
        $data = [
            ":name" => $name,
            ":description" => $description,
            ":updated_at" => $updated_at,
            ":id" => $id
        ];
        $result = $db->crud($query, $data);

        if ($result) {
            echo "<script>alert('Successfully Updated Category');window.location.href='category.php'</script>";
            die();
        }
    } else {
        //found empty input fileds and make ui error message
        $findErrArr = ['name', "description", 'updated_at'];
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
    <h1 class="h2">Edit Category</h1>
</div>

<form action="" method="POST" style="max-width: 500px;" class="container mt-4">

    <div class="mb-3">
        <label class="form-label">Name :</label>
        <p style="color:#EF1510"><?= isset($uiErr['name']) ? '*' . $uiErr['name'] : '' ?></p>
        <input type="text" name="name" class="form-control" value="<?= $cat->name ?>">
    </div>
    <div class="mb-4">
        <label class="form-label">Description :</label>
        <p style="color:#EF1510"><?= isset($uiErr['description']) ? '*' . $uiErr['description'] : '' ?></p>
        <textarea name="description" class="form-control" rows="5"><?= $cat->description ?></textarea>
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

<?php require_once "footer.php" ?>