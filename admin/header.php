<?php
session_start();
if (empty($_SESSION['admin']) || empty($_SESSION['loggedin'])) {
    header("location: login.php");
    die();
}
require_once "../config/DB.php";
require_once "../config/functions.php";
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
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="index.php">GOOD VIDE | (<?= $_SESSION['admin']['name'] ?>)</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <form action="" class="w-100">
            <div class="input-group input-group-sm">
                <input type="search" name="search" class="form-control form-control-dark" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-dark" type="submit"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </form>

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
                        <span class="list-group-item disabled d-none d-lg-block">
                            <small>CONTROLS</small>
                        </span>
                        <a href="index.php" class="list-group-item list-group-item-action ">
                            <i class="fa-solid fa-newspaper"></i>
                            <span class="">Articles</span>
                            <?php
                            $numOfarts = new DB();
                            $numOfarts = $numOfarts->crud("SELECT * FROM articles", null, null, true);
                            ?>
                            <span class=" badge bg-danger rounded-pill float-end"><?= count($numOfarts) ?></span>
                        </a>
                        <a href="admin.php" class="list-group-item list-group-item-action">
                            <i class="fas fa-users"></i>
                            <span class="">Admins</span>
                            <?php
                            $numOfadmins = new DB();
                            $numOfadmins = $numOfadmins->crud("SELECT * FROM admins", null, null, true);
                            ?>
                            <span class=" badge bg-danger rounded-pill float-end"><?= count($numOfadmins) ?></span>
                        </a>
                        <a href="category.php" class="list-group-item list-group-item-action">
                            <i class="fa-solid fa-table"></i>
                            <span class="">Categories</span>
                            <?php
                            $numOfcats = new DB();
                            $numOfcats = $numOfcats->crud("SELECT * FROM categories", null, null, true);
                            ?>
                            <span class=" badge bg-danger rounded-pill float-end"><?= count($numOfcats) ?></span>
                        </a>
                        <!-- <a href="#" class="list-group-item list-group-item-action">
                            <i class="fas fa-flag"></i>
                            <span class="">Reports</span>
                        </a> -->
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