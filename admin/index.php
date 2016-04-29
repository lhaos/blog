<?php
    if(is_array($_POST) && count($_POST) > 0){
        if($_POST["action"] == "login"){

        }
    }//fecha primeiro if

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
        <input type="text" class="form-control" placeholder="User or email address" required="" autofocus="">
        <input type="password" class="form-control" placeholder="Password" required="">
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