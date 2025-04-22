<?php
$id = $_GET['id']; // Storing the value of $_GET['id'] in a variable to prevent SQL injection

$res = "SELECT assignment_list.rooms_id,rooms.rooms_name,assignment_list.id,assignment_list.child_id,assignment_list.caregiver_id,enrollment_list.child_fullname, CONCAT(users.firstname, ' ', users.lastname) AS name
          FROM assignment_list
          INNER JOIN enrollment_list ON assignment_list.child_id = enrollment_list.id
           INNER JOIN rooms ON assignment_list.rooms_id = rooms.id
          INNER JOIN users ON assignment_list.caregiver_id = users.id
          WHERE assignment_list.id = $id"; // Using $id variable in the query
$result = $conn->query($res);
$data = $result->fetch_assoc();
$qry = $conn->query("SELECT * from `enrollment_list` where astatus=0 order by id asc ");
$qry2 = $conn->query("SELECT * from `rooms`  order by id asc ");

$qry1 = $conn->query("SELECT *,concat(firstname,' ',lastname) as name from `users` where type = '2' order by concat(firstname,' ',lastname) asc ");
?>



<?php //echo isset($meta['id']) ? $meta['id']: '' ?>
<?php //if($_settings->chk_flashdata('success')): ?>

<div class="content py-3">
    <div class="container-fluid">
        <div class="card card-outline card-info shadow rounded-0">
            <div class="card-header">
                <h4 class="card-title"><?= isset($id) ? "Uppdate assignment" : "Manage assignment"; ?></h4>
            </div>
            <div class="card-body">
                <div class="container-fluid">
                    <form action="" id="assignment-form">
                        <input type="hidden" name="id" value="<?= isset($id) ? $id : '' ?>"> 
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="" class="control-label">Child's Name</label>
                                <select name="child_fullname" id="child_fullname" class="form-control form-control-border" required> 
                                    <option value="<?php echo $data['child_id']; ?>"><?php echo $data['child_fullname']; ?></option>
                                    <?php while ($row = $qry->fetch_assoc()): ?>
                                        <?php if ($row['id'] != $data['child_id']): ?>
                                            <option value="<?php echo $row['id']; ?>"><?php echo $row['child_fullname']; ?></option>
                                        <?php endif; ?>
                                    <?php endwhile; ?>
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="" class="control-label">Care Giver</label>
                                <select name="fullname" id="fullname" class="form-control form-control-border" required>

                                    <option value="<?php echo $data['caregiver_id']; ?>"><?php echo $data['name']; ?></option>
                                    <?php while ($row = $qry1->fetch_assoc()): ?>
                                        <?php if ($row['id'] != $data['caregiver_id']): ?>
                                            <option value="<?php echo $row['id']; ?>">
                                                <?php echo $row['name']; ?>
                                            </option>
                                        <?php endif; ?>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="" class="control-label">Rooms</label>
                                <select name="rooms" id="rooms" class="form-control form-control-border" required>

                                    <option value="<?php echo $data['rooms_id']; ?>"><?php echo $data['rooms_name']; ?></option>
                                    <?php while ($row = $qry2->fetch_assoc()): ?>
                                        <?php if ($row['id'] != $data['rooms_id']): ?>
                                            <option value="<?php echo $row['id']; ?>">
                                                <?php echo $row['rooms_name']; ?>
                                            </option>
                                        <?php endif; ?>
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
                url: _base_url_ + "classes/Master.php?f=update_assignment",
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