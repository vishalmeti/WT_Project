<?php
session_abort();

// echo '<script>alert("You have successfully logged out")</script>'; 
header('location: logout.html');
?>