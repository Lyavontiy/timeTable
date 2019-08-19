<section id="section">
		<div class="container">
			<div class="containerGridSection">
				<div class="addData styleCreateBlock">
					<h4 class="styleH4Create">Просмотр</h4>
						<div class="workWithTable">
							<a href="http://bsac.by:8080/timetable" target="_blank">Расписание</a>
								<?php 
									get_database_tables($link);
									
									if (isset($data['do_selectTable'])) {
										$basd;
										echo '<form action="" method="POST">';
											
										$option = $data['taskOption'];

										$resultSelect = mysqli_query($link,"SELECT * FROM {$option}");
										 
										if ($resultSelect) {
											if ($option == "Teachers" || $option == "Subject") {
												echo "Таблица <i>".$option."</i> не доступна для вывода!";
											} else {
												$resultXX = mysqli_query($link,"SELECT * FROM {$option}");
												echo "Выбранна таблица: <i>".$option."</i>.";
												echo '<table class="styleTableX">';

												echo "<tr>";
				    							$rowss = mysqli_fetch_assoc($resultXX);
				    							while (current($rowss)) {
				    									echo "<td>".key($rowss)."</td>";
				    									next($rowss);
				    						}
				    							echo "</tr>";
												while ($rows = mysqli_fetch_row($resultSelect)) {
												    echo "<tr class='contentRowTable".$countRowsInTable."'>";
												        for ($j = 0 ; $j < mysqli_num_fields($resultSelect) ; ++$j) {
												        	echo "<td>$rows[$j]</td>";
												        	
												        }

												    echo "</tr>";
												
												}	
												mysqli_free_result($resultSelect);
											}
											echo "</table>";
										} 
										
										echo "</form>";
									} 
									?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>