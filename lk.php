<section id="section">
		<div class="container">
			<div class="containerGridSection">
				<!-- Создать -->
				<div class="styleTitleBlock">
					<h4 class="styleH4Create">
						Добавить			
					</h4>
				</div>

				<div class="createteache styleCreateBlock">
					<h4 class="styleH4Create">
						<b>+</b> Преподаватель
					</h4>
					<form action="" class="designForm" method="POST">
						<input type="text" placeholder="Идентификатор преподавателя"  name="id_teacher" maxlength="6" minlength="6">
						<input type="text" placeholder="Фамилия Имя Отчество" name="fullName">
						<input type="password" placeholder="Пароль" name="password">
						<input type="text" placeholder="Идентификатор предмета" name="id_subject" maxlength="3" minlength="1">

						<input type="submit" value="Добавить" name="do_createTeacher">
					</form>
				</div>

				<div class="createSubject styleCreateBlock">
					<h4 class="styleH4Create">
						<b>+</b> Предмет
					</h4>
					<form action="" class="designForm" method="POST">
						<input type="text" placeholder="Идентификатор предмета" name="subject" maxlength="1" minlength="3">
						<input type="text" placeholder="Полное название предмета" name="fullSubject">

						<input type="submit" value="Добавить" name="do_createSubject">
					</form>
				</div>

				<div class="createGroup styleCreateBlock">
					<h4 class="styleH4Create">
						<b>+</b> Группа 
					</h4>
					<form action="" class="designForm" method="POST">
						<input type="text" placeholder="Инструкция по наведению*" title="Введите номер группы и предмет. Например, ТО512_АТPО. Язык ввода символов - Английский." name="nameGroup">
						<input type="text" placeholder="Кол-во учащихся в группе" name="countPeople" id="fieldCountCreateGroup" onBlur="inputPeopleGroup()" maxlength="2" minlength="1">

						<table>
							<div class="createfield">	
								<!-- create JS -->
							</div>
						</table>

						<input type="submit" value="Добавить" name="do_createGroup">
					</form>
				</div>

				<div class="createSubjectInGroup styleCreateBlock">
					<h4 class="styleH4Create">
						Список предметов (id)
					</h4>
					<p><span>*</span> Идентификатор предмета указан перед наименованием!</p>
					<!-- Высасывание предметов из бд -->
					<div class="subjectlist">
						<?php 
							$getSubject = mysqli_query($link,"SELECT * FROM Subject");

							echo "<ul class='ulSubjects'>";
							while($row=mysqli_fetch_array($getSubject)){
								echo '<li>'.$row['id_subject'].'. '.$row['full_name_subject'].'</li>';// выводим данные
							}
							echo "</ul>";
						?>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section id="section">
		<div class="container">
			<div class="containerGridXection">
				<!-- Создать -->
				<div class="styleTitleBlock">
					<h4 class="styleH4Create">
						Учет успеваемости и посещаемости
					</h4>
				</div>

				<div class="addData styleCreateBlock">
					<h4 class="styleH4Create">Взаимодействие</h4>
						<div class="workWithTable">
								<?php 
									get_database_tables($link);
									
									if (isset($data['do_selectTable'])) {
										$basd;
										echo '<form action="" method="POST">';
											
										$option = $data['taskOption'];
										$_SESSION['option'] = $option;

										$resultSelect = mysqli_query($link,"SELECT * FROM {$option}");
										 
										if ($resultSelect) {
											
											if ($option == "Teachers" || $option == "Subject") {
												echo "Таблица <i>".$option."</i> не доступна для вывода!";
											} else {
												$resultXX = mysqli_query($link,"SELECT * FROM {$option}");
												echo "Выбранна таблица: <i>".$option."</i>.";
												echo '<table class="styleTableX">';

												echo "<tr class='titleRowTable'>";
												$rowss = 0;
				    							$rowss = mysqli_fetch_assoc($resultXX);
				    							while (current($rowss)) {
				    									echo "<td>".key($rowss)."</td>";
				    									next($rowss);
				    							}
				    							echo "</tr>";
				    							$countRowsInTable = 0;
												while ($rows = mysqli_fetch_row($resultSelect)) {
													$countRowsInTable++;
												    echo "<tr class='contentRowTable".$countRowsInTable."'>";
												        for ($j = 0 ; $j < mysqli_num_fields($resultSelect) ; ++$j) {
												        	echo "<td>$rows[$j]</td>";
												        	$GLOBALS['basd']++;
												        }

												    echo "</tr>";
												    
												    $_SESSION['count'] = $GLOBALS['basd'];
												}
												var_dump($countRowsInTable);
												echo "<script>var domain='$countRowsInTable';</script>";
												mysqli_free_result($resultSelect);
											}

										}
										echo '<input type="submit" name="do_addTableColumns" value="Внести изменения">'; 
										echo "</form>";
										echo "</table>";
									} 
									
									// обновлнеи
									$zzz = 'none';
									if (isset($data['do_addTableColumns'])) {
										$teststst = $data['titleAddColumns'];
										$nameTableAdd = $_SESSION['option'];
										$teststst=mysqli_real_escape_string($link,$teststst);
										// var_dump($teststst);

										// "ALTER TABLE {$_SESSION['option']} ADD ' . $teststst . '" VARCHAR(200) NOT NULL"
										$queryAddColumns = mysqli_query($link,'ALTER TABLE '.$nameTableAdd.' ADD `'.$teststst.'` VARCHAR(20) NOT NULL') or die("Ошибка " . mysqli_error($link));

										// mysql_close($link);
										// $link = mysqli_connect($host, $user, $password, $database) or die("Ошибка ".mysqli_error($link))
										// sql-mode="" in my.ini file;
										// mysql.server restart;
										if ($queryAddColumns) {
											for ($i = 1; $i < $_SESSION['count'] - 1; $i++) { 
												$academicPerformance = $data['informationColumn'.$i.''];
												
												if ($academicPerformance == "") {
													$academicPerformance = '-';
												}

												$strSQLi = mysqli_query($link, "UPDATE $nameTableAdd SET $teststst = '$academicPerformance' WHERE id = $i") or die('Ошибка ' . mysqli_error($link));
											}
											echo "Данные в добавлены!";
										}
										// var_dump($teststst);
										unset($_SESSION['option']);
										unset($_SESSION['count']);									
									}
								?>

						</div>
					</div>
				</div>
			</div>
	</section>

