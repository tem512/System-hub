
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Facilities</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <title>News/Events</title>
    <link rel="stylesheet" href="path/to/your/bootstrap.css">
    <link rel="stylesheet" href="path/to/your/font-awesome.css">

    
<style>
      /********** Template CSS **********/
:root {
    --primary: #FE5D37;
    --light: #FFF5F3;
    --dark: #103741;
}
    .text-center {
            text-align: center; /* Center text */
        }
        .text-muted {
            color: ; /* Lighter text color for muted text */
        }
		 h3 {
            text-align: center; /* Center align the h3 element */
			color: 
          
        }
        
      

        .container {
        position: relative;
        top: 0; /* Stick to the top of the viewport */
        background-color: ffff; /* Optional: Set background color */
        z-index: 1000;
     margin: auto;
    font-family: -apple-system, BlinkMacSystemFont, sans-serif;
    overflow: auto;
   
    .carousel-wrapper {
        position: relative;
        overflow: hidden;
    }
    .carousel-inner {
        display: flex;
        overflow: hidden;
        position: relative;
        width: 100%; /* Ensure the carousel-inner takes full width */
    }
    .carousel-item {
        flex: 0 0 100%;
        max-width: 100%;
        transition: transform 0.1s ease-in-out;
        position: relative;
    }
    .carousel-item img {
        width: 100%; /* Make the image take full width */
        height: auto; /* Maintain aspect ratio */
        border-radius: 200px; /* Apply border radius */
    }
    .carousel-item:nth-child(odd) {
        transform-origin: center;
    }
    .carousel-item:nth-child(even) {
        transform-origin: right center;
    }
    .carousel-wrapper:hover .carousel-item {
        transform: scale(0.97);
    }
    .carousel-caption {
        position: absolute;
        top: 30px;
        left: 60%;
        right: 30px;
        transform: translate(2%, 2%);
        color: rgba(255, 210, 0, 0.7); /* Adjusted for transparency */
        text-align: center;
        background: rgba(52, 109, 191, 0.7); /* Adjusted for transparency */
        padding: 100px;
    }
    .carousel-caption h3 {
        font-family: Arial, sans-serif;
        font-weight: bold;
        font-style: italic;
        color: rgba(255, 255, 255, 0.7); /* Adjusted for transparency */
        font-size: 35px;
        margin-bottom: 10px;
    }
    .carousel-caption p {
        color: rgba(255, 255, 255, 0.7); /* Adjusted for transparency */
        font-size: 24px;
    }
    iframe {
        border: none;
        margin: 0;
    }
   
    h1  {
            text-align: center; /* Center align the h3 element */
			color: 
            
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
    font-family: 'Lobster Two', cursive;
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



/*** Header ***/
.header-carousel::before,
.header-carousel::after,
.page-header::before,
.page-header::after {
    position: absolute;
    content: "";
    width: 100%;
    height: 10px;
    top: 0;
    left: 0;
    background: url(../img/bg-header-top.png) center center repeat-x;
    z-index: 1;
}

.header-carousel::after,
.page-header::after {
    height: 19px;
    top: auto;
    bottom: 0;
    background: url(../img/bg-header-bottom.png) center center repeat-x;
}

@media (max-width: 768px) {
    .header-carousel .owl-carousel-item {
        position: relative;
        min-height: 500px;
    }
    
    .header-carousel .owl-carousel-item img {
        position: absolute;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .header-carousel .owl-carousel-item p {
        font-size: 16px !important;
        font-weight: 400 !important;
    }

    .header-carousel .owl-carousel-item h1 {
        font-size: 30px;
        font-weight: 600;
    }
}

.header-carousel .owl-nav {
    position: absolute;
    top: 50%;
    right: 8%;
    transform: translateY(-50%);
    display: flex;
    flex-direction: column;
}

.header-carousel .owl-nav .owl-prev,
.header-carousel .owl-nav .owl-next {
    margin: 7px 0;
    width: 45px;
    height: 45px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #FFFFFF;
    background: transparent;
    border: 1px solid #FFFFFF;
    border-radius: 45px;
    font-size: 22px;
    transition: .5s;
}

.header-carousel .owl-nav .owl-prev:hover,
.header-carousel .owl-nav .owl-next:hover {
    background: var(--primary);
    border-color: var(--primary);
}

.page-header {
    background: linear-gradient(rgba(0, 0, 0, .2), rgba(0, 0, 0, .2)), url(../img/carousel-1.jpg) center center no-repeat;
    background-size: cover;
}

.breadcrumb-item + .breadcrumb-item::before {
    color: rgba(255, 255, 255, .5);
}


    
    
    </style>
    
  
    <h1>News/Events</h1>


    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="input-group mb-2">
             <!--   <input type="search" id="search" class="form-control form-control-border" placeholder="Search Program here...">
                <div class="input-group-append">
                    <button type="button" class="btn btn-sm border-0 border-bottom btn-default">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
-->
            </div>
        </div>
    </div>
    <div class="list-group" id="package-list">
    <?php 
        $package = $conn->query("SELECT * FROM `service_list` where `status` = 1 order by `name` asc");
        while($row = $package->fetch_assoc()):
    ?>
    <div class="text-decoration-none list-group-item rounded-0 package-item">
        <a class="d-flex w-100 text-navy" href="#package_<?= $row['id'] ?>" data-toggle="collapse">
            <div class="col-11">
                <h3><b><?= ucwords($row['name']) ?></b></h3>
            </div>
            <div class="col-1 text-right">
                <i class="fa fa-plus collapse-icon"></i>
            </div>
        </a>
        <div class="collapse" id="package_<?= $row['id'] ?>">
            <hr class="border-navy">
            <p class="mx-3"><?= html_entity_decode($row['description']) ?></p>
        </div>
    </div>
    <?php endwhile; ?>
    <?php if($package->num_rows < 1): ?>
        <center><span class="text-muted">No package Listed Yet.</span></center>
    <?php endif; ?>
        <div id="no_result" style="display:none"><center><span class="text-muted">No Program Listed Yet.</span></center></div>
    </div>
</div>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Facilities</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
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
<script>
    $(function(){
        $('.collapse').on('show.bs.collapse', function () {
            $(this).parent().siblings().find('.collapse').collapse('hide')
            $(this).parent().siblings().find('.collapse-icon').removeClass('fa-plus fa-minus')
            $(this).parent().siblings().find('.collapse-icon').addClass('fa-plus')
            $(this).parent().find('.collapse-icon').removeClass('fa-plus fa-minus')
            $(this).parent().find('.collapse-icon').addClass('fa-minus')
        })
        $('.collapse').on('hidden.bs.collapse', function () {
            $(this).parent().find('.collapse-icon').removeClass('fa-plus fa-minus')
            $(this).parent().find('.collapse-icon').addClass('fa-plus')
        })

        $('#search').on("input",function(e){
            var _search = $(this).val().toLowerCase()
            $('#package-list .package-item').each(function(){
                var _txt = $(this).text().toLowerCase()
                if(_txt.includes(_search) === true){
                    $(this).toggle(true)
                }else{
                    $(this).toggle(false)
                }
                if($('#package-list .package-item:visible').length <= 0){
                    $("#no_result").show('slow')
                }else{
                    $("#no_result").hide('slow')
                }
            })
        })
    })
    
</script>
