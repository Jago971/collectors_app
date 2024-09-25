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
                <div class=\"description flex\">
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