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
    $start = "<select name=\"{$name}\" id=\"{$name}\"><option disabled=\"disabled\" selected=\"selected\">$name</option>";
    $options = dropDownOptions(getTable($name, connectDB()));
    $end = '</select><br><br>';
    return $start . $options . $end;
}
//---------------------------------------------------------------------------------------------------------creates each sock div and ties together as one string
function createSockDiv(array $socksArr): string {
    $socksStr= '';
    foreach($socksArr as $sock) {
        $socksStr .=
            "<div class=\"sock-BG flex\">
                <div class=\"sock-container {$sock['size']} {$sock['color']}\">
                      <div class=\"sock-ankle\">
                            <div class=\"cuff detail\"></div>
                            <div class=\"heel\"></div>
                      </div>
                      <div class=\"sock-foot\">
                            <div class=\"toe\"></div>
                      </div>
                </div>
            </div>";
    }
    return $socksStr;
}
//------------------------------------------------------------------------------------------returns the full collection of stored entries as a long string of divs
function displaySocksCollection(PDO $db): string {
    $query = $db->prepare('SELECT `socks`.`size`, `sizes`.`size`, `socks`.`pattern`, `patterns`.`pattern`, `socks`.`color`, `colors`.`color`
FROM `socks`
    JOIN `sizes` ON `socks`.`size` = `sizes`.`id`
    JOIN `patterns` ON `socks`.`pattern` = `patterns`.`id`
    JOIN `colors` ON `socks`.`color` = `colors`.`id`;');
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
    //$query = $db->prepare("INSERT INTO `socks` (`size`, `pattern`, `color`) VALUES (:size, :pattern, :color)");
    $result = $query->execute([
        'size' => getRelatedNumberForDropdownOption('size', $_GET['size']),
        'pattern' => getRelatedNumberForDropdownOption('pattern', $_GET['pattern']),
        'color' => getRelatedNumberForDropdownOption('color', $_GET['color'])
    ]);
}
function getRelatedNumberForDropdownOption($stat, $option) {
    $db = connectDB();
    $query = $db->prepare("SELECT `socks`.`{$stat}` FROM `socks` JOIN `{$stat}s` ON `socks`.`{$stat}` = `{$stat}s`.`id` WHERE `{$stat}s`.`{$stat}` = '{$option}';");
    $result = $query->execute();
    if ($result) {
        $num = $query->fetchAll();
    } else {
        echo 'error';
    }
    return $num[0][$stat];
}