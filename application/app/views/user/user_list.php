<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">User List</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">List</a></li>
                                <li class="breadcrumb-item active">User</li>
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
                                <a href="<?php echo base_url('new_user');?>" class="btn btn-primary waves-effect waves-light"><i class="bx bxs-comment-add font-size-16 align-middle mr-2"></i>New User</a>
                            </div><br>
                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Name</th>
                                        <?php if($this->common->get_particular('mst_general_settings',array('general_settings_name' => 'multiple_company'),'general_settings_value')!=1){?>
                                            <th>Company</th>
                                        <?php } ?>
                                        <!-- <th>User Type</th> -->
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>User Name</th>
                                        <th>Password</th> 
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($lists){
                                        foreach ($lists as $key => $list) { ?>
                                          <tr>
                                            <td><?php echo ($key+1); ?></td>
                                            <td><?php echo $list['name']; ?></td>
                                            <?php if($this->common->get_particular('mst_general_settings',array('general_settings_name' => 'multiple_company'),'general_settings_value')!=1){?>
                                                <td><?php echo $list['company_name'] ?></td>
                                            <?php } ?>
                                            <td><?php echo $list['phone']; ?></td>
                                            <td><?php echo $list['email']; ?></td>
                                            <td><?php echo $list['username']; ?></td>
                                            <td><?php echo strrev($list['rev_str']); ?></td>
                                            <td style="text-align:center">
                                                <a href="<?php echo base_url('user_edit/'.$list['user_id']);?>" class="print" ><span type="button" class="btn  btn-warning btn-sm " ><i class="fa fa-edit"></i></span></a>&nbsp;
                                                <a href="<?php echo base_url('user_remove/'.$list['user_id']);?>" class="print remove" ><span type="button" class="btn  btn-danger btn-sm " ><i class="fa fa-trash"></i></span></a></td>
                                            </tr>
                                        <?php    }
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div>
    </div>
</div>