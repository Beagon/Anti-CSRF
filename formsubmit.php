<?php
include_once ("functions.php");
if (isset($_POST['token'])) {
	CheckToken($_POST['token']);
}
?>