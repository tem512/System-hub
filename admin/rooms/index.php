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
        <h3 class="card-title">Rooms Information </h3>
        <div class="card-tools">
            <a href="./?page=rooms/manage_rooms" class="btn btn-flat btn-primary btn-sm"><i class="fa fa-plus"></i> Add New</a>
        </div>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <div class="container-fluid">
                <table class="table table-hover table-striped">

                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Rooms Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        $qry = $conn->query("SELECT * from `rooms`");
                        while ($row = $qry->fetch_assoc()):
                            ?>
                            <tr>
                                <td ><?php echo $i++; ?></td>
                                <td><?php echo $row['rooms_name'] ?></td>
                                <td>
                                    <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                        Action
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="./?page=rooms/update_rooms&id=<?= $row['id'] ?>" data-id="<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"  data-name="<?= $row['id'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
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
</script>