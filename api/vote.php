<?php 
    session_start();
    include("connect.php");

    if(!isset($_SESSION['userdata'])){
        header("location: ../");
        exit();
    }

    $userdata = $_SESSION['userdata'];
    $gvotes = $_POST['gvotes'];
    $gid = $_POST['gid'];
    $uid = $userdata['id'];
    // check if user already voted
    if($userdata['status']==0){
        $update_votes = mysqli_query($connect, "UPDATE user SET votes = votes + 1 WHERE id = $gid");

        $update_user = mysqli_query($connect, "UPDATE user SET status = 1 WHERE id = $uid");

        if($update_votes && $update_user){
            $_SESSION['userdata']['status'] = 1;

            $groups = mysqli_query($connect,"SELECT * FROM user WHERE role='group'");
            $_SESSION['groupsdata'] = mysqli_fetch_all($groups,MYSQLI_ASSOC);
            
            echo "
                <script>
                alert('Vote submitted successfully!');
                window.location = '../routes/dashboard.php';
                </script>
            ";
        }
        else{
            echo "
                <script>
                alert('Error submitting vote. Please try again!');
                window.location = '../routes/dashboard.php';
                </script>
            ";
        }
    }
    else{
        echo "
            
            <script>
            alert('You have already voted!');
            window.location = '../routes/dashboard.php';
            </script>
        ";
    }


?>