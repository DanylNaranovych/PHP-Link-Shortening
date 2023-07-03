<?php
if (isset($_POST['functionName'])) {
    $functionName = $_POST['functionName'];

    if ($functionName == 'generateShortLink') {
        if (isset($_POST['inputParam'])) {
            $originalLink = $_POST['inputParam'];
            $result = generateShortLink($originalLink);
            echo $result;
            die();
        }
    }
}

function generateShortLink($url)
{
    $domain = 'http://localhost:3000/'; // Замените "yourdomain" на свой домен

    // Хэширование оригинальной ссылки
    $hash = md5($url);

    // Извлечение первых 5 символов хэша
    $code = substr($hash, 0, 5);

    // Формирование сокращенной ссылки
    $shortLink = $domain . $code;

    // Сохранение связи между сокращенной ссылкой и оригинальной ссылкой
    saveLinkMapping($shortLink, $url);

    return $shortLink;
}

function saveLinkMapping($shortLink, $url)
{
    $iniFile = 'links.ini';

    // Проверка наличия ini-файла
    if (!file_exists($iniFile)) {
        // Создание пустого ini-файла
        file_put_contents($iniFile, '');
    }

    // Загрузка данных из ini-файла
    $links = parse_ini_file($iniFile);

    // Добавление связи между сокращенной ссылкой и оригинальной ссылкой
    $links[$shortLink] = $url;

    // Сохранение данных в ini-файле
    $iniContent = '';
    foreach ($links as $key => $value) {
        $iniContent .= "$key = \"$value\"\n";
    }
    file_put_contents($iniFile, $iniContent);
}
?>