<?php session_start(); ?>
<?php require("botdetect.php"); ?>

<html lang="en">
	<head>
		<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1" />
		

        <link rel="stylesheet" href="css/estilos.css">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
        <link type="text/css" rel="Stylesheet" href="<?php echo CaptchaUrls::LayoutStylesheetUrl() ?>" />

        <script type="module" src="js/login.js" defer></script>
	</head>
<body>

	<div class="col-md-6">
        <div class= "well hoverwell well-lg  login">	
            
            <label class="title"> Login Plataforma Tickets </label>
            <hr style="border-top:1px dotted #ccc;"/>

            <div class="container">
                    <form id="data-login" action="" method="POST">

                        <div class="form-group">
                            <label for="f-usuario"> Usuario </label>
                            <input id="f-usuario" type="text" name="username" class="form-control"/>
                        </div>

                        <div class="form-group">
                            <label for="f-password"> Contraseña </label>
                            <input id="f-password" type="password" name="password" class="form-control"/>
                        </div>

                        <div class="captcha">
                            <label for="f-captcha" > Captcha </label>

                            <?php
                                $Captcha = new Captcha("LoginCaptcha");
                                $Captcha->UserInputID = "f-captcha";
                                echo $Captcha->Html(); 
                            ?>

                            <span>&nbsp</span>
                            <div class="captcha-code">
                                <input id="f-captcha" name="f-captcha" class="form-control captcha-input" type="text" />
                            </div>

                        </div>

                        <br />
                        <button name="Login" name="login-btn" class="btn btn-primary"> Login </button>
                    </form>
                </div>
        </div>
	</div>
</body>
</html>

<?php 

if ($_POST) { 
    $isHuman = $Captcha->Validate();
    
    if (!$isHuman) {
      echo "<span>Incorrect code</span>";
    } else {
        echo "<span>CORRECT code</span>";
    } 
  }


?>

