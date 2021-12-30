<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Logs List</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">List</a></li>
                                <li class="breadcrumb-item active">Logs</li>
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
                            <?php 
                            $logs = $this->logs->get_log_counts($log_category_id);
                            if($logs['count']!="0") { ?> 
                                <div class="button-items" style="text-align: right;">
                                    <a href="<?php echo base_url('change_log_status/'.$log_category_id);?>" class="btn btn-success waves-effect waves-light"><i class="bx bxs-comment-add font-size-16 align-middle mr-2"></i>Mark All as Read</a>
                                </div><br>
                            <?php } ?>
                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Date</th>
                                        <th>log Operation</th>
                                        <th>User Name</th>
                                        <th>Details</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($lists){ 
                                        foreach($lists as $key => $log) { ?>
                                            <tr>
                                                <td><?php echo $key+1;?></td>
                                                <td><?php echo date('d-m-Y',strtotime($log['created_on']));?></td>
                                                <td><?php echo $log['operation'];?></td>
                                                <td><?php $user_name = $this->common->get_particular('mst_users',array('user_id' =>$log['user_id']),'name'); echo $user_name;?></td>
                                                <td><?php echo $log['operation_details'];?></td>
                                                <td>
                                                    <?php if($log['product_id']!="0") { ?>
                                                        <a href="<?php echo base_url('product_edit/'.$log['product_id']);?>" class="btn btn-primary"><i class="mdi mdi-view-compact-outline"></i></a>
                                                    <?php } elseif($log['invoice_id']!="0"){ ?>
                                                        <a href="<?php echo base_url('invoice_view/'.$log['invoice_id']);?>" class="btn btn-primary"><i class="mdi mdi-view-compact-outline"></i></a>
                                                    <?php } elseif($log['dc_id']!="0"){ ?>
                                                        <a href="<?php echo base_url('dc_view/'.$log['dc_id']);?>" class="btn btn-primary"><i class="mdi mdi-view-compact-outline"></i></a>
                                                    <?php } elseif($log['estimate_id']!="0"){ ?>
                                                        <a href="<?php echo base_url('estimate_view/'.$log['estimate_id']);?>" class="btn btn-primary"><i class="mdi mdi-view-compact-outline"></i></a>
                                                    <?php } elseif($log['quotation_id']!="0"){ ?>
                                                        <a href="<?php echo base_url('quotation_view/'.$log['quotation_id']);?>" class="btn btn-primary"><i class="mdi mdi-view-compact-outline"></i></a>
                                                    <?php } elseif($log['sales_return_id']!="0"){ ?>
                                                        <a href="<?php echo base_url('sales_return_view/'.$log['sales_return_id']);?>" class="btn btn-primary"><i class="mdi mdi-view-compact-outline"></i></a>
                                                    <?php } elseif($log['purchase_dc_id']!="0"){ ?>
                                                        <a href="<?php echo base_url('purchase_dc_view/'.$log['purchase_dc_id']);?>" class="btn btn-primary"><i class="mdi mdi-view-compact-outline"></i></a>
                                                    <?php } elseif($log['purchase_id']!="0"){ ?>
                                                        <a href="<?php echo base_url('purchase_view/'.$log['purchase_id']);?>" class="btn btn-primary"><i class="mdi mdi-view-compact-outline"></i></a>
                                                    <?php } elseif($log['purchase_order_id']!="0"){ ?>
                                                        <a href="<?php echo base_url('purchase_order_view/'.$log['purchase_order_id']);?>" class="btn btn-primary"><i class="mdi mdi-view-compact-outline"></i></a>
                                                    <?php } elseif($log['purchase_return_id']!="0"){ ?>
                                                        <a href="<?php echo base_url('purchase_return_view/'.$log['purchase_return_id']);?>" class="btn btn-primary"><i class="mdi mdi-view-compact-outline"></i></a>
                                                    <?php } elseif($log['expense_id']!="0"){ ?>
                                                        <a href="<?php echo base_url('expense_view/'.$log['expense_id']);?>" class="btn btn-primary"><i class="mdi mdi-view-compact-outline"></i></a>
                                                    <?php } elseif($log['stock_id']!="0"){ ?>
                                                        <a href="<?php echo base_url('stock_list');?>" class="btn btn-primary"><i class="mdi mdi-view-compact-outline"></i></a>
                                                    <?php } elseif($log['stock_inward_id']!="0"){ ?>
                                                        <a href="<?php echo base_url('stock_inward_list');?>" class="btn btn-primary"><i class="mdi mdi-view-compact-outline"></i></a>
                                                    <?php } elseif($log['stock_adjustment_id']!="0"){ ?>
                                                        <a href="<?php echo base_url('stock_adjustment_list');?>" class="btn btn-primary"><i class="mdi mdi-view-compact-outline"></i></a>
                                                    <?php } elseif($log['purchase_payment_id']!="0"){ ?>
                                                        <a href="<?php echo base_url('purchase_payments_bill_details/'.$log['purchase_payment_id']);?>" class="btn btn-primary"><i class="mdi mdi-view-compact-outline"></i></a>
                                                    <?php } elseif($log['estimate_payment_id']!="0"){ ?>
                                                        <a href="<?php echo base_url('estimate_payments_bill_details/'.$log['estimate_payment_id']);?>" class="btn btn-primary"><i class="mdi mdi-view-compact-outline"></i></a>
                                                    <?php } elseif($log['invoice_payment_id']!="0"){ ?>
                                                        <a href="<?php echo base_url('invoice_payments_bill_details/'.$log['invoice_payment_id']);?>" class="btn btn-primary"><i class="mdi mdi-view-compact-outline"></i></a>
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