<?php
include_once ("config.php");

function GenerateToken() { //This will generate an token and store it in the database

	$con = mysqli_connect(SERVER_NAME, USER_NAME, PASSWORD, DATABASE_NAME);

	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	$randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 128);
	$sql = "INSERT INTO " . TOKEN_TABLE . " (token) VALUES (\"" . $randomString . "\");";
	mysqli_query($con, $sql);
	mysqli_close($con);

	return $randomString;
}

function CheckToken($token = "No token") { //This will check if the token is in the database and if it is used.
	$con = mysqli_connect(SERVER_NAME, USER_NAME, PASSWORD, DATABASE_NAME);
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	/* This is me learning how to use MYSQLI and prepared statements. */

	if ($stmt = $con -> prepare("SELECT * FROM `" . TOKEN_TABLE . "` WHERE token=?")) {

		/* bind parameters for markers */
		$stmt -> bind_param("s", $token);

		/* execute query */
		$stmt -> execute();

		/* bind result variables */
		$stmt -> bind_result($tokens, $used);

		/* fetch value */
		$stmt -> fetch();

		/* close statement */
		$stmt -> close();
	}

	if ($tokens == $token && $used == 0) {
		printf("Token: %s <br /> Used: %s <br /> Message: " . $_POST['f'] . "", $tokens, $used);

		if ($stmt = $con -> prepare("UPDATE " . TOKEN_TABLE . " SET `used`='1' WHERE `token`=?")) {

			/* bind parameters for markers */
			$stmt -> bind_param("s", $tokens);

			/* execute query */
			$stmt -> execute();

			/* close statement */
			$stmt -> close();
		}
	} else {
		printf("Token invalid or already used.");
	}
}
?>