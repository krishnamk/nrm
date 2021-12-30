<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">BUYERS PO EXCEL VIEW</h4>
                        <div class="page-title-right">
                            <div class="d-flex align-items-center justify-content-end">
                                <div class="col-12 ">
                                    <a href="<?php echo base_url('buyers_po_excel_print/'.$buyers_po_details['buyers_po_id']);?>" style="margin-right: 5px;" class="btn btn-primary float-right"><i class="fa fa-print"></i>&nbsp;Print</a>
                                    <a href="<?php echo base_url('buyers_po_excel_list');?>" style="margin-right: 5px;" class="btn btn-warning float-right"><i class="fa fas fa-backward"></i>&nbsp;BACK</a>
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
                            <div class="row">
                                <div class="col-sm-6 mt-3 text-sm-left">
                                    <address>
                                        <strong>TO :</strong><br>
                                        <?php echo $customer_details['customer_name'];?><br>
                                        <?php echo $customer_details['customer_address1'];?><br>
                                        <?php echo $customer_details['customer_address2'];?><br>
                                        <?php echo $customer_details['customer_city'];?><br>
                                        <?php echo $customer_details['state_name'].' - '.$customer_details['customer_pincode'];?><br>
                                        <?php if($customer_details['customer_phone']){ echo 'PHONE - '.$customer_details['customer_phone']; } ?>
                                    </address>
                                </div>
                                <div class="col-sm-6 mt-3 text-sm-right">
                                    <address>
                                        <strong>DATE :</strong><br>
                                        <?php echo date('d-m-Y',strtotime($buyers_po_details['date'])); ?><br><br>
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
                                            <th>VENDOR SKU</th>
                                            <th>SIZE</th>
                                            <th>SKU</th>
                                            <th>PRODUCT NAME</th>
                                            <th>COST</th>
                                            <th>QUANTITY</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if($relations){
                                            $total_quantity = 0;
                                            foreach ($relations as $key => $relation) {
                                                $total_quantity = $total_quantity + $relation['quantity'];
                                                ?>
                                                <tr>
                                                    <td style="width: 10px"><strong><?php echo next_number($key); ?></strong></td>
                                                    <td><label><?php echo $relation['product_stylecode']; ?></label></td>
                                                    <td><label><?php echo $relation['size_name']; ?></label></td>
                                                    <td><label><?php echo $relation['product_itemcode']; ?></label></td>
                                                    <td><label><?php echo $relation['product_name']; ?></label></td>
                                                    <td><label><?php echo $relation['product_purchase_price'];; ?></label></td>
                                                    <td><label><?php echo $relation['quantity'];; ?></label></td>
                                                </tr>
                                            <?php } ?>
                                            <tr>
                                                <td colspan='6'><strong class="float-right">TOTAL QTY</strong></td>
                                                <td><label><?php echo $total_quantity; ?></label></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
</div>