<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">PURCHASE VIEW</h4>
                        <div class="page-title-right">
                            <div class="d-flex align-items-center justify-content-end">
                                <div class="col-12 ">
                                   <?php $purchase_payments_id = $this->common->get_particular('tbl_purchase_payments',array('purchase_id' => $purchase_details['purchase_id']),'purchase_payments_id');?>
                                   <a href="<?php echo base_url('purchase_payments_bill_details/'.$purchase_payments_id);?>" style="margin-right: 5px;" class="btn btn-success float-right"><i class="fa fas fa-rupee-sign"></i>&nbsp;Add Payment</a>
                                   <a href="<?php echo base_url('purchase_print/'.$purchase_details['purchase_id']);?>" style="margin-right: 5px;" class="btn btn-dark float-right"><i class="fa fa-print"></i>&nbsp;Print</a>
                                   <a href="<?php echo base_url('purchase_download/'.$purchase_details['purchase_id']);?>" style="margin-right: 5px;" class="btn btn-primary float-right"><i class="fa fa-download"></i>&nbsp;Download</a>
                                   <a href="<?php echo base_url('purchase');?>" style="margin-right: 5px;" class="btn btn-danger float-right"><i class="bx bxs-comment-add font-size-16 align-middle mr-2"></i>&nbsp;Add Purchase</a>
                                   <a href="<?php echo base_url('purchase_list');?>" style="margin-right: 5px;" class="btn btn-info float-right"><i class="fa fas fa-backward"></i>&nbsp;BACK</a>
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
                            <!-- <div class="card-body">
                                <div class="col-lg-12 ">
                                    <div class="col-lg-6"><h4 class="card-title">PURCHASE</h4></div>
                                </div>
                            </div>
                            <hr class="m-t-0 m-b-40"> -->
                            <div class="row">
                                <div class="col-sm-6 mt-3">
                                    <address>
                                        <strong>PURCHASE NUMBER :</strong><br>
                                        <?php echo $purchase_details['purchase_number']; ?>
                                    </address>
                                </div>
                                <div class="col-sm-6 mt-3 text-sm-right">
                                    <address>
                                        <strong>PURCHASE DATE :</strong><br>
                                        <?php echo date('d-m-Y',strtotime($purchase_details['purchase_date'])); ?><br><br>
                                    </address>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 mt-3">
                                    <address>
                                        <strong>FROM :</strong><br>
                                        <?php echo $supplier_details['supplier_name'];?><br>
                                        <?php echo $supplier_details['supplier_address1'];?><br>
                                        <?php echo $supplier_details['supplier_address2'];?><br>
                                        <?php echo $supplier_details['supplier_city'];?><br>
                                        <?php echo $supplier_details['state_name'].' - '.$supplier_details['supplier_pincode'];?><br>
                                        <?php if($supplier_details['supplier_phone']){ echo 'PHONE - '.$supplier_details['supplier_phone']; } ?>
                                    </address>
                                </div>
                                <div class="col-sm-6 mt-3 text-sm-right">
                                    <address>
                                        <strong>TO :</strong><br>
                                        <?php echo $company_details['company_name'];?><br>
                                        <?php echo $company_details['company_address1'];?><br>
                                        <?php echo $company_details['company_address2'];?><br>
                                        <?php echo $company_details['company_city'];?><br>
                                        <?php echo $company_details['state_name'].' - '.$company_details['company_pincode'];?><br>
                                        <?php if($company_details['company_phone']){ echo 'PHONE - '.$company_details['company_contact_no']; } ?>
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
                                            <!-- <?php if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')== 1)){ ?>
                                                <th>BRAND NAME</th>
                                            <?php } ?> -->
                                            <?php if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_category'),'product_settings_value')== 1)){ ?>
                                                <th>CATEGORY NAME</th>
                                            <?php } ?>
                                            <th>QUANTITY</th>
                                            <th>RATE</th>
                                            <th>AMOUNT</th>
                                            <?php if($this->common->get_particular('mst_purchase_settings',array('purchase_settings_name' => 'purchase_tax_included'),'purchase_settings_value')==1){?> 
                                                <th>TAX %</th>
                                                <th>TAX TOTAL</th>
                                                <th>TOTAL</th>   
                                            <?php } ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if($relations){
                                            $total_quantity = 0;
                                            $total_amount = 0;
                                            $total_tax = 0;
                                            $sub_total = 0;
                                            foreach ($relations as $key => $relation) {
                                                $total_quantity = $total_quantity + $relation['quantity'];
                                                $total_amount = $total_amount + $relation['total'];
                                                $sub_total = $sub_total + ($relation['quantity']*$relation['rate']);
                                                $total_tax = $total_tax + $relation['tax_total'];?>
                                                <tr>
                                                    <td style="width: 10px"><strong><?php echo next_number($key); ?></strong></td>
                                                    <td><label><?php echo $relation['product_name']; ?></label></td>
                                                    <!-- <?php if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')== 1)){ ?>
                                                        <td><label><?php echo $relation['brand_name']; ?></label></td>
                                                    <?php } ?> -->
                                                    <?php if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_category'),'product_settings_value')== 1)){ ?>
                                                        <td><label><?php echo $relation['category_name']; ?></label></td>
                                                    <?php } ?>
                                                    <td><label><?php echo $relation['quantity']; ?></label></td>
                                                    <td><label>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($relation['rate']); ?></label></td>
                                                    <td><label>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($relation['quantity']*$relation['rate']); ?></label></td>
                                                    <?php if($this->common->get_particular('mst_purchase_settings',array('purchase_settings_name' => 'purchase_tax_included'),'purchase_settings_value')==1){?> 
                                                     <td><label><?php echo $relation['tax_percent']; ?></label></td>
                                                     <td><label>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($relation['tax_total']); ?></label></td>
                                                     <td><label>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($relation['total']); ?></label></td>
                                                 <?php } ?>
                                             </tr>
                                         <?php } ?>
                                         <tr>
                                            <td colspan='<?php if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')== 1)){ ?>3<?php } else{ ?>2<?php } ?>'><strong class="float-right">TOTAL</strong></td>
                                            <td><label><?php echo $total_quantity; ?></label></td>
                                            <td></td>
                                            <td><label>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($sub_total); ?></label></td> 
                                            <?php if($this->common->get_particular('mst_purchase_settings',array('purchase_settings_name' => 'purchase_tax_included'),'purchase_settings_value')==1){?> 
                                                <td></td>
                                                <td><label>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($total_tax); ?></label></td>
                                                <td><label>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($total_amount); ?></label></td>
                                            <?php } ?>
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