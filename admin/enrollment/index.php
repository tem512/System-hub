<style>
    .img-avatar{
        width:45px;
        height:45px;
        object-fit:cover;
        object-position:center center;
        border-radius:100%;
    }
</style>
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">List of Enrollments</h3>
        <div class="card-tools">
            <?php if ($_settings->userdata('type') == 3): ?>
                <a href="./?page=enrollment/enrollment" class="btn btn-flat btn-primary btn-sm"><i class="fa fa-plus"></i> Enrollment </a>
            <?php endif; ?>
        </div>

    </div>

    <div class="card-body">
        <div class="container-fluid">
            <div class="container-fluid">
                <table class="table table-hover table-striped">
                    <colgroup>
                        <col width="5%">
                        <col width="15%">
                        <col width="15%">
                        <col width="20%">
                        <col width="20%">
                        <col width="10%">
                        <col width="10%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date Created</th>
                            <th>Enrollment Code</th>
                            <th>Child's Name</th>
                            <th>Parent/Guardian's Name</th>
                            <th>Confirmation Status</th>
                            <th>Avaliblity Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        $uid = $_settings->userdata('id');
                        if ($_settings->userdata('type') == 3) {
                            $qry = $conn->query("SELECT * from `enrollment_list` where parent_id=$uid and astatus=0 order by `id` desc, unix_timestamp(date_created) desc ");
                        }  
                        elseif ($_settings->userdata('type') == 2) { 
                         $qry = $conn->query("SELECT *
                                                   FROM assignment_list
                                                   INNER JOIN enrollment_list ON assignment_list.child_id = enrollment_list.id
                                                    WHERE assignment_list.caregiver_id=$uid and astatus=0 order by enrollment_list.id desc");
                        }
                        else
                        {
                         $qry = $conn->query("SELECT * from `enrollment_list` order by `id` desc, unix_timestamp(date_created) desc ");   
                        }
                        while ($row = $qry->fetch_assoc()):
                            ?>
                            <tr>
                                <td class="text-center"><?php echo $i++; ?></td>
                                <td class=""><?php echo date("Y-m-d H:i", strtotime($row['date_created'])) ?></td>
                                <td><?php echo ($row['code']) ?></td>
                                <td><?php echo ucwords($row['child_fullname']) ?></td>
                                <td><?php echo ucwords($row['parent_fullname']) ?></td>
                                <td class="text-center">
                                    <?php
                                    switch ($row['status']) {
                                        case '1':
                                            echo "<span class='badge badge-primary badge-pill'>Confirmed</span>";
                                            break;
                                        case '0':
                                            echo "<span class='badge badge-secondary badge-pill'>Pending</span>";
                                            break;
                                    }
                                    ?>
                                </td>
                                <td class="text-center">
                                    <?php
                                    switch ($row['astatus']) {
                                        case '1':
                                            echo "<span class='badge badge-danger badge-pill'>Inactive</span>";
                                            break;
                                        case '0':
                                            echo "<span class='badge badge-success badge-pill'>Active</span>";
                                            break;
                                    }
                                    ?>
                                </td>
                                <td align="center">
                                    <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                        Action
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                        <a class="dropdown-item view_details" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-window-restore text-gray"></span> View</a>
                                        <?php if ($_settings->userdata('type') == 1 or $_settings->userdata('type') == 0): ?>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item update_status" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>" data-id="<?php echo $row['id'] ?>" data-astatus="<?php echo $row['astatus'] ?>" data-status="<?php echo $row['status'] ?>"  data-code="<?php echo $row['code'] ?>"><span class="fa fa-check text-dark"></span> Update Status</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>" data-code="<?php echo $row['code'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('.delete_data').click(function () {
            _conf("Are you sure to delete <b>" + $(this).attr('data-code') + "\'s</b> from enrollment list permanently?", "delete_enrollment", [$(this).attr('data-id')])
        })
        $('.update_status').click(function () {
            uni_modal("Update <b>" + $(this).attr('data-code') + "\'s</b> Status", "enrollment/update_status.php?id=" + $(this).attr('data-id') + "&status=" + $(this).attr('data-status') + "&astatus=" + $(this).attr('data-astatus'))
        })
        $('.view_details').click(function () {
            uni_modal("Enrollment Details", "enrollment/view_details.php?id=" + $(this).attr('data-id'), 'large')
        })
        $('.table td,.table th').addClass('py-1 px-2 align-middle')
        $('.table').dataTable({
            columnDefs: [
                {orderable: false, targets: 5}
            ],
        });
    })
    function delete_enrollment($id) {
        start_loader();
        $.ajax({
            url: _base_url_ + "classes/Master.php?f=delete_enrollment",
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
</script>