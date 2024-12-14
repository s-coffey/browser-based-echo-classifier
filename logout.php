<?php
    require_once "config.php";
    session_start();
    //
    $query_chk = "SELECT * FROM current_dicom";
    if(!$result_1 = mysqli_query($link, $query_chk))
    {
        exit(mysqli_error($link));
    }
    if(mysqli_num_rows($result_1) > 0)
    {
        $s_end_query = "DELETE FROM current_dicom";
        if(!$result_2 = mysqli_query($link, $s_end_query))
        {
            exit(mysqli_error($link));
        }
    }
    //
    $_SESSION = array();
    //
    session_destroy();
    //
    header("location: http://localhost/");
    exit;
?>