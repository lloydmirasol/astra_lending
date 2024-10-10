<?php
session_start();

// Destroy the session to log out the user
session_unset();
session_destroy();

// Redirect to the home page (index.html)
header("Location: index.html");
exit();
?>