<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">
        <title>School Facilities</title>

        <!-- Favicon -->
        <link href="img/favicon.ico" rel="icon">
        <!-- Bootstrap CSS -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome CSS -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
        <!-- Animate CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@600&family=Lobster+Two:wght@700&display=swap" rel="stylesheet">
        <!-- Bootstrap Icons -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <style>
            .facility-item {
                border-radius: 10px;
                padding: 5px;
                text-align: center;
            }
            .facility-text {
                padding-top: 5px;
            }
        </style>

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- Bootstrap JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    </head>
    <body>

        <h1 class="text-center"><b>Caregivers</b></h1>

        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="input-group mb-2">
                    <input type="search" id="search" class="form-control form-control-border" placeholder="Search our Staffs here...">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-sm border-0 border-bottom btn-default">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <?php
        $babysitters = $conn->query("SELECT * FROM babysitter_list where status = 1 order by `fullname` asc");
        if ($babysitters->num_rows > 0):
            ?>
            <div class="container">
                <div class="col-lg-12 col-md-12 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="row">
                        <?php while ($row = $babysitters->fetch_assoc()): ?>
                            <div class="col-lg-4 col-md-6 mb-4 bs-item" data-id="<?php echo $row['id']; ?>">
                                <div class="bg-light rounded-circle w-75 mx-auto p-3" style="background-color: #C0C0C0;">
                                    <div class="text-center">
                                        <img id="bs-image" class="img-thumbnail bg-gradient-dark border-info" src="<?php echo validate_image(isset($row['bs_image']) ? $row['bs_image'] : '') ?>" alt="BS Image">
                                    </div>
                                </div>
                                <div class="bg-light rounded p-4 pt-5 mt-n5" style="background-color: #C0C0C0;">
                                    <h4 class="text-center"><b><?= ucwords($row['fullname']) ?></b></h4>
                                    <div class="text-center"><small class="text-muted"><?= $row['code'] ?></small></div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="col text-center"><span class="text-muted">No Caregivers Listed Yet.</span></div>
        <?php endif; ?>
        <div id="no_result" style="display:none" class="col text-center"><span class="text-muted">No Result.</span></div>

        <!-- Modal -->
        <div class="modal fade" id="uni_modal" tabindex="-1" role="dialog" aria-labelledby="uni_modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="uni_modalLabel">Babysitter's Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Modal content will be loaded here -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-flat btn-sm btn-dark" data-bs-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $(function () {
                $('#search').on("input", function (e) {
                    var _search = $(this).val().toLowerCase();
                    $('.bs-item').each(function () {
                        var _txt = $(this).text().toLowerCase();
                        if (_txt.includes(_search) === true) {
                            $(this).toggle(true);
                        } else {
                            $(this).toggle(false);
                        }
                        if ($('.bs-item:visible').length <= 0) {
                            $("#no_result").show('slow');
                        } else {
                            $("#no_result").hide();
                        }
                    });
                });

                $('.bs-item').click(function () {
                    var id = $(this).attr('data-id');
                    $.ajax({
                        url: 'view_babysitter.php',
                        method: 'GET',
                        data: {id: id},
                        success: function (response) {
                            $('#uni_modal .modal-body').html(response);
                            $('#uni_modal').modal('show');
                        }
                    });
                });
            });
        </script>
    </body>
</html>
