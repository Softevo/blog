<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['user_type']!='admin') {
	header('Location:login.php?msg=notloggedin');

}
