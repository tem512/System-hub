<?php
require_once('../../config.php');
require_once('../../initialize.php');
require_once('../../classes/DBConnection.php');
include_once('../../classes/SystemSettings.php');
//session_start();
include_once "php/config.php";
?>
</div>
<?php require_once('../inc/header.php') ?>
<?php include_once "header.php"; ?>
<body class="sidebar-mini layout-fixed control-sidebar-slide-open layout-navbar-fixed sidebar-mini-md sidebar-mini-xs" data-new-gr-c-s-check-loaded="14.991.0" data-gr-ext-installed="" style="height: auto;">
    <?php require_once('../inc/navigation.php') ?>  
    <div class="wrapper">
        <section class="users">
            <header>
                <div class="content">
                    <?php
                    //$uid=$_SESSION['unique_id']; 
                    $uid = $_settings->userdata('unique_id');
                    $sql = "SELECT * FROM users WHERE unique_id = $uid";
                    $result = $conn->query($sql);
                    $row = $result->fetch_assoc();
                    ?>
                    <img src="../../<?php echo $row['avatar']; ?>" alt="">
                    <div class="details">
                        <span><?php echo $row['firstname'] . " " . $row['lastname'] ?></span>
                        <p><?php echo $row['status1']; ?></p>
                    </div>
                </div>
            </header>
            <div class="search">
                <span class="text">Select an user to start chat</span>
                <input type="text" placeholder="Enter name to search...">
                <button><i class="fas fa-search"></i></button>
            </div>
            <div class="users-list">

            </div>
        </section>
    </div>

    <script src="javascript/users.js"></script>

</body>
</html>
