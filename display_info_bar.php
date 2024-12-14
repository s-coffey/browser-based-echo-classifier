<?php
    require_once "config.php";
    $data = "";
    //
    $query_info_bar = "SELECT COUNT(echo_status) FROM study WHERE echo_status='DONE'";
    //
    if(!$result = mysqli_query($link, $query_info_bar))
    {
        exit(mysqli_error($link));
    }
    $row = mysqli_fetch_assoc($result);
    //
    $data = $row['COUNT(echo_status)'];
    //
    echo $data;
?>