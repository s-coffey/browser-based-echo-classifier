<?php
    require_once "config.php";
    $data = "";
    $max_echo_eid = 16509;
    //
    $query_for_current_echo = "SELECT current_e_id FROM current_dicom";
    //
    if(!$result_cur = mysqli_query($link, $query_for_current_echo))
    {
        exit(mysqli_error($link));
    }
    //
    if(mysqli_num_rows($result_cur) > 0)
    {
        $row_cur = mysqli_fetch_assoc($result_cur);
        //
        $current_echo_eid = $row_cur['current_e_id'];
        //
        if($current_echo_eid < $max_echo_eid)
        {
            $next_eid = $current_echo_eid + 1;
            //
            $query_for_status_tbc_echo = "SELECT cate, view, qty FROM study WHERE e_id=$next_eid";
            //
            if(!$result_1 = mysqli_query($link, $query_for_status_tbc_echo))
            {
                exit(mysqli_error($link));
            }
            $row_1 = mysqli_fetch_assoc($result_1);
            //
            $tbc_cate = $row_1['cate'];
            $tbc_view = $row_1['view'];
            $tbc_qty = $row_1['qty'];
            //
            $selected_vals = array($tbc_cate, $tbc_view, $tbc_qty);
            //
            $underscore_separated = implode("_", $selected_vals);
            //
            echo $underscore_separated;
        }
        else
        {
            $data = "NA_NA_NA";
            //
            echo $data;
        }
    }
    else
    {
        $data = "NA_NA_NA";
        //
        echo $data;
    }
?>