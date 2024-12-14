<?php
    session_start();
    //
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) 
    {
        header("location: categorize.php");
        exit;
    }
    //
    require_once "config.php";
    //
    $username = $password = "";
    $username_err = $password_err = "";
    //
    if($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        if(empty(trim($_POST["username"]))) 
        {
            $username_err = "Username required";
        } 
        else 
        {
            $username = trim($_POST["username"]);
        }
        //
        if(empty(trim($_POST["password"]))) 
        {
            $password_err = "Password required";
        } 
        else 
        {
            $password = trim($_POST["password"]);
        }
        //
        if(empty($username_err) && empty($password_err)) 
        {
            $sql = "SELECT dis_name, pass_h FROM users WHERE u_name = ?";
            //
            if($stmt = mysqli_prepare($link, $sql))
            {
                mysqli_stmt_bind_param($stmt, "s", $param_username);
                $param_username = $username;
                //
                if(mysqli_stmt_execute($stmt))
                {
                    mysqli_stmt_store_result($stmt);
                    //
                    if(mysqli_stmt_num_rows($stmt) == 1)
                    {
                        mysqli_stmt_bind_result($stmt, $dis_name, $pass_h);
                        //
                        if(mysqli_stmt_fetch($stmt))
                        {
                            if(password_verify($password, $pass_h))
                            {
                                session_start();
                                //
                                $_SESSION["loggedin"] = true;
                                $_SESSION["dis_name"] = $dis_name;
                                //
                                header("location: categorize.php");
                            }
                            else
                            {
                                $password_err = "Invalid password";
                            }
                        }
                    }
                    else
                    {
                        $username_err = "No account available";
                    }
                }
                else
                {
                    echo "Database unreachable";
                }
                mysqli_stmt_close($stmt);
            }
        }
        mysqli_close($link);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRU | DM - DSM | Sign In</title>
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Andika+New+Basic&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style_auth_hrc.css">
</head>
<body>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Member Sign In</h3>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                    <input type="text" name="username" placeholder="Username" class="form-control" value="<?php echo $username; ?>">
                    <span class="help-block"><?php echo $username_err; ?></span>
                </div>    
                <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                    <input type="password" name="password" placeholder="Password" class="form-control">
                    <span class="help-block"><?php echo $password_err; ?></span>
                </div>
                <div class="form-group">
                    <input type="submit" id="sign_b" class="btn btn-dark" value="Sign In">
                </div>
            </form>
        </div>
    </div>
</body>
</html>