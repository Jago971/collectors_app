<?php
function connectDB(): PDO {
    $db = new PDO(
        'mysql:host=DB;dbname=collection',
        'root',
        'password'
    );
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $db;
}
function bounceNumber() {
    $num = 0;
    $num++;
    return $num;
}

function createSockDiv(array $socksArr): string {
    $socksStr= '';
    foreach($socksArr as $sock) {
        $num = bounceNumber();
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
                <div class=\"description flex bounce{$num}\">
                    <h3>{$sock['name']}</h3>
                    <div class=\"description-container\"><p>{$sock['description']}</p><p class=\"cover\">...</p></div>
                </div>
            </div>";
    }
    return $socksStr;
}

function displaySocksCollection(PDO $db): string {
    $query = $db->prepare('SELECT `socks`.`size`, `sizes`.`size`, `socks`.`pattern`, `patterns`.`pattern`, `socks`.`color`, `colors`.`color`, `socks`.`name`, `socks`.`description` FROM `socks` JOIN `sizes` ON `socks`.`size` = `sizes`.`id` JOIN `patterns` ON `socks`.`pattern` = `patterns`.`id` JOIN `colors` ON `socks`.`color` = `colors`.`id`;');

    $result = $query->execute();
    if ($result) {
        $socksArr = $query->fetchAll();
    } else {
        echo 'not working';
    }
    return createSockDiv($socksArr);
}

function getTable(string $table,PDO $db): array {
    $query = $db->prepare("SELECT `{$table}` FROM `{$table}s`");
    $result = $query->execute();
    if ($result) {
        return $query->fetchAll();
    } else {
        throw new Exception('error');
    }
}

function dropDownOptions(array $rows): string {
    $options= '';
    foreach($rows as $row) {
        foreach ($row as $key => $value) {
            $options .= "<option value=\"{$value}\">{$value}</option>";
        }
    }
    return $options;
}

function createDropdown(string $name) : string {
    $start = "<select name=\"{$name}\" id=\"{$name}\"><option disabled=\"disabled\" selected=\"selected\">$name</option>";
    $options = dropDownOptions(getTable($name, connectDB()));
    $end = '</select>';
    return $start . $options . $end;
}

function insertIntoDatabase() {
    if ($_POST) {
        $db = connectDB();
        $query = $db->prepare("INSERT INTO `socks` (`name`, `size`, `pattern`, `color`, `description`) VALUES (:name, :size, :pattern, :color, :description)");
        //$query = $db->prepare("INSERT INTO `socks` (`size`, `pattern`, `color`) VALUES (:size, :pattern, :color)");
        $result = $query->execute([
            'name' => $_POST['name'],
            'size' => getRelatedNumberForDropdownOption('size', $_POST['size']),
            'pattern' => getRelatedNumberForDropdownOption('pattern', $_POST['pattern']),
            'color' => getRelatedNumberForDropdownOption('color', $_POST['color']),
            'description' => $_POST['description']
        ]);
    }
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