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
        /* Modal image custom CSS */
        .modal-dialog.modal-md {
            max-width: 60%;
        }
        .modal-body {
            text-align: center;
            padding: 0;
        }
        #modalImage {
            width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
<?php 
$qry = $conn->query("SELECT * FROM `images` where `delete_f` = 0 and album_id = '{$_GET['id']}' order by `original_name` asc ");
while($row = $qry->fetch_assoc()):
?>
<!-- Image HTML markup goes here -->
<?php endwhile; ?>
<?php
$name = "Albums"; // Initialize $name variable
?>
<div class="w-100 d-flex justify-content-between border-bottom py-2">
    <h3><?php echo $name ?></h3>
    <div>
        <a class="btn btn-flat btn-light border" href="./?page=gallery" ><i class="fa fa-angle-left"></i> Back</a>
    </div>
</div>
<div class="row row-cols-4 row-cols-md-3 row-cols-sm-1 row-cols-lg-4 py-2">
    <?php 
        $qry = $conn->query("SELECT * FROM `images` where  album_id = '{$_GET['id']}' order by `original_name` asc ");
        while($row = $qry->fetch_assoc()):
    ?>
    <div class="col p-2 item">
        <a href="javascript:void(0)" data-id="<?php echo $row['id'] ?>" class="img-item">
            <div class='img-view'>
                <img src="<?php echo validate_image($row['path_name']) ?>" class="img-thumbnail img-fluid img-thumb" alt="img" loading="lazy">
            </div>
            <div class="w-100 d-flex justify-content-between">
                <span class="text-dark"><b><?php echo $row['original_name'] ?></b></span>
                <div class="dropleft">
                    <a href="#" id="menus_<?php echo $row['id'] ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="text-dark"><i class="fa fa-ellipsis-v"></i> </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" download="<?php echo $row['original_name'] ?>" href="<?php echo validate_image($row['path_name']) ?>" target="_blank"><i class="fa fa-download text-primary"></i> Download</a>
                        <div class="dropdown-divider"></div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <?php endwhile; ?>
</div>
<div class="row">
    <div class="w-100 p-2 text-center" id="nData" style="display:none"><b>No Images</b></div>
</div>

<!-- Modal Structure -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Image Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="" id="modalImage" class="img-fluid" alt="Image">
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function(){
        if($('.img-item').length <= 0){
            $('#nData').show('slow')
        }else{
            $('#nData').hide('slow')
        }
        $('#add-new').click(function(){
            uni_modal("<i class='fa fa-upload'></i> Create New Album", "manage_image.php?album_id=<?php echo $_GET['id'] ?>")
        })
        $('.edit_image').click(function(){
            uni_modal("<i class='fa fa-edit'></i> Rename Image", "rename_image.php?id="+$(this).attr('data-id'))
        })
        $('.move_image').click(function(){
            uni_modal("<i class='fa fa-arrows-alt'></i> Move Image", "move_image.php?id="+$(this).attr('data-id'))
        })
        $('.img-item').click(function(){
            var imgSrc = $(this).find('img').attr('src');
            $('#modalImage').attr('src', imgSrc);
            $('#imageModal').modal('show');
        })
        $('.delete_image').click(function(){
            _conf("Are you sure to delete this Image ?","delete_image",[$(this).attr('data-id')])
        })
        $('.img-item').closest('.item').hover(function(){
            $(this).css({
                'background':'#005aff29',
                'border-radius':'5px'
            })
        })
        $('.img-item').closest('.item').mouseleave(function(){
            $(this).css({
                'background':'none',
                'border-radius':'5px'
            })
        })
    })
    function delete_image($id){
        start_loader();
        $.ajax({
            url:_base_url_+"classes/Master.php?f=delete_image",
            method:"POST",
            data:{id: $id},
            dataType:"json",
            error:err=>{
                console.log(err)
                alert_toast("An error occured.",'error');
                end_loader();
            },
            success:function(resp){
                if(typeof resp== 'object' && resp.status == 'success'){
                    location.reload();
                }else{
                    alert_toast("An error occured.",'error');
                    end_loader();
                }
            }
        })
    }
</script>
</body>
