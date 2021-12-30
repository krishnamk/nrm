<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">ESTIMATE VIEW</h4>
                        <div class="page-title-right">
                            <div class="d-flex align-items-center justify-content-end">
                                <div class="col-12 ">
                                    <a href="<?php echo base_url('estimate_list');?>" style="margin-right: 5px;" class="btn btn-primary float-right"><i class="fa fas fa-backward"></i>&nbsp;BACK</a>
                                    <a href="<?php echo base_url('estimate_print/'.$estimate_details['estimate_id']);?>" style="margin-right: 5px;" class="btn btn-warning float-right"><i class="fa fa-print"></i>&nbsp;Print</a>
                                    <a href="<?php echo base_url('estimate_download/'.$estimate_details['estimate_id']);?>" style="margin-right: 5px;" class="btn btn-dark float-right"><i class="fa fa-download"></i>&nbsp;Download</a>
                                    <a href="<?php echo base_url('estimate');?>" style="margin-right: 5px;" class="btn btn-success float-right"><i class="bx bxs-comment-add font-size-16 align-middle mr-2"></i>&nbsp;New estimate</a>
                                    <?php if($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_dc_generate'),'estimate_settings_value')== 1) { ?> 
                                        <?php if($estimate_details['estimate_cancel']=="0") { ?> 
                                            <?php if($estimate_details['status']!="2") { ?> 
                                                <a href="<?php echo base_url('estimate_generate_dc/'.$estimate_details['estimate_id']);?>" style="margin-right: 5px;" class="btn btn-danger float-right"><i class="bx bxs-truck font-size-16 align-middle mr-2"></i>&nbsp;Generate DC</a>
                                            <?php } elseif($estimate_details['status']=="2"){ ?> 
                                                <?php $dc_id = $this->common->get_particular('tbl_dcs',array('estimate_id' => $estimate_details['estimate_id']),'dc_id'); ?>
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
                                        <strong>ESTIMATE NUMBER :</strong><br>
                                        <?php echo $estimate_details['estimate_number']; ?>
                                    </address>
                                </div>
                                <div class="col-sm-6 mt-3 text-sm-right">
                                    <address>
                                        <strong>ESTIMATE DATE :</strong><br>
                                        <?php echo date('d-m-Y',strtotime($estimate_details['estimate_date'])); ?><br><br>
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
                                        <?php echo $customer_details['customer_name'];?><br>
                                        <?php echo $customer_details['customer_address1'];?><br>
                                        <?php echo $customer_details['customer_address2'];?><br>
                                        <?php echo $customer_details['customer_city'];?><br>
                                        <?php echo $customer_details['state_name'].' - '.$customer_details['customer_pincode'];?><br>
                                        <?php if($customer_details['customer_phone']){ echo 'PHONE - '.$customer_details['customer_phone']; } ?>
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
                                            <th>PRODUCT DESCRIPTION</th>
                                            <?php if($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')== 1) { ?>
                                                <th>BRAND NAME</th>
                                            <?php } ?>
                                            <th>QUANTITY</th>
                                            <th>RATE</th>
                                            <?php if(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_discount'),'estimate_settings_value')!= 1)) { ?>
                                                <th>AMOUNT</th>
                                                <th>TOTAL</th>
                                            <?php } elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_productwise_discount'),'estimate_settings_value')== 1)){ ?>
                                                <th>AMOUNT</th>
                                                <th>DISCOUNT %</th>
                                                <th>DISCOUNT AMT</th>
                                                <th>TOTAL</th>
                                            <?php } elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_discount'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_productwise_discount'),'estimate_settings_value')== 1)){ ?>
                                                <th>AMOUNT</th>
                                                <th>DISCOUNT %</th>
                                                <th>DISCOUNT AMT</th>
                                                <th>TOTAL</th>
                                            <?php } elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_discount'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_overall_discount'),'estimate_settings_value')== 1)){ ?>
                                                <th>AMOUNT</th>
                                                <th>DISCOUNT %</th>
                                                <th>DISCOUNT AMT</th>
                                                <th>TOTAL</th>
                                            <?php }else { ?>
                                                <th>TOTAL</th>
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
                                                $total_amount = $total_amount + $amount;
                                                if(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name'=>'estimate_productwise_discount'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)){
                                                    $discount_amt = $amount - $relation['pre_total'];
                                                    $discount_total = $discount_total + $discount_amt; 
                                                    $total_price = $total_price + ($amount-$discount_amt);  
                                                }
                                                if(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name'=>'estimate_overall_discount'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)){
                                                    $discount_amt = $amount - $relation['pre_total'];
                                                    $discount_total = $discount_total + $discount_amt; 
                                                    $total_price = $total_price + ($amount-$discount_amt);  
                                                }
                                                if(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_discount'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_productwise_discount'),'estimate_settings_value')== 1)){ 
                                                    $net_total = $net_total + $relation['pre_total']; 
                                                    $pre_total = $relation['pre_total'];
                                                    $final_total = $final_total + $relation['total'];
                                                }
                                                if(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_discount'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_overall_discount'),'estimate_settings_value')== 1)){ 
                                                    $net_total = $net_total + $relation['pre_total']; 
                                                    $pre_total = $relation['pre_total'];
                                                    $final_total = $final_total + $relation['total'];
                                                }
                                                ?>
                                                <tr>
                                                    <td style="width: 10px"><strong><?php echo $dc_details['dc_number']; ?></strong></td>
                                                    <!-- <td style="width: 10px"><strong><?php echo next_number($key); ?></strong></td> -->
                                                    <td><label><?php $product_description = $this->common->get_particular('mst_products',array('product_id' => $relation['product_id']),'product_description'); echo 
                                                    $product_description; ?></label></td>
                                                    <?php if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')== 1)){ ?>
                                                        <td><?php echo $relation['brand_name']; ?></td>
                                                    <?php } ?>
                                                    <td><label><?php echo $relation['quantity']; ?></label></td>
                                                    <td><label>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($relation['rate']); ?></label></td>
                                                    <?php if(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_discount'),'estimate_settings_value')!= 1)) { ?>
                                                        <td><label>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia(($relation['quantity']*$relation['rate'])); ?></label></td>
                                                        <td class="text-center"><label>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($relation['total']); ?></label></td>
                                                    <?php } elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_productwise_discount'),'estimate_settings_value')== 1)){ ?>
                                                        <td><label>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia(($relation['quantity']*$relation['rate'])); ?></label></td>
                                                        <td><label><?php echo $relation['discount_percentage']; ?> % </label></td>
                                                        <td><label>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($discount_amt); ?></label></td>
                                                        <td class="text-center"><label>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($amount-$discount_amt); ?></label></td>
                                                    <?php } elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_overall_discount'),'estimate_settings_value')== 1)){ ?>
                                                        <td><label>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia(($relation['quantity']*$relation['rate'])); ?></label></td>
                                                        <td><label><?php echo $relation['discount_percentage']; ?> % </label></td>
                                                        <td><label>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($discount_amt); ?></label></td>
                                                        <td class="text-center"><label>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($amount-$discount_amt); ?></label></td>
                                                    <?php } else { ?>
                                                        <td class="text-center"><label>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia(($relation['rate']*$relation['quantity'])); ?></label></td>
                                                    <?php } ?>
                                                </tr>
                                            <?php } ?>
                                            <tr>
                                                <td colspan='<?php if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')== 1)){ ?>3
                                                    <?php } else{ ?>2<?php } ?>'><strong class="float-right">TOTAL</strong></td>
                                                    <?php if(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_productwise_discount'),'estimate_settings_value')== 1)){ ?>
                                                       <td><strong><?php echo $total_quantity;?></strong></td>
                                                       <td></td>
                                                       <td><label><strong>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($total_amount); ?></strong></label></td>
                                                       <td></td>
                                                       <td><label><strong>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($discount_total); ?></strong></label></td>
                                                       <td class="text-center"><label><strong>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($total_price); ?></strong></label></td>
                                                   <?php } elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_overall_discount'),'estimate_settings_value')== 1)){ ?>
                                                       <td><strong><?php echo $total_quantity;?></strong></td>
                                                       <td></td>
                                                       <td><label><strong>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($total_amount); ?></strong></label></td>
                                                       <td></td>
                                                       <td><label><strong>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($discount_total); ?></strong></label></td>
                                                       <td class="text-center"><label><strong>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($total_price); ?></strong></label></td>
                                                   <?php } else { ?>
                                                   <td><strong><?php echo $total_quantity;?></strong></td>
                                                   <td></td>
                                                   <td class="text-center"><label><strong>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($total_amount); ?></strong></label></td>
                                               <?php } ?>
                                           </tr>
                                           <?php if(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_discount'),'estimate_settings_value')!= 1)) { 
                                            $final_amount = $final_amount + $total; ?>
                                        <?php } elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_productwise_discount'),'estimate_settings_value')== 1)){ 
                                            $final_amount = $final_amount + $total_price; ?>
                                        <?php } elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_overall_discount'),'estimate_settings_value')== 1)){ 
                                            $final_amount = $final_amount + $total_price; ?>
                                        <?php } elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_discount'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_productwise_discount'),'estimate_settings_value')== 1)){ 
                                            $final_amount = $final_amount + $final_total; ?>
                                        <?php } elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_discount'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_overall_discount'),'estimate_settings_value')== 1)){ 
                                            $final_amount = $final_amount + $final_total; ?>
                                        <?php }else { 
                                            $final_amount = $final_amount + $total_amount; ?>
                                        <?php } ?>
                                        <?php if($estimate_details['estimate_cash_discount']!="0") {  
                                            $final_amount = $final_amount-$estimate_details['estimate_cash_discount']; ?>
                                            <tr>
                                                <td colspan="<?php if($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')!= 1){ echo "7"; }elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_discount'),'estimate_settings_value')!= 1)) { echo "9"; } elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_discount'),'estimate_settings_value')!= 1)) { echo "5"; }elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_productwise_discount'),'estimate_settings_value')== 1)){ echo "8"; }elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_overall_discount'),'estimate_settings_value')== 1)){ echo "8"; }elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_cash_discount'),'estimate_settings_value')== 1)){ echo "5"; }elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_discount'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_productwise_discount'),'estimate_settings_value')== 1)){ echo "10"; }elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_discount'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_overall_discount'),'estimate_settings_value')== 1)){ echo "10"; }else { echo "6"; }?>" align="right"><b>CASH DISCOUNT</b></td>
                                                <td class="text-center"><?php echo digit_maintainer($estimate_details['estimate_cash_discount']); ?></td>
                                            </tr>
                                        <?php } ?>
                                        <?php if($estimate_details['estimate_other_expenses']!="0") {  
                                            $final_amount = $final_amount+$estimate_details['estimate_other_expenses']; ?>
                                            <tr>
                                                <td colspan="<?php if($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')!= 1){ echo "7"; }elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_discount'),'estimate_settings_value')!= 1)) { echo "9"; } elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_discount'),'estimate_settings_value')!= 1)) { echo "5"; } elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_productwise_discount'),'estimate_settings_value')== 1)){ echo "8"; }elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_overall_discount'),'estimate_settings_value')== 1)){ echo "8"; }elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_cash_discount'),'estimate_settings_value')== 1)){ echo "5"; }elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_discount'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_productwise_discount'),'estimate_settings_value')== 1)){ echo "10"; }elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_discount'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_overall_discount'),'estimate_settings_value')== 1)){ echo "10"; }else { echo "6"; }?>" align="right"><b>OTHER EXPENSES</b></td>
                                                <td class="text-center"><?php echo digit_maintainer($estimate_details['estimate_other_expenses']); ?></td>
                                            </tr>
                                        <?php } ?>
                                        <?php if($estimate_details['estimate_transportaion_charges']!="0") {  
                                            $final_amount = $final_amount+$estimate_details['estimate_transportaion_charges']; ?>
                                            <tr>
                                                <td colspan="<?php if($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')!= 1){ echo "7"; }elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_discount'),'estimate_settings_value')!= 1)) { echo "9"; } elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_discount'),'estimate_settings_value')!= 1)) { echo "5"; } elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_productwise_discount'),'estimate_settings_value')== 1)){ echo "8"; }elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_overall_discount'),'estimate_settings_value')== 1)){ echo "8"; }elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_cash_discount'),'estimate_settings_value')== 1)){ echo "5"; }elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_discount'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_productwise_discount'),'estimate_settings_value')== 1)){ echo "10"; }elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_discount'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_overall_discount'),'estimate_settings_value')== 1)){ echo "10"; }else { echo "6"; }?>" align="right"><b>TRANPORTATION CHARGES</b></td>
                                                <td class="text-center" ><?php echo digit_maintainer($estimate_details['estimate_transportaion_charges']); ?></td>
                                            </tr>
                                        <?php } ?>
                                        <?php if($estimate_details['estimate_loading_charges']!="0") {  
                                            $final_amount = $final_amount+$estimate_details['estimate_loading_charges']; ?>
                                            <tr>
                                                <td colspan="<?php if($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')!= 1){ echo "7"; }elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_discount'),'estimate_settings_value')!= 1)) { echo "9"; } elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_discount'),'estimate_settings_value')!= 1)) { echo "5"; } elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_productwise_discount'),'estimate_settings_value')== 1)){ echo "8"; }elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_overall_discount'),'estimate_settings_value')== 1)){ echo "8"; }elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_cash_discount'),'estimate_settings_value')== 1)){ echo "5"; }elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_discount'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_productwise_discount'),'estimate_settings_value')== 1)){ echo "10"; }elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_discount'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_overall_discount'),'estimate_settings_value')== 1)){ echo "10"; }else { echo "6"; }?>" align="right"><b><b>LOADING/UNLOADING CHARGES</b></td>
                                                <td class="text-center" ><?php echo digit_maintainer($estimate_details['estimate_loading_charges']); ?></td>
                                            </tr>
                                        <?php } ?>
                                        <tr>
                                            <td colspan="<?php if($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')!= 1){ echo "7"; } elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_discount'),'estimate_settings_value')!= 1)) { echo "5"; }elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_productwise_discount'),'estimate_settings_value')== 1)){ echo "8"; }elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_overall_discount'),'estimate_settings_value')== 1)){ echo "8"; }elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_cash_discount'),'estimate_settings_value')== 1)){ echo "5"; }elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_discount'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_productwise_discount'),'estimate_settings_value')== 1)){ echo "10"; }elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_discount'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_overall_discount'),'estimate_settings_value')== 1)){ echo "10"; }else { echo "6"; }?>" align="right"><b><b> TOTAL </b></td>
                                            <td class="text-center" >&#8377;&nbsp;&nbsp;&nbsp;<strong><?php echo MoneyFormatIndia($final_amount); ?></strong></td>
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