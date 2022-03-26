<?php require_once "header.php" ?>
<?php
if (!empty($_POST)) {
    //check empty input fields
    (!isEmptyInput($_POST)) ? $db = new DB() : $err = isEmptyInput($_POST);
    if (isset($db) && empty($err)) {
        //check email duplicated
        $emailDuplicated = $db->checkEmailExist($_POST['email']);

        if (!$emailDuplicated) {
            //check password length
            if (strlen(trim($_POST['password'])) < 6) {
                $pswLengthErr = "Password must have atleast 6 characters";
            } elseif ($_POST['password'] !== $_POST['confirm_password']) {
                //check password match 
                $pswMatchErr = "Password doesn't match!";
            } else {
                $data = [
                    ":name" => $_POST['name'],
                    ":email" => $_POST['email'],
                    ":password" => password_hash($_POST['password'], PASSWORD_DEFAULT)
                ];
                $result = $db->crud("INSERT INTO admins(name,email,password) VALUES (:name,:email,:password)", $data);

                if ($result) {
                    echo "<script>alert('New Admin Successfully Created.');window.location.href='admin.php'</script>";
                    die();
                }
                die();
            }
        } else {
            $emailDuplicatedErr = "Email already exist!";
        }
    } else {
        //found empty input fileds and make ui error message
        $findErrArr = ['name', 'email', "password", "confirm_password"];
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
    <h1 class="h2">Create New Admin</h1>
</div>

<form action="" method="POST" style="max-width: 500px;" class="container mt-4">
    <?php if ($emailDuplicatedErr) : ?>
        <div class="alert alert-warning">
            <i class="fa-solid fa-triangle-exclamation pe-2"></i>
            <?= $emailDuplicatedErr ?>
        </div>
    <?php endif; ?>
    <?php if ($pswLengthErr) : ?>
        <div class="alert alert-warning">
            <i class="fa-solid fa-triangle-exclamation pe-2"></i>
            <?= $pswLengthErr ?>
        </div>
    <?php endif; ?>
    <?php if ($pswMatchErr) : ?>
        <div class="alert alert-warning">
            <i class="fa-solid fa-triangle-exclamation pe-2"></i>
            <?= $pswMatchErr ?>
        </div>
    <?php endif; ?>
    <div class="mb-3">
        <label class="form-label">Name :</label>
        <p style="color:#EF1510"><?= isset($uiErr['name']) ? '*' . $uiErr['name'] : '' ?></p>
        <input type="text" name="name" class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">Email :</label>
        <p style="color:#EF1510"><?= isset($uiErr['email']) ? '*' . $uiErr['email'] : '' ?></p>
        <input type="email" name="email" class="form-control">
    </div>
    <div class="mb-4">
        <label class="form-label">Password :</label>
        <p style="color:#EF1510"><?= isset($uiErr['password']) ? '*' . $uiErr['password'] : '' ?></p>
        <input type="password" name="password" class="form-control">
    </div>
    <div class="mb-4">
        <label class="form-label">Confrim Password :</label>
        <p style="color:#EF1510"><?= isset($uiErr['confirm_password']) ? '*' . $uiErr['confirm_password'] : '' ?></p>
        <input type="password" name="confirm_password" class="form-control">
    </div>
    <div class="mb-3">
        <button class="btn btn-outline-dark w-100">Submit</button>
    </div>
</form>

<?php require_once "footer.php" ?>