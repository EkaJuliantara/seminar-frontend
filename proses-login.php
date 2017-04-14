<?php

ob_start();
session_start();

if ($_POST['id']) {
	$_SESSION['seminar']['id'] = $_POST['id'];
}

?>