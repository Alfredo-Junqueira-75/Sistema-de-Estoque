<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Login</title>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="/public/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="/public/css/bootstrap-responsive.min.css"/>
    <link rel="stylesheet" href="/public/css/matrix-login.css"/>
    <link href="/public/font-awesome/css/font-awesome.css" rel="stylesheet"/>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>

</head>
<body>
<div id="loginbox">
    <form name="form1" class="form-vertical" action="../../controller/UsuarioController.php" method="post">
        <div class="control-group normal_text"><h3>Login Page</h3></div>
        <div class="control-group">
            <div class="controls">
                <div class="main_input_box">
                    <span class="add-on bg_lg"><i class="icon-user"> </i></span><input type="text"
                                                                                    placeholder="Username" name="username"/>
                </div>
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <div class="main_input_box">
                    <span class="add-on bg_ly"><i class="icon-lock"></i></span><input type="password"
                                                                                    placeholder="Password" name="password"/>
                </div>
            </div>
        </div>
        <div class="form-actions">
            <center>
                <input type="submit" name="submit2" value="Login" class="btn btn-success"/>
            </center>
        </div>
    </form>

</div>

<script src="/public/js/jquery.min.js"></script>
<script src="/public/js/matrix.login.js"></script>
</body>

</html>
