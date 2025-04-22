<?php 
$time = date("H:i:s");
$uid=$_settings->userdata('id');
$qry = $conn->query("SELECT * 
                     FROM enrollment_list
                     where astatus=0 and enrollment_list.parent_id=$uid");


?>
<div class="content py-3">
    <div class="container-fluid">
        <div class="card card-outline card-info shadow rounded-0">
            <?php if($_settings->userdata('type') == 2): ?>
            <div class="card-header bg-info">
                        <h1 class="card-title text-center text-white"><strong>Add New Meal traking information</strong></h1>
                    </div>
                <?php endif;?>
            <div class="card-body">
                <div class="container-fluid">
                    <form action="" id="meal_form">
                    <input type="hidden" name="parent_id" id="parent_id"value="<?php echo $_settings->userdata('id')?>">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="" class="control-label">Child's Name</label>
                                <select name="child_fullname" id="child_fullname" class="form-control form-control-border"  required>
                            <option value="" disabled selected>Select child's full name</option>
                                    <?php  while($row = $qry->fetch_assoc()):?>
                                    <option value="<?php echo isset($row['id']) ? $row['id'] : ''; ?>"><?php echo isset($row['child_fullname']) ? $row['child_fullname'] : ''; ?></option>

                                <?php endwhile; ?>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="meal_type" class="control-label">Meal Type</label>
                                <input type="text" name="meal_type" id="meal_type" class="form-control form-control-border" required value="<?= isset($meal_type) ? $meal_type : "" ?>"> 
                            </div>
                            <div class="form-group col-md-4">
                                <label for="food_items" class="control-label">Food Items</label>
                                <input type="text" name="food_items" id="food_items" class="form-control form-control-border" required value="<?= isset($food_items) ? $food_items : "" ?>"> 
                            </div>
                        </div>
                         <div class="row">

                        
                            <div class="form-group col-md-4">
                                <label for="descrption" class="control-label">Description</label>
                                <textarea  name="description" id="description" class="form-control form-control-border" required> </textarea>
                            </div>                       
                            
                            <div class="form-group col-md-4">
                                <label for="date" class="control-label">Meal Date</label>
                                <input type="date" name="meal_date" id="date" class="form-control form-control-border" required> 
                            </div>
                            <div class="form-group col-md-4">
                                <label for="time" class="control-label">Meal Time</label>
                                <input type="time" name="time" id="time" class="form-control form-control-border" required > 
                            </div>

                        </div>

                    </form>
                </div>
            </div>
            <div class="card-footer">
                <div class="text-center">
                    <button class="btn btn-flat btn-primary" form="meal_form"><i class="fa fa-save"></i> Save</button>
                    <a href="./?page=meal" class="btn btn-flat btn-light border"><i class="fa fa-angle-left"></i> Cancel</a>
                </div>
            </div>

        </div>
    </div>
</div>

    <script>
    $(function () {
        $('#meal_form').submit(function (e) {
            e.preventDefault()
            var _this = $(this)
            $('.pop-msg').remove()
            var el = $('<div>')
            el.addClass("pop-msg alert")
            el.hide()
            start_loader();
            $.ajax({
                url: _base_url_ + "classes/Master.php?f=save_meal",
                data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
                error: err => {
                    console.log(err);
                    alert_toast("An error occured", 'error');
                    end_loader();
                },
                success: function (resp) {
                    if (resp.status == 'success') {
                        location.href = "./?page=meal";
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