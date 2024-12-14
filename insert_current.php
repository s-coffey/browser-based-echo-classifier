<?php
    require_once "config.php";
    session_start();
    //
    if((isset($_POST["current_v_cat"]) && isset($_POST["current_v"])) && (isset($_POST["current_qty"])))
    {
        $query_for_current_sid = "SELECT current_e_id FROM current_dicom";
        //
        if(!$result_1 = mysqli_query($link, $query_for_current_sid))
        {
            exit(mysqli_error($link));
        }
        //
        if(mysqli_num_rows($result_1) > 0)
        {
            $row_1 = mysqli_fetch_assoc($result_1);
            //
            $current_eid = $row_1['current_e_id'];
            //
            $v_cat_insert = $_POST["current_v_cat"];
            $v_insert = $_POST["current_v"];
            $qty_insert = $_POST["current_qty"];
            $assessor = $_SESSION["dis_name"];
            //
            $query_to_set = "UPDATE study SET cate='$v_cat_insert', view='$v_insert', qty='$qty_insert', echo_status='DONE', assessor='$assessor' WHERE e_id=$current_eid";
            //
            if(!$result_2 = mysqli_query($link, $query_to_set))
            {
                exit(mysqli_error($link));
            }
        }
    }
?>