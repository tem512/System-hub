<?php
$qry = $conn->query("SELECT * from `enrollment_list` where astatus=0  order by id asc ");
$qry1 = $conn->query("SELECT *,concat(firstname,' ',lastname) as name from `users` where type = '2' order by concat(firstname,' ',lastname) asc ");
$qry2 = $conn->query("SELECT * from `rooms`  order by id asc ");
?>



<?php //echo isset($meta['id']) ? $meta['id']: ''  ?>
<?php //if($_settings->chk_flashdata('success')):  ?>

</style>
<div class="content py-3">
    <div class="container-fluid">
        <div class="card card-outline card-info shadow rounded-0">
            <div class="card-header bg-info">
                <h1 class="card-title text-center text-white"><strong>Make New Assignment</strong></h1>
            </div>

            <div class="card-body">
                <div class="container-fluid">
                    <form action="" id="assignment-form">
                        <input type="hidden" name="id" value="<?= isset($id) ? $id : '' ?>">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="" class="control-label">Child's Name</label>
                                <select name="child_fullname" id="child_fullname" class="form-control form-control-border"  required>
                                    <option value="" disabled selected>Select child's full name</option>
                                    <?php while ($row = $qry->fetch_assoc()): ?>
                                        <option value="<?php echo isset($row['id']) ? $row['id'] : ''; ?>"><?php echo isset($row['child_fullname']) ? $row['child_fullname'] : ''; ?></option>

                                    <?php endwhile; ?>
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="" class="control-label">Caregiver Name</label>
                                <select name="fullname" id="fullname" class="form-control form-control-border" required>
                                    <option value="" disabled selected>Select Caregiver full name</option>
                                    <?php while ($row = $qry1->fetch_assoc()): ?>
                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>

                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="" class="control-label">Rooms</label>
                                <select name="rooms" id="rooms" class="form-control form-control-border" required>
                                    <option value="" disabled selected>Select room</option>
                                    <?php while ($row = $qry2->fetch_assoc()): ?>
                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['rooms_name']; ?></option>

                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-footer">
                <div class="text-center">
                    <button class="btn btn-flat btn-primary" form="assignment-form"><i class="fa fa-save"></i> Save</button>
                    <a href="./?page=assignment" class="btn btn-flat btn-light border"><i class="fa fa-angle-left"></i> Cancel</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function displayImg(input, _this) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#cimg').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        } else {
            $('#cimg').attr('src', "<?= validate_image(isset($avatar) ? $avatar : "") ?>");
        }
    }
    $(function () {
        $('#assignment-form').submit(function (e) {
            e.preventDefault()
            var _this = $(this)
            $('.pop-msg').remove()
            var el = $('<div>')
            el.addClass("pop-msg alert")
            el.hide()
            start_loader();
            $.ajax({
                url: _base_url_ + "classes/Master.php?f=save_assignment",
                data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
                error: err => {
                    console.log(err)
                    alert_toast("An error occured", 'error');
                    end_loader();
                },
                success: function (resp) {
                    if (resp.status == 'success') {
                        location.href = "./?page=assignment";
                    } else if (!!resp.msg) {
                        el.addClass("alert-danger")
                        el.text(resp.msg)
                        _this.prepend(el)
                    } else {
                        el.addClass("alert-danger")
                        el.text("An error occurred due to unknown reason.")
                        _this.prepend(el)
                    }
                    el.show('slow')
                    $('html, body').animate({scrollTop: 0}, 'fast')
                    end_loader();
                }
            })
        })
    })
</script>