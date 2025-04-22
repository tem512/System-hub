<?php
$time = date("H:i:s");
$id = $_GET['id']; // Storing the value of $_GET['id'] in a variable to prevent SQL injection

$res = "SELECT * FROM child_meals
          INNER JOIN enrollment_list ON enrollment_list.id = child_meals.child_id
          WHERE child_meals.meal_id = $id"; // Using $id variable in the query
$result = $conn->query($res);
$data = $result->fetch_assoc();
$uid = $_settings->userdata('id');
$qry = $conn->query("SELECT * 
                     FROM enrollment_list
                     where astatus=0 and enrollment_list.parent_id=$uid");
// $qry1 = $conn->query("SELECT * from `health_list` ");
?>
<?php //echo isset($meta['id']) ? $meta['id']: ''     ?>
<?php //if($_settings->chk_flashdata('success')):     ?>


<div class="content py-3">
    <div class="container-fluid">
        <div class="card card-outline card-info shadow rounded-0">
            <div class="card-header bg-info">
                <h1 class="card-title text-center text-white"><strong>Uppdate Meal Tracking Information</strong></h1>
            </div>
            <div class="card-body">
                <div class="container-fluid">
                    <form action="" id="meal-form">
                        <input type="hidden" name="meal_id" id="meal_id"value="<?php echo $data['meal_id'] ?>">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="" class="control-label">Child's Name</label>
                                <select name="child_fullname" id="child_fullname" class="form-control form-control-border" required> 
                                    <option value="<?php echo $data['child_id']; ?>"><?php echo $data['child_fullname']; ?></option>
                                    <?php while ($row = $qry->fetch_assoc()): ?>
                                        <?php if ($row['id'] != $data['child_id']): ?>
                                            <option value="<?php echo $row['id']; ?>"><?php echo $row['child_fullname']; ?></option>
                                        <?php endif; ?>
                                    <?php endwhile; ?>
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="meal_type" class="control-label">Meal type</label>
                                <input type="text" name="meal_type" id="meal_type" class="form-control form-control-border"  value="<?php echo $data['meal_type'] ?>"> 
                            </div>

                            <div class="form-group col-md-4">
                                <label for="food_items" class="control-label">Food Items</label>
                                <input type="text" name="food_items" id="food_items" class="form-control form-control-border"  value="<?php echo $data['food_items'] ?>"> 
                            </div>  
                        </div>

                        <div class="row">


                            <div class="form-group col-md-4">
                                <label for="descrption" class="control-label">Description</label>
                                <input type="text" name="description" id="descrption" class="form-control form-control-border"value="<?php echo $data['description'] ?>"> 
                            </div>
                            <div class="form-group col-md-4">
                                <label for="time" class="control-label">Meal Time</label>
                                <input type="time" name="time" id="time" class="form-control form-control-border" value="<?php echo $data['meal_time'] ?>"> 
                            </div>
                            <div class="form-group col-md-4">
                                <label for="date" class="control-label">Meal Date</label>
                                <input type="date" name="meal_date" id="date" class="form-control form-control-border"  value="<?php echo $data['meal_date'] ?>"> 
                            </div>
                        </div>

                    </form>
                </div>
            </div>
            <div class="card-footer">
                <div class="text-center">
                    <button class="btn btn-flat btn-primary" form="meal-form"><i class="fa fa-save"></i> Save</button>
                    <a href="./?page=meal" class="btn btn-flat btn-light border"><i class="fa fa-angle-left"></i> Cancel</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function () {
        $('#meal-form').submit(function (e) {
            e.preventDefault();
            var _this = $(this);
            $('.pop-msg').remove();
            var el = $('<div>').addClass("pop-msg alert").hide();
            start_loader();
            $.ajax({
                url: _base_url_ + "classes/Master.php?f=uppdate_meal",
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
                        location.href = "./?page=meal";
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