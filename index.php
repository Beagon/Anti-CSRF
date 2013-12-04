<?php
include_once ("functions.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Control Site Request Solution Test</title>
	</head>
	<body>
		<form action="formsubmit.php" method="post">
			<table border="0">
				<tr>
					<td>Submit:</td>
					<td>
					<input type="text"name="f"/>
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>
					<input type="submit"/>
					</td>
				</tr>
				<tr>
					<td>Token:</td>
					<td>
					<input type="text" value="<?php $token = GenerateToken(); echo $token; ?>"/>
					<input type="hidden" name="token" value="<?php echo $token ?>"/>
					</td>
				</tr>
			</table>
		</form>
	</body>
</html>