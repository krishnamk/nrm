<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Access Level List</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">List</a></li>
                                <li class="breadcrumb-item active">Access Level</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 message"><?php message(); ?></div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="button-items" style="text-align: right;">
                                <a href="<?php echo base_url('access_level');?>" class="btn btn-primary waves-effect waves-light"><i class="bx bxs-comment-add font-size-16 align-middle mr-2"></i>Add Access Level</a>
                            </div><br>
                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>S.NO</th>
                                        <th>ACCESS LEVEL NAME</th>
                                        <th>ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($lists){
                                        foreach ($lists as $key => $list) { ?>
                                          <tr>
                                            <td><?php echo next_number($key); ?></td>
                                            <td><?php echo $list['access_level_name']; ?></td>
                                            <!-- <td>                                              
                                              <a href="<?php echo base_url('access_level_update/'.$list['access_level_id']); ?>" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Access Level Update" style="margin-top:5px;"><i class="fa fa-pencil-alt"></i></a> &nbsp;
                                              <a href="<?php echo base_url('access_level_remove/'.$list['access_level_id']); ?>" class="btn btn-danger remove" data-toggle="tooltip" data-placement="top" title="Access Level Remove" style="margin-top:5px;"><i class="fa fa-trash"></i></a> &nbsp;
                                          </td> -->
                                          <td><?php if($list['status'] == 1){ ?>
                                              <a href="<?php echo base_url('access_level_block/'.$list['access_level_id']); ?>" class="btn btn-danger confirm" data-toggle="tooltip" data-placement="top" title="Access Level Block" style="margin-top:5px;"><i class="fa fa-lock"></i></a> &nbsp;
                                              <?PHP }else{ ?>
                                                  <a href="<?php echo base_url('access_level_unblock/'.$list['access_level_id']); ?>" class="btn btn-success confirm" data-toggle="tooltip" data-placement="top" title="Access Level Block" style="margin-top:5px;"><i class="fa fa-lock-open"></i></a> &nbsp;
                                              <?php } ?>
                                              
                                              <a href="<?php echo base_url('access_level_update/'.$list['access_level_id']); ?>" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Access Level Update" style="margin-top:5px;"><i class="fa fa-pencil-alt"></i></a> &nbsp;
                                              <a href="<?php echo base_url('access_level_remove/'.$list['access_level_id']); ?>" class="btn btn-danger remove" data-toggle="tooltip" data-placement="top" title="Access Level Remove" style="margin-top:5px;"><i class="fa fa-trash"></i></a> &nbsp;
                                          </td>
                                      </tr>
                                  <?php  }
                              }?>
                          </tbody>
                      </table>
                  </div>
              </div>
          </div> <!-- end col -->
      </div> <!-- end row -->
  </div>
</div>
</div>