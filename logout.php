<?php
session_start();

unset($_SESSION['isLogin']);
unset($_SESSION['student_id']);
unset($_SESSION['roll_number']);

echo "<script>location.href='login.php';</script>";
?>