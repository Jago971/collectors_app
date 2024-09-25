<?php
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
    </form>
    <div class="collection flex">
        <?php
        echo displaySocksCollection(connectDB());
        ?>
    </div>
</div>
</body>
</html>