
<div class="content py-3">
    <div class="container-fluid">
        <div class="card card-outline card-info shadow rounded-0">
            <div class="card-header bg-info">
                <h1 class="card-title text-center text-white"><strong>Add New Rooms</strong></h1>
            </div>
            <div class="card-body">
                <div class="container-fluid">
                    <form action="" id="rooms-form">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="" class="control-label">Rooms Name</label>
                                <input type="text" name="rooms" id="rooms" class="form-control form-control-border" placeholder="Room name"required> 
                            </div>
                        </div>

                    </form>
                </div>
            </div>
            <div class="card-footer">
                <div class="text-center">
                    <button class="btn btn-flat btn-primary" form="rooms-form"><i class="fa fa-save"></i> Save</button>
                    <a href="./?page=rooms" class="btn btn-flat btn-light border"><i class="fa fa-angle-left"></i> Cancel</a>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    $(function () {
        $('#rooms-form').submit(function (e) {
            e.preventDefault();
            var _this = $(this);
            $('.pop-msg').remove();
            var el = $('<div>').addClass("pop-msg alert").hide();
            start_loader();
            $.ajax({
                url: _base_url_ + "classes/Master.php?f=save_rooms",
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
                        location.href = "./?page=rooms";
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
