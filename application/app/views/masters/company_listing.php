<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Company List</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">List</a></li>
                                <li class="breadcrumb-item active">Company</li>
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
                            <?php $company_count = $this->common->count('company_details','company_status!=0'); ?> 
                            <?php if($this->common->get_particular('mst_general_settings',array('general_settings_name' => 'single_company'),'general_settings_value')==1){ ?>
                                <?php if($company_count == 0){ ?> 
                                    <div class="button-items" style="text-align: right;">
                                        <a href="<?php echo base_url('company');?>" class="btn btn-primary waves-effect waves-light"><i class="bx bxs-comment-add font-size-16 align-middle mr-2"></i>Add Company</a>
                                    </div>
                                <?php } ?>
                            <?php } elseif($this->common->get_particular('mst_general_settings',array('general_settings_name' => 'multiple_company'),'general_settings_value')==1) { ?>   
                                <div class="button-items" style="text-align: right;">
                                    <a href="<?php echo base_url('company');?>" class="btn btn-primary waves-effect waves-light"><i class="bx bxs-comment-add font-size-16 align-middle mr-2"></i>Add Company</a>
                                </div>
                            <?php } ?>
                            <br>
                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>S.No</th> 
                                        <th>Company Name</th>
                                        <th>Company Location</th>
                                        <th>Company Phone</th>
                                        <th>Company Mobile</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($lists){ 
                                        foreach($lists as $key => $list) { ?>
                                            <tr>
                                                <td><?php echo $key+1;?></td> 
                                                <td><?php echo $list['company_name'];?></td>
                                                <td><?php echo $list['company_location'];?></td>
                                                <td><?php echo $list['company_phone'];?></td>
                                                <td><?php echo $list['company_contact_no'];?></td>
                                                <td>
                                                    <a href="<?php echo base_url('company_edit/'.$list['company_id']);?>" class="btn btn-success"><i class="mdi mdi-comment-edit"></i></a>
                                                    <a href="<?php echo base_url('company_delete/'.$list['company_id']);?>" class="btn btn-danger cancel"><i class="mdi mdi-delete-circle"></i></a>
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