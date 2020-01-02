<?php
session_start();
//unset($_SESSION['suojure']);
session_unset();
//session_destroy();
header("Location: ../../");

?>