<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Branch List</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">List</a></li>
                                <li class="breadcrumb-item active">Branch</li>
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
                                <a href="<?php echo base_url('branch');?>" class="btn btn-primary waves-effect waves-light"><i class="bx bxs-comment-add font-size-16 align-middle mr-2"></i>Add Branch</a>
                            </div><br>
                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>S.No</th> 
                                        <th>Company Name</th>
                                        <th>Branch Name</th>
                                        <th>Branch Location</th>
                                        <th>Branch Phone</th>
                                        <th>Branch Mobile</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($lists){ 
                                        foreach($lists as $key => $list) { ?>
                                            <tr>
                                                <td><?php echo $key+1;?></td>
                                                <td><?php $company = $this->common->get_particular('company_details',array('company_id' => $list['company_id']),'company_name'); echo $company;?></td> 
                                                <td><?php echo $list['branch_name'];?></td>
                                                <td><?php echo $list['branch_location'];?></td>
                                                <td><?php echo $list['branch_phone'];?></td>
                                                <td><?php echo $list['branch_contact_no'];?></td>
                                                <td>
                                                    <a href="<?php echo base_url('branch_edit/'.$list['branch_id']);?>" class="btn btn-success"><i class="mdi mdi-comment-edit"></i></a>
                                                    <a href="<?php echo base_url('branch_delete/'.$list['branch_id']);?>" class="btn btn-danger cancel"><i class="mdi mdi-delete-circle"></i></a>
                                                </td>
                                            </tr>
                                        <?php } }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->
            </div>
        </div>
    </div>