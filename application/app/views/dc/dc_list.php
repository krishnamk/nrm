<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Dc List</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">List</a></li>
                                <li class="breadcrumb-item active">Dc</li>
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
                                <a href="<?php echo base_url('dc');?>" class="btn btn-primary waves-effect waves-light"><i class="bx bxs-comment-add font-size-16 align-middle mr-2"></i>Add Dc</a>
                            </div><br> 
                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Date</th>
                                        <th>Dc No</th>
                                        <th>Customer</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($lists){ 
                                        foreach($lists as $key => $dc) { ?>
                                            <tr>
                                                <td><?php echo $key+1;?></td>
                                                <td><?php echo date('d-m-Y',strtotime($dc['dc_date']));?></td>
                                                <td><?php echo $dc['dc_number'];?></td>
                                                <td><?php echo $dc['customer_name'];?></td>
                                                <td><?php 
                                                if($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'multiple_dc_to_estimate_generate'),'estimate_settings_value') == 1) { 
                                                    echo auto_dc_status($dc['status']);
                                                }else{
                                                  echo auto_dc_status($dc['dc_status']);  
                                              }
                                          ?></td>
                                          <td>
                                            <a href="<?php echo base_url('dc_view/'.$dc['dc_id']);?>" class="btn btn-primary"><i class="mdi mdi-view-compact-outline"></i></a>

                                            <?php if($dc['status'] != "0" && $dc['status'] !="2") { ?>
                                                <a href="<?php echo base_url('dc_edit/'.$dc['dc_id']);?>" class="btn btn-success"><i class="mdi mdi-comment-edit"></i></a>
                                            <?php } ?>

                                            <?php if($dc['status']!="0"){ ?>
                                                <a href="<?php echo base_url('dc_delete/'.$dc['dc_id']);?>" class="btn btn-danger cancel"><i class="mdi mdi-delete-circle"></i></a>
                                            <?php } elseif($dc['dc_cancel']!="0") { ?>
                                                <?php echo quotation_dc_status($dc['dc_cancel']);?>
                                            <?php } else{ ?> 
                                                <?php echo dc_status($dc['dc_cancel']);?>
                                            <?php } ?>

                                            <?php if($this->common->get_particular('mst_settings',array('settings_name' => 'dc_mail_status'),'settings_value')==1){ ?>
                                                <a href="<?php echo base_url('dc_mail/'.$dc['dc_id']);?>" class="btn btn-warning"><i class="mdi mdi-email-send"></i></a>
                                            <?php } ?>
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