<?php
    require_once "config.php";
    $data = "";
    //
    $query_for_tbc_echo = "SELECT e_id, study_id, video FROM study WHERE echo_status='TBC' LIMIT 1";
    //
    if(!$result_1 = mysqli_query($link, $query_for_tbc_echo))
    {
        exit(mysqli_error($link));
    }
    if(mysqli_num_rows($result_1) > 0)
    {
        $row_1 = mysqli_fetch_assoc($result_1);
        //
        $tbc_echo_eid = $row_1['e_id'];
        $tbc_echo_sid = $row_1['study_id'];
        $tbc_echo_vid = $row_1['video'];
        //
        $query_set_echo = "INSERT INTO current_dicom (current_e_id) VALUES ($tbc_echo_eid)";
        //
        if(!$result_err = mysqli_query($link, $query_set_echo))
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
        $data = '<div id="echo_image"><div class="alert alert-danger" role="alert">FINISHED!</div></div>';
        $data .= '<div id="echo_vid"><div class="alert alert-danger" role="alert">FINISHED!</div></div>';
        //
        echo $data;
    }
?>