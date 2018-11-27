<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>fordFanatics</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="./CSS/register_site.css">
 		<link rel="shortcut icon" type="image/jpg" href="g.jpg">
 		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src='https://www.google.com/recaptcha/api.js'></script>		
        <script src="script.js"></script>
<style>
body {
    font-family: Arial;
    color: white;
}
.split {
    height: 98%;
    width: 50%;
    position: fixed;
    z-index: 1;
    top: 0;
    overflow-x: hidden;
    padding-top: 20px;
}
.left {
    left: 0;
    background-color:rgb(35,180,255);
}
.right {
    right: 0;
}
.centered {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
}
.centered img {
    width: 150px;
    border-radius: 50%;
}
.footer {
    position: fixed;
    left: 0;
    bottom: 0;
    width: 100%;
    background-color: white;
    color: black;
    text-align: center;
}
</style>	
	</head>
	<body>

	<div class="split left">
		<div class="centered">
		<img src="globe.jpg" alt="Gatherly">
		<h1 style="font-size: 500%">Gatherly</h1>
        <h3 style="font-size: 100%">Gather around, join the conversation today</h3>
        <h5 style="font-size: 100%"><a href="register.php"><strong>Join Gatherly</strong></a></h5>
		<!-- <link  type="image/png" href="icons/gLogo.png"> -->
		</div>
		</div>	

<div class="split right">
  <div class="centered">
                    <div class="row">
                        <div class="col-sm-6 credentialsWrapper">
                            <h2>Sign In</h2>
                            <form method="POST" id = "loginForum">

                                <div class="input-group emailWrapper">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input id="email" type="text" class="form-control" name="email" placeholder="Email" >
                                </div>

                                <div class="input-group passwordWrapper">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                    <input id="password" type="password" class="form-control" name="password" placeholder="Password" >
                                </div>
                                 <div class="captchaWrapper">
                                     <div class="g-recaptcha" data-sitekey="6LfpEHsUAAAAAEcSDva0UW5YEwF2n0qBdx3i1sYB" data-callback="reCaptchad"></div>
                                </div>
                                 <div class="forgotPasswordWrapper">
                                    <a href="UhOh.html">Forgot password?</a>
                                </div>

                                <div class="buttonWrapper">
                                    <button type="submit" class="btn btn-primary btn-block loginButton">Sign In</button>
                                </div>
                            </form>
                        </div>

                        <div class="col-sm-1 lineDivider">
                        </div>
                </div>
            <div class="col-xs-1"></div>
		</div>
  </div>
</div>
		<div class="footer row">
			<small >&copy;fordFanatics</small>
		</div>
	</body>
</html>
