<?php
$result = 'Message error!';
if (isset($_GET['username'], $_GET['dt'], $_GET['message'])) {
    $username = $_GET['username'];
    $dt = $_GET['dt'];
    $message = $_GET['message'];

    $db = new PDO('sqlite:/opt/database/habwatch.sqlite3');
    $sqlinsert = 'INSERT INTO text (username, dt, message) VALUES (:username, :dt, :message)';
    $stmt = $db->prepare($sqlinsert);

    $stmt->bindValue(':username', $username, PDO::PARAM_STR);
    $stmt->bindValue(':dt', $dt, PDO::PARAM_STR);
    $stmt->bindValue(':message', $message, PDO::PARAM_STR);
    $stmt->execute();

    $result = 'Message recorded!';
}

?>
<em><?= $result ?></em>