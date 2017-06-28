<?php require_once("index.php"); ?>

	<h1>Aufgabe 3</h1>

	<h2>Katalog</h2>

	<?php

		if (isset($_POST["auswahl"])) {
			echo "Produkt wurde dem Warenkorb hinzugefügt!<br><br>";
		}

	?>
	
	<table>
		<tr>
			<th>Artikel</th>
			<th>Bezeichnung</th>
			<th>Einzelpreis</th>
		</tr>
		<?php
			$zeilen = 1;
			$datei = fopen("katalog.csv", "r");
			$daten =fgetcsv($datei, 1000, ";");

			while ($data = fgetcsv($datei, 1000, ";")) {
				$num = count($data);
				$zeilen++;
				$data[2] = $data[2]. " €";

				echo "<tr>";

				for ($i =0; $i<$num; $i++) {
					echo "<td>" .$data[$i]. "</td>";
				}

				echo "
					<form method='POST' action='aufgabe3.php?$data[0]''>
						<td>
							<input type='submit' name='auswahl' class='auswahl' value=''>
						</td>
					</form>";

			}
		
			fclose($datei);

		?>

		<tr>
			<td colspan="4">
				<a href="warenkorb.php">Warenkorb anzeigen</a>
			</td>
		</tr>
	</form>
	</table>
	

</body>
</html>