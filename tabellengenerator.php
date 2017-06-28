<?php require_once("index.php");?>

<form action="tabellengenerator.php" method="post">
	Anzahl der Zeilen:
	<input type="text" name="zeilen">
	<br>
	Anzahl der Spalten:
	<input type="text" name="spalten">
	<br>
	<input type="submit" name="submit" value="Ausgeben">
	<br><br>

	<?php
		if (isset($_POST["submit"]) && !empty($_POST["zeilen"]) && !empty($_POST["spalten"])) {
			echo "<table>";

			for ($z=1; $z<=$_POST["zeilen"]; $z++) {
				echo "<tr> ";
				for ($sp =1; $sp<=$_POST["spalten"]; $sp++) {
					echo "<td> </td>";
				}
			echo "</tr>";
			}
			echo "</table>";
		}


	?>

</form>

</body>
</html>