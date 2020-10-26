
<?php
define('ADMIN', true);
require_once('../common/lib.php');
require_once('../common/define.php');
define('TITLE_ELEMENT', $texts['DASHBOARD'].' - '.$texts['LOGIN']);

$action = (isset($_GET['action'])) ? $_GET['action'] : '';

if($action == 'logout' && isset($_SESSION['user'])) unset($_SESSION['user']);

if(isset($_SESSION['user'])){
    if($_SESSION['user']['type'] != 'registered'){
        header('Location: index.php');
        exit();
    }else
        unset($_SESSION['user']);
}

if($db !== false && isset($_POST['login'])){
    $user = htmlentities($_POST['user'], ENT_COMPAT, 'UTF-8');
    $password = $_POST['password'];
    
    if(check_token('/'.ADMIN_FOLDER.'/login.php', 'login', 'post')){
        
        $result_user = $db->query('SELECT * FROM pm_user WHERE login = '.$db->quote($user).' AND pass = '.$db->quote(md5($password)).' AND checked = 1');
        if($result_user !== false && $db->last_row_count() > 0){
            $row = $result_user->fetch();
            $_SESSION['user']['id'] = $row['id'];
            $_SESSION['user']['login'] = $user;
            $_SESSION['user']['email'] = $row['email'];
            $_SESSION['user']['type'] = $row['type'];
            $_SESSION['user']['add_date'] = $row['add_date'];
            header('Location: index.php');
            exit();
        }else
            $_SESSION['msg_error'][] = $texts['LOGIN_FAILED'];
    }else
        $_SESSION['msg_error'][] = $texts['BAD_TOKEN2'];
}

if($db !== false && isset($_POST['reset'])){
    
    if(defined('DEMO') && DEMO == 1)
        $_SESSION['msg_error'][] = 'This action is disabled in the demo mode';
    else{
        $email = htmlentities($_POST['email'], ENT_COMPAT, 'UTF-8');

        if(check_token('/'.ADMIN_FOLDER.'/login.php', 'login', 'post')){

            $result_user = $db->query('SELECT * FROM pm_user WHERE email = '.$db->quote($email).' AND checked = 1');
            if($result_user !== false && $db->last_row_count() > 0){
                $row = $result_user->fetch();
                $url = getUrl();
                $new_pass = genPass(6);
                $mailContent = '
                <p>Hi,<br>You requested a new password from <a href=\"'.$url.'\" target=\"_blank\">'.$url.'</a><br>
                Bellow, your new connection informations<br>
                Username: '.$row['login'].'<br>
                Password: <b>'.$new_pass.'</b><br>
                You can modify this random password in the settings via the manager.</p>';
                if(sendMail($email, $row['name'], 'Your new password', $mailContent) !== false)
                    $db->query('UPDATE pm_user SET pass = '.$db->quote(md5($new_pass)).' WHERE id = '.$row['id']);
            }
            $_SESSION['msg_success'][] = 'A new password has been sent to your e-mail.';
        }else
            $_SESSION['msg_error'][] = 'Bad token! Thank you for re-trying by clicking on "New password".';
    }
}

$csrf_token = get_token('login'); ?>
<!DOCTYPE html>
<head>
    <?php include('includes/inc_header_common.php'); ?>
</head>
<body>
    <div class="limiter">
		<div class="container-login100" style="background-image: url('/templates/default/img/all/bg-01.jpg');">
       
        <div id="login">
        
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
            <div id="logo">
                    <img src="images/logo-admin.png" style="width:250px;">
                </div>
				<form class="login100-form validate-form"  action="login.php" method="post" role="form">
                    <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                <div class="col-sm-12 col-md-12" id="loginWrapper">
                
                
                    <div class="alert-container">
                        <div class="alert alert-success alert-dismissable"></div>
                        <div class="alert alert-warning alert-dismissable"></div>
                        <div class="alert alert-danger alert-dismissable"></div>
                    </div>
                    
					<span class="login100-form-title p-b-49">
						Giriş
                    </span>
                    <?php
                    if($action == 'reset'){ ?>
                        <p>Lütfen hesabınıza karşılık gelen e-posta adresinizi girin. Size e-posta ile yeni bir şifre gönderilecektir.</p>
                    <div class="wrap-input100 validate-input m-b-23" data-validate = "E-Mail Adresinizi Girin">
						<span class="label-input100">Kullanıcı Adı</span>
						<input class="input100" type="text" name="email" placeholder="E-Mail Adresiniz">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
                    </div>
                    <div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" type="submit" value="" name="reset" style="background:bottom;">
								Yeni Şifre
							</button>
						</div>
                    </div>
                    <div class="text-right p-t-8 p-b-31">
						<a href="login.php">
                        Giriş
						</a>
					</div>
                    <?php } else { ?>
					<div class="wrap-input100 validate-input m-b-23" data-validate = "Kullanıcı Adı Girin">
						<span class="label-input100">Kullanıcı Adı</span>
						<input class="input100" type="text" name="user" placeholder="Kullanıcı Adı">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Şifreyi Girin">
						<span class="label-input100">Şifre</span>
						<input class="input100" type="password" name="password" placeholder="Şifreniz">
						<span class="focus-input100" data-symbol="&#xf190;"></span>
					</div>
					
					<div class="text-right p-t-8 p-b-31">
						<a href="login.php?action=reset">
                        Şifremi Unuttum
						</a>
					</div>
					
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" type="submit" value="" name="login" style="background:bottom;">
								Giriş
							</button>
						</div>
                    </div>
                    <?php } ?>
					</div></div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>
<?php
$_SESSION['msg_error'] = array();
$_SESSION['msg_success'] = array();
$_SESSION['msg_notice'] = array(); ?>
