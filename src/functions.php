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
        $socksStr .= "<div class=\"sock\">
        <p>Size: {$sock['size']}</p>
        <p>Pattern: {$sock['pattern']}</p>
        <p>Color: {$sock['color']}</p>
        </div>";
    }
    return $socksStr;
}
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

