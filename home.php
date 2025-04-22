



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home Page</title>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">



        <!-- Favicon -->
        <link href="img/favicon.ico" rel="icon">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@600&family=Lobster+Two:wght@700&display=swap" rel="stylesheet">

        <!-- Icon Font Stylesheet -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link href="lib/animate/animate.min.css" rel="stylesheet">
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

        <!-- Customized Bootstrap Stylesheet -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="css/style.css

              <!DOCTYPE html>
              <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home Page</title>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">




        <style>

            /********** Template CSS **********/

            :root {
                --primary: #0000CD;
                --light: #FFD700;
                --dark: #008000;
            }

            .back-to-top {
                position: fixed;
                display: none;
                right: 45px;
                bottom: 45px;
                z-index: 99;
            }



            /*** Heading ***/
            h1,
            h2,
            h3,
            h4,
            .h1,
            .h2,
            .h3,
            .h4,
            .display-1,
            .display-2,
            .display-3,
            .display-4,
            .display-5,
            .display-6 {
                ;
                font-weight: 700;
            }

            h5,
            h6,
            .h5,
            .h6 {
                font-weight: 600;
            }

            .font-secondary {
                font-family: 'Lobster Two', cursive;
            }


            /*** Facility ***/
            .facility-item .facility-icon {
                position: relative;
                margin: 0 auto;
                width: 100px;
                height: 100px;
                border-radius: 100px;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .facility-item .facility-icon::before {
                position: absolute;
                content: "";
                width: 100%;
                height: 100%;
                top: 0;
                left: 0;
                background: rgba(255, 255, 255, .9);
                transition: .5s;
                z-index: 1;
            }

            .facility-item .facility-icon span {
                position: absolute;
                content: "";
                width: 35px;
                height: 40px;
                top: 0;
                left: 0;
                border-radius: 50%;
            }

            .facility-item .facility-icon span:last-child {
                left: auto;
                right: 0;
            }

            .facility-item .facility-icon i {
                position: relative;
                z-index: 2;
            }

            .facility-item .facility-text {
                position: relative;
                min-height: 300px;
                padding: 40px;
                border-radius: 100%;
                display: flex;
                text-align: center;
                justify-content: center;
                flex-direction: column;
            }

            .facility-item .facility-text::before {
                position: absolute;
                content: "";
                width: 100%;
                height: 100%;
                top: 0;
                left: 0;
                background: rgba(154, 205, 50, .5);
                transition: .5s;
                z-index: 1;
            }

            .facility-item .facility-text * {
                position: relative;
                z-index: 2;
            }

            .facility-item:hover .facility-icon::before,
            .facility-item:hover .facility-text::before {
                background: transparent;
            }

            .facility-item * {
                transition: .5s;
            }

            .facility-item:hover * {
                color: #F8F8FF !important;
            }


            /*** About ***/
            .about-img img {
                transition: .5s;
            }

            .about-img img:hover {
                background: var(--primary) !important;
            }


            /*** Classes ***/
            .classes-item {
                transition: .5s;
            }

            .classes-item:hover {
                margin-top: -10px;
            }


            /*** Team ***/
            .team-item .team-text {
                position: absolute;
                width: 250px;
                height: 250px;
                bottom: 0;
                right: 0;
                display: flex;
                align-items: center;
                justify-content: center;
                flex-direction: column;
                background: #FFFFFF;
                border: 17px solid var(--light);
                border-radius: 250px;
                transition: .5s;
            }

            .team-item:hover .team-text {
                border-color: 	#5B4CFF;
            }


            /*** Testimonial ***/
            .testimonial-carousel {
                padding-left: 1.5rem;
                padding-right: 1.5rem;
            }

            @media (min-width: 576px) {
                .testimonial-carousel {
                    padding-left: 4rem;
                    padding-right: 4rem;
                }
            }

            .testimonial-carousel .testimonial-item .border {
                border: 1px dashed rgba(0, 185, 142, .3) !important;
            }

            .testimonial-carousel .owl-nav {
                position: absolute;
                width: 100%;
                height: 45px;
                top: 50%;
                left: 0;
                transform: translateY(-50%);
                display: flex;
                justify-content: space-between;
                z-index: 1;
            }

            .testimonial-carousel .owl-nav .owl-prev,
            .testimonial-carousel .owl-nav .owl-next {
                position: relative;
                width: 45px;
                height: 45px;
                display: flex;
                align-items: center;
                justify-content: center;
                color: #FFFFFF;
                background: var(--primary);
                border-radius: 45px;
                font-size: 20px;
                transition: .5s;
            }

            .testimonial-carousel .owl-nav .owl-prev:hover,
            .testimonial-carousel .owl-nav .owl-next:hover {
                background: var(--dark);
            }


            /*** Footer ***/
            .footer .btn.btn-social {
                margin-right: 5px;
                width: 45px;
                height: 45px;
                display: flex;
                align-items: center;
                justify-content: center;
                color: 	#5B4CFF;
                border: 1px solid rgba(255,255,255,0.5);
                border-radius: 45px;
                transition: .3s;
            }

            .footer .btn.btn-social:hover {
                border-color: var(--primary);
                background: var(--primary);
            }

            .footer .btn.btn-link {
                display: block;
                margin-bottom: 5px;
                padding: 0;
                text-align: left;
                font-size: 16px;
                font-weight: normal;
                text-transform: capitalize;
                transition: .3s;
            }

            .footer .btn.btn-link::before {
                position: relative;
                content: "\f105";
                font-family: "Font Awesome 5 Free";
                font-weight: 900;
                margin-right: 10px;
            }

            .footer .btn.btn-link:hover {
                color: var(--primary) !important;
                letter-spacing: 1px;
                box-shadow: none;
            }

            .footer .form-control {
                border-color: rgba(255,255,255,0.5);
            }

            .footer .copyright {
                padding: 25px 0;
                font-size: 15px;
                border-top: 1px solid rgba(256, 256, 256, .1);
            }

            .footer .copyright a {
                color: #FFFFFF;
            }

            .footer .footer-menu a {
                margin-right: 15px;
                padding-right: 15px;
                border-right: 1px solid rgba(255, 253, 25, .1);
            }

            .footer .copyright a:hover,
            .footer .footer-menu a:hover {
                color: var(--primary) !important;
            }

            .footer .footer-menu a:last-child {
                margin-right: 0;
                padding-right: 0;
                border-right: none;
            }

            /* Add your custom styles here */
            body {
                margin: 0;
                padding: 0;
                font-family: Arial, sans-serif;
            }

            .card-body {
                background-color: #f8f9fa;
            }

            .container-fluid {
                padding: 10px;
            }

            .welcome-content {
                background-color: #ffffff;
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            .container-xxl {
                background-color: #f8f9fa;
                overflow: hidden; /* Added overflow hidden */
            }

            .classes-item {
                background-color: #ffffff;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                margin-bottom: 20px; /* Added margin bottom */
                transition: transform 0.3s ease; /* Added transition for smooth movement */
            }

            .classes-item:hover {
                transform: translateY(-10px); /* Move up on hover */
            }

            /* New styles for movable text and pictures */
            .movable {
                transition: transform 0.5s ease; /* Added transition for smooth movement */
            }
        </style>


    </head>





    <script>

        window.onscroll = function () {
            scrollFunction()
        };

        function scrollFunction() {
            var scrollPos = window.pageYOffset || document.documentElement.scrollTop;
            var direction = (scrollPos > this.lastScrollTop) ? 'down' : 'up';
            this.lastScrollTop = scrollPos;

            document.querySelectorAll(".movable").forEach(function (item) {
                if (direction === 'up') {
                    item.style.transform = "translateY(-50px)"; // Move up when scrolling up
                } else {
                    item.style.transform = "translateY(50px)"; // Move down when scrolling down
                }
            });
        }

        window.onscroll = function () {
            scrollFunction()
        };

        function scrollFunction() {
            var scrollPos = window.pageYOffset || document.documentElement.scrollTop;
            var direction = (scrollPos > this.lastScrollTop) ? 'down' : 'up';
            this.lastScrollTop = scrollPos;

            document.querySelectorAll(".movable").forEach(function (item) {
                if (direction === 'up') {
                    item.style.transform = "translateY(-50px)"; // Move up when scrolling up
                } else {
                    item.style.transform = "translateY(50px)"; // Move down when scrolling down
                }
            });
        }

        window.onscroll = function () {
            scrollFunction()
        };

        function scrollFunction() {
            var scrollPos = window.pageYOffset || document.documentElement.scrollTop;
            if (scrollPos > 100) {
                document.querySelectorAll(".movable").forEach(function (item) {
                    item.style.transform = "translateY(-50px)"; // Move up when scrolled down
                });
            } else {
                document.querySelectorAll(".movable").forEach(function (item) {
                    item.style.transform = "translateY(0)"; // Move back to original position
                });
            }
        }
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
    <script>
        new WOW().init();
    </script>


</style>

<script src="js/index.js"></script>


</div>
</div>
</body>
<div class="card-body rounded-0">
    <div class="container-fluid">



    </div>

</div>
<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
</div>

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="lib/wow/wow.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/waypoints/waypoints.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>

<!-- Template Javascript -->
<script src="js/main.js"></script>
</body>
</html>
