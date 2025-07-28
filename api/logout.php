<?php
    session_start();

    session_destroy();

    unset($_SESSION['userdata']);
    unset($_SESSION['groupsdata']);

    echo "
        <script>
        alert('Logged out successfully!');
        window.location = '../index.html';
        </script>
        ";
    

?>