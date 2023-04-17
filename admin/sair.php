<?php
session_start();
echo '<script>alert("Até logo '. $_SESSION['usuario'].'."); </script>';  
unset($_SESSION['usuario']);
session_destroy();
echo '<script>location.href="index.php";</script>';
?>