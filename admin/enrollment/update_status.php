<div class="container-fluid">
    <form action="" id="update_status_form">
        <input type="hidden" name="id" value="<?= isset($_GET['id']) ? $_GET['id'] : "" ?>">
        <div class="form-group">
            <label for="status" class="control-label text-navy">confirmation Status</label>
            <select name="status" id="status" class="form-control form-control-border" required>
                <option value="0" <?= isset($_GET['status']) && $_GET['status'] == 0 ? "selected" : "" ?>>Pending</option>
                <option value="1" <?= isset($_GET['status']) && $_GET['status'] == 1 ? "selected" : "" ?>>Confirmed</option>
            </select>

            <label for="astatus" class="control-label text-navy">Availability Status</label>
            <select name="astatus" id="astatus" class="form-control form-control-border" required>
                <option value="0" <?= isset($_GET['astatus']) && $_GET['astatus'] == 0 ? "selected" : "" ?>>Active</option>
                <option value="1" <?= isset($_GET['astatus']) && $_GET['astatus'] == 1 ? "selected" : "" ?>>Inactive</option>
            </select>
        </div>
    </form>
</div>
<script>
    $(function () {
        $('#update_status_form').submit(function (e) {
            e.preventDefault()
            start_loader()
            var el = $('<div>')
            el.addClass("pop-msg alert")
            el.hide()
            $.ajax({
                url: _base_url_ + "classes/Master.php?f=update_status",
                method: "POST",
                data: $(this).serialize(),
                dataType: "json",
                error: err => {
                    console.log(err)
                    alert_taost("An error occured while saving the data,", "error")
                    end_loader()
                },
                success: function (resp) {
                    if (resp.status == 'success') {
                        location.reload()
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
                    end_loader();
                }
            })
        })
    })
</script>