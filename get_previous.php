<?php
    require_once "config.php";
    $min_echo_eid = 1;
    //
    $query_for_current_eid = "SELECT current_e_id FROM current_dicom";
    //
    if(!$result_1 = mysqli_query($link, $query_for_current_eid))
    {
        exit(mysqli_error($link));
    }
    //
    if(mysqli_num_rows($result_1) > 0)
    {
        $row_1 = mysqli_fetch_assoc($result_1);
        $current_eid = $row_1['current_e_id'];
        $eid_to_show = -1;
        //
        if($current_eid > $min_echo_eid)
        {
            $eid_to_show = $current_eid - 1;
        }
        else
        {
            $eid_to_show = $min_echo_eid;
        }
        //
        $query_for_s_echo = "SELECT cate, view, qty FROM study WHERE e_id=$eid_to_show";
        //
        if(!$result_2 = mysqli_query($link, $query_for_s_echo))
        {
            exit(mysqli_error($link));
        }
        //
        $row_2 = mysqli_fetch_assoc($result_2);
        //
        $selected_vals = array($row_2['cate'], $row_2['view'], $row_2['qty']);
        //
        $underscore_separated = implode("_", $selected_vals);
        //
        echo $underscore_separated;
    }
    else
    {
        echo "NA_NA_NA";
    }
?>