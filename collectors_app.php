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

//----------------------------------------------------------------------------------------------------------------------dropdowns
//----------------------------------------------------------------------------------------------------------------------connect DB function
function connectDB() {
    $db = new PDO(
        'mysql:host=DB;dbname=collection',
        'root',
        'password'
    );
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $db;
}
//----------------------------------------------------------------------------------------------------------------------get table function
function getTable($table, $db) {
    $query = $db->prepare("SELECT `{$table}` FROM `{$table}s`");
    $result = $query->execute();
    if ($result) {
        return $query->fetchAll();
    } else {
        echo 'not working'; //maybe return not working
    }
}
//----------------------------------------------------------------------------------------------------------------------creating html options for select dropdown
function dropDownOptions($rows) {
    $options= '';
    foreach($rows as $row) {
        foreach ($row as $key => $value) {
            $options .= "<option value=\"{$value}\">{$value}</option>";
        }
    }
    return $options;
}
//----------------------------------------------------------------------------------------------------------return full html dropdown - select, options, /select
function createDropdown($name) {

    $start = "<select name=\"{$name}\" id=\"{name}\"><option selected=\"selected\">$name</option>";
    $options = dropDownOptions(getTable($name, connectDB()));
    $end = '</select><br><br>';
    return $start . $options . $end;
}
function createSocksDiv($socksArr) {
    $socksStr= '';
    foreach($socksArr as $sock) {
        $socksStr .= "<div class=\"sock\">
        <p>Size: {$sock['size']}</p>
        <p>Pattern: {$sock['pattern']}</p>
        <p>Color: {$sock['color']}</p>
        </div>";
    }
    return $socksStr;
}
function displaySocksCollection($db) {
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $query = $db->prepare('SELECT `id`, `size`, `pattern`, `color` FROM `socks`');
    $result = $query->execute();
    if ($result) {
        $socksArr = $query->fetchAll();
    } else {
        echo 'not working';
    }
    return createSocksDiv($socksArr);
}
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