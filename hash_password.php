<?php
// Replace 'your_password_here' with the actual password you want to hash.
$hashed_password = password_hash('your_password_here', PASSWORD_DEFAULT);

// Output the hashed password.
echo $hashed_password;
?>
