<?php require_once("index.php");?>


	<h1>Aufgabe 3</h1>
	
	<h2>Warenkorb</h2>
	
	<table>
		<tr>
			<th>Artikelnummer</th>
			<th>Bezeichnung</th>
			<th>Anzahl</th>
			<th>Einzelpreis</th>
			<th>Gesamtpreis</th>
		</tr>

		<?php

			$zeilen = "";
			$data ="";
			$gesamtsumme= 0;
			$datei = fopen("katalog.csv", "r");

			while ($data = fgetcsv($datei, 1000, ";")) {

				//Artikel bearbeiten
				if (isset($_POST["edit"][$data[0]])) {
					$artAnzahl = ($_POST["anzahl"][$data[0]]);
					$_SESSION[$data[0]] = $artAnzahl;
				}

				//Artikel löschen
				if (isset($_POST["delete-$data[0]"])) {
					unset($_SESSION[$data[0]]);
					echo "Produkt wurde aus dem Warenkorb entfernt!<br><br>";
				}

				if (!isset($_SESSION[$data[0]])) {
					$artNummer = $data[0];
					continue;
				}

				$artNummer = $data[0];
				$artBezeichnung = $data[1];
				$artAnzahl = $_SESSION[$data[0]];
				$artPreis = $data[2] . " €";
				$artSumme = number_format($artAnzahl * str_replace (",", ".", $artPreis), 2, ",", "") . " €";
				$gesamtsumme = number_format(str_replace(",", ".", $gesamtsumme) + str_replace(",", ".", $artSumme), 2, ",", ""). " €";
			

				echo "
					<tr>
						<td>$artNummer</td>
						<td>$artBezeichnung</td>
						<td>
							<form action='warenkorb.php' method='POST' name='produktdaten'>
								<input name='id' value='$data[0]' type='hidden'>";
								if (!isset($_POST["kaufen"])) {
									if (!isset($_POST["bestellung"]) || isset($_POST["bearbeiten"])) {
										echo "
											<input name='anzahl[$data[0]]' type='text' 	value='$artAnzahl' size='4'>
											<input name='edit[$data[0]]' type='submit' value='ändern'>";
									}
								}
								if (isset($_POST["bestellung"]) || isset($_POST["kaufen"])) {
									echo $artAnzahl;
								}
						
				echo "</td>
					<td>$artPreis</td>
					<td>$artSumme</td>";
					if (!isset($_POST["kaufen"])) {
						if (!isset($_POST["bestellung"]) || isset($_POST["bearbeiten"])) {
							echo "
								<td>
									<input name='delete-$data[0]' type='submit' value='Artikel löschen'>
								</td>";
						};
					}
				echo "</tr>";

				$zeilen = $artNummer. ";" .$artBezeichnung. ";" .$artAnzahl. ";" .$artPreis. ";" .$artSumme. "\n";
			
			};


			echo "<tr>
					<th colspan='4' style='text-align: right;' >
						Gesamtpreis: 
					</th>
					<th class='highlight'>$gesamtsumme</th>
					";
			fclose($datei);
		?>

		<tr>
			<td colspan='2' style='text-align: left;'>
				<a href="aufgabe3.php">zurück zum Katalog</a>
			</td>
			<td colspan='4' style='text-align: right;'>
				<?php
					if (isset($_POST["bestellung"]) || isset($_POST["kaufen"])) {
						echo "
							<input type='submit' name='bearbeiten' value='Warenkorb bearbeiten'>";
					}
					else {
						echo "
							<input type='submit' name='bestellung' class='highlight' value='weiter >'>";
					}
				?>
			</td>
		</tr>
	</table>
	<br><br>

