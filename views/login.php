<?php
require_once('botdetect.php');
require_once('../models/session.php');

Session::logout();

$Captcha = new Captcha('LoginCaptcha');

if (isset($_POST['login'])) {
    $isHuman = $Captcha->Validate();

    if (!$isHuman) {
        echo '<div style="text-align: center; color: red; font-weight: bold;">Incorrect code</div>';
    } else {
        $r = Session::login($_POST['username'], $_POST['password']);

        if($r === true)
            header('Location: ticket.php');

        echo '<div style="text-align: center; color: red; font-weight: bold;">' . $r . '</div>';
    }
}
?>

<html lang="en">
	<head>
		<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1" />

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
        <link type="text/css" rel="Stylesheet" href="<?php echo CaptchaUrls::LayoutStylesheetUrl() ?>" />
        <link rel="stylesheet" href="../css/estilos.css">

        <script type="module" src="../js/login.js" defer></script>
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
                                $Captcha->UserInputID = 'f-captcha';
                                echo $Captcha->Html(); 
                            ?>

                            <span>&nbsp</span>
                            <div class="captcha-code">
                                <input id="f-captcha" name="f-captcha" class="form-control captcha-input" type="text" />
                            </div>

                        </div>

                        <br />
                        <button name="login" class="btn btn-primary"> Login </button>
                    </form>
                </div>
        </div>
	</div>
</body>
</html>