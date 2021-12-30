<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">PURCHASE RETURN VIEW</h4>
                        <div class="page-title-right">
                            <div class="d-flex align-items-center justify-content-end">
                                <div class="col-12 ">
                                    <a href="<?php echo base_url('purchase_return_print/'.$purchase_return_details['purchase_return_id']);?>" style="margin-right: 5px;" class="btn btn-primary float-right"><i class="fa fa-print"></i>&nbsp;Print</a>
                                    <a href="<?php echo base_url('purchase_return_download/'.$purchase_return_details['purchase_return_id']);?>" style="margin-right: 5px;" class="btn btn-secondary float-right"><i class="fa fa-download"></i>&nbsp;Download</a>
                                    <a href="<?php echo base_url('purchase_return_list');?>" style="margin-right: 5px;" class="btn btn-info float-right"><i class="fa fas fa-backward"></i>&nbsp;BACK</a>
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
                                    <div class="col-lg-6"><h4 class="card-title">PURCHASE RETURN</h4></div>
                                </div>
                            </div>
                            <hr class="m-t-0 m-b-40">
                            <div class="row">
                                <div class="col-sm-6 mt-3">
                                    <address>
                                        <strong>PURCHASE RETURN NUMBER :</strong><br>
                                        <?php echo $purchase_return_details['purchase_return_number']; ?>
                                    </address>
                                </div>
                                <div class="col-sm-6 mt-3 text-sm-right">
                                    <address>
                                        <strong>PURCHASE RETURN DATE :</strong><br>
                                        <?php echo date('d-m-Y',strtotime($purchase_return_details['purchase_return_date'])); ?><br><br>
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
                                            <?php if($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')== 1) { ?>
                                                <th>BRAND</th>
                                            <?php } ?>
                                            <th>QUANTITY</th>
                                            <th>RATE</th>
                                            <th>TOTAL</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if($relations){
                                            $total_quantity = 0;
                                            $total_amount = 0;
                                            foreach ($relations as $key => $relation) {
                                                $total_quantity = $total_quantity + $relation['return_quantity'];
                                                $total_amount = $total_amount + ($relation['return_quantity']*$relation['rate']);
                                                ?>
                                                <tr>
                                                    <td style="width: 10px"><strong><?php echo next_number($key); ?></strong></td>
                                                    <td><label><?php echo $relation['product_name']; ?></label></td>
                                                    <?php if($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')== 1) { ?>
                                                        <td><label><?php echo $relation['brand_name']; ?></label></td>
                                                    <?php } ?>
                                                    <td><label><?php echo $relation['return_quantity']; ?></label></td>
                                                    <td><label>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($relation['rate']); ?></label></td>
                                                    <td><label>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($relation['rate']*$relation['return_quantity']); ?></label></td>
                                                </tr>
                                            <?php } ?>
                                            <tr>
                                                <td colspan='<?php if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')== 1)){ ?>3<?php } else{ ?>2<?php } ?>'><strong class="float-right">TOTAL QTY</strong></td>
                                                <td><label><?php echo $total_quantity; ?></label></td>
                                                <td><strong class="float-right">TOTAL</strong></td>
                                                <td><label>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($total_amount); ?></label></td>
                                            </tr>
                                        <?php    } ?>
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