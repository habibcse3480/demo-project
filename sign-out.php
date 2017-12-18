<?php
session_start();
session_unset();
session_destroy();
ob_start();
header("location:index.php");
ob_end_flush();
exit();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Out</title>
</head>
<body>

</body>
</html>