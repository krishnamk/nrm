<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">PURCHASE ORDER VIEW</h4>
                        <div class="page-title-right">
                            <div class="d-flex align-items-center justify-content-end">
                                <div class="col-12 ">
                                    <a href="<?php echo base_url('purchase_order_mail/'.$purchase_order_details['purchase_order_id']);?>" style="margin-right: 5px;" class="btn btn-primary float-right"><i class="fa fas fa-mail-bulk"></i>&nbsp;Send Mail</a>
                                    <a href="<?php echo base_url('purchase_order_print/'.$purchase_order_details['purchase_order_id']);?>" style="margin-right: 5px;" class="btn btn-primary float-right"><i class="fa fa-print"></i>&nbsp;Print</a>
                                    <a href="<?php echo base_url('purchase_order_download/'.$purchase_order_details['purchase_order_id']);?>" style="margin-right: 5px;" class="btn btn-primary float-right"><i class="fa fa-download"></i>&nbsp;Download</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 message"><?php message(); ?></div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-body">
                                <div class="col-lg-12 ">
                                    <div class="col-lg-6"><h4 class="card-title">PURCHASE ORDER</h4></div>
                                </div>
                            </div>
                            <hr class="m-t-0 m-b-40">
                            <div class="row">
                                <div class="col-sm-6 mt-3">
                                    <address>
                                        <strong>PURCHASE ORDER NUMBER :</strong><br>
                                        <?php echo $purchase_order_details['purchase_order_number']; ?>
                                    </address>
                                </div>
                                <div class="col-sm-6 mt-3 text-sm-right">
                                    <address>
                                        <strong>PURCHASE ORDER DATE :</strong><br>
                                        <?php echo date('d-m-Y',strtotime($purchase_order_details['purchase_order_date'])); ?><br><br>
                                    </address>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 mt-3">
                                    <address>
                                        <strong>FROM :</strong><br>
                                        <?php echo $company_details['company_name'];?><br>
                                        <?php echo $company_details['company_address1'];?><br>
                                        <?php echo $company_details['company_address2'];?><br>
                                        <?php echo $company_details['company_city'];?><br>
                                        <?php echo $company_details['state_name'].' - '.$company_details['company_pincode'];?><br>
                                        <?php if($company_details['company_phone']){ echo 'PHONE - '.$company_details['company_contact_no']; } ?>
                                    </address>
                                </div>
                                <div class="col-sm-6 mt-3 text-sm-right">
                                    <address>
                                        <strong>TO :</strong><br>
                                        <?php echo $supplier_details['supplier_name'];?><br>
                                        <?php echo $supplier_details['supplier_address1'];?><br>
                                        <?php echo $supplier_details['supplier_address2'];?><br>
                                        <?php echo $supplier_details['supplier_city'];?><br>
                                        <?php echo $supplier_details['state_name'].' - '.$supplier_details['supplier_pincode'];?><br>
                                        <?php if($supplier_details['supplier_phone']){ echo 'PHONE - '.$supplier_details['supplier_phone']; } ?>
                                    </address>
                                </div>
                            </div>
                            <hr class="m-t-0 m-b-40">
                            <div class="py-2 mt-3">
                                <h3 class="font-size-15 font-weight-bold">PRODUCT DETAILS</h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-nowrap">
                                    <thead>
                                        <tr>
                                            <th>S.NO</th>
                                            <th>PRODUCT NAME</th>
                                            <th>BRAND</th>
                                            <th>QUANTITY</th>
                                            <th>RATE</th>
                                            <th>AMOUNT</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if($relations){
                                            $total_quantity = 0;
                                            $total_amount = 0;
                                            foreach ($relations as $key => $relation) {
                                                $total_quantity = $total_quantity + $relation['quantity'];
                                                $total_amount = $total_amount + $relation['amount']; ?>
                                                <tr>
                                                    <td style="width: 10px"><strong><?php echo next_number($key); ?></strong></td>
                                                    <td><label><?php echo $relation['product_name']; ?></label></td>
                                                    <td><label><?php echo $relation['brand_name']; ?></label></td>
                                                    <td><label><?php echo $relation['quantity']; ?></label></td>
                                                    <td><label><?php echo sprintf("%.2f",$relation['rate']); ?></label></td>
                                                    <td><label><?php echo sprintf("%.2f",$relation['amount']); ?></label></td>
                                                </tr>
                                            <?php } ?>
                                            <tr>
                                                <td colspan='3'><strong class="float-right">TOTAL</strong></td>
                                                <td><label><?php echo $total_quantity; ?></label></td>
                                                <td></td>
                                                <td><label><?php echo sprintf("%.2f",$total_amount); ?></label></td> 
                                            </tr>
                                        <?php    } ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- <div class="d-print-none">
                                <div class="float-right">
                                    <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light mr-1"><i class="fa fa-print"></i></a>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
</div>