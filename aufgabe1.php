<?php require_once("index.php");?>


	<!--Anlegen der Deutsch/Englisch-Dateien-->
	<?php
		$text = array("Kuchen", "Tier", "Baum", "Haus", "Straße", "Garten");
		$deutsch1 = fopen("deutsch1.dat", "w");
		for ($zeile=0; $zeile<sizeof($text); $zeile++)
		{
			fputs($deutsch1, $text[$zeile] ."\n");
		}
		fclose($deutsch1);

		$text = array("Auto", "Fluss", "Stadt");
		$deutsch2 = fopen("deutsch2.dat", "w");
		for ($zeile=0; $zeile<sizeof($text); $zeile++)
		{
			fputs($deutsch2, $text[$zeile] ."\n");
		}
		fclose($deutsch2);

		$text = array("cake", "animal", "tree", "house", "street", "garden");
		$englisch1 = fopen("englisch1.dat", "w");
		for ($zeile=0; $zeile<sizeof($text); $zeile++)
		{
			fputs($englisch1, $text[$zeile] ."\n");
		}
		fclose($englisch1);

		$text = array("car", "river", "town");
		$englisch2 = fopen("englisch2.dat", "w");
		for ($zeile=0; $zeile<sizeof($text); $zeile++)
		{
			fputs($englisch2, $text[$zeile] ."\n");
		}
		fclose($englisch2);

	?>

	<h1>Aufgabe 1</h1>
	<!--Formularausgabe bei Beginn oder wenn Datei u./o. Richtung nicht ausgewählt wurden-->
	<?php 


		if ( !isset($_POST["submit"]) || (isset($_POST["submit"]) && ( !isset($_POST["dateiauswahl"]) || !isset($_POST["richtung"]) ) )) { ?>
	
			<form action="aufgabe1.php" method="post">
				<table>
					<tr>
						<td>
							<h2>Dateiauswahl</h2>
							<br>
							<select name="dateiauswahl" size="2">
								<option value="deutsch1.dat">deutsch1.dat</option>
								<option value="deutsch2.dat">deutsch2.dat</option>
							</select>
						</td>
						<td>
							<h2>Richtung</h2>
							<br>
							<input type="radio" name="richtung" value="de-en" id="de-en">
							<label for="de-en">Deutsch - Englisch</label>
							<br>
							<input type="radio" name="richtung" value="en-de" id="en-de">
							<label for="en-de">Englisch - Deutsch</label>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<input type="submit" name="submit" value="Ausgeben">
						</td>
					</tr>
				</table>
			</form>
			<br>

	<?php 
		//Infotext dass Datei u./o. Richtung nicht angegeben wurden
		if (isset($_POST["submit"]) && ( !isset($_POST["dateiauswahl"]) || !isset($_POST["richtung"]) ) ) {
				echo "<span>Bitte Datei UND Richtung angeben!\n</span>";
		}

		//Erzeugung der Übersetzungsdatei wenn Submit, Datei und Richtung ok 
		}

		if ( isset($_POST["submit"]) && isset($_POST["dateiauswahl"]) && isset($_POST["richtung"]) ) {

			$trenner = " --> ";
			$uebersetzung = fopen("uebersetzung.dat", "w+");
		
			$dateiauswahl = $_POST["dateiauswahl"];

			//Auswahl von Englischer-Datei
			$englisch = "";
			if ($dateiauswahl == "deutsch1.dat") {
				$englisch = file("englisch1.dat");
			}
			else {
				$englisch = file("englisch2.dat");
			}

			$dateiauswahl = file($dateiauswahl);

			//Angabe der Richtung
			$richtung = $_POST["richtung"];
			if ($richtung == "de-en") {
					for ($zeile=0; $zeile<sizeof($dateiauswahl); $zeile++) {
						fputs($uebersetzung, $dateiauswahl[$zeile] .$trenner);
						$zeile = $zeile--;
						fputs($uebersetzung, $englisch[$zeile] ."\n");

					}
				}
				
			
			else {
				for ($zeile=0; $zeile<sizeof($dateiauswahl); $zeile++) {
						fputs($uebersetzung, $englisch[$zeile] .$trenner);
						$zeile = $zeile--;
						fputs($uebersetzung, $dateiauswahl[$zeile] ."\n");

						
					}
			}
			
			fclose($uebersetzung);



			echo '<pre><br>';
			include("uebersetzung.dat");	
			echo '</pre>';



	?>
	</center>
	<br>
	<?php 
		echo '<h2><a href="aufgabe1.php">zurück</a></h2>';
	?>
	<br><hr><br>
	<!--Ausgabe der Dateien wenn Submit, Datei und Richtung ok-->
	<ul>
		<li><a href="deutsch1.dat" target="blank">deutsch1.dat</a></li>
		<li><a href="deutsch2.dat" target="blank">deutsch2.dat</a></li>
		<li><a href="englisch1.dat" target="blank">englisch1.dat</a></li>
		<li><a href="englisch2.dat" target="blank">englisch2.dat</a></li>
		<li><a href="uebersetzung.dat" target="blank">uebersetzung.dat</a></li>
	</ul>


	<?php } ?>


</body>
</html>