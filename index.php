

<?php require_once('./config.php'); ?>
<!DOCTYPE html>
<html lang="en" class="" style="height: auto;">
    <style>

        #header{
            height:70vh;
            width:calc(100%);
            position:relative;
            top:-1em;
        }
        #header:before{
            content:"";
            position:absolute;
            height:calc(100%);
            width:calc(100%);
            background-image:url(<?= validate_image($_settings->info("cover"))?>);
            background-size:cover;
            background-repeat:no-repeat;
            background-position: center center;
        }
        #header>div{
            position:absolute;
            height:calc(100%);
            width:calc(100%);
            z-index:2;
        }

        #top-Nav a.nav-link.active {
            color: #001f3f;
            font-weight: 900;
            position: relative;
        }
        #top-Nav a.nav-link.active:before {
            content: "";
            position: absolute;
            border-bottom: 2px solid  #7a005c;
            width: 33.33%;
            left: 33.33%;
            /* Custom CSS */
            .facility-item {
                border-radius: 10px;
                padding: 5px;
                text-align: center;
            }
            .facility-text {
                padding-top: 5px;
            }
        </style>








        <?php require_once('inc/header.php') ?>
        <body class="layout-top-nav layout-fixed layout-navbar-fixed" style="height: auto;">
            <div class="wrapper">
                <?php $page = isset($_GET['page']) ? $_GET['page'] : 'home'; ?>
                <?php require_once('inc/topBarNav.php') ?>
                <?php if ($_settings->chk_flashdata('success')): ?>
                    <script>
                        alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
                    </script>
                <?php endif; ?>    
                <!-- Content Wrapper. Contains page content -->

                <?php if ($page == "home" || $page == "about_us"): ?>
                    <!--<div id="header" class="shadow mb-4">
                          <div class="d-flex justify-content-center h-100 w-100 align-items-center flex-column px-3">
                            <h1 class="w-100 text-center site-title"><?php echo $_settings->info('name') ?></h1>
                            <a href="./?page=programs" class="btn btn-lg btn-light rounded-pill w-25" id="enrollment"><b>Explore Our Services</b></a>
                        </div>
                    </div>-->

                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <meta content="width=device-width, initial-scale=1.0" name="viewport">
                        <meta content="" name="keywords">
                        <meta content="" name="description">

                        <title>School Facilities</title>
                        <!-- Bootstrap CSS -->
                        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
                        <!-- Font Awesome CSS -->
                        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
                        <!-- Animate CSS -->
                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

                        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

                        <style>
                            /* Custom CSS */
                            .facility-item {
                                border-radius: 10px;
                                padding: 5px;
                                text-align: center;
                            }
                            .facility-text {
                                padding-top: 5px;
                            }
                        </style>
                    </head>
                    <body>


                        <!-- Facilities Start -->
                        <div class=" py-7">
                            <div class="container">
                                <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                                    <h1 class="mb-3"> Our Services</h1>
                                    <p>ESS Daycare centers prioritize secure often equipped with camera surveillance, to maintain a safe environment 
                                        for children. Concurrently, they emphasize educational activities, nutritious meals, 
                                        and effective parental communication to nurture children's development and foster trust among families.</p>
                                </div>

                                <div class="row g-4">
                                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                                        <div class="facility-item">

                                            <div class="facility-icon bg-primary">
                                                <span class="bg-primary"></span>
                                                <i class="fas fa-child fa-3x"></i>
                                                <span class="bg-primary"></span>
                                            </div>



                                            <div class="facility-text bg-primary">
                                                <h3 class="text-primary mb-3">Child Supervision</h3>
                                                <p class="mb-0"> Daycare centers provide a secure and monitored environment for children, often managed 
                                                    by camera systems, while their parents or guardians are at work or attending to other responsibilities.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                                        <div class="facility-item">
                                            <div class="facility-icon bg-success">
                                                <span class="bg-success"></span>
                                                <i class="fas fa-utensils fa-3x text-success"></i>
                                                <span class="bg-success"></span>
                                            </div>
                                            <div class="facility-text bg-success">
                                                <h3 class="text-success mb-3">Healthy Meals</h3>
                                                <p class="mb-0">Parents' involvement in meal preparation by accepting contributions from home.
                                                    staff ensures that these meals are appropriately stored and served according to the parents' instructions.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                                        <div class="facility-item">
                                            <div class="facility-icon bg-warning">
                                                <span class="bg-warning"></span>
                                                <i class="fas fa-hospital fa-3x text-warning"></i>
                                                <span class="bg-warning"></span>
                                            </div>
                                            <div class="facility-text bg-warning">
                                                <h3 class="text-warning mb-3">Healthcare Services</h3>
                                                <p class="mb-0"> Certain daycares provide basic healthcare, including first aid and medication administration 
                                                    for minor illnesses or accidents, ensuring the safety and well-being of children under their care.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                                        <div class="facility-item">
                                            <div class="facility-icon bg-info">
                                                <span class="bg-info"></span>
                                                <i class="fas fa-comments fa-3x text-info"></i>
                                                <span class="bg-info"></span>
                                            </div>
                                            <div class="facility-text bg-info">
                                                <h3 class="text-info mb-3">Family Communication</h3>
                                                <p class="mb-0"> ESS daycare contact with parents, updating them
                                                    on their child's activities, progress, and any issues, while also scheduling 
                                                    breastfeeding times to accommodate infants' needs.</p>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <?php include("welcome.html") ?>
                            </div>

                        </div>
                        <!-- Facilities End -->





                        <!-- Call To Action Start -->
                        <div class="container-xxl py-5">
                            <div class="container">
                                <div class="bg-light rounded">
                                    <div class="row g-0">

                                        <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                                            <div class="h-100 d-flex flex-column justify-content-center p-5">
                                                <h1 class="mb-4">Welcome to ESS daycare!</h1>
                                                <p class="mb-4">We are committed to supporting our staff's professional growth and well-being through a range of initiatives.
                                                    One of our key focuses is ensuring that our employees can perform their duties safely and efficiently without disruptions.
                                                    In addition to promoting a safe work environment.
                                                    This proximity allows our employees to visit their children during breaks or other suitable times throughout the day, fostering a strong bond between parent and child. 
                                                    Moreover, our daycare environment is designed to be breastfeeding-friendly, providing comfortable and private spaces where mothers can nurse their infants as needed. 
                                                    When employees feel supported in balancing their work and family responsibilities, they are more likely to feel valued and motivated in their roles. 
                                                    Through our comprehensive approach to staff support and childcare, we aim to build a positive and thriving community within our organization.
                                                </p>

                                            </div>
                                        </div>
                                        <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s" style="min-height: 400px;">
                                            <div class="position-relative h-100">
                                                <img class="position-absolute w-100 h-100 rounded" src="img/call-to-action11.jpg" style="object-fit: cover;">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Call To Action End -->





                        <!-- About Start -->
                        <div class="container-xxl py-5">
                            <div class="container">
                                <div class="row g-5 align-items-center">
                                    <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                                        <h1 class="mb-4"> About Us </h1>
                                        <p>ESS Daycare is a pioneering organization committed to providing exceptional early childhood education and care. With a mission rooted in 
                                            fostering a nurturing and stimulating environment for young minds to flourish, we prioritize the holistic development of every child in our care. Our innovative programs, dedicated staff, and unwavering commitment to excellence set us apart as leaders in the field of early education. At ESS Daycare, we believe in the power of early learning to shape the future, and we are proud to be a trusted partner in the journey of each child's growth and discovery.
                                        </p>
                                        <div class="row g-4 align-items-center">
                                            <div class="col-sm-6">

                                                <a class="btn btn-primary rounded-pill py-3 px-5" href="about_us.php">Read More</a>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="d-flex align-items-center">

                                                    <div class="ms-3">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 about-img wow fadeInUp" data-wow-delay="0.5s">
                                        <div class="row">
                                            <div class="col-12 text-center">
                                                <img class="img-fluid w-75 rounded-circle bg-light p-3" src="img/about-11.jpg" alt="">
                                            </div>
                                            <div class="col-6 text-start" style="margin-top: -150px;">
                                                <img class="img-fluid w-100 rounded-circle bg-light p-3" src="img/about-2222.jpg" alt="">
                                            </div>
                                            <div class="col-6 text-end" style="margin-top: -150px;">
                                                <img class="img-fluid w-100 rounded-circle bg-light p-3" src="img/about-3333.jpg" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- About End -->




                        <!-- Team Start -->
                        <div class="container-xxl py-5">
                            <div class="container">
                                <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                                    <h1 class="mb-3">Meet Our Staff</h1>
                                    <p>Our Staffs are the heart and 
                                        soul of our community. With warmth, compassion, and expertise, they nurture each child's growth and development, fostering a safe and enriching environment where every little one can thrive.</p>
                                </div>
                                <div class="row g-4">
                                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                                        <div class="team-item position-relative">
                                            <img class="img-fluid rounded-circle w-75" src="img/team-1.jpg" alt="">
                                            <div class="team-text">
                                                <h3>Full Name</h3>
                                                <p>Designation</p>
                                                <div class="d-flex align-items-center">
                                                    <a class="btn btn-square btn-primary mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                                    <a class="btn btn-square btn-primary  mx-1" href=""><i class="fab fa-twitter"></i></a>
                                                    <a class="btn btn-square btn-primary  mx-1" href=""><i class="fab fa-instagram"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                                        <div class="team-item position-relative">
                                            <img class="img-fluid rounded-circle w-75" src="img/team-2.jpg" alt="">
                                            <div class="team-text">
                                                <h3>Full Name</h3>
                                                <p>Designation</p>
                                                <div class="d-flex align-items-center">
                                                    <a class="btn btn-square btn-primary mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                                    <a class="btn btn-square btn-primary  mx-1" href=""><i class="fab fa-twitter"></i></a>
                                                    <a class="btn btn-square btn-primary  mx-1" href=""><i class="fab fa-instagram"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                                        <div class="team-item position-relative">
                                            <img class="img-fluid rounded-circle w-75" src="img/team-3.jpg" alt="">
                                            <div class="team-text">
                                                <h3>Full Name</h3>
                                                <p>Designation</p>
                                                <div class="d-flex align-items-center">
                                                    <a class="btn btn-square btn-primary mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                                    <a class="btn btn-square btn-primary  mx-1" href=""><i class="fab fa-twitter"></i></a>
                                                    <a class="btn btn-square btn-primary  mx-1" href=""><i class="fab fa-instagram"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Team End -->



                        <!-- Classes Start -->
                        <div class="container-xxl py-5">
                            <div class="container">
                                <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                                    <h1 class="mb-3">Age group</h1>

                                </div>
                                <div class="row g-4">
                                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                                        <div class="classes-item">
                                            <div class="bg-light rounded-circle w-75 mx-auto p-3">
                                                <img class="img-fluid rounded-circle" src="img/classes-1.png" alt="">
                                            </div>
                                            <div class="bg-light rounded p-4 pt-5 mt-n5">
                                                <a class="d-block text-center h3 mt-3 mb-4" href="">Infants</a>
                                                <div class="d-flex align-items-center justify-content-between mb-4">
                                                    <div class="d-flex align-items-center">

                                                        <div class="ms-3">
                                                            <h6>This group usually consists of babies from birth to around 12 months old. Care for 
                                                                infants often involves feeding, diaper changing, napping, and providing sensory stimulation.</h6>

                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row g-1">
                                                    <div class="col-4">
                                                        <div class="border-top border-3 border-primary pt-2">

                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="border-top border-3 border-success pt-2">

                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="border-top border-3 border-warning pt-2">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                                        <div class="classes-item">
                                            <div class="bg-light rounded-circle w-75 mx-auto p-3">
                                                <img class="img-fluid rounded-circle" src="img/classes-2.png" alt="">
                                            </div>
                                            <div class="bg-light rounded p-4 pt-5 mt-n5">
                                                <a class="d-block text-center h3 mt-3 mb-4" href="">Toddlers</a>
                                                <div class="d-flex align-items-center justify-content-between mb-4">
                                                    <div class="d-flex align-items-center">

                                                        <div class="ms-3">
                                                            <h6>Toddlers typically range from about 1 year to 2 years old. They are usually more mobile and 
                                                                may be starting to explore language, social interactions, and early cognitive skills.</h6>

                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row g-1">
                                                    <div class="col-4">
                                                        <div class="border-top border-3 border-primary pt-2">


                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="border-top border-3 border-success pt-2">

                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="border-top border-3 border-warning pt-2">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                                        <div class="classes-item">
                                            <div class="bg-light rounded-circle w-75 mx-auto p-3">
                                                <img class="img-fluid rounded-circle" src="img/classes-3.png" alt="">
                                            </div>
                                            <div class="bg-light rounded p-4 pt-5 mt-n5">
                                                <a class="d-block text-center h3 mt-3 mb-4" href="">Preschoolers</a>
                                                <div class="d-flex align-items-center justify-content-between mb-4">
                                                    <div class="d-flex align-items-center">

                                                        <div class="ms-3">
                                                            <h6> typically around 3 to 4 years old. At this stage, they are further developing
                                                                language, social and cognitive skills. Preschool programs often focus on preparing 
                                                                children for kindergarten.

                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row g-1">
                                                    <div class="col-4">
                                                        <div class="border-top border-3 border-primary pt-2">

                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="border-top border-3 border-success pt-2">

                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="border-top border-3 border-warning pt-2">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                        <!-- Classes End -->


                        <!-- Call To Action Start -->
                        <div class="container-xxl py-5">
                            <div class="container">
                                <div class="bg-light rounded">
                                    <div class="row g-0">
                                        <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s" style="min-height: 400px;">
                                            <div class="position-relative h-100">
                                                <img class="position-absolute w-100 h-100 rounded" src="img/call-to-action123.jpg" style="object-fit: cover;">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                                            <div class="h-100 d-flex flex-column justify-content-center p-5">
                                                <h1 class="mb-4">Our gallery</h1>
                                                <p class="mb-4">Welcome to the enchanting ESS Daycare Gallery, where each image encapsulates the vibrant 
                                                    essence of childhood. Within these frames, you'll discover a tapestry of joy, curiosity, and growth as 
                                                    children embark on their journey of learning and discovery. From the sparkle in their eyes to the laughter that fills the air, every photograph tells a story of nurturing care and boundless exploration. 

                                                </p>
                                                <a class="btn btn-primary py-3 px-5" href="">View More Details<i class="fa fa-arrow-right ms-2"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="container-xxl bg-white p-0">
                                <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
                            </div>
                        </div>
                        <!-- Call To Action End -->




                        <style>
                            /**************** Banner Slider Carousel **************/
                            .carousel-inner img {
                                width: 100%;
                                max-height:400px;
                            }
                            .carousel-caption {
                                color:#000;
                                top:100px;
                                bottom: auto;
                                text-align:left;
                            }




                        <?php endif; ?>
                        <!-- Main content -->
                        <section class="content">
                        <div class="container">
                        <?php
                        if (!file_exists($page . ".php") && !is_dir($page)) {
                            include '404.html';
                        } else {
                            if (is_dir($page))
                                include $page . '/index.php';
                            else
                                include $page . '.php';
                        }
                        ?>
                        </div>
                        </section>
                        <!-- /.content -->
                        <div class="modal fade rounded-0" id="confirm_modal" role='dialog'>
                        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                        <div class="modal-content">
                        <di5v class="modal-header rounded-0">
                        <h5 class="modal-title">Confirmation</h5>
                        </div>
                        <div class="modal-body rounded-0">
                        <div id="delete_content"></div>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id='confirm' onclick="">Continue</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                        </div>
                        </div>
                        </div>
                        <div class="modal fade rounded-0" id="uni_modal" role='dialog'>
                        <div class="modal-dialog modal-md modal-dialog-centered rounded-0" role="document">
                        <div class="modal-content rounded-0">
                        <div class="modal-header rounded-0">
                        <h5 class="modal-title"></h5>
                        </div>
                        <div class="modal-body rounded-0">
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id='submit' onclick="$('#uni_modal form').submit()">Save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        </div>
                        </div>
                        </div>
                        </div>
                        <div class="modal fade rounded-0" id="uni_modal_right" role='dialog'>
                        <div class="modal-dialog modal-full-height  modal-md" role="document">
                        <div class="modal-content">
                        <div class="modal-header rounded-0">
                        <h5 class="modal-title"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="fa fa-arrow-right" aria-hidden="true"></span>
                        </button>
                        </div>

                        <div class="modal-body rounded-0">
                        </div>
                        </div>
                        </div>
                        </div>
                        <div class="modal fade" id="viewer_modal" role='dialog'>
                        <div class="modal-dialog modal-md" role="document">
                        <div class="modal-content">
                        <button type="button" class="btn-close" data-dismiss="modal"><span class="fa fa-times"></span></button>
                        <img src="" alt="">
                        </div>
                        </div>
                        </div>
                        </div>

                        <!-- /.content-wrapper -->
                        <?php require_once('inc/footer.php') ?>

                        </body>
                        </html>
