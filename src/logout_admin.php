<?php
session_start();

unset($_SESSION['loginadmin']);
unset($_SESSION['tokenadmin']);
unset($_SESSION['namaadmin']);
unset($_SESSION['msgerror']);
unset($_SESSION['msgsuccess']);

header("location:./../login.php");
