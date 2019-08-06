
<?php
/*
echo "check ";
$link = mysqli_connect("localhost", "numaanan_omerriener", "yjZWS*hvArbx", "numaanan_omerriener");

/* check connection 
if (mysqli_connect_errno()) {
	echo "check1a ";
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
echo "check2 ";

/* Select queries return a resultset
if ($result = mysqli_query($link, "SELECT * FROM users")) {
	echo "check2a ";

	if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo $row["id"]. " - Name: " . $row["name"]. " " . $row["email"].  " " . $row["type"] . "<br>";
		}
	} else {
		echo "0 results";
	}
    /* free result set 
    mysqli_free_result($result);
}
echo "check3 ";
mysqli_close($link);
*/
?>
