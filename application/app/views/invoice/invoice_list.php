<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Invoice List</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">List</a></li>
                                <li class="breadcrumb-item active">Invoice</li>
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
                                <a href="<?php echo base_url('invoice');?>" class="btn btn-primary waves-effect waves-light"><i class="bx bxs-comment-add font-size-16 align-middle mr-2"></i>Add Invoice</a>
                            </div><br>
                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Date</th>
                                        <th>Invoice No</th>
                                        <th>Customer</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($lists){ 
                                        foreach($lists as $key => $invoice) { ?>
                                            <tr>
                                                <td><?php echo $key+1;?></td>
                                                <td><?php echo date('d-m-Y',strtotime($invoice['invoice_date']));?></td>
                                                <td><?php echo $invoice['invoice_number'];?></td>
                                                <td><?php echo $invoice['customer_name'];?></td>
                                                <td><?php echo dc_status($invoice['status']);?></td>
                                                <td>
                                                    <a href="<?php echo base_url('invoice_view/'.$invoice['invoice_id']);?>" class="btn btn-primary"><i class="mdi mdi-view-compact-outline"></i></a>
                                                    <a href="<?php echo base_url('invoice_print/'.$invoice['invoice_id']);?>" class="btn btn-info"><i class="fa fa-print"></i></a>
                                                    <?php if($invoice['invoice_cancel']=="0") { ?> 
                                                        <?php if($invoice['status']!="2") { ?>
                                                            <a href="<?php echo base_url('invoice_edit/'.$invoice['invoice_id']);?>" class="btn btn-success"><i class="mdi mdi-comment-edit"></i>
                                                            </a>
                                                        <?php } ?>
                                                        <?php if($invoice['invoice_cancel']=="0"){ ?>
                                                            <a href="<?php echo base_url('invoice_remove/'.$invoice['invoice_id']);?>" class="btn btn-danger cancel"><i class="mdi mdi-delete-circle"></i></a>
                                                        <?php } ?>
                                                        <?php if($this->common->get_particular('mst_settings',array('settings_name' => 'invoice_mail_status'),'settings_value')==1){ ?>
                                                            <a href="<?php echo base_url('invoice_mail/'.$invoice['invoice_id']);?>" class="btn btn-warning"><i class="mdi mdi-email-send"></i></a>
                                                        <?php } ?>
                                                        <?php if($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_dc_generate'),'settings_value')== 1) { ?> 
                                                            <?php if($invoice['status']!="2") { ?> 
                                                                <a href="<?php echo base_url('invoice_generate_dc/'.$invoice['invoice_id']);?>" style="margin-right: 5px;" class="btn btn-warning"><i class="bx bxs-truck font-size-16 align-middle mr-2"></i>Generate DC</a>
                                                            <?php }else{ ?> 
                                                                <a href="#" class="btn btn-secondary"><i class="bx bxs-truck font-size-16 align-middle mr-2"></i>DC Generated</a>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    <?php } else { ?>
                                                        <?php echo invoice_status($invoice['invoice_cancel']);?>
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