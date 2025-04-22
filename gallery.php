<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Album Collections</title>
        <!-- Bootstrap CSS -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome CSS -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
        <!-- Animate CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
        <style>
            /* Custom CSS */
            .folder {
                width: 100%;
                height: 300px;
                margin: 0.5rem;
                padding: 1rem;
                border: 1px solid var(--gray);
                border-radius: 0.25rem;
                position: relative;
                overflow: hidden;
                transition: transform 0.2s, box-shadow 0.2s;
            }

            .folder img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                margin-bottom: 1rem;
            }

            .folder:hover {
                transform: scale(1.05);
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }

            .folder-name {
                font-weight: bold;
            }

            .folder-options {
                position: absolute;
                bottom: 0.5rem;
                right: 0.5rem;
            }

            #nData {
                display: none;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <div class="w-100 d-flex justify-content-center align-items-center border-bottom py-2">
                <h3>Album Collections</h3>
            </div>
            <div class="row py-2">
                <?php
                $qry = $conn->query("SELECT * FROM album_list WHERE `delete_f` = 0 ORDER BY `name` ASC ");
                while ($row = $qry->fetch_assoc()):
                    $img = array();
                    $imgs = $conn->query("SELECT * FROM `images` WHERE album_id = '{$row['id']}' AND delete_f = 0 ORDER BY unix_timestamp(date_updated) DESC, unix_timestamp(date_created) DESC LIMIT 3");
                    while ($irow = $imgs->fetch_assoc()) {
                        $img[] = $irow['path_name'];
                    }
                    ?>
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="folder">
                            <?php if (count($img) > 0): ?>
                                <img src="<?php echo validate_image($img[0]) ?>" alt="Album Cover">
                            <?php endif; ?>
                            <div class="folder-name"><?php echo htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8'); ?></div>
                            <div class="folder-options">
                                <a href="./?page=images&id=<?php echo $row['id'] ?>" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> View Album</a>
                            </div>
                        </div>
                        <div class="w-100 d-flex justify-content-between">
                            <span class="text-dark"><b><?php echo $row['name'] ?></b></span>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
            <div class="row">
                <div class="w-100 p-2 text-center" id="nData"><b>No Album Listed</b></div>
            </div>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
        <!-- jQuery -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script>
            $(document).ready(function () {
                if ($('.folder').length <= 0) {
                    $('#nData').show('slow')
                } else {
                    $('#nData').hide('slow')
                }

                $('#add-new').click(function () {
                    uni_modal("<i class='fa fa-plus'></i> Create New Album", "manage_album.php")
                })

                $('.delete_album').click(function () {
                    var albumId = $(this).data('id');
                    _conf("Are you sure you want to delete this album?", "delete_album", [albumId]);
                })
            });

            function delete_album(albumId) {
                start_loader();
                $.ajax({
                    url: _base_url_ + "classes/Master.php?f=delete_album",
                    method: "POST",
                    data: {id: albumId},
                    dataType: "json",
                    error: function (err) {
                        console.log(err);
                        alert_toast("An error occurred.", 'error');
                        end_loader();
                    },
                    success: function (resp) {
                        if (typeof resp === 'object' && resp.status === 'success') {
                            location.reload();
                        } else {
                            alert_toast("An error occurred.", 'error');
                            end_loader();
                        }
                    }
                })
            }
        </script>
    </body>

</html>
