<?php
session_start();

if (isset($_GET['set'])) {
    $_SESSION['test'] = 'Session is working!';
    echo "Session variable set. <a href='session_test.php'>Go to test page</a>";
} else {
    echo "<pre>";
    var_dump($_SESSION);
    echo "</pre>";
    echo "<a href='session_test.php?set=1'>Set session variable</a>";
}
?>
