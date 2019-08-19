<?php
	// Подключение БД
	session_start();
	$host = 'localhost'; // адрес сервера
	$database = 'bsac'; // имя базы данных
	$user = 'root'; // имя пользователя
	$password = 'root'; // пароль
	// Присваиванеи 
	$data = $_POST;
	// Перменная для подключения к БД
	$link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка ".mysqli_error($link));

    // Добавить учителя
    if (isset($data['do_createTeacher'])) {
    	
    	// Номер преподавателя 
    	$id_teacher = $data['id_teacher'];
    	// ФИО 
		$fullName = $data['fullName'];
		// Пароль 
		$password = $data['password'];
		// Шифрование
		$password = md5(md5(md5($password)));
		// Предмет
		$id_subject = $data['id_subject'];

		$error = '';
		if ($id_teacher == "") {
	        $error = 'Введите идентификатор!';
	    } 
	    else if ($fullName == "") {
	        $error = 'Введите ФИО!';
	    }
	    else if ($password == "") {
	        $error = 'Введите пароль!';
	    }
	    else if ($id_subject == "") {
	        $error = 'Введите идентификатор предмета!';
	    }

	    if ($error == '') {
	    	$sqlCT = mysqli_query($link, "INSERT INTO Teachers (id,full_name,password,id_subject) VALUES('$id_teacher','$fullName','$password','$id_subject')");

			if ($sqlCT) {
		    	echo "<script>alert('Преподователь ".$fullName." добавлен!');</script>";
		    	mysqli_close($link);
		    }
		    echo "<script>window.open('index.php?hr=login','_self')</script>";

	    } else {
	        // Выводим ошибку
	        echo '<div align="center" style="color: red;">' .$error . '</div>';
	    }
		

    } else if (isset($data['do_createSubject'])) {
    	$subject = 0;
    	$subject = $data['subject'];
		$fullSubject = $data['fullSubject'];

		$error = '';
		if ($subject == "") {
	        $error = 'Введите идентификатор предмета!';
	    } 
	    else if ($fullSubject == "") {
	        $error = 'Введите название предмета!';
	    }
	    
		if ($error == '') {
			$sqlCS = mysqli_query($link, "INSERT INTO Subject (id_subject,full_name_subject) VALUES('$subject','$fullSubject')");

			if ($sqlCS) {
		    	echo "<script>alert('Предмет ".$fullSubject." добавлен!');</script>";
		    	mysqli_close($link);
		    }
		    echo "<script>window.open('index.php?hr=login','_self')</script>";
		}
		else {
	        // Выводим ошибку
	        echo '<div align="center" style="color: red;">' .$error . '</div>';
	    }
		
	    
    } else if (isset($data['do_createGroup'])) {
    	
    	$nameGroup =$data['nameGroup'];
		$count =$data['countPeople'];

		// var_dump($nameGroup);	
		// var_dump($count);

		$error = '';
		if ($nameGroup == "") {
	        $error = 'Введите имя группы и предмет!';
	    } 
	    else if ($count == "") {
	        $error = 'Введите количество учащихся!';
	    }

	    if ($error == '') {
	    	$queryCreate = "CREATE Table tableWithPeople
		   	(
			    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
			    fullName VARCHAR(200) NOT NULL
			)";
			
			$result = mysqli_query($link, $queryCreate) or die("Ошибка " . mysqli_error($link));

			if($result)
			{ 
				$checks = mysqli_query($link,"RENAME TABLE tableWithPeople TO {$nameGroup}");
				
					for ($i=0; $i < $count; $i++) {
						$name = $data['people'.$i.''];
						// var_dump($name);
						$strSQL = mysqli_query($link, "INSERT INTO {$nameGroup} (fullName) VALUES ('$name')");
					}

				mysqli_close($link);	
			} else {
				echo "s";
			}
			echo "<script>window.open('index.php?hr=login','_self')</script>";
	    } else {
	        // Выводим ошибку
	        echo '<div align="center" style="color: red;">' .$error . '</div>';
	    }
		
		
    }
	

    function get_database_tables($link){
		$ret = [];
		$countCT = 0;
		$r = mysqli_query($link,"SHOW TABLES");
		if (mysqli_num_rows($r)>0){
			while($row = mysqli_fetch_array($r)){
							$ret[] = $row[0];
							$countCT++;
			}

			echo '<form method="post" action="">';
			echo "<select name='taskOption'>";
			echo "<option disabled selected>Выберите группу и предмет</option>";

			for ($k = 0; $k < $countCT; $k++) {
				echo "<option value=".$ret[$k].">".$ret[$k]."</option>";
			}

			echo "</select> ";
			echo '<input type="submit" name="do_selectTable" value="Запросить таблицу">';
			if ($_SESSION['name'] == ""){
				
			} else {
				echo '<a href="javascript:void(0)" onclick="createColumns()" class="styleLinkCreate">+</a>';
			}
			
			echo "</form>";

		return $ret;
		}
	}

?>