<?php
session_start();
include('includes/config.php');
if(isset($_POST['login']))
{
$uname=$_POST['username'];
$password=md5($_POST['password']);
$sql ="SELECT UserName,Password FROM admin WHERE UserName=:uname and Password=:password";
$query= $dbh -> prepare($sql);
$query-> bindParam(':uname', $uname, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
$_SESSION['alogin']=$_POST['username'];
echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
} else{
	
	echo "<script>alert('Invalid Details');</script>";

}

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TMS | Admin Sign in</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fafafa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 400px; /* Adjusted width for desktop view */
            max-width: 90%;
            text-align: center;
        }

        h2 {
            margin-top: 0;
            color: #262626;
            font-weight: 600;
            font-size: 28px;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        input[type="text"],
        input[type="password"] {
            width: calc(100% - 20px);
            padding: 12px;
            border: 1px solid #dbdbdb;
            border-radius: 5px;
            background-color: #fafafa;
            outline: none;
        }

        .login-btn {
            width: 100%;
            padding: 12px;
            background-color: #0095f6;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            font-weight: bold;
            font-size: 16px;
            letter-spacing: 1px;
        }

        .login-btn:hover {
            background-color: #0077c2;
        }

        .back-home-btn {
            margin-top: 20px;
            font-size: 14px;
            color: #262626;
        }

        .back-home-btn a {
            color: #0095f6;
            text-decoration: none;
        }

        .back-home-btn a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Admin Sign In</h2>
        <form method="post">
            <div class="form-group">
                <input type="text" name="username" placeholder="Username" required="">
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Password" required="">
            </div>
            <div class="form-group">
                <input type="submit" class="login-btn" name="login" value="Sign In">
            </div>
        </form>
        <div class="back-home-btn">
            <a href="../index.php">Back to Home</a>
        </div>
    </div>
</body>
</html>

