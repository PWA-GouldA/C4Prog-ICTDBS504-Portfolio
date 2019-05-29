<?php
/**
 * Header
 *
 * Header content for our pages
 *
 * @author      Adrian Gould <adrian.gould@nmtafe.wa.edu.au>
 * @file        header.php
 * @version     1.0
 * @created     2019-05-07
 * @copyright   This work is licensed under Creative Commons
 *              Attribution-ShareAlike 3.0 Australia License.
 */

// If no session started, then start one
if (!session_id()) {
    session_start();
}
require_once "vendor/autoload.php";

?>
<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <!-- Bootstrap CSS file included -->
    <link rel="stylesheet" href="./assets/css/bootstrap/bootstrap.min.css"/>
    <!-- FontAwesome 5 Free CSS file included -->
    <link rel="stylesheet" href="./assets/css/fontawesome/all.min.css"/>
    <!-- Cert 4 Programming Specific Stylesheet -->
    <link rel="stylesheet" href="./assets/css/c4prog.css"/>
    <!-- Leafletjs Specific Stylesheet -->
    <link rel="stylesheet" href="./assets/css/leaflet/leaflet.css"/>
<!-- Chart.js Specific Stylesheet -->
    <link rel="stylesheet" href="./assets/css/Chart.min.css"/>

    <?php /* use PHP to show a different title and header id $title is set */ ?>
    <title><?= isset($title) ? $title : 'Portfolio' ?></title>

    <base href="http://localhost/AJG/C4Prog-DBS504/">

</head>
<body class="d-flex flex-column h-100">
<header>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="./">YOUR INITIALS</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <ul class="navbar-nav mr-auto">
            <li class="nav-item ">
                <a class="nav-link" href="./">Home</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="links.php">Links</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="tags.php">Tags</a>
            </li>
        </ul>


        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="about.php">About</a>
            </li>
        </ul>
    </nav>
</header>

<!-- Begin page content -->
<main role="main" class="flex-shrink-0">
    <div class="container">
