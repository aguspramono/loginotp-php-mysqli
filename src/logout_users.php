<?php
session_start();

unset($_SESSION['loginuser']);
unset($_SESSION['tokenusers']);
unset($_SESSION['namausers']);
unset($_SESSION['msgerror']);
unset($_SESSION['msgsuccess']);

header("location:./../login.php");
