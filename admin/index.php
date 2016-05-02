<?php
session_start();
include_once '../config/app.php';
    if(is_array($_POST) && count($_POST) > 0){

        if($_POST["action"] == "login"){
            $responseUser = User::login($_POST['user'] && $_POST['password']);

            if($responseUser === true){
                header("location:".GLOBAL_PATH."admin/application/dashboard/");
            }//fecha if

        }//fecha if de login

    }//fecha if teste de array

    if(is_array($_GET) && count($_GET) > 0) {

        if ($_GET["action"] == "logout") {
            User::logout();
        }//fecha if para logout

    }//fecha teste de logout

?>
<!DOCTYPE html>
<html>
<head>
	<title>Adm</title>
	<meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link href="../assets/sys/css/adminLogin.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="fullscreen_bg" class="fullscreen_bg"/>

<div class="container">
    <form class="form-signin" method="post" action="">
        <h1 class="form-signin-heading text-muted">Sign In</h1>
        <?php
        if(isset($responseUser)) {
            ?>
            <div class="alert alert-danger" role="alert"> <strong>Error: </strong>
                <?= $responseUser; ?>
            </div>
            <?php
        }
        ?>
        <input type="text" name="user" class="form-control" placeholder="User or email address" required="" autofocus="">
        <input type="password" name="password" class="form-control" placeholder="Password" required="">
        <button class="btn btn-lg btn-primary btn-block" type="submit">
            Sign In
        </button>
        <input type="hidden" name="action" value="login">
    </form>
</div>
</body>
<footer>
    <div id="rodape">
    <b>Copyright &copy; 2016 - by Thiago Souza<br/>
    </footer>
</html>