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
        <h3 class="card-title">List of assignment</h3>
        <div class="card-tools">
            <a href="./?page=assignment/manage_assignment" class="btn btn-flat btn-primary btn-sm"><i class="fa fa-plus"></i> Make Assignment </a>
        </div>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <div class="container-fluid">
                <table class="table table-hover table-striped">
                        <!-- <colgroup>
                                <col width="5%">
                                <col width="10%">
                                <col width="20%">
                                <col width="20%">
                                <col width="15%">
                                <col width="15%">
                                <col width="10%">
                        </colgroup> -->
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Child's Name</th>
                            <th>Caregiver Name</th>
                            <th>Room</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;

                        $qry = $conn->query("SELECT assignment_list.id,assignment_list.child_id,assignment_list.caregiver_id,rooms.rooms_name,enrollment_list.child_fullname, CONCAT(users.firstname, ' ', users.lastname) AS name
          FROM assignment_list
          INNER JOIN enrollment_list ON assignment_list.child_id = enrollment_list.id
          INNER JOIN rooms ON assignment_list.rooms_id = rooms.id
          INNER JOIN users ON assignment_list.caregiver_id = users.id where astatus=0");
                        while ($row = $qry->fetch_assoc()):
                            ?>
                            <tr>
                                <td class="text-center"><?php echo $i++; ?></td>
                                <td><?php echo($row['child_fullname']) ?></td>
                                <td><?php echo ($row['name']) ?></td>
                                <td><?php echo ($row['rooms_name']) ?></td>
                                <td align="center">
                                    <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                        Action
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="./?page=assignment/uppdate_assignment&id=<?= $row['id'] ?>" data-id="<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"  data-name="<?= $row['child_fullname'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
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
            _conf("Are you sure to delete <b>" + $(this).attr('data-name') + "</b> from Assignment permanently?", "delete_assignment", [$(this).attr('data-id')])
        })
        $('.table td,.table th').addClass('py-1 px-2 align-middle')
        $('.verify_user').click(function () {
            _conf("Are you sure to verify <b>" + $(this).attr('data-name') + "<b/>?", "verify_user", [$(this).attr('data-id')])
        })
        $('.view_details').click(function () {
            uni_modal('Babysitter Details', "babysitters/view_details.php?id=" + $(this).attr('data-id'), 'mid-large')
        })
        $('.table').dataTable();

    })
    function delete_assignment($id) {
        start_loader();
        $.ajax({
            url: _base_url_ + "classes/Master.php?f=delete_assignment",
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
</script>