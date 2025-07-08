<?php
session_start();
session_destroy();
header("Location: view/user/index.php");
exit;
?>