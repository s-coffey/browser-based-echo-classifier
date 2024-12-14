<?php
session_start();
//
require_once "config.php";

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
{
    header("location: http://localhost/");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>CRU | DM - DSM | Categorize</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap.min.css">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.3/css/bootstrap-select.min.css"> -->
    <link rel="stylesheet" href="bootstrap-select.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Andika+New+Basic&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Langar&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style_hrc.css">
</head>
<body>
    <div class=".container-fluid" id="head_jumbo">
        <div class="jumbotron text-center" style="margin-bottom:0;border-radius:0;background-color:#dfbf9f">
            <h1>Echocardiography View Classification</h1>
        </div>
    </div>
    <div class="topright">
        <label for="total">Total:</label>
        <span class="badge badge-light" id="total">TBA</span>
        <label for="completed">Completed:</label>
        <span class="badge badge-light" id="completed">TBA</span>
        <label for="remaining">Remaining:</label>
        <span class="badge badge-light" id="remaining">TBA</span>
        <label for="log_in">Logged in as:</label>
        <span class="badge badge-light" id="log_in"><?php echo htmlspecialchars($_SESSION["dis_name"]); ?></span>
        <a href="logout.php" class="btn btn-link">Sign Out</a>
    </div>
    <div class=".container-fluid" style="margin:50px">
        <div class="row">
            <div class="col-sm-12">
                <div class="echo_content"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div id="echo_controls">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <select id="select_cat" class="selectpicker form-control" title="Select Category">
                                    <?php
                                        $sql = "SELECT view_cat FROM views";
                                        $resultset = mysqli_query($link, $sql) or die("database error:". mysqli_error($link));
                                        while( $rows = mysqli_fetch_assoc($resultset) ) {
                                    ?>
                                            <option><?php echo $rows["view_cat"]; ?></option>
                                    <?php 
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <select disabled id="select_view" class="selectpicker form-control" title="Select View">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <select disabled id="select_quality" class="selectpicker form-control" title="Select Quality">
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="echo_b">
                    <div class="row">
                        <div class="col-sm-12">
                            <button type="button" id="pre_b" class="btn btn-danger" onclick="previousB()">Previous</button>
                            <button type="button" disabled id="next_b" class="btn btn-success" onclick="nextB()">Next</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div id="badges">
                                <div id="v_cat">
                                    <span class="badge badge-danger" id="v_cat_b">No view category</span>
                                </div>
                                <div id="v">
                                    <span class="badge badge-danger" id="v_b">No view</span>
                                </div>
                                <div id="qty">
                                    <span class="badge badge-danger" id="qty_b">No quality</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class=".container-fluid" id="foot_jumbo">
        <div class="jumbotron text-center" style="margin-bottom:0;border-radius:0;background-color:#dfbf9f">
            <p>Cardiology Research Unit</p>
        </div>
    </div>
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script> -->
    <script src="jquery-3.3.1.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script> -->
    <script src="popper.min.js"></script>
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script> -->
    <script src="bootstrap.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.3/js/bootstrap-select.min.js"></script> -->
    <script src="bootstrap-select.min.js"></script>
    <script src="control.js"></script>
</body>