<?php
session_start();
if (empty($_SESSION['admin']) || empty($_SESSION['loggedin'])) {
    header("location: login.php");
    die();
}
require_once "../config/DB.php";
require_once "../config/functions.php";
$db = new DB();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>GOOD VIDE | ADMIN</title>

    <!-- <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/dashboard/"> -->

    <!-- Bootstrap core CSS -->
    <link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- font awesome  -->
    <link rel="stylesheet" href="../node_modules/@fortawesome/fontawesome-free/css/fontawesome.min.css">
    <link rel="stylesheet" href="../node_modules/@fortawesome/fontawesome-free/css/all.min.css">
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
    <link href="css/dashboard.css" rel="stylesheet">
</head>

<body>

    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="index.php">GOOD VIDE</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- search form -->
        <?php
        $link = $_SERVER['PHP_SELF'];
        $linkArr = explode('/', $link);
        $page = end($linkArr);
        $search_include_pages = ['category.php', 'admin.php', 'index.php', 'mail.php']
        ?>
        <?php if (in_array($page, $search_include_pages)) : ?>
            <form action="<?php
                            if ($page == 'category.php') echo "category.php";
                            elseif ($page == 'admin.php') echo "admin.php";
                            elseif ($page == 'index.php') echo "index.php";
                            ?>" method="POST" class="w-100">
                <div class="input-group input-group-sm">
                    <input type="search" name="search" class="form-control form-control-dark" placeholder="Search" aria-label="Search">
                    <!-- <div class="input-group-append">
                        <button class="btn btn-dark" type="submit"><i class="fas fa-search"></i></button>
                    </div> -->
                </div>
            </form>
        <?php else : ?>

            <div class="flex-fill w-100 bg-dark"></div>
        <?php endif; ?>
        <div class="navbar-nav">
            <div class="nav-item text-nowrap">
                <a class="nav-link px-3" href="logout.php"><i class="fa-solid fa-right-from-bracket"></i>Sign out</a>
            </div>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky p-3">

                    <div class="list-group text-center text-lg-start">
                        <span class="list-group-item disabled d-lg-block">
                            <small>ADMIN</small>
                        </span>
                        <a href="edit-profile.php?id=<?= $_SESSION['admin']['id'] ?>" class="list-group-item list-group-item-action">
                            <i class="fa-solid fa-user-shield"></i>
                            <?= $_SESSION['admin']['name'] ?>
                        </a>
                    </div>

                    <div class="list-group text-center text-lg-start mt-4">
                        <span class="list-group-item disabled d-none d-lg-block">
                            <small>CONTROLS</small>
                        </span>
                        <a href="index.php" class="list-group-item list-group-item-action ">
                            <i class="fa-solid fa-newspaper"></i>
                            <span class="">Articles</span>
                            <?php
                            $numOfarts = $db->crud("SELECT * FROM articles", null, null, true);
                            ?>
                            <span class=" badge bg-danger rounded-pill float-end"><?= count($numOfarts) ?></span>
                        </a>
                        <a href="admin.php" class="list-group-item list-group-item-action">
                            <i class="fas fa-users"></i>
                            <span class="">Admins</span>
                            <?php
                            $numOfadmins = $db->crud("SELECT * FROM admins", null, null, true);
                            ?>
                            <span class=" badge bg-danger rounded-pill float-end"><?= count($numOfadmins) ?></span>
                        </a>
                        <a href="category.php" class="list-group-item list-group-item-action">
                            <i class="fa-solid fa-table"></i>
                            <span class="">Categories</span>
                            <?php
                            $numOfcats = $db->crud("SELECT * FROM categories", null, null, true);
                            ?>
                            <span class=" badge bg-danger rounded-pill float-end"><?= count($numOfcats) ?></span>
                        </a>
                        <a href="mail.php" class="list-group-item list-group-item-action">
                            <i class="fa-solid fa-envelope"></i>
                            <span class="">Mails</span>
                            <?php
                            $numOfmails = $db->crud("SELECT * FROM mails", null, null, true);
                            ?>
                            <span class=" badge bg-danger rounded-pill float-end"><?= count($numOfmails) ?></span>
                        </a>
                    </div>

                    <div class="list-group mt-4 text-center text-lg-start">
                        <span class="list-group-item disabled d-none d-lg-block">
                            <small>ACTIONS</small>
                        </span>
                        <a href="add-admin.php" class="list-group-item list-group-item-action">
                            <i class="fa-solid fa-user-plus"></i>
                            <span class="">Add Admin</span>
                        </a>
                        <a href="edit-profile.php?id=<?= $_SESSION['admin']['id'] ?>" class="list-group-item list-group-item-action">
                            <i class="fa-solid fa-user-pen"></i>
                            <span class="">Edit MyProfile</span>
                        </a>
                        <a href="add-article.php" class="list-group-item list-group-item-action">
                            <i class="fas fa-edit"></i>
                            <span class="">Write Article</span>
                        </a>
                        <a href="add-category.php" class="list-group-item list-group-item-action">
                            <i class="fa-regular fa-square-plus"></i>
                            <span class="">Create Category</span>
                        </a>
                    </div>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">