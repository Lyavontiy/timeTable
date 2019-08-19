<?php 
require 'code.php';
?>
<head>
	<title>Name</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script type="text/javascript" src="script/script.js?5"></script>
	<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
</head>
<body>
	<header id="header">
		 <div class="container">
		 	<div class="title">
		 		<a href="index.php">Электронный журнал</a>
		 	</div>
		 	<div class="login">
		 		<?php 
		 			// if () {
		 			// 	echo "<a href="">Авторизация</a>";
		 			// } else {
		 			// 	echo "<a href="">Кабинет</a>";
		 			// }
		 		 ?>
		 		 <?php 
						if ($_SESSION['name'] == ""){
							echo '<a href="index.php?hr=login">Авторизация</a>';
						} else {
							echo '<a href="index.php?hr=login">Кабинет</a>';
							echo'<form action="" method="post">
								<input type="submit" name="do_exite_session" value="Выйти">
								</form>';
						}
					 ?>
		 	</div>
		 </div>
	</header>
	
			<?php 
				if ($_GET["hr"] == "login"){
					require_once 'login.php';
				}
				else if ($_GET["hr"] == ""){
					require_once 'head.php';
				}

			 ?>

	

</body>
</html>
