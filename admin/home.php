<h1><?php echo $_settings->info('name') ?></h1>
<hr class="border-info">
<div class="row">
    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
        <div class="info-box bg-orange hover-expand-effect">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-th-list"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Service List</span>
            <span class="info-box-number text-right">
                <?php 
                    echo $conn->query("SELECT * FROM `service_list` where status = 1")->num_rows;
                ?>
            </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
        <div class="info-box bg-light shadow">
            <span class="info-box-icon bg-gradient-dark elevation-1"><i class="fas fa-users"></i></span>
            <div class="info-box-content">
            <span class="info-box-text">Babysitters List</span>
            <span class="info-box-number text-right">
                <?php 
                    echo $conn->query("SELECT * FROM `babysitter_list` where `status` = 1")->num_rows;
                ?>
            </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
        <div class="info-box bg-pink hover-expand-effect">
            <span class="info-box-icon bg-gradient-secondary elevation-1"><i class="fas fa-file-alt"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Pending Enrollee</span>
            <span class="info-box-number text-right">
                <?php 
                    echo $conn->query("SELECT * FROM `enrollment_list` where `status` = 0")->num_rows;
                ?>
            </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
        <div class="info-box bg-cyan hover-expand-effect">
            <span class="info-box-icon bg-gradient-primary elevation-1"><i class="fas fa-file-alt"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Confirmed Enrollee</span>
            <span class="info-box-number text-right">
                <?php 
                    echo $conn->query("SELECT * FROM `enrollment_list` where `status` = 1")->num_rows;
                ?>
            </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
</div>
<div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-images"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Albums</span>
                <span class="info-box-number">
                  <?php echo $conn->query("SELECT * FROM album_list where delete_f = 0 and user_id = '{$_settings->userdata('id')}'")->num_rows ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-image"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Images</span>
                <span class="info-box-number">
                <?php echo $conn->query("SELECT * FROM `images` where delete_f = 0 and user_id = '{$_settings->userdata('id')}'")->num_rows ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

</div>