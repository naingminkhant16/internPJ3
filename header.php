<?php
session_start();
require_once "./config/DB.php";
require_once "./config/functions.php";
$db = new DB();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <!-- bootstrap css  -->
    <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <!-- CSS Links -->
    <link rel="stylesheet" href="./CSS/main.css">
    <link rel="stylesheet" href="./CSS/carousel.css">
    <link rel="stylesheet" href="./CSS/footer.css">

    <!-- owl carousel  -->
    <link rel="stylesheet" href="./OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="./OwlCarousel2-2.3.4/dist/assets/owl.theme.default.min.css">

    <!-- font awesome  -->
    <link rel="stylesheet" href="./node_modules/@fortawesome/fontawesome-free/css/fontawesome.min.css">
    <link rel="stylesheet" href="./node_modules/@fortawesome/fontawesome-free/css/all.min.css">
</head>

<body>
    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top shadow">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php"><img src="./Images/logo.png" alt="" height="50"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 px-5 text-center">
                    <?php

                    $last = $_SERVER["PHP_SELF"];
                    ?>
                    <li class="nav-item">
                        <a class="nav-link px-4 <?php if ($last == '/index.php') echo "active" ?>" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?php if ($last == '/category.php') echo "active" ?>" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="">Categories</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php
                            $cats = $db->crud("SELECT * FROM categories", null, null, true);
                            foreach ($cats as $cat) :
                            ?>
                                <li><a class="dropdown-item" href="./category.php?cat_id=<?= $cat->id ?>"><?= $cat->name ?></a></li>
                            <?php
                            endforeach;
                            ?>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-4 <?php if ($last == '/about.php') echo "active" ?>" href="./about.php">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-4 <?php if ($last == '/contact.php') echo "active" ?>" href="./contact.php">Contact Us</a>
                    </li>
                </ul>

                <!-- search form -->
                <?php
                $link = $_SERVER['PHP_SELF'];
                $linkArr = explode('/', $link);
                $page = end($linkArr);
                ?>
                <form class="d-flex" action="search.php" method="POST">
                    <input class="form-control me-2" type="text" name="search" placeholder="Search Articles" aria-label="Search">
                    <button class="btn btn-outline-dark" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->