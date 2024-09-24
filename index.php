<?php
require_once 'src/functions.php';
$db = connectDB();
$query = $db->prepare('SELECT `socks`.`size`, `sizes`.`size` FROM `socks` JOIN `sizes` ON `socks`.`size` = `sizes`.`id`;');
//SELECT ‘parent’.’name’, ‘children’.’name’
//FROM ‘parents’
//JOIN ‘parents_children’
//  ON ‘parents’.’id’ = ‘parents_children’.’parent_id’
//JOIN ‘children’
//  ON ‘children’.’id’. = ‘parents_children’.’child_id’;

$result = $query->execute();
if ($result) {
    $socksArr = $query->fetchAll();
} else {
    echo 'not working';
}
echo '<pre>';
var_dump($socksArr);
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