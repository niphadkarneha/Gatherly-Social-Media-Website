<style type="text/css">
	.responsive{
		width: 100%;
		height: auto;
	}

</style>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>fordFanatics</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- 		<script type="text/javascript" src="./scripts/registersitescript.js"></script> -->
<!-- 		<link rel="shortcut icon" href="./favicon.ico" type="image/x-icon"> -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!-- 		<link rel="stylesheet" href="./Assets/w3.css"> -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="register_site.css">
	</head>
	<body>

	<div class="split left">
		<div class="centered">
		<img src="icons/gLogo.png" alt="Gatherly" class="responsive">
		<!-- <link  type="image/png" href="icons/gLogo.png"> -->
		</div>
		</div>	
<!-- <div class="split left">
  <div class="centered">	
   <h2>Registration</h2>	
		<div class="container mainLoginWrapper well w3-panel w3-card-4">

			<div class="modal fade" id="successModal" role="dialog">
			    <div class="modal-dialog modal-sm">
			      <div class="modal-content">
			        <div class="modal-header">
			          <button type="button" class="close" data-dismiss="modal">&times;</button>
			          <h4 class="modal-title">Success</h4>
			        </div>
			        <div class="modal-body">

			        </div>
			        <div class="modal-footer">
			          <button type="button" class="btn btn-default signIn" data-dismiss="modal">Sign In</button>
			        </div>
			      </div>
			    </div>
			</div>
			<div class="modal fade" id="errorModal" role="dialog">
			    <div class="modal-dialog modal-sm">
			      <div class="modal-content">
			        <div class="modal-header">
			          <button type="button" class="close" data-dismiss="modal">&times;</button>
			          <h4 class="modal-title">Error</h4>
			        </div>
			        <div class="modal-body">

			        </div>
			        <div class="modal-footer">
			          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			        </div>
			      </div>
			    </div>
			</div>
			<div class="row">
				<form class="col-xs-12" id="registerForm">
					<div class="row">
						<div class="form-group col-xs-5">
					        <input type="text" class="form-control firstName" name="firstName" id="firstName" maxlength="20" required>
					        <label class="form-control-placeholder" for="firstName">First Name</label>
				      	</div>
				      	<div class="form-group col-xs-1">
				      	</div>
				      	<div class="form-group col-xs-6">
					        <input type="text" class="form-control lastName" name="lastName" id="lastName" maxlength="20" required>
					        <label class="form-control-placeholder" for="lastName">Last Name</label>
				      	</div>
				    </div>
				    <div class="row">
				      	<div class="form-group">
					        <input type="email" class="form-control email" name="email" id="email" maxlength="20" required>
					        <label class="form-control-placeholder" for="email">E-mail</label>
				      	</div>
				    </div>
				    <div class="row">
				      	<div class="form-group">
					        <input type="password" class="form-control password" name="password" id="password" maxlength="20" required>
					        <label class="form-control-placeholder" for="password">Password</label>
					    </div>
					</div>

				    </div>
				    <div class="row">
				      	<div class="form-group">
					        <input type="text" class="form-control status not_reallyrequired" name="status" maxlength="20" id="status" required>
					        <label class="form-control-placeholder" for="status">Status</label>
				      	</div>
				    </div>
				    <div class="row">
				      	<div class="form-group">
					        <input type="number" class="form-control phoneNumber not_reallyrequired" name="phoneNumber" size="10" id="phoneNumber" required>
					        <label class="form-control-placeholder" for="phoneNumber">Phone Number</label>
				      	</div>
				    </div>
					<div class="row">
						<div class="col-xs-6">
							<button type="reset" class="btn btn-block" value="reset">Clear</button>
						</div>
						<div class="col-xs-6">
							<button type="submit" id="dummysubmit" class="btn hidden" value="DummySubmit">Dummy</button>
							<button type="submit" class="btn btn-primary btn-block createUser">Submit</button>
						</div>
					</div>

					<div class="login-box">
					<a href="#" class="social-button" id="facebook-connect"> <span>Connect with Facebook</span></a>
					<a href="#" class="social-button" id="google-connect"> <span>Connect with Google</span></a>
					<a href="#" class="social-button" id="twitter-connect"> <span>Connect with Twitter</span></a>
					<a href="#" class="social-button" id="linkedin-connect"> <span>Connect with LinkedIn</span></a>
					</div>					
				</form>

			</div>
		</div>
</div>
</div> -->

<div class="split right">
  <div class="centered">
<!--     <img src="img_avatar.png" alt="Avatar man">
 -->
                    <div class="row">
                        <div class="col-sm-6 credentialsWrapper">
                            <h2>Sign In</h2>
                            <form method="POST" action="./server/login.php">

                                <div class="input-group emailWrapper">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input id="email" type="text" class="form-control" name="email" placeholder="Email" >
                                </div>

                                <div class="input-group passwordWrapper">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                    <input id="password" type="password" class="form-control" name="password" placeholder="Password" >
                                </div>
                                 <div class="forgotPasswordWrapper">
                                    <a href="#">Forgot password?</a>
                                </div>
                                <div class="captchaWrapper">

                                     <div class="g-recaptcha" data-sitekey="6LfjejsUAAAAAAPDW7-tn-daogbbotzZclSiCLSD" data-callback="reCaptchad"></div>
                                </div>
                                <div class="buttonWrapper">
                                    <button type="submit" class="btn btn-primary btn-block">Sign In</button>
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
