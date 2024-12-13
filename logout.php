<?php
session_start();

echo "Sessão encerrada!";
session_unset();
session_destroy();

header('Location: homepage.php');
exit();
?>