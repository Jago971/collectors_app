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

function createSockDiv(array $socksArr,array $sizes,array $patterns,array $colors): string {
    $socksStr= '';
    foreach($socksArr as $sock) {
        $size = $sizes[$sock['size'] - 1]['name'];
        $pattern = $patterns[$sock['pattern'] - 1]['name'];
        $color = $colors[$sock['color'] - 1]['name'];

        $socksStr .= "<div class=\"sock-BG flex\">";
        $socksStr .= "<div class=\"sock-container {$size} {$color}\">";
        $socksStr .= "<div class=\"sock-ankle {$pattern}\">";
        $socksStr .= "<div class=\"cuff detail\"></div>";
        $socksStr .= "<div class=\"heel\"></div>";
        $socksStr .= "</div>";
        $socksStr .= "<div class=\"sock-foot {$pattern}\">";
        $socksStr .= "<div class=\"toe\"></div>";
        $socksStr .= "</div>";
        $socksStr .= "</div>";
        $socksStr .= "<div class=\"description flex\">";
        $socksStr .= "<h3>{$sock['name']}</h3>";
        $socksStr .= "<div class=\"description-container\"><p>{$sock['description']}</p><p class=\"cover\">...</p></div>";
        $socksStr .= "</div>";
        $socksStr .= "</div>";
    }
    return $socksStr;
}

function displaySocksCollection(PDO $db): string {
    $query = $db->prepare('SELECT `socks`.`size`, `sizes`.`name`, `socks`.`pattern`, `patterns`.`name`, `socks`.`color`, `colors`.`name`, `socks`.`name`, `socks`.`description` FROM `socks` JOIN `sizes` ON `socks`.`size` = `sizes`.`id` JOIN `patterns` ON `socks`.`pattern` = `patterns`.`id` JOIN `colors` ON `socks`.`color` = `colors`.`id`;');

    $result = $query->execute();
    if ($result) {
        $socksArr = $query->fetchAll();
    } else {
        throw new Exception('error');
    }
    $sizes = getSizes($db);
    $patterns = getPatterns($db);
    $colors = getColors($db);
    return createSockDiv($socksArr, $sizes, $patterns, $colors);
}


function getSizes(PDO $db): array {
    $query = $db->prepare("SELECT `id`, `name` FROM `sizes`");
    $result = $query->execute();
    if ($result) {
        return $query->fetchAll();
    } else {
        throw new Exception('error');
    }
}
function getColors(PDO $db): array {
    $query = $db->prepare("SELECT `id`, `name` FROM `colors`");
    $result = $query->execute();
    if ($result) {
        return $query->fetchAll();
    } else {
        throw new Exception('error');
    }
}

function getPatterns(PDO $db): array {
    $query = $db->prepare("SELECT `id`, `name` FROM `patterns`");
    $result = $query->execute();
    if ($result) {
        return $query->fetchAll();
    } else {
        throw new Exception('error');
    }
}

function getSockNames(PDO $db): array {
    $query = $db->prepare("SELECT `id`, `name` FROM `socks`");
    $result = $query->execute();
    if ($result) {
        return $query->fetchAll();
    } else {
        throw new Exception('error');
    }
}

function dropDownOptions(array $rowsArr): string {
    $options= '';
    foreach($rowsArr as $row) {
        $options .= "<option value=\"{$row['id']}\">{$row['name']}</option>";
    }
    return $options;
}

function createDropdown(string $name, $getTableCallback) : string {
    $start = "<select name=\"{$name}\" id=\"{$name}\"><option disabled=\"disabled\" selected=\"selected\">$name</option>";
    $options = dropDownOptions($getTableCallback);
    $end = '</select>';
    return $start . $options . $end;
}

function insertIntoDatabase(array $sanitizedData, PDO $db) {
        $query = $db->prepare("INSERT INTO `socks` (`name`, `size`, `pattern`, `color`, `description`) VALUES (:name, :size, :pattern, :color, :description);");
        $query->execute([
            'name' => $sanitizedData['name'],
            'size' => $sanitizedData['size'],
            'pattern' => $sanitizedData['pattern'],
            'color' => $sanitizedData['color'],
            'description' => $sanitizedData['description'] ?? ''
        ]);
}



function deleteFromDatabase(array $sanitizedData, PDO $db) {
    $query = $db->prepare("DELETE FROM `socks` WHERE `id` = :chosenSock");
    $query->execute([
        'chosenSock' => $sanitizedData['id']
    ]);
}

function searchSock(array $sanitizedData, PDO $db): array {
    $query = $db->prepare("SELECT `sizes`.`name` AS 'Size', `patterns`.`name` AS 'Pattern', `colors`.`name` AS 'Color', `socks`.`name` AS 'Name', `socks`.`description` AS 'Description' FROM `socks` JOIN `sizes` ON `socks`.`size` = `sizes`.`id` JOIN `patterns` ON `socks`.`pattern` = `patterns`.`id` JOIN `colors` ON `socks`.`color` WHERE `socks`.`id` = :chosenSock;");
    $result = $query->execute([
        'chosenSock' => $sanitizedData['id']
    ]);
    if ($result) {
        $sockArr = $query->fetch();
    } else {
        throw new Exception('error');
    }
    return $sockArr;
}

function displaySearchedSock(array $sockArr, int $data): string {
    $message = '<br>';
    foreach ($sockArr as $key => $value) {
        if($key == 'Description' && $value == '') {
            $message .= "<p><b>{$key}:</b> N/A</p>";
        } else {
            $message .= "<p><b>{$key}:</b> {$value}</p>";
        }
    }
    $message .= "<br><form method=\"post\">";
    $message .= "<label for=\"deletesock\"></label>";
    $message .= "<input value=\"\">";
    $message .= "<input class=\"submit\" type=\"submit\" value=\"DELETE SOCK\">";
    $message .= "</form>";
    return $message;
}