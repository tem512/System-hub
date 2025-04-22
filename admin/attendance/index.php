<style>
    .datepicker
    {
        z-index: 1600 !important; /* has to be larger than 1050 */
    }
    /* Table styles */
    .custom-table {
        width: 100%;
        border-collapse: collapse;
        border: 2px solid #ddd;
    }

    .custom-table th,
    .custom-table td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .custom-table th {
        background-color: #f2f2f2;
    }

    .custom-table tbody tr:nth-child(odd) {
        background-color: #f9f9f9;
    }

    /* Radio button styles */
    .custom-radio {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .custom-radio input[type="radio"] {
        margin: 0;
    }

    /* Button styles */
    .custom-btn {
        padding: 8px 16px;
        cursor: pointer;
        border: none;
        border-radius: 4px;
        background-color: #4caf50;
        color: white;
        text-align: center;
        text-decoration: none;
        display: inline-block;
    }

    .custom-btn.close-btn {
        background-color: #f44336;
    }

    /* Responsive styles */
    @media only screen and (max-width: 600px) {
        .modal-dialog {
            margin: 0;
            width: 100%;
            max-width: none;
        }
    }
</style>


<div class="card card-outline card-info rounded-0" id="data-table">
    <div class="card-header">
        <h3 class="card-title">Attendance Information</h3>
        <?php if ($_settings->userdata('type') == 2): ?>
            <div class="card-tools">
                <button type="button" id="add_button" class="btn btn-info btn-sm"><i class="fa fa-plus"></i>Add</button>
            </div>
            <div class="card-tools" style="margin-right: 10px;"> <!-- Adjust margin-top as needed -->
                <button type="button" id="" class="btn btn-danger btn-sm report_button">
                    <i class="fa fa-exclamation-circle"></i>
                    <span style="margin-left: 5px;">Report</span>
                </button>

            </div>
        <?php endif; ?>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <div class="container-fluid">
                <table class="table table-hover table-striped">

                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Child Name</th>
                            <th>Code</th>
                            <th>Attendance Status</th>
                            <th>Attendance Date</th>
                            <?php if ($_settings->userdata('type') == 2): ?>
                                <th>Action</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $uid = $_settings->userdata('id');
                        $i = 1;
                        if ($_settings->userdata('type') == 1 or $_settings->userdata('type') == 0):
                            $qry = $conn->query("SELECT * FROM `tbl_attendance` 
                    INNER JOIN enrollment_list ON tbl_attendance.child_id = enrollment_list.id 
                    WHERE astatus = 0 
                    ORDER BY attendance_id DESC");

                        endif;
                        if ($_settings->userdata('type') == 2):
                            $qry = $conn->query("SELECT * from `tbl_attendance` 
			INNER JOIN enrollment_list ON tbl_attendance.child_id = enrollment_list.id where tbl_attendance.caregiver_id=$uid and astatus=0 ORDER BY attendance_id DESC");

                        endif;
                        if ($_settings->userdata('type') == 3):
                            $qry = $conn->query("SELECT * from `tbl_attendance` 
						INNER JOIN enrollment_list ON tbl_attendance.child_id = enrollment_list.id where tbl_attendance.parent_id=$uid and astatus=0 ORDER BY attendance_id DESC");
                        endif;
                        // if ($_settings->userdata('type') == 3):
                        //  endif;

                        while ($row = $qry->fetch_assoc()):
                            ?>
                            <tr>
                                <td class="text-center"><?php echo $i++; ?></td>
                                <td><?php echo ($row['child_fullname']) ?></td>
                                <td><?php echo ucwords($row['code']) ?></td>
                                <?php if ($row['attendance_status'] == 'Absent') { ?>
                                    <td class="badge badge-danger"><?php echo $row['attendance_status']; ?></td>
                                <?php } else { ?>
                                    <td class="badge badge-success"><?php echo $row['attendance_status']; ?></td>
                                <?php } ?>

                                <td><?php echo ucwords($row['attendance_date']) ?></td>
                                <?php if ($_settings->userdata('type') == 2): ?>
                                    <td align="center">
                                        <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                            Action
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu" role="menu">
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="./?page=attendance/uppdate_attendance&id=<?= $row['attendance_id'] ?>" data-id="<?php echo $row['attendance_id'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
                                            <input type="hidden" name="chaild_id" id="chaild_id" value="<?php echo $row['child_id'] ?>" />
                                            <button type="button" id="<?php echo $row['child_id'] ?>" class="dropdown-item report_button">
                                                <span class="fa fa-exclamation-circle text-danger mr-2"></span>Report
                                            </button>
                                            <div class="dropdown-divider"></div>

                                        </div>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<div class="modal" id="reportModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Make Report</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="form-group">
                    <div class="input-daterange">
                        <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date" readonly />
                        <span id="error_from_date" class="text-danger"></span>
                        <br />
                        <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" readonly />
                        <span id="error_to_date" class="text-danger"></span>
                    </div>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <input type="hidden" name="chaildId" id="chaildId" />
                <button type="button" name="create_report" id="create_report" class="btn btn-success btn-sm">Create Report</button>
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>


<div class="modal" id="formModal">
    <div class="modal-dialog">
        <form method="post" id="attendance_form">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title" id="modal_title"></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right">Attendance Date <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <input type="text" name="attendance_date" id="attendance_date" class="form-control" readonly />
                                <input type="hidden" name="caregiver_id" id="caregiver_id"value="<?php echo $_settings->userdata('id') ?>">
                                <span id="error_attendance_date" class="text-danger"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" id="student_details">
                        <div class="table-responsive">
                            <table class="custom-table">
                                <thead>
                                    <tr>
                                        <th>Roll No.</th>
                                        <th>Child Name</th>
                                        <th>Present</th>
                                        <th>Absent</th>
                                    </tr>
                                </thead>
                                <?php
                                $i = 1;
                                $uid = $_settings->userdata('id');
                                $qry = $conn->query("SELECT enrollment_list.child_fullname, enrollment_list.id,enrollment_list.parent_id
                                                    FROM enrollment_list
                                                    INNER JOIN assignment_list ON assignment_list.child_id = enrollment_list.id
                                                    WHERE assignment_list.caregiver_id=$uid AND astatus=0");

                                while ($row = $qry->fetch_assoc()):
                                    ?>

                                    <tr>
                                        <td class="text-center"><?php echo $i++; ?></td>
                                        <td><?php echo $row["child_fullname"]; ?>
                                            <input type="hidden" name="child_id[]" value="<?php echo $row["id"]; ?>" /></td>
                                    <input type="hidden" name="parent_id[]" value="<?php echo $row['parent_id'] ?>" /></td>
                                    <td class="text-center">
                                        <input type="radio" name="attendance_status<?php echo $row["id"]; ?>" value="Present" />
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="attendance_status<?php echo $row["id"]; ?>" checked value="Absent" />
                                    </td>
                                    </tr>
                                <?php endwhile; ?>
                            </table>
                        </div>
                    </div>

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <input type="hidden" name="action" id="action" value="Add" />
                    <input type="submit" name="button_action" id="button_action" class="custom-btn" value="Add" />
                    <button type="button" class="custom-btn close-btn" data-dismiss="modal">Close</button>
                </div>

            </div>
        </form>
    </div>
</div>


<script>
    $(document).ready(function () {
        $('.delete_data').click(function () {
            _conf("Are you sure to delete <b>" + $(this).attr('data-name') + "</b> from health List permanently?", "delete_health", [$(this).attr('data-id')])
        })
        $('.table td,.table th').addClass('py-1 px-2 align-middle')
        $('.verify_user').click(function () {
            _conf("Are you sure to verify <b>" + $(this).attr('data-name') + "<b/>?", "verify_user", [$(this).attr('data-id')])
        })
        $('.view_details').click(function () {
            uni_modal('health Details', "babysitters/view_details.php?id=" + $(this).attr('data-id'), 'mid-large')
        })
        $('.table').dataTable();

    })
    function delete_health($id) {
        start_loader();
        $.ajax({
            url: _base_url_ + "classes/Master.php?f=delete_health",
            method: "POST",
            data: {id: $id},
            dataType: "json",
            error: err => {
                console.log(err)
                alert_toast("An error occured.", 'error');
                end_loader();
            },
            success: function (resp) {
                if (typeof resp == 'object' && resp.status == 'success') {
                    location.reload();
                } else {
                    alert_toast("An error occured.", 'error');
                    end_loader();
                }
            }
        })
    }
    function verify_user($id) {
        start_loader();
        $.ajax({
            url: _base_url_ + "classes/Users.php?f=verify_babysitter",
            method: "POST",
            data: {id: $id},
            dataType: "json",
            error: err => {
                console.log(err)
                alert_toast("An error occured.", 'error');
                end_loader();
            },
            success: function (resp) {
                if (typeof resp == 'object' && resp.status == 'success') {
                    location.reload();
                } else {
                    alert_toast("An error occured.", 'error');
                    end_loader();
                }
            }
        })
    }


    $(document).ready(function () {
        $('#attendance_date').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            container: '#formModal modal-body'
        });

        function clear_field()
        {
            $('#attendance_form')[0].reset();
            $('#error_attendance_date').text('');
        }

        $('#add_button').click(function () {
            $('#modal_title').text("Add Attendance");
            $('#formModal').modal('show');
            clear_field();
        });

        $('#attendance_form').on('submit', function (event) {
            event.preventDefault();
            $.ajax({
                url: _base_url_ + "classes/Master.php?f=save_attendance",
                method: "POST",
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function () {
                    $('#button_action').val('Validate...');
                    $('#button_action').attr('disabled', 'disabled');
                },
                success: function (data)
                {
                    $('#button_action').attr('disabled', false);
                    $('#button_action').val($('#action').val());
                    if (data.success)
                    {
                        $('#message_operation').html('<div class="alert alert-success">' + data.success + '</div>');
                        clear_field();
                        $('#formModal').modal('hide');

                        location.reload();

                    }
                    if (data.error)
                    {
                        if (data.error_attendance_date != '')
                        {
                            $('#error_attendance_date').text(data.error_attendance_date);
                        } else
                        {
                            $('#error_attendance_date').text('');
                        }
                    }
                }
            })
        });

        $('.input-daterange').datepicker({
            todayBtn: "linked",
            format: "yyyy-mm-dd",
            autoclose: true,
            container: '#formModal modal-body'
        });

        $(document).on('click', '.report_button', function () {
            var chaild_id = $(this).attr('id');
            $('#chaildId').val(chaild_id);
            $('#reportModal').modal('show');
        });
        $('#create_report').click(function () {
            var chaild_id = $('#chaildId').val();
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            var error = 0;
            if (from_date === '')
            {
                $('#error_from_date').text('From Date is Required');
                error++;
            } else
            {
                $('#error_from_date').text('');
            }

            if (to_date === '')
            {
                $('#error_to_date').text("To Date is Required");
                error++;
            } else
            {
                $('#error_to_date').text('');
            }

            if (error === 0)
            {
                //                $('#chaildId').val('');
                $('#from_date').val('');
                $('#to_date').val('');
                $('#formModal').modal('hide');
                if (chaild_id === '') {
                    window.open(_base_url_ + "classes/Master.php?f=attendance_report1&from_date=" + from_date + "&to_date=" + to_date + "&uid=" + <?php echo $uid ?>);
                } else {
                    window.open(_base_url_ + "classes/Master.php?f=attendance_report2&from_date=" + from_date + "&to_date=" + to_date + "&uid=" + chaild_id);
                }

            }

        });

    });

</script></div>