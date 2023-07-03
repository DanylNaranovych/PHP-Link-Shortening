<?php
// $links = parse_ini_file('links.ini');

// if (isset($_GET['url']) && array_key_exists($_GET['url'], $links)) {
//     header('Location: ' . $link[$_GET['url']]);
// } else {
//     header('HTTP/1.0 404 Not Found');
//     echo 'Неизвестная ссылка.';
// }
$shortLink = $_SERVER['REQUEST_URI'];
$filePath = 'path/to/files/' . $shortLink;
$links = parse_ini_file('links.ini');

if (file_exists($filePath)) {
} else {
    $redirectLink = $links['http://localhost:3000' . $shortLink];
    header("Location: $redirectLink");
    exit;
}
?>