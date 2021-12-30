<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">INVOICE VIEW</h4>
                        <div class="page-title-right">
                            <div class="d-flex align-items-center justify-content-end">
                                <div class="col-12 ">
                                    <a href="<?php echo base_url('invoice_list');?>" style="margin-right: 5px;" class="btn btn-primary float-right"><i class="fa fas fa-backward"></i>&nbsp;BACK</a>
                                    <a href="<?php echo base_url('invoice_print/'.$invoice_details['invoice_id']);?>" style="margin-right: 5px;" class="btn btn-warning float-right"><i class="fa fa-print"></i>&nbsp;Print</a>
                                    <a href="<?php echo base_url('invoice_download/'.$invoice_details['invoice_id']);?>" style="margin-right: 5px;" class="btn btn-dark float-right"><i class="fa fa-download"></i>&nbsp;Download</a>
                                    <a href="<?php echo base_url('invoice');?>" style="margin-right: 5px;" class="btn btn-success float-right"><i class="bx bxs-comment-add font-size-16 align-middle mr-2"></i>&nbsp;New invoice</a>
                                    <a href="<?php echo base_url('invoice_payment_list');?>" style="margin-right: 5px;" class="btn btn-info float-right"><i class="bx bxs-comment-add font-size-16 align-middle mr-2"></i>&nbsp;Add Payment</a>
                                    <?php if($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_dc_generate'),'settings_value')== 1) { ?> 
                                        <?php if($invoice_details['invoice_cancel']=="0") { ?> 
                                            <?php if($invoice_details['status']!="2") { ?> 
                                                <a href="<?php echo base_url('invoice_generate_dc/'.$invoice_details['invoice_id']);?>" style="margin-right: 5px;" class="btn btn-danger float-right"><i class="bx bxs-truck font-size-16 align-middle mr-2"></i>&nbsp;Generate DC</a>
                                            <?php } elseif($invoice_details['status']=="2"){ ?> 
                                                <?php $dc_id = $this->common->get_particular('tbl_dcs',array('invoice_id' => $invoice_details['invoice_id']),'dc_id'); ?>
                                                <a href="<?php echo base_url('dc_view/'.$dc_id);?>" style="margin-right: 5px;" class="btn btn-danger float-right"><i class="bx bxs-truck font-size-16 align-middle mr-2"></i>&nbsp;DC View</a>
                                            <?php } ?> 
                                        <?php } ?>
                                    <?php } ?>
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
                                <div class="col-sm-6 mt-3">
                                    <address>
                                        <strong>INVOICE NUMBER :</strong><br>
                                        <?php echo $invoice_details['invoice_number']; ?>
                                    </address>
                                </div>
                                <div class="col-sm-6 mt-3 text-sm-right">
                                    <address>
                                        <strong>INVOICE DATE :</strong><br>
                                        <?php echo date('d-m-Y',strtotime($invoice_details['invoice_date'])); ?><br><br>
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
                                        <?php if($company_details['company_phone']){ echo 'PHONE - '.$company_details['company_contact_no']; } ?><br>
                                        <strong>Reverse Charge (Y/N):</strong><br>
                                        <?php echo $invoice_details['reverse_charge']; ?>
                                        <br>
                                        <strong>Date of Supply :</strong><br>
                                        <?php echo date('d-m-Y',strtotime($invoice_details['date_of_supply'])); ?>
                                        <br>
                                    </address>
                                </div>
                                <div class="col-sm-6 mt-3 text-sm-right">
                                    <address>
                                        <strong>TO :</strong><br>
                                        <?php echo $customer_details['customer_name'];?><br>
                                        <?php echo $customer_details['customer_address1'];?><br>
                                        <?php echo $customer_details['customer_address2'];?><br>
                                        <?php echo $customer_details['customer_city'];?><br>
                                        <?php echo $customer_details['state_name'].' - '.$customer_details['customer_pincode'];?><br>
                                        <?php if($customer_details['customer_phone']){ echo 'PHONE - '.$customer_details['customer_phone']; } ?><br>
                                        <strong>Total bundle :</strong><br>
                                        <?php echo $invoice_details['total_bundle']; ?>
                                        <br>
                                        <strong>Place of Supply :</strong><br>
                                        <?php echo $invoice_details['place_of_supply']; ?>
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
                                            <th>DC.NO</th>
                                            <th>PRODUCT NAME</th>
                                            <th>PRODUCT DESCRIPTION</th>
                                            <?php if($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')== 1) { ?>
                                                <th>BRAND NAME</th>
                                            <?php } ?>
                                            <th>QUANTITY</th>
                                            <th>RATE</th>
                                            <?php if(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_discount'),'invoice_settings_value')!= 1)) { ?>
                                                <th>AMOUNT</th>
                                                <th>TAX %</th>
                                                <th>TAX TOTAL</th>
                                                <th>TOTAL</th>
                                            <?php } elseif(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')!= 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_productwise_discount'),'invoice_settings_value')== 1)){ ?>
                                                <th>AMOUNT</th>
                                                <th>DISCOUNT %</th>
                                                <th>DISCOUNT AMT</th>
                                                <th>TOTAL</th>
                                            <?php } elseif(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_discount'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_productwise_discount'),'invoice_settings_value')== 1)){ ?>
                                                <th>AMOUNT</th>
                                                <th>DISCOUNT %</th>
                                                <th>NET TOTAL</th>
                                                <th>TAX %</th>
                                                <th>TAX TOTAL</th>
                                                <th>TOTAL</th>
                                            <?php } elseif(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_discount'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_overall_discount'),'invoice_settings_value')== 1)){ ?>
                                                <th>AMOUNT</th>
                                                <th>DISCOUNT %</th>
                                                <th>NET TOTAL</th>
                                                <th>TAX %</th>
                                                <th>TAX TOTAL</th>
                                                <th>TOTAL</th>
                                            <?php }else { ?>
                                                <th class="text-center">TOTAL</th> 
                                            <?php } ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if($relations){
                                            $total_quantity = 0;
                                            $total_tax = 0;
                                            $total = 0;
                                            $total_amount = 0;
                                            $net_total = 0;
                                            $pre_total = 0;
                                            $final_total = 0;
                                            $discount_amt = 0;
                                            $discount_total = 0;
                                            $total_price = 0;
                                            $final_amount = 0;
                                            foreach ($relations as $key => $relation) {
                                                $total_quantity = $total_quantity + $relation['quantity'];
                                                $amount = $relation['rate']*$relation['quantity'];
                                                $total_tax = $total_tax + $relation['tax_total'];
                                                $total_amount = $total_amount + $amount;
                                                if($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')== 1){
                                                    $total = $total_amount + $total_tax;  
                                                }
                                                if(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_productwise_discount'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')!= 1)){
                                                    $discount_amt = $amount - $relation['pre_total'];
                                                    $discount_total = $discount_total + $discount_amt; 
                                                    $total_price = $total_price + ($discount_amt+$amount);  
                                                }
                                                if(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_overall_discount'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')!= 1)){
                                                    $discount_amt = $amount - $relation['pre_total'];
                                                    $discount_total = $discount_total + $discount_amt; 
                                                    $total_price = $total_price + ($discount_amt+$amount);  
                                                }
                                                if(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_discount'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_productwise_discount'),'invoice_settings_value')== 1)){ 
                                                    $net_total = $net_total + $relation['pre_total']; 
                                                    $pre_total = $relation['pre_total'] + $relation['tax_total'];
                                                    $final_total = $final_total + $relation['total'];
                                                }
                                                if(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_discount'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_overall_discount'),'invoice_settings_value')== 1)){ 
                                                    $net_total = $net_total + $relation['pre_total']; 
                                                    $pre_total = $relation['pre_total'] + $relation['tax_total'];
                                                    $final_total = $final_total + $relation['total'];
                                                }
                                                ?>
                                                <tr>
                                                    <td style="width: 10px"><strong><?php echo $dc_details['dc_number']; ?></strong></td>
                                                    <td><label><?php echo $relation['product_name']; ?></label></td>
                                                    <td><label><?php $product_description = $this->common->get_particular('mst_products',array('product_id' => $relation['product_id']),'product_description'); echo 
                                                    $product_description; ?></label></td>
                                                    <?php if($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')== 1) { ?>
                                                        <td><label><?php echo $relation['brand_name']; ?></label></td>
                                                    <?php } ?>
                                                    <td><label><?php echo $relation['quantity']; ?></label></td>
                                                    <td><label>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($relation['rate']); ?></label></td>
                                                    <?php if(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_discount'),'invoice_settings_value')!= 1)) { ?>
                                                        <td><label>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia(($relation['quantity']*$relation['rate'])); ?></label></td>
                                                        <td><label><?php echo $relation['tax_percent']; ?> % </label></td>
                                                        <td><label>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($relation['tax_total']); ?></label></td>
                                                        <td class="text-right"><label>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($relation['total']); ?></label></td>
                                                    <?php } elseif(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')!= 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_productwise_discount'),'invoice_settings_value')== 1)){ ?>
                                                        <td><label>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia(($relation['quantity']*$relation['rate'])); ?></label></td>
                                                        <td><label><?php echo $relation['discount_percentage']; ?> % </label></td>
                                                        <td><label>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($discount_amt); ?></label></td>
                                                        <td class="text-right"><label>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($discount_amt+$amount); ?></label></td>
                                                    <?php } elseif(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')!= 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_overall_discount'),'invoice_settings_value')== 1)){ ?>
                                                        <td><label>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia(($relation['quantity']*$relation['rate'])); ?></label></td>
                                                        <td><label><?php echo $relation['discount_percentage']; ?> % </label></td>
                                                        <td><label>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($discount_amt); ?></label></td>
                                                        <td class="text-right"><label>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($discount_amt+$amount); ?></label></td>
                                                    <?php } elseif(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_discount'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_productwise_discount'),'invoice_settings_value')== 1)){ ?>
                                                        <td><label>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia(($relation['quantity']*$relation['rate'])); ?></label></td>
                                                        <td><label><?php echo $relation['discount_percentage']; ?> % </label></td>
                                                        <td><label>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($relation['pre_total']); ?></label></td>
                                                        <td><label><?php echo $relation['tax_percent']; ?> % </label></td>
                                                        <td><label>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($relation['tax_total']); ?></label></td>
                                                        <td class="text-right"><label>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($pre_total); ?></label></td>
                                                    <?php } elseif(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_discount'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_overall_discount'),'invoice_settings_value')== 1)){ ?>
                                                        <td><label>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia(($relation['quantity']*$relation['rate'])); ?></label></td>
                                                        <td><label><?php echo $relation['discount_percentage']; ?> % </label></td>
                                                        <td><label>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($relation['pre_total']); ?></label></td>
                                                        <td><label><?php echo $relation['tax_percent']; ?> % </label></td>
                                                        <td><label>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($relation['tax_total']); ?></label></td>
                                                        <td class="text-right"><label>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($pre_total); ?></label></td>
                                                    <?php } else { ?>
                                                        <td class="text-right"><label>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia(($relation['rate']*$relation['quantity'])); ?></label></td>
                                                    <?php } ?>
                                                </tr>
                                            <?php } ?>
                                            <tr>
                                                <td colspan='<?php if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')== 1)){ ?>4
                                                    <?php } else{ ?>3<?php } ?>'><strong class="float-right">TOTAL</strong></td>
                                                    <?php if(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_discount'),'invoice_settings_value')!= 1)) { ?>
                                                        <td><strong><?php echo $total_quantity;?></strong></td>
                                                        <td></td>
                                                        <td><label><strong>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($total_amount); ?></strong></label></td>
                                                        <td></td>
                                                        <td><label><strong>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($total_tax); ?></strong></label></td>
                                                        <td class="text-right"><label><strong>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($total); ?></strong></label></td>
                                                    <?php } elseif(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')!= 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_productwise_discount'),'invoice_settings_value')== 1)){ ?>
                                                        <td><strong><?php echo $total_quantity;?></strong></td>
                                                        <td></td>
                                                        <td><label><strong>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($total_amount); ?></strong></label></td>
                                                        <td></td>
                                                        <td><label><strong>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($discount_total); ?></strong></label></td>
                                                        <td class="text-right"><label><strong>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($total_price); ?></strong></label></td>
                                                    <?php } elseif(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')!= 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_overall_discount'),'invoice_settings_value')== 1)){ ?>
                                                        <td><strong><?php echo $total_quantity;?></strong></td>
                                                        <td></td>
                                                        <td><label><strong>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($total_amount); ?></strong></label></td>
                                                        <td></td>
                                                        <td><label><strong>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($discount_total); ?></strong></label></td>
                                                        <td class="text-right"><label><strong>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($total_price); ?></strong></label></td>
                                                    <?php } elseif(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_discount'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_productwise_discount'),'invoice_settings_value')== 1)){ ?>
                                                        <td><strong><?php echo $total_quantity;?></strong></td>
                                                        <td></td>
                                                        <td><label><strong>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($total_amount); ?></strong></label></td>
                                                        <td></td>
                                                        <td><label><strong>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($net_total); ?></strong></label></td>
                                                        <td></td>
                                                        <td><label><strong>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($total_tax); ?></strong></label></td>
                                                        <td class="text-right"><label><strong>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($final_total); ?></strong></label></td>
                                                    <?php } elseif(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_discount'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_overall_discount'),'invoice_settings_value')== 1)){ ?>
                                                        <td><strong><?php echo $total_quantity;?></strong></td>
                                                        <td></td>
                                                        <td><label><strong>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($total_amount); ?></strong></label></td>
                                                        <td></td>
                                                        <td><label><strong>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($net_total); ?></strong></label></td>
                                                        <td></td>
                                                        <td><label><strong>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($total_tax); ?></strong></label></td>
                                                        <td class="text-right"><label><strong>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($final_total); ?></strong></label></td>
                                                    <?php }else { ?>
                                                        <td><strong><?php echo $total_quantity;?></strong></td>
                                                        <td></td>
                                                        <td class="text-right"><label><strong>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($total_amount); ?></strong></label></td>
                                                    <?php } ?>
                                                </tr>
                                                <?php if(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_discount'),'invoice_settings_value')!= 1)) { 
                                                    $final_amount = $final_amount + $total; ?>
                                                <?php } elseif(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')!= 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_productwise_discount'),'invoice_settings_value')== 1)){ 
                                                    $final_amount = $final_amount + $total_price; ?>
                                                <?php } elseif(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')!= 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_overall_discount'),'invoice_settings_value')== 1)){ 
                                                    $final_amount = $final_amount + $total_price; ?>
                                                <?php } elseif(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_discount'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_productwise_discount'),'invoice_settings_value')== 1)){ 
                                                    $final_amount = $final_amount + $final_total; ?>
                                                <?php } elseif(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_discount'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_overall_discount'),'invoice_settings_value')== 1)){ 
                                                    $final_amount = $final_amount + $final_total; ?>
                                                <?php }else { 
                                                    $final_amount = $final_amount + $total_amount; ?>
                                                <?php } ?>
                                                <?php if($invoice_details['invoice_cash_discount']!="0") {  
                                                    $final_amount = $final_amount-$invoice_details['invoice_cash_discount']; ?>
                                                    <tr>
                                                        <td colspan="<?php if(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_discount'),'invoice_settings_value')!= 1)) { echo "8"; } elseif(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')!= 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_discount'),'invoice_settings_value')!= 1)) { echo "5"; }elseif(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')!= 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_productwise_discount'),'invoice_settings_value')== 1)){ echo "8"; }elseif(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')!= 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_overall_discount'),'invoice_settings_value')== 1)){ echo "8"; }elseif(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_discount'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_productwise_discount'),'invoice_settings_value')== 1)){ echo "10"; }elseif(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_discount'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_overall_discount'),'invoice_settings_value')== 1)){ echo "10"; }else { echo "6"; }?>" align="right"><b>CASH DISCOUNT</b></td>
                                                        <td class="text-right"><?php echo digit_maintainer($invoice_details['invoice_cash_discount']); ?></td>
                                                    </tr>
                                                <?php } ?>
                                                <tr>
                                                </tr>
                                                <?php if(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')== 1)) { ?>
                                                    <?php if($taxs){  ?>
                                                        <tr>
                                                            <td></td>
                                                            <td align="center"><strong>5%</strong></td>
                                                            <td align="center"><strong>12%</strong></td>
                                                            <td align="center"><strong>18%</strong></td>
                                                            <td align="center"><strong>28%</strong></td>

                                                        </tr>
                                                        <tr>
                                                            <td  align="center"><label><strong>CGST :</strong> </label>
                                                            </td>
                                                            <td align="center">
                                                                <?php if(in_array(5,array_column($taxs, 'tax_percent'))){
                                                                    foreach ($taxs as $key => $tax) {
                                                                        if($tax['tax_percent'] == 5){
                                                                            if($company_details['company_state'] == $customer_details['customer_state'] ){
                                                                                echo MoneyFormatIndia($tax['tax_total']/2);
                                                                            }else{
                                                                                echo 'Nil';
                                                                            }
                                                                        }
                                                                    }
                                                                }else{
                                                                    echo 'Nil';
                                                                }?></td>
                                                                <td align="center">
                                                                    <?php if(in_array(12,array_column($taxs, 'tax_percent'))){
                                                                        foreach ($taxs as $key => $tax) {
                                                                            if($tax['tax_percent'] == 12){
                                                                                if($company_details['company_state'] == $customer_details['customer_state'] ){
                                                                                    echo MoneyFormatIndia($tax['tax_total']/2);
                                                                                }else{
                                                                                    echo 'Nil';
                                                                                }
                                                                            }
                                                                        }
                                                                    }else{
                                                                        echo 'Nil';
                                                                    }?>
                                                                </td>
                                                                <td align="center">
                                                                    <?php if(in_array(18,array_column($taxs, 'tax_percent'))){
                                                                        foreach ($taxs as $key => $tax) {
                                                                            if($tax['tax_percent'] == 18){
                                                                                if($company_details['company_state'] == $customer_details['customer_state'] ){
                                                                                    echo MoneyFormatIndia($tax['tax_total']/2);
                                                                                }else{
                                                                                    echo 'Nil';
                                                                                }
                                                                            }
                                                                        }
                                                                    }else{
                                                                        echo 'Nil';
                                                                    }?>
                                                                </td>
                                                                <td align="center">
                                                                    <?php if(in_array(28,array_column($taxs, 'tax_percent'))){
                                                                        foreach ($taxs as $key => $tax) {
                                                                            if($tax['tax_percent'] == 28){
                                                                                if($company_details['company_state'] == $customer_details['customer_state'] ){
                                                                                    echo MoneyFormatIndia($tax['tax_total']/2);
                                                                                }else{
                                                                                    echo 'Nil';
                                                                                }
                                                                            }
                                                                        }
                                                                    }else{
                                                                        echo 'Nil';
                                                                    }?>
                                                                </td>
                                                                <?php if($invoice_details['invoice_other_expenses']!="0") {  
                                                                    $final_amount = $final_amount+$invoice_details['invoice_other_expenses']; ?>
                                                                    <td colspan="<?php if(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_discount'),'invoice_settings_value')!= 1)) { echo "3"; } elseif(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')!= 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_discount'),'invoice_settings_value')!= 1)) { echo "0"; } elseif(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')!= 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_productwise_discount'),'invoice_settings_value')== 1)){ echo "3"; }elseif(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')!= 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_overall_discount'),'invoice_settings_value')== 1)){ echo "3"; }elseif(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_discount'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_productwise_discount'),'invoice_settings_value')== 1)){ echo "5"; }elseif(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_discount'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_overall_discount'),'invoice_settings_value')== 1)){ echo "5"; }else { echo "1"; }?>" align="right"><b>OTHER EXPENSES</b></td>
                                                                    <td class="text-right"><?php echo digit_maintainer($invoice_details['invoice_other_expenses']); ?></td>
                                                                <?php } ?>
                                                            </tr>
                                                            <tr>
                                                                <td  align="center"><label><strong>SGST :</strong> </label>
                                                                </td>
                                                                <td align="center">
                                                                    <?php if(in_array(5,array_column($taxs, 'tax_percent'))){
                                                                        foreach ($taxs as $key => $tax) {
                                                                            if($tax['tax_percent'] == 5){
                                                                                if($company_details['company_state'] == $customer_details['customer_state'] ){
                                                                                    echo MoneyFormatIndia($tax['tax_total']/2);
                                                                                }else{
                                                                                    echo 'Nil';
                                                                                }
                                                                            }
                                                                        }
                                                                    }else{
                                                                        echo 'Nil';
                                                                    }?>
                                                                </td>
                                                                <td align="center">
                                                                    <?php if(in_array(12,array_column($taxs, 'tax_percent'))){
                                                                        foreach ($taxs as $key => $tax) {
                                                                            if($tax['tax_percent'] == 12){
                                                                                if($company_details['company_state'] == $customer_details['customer_state'] ){
                                                                                    echo MoneyFormatIndia($tax['tax_total']/2);
                                                                                }else{
                                                                                    echo 'Nil';
                                                                                }
                                                                            }
                                                                        }
                                                                    }else{
                                                                        echo 'Nil';
                                                                    }?>
                                                                </td>
                                                                <td align="center">
                                                                    <?php if(in_array(18,array_column($taxs, 'tax_percent'))){
                                                                        foreach ($taxs as $key => $tax) {
                                                                            if($tax['tax_percent'] == 18){
                                                                                if($company_details['company_state'] == $customer_details['customer_state'] ){
                                                                                    echo MoneyFormatIndia($tax['tax_total']/2);
                                                                                }else{
                                                                                    echo 'Nil';
                                                                                }
                                                                            }
                                                                        }
                                                                    }else{
                                                                        echo 'Nil';
                                                                    }?>
                                                                </td>
                                                                <td align="center">
                                                                    <?php if(in_array(28,array_column($taxs, 'tax_percent'))){
                                                                        foreach ($taxs as $key => $tax) {
                                                                            if($tax['tax_percent'] == 28){
                                                                                if($company_details['company_state'] == $customer_details['customer_state'] ){
                                                                                    echo MoneyFormatIndia($tax['tax_total']/2);
                                                                                }else{
                                                                                    echo 'Nil';
                                                                                }
                                                                            }
                                                                        }
                                                                    }else{
                                                                        echo 'Nil';
                                                                    }?>
                                                                </td>
                                                                <?php if($invoice_details['invoice_transportaion_charges']!="0") {  
                                                                    $final_amount = $final_amount+$invoice_details['invoice_transportaion_charges']; ?>
                                                                    <td colspan="<?php if(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_discount'),'invoice_settings_value')!= 1)) { echo "3"; } elseif(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')!= 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_discount'),'invoice_settings_value')!= 1)) { echo "0"; } elseif(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')!= 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_productwise_discount'),'invoice_settings_value')== 1)){ echo "3"; }elseif(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')!= 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_overall_discount'),'invoice_settings_value')== 1)){ echo "3"; }elseif(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_discount'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_productwise_discount'),'invoice_settings_value')== 1)){ echo "5"; }elseif(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_discount'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_overall_discount'),'invoice_settings_value')== 1)){ echo "6"; }else { echo "1"; }?>" align="right"><b>TRANPORTATION CHARGES</b></td>
                                                                    <td class="text-right" ><?php echo digit_maintainer($invoice_details['invoice_transportaion_charges']); ?></td>
                                                                <?php } ?>
                                                            </tr>
                                                            <tr>
                                                                <td  align="center"><label><strong>IGST :</strong></label>
                                                                </td>
                                                                <td align="center">
                                                                    <?php if(in_array(5,array_column($taxs, 'tax_percent'))){
                                                                        foreach ($taxs as $key => $tax) {
                                                                            if($tax['tax_percent'] == 5){
                                                                                if($company_details['company_state'] != $customer_details['customer_state'] ){
                                                                                    echo MoneyFormatIndia($tax['tax_total']);
                                                                                }else{
                                                                                    echo 'Nil';
                                                                                }
                                                                            }
                                                                        }
                                                                    }else{
                                                                        echo 'Nil';
                                                                    }?>
                                                                </td>
                                                                <td align="center">
                                                                    <?php if(in_array(12,array_column($taxs, 'tax_percent'))){
                                                                        foreach ($taxs as $key => $tax) {
                                                                            if($tax['tax_percent'] == 12){
                                                                                if($company_details['company_state'] != $customer_details['customer_state'] ){
                                                                                    echo MoneyFormatIndia($tax['tax_total']);
                                                                                }else{
                                                                                    echo 'Nil';
                                                                                }
                                                                            }
                                                                        }
                                                                    }else{
                                                                        echo 'Nil';
                                                                    }?>
                                                                </td>
                                                                <td align="center">
                                                                    <?php if(in_array(18,array_column($taxs, 'tax_percent'))){
                                                                        foreach ($taxs as $key => $tax) {
                                                                            if($tax['tax_percent'] == 18){
                                                                                if($company_details['company_state'] != $customer_details['customer_state'] ){
                                                                                    echo MoneyFormatIndia($tax['tax_total']);
                                                                                }else{
                                                                                    echo 'Nil';
                                                                                }
                                                                            }
                                                                        }
                                                                    }else{
                                                                        echo 'Nil';
                                                                    }?>
                                                                </td>
                                                                <td align="center">
                                                                    <?php if(in_array(28,array_column($taxs, 'tax_percent'))){
                                                                        foreach ($taxs as $key => $tax) {
                                                                            if($tax['tax_percent'] == 28){
                                                                                if($company_details['company_state'] != $customer_details['customer_state'] ){
                                                                                    echo MoneyFormatIndia($tax['tax_total']);
                                                                                }else{
                                                                                    echo 'Nil';
                                                                                }
                                                                            }
                                                                        }
                                                                    }else{
                                                                        echo 'Nil';
                                                                    }?>
                                                                </td>
                                                                <?php if($invoice_details['invoice_loading_charges']!="0") {  
                                                                    $final_amount = $final_amount+$invoice_details['invoice_loading_charges']; ?>
                                                                    <td colspan="<?php if(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_discount'),'invoice_settings_value')!= 1)) { echo "3"; } elseif(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')!= 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_discount'),'invoice_settings_value')!= 1)) { echo "0"; } elseif(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')!= 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_productwise_discount'),'invoice_settings_value')== 1)){ echo "3"; }elseif(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')!= 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_overall_discount'),'invoice_settings_value')== 1)){ echo "3"; }elseif(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_discount'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_productwise_discount'),'invoice_settings_value')== 1)){ echo "5"; }elseif(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_discount'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_overall_discount'),'invoice_settings_value')== 1)){ echo "5"; }else { echo "1"; }?>" align="right"><b><b>LOADING/UNLOADING CHARGES</b></td>
                                                                    <td class="text-right" ><?php echo digit_maintainer($invoice_details['invoice_loading_charges']); ?></td>
                                                                <?php } ?>
                                                            </tr>
                                                        <?php } ?> 
                                                    <?php }else{ ?>
                                                        <tr>
                                                            <?php if($invoice_details['invoice_other_expenses']!="0") {  
                                                                $final_amount = $final_amount+$invoice_details['invoice_other_expenses']; ?>
                                                                <td colspan="<?php if(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_discount'),'invoice_settings_value')!= 1)) { echo "8"; } elseif(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')!= 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_discount'),'invoice_settings_value')!= 1)) { echo "5"; }elseif(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')!= 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_productwise_discount'),'invoice_settings_value')== 1)){ echo "8"; }elseif(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')!= 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_overall_discount'),'invoice_settings_value')== 1)){ echo "8"; }elseif(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_discount'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_productwise_discount'),'invoice_settings_value')== 1)){ echo "10"; }elseif(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_discount'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_overall_discount'),'invoice_settings_value')== 1)){ echo "10"; }else { echo "6"; }?>" align="right"><b>OTHER EXPENSES</b></td>
                                                                <td class="text-right"><?php echo digit_maintainer($invoice_details['invoice_other_expenses']); ?></td>
                                                            <?php } ?>

                                                        </tr>
                                                        <tr>
                                                            <?php if($invoice_details['invoice_transportaion_charges']!="0") {  
                                                                $final_amount = $final_amount+$invoice_details['invoice_transportaion_charges']; ?>
                                                                <td colspan="<?php if(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_discount'),'invoice_settings_value')!= 1)) { echo "8"; } elseif(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')!= 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_discount'),'invoice_settings_value')!= 1)) { echo "5"; }elseif(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')!= 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_productwise_discount'),'invoice_settings_value')== 1)){ echo "8"; }elseif(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')!= 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_overall_discount'),'invoice_settings_value')== 1)){ echo "8"; }elseif(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_discount'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_productwise_discount'),'invoice_settings_value')== 1)){ echo "10"; }elseif(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_discount'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_overall_discount'),'invoice_settings_value')== 1)){ echo "10"; }else { echo "6"; }?>" align="right"><b>TRANPORTATION CHARGES</b></td>
                                                                <td class="text-right" ><?php echo digit_maintainer($invoice_details['invoice_transportaion_charges']); ?></td>
                                                            <?php } ?>

                                                        </tr>
                                                        <tr>
                                                            <?php if($invoice_details['invoice_loading_charges']!="0") {  
                                                                $final_amount = $final_amount+$invoice_details['invoice_loading_charges']; ?>
                                                                <td colspan="<?php if(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_discount'),'invoice_settings_value')!= 1)) { echo "8"; } elseif(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')!= 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_discount'),'invoice_settings_value')!= 1)) { echo "5"; }elseif(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')!= 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_productwise_discount'),'invoice_settings_value')== 1)){ echo "8"; }elseif(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')!= 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_overall_discount'),'invoice_settings_value')== 1)){ echo "8"; }elseif(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_discount'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_productwise_discount'),'invoice_settings_value')== 1)){ echo "10"; }elseif(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_discount'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_overall_discount'),'invoice_settings_value')== 1)){ echo "10"; }else { echo "6"; }?>" align="right"><b><b>LOADING/UNLOADING CHARGES</b></td>
                                                                <td class="text-right" ><?php echo digit_maintainer($invoice_details['invoice_loading_charges']); ?></td>
                                                            <?php } ?>

                                                        </tr>
                                                    <?php } ?>
                                                </tr>
                                            <?php } ?>
                                            <tr>
                                                <td colspan="<?php if(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_discount'),'invoice_settings_value')!= 1)) { echo "8"; }elseif(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')!= 1)){echo "5";} elseif(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')!= 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_discount'),'invoice_settings_value')!= 1)) { echo "5"; } elseif(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')!= 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_productwise_discount'),'invoice_settings_value')== 1)){ echo "8"; }elseif(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')!= 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_overall_discount'),'invoice_settings_value')== 1)){ echo "8"; }elseif(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_discount'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_productwise_discount'),'invoice_settings_value')== 1)){ echo "10"; }elseif(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_discount'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_overall_discount'),'invoice_settings_value')== 1)){ echo "11"; }else { echo "6"; }?>" align="right"><b><b> TOTAL </b></td>
                                                <td class="text-right" style="text-align:center;">&#8377;&nbsp;&nbsp;&nbsp;<strong><?php echo MoneyFormatIndia($final_amount); ?></strong></td>
                                            </tr>
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