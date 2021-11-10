<?php
$uploaddir = './var/www/uploads/';
if (empty($_GET['submit'])){
    http_response_code(400);
//    echo '<h1>Страница не доступна, пожалуста заполните форму.</h1>';
//    return;
    header("Location: /400.html");
}
if (empty($_GET['filename'])){
    http_response_code(400);
//    echo '<h1>Страница не доступна, пожалуста введите имя файла при заполнении формы.</h1>';
//    return;
    header("Location: /400.html");
}
$filename=$_GET['filename'];
$relative_path = $uploaddir.$filename;

if (file_exists($relative_path)){
    if (ob_get_level()) {
        ob_end_clean();
    }
    // заставляем браузер показать окно сохранения файла
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=' . basename($relative_path));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($relative_path));
    // читаем файл и отправляем его пользователю
    readfile($relative_path);
} else{
    http_response_code(404);
//    echo '<h1>Файл не найден.</h1>';
//    return;
    header("Location: /404.html");
}

?>