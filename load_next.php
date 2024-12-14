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
            $query_for_tbc_echo = "SELECT study_id, video FROM study WHERE e_id=$next_eid";
            //
            if(!$result_1 = mysqli_query($link, $query_for_tbc_echo))
            {
                exit(mysqli_error($link));
            }
            $row_1 = mysqli_fetch_assoc($result_1);
            //
            $tbc_echo_eid = $next_eid;
            $tbc_echo_sid = $row_1['study_id'];
            $tbc_echo_vid = $row_1['video'];
            //
            $query_clear_current = "DELETE FROM current_dicom";
            if(!$result_c_c = mysqli_query($link, $query_clear_current))
            {
                exit(mysqli_error($link));
            }
            $query_insert_new = "INSERT INTO current_dicom (current_e_id) VALUES ($tbc_echo_eid)";
            if(!$result_i_n = mysqli_query($link, $query_insert_new))
            {
                exit(mysqli_error($link));
            }
            //
            $data = '<div id="s_id_badge"><span class="badge badge-primary">'.$tbc_echo_sid.'</span></div><div id="echo_image"><img src="DICOM_db/'.$tbc_echo_sid.'/.f1.png" width="100%"></div>';
            //
            if(strcmp($tbc_echo_vid, "YES") == 0)
            {
                $data .= '<div id="echo_vid"><video width="100%" controls><source src="DICOM_db/'.$tbc_echo_sid.'/'.$tbc_echo_sid.'.mp4" type="video/mp4"></video></div>';
            }
            else
            {
                $data .= '<div id="echo_vid"><div class="alert alert-danger" role="alert">No video available!</div></div>';
            }
            //
            echo $data;
        }
        else
        {
            $query_clear_current = "DELETE FROM current_dicom";
            if(!$result_c_c = mysqli_query($link, $query_clear_current))
            {
                exit(mysqli_error($link));
            }
            $tbc_echo_eid = $max_echo_eid + 1;
            $query_insert_new = "INSERT INTO current_dicom (current_e_id) VALUES ($tbc_echo_eid)";
            if(!$result_i_n = mysqli_query($link, $query_insert_new))
            {
                exit(mysqli_error($link));
            }
            //
            $data = '<div id="echo_image"><div class="alert alert-danger" role="alert">THE END!</div></div>';
            $data .= '<div id="echo_vid"><div class="alert alert-danger" role="alert">THE END!</div></div>';
            //
            echo $data;
        }
    }
    else
    {
        $data = '<div id="echo_image"><div class="alert alert-danger" role="alert">FINISHED!</div></div>';
        $data .= '<div id="echo_vid"><div class="alert alert-danger" role="alert">FINISHED!</div></div>';
        //
        echo $data;
    }
?>