<!--Kontaktformular-->

	<?php
		if (isset($_POST["bestellung"]) || (isset($_POST["kaufen"]) && ( empty($_POST["name"]) || empty($_POST["email"]) || !isset($_POST["anrede"]) || !isset($_POST["land"]) || !isset($_POST["zahlungsart"])))   ) {

			if (isset($_POST["kaufen"]) && ( empty($_POST["name"]) || empty($_POST["email"]) || !isset($_POST["anrede"]) || !isset($_POST["land"]) || !isset($_POST["zahlungsart"])   )      ) {
				echo "<span>Bitte Eingabe bei rot markierten Felder korrigieren!\n</span><br><br>";
			}

	?>

	<h2>Kontaktdaten</h2>
			
		<table>
			<tr>
				<?php if(isset($_POST["kaufen"]) && !isset($_POST["anrede"])) {echo '<th class="leer">Anrede: </th>';}
								else {echo '<th>Anrede: </th>';}?>
				<td>
					<input type="radio" name="anrede" value="Herr" <?php if (isset($_POST["anrede"]) && $_POST["anrede"]=="Herr") {echo "checked";} ?> >Herr
					<input type="radio" name="anrede" value="Frau" <?php if (isset($_POST["anrede"]) && $_POST["anrede"]=="Frau") {echo "checked";} ?> >Frau
					<input type="radio" name="anrede" value="Firma" <?php if (isset($_POST["anrede"]) && $_POST["anrede"]=="Firma") {echo "checked";} ?> >Firma
				</td>
			</tr>
			<tr>
				<?php if(isset($_POST["kaufen"]) && empty($_POST["name"])) {echo '<th class="leer">Name: </th>';}
					else {echo '<th>Name: </th>';}?>
				<td>
					<input type="text" name="name" value="<?php if (isset($_POST["name"])) { echo ucfirst($_POST["name"]); }?>">
				</td>
			</tr>
			<tr>
				<?php if(isset($_POST["kaufen"]) && empty($_POST["email"])) {echo '<th class="leer">E-Mail: </th>';}
					else {echo '<th>E-Mail: </th>';}?>
				<td>
					<input type="email" name="email" value="<?php if (isset($_POST["email"])) { echo $_POST["email"]; }?>">
				</td>
			</tr>		
			<tr>
				<?php if(isset($_POST["kaufen"]) && !isset($_POST["land"])) {echo '<th class="leer">Land: </th>';}
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
				<?php if(isset($_POST["kaufen"]) && !isset($_POST["zahlungart"])) {echo '<th class="leer">Zahlungart: </th>';}
								else {echo '<th>Zahlungsart: </th>';}?>
				<td>
					<input type="radio" name="zahlungart" value="Kreditkarte" <?php if (isset($_POST["zahlungart"]) && $_POST["zahlungart"]=="Kreditkarte") {echo "checked";} ?> >Kreditkarte
					<input type="radio" name="zahlungart" value="Vorauskassa" <?php if (isset($_POST["zahlungart"]) && $_POST["zahlungart"]=="Vorauskassa") {echo "checked";} ?> >Vorauskassa
				</td>
			</tr>
			<tr>
				<td>
					<input type="reset" name="reset" value="zurücksetzen">
				</td>
				<td>
					<input type="submit" name="kaufen"  class="highlight" value="Kostenpflichtig bestellen">
				</td>
			</tr>
		</table>
		</form>

	<?php
		} //Ende if
		if (isset($_POST["kaufen"]) && ( !empty($_POST["name"]) && !empty($_POST["email"]) && isset($_POST["anrede"]) && isset($_POST["land"]) && isset($_POST["zahlungsart"])   )      ) {

			$anrede = $_POST["anrede"];
			$name = $_POST["name"];
			$email = $_POST["email"];
			$land = $_POST["land"];
			$zahlungsart = $_POST["zahlungsart"];

			$zeile .= $anrede. ";" .$name. ";" .$email. ";" .$land. ";" .$zahlungsart. "\n";


			$bestellung = fopen("bestellung.dat", "a+");
			flock ($bestellung, LOCK_EX) or die ("Kann die Datei nicht locken.");
			fputs($bestellung, $zeile);
			fclose($bestellung);

			echo '<a href="bestellung.dat" target="blank">bestellung.dat</a><br>';
		}

	

	?>


	

</body>
</html>