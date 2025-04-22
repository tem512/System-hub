

<?php
$uid = $_settings->userdata('id');
$qry = $conn->query("SELECT enrollment_list.child_fullname, enrollment_list.id,enrollment_list.parent_id
                     FROM enrollment_list
                     INNER JOIN assignment_list ON assignment_list.child_id = enrollment_list.id
                     where assignment_list.caregiver_id=$uid and astatus=0");
?>


<div class="content py-3">
    <div class="container-fluid">
        <div class="card card-outline card-info shadow rounded-0">
            <?php if ($_settings->userdata('type') == 2): ?>
                <div class="card-header bg-info">
                    <h1 class="card-title text-center text-white"><strong>Add New Health care</strong></h1>
                </div>
            <?php endif; ?>
            <div class="card-body">
                <div class="container-fluid">
                    <form action="" id="health-form">
                        <input type="hidden" id="parent_id" name="parent_id" />
                        <input type="hidden" name="caregiver_id" id="caregiver_id"value="<?php echo $_settings->userdata('id') ?>">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="" class="control-label">Child's Name</label>
                                <select name="child_fullname" id="child_fullname" class="form-control form-control-border"  required>
                                    <option value="" disabled selected>Select child's full name</option>
                                    <?php while ($row = $qry->fetch_assoc()): ?>
                                    <option id="<?php echo $row['parent_id'] ?>" class="parent_id" value="<?php echo isset($row['id']) ? $row['id'] : ''; ?>"><?php echo isset($row['child_fullname']) ? $row['child_fullname'] : ''; ?></option>

                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="iliness" class="control-label">Illness</label>
                                <input type="text" name="iliness" id="iliness" class="form-control form-control-border">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="symptoms" class="control-label">Symptoms</label>
                                <input type="text" name="symptoms" id="symptoms" class="form-control form-control-border">
                            </div>
                        </div>
                        <div class="row">

                            <div class="form-group col-md-4">
                                <label for="temperature" class="control-label">Temperature</label>
                                <input type="number" name="temperature" id="temperature" class="form-control form-control-border">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="weight" class="control-label">Weight</label>
                                <input type="number" name="weight" id="weight" class="form-control form-control-border">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="date" class="control-label">Date</label>
                                <input type="date" name="date" id="date" class="form-control form-control-border" required>
                            </div>

                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="symptoms" class="control-label">Detail Description</label>
                                <textarea  name="description" id="description" class="form-control form-control-border""> </textarea>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
            <div class="card-footer">
                <div class="text-center">
                    <button class="btn btn-flat btn-primary" form="health-form"><i class="fa fa-save"></i> Save</button>
                    <a href="./?page=health" class="btn btn-flat btn-light border"><i class="fa fa-angle-left"></i> Cancel</a>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    $(function () {
        $('#health-form').submit(function (e) {
            e.preventDefault();
            var _this = $(this);
            $('.pop-msg').remove();
            var el = $('<div>').addClass("pop-msg alert").hide();
            start_loader();
            $.ajax({
                url: _base_url_ + "classes/Master.php?f=save_health",
                data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
                error: err => {
                    console.log(err);
                    alert_toast("An error occurred", 'error');
                    end_loader();
                },
                success: function (resp) {
                    if (resp.status == 'success') {
                        location.href = "./?page=health";
                    } else if (!!resp.msg) {
                        el.addClass("alert-danger").text(resp.msg);
                        _this.prepend(el);
                    } else {
                        el.addClass("alert-danger").text("An error occurred due to an unknown reason.");
                        _this.prepend(el);
                    }
                    el.show('slow');
                    $('html, body').animate({scrollTop: 0}, 'fast');
                    end_loader();
                }
            });
        });
    });
    $(document).ready(function () {
        $('#child_fullname').on('change', function () {
            var parent_id = $(this).find(':selected').attr('id');
            $('#parent_id').val(parent_id);
        });
    });
</script>
