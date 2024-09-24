<?php
//----------------------------------------------------------------------------------------------------------------------connect to DB
function connectDB(): PDO {
    $db = new PDO(
        'mysql:host=DB;dbname=collection',
        'root',
        'password'
    );
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $db;
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