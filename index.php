<?php
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
<div class="title flex">
    <div class="flex"><h1>ODD SOCKS COLLECTION</h1></div>
    <div class="flex"><h3>a place to keep a collection of your odd socks</h3></div>
</div>
<div class="interactions flex">
    <div class="interaction add flex">
        <h1>ADD</h1>
        <form method="get" class="flex">
            <div class="small-inputs flex">
                <label for="name">Name:</label>
                <input name="name" id="name" type="text">
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
            </div>
            <div class="description-input flex">
                <label for="description">Description:</label>
                <textarea name="description" id="description"></textarea>
                <input class="submit" type="submit">
            </div>
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
</div>
</body>
</html>