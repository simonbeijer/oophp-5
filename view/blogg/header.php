<?php
namespace Anax\View;

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?= $title . $titleExtended ?></title>
    <link rel="stylesheet" href="../bloggcss/css/style.css">
    <script src="https://use.fontawesome.com/e5579368c4.js"></script>
</head>
<body>

<navbar class="navbar">
    <a href=<?= url("../htdocs/blogg/index") ?>>Show all content</a> |
    <a href=<?= url("../htdocs/blogg/admin") ?>>Admin</a> |
    <a href=<?= url("../htdocs/blogg/create") ?>>Create</a> |
    <a href=<?= url("../htdocs/blogg/pages") ?>>View pages</a> |
    <a href=<?= url("../htdocs/blogg/blog") ?>>View blog</a> |
</navbar>

<h1>My Content Database</h1>

<main>
