<!DOCTYPE html>
<html>
    <head>
        <title>Header Slide</title>
        <style>
            /* Basic styling for header */
            #header {
                width: 100%;
                height: 400px;
                overflow: hidden;
                position: relative;
                background: #f0f0f0; /* Add a background color */
                padding: 10px; /* Add padding */
                border-radius: 10px; /* Add border radius */
                position: relative;
                padding: 0; /* Remove padding */
                border-radius: 10px; /* Add border radius */
                position: relative;
            }


            /* Style for individual slides */
            .slide {
                width: 100%;
                height: 100%;
                position: absolute;
                top: 0;
                left: 0;
                opacity: 0; /* Initially hidden */
                transition: opacity 1s ease; /* Transition effect */
            }

            /* Style for active slide */
            .slide.active {
                opacity: 1; /* Make it visible */
            }

            /* Style for navigation */
            .navbar {
                position: relative;
                z-index: 1; /* Ensure the navigation is above the slides */
            }


            /* CSS to make slides full width */
            .slide {
                width: 100%;
                overflow: hidden;
            }
            .slide img {
                width: 100%;
                height: auto;
            }



            /* Basic styling for header */
            #header {
                width: 100%;
                height: 400px;
                overflow: hidden;
                position: relative;
                background: #f0f0f0; /* Add a background color */
                padding: 100px; /* Add padding */
                border-radius: 10px; /* Add border radius */
                position: relative;
                padding: 0; /* Remove padding */
                border-radius: 5px; /* Add border radius */
                position: relative;
            }


            /* Style for individual slides */
            .slide {
                width: 100%;
                height: 100%;
                position: absolute;
                top: 0;
                left: 0;
                opacity: 0; /* Initially hidden */
                transition: opacity 1s ease; /* Transition effect */
            }

            /* Style for active slide */
            .slide.active {
                opacity: 1; /* Make it visible */
            }

            /* Style for navigation */
            .navbar {
                position: relative;
                z-index: 1; /* Ensure the navigation is above the slides */
            }


            /* CSS to make slides full width */
            .slide {
                width: 100%;
                overflow: hidden;
            }
            .slide img {
                width: 100%;
                height: auto;
            }

        </style>

    </head>
    <body>
        <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top px-4 px-lg-5 py-lg-0">
            <div href="#" class="navbar-brand">
                <h1 class="m-0 text-primary" style="color: lightblue; font-family: 'Times New Roman', Times, serif; font-style: italic; font-weight: bold;">ESS Daycare</h1>
            </div>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Left navbar links -->
            <div class="collapse navbar-collapse" id="navbarCollapse">         
                <div class="navbar-nav mx-auto">
                    <a href="./" class="nav-item nav-link active" <?= isset($page) && $page == 'home' ? 'active' : '' ?>">Home</a>
                    <a href="./?page=programs" class="nav-link <?= isset($page) && $page == 'programs' ? 'active' : '' ?>">News/Events</a>
                    <a href="./?page=babysitters" class="nav-link <?= isset($page) && $page == 'babysitters' ? 'active' : '' ?>">Caregiver</a>
                    <a href="./?page=gallery" class="nav-link <?= isset($page) && $page == 'gallery' ? 'active' : '' ?>">Gallery</a>
                    <a href="./?page=about" class="nav-link <?= isset($page) && $page == 'about' ? 'active' : '' ?>">About us</a>
                </div>

                <?php if ($_settings->userdata('id') > 0): ?>
                    <span class="mx-2"><img src="<?= validate_image($_settings->userdata('avatar')) ?>" alt="User Avatar" id="student-img-avatar"></span>
                    <span class="mx-2"><?= !empty($_settings->userdata('username')) ? $_settings->userdata('username') : '' ?></span>
                    <span class="mx-1"><a href="<?= base_url . 'classes/Login.php?f=logout&logout_id=' . urlencode($_settings->userdata('unique_id')) ?>"><i class="fa fa-power-off"></i></a></span>

                <?php else: ?>
                    <a href="./admin" class="btn btn-primary rounded-pill px-3 d-none d-lg-block <?= isset($page) && $page == 'login' ? 'active' : '' ?>">
                        Login<i class="fa fa-arrow-right ms-3"></i>
                    </a>
                <?php endif; ?>
            </div>  
        </nav>

        <div id="header">

            <!-- Slides will be inserted here dynamically -->
        </div>

        <script>
            // JavaScript for slide functionality
            var slidesContainer = document.getElementById('header');
            var currentSlide = 0;
            var slideInterval = setInterval(nextSlide, 5000); // Change slide every 5 seconds

            // Function to fetch image URLs
            function fetchImages() {
                // Simulate AJAX request here
                // Replace this with your actual AJAX call to fetch image URLs from the server
                var images = ["slider_image/PFC_4.png", "slider_image/download.jfif", "slider_image/slider19_5.jpg"];
                return images;
            }

            // Function to create slides
            function createSlides(images) {
                images.forEach(function (image) {
                    var slide = document.createElement('div');
                    slide.className = 'slide';
                    slide.innerHTML = '<img src="' + image + '" alt="Slide">';
                    slidesContainer.appendChild(slide);
                });
            }

            // Function to switch to the next slide
            function nextSlide() {
                var slides = document.querySelectorAll('.slide');
                slides[currentSlide].classList.remove('active');
                currentSlide = (currentSlide + 1) % slides.length;
                slides[currentSlide].classList.add('active');
            }

            // Fetch images and create slides on page load
            window.addEventListener('load', function () {
                var images = fetchImages();
                createSlides(images);
            });
        </script>
    </body>








