<?php
session_start();

// ================= HAPUS SESSION =================
$_SESSION = [];
session_unset();
session_destroy();

// ================= REDIRECT =================
header("Location: ../index.php");
exit;