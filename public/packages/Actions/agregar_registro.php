<?php
$db = new SQLite3('../../db/scris.db');


if (isset($_POST['dependencia'])) {
    $dependencia = $_POST['dependencia'];
    $sql = "SELECT nombre FROM funcionarios WHERE dependencia = '$dependencia' ORDER BY nombre ASC";

    if ($dependencia == '') {
        $sql = "SELECT nombre FROM funcionarios ORDER BY nombre ASC";
    }
    $result = $db->query($sql);
    echo '<option value="">Seleccione</option>';
    while ($row = $result->fetchArray()) {
        echo '<option value="' . $row['nombre'] . '">' . $row['nombre'] . '</option>';
    }
}

if (isset($_POST['nombre'])) {
    $nombre = $_POST['nombre'];
    $sql = "SELECT * FROM funcionarios WHERE nombre = '$nombre'";
    $result = $db->query($sql);
    while ($row = $result->fetchArray()) {
        $dependencia = $row['dependencia'];
        $direccion = $row['direccion'];
        $asignatura = $row['asignatura'];
        $placa = $row['placa'];
        $observaciones = $row['observaciones'];

        echo '{"dependencia":"' . $dependencia . '", "direccion":"' . $direccion . '", "asignatura":"' . $asignatura . '", "placa":"' . $placa . '", "observaciones":"' . $observaciones . '"}';
    }
}

if (isset($_POST['sql'])) {
    $db = new SQLite3('../../db/scris.db');
    $sql = $_POST['sql'];
    $result = $db->query($sql);

    if ($result) {
        echo 1;
    } else {
        echo 0;
    }
}
