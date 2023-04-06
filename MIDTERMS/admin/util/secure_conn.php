<?php
    if (!isset($_SERVER['HTTPS'])) {
        $url = 'mysql://vmsd6aewymsxzdgi:zj6g5dris9kla3zv@r4wkv4apxn9btls2.cbetxkdyhwsb.us-east-1.rds.amazonaws.com:3306/ywjy0umm9qs73g4a' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        header("Location: " . $url);
        exit();
    }
?>
