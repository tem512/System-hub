<style>
    .img-avatar{
        width:45px;
        height:45px;
        object-fit:cover;
        object-position:center center;
        border-radius:100%;
    }
</style>
<div class="card card-outline card-info rounded-0">
    <div class="card-header">
        <h3 class="card-title">Meal Information List</h3>
        <?php if ($_settings->userdata('type') == 3): ?>
            <div class="card-tools">
                <a href="./?page=meal/manage_meal" class="btn btn-flat btn-primary btn-sm"><i class="fa fa-plus"></i> Add New</a>
            </div>

        <?php endif; ?>

        <?php if ($_settings->userdata('type') == 2): ?>
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
                            <th>Meal Date</th>
                            <th>Meal Time</th>
                            <th>Meal type</th>
                            <th>Food Items</th>
                            <th>Description</th>
                            <th style="color: blue;">Caregiver Notes</th>
                            <?php if ($_settings->userdata('type') == 2): ?>
                                <th></th>
                                <th></th>
                            <?php endif; ?>
                            <?php if ($_settings->userdata('type') == 3 or $_settings->userdata('type') == 2): ?>
                                <th>Action</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $uid = $_settings->userdata('id');
                        $i = 1;
                        if ($_settings->userdata('type') == 1 or $_settings->userdata('type') == 0) {
                            $qry = $conn->query("SELECT * from `child_meals`
						INNER JOIN enrollment_list ON child_meals.child_id = enrollment_list.id where astatus=0");
                        } elseif ($_settings->userdata('type') == 2) {
                            $qry = $conn->query("SELECT * from `child_meals`
                                                            INNER JOIN enrollment_list ON child_meals.child_id = enrollment_list.id
                                                            INNER JOIN assignment_list ON assignment_list.child_id = enrollment_list.id
						             where enrollment_list.astatus=0 and assignment_list.caregiver_id=$uid");
                        } else {
                            $qry = $conn->query("SELECT * from `child_meals`
                                                            INNER JOIN enrollment_list ON child_meals.child_id = enrollment_list.id
                                                             where astatus=0 and child_meals.parent_id=$uid");
                        }
                        while ($row = $qry->fetch_assoc()):
                            ?>
                            <tr>
                                <td class="text-center"><?php echo $i++; ?></td>
                                <td><?php echo ($row['child_fullname']) ?></td>
                                <td><?php echo ($row['meal_date']) ?></td>
                                <td><?php echo ($row['meal_time']) ?></td>
                                <td><?php echo ucwords($row['meal_type']) ?></td>
                                <td><?php echo ucwords($row['food_items']) ?></td>
                                <td><?php echo ucwords($row['description']) ?></td>
                                <td style="color: blue;"><?php echo($row['note']) ?></td>
                                <?php if ($_settings->userdata('type') == 2): ?>
                                    <td>
                                        <textarea name="note_<?php echo $row['meal_id']; ?>" id="note_<?php echo $row['meal_id']; ?>" class="form-control form-control-border"></textarea>
                                    </td>
                                    <td>
                                        <button id="save_<?php echo $row['meal_id']; ?>" class="btn btn-flat btn-primary meal-form" data-meal-id="<?php echo $row['meal_id']; ?>">Save</button>
                                    </td>
                                <?php endif; ?>


                                <td align="center">
                                    <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                        Action
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                        <?php if ($_settings->userdata('type') == 2): ?>
                                            <button type="button" id="<?php echo $row['child_id'] ?>" class="dropdown-item report_button">
                                                <input type="hidden" name="chaild_id" id="chaild_id" value="<?php echo $row['child_id'] ?>" />
                                                <span class="fa fa-exclamation-circle text-danger mr-2"></span>Report
                                            </button>
                                        <?php endif; ?>
                                        <?php if ($_settings->userdata('type') == 3): ?>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="./?page=meal/uppdate_meal&id=<?= $row['meal_id'] ?>" data-id="<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> update</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['meal_id'] ?>"  data-name="<?= $row['meal_id'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
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
<script>
    $(document).ready(function () {
        $('.delete_data').click(function () {
            _conf("Are you sure to delete <b>" + $(this).attr('data-name') + "</b> from meals List permanently?", "delete_meal", [$(this).attr('data-id')])
        })
        $('.table td,.table th').addClass('py-1 px-2 align-middle')
        $('.verify_user').click(function () {
            _conf("Are you sure to verify <b>" + $(this).attr('data-name') + "<b/>?", "verify_user", [$(this).attr('data-id')])
        })
        $('.view_details').click(function () {
            uni_modal('meal Details', "meal/view_details.php?id=" + $(this).attr('data-id'), 'mid-large')
        })
        $('.table').dataTable();

    })
    function delete_meal($id) {
        start_loader();
        $.ajax({
            url: _base_url_ + "classes/Master.php?f=delete_meal",
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
    $(document).on('click', '.meal-form', function () {
        var meal_id = $(this).data('meal-id');
        var note = $('#note_' + meal_id).val();
        $.ajax({
            url: _base_url_ + "classes/Master.php?f=uppdate_meal_note",
            method: "GET",
            data: {meal_id: meal_id, note: note},
            success: function (response) {
                // Reload the page after successful update
                location.reload();
            },
            error: function (xhr, status, error) {
                // Handle error if necessary
                console.error(xhr.responseText);
            }
        });
    });


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
                url: "attendance_action.php",
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
                        dataTable.ajax.reload();
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
                    window.open(_base_url_ + "classes/Master.php?f=meal_report1&from_date=" + from_date + "&to_date=" + to_date + "&uid=" + <?php echo $uid ?>);
                } else {
                    window.open(_base_url_ + "classes/Master.php?f=meal_report2&from_date=" + from_date + "&to_date=" + to_date + "&uid=" + chaild_id);
                }

            }

        });

    });

</script>