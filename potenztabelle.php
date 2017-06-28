<?php require_once("index.php");

function potenzieren ($basis, $exponent) {
	if ($exponent<0) {
		$exponent =1;
	}
	$ergebnis=1;
	for ($i =0; $i <$exponent; $i++) {
		$ergebnis = $ergebnis * $basis;
	}
	return $ergebnis;
}

echo "<table border='1'><tr><th> </th>";
for ($i =1; $i <=6; $i++) {
	echo "<th>$i</th>";
}
echo "</tr>";

for ($t =1; $t<=10; $t++) {
	echo "<tr><th>$t</th>";
	for ($i=1; $i<=6; $i++) {
		$erg = potenzieren ($t, $i);
		if ($erg >100000) {
			$farbe = "bgcolor='red'";
		}
		elseif($erg >10000) {
			$farbe = "bgcolor='yellow'";
		}
		elseif($erg >1000) {
			$farbe = "bgcolor='blue'";
		}
		elseif($erg >100) {
			$farbe = "bgcolor='green'";
		}
		else {
			$farbe = "bgcolor='white'";
		}

		echo "<td $farbe>$t<sup>$i</sup>=$erg</td>";
	}
	echo "</tr>";
}

?>


</body>
</html>