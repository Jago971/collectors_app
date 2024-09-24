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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>collectors_app</title>
    <style>
        <?php include 'styles.css'; ?>
    </style>
</head>
<body>
<div class="interactions flex">
    <div class="interaction">
        <h1>ADD</h1>
        <form method="get">
            <label for="size">Size:</label>
            <?php
            echo createDropdown('size');
            ?>
            <label for="pattern">Pattern:</label>
            <?php
            echo createDropdown('pattern');
            ?>
            <label for="color">Color:</label>
            <?php
            echo createDropdown('color');
            ?>
            <input type="submit">
        </form>
    </div>
    <div class="interaction">
        <h1>EDIT</h1>
    </div>
    <div class="interaction">
        <h1>DELETE</h1>
    </div>
</div>
<div class="collection flex">
    <?php
    echo displaySocksCollection(connectDB());
    ?>
    <div class="sock-BG">
        <div class="sock-container purple XS">
            <div class="sock-ankle">
                <div class="cuff detail"></div>
                <div class="heel"></div>
            </div>
            <div class="sock-foot">
                <div class="toe"></div>
            </div>
        </div>
    </div>

</div>
</body>
</html>