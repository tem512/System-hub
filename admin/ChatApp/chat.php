<?php
require_once('../../config.php');
require_once('../../initialize.php');
require_once('../../classes/DBConnection.php');
include_once('../../classes/SystemSettings.php');
//session_start();
include_once "php/config.php";
if (1 < 0) {
    header("location: login.php");
}
?>
<?php require_once('../inc/header.php') ?>
<?php include_once "header.php"; ?>
<body class="sidebar-mini layout-fixed control-sidebar-slide-open layout-navbar-fixed sidebar-mini-md sidebar-mini-xs" data-new-gr-c-s-check-loaded="14.991.0" data-gr-ext-installed="" style="height: auto;">

    <?php require_once('../inc/navigation.php') ?>  
    <div class="wrapper">
        <section class="chat-area">
            <header>
                <?php
                $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
                $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");
                if (mysqli_num_rows($sql) > 0) {
                    $row = mysqli_fetch_assoc($sql);
                } else {
                    header("location: users.php");
                }
                ?>
                <a href="index.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                <img src="../../<?php echo $row['avatar']; ?>" alt="">
                <div class="details">
                    <span><?php echo $row['firstname'] . " " . $row['lastname'] ?></span>
                    <p><?php echo $row['status1']; ?></p>
                </div>
            </header>
            <div class="chat-box">

            </div>
            <form action="#" class="typing-area">
                <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
                <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
                <button><i class="fab fa-telegram-plane"></i></button>
            </form>
        </section>
    </div>

    <script src="javascript/chat.js"></script>

</body>
</html>
