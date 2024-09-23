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
// move data to DB

//----------------------------------------------------------------------------------------------------------------------empty socks array
$socks = [];

//----------------------------------------------------------------------------------------------------------------------connect to DB
$db = new PDO(
    'mysql:host=DB;dbname=collection',
    'root',
    'password'
);
//----------------------------------------------------------------------------------------------------------------------defaulting
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
//----------------------------------------------------------------------------------------------------------------------preparing query
$query = $db->prepare('SELECT * FROM `socks`');
//----------------------------------------------------------------------------------------------------------------------execute query
$result = $query->execute();

if ($result) {
    $socks = $query->fetchAll();//--------------------------------------------------------------------------------------REASSIGN PLAYERS ARRAY
} else {
    echo 'not working';
}
//----------------------------------------------------------------------------------------------------------------------form $_GET data
$test = '';
if ($_GET) {
    $test = "{$_GET['size']} {$_GET['pattern']} {$_GET['color']}";

    //------------------------------------------------------------------------------------------------------------------move form to DB
    $query = $db->prepare("INSERT INTO `socks` (`size`, `pattern`, `color`) VALUES (:size, :pattern, :color)");
    $result = $query->execute([
        'size' => $_GET['size'],
        'pattern' => $_GET['pattern'],
        'color' => $_GET['color']
    ]);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>collectors_app</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body style="margin: 0; padding:0; position: relative;">
<div style="margin: 0; position: relative; display: flex; flex-direction: column; align-items: center;">
    <form method="get">
        <label for="size">Size:</label><br>
        <input type="text" id="size" name="size" required><br>
        <label for="pattern">Pattern:</label><br>
        <input type="text" id="pattern" name="pattern" required><br>
        <label for="color">Color:</label><br>
        <input type="text" id="color" name="color" required><br><br>
        <input type="submit">
    </form>
    <div class="tst_answer">
        <?php
        echo $test;
        ?>
    </div>
</div>
</body>
</html>
