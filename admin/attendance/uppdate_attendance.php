<?php
$id = $_GET['id']; // Storing the value of $_GET['id'] in a variable to prevent SQL injection

$res = "SELECT *
          FROM tbl_attendance
          INNER JOIN enrollment_list ON enrollment_list.id = tbl_attendance.child_id
          WHERE tbl_attendance.attendance_id = $id"; // Using $id variable in the query
$result = $conn->query($res);
$data = $result->fetch_assoc();
?>



<div class="content py-3">
    <div class="container-fluid">
        <div class="card card-outline card-info shadow rounded-0">
            <div class="card-header bg-info">
                <h1 class="card-title text-center text-white"><strong>Update Attendance</strong></h1>
            </div>
            <div class="card-body">
                <div class="container-fluid">
                    <form action="" id="attendance-form">
                        <input type="hidden" id="parent_id" name="parent_id" />
                        <input type="hidden" name="attendance_id" id="attendance_id"value="<?php echo $data['attendance_id'] ?>">
                        <input type="hidden" name="parent_id" id="parent_id"value="<?php echo $data['parent_id'] ?>">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="child_name" class="control-label">Child's Name</label>
                                <input id="child_name" class="form-control form-control-border" type="text" value="<?= $data['child_fullname']; ?>" readonly>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="date" class="control-label">Date</label>
                                <input id="date" type="date" name="date" class="form-control form-control-border" required value="<?= $data['attendance_date']; ?>"> 
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">Attendance Status</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="attendance_status" id="present" <?= isset($data['attendance_status']) && $data['attendance_status'] === 'Present' ? 'checked' : ''; ?> value="Present">
                                    <label class="form-check-label" for="present">Present</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="attendance_status" id="absent" <?= isset($data['attendance_status']) && $data['attendance_status'] === 'Absent' ? 'checked' : ''; ?> value="Absent">
                                    <label class="form-check-label" for="absent">Absent</label>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <div class="text-center">
                                <button class="btn btn-flat btn-primary" form="attendance-form"><i class="fa fa-save"></i> Save</button>
                                <a href="./?page=attendance" class="btn btn-flat btn-light border"><i class="fa fa-angle-left"></i> Cancel</a>
                            </div>
                        </div>
                </div>
            </div>
        </div>

        <script>
            $(function () {
                $('#attendance-form').submit(function (e) {
                    e.preventDefault();
                    var _this = $(this);
                    $('.pop-msg').remove();
                    var el = $('<div>').addClass("pop-msg alert").hide();
                    start_loader();
                    $.ajax({
                        url: _base_url_ + "classes/Master.php?f=uppdate_attendance",
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
                                location.href = "./?page=attendance";
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

        </script>