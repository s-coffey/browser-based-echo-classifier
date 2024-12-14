<?php
    require_once "config.php";
    //
    $query = "SELECT qty_lvl FROM qty";
    //
    $result = mysqli_query($link, $query) or die("database error:". mysqli_error($link));
    //
    $data = array();
    //
    while($row = mysqli_fetch_assoc($result))
    {
        $data[] = $row["qty_lvl"];
    }
    //
    echo json_encode($data);
?>