<?php
    require_once "config.php";
    //
    if((isset($_POST['category']) && isset($_POST['category']) != ""))
    {
        $category = $_POST['category'];
        //
        $query = "SELECT cate FROM category WHERE view='$category'";
        //
        $result = mysqli_query($link, $query) or die("database error:". mysqli_error($link));
        //
        $data = array();
        //
        while($row = mysqli_fetch_assoc($result))
        {
            $data[] = $row["cate"];
        }
        //
        echo json_encode($data);
    }
?>