<?php
require '../helpers.php';
require_once '../vendor/autoload.php';

session_start();

$base_url = get_base_url();
if (!isset($_SESSION['user'])) {
  header('Location: ../login.php');
  exit;
} else {
  $user = $_SESSION['user'];
}
?>