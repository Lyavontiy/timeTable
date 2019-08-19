<?php 
    if(isset($data['do_signup'])) {
    	$idX = $data['id_ent'];
    	$passwordX = $data['pass'];
    	$password = md5(md5(md5($passwordX)));
    	$queryLogin = mysqli_query($link,"SELECT * FROM Teachers WHERE id='$idX'");
    	$userData = mysqli_fetch_array($queryLogin);

    	if ($userData['password'] == $password) {
    		$_SESSION['name'] = $userData['full_name'];	
    		echo "<script>window.open('index.php?hr=login','_self')</script>";
        } else {
            echo '<div align="center" style="color: black;">'."Логин или пароль не верный!".'</div>';
        }

    	}

    else if (isset($data['do_exite_session'])) {
    	unset($_SESSION);
    	session_unset($_SESSION["name"]);
    	session_destroy();
    	mysqli_close($link);
    }	
 
 
		if ($_SESSION['name'] == "") {
			echo '<div class="loginXX"><form action=" " method="POST">
			<div class="loginXXX">
				<h2>Авторизация</h2>
					<label for="">Идентификатор</label><br>
					<input type="text" name="id_ent" maxlength="6" minlength="6"><br>
					<label for="">Пароль</label><br>
					<input type="password" name="pass"> <br>
					<input type="submit" name="do_signup"></div>
			</form></div>
			
			';
		} else {
			
			require_once "lk.php";
			
		}
	?>

</form>
