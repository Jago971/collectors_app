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
</div>
</body>
</html>