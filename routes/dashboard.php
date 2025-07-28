<?php

    session_start();
    if(!isset($_SESSION['userdata'])){
        header("location: ../");
    }
    $userdata = $_SESSION['userdata'];
    $groupsdata = $_SESSION['groupsdata'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Voting System - Dashboard</title>
    <link rel="stylesheet" href="../CSS/style.css">
</head>
<body>
    <style>
        .top-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 30px;
    background-color: #aac3dd;
}

.back-btn,
.logout-btn {
    padding: 8px 16px;
    background-color: #337ab7;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.back-btn:hover,
.logout-btn:hover {
    background-color: #286090;
}

.title {
    text-align: center;
    font-size: 24px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin: 10px 0;
}

#Profile{
        
        background-color: #e3effa;
        width: 30%;
        padding: 20px;
        float: left;
}
#Group{
        
        background-color: #e3effa;
        width: 60%;
        padding: 20px;
        float: right;
}
#votebtn{
    padding: 5px;
    font-size: 15px;
    background-color: #337ab7;
    color: white;
    border-radius: 5px;
}
    </style>

    <div id = "mainSection">
        <center>
        <div class="top-bar">
    <button class="back-btn" onclick="window.history.back()" >Back</button><button class="logout-btn" onclick="window.location.href='../api/logout.php'" >Logout</button>
    
    </div>

    <h1>Online Voting System</h1>
    </div>
    </center>
    <hr>
    <div id="Profile" >
        <center><img src="../uploads/<?php echo $userdata['photo'] ?>" height="100" width="100"></center><br><br>
        <b>Name: </b><?php echo $userdata['name'] ?><br><br>
        <b>Mobile: </b><?php echo $userdata['mobile'] ?><br><br>
        <b>Address: </b><?php echo $userdata['address'] ?><br><br>
        <b>Status: </b><?php echo $userdata['status'] ?><br><br>
    </div>
    <div id="Group">
        <?php
            if($_SESSION['groupsdata'] && count($_SESSION['groupsdata'])>0){
                for($i=0; $i<count($groupsdata); $i++){
                    ?>
                    <div>
                        <img style="float: right" src="../uploads/<?php echo $groupsdata[$i]['photo'] ?>" height="100" width="100">
                        <b>Group Name: </b><?php echo $groupsdata[$i]['name']?> <br>
                        <b>Votes: </b><?php echo $groupsdata[$i]['votes']?>  <br>
                        <form action="../api/vote.php" method="post">
                            <input type="hidden" name="gvotes" value="<?php echo $groupsdata[$i]['votes'] ?>">
                            <input type="hidden" name="gid" value="<?php echo $groupsdata[$i]['id'] ?>">
                            <input type="submit" name="votebtn" value="vote" id="votebtn">
                        </form>
                        </div>
                        <hr>
                        <?php
                }
            }
            else{
                echo "<p>No groups available for voting</p>";
            }
        ?>
    </div>
</body>
</html>