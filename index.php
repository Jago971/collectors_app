<?php
// story one:
// DB to store items
// items must have at least 3 stats
// display DB items

// story two:
// add new items


// story 1 tasks:

// git repo ✅
// git connect ✅
// git main ✅
// git branch story 1 (S1) ✅
// create DB with 3 items, 3 stats each ✅
// fetch db and display ✅

// story 2 tasks:

// html form ✅
// $_GET form data ✅
// move data to DB ✅

// trainer tasks:

// validation of inputs:
// DB table for sizes, color, pattern ✅
// dropdowns that populate colors, sizes, patterns ✅

//----------------------------------------------------------------------------------------------------------------------required files
require_once 'src/functions.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>collectors_app</title>
    <style>
        <?php include 'styles.css'; ?>
    </style>
</head>
<body>
<div class="container flex">
    <form method="get">
        <label for="size">Size:</label><br>
        <?php
        echo createDropdown('size');
        ?>
        <label for="pattern">Pattern:</label><br>
        <?php
        echo createDropdown('pattern');
        ?>
        <label for="color">Color:</label><br>
        <?php
        echo createDropdown('color');
        ?>
        <input type="submit">
    </form>
    <div class="collection flex">
            <?php
            echo displaySocksCollection(connectDB());
            ?>
    </div>
</div>
</body>
</html>