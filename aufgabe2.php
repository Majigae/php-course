<?php require_once("index.php");?>

	<h1>Aufgabe 2</h1>
	<!--Formularausgabe bei Beginn oder nicht korrekt ausgefüllt wurden-->
	<?php

		if ( !isset($_POST["submit"]) || (isset($_POST["submit"]) && ( empty($_POST["name"]) || empty($_POST["email"]) || !isset($_POST["anrede"]) || !isset($_POST["land"]) ) )) {

			//Infotext wenn Daten fehlen
			if (isset($_POST["submit"]) && ( empty($_POST["name"]) || empty($_POST["email"]) || !isset($_POST["anrede"]) || !isset($_POST["land"]))) {
				echo "<span>Bitte Eingabe bei rot markierten Felder korrigieren!\n</span><br><br>";
			}?>


			<form action="aufgabe2.php" method="post">
				<table>
					<tr>
						<?php if(isset($_POST["submit"]) && empty($_POST["name"])) {echo '<th class="leer">Name: </th>';}
								else {echo '<th>Name: </th>';}?>
						<td>
							<input type="text" name="name" value="<?php if (isset($_POST["name"])) { echo ucfirst($_POST["name"]); }?>">
						</td>
					</tr>
					<tr>
						<?php if(isset($_POST["submit"]) && empty($_POST["email"])) {echo '<th class="leer">E-Mail: </th>';}
								else {echo '<th>E-Mail: </th>';}?>
						<td>
							<input type="email" name="email" value="<?php if (isset($_POST["email"])) { echo $_POST["email"]; }?>">
						</td>
					</tr>
					<tr>
						<?php if(isset($_POST["submit"]) && !isset($_POST["anrede"])) {echo '<th class="leer">Anrede: </th>';}
								else {echo '<th>Anrede: </th>';}?>
						<td>
							<input type="radio" name="anrede" value="Herr" <?php if (isset($_POST["anrede"]) && $_POST["anrede"]=="Herr") {echo "checked";} ?> >Herr<br>
							<input type="radio" name="anrede" value="Frau" <?php if (isset($_POST["anrede"]) && $_POST["anrede"]=="Frau") {echo "checked";} ?> >Frau<br>
							<input type="radio" name="anrede" value="Firma" <?php if (isset($_POST["anrede"]) && $_POST["anrede"]=="Firma") {echo "checked";} ?> >Firma<br>
						</td>
					</tr>
					<tr>
						<?php if(isset($_POST["submit"]) && !isset($_POST["land"])) {echo '<th class="leer">Land: </th>';}
								else {echo '<th>Land: </th>';}?>
						<td>
							
							<select name="land" size="3">
								<option value="DE" <?php if (isset($_POST["land"]) && $_POST["land"]=="DE") {echo "selected=\"selected\"";}?> >DE</option>
								<option value="AT" <?php if (isset($_POST["land"]) && $_POST["land"]=="AT") {echo "selected=\"selected\"";}?> >AT</option>
								<option value="CH"<?php if (isset($_POST["land"]) && $_POST["land"]=="CH") {echo "selected=\"selected\"";}?> >CH</option>
								<option value="FR" <?php if (isset($_POST["land"]) && $_POST["land"]=="FR") {echo "selected=\"selected\"";}?> >FR</option>
								<option value="IT" <?php if (isset($_POST["land"]) && $_POST["land"]=="IT") {echo "selected=\"selected\"";}?> >IT</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							<input type="reset" name="reset" value="zurücksetzen">
						</td>
						<td>
							<input type="submit" name="submit" value="abschicken">
						</td>
					</tr>
				</table>
			</form>
			<br>
	<?php } //Ende Formular-If

	else {

		$anrede = $_POST["anrede"];
		$name = ucfirst($_POST["name"]);
		$email = $_POST["email"];
		$land = $_POST["land"];

		$text = $anrede. ";" .$name. ";" .$email. ";" .$land. "\n";

		echo $anrede. " " .$name. " aus " .$land. "<br>
				mit folgender E-Mail-Adresse: " .$email;

		echo '<br><br>';

		$daten = fopen("daten.dat" , "a+");
		flock ($daten, LOCK_EX) or die ("Kann die Datei nicht locken.");
		fputs($daten, $text);
		fclose($daten);

		$text = str_replace(";", " ", $text);


		echo '<a href="daten.dat" target="blank">daten.dat</a><br>';

		$from = "Absender: " .$anrede .$name. "<" .$email. ">";
		$empfaenger = "php@lerneniminternet.de";
		$betreff = "Aufgabe2";

		@mail($empfaenger, $betreff, $text, $from);
		echo '<span>Nachricht wurde versandt!</span>';
		echo '<br><hr><br>
					<a href="aufgabe2.php">zurück</a>';


	}
	?>


</body>
</html>
