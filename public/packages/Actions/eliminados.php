<?php
$db = new SQLite3('../../db/scris.db');
if (isset($_POST['sql'])) {
    $sql = $_POST['sql'];
    $resultado = $db->query($sql);
    if ($resultado) {
        echo "1";
    }
}
