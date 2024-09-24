<?php
//----------------------------------------------------------------------------------------------------------------------connect to DB
function connectDB() {
    $db = new PDO(
        'mysql:host=DB;dbname=collection',
        'root',
        'password'
    );
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $db;
}

//----------------------------------------------------------------------------------------------------------------------gets a stat table from the db
function getTable(string $table,PDO $db): array {
    $query = $db->prepare("SELECT `{$table}` FROM `{$table}s`");
    $result = $query->execute();
    if ($result) {
        return $query->fetchAll();
    } else {
        throw new Exception('error');
    }
}
//--------------------------------------------------------------------------------------------------------------creates the html options for select dropdown
function dropDownOptions(array $rows): string {
    $options= '';
    foreach($rows as $row) {
        foreach ($row as $key => $value) {
            $options .= "<option value=\"{$value}\">{$value}</option>";
        }
    }
    return $options;
}
//----------------------------------------------------------------------------------------------------------return full html dropdown - select, options, /select
function createDropdown(string $name) : string {
    $start = "<select name=\"{$name}\" id=\"{name}\"><option disabled=\"disabled\" selected=\"selected\">$name</option>";
    $options = dropDownOptions(getTable($name, connectDB()));
    $end = '</select><br><br>';
    return $start . $options . $end;
}
//---------------------------------------------------------------------------------------------------------creates each sock div and ties together as one string
function createSockDiv(array $socksArr): string {
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
//------------------------------------------------------------------------------------------returns the full collection of stored entries as a long string of divs
function displaySocksCollection(PDO $db): string {
    $query = $db->prepare('SELECT `id`, `size`, `pattern`, `color` FROM `socks`');
    $result = $query->execute();
    if ($result) {
        $socksArr = $query->fetchAll();
    } else {
        echo 'not working';
    }
    return createSockDiv($socksArr);
}
//----------------------------------------------------------------------------------------------------------------------return entry to DB
if ($_GET) {
    $db = connectDB();
    $query = $db->prepare("INSERT INTO `socks` (`size`, `pattern`, `color`) VALUES (:size, :pattern, :color)");
    $result = $query->execute([
        'size' => $_GET['size'],
        'pattern' => $_GET['pattern'],
        'color' => $_GET['color']
    ]);
}