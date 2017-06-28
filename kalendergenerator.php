<?php require_once("index.php");?>

<form action="kalendergenerator.php" method="post">
	Anzahl der Tage im Monat:
	<input type="text" name="tage">
	<br>
	1. Monatstag
	<select name="tagEins">
		<option value="0">Montag</option>
		<option value="1">Dienstag</option>
		<option value="2">Mittwoch</option>
		<option value="3">Donnerstag</option>
		<option value="4">Freitag</option>
		<option value="5">Samstag</option>
		<option value="6">Sonntag</option>
	</select>
	<br>
	<input type="submit" name="submit" value="Ausgeben">
</form>

<?php
	if (isset($_POST["submit"])) {
		$ausgabe = "<table border='1'>";
		$ausgabe .= "<tr><th>Mo</th><th>Di</th><th>Mi</th><th>Do</th>";
		$ausgabe .= "<th>Fr</th><th>Sa</th><th>So</th></tr>";

		$zelle =0;

		for ($sp=0; $sp<$_POST["tagEins"]; $sp++) {
			$ausgabe .= "<td> </td>";
			$zelle++;
		}
		for ($sp=1; $sp<=$_POST["tage"]; $sp++) {
			$ausgabe .= "<td>$sp</td>";
			$zelle++;
			if ($zelle ==7) {
				$ausgabe .= "</tr> <tr>";
				$zelle =0;
			}
		}
		for ($sp=$zelle; $sp<7; $sp++) {
			$ausgabe .= "<td> </td>";
			$zelle++;
		}

		echo $ausgabe;

	}



?>


</body>
</html>