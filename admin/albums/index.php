<style>
.folder {
  width: 200px;
  height: 300px;
  margin: 0.5rem;
  padding: 1rem;
  border: 1px solid var(--gray);
  border-radius: 0.25rem;
  position: relative;
  overflow: hidden;
}

.folder img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  margin-bottom: 1rem;
}

.folder .folder-name {
  font-weight: bold;
}

.folder .folder-options {
  position: absolute;
  bottom: 0.5rem;
  right: 0.5rem;
}
.center {
  text-align: center;
}
</style>

<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif; ?>
<div class="w-100 d-flex justify-content-between border-bottom py-2">
    <div class="center">
    <h3>Albums</h3>
  </div>
    <button class="btn btn-flat btn-primary" type="button" id="add-new"><i class="fa fa-plus"></i> Add New</button>
</div>
<div class="row py-2">
    <?php
    $qry = $conn->query("SELECT * FROM album_list where user_id = '{$_settings->userdata('id')}' and `delete_f` = 0  order by `name` asc ");
    while($row = $qry->fetch_assoc()):
        $img = array();
        $imgs = $conn->query("SELECT * FROM `images` where album_id = '{$row['id']}' and delete_f = 0 order by unix_timestamp(date_updated) desc, unix_timestamp(date_created) desc limit 3");
        while ($irow = $imgs->fetch_assoc()){
            $img[] = $irow['path_name'];
        }
        ?>
        <div class="col">
            <div class="folder">
                <?php if(count($img) > 0): ?>
                    <img src="<?php echo validate_image($img[0]) ?>" alt="Album Cover">
                <?php endif; ?>
                <div class="folder-name"><?php echo $row['name'] ?></div>
                <div class="folder-options">
                    <a href="./?page=albums/images&id=<?php echo $row['id'] ?>" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i>View Album</a>
                    <a href="#" class="btn btn-sm btn-danger delete_album" data-id="<?php echo $row['id'] ?>"><i class="fa fa-trash"></i> Delete</a>
                    <a href="#" class="btn btn-sm rename_album" data-id="<?php echo $row['name'] ?>"><i class="fa fa-edit text-primary"></i> Rename</a>
                </div>
            </div>
			<div class="w-100 d-flex justify-content-between">
                <span class="text-dark"><b><?php echo $row['name'] ?></b></span>
        </div>
		        </div>
		
    <?php endwhile; ?>
</div>
<div class="row">
    <div class="w-100 p-2 text-center" id="nData" style="display:none"><b>No Album Listed</b></div>
</div>
<script>
    $(document).ready(function(){
        if($('.folder').length <= 0){
            $('#nData').show('slow')
        }else{
            $('#nData').hide('slow')
        }
        $('#add-new').click(function(){
            uni_modal("<i class='fa fa-plus'></i> Create New Album", "albums/manage_album.php")

        })
        $('.delete_album').click(function(){
            var albumId = $(this).data('id');
            _conf("Are you sure you want to delete this album?", "delete_album", [albumId]);
        })
        $('.rename_album').click(function(){
            var albumId = $(this).data('id');
            _conf("Are you sure you want to rename this album?", "rename_album", [albumId]);
        })
    });

    function delete_album(albumId){
        start_loader();
        $.ajax({
            url:_base_url_+"classes/Master.php?f=delete_album",
            method:"POST",
            data:{id: albumId},
            dataType:"json",
            error:function(err){
                console.log(err);
                alert_toast("An error occurred.",'error');
                end_loader();
            },
            success:function(resp){
                if(typeof resp === 'object' && resp.status === 'success'){
                    location.reload();
                }else{
                    alert_toast("An error occurred.",'error');
                    end_loader();
                }
            }
        })
    }
    function rename_album(albumId){
        start_loader();
        $.ajax({
            url:_base_url_+"classes/Master.php?f=rename_album",
            method:"POST",
            data:{id: albumId},
            dataType:"json",
            error:function(err){
                console.log(err);
                alert_toast("An error occurred.",'error');
                end_loader();
            },
            success:function(resp){
                if(typeof resp === 'object' && resp.status === 'success'){
                    location.reload();
                }else{
                    alert_toast("An error occurred.",'error');
                    end_loader();
                }
            }
        })
    }
</script>
