<?php

    session_start();
    include("connect.php");
    $mobile = $_POST['Mobile'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $check = mysqli_query($connect,"SELECT * FROM user WHERE mobile = '$mobile' AND password = '$password' AND role = '$role' ");
    if(mysqli_num_rows($check)>0){
        $userdata = mysqli_fetch_array($check);
        $groups = mysqli_query($connect,"SELECT * FROM user WHERE role='group'");
        $groupsdata = mysqli_fetch_all($groups,MYSQLI_ASSOC);

        $_SESSION['userdata'] = $userdata;
        $_SESSION['groupsdata'] = $groupsdata;

        echo "
            <script>
            window.location = '../routes/dashboard.php';
            </script>
            ";
    }
    else{
        echo "
            <script>
            alert('Invalid Credential or User not found!');
            window.location = '../';
            </script>
            ";
    }

?>