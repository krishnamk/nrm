<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">QUOTATION VIEW</h4>
                        <div class="page-title-right">
                            <div class="d-flex align-items-center justify-content-end">
                                <div class="col-12 ">
                                    <a href="<?php echo base_url('quotation_list');?>" style="margin-right: 5px;" class="btn btn-primary float-right"><i class="fa fas fa-backward"></i>&nbsp;BACK</a>
                                    <a href="<?php echo base_url('quotation_print/'.$quotation_details['quotation_id']);?>" style="margin-right: 5px;" class="btn btn-warning float-right"><i class="fa fa-print"></i>&nbsp;Print</a>
                                    <a href="<?php echo base_url('quotation_download/'.$quotation_details['quotation_id']);?>" style="margin-right: 5px;" class="btn btn-dark float-right"><i class="fa fa-download"></i>&nbsp;Download</a>
                                    <a href="<?php echo base_url('quotation');?>" style="margin-right: 5px;" class="btn btn-success float-right"><i class="bx bxs-comment-add font-size-16 align-middle mr-2"></i>&nbsp;New Quotation</a>
                                    <!-- <?php if($quotation_details['quotation_cancel']=="0") { ?> 
                                        <?php if($quotation_details['status']!="2") { ?> 
                                            <a href="<?php echo base_url('qt_generate_dc/'.$quotation_details['quotation_id']);?>" style="margin-right: 5px;" class="btn btn-danger float-right"><i class="bx bxs-truck font-size-16 align-middle mr-2"></i>&nbsp;Generate DC</a>
                                        <?php } elseif($quotation_details['status']=="2"){ ?> 
                                            <?php $dc_id = $this->common->get_particular('tbl_dcs',array('quotation_id' => $quotation_details['quotation_id']),'dc_id'); ?>
                                            <a href="<?php echo base_url('dc_view/'.$dc_id);?>" style="margin-right: 5px;" class="btn btn-danger float-right"><i class="bx bxs-truck font-size-16 align-middle mr-2"></i>&nbsp;DC View</a>
                                        <?php } ?> 
                                        <?php } ?> -->
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
                                        <div class="col-lg-6"><h4 class="card-title">QUOTATION</h4></div>
                                    </div>
                                </div>
                                <hr class="m-t-0 m-b-40">
                                <div class="row">
                                    <div class="col-sm-6 mt-3">
                                        <address>
                                            <strong>QUOTATION NUMBER :</strong><br>
                                            <?php echo $quotation_details['quotation_number']; ?>
                                        </address>
                                    </div>
                                    <div class="col-sm-6 mt-3 text-sm-right">
                                        <address>
                                            <strong>QUOTATION DATE :</strong><br>
                                            <?php echo date('d-m-Y',strtotime($quotation_details['quotation_date'])); ?><br><br>
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
                                                <th>S.NO</th>
                                                <th>PRODUCT NAME</th>
                                                <?php if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')== 1)){ ?>
                                                    <th scope="col">BRAND NAME</th>
                                                <?php } ?>
                                                <?php if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_category'),'product_settings_value')== 1)){ ?>
                                                    <th scope="col">CATEGORY NAME</th>
                                                <?php } ?> 
                                                <?php if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_subcategory'),'product_settings_value')== 1)){ ?>
                                                    <th scope="col">SUB CATEGORY NAME</th>
                                                <?php } ?>
                                                <th>QUANTITY</th>
                                                <th>RATE</th>
                                                <?php if($this->common->get_particular('mst_quotation_settings',array('quotation_settings_name' => 'quotation_tax_included'),'quotation_settings_value')== 1) { ?>
                                                    <th>AMOUNT</th>
                                                    <th>TAX %</th>
                                                    <th>TAX TOTAL</th>
                                                <?php } ?>
                                                <th>TOTAL</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if($relations){
                                                $total_quantity = 0;
                                                $total_total = 0;
                                                $total_tax = 0;
                                                $total_amount = 0;
                                                foreach ($relations as $key => $relation) {
                                                    $total_quantity = $total_quantity + $relation['quantity'];
                                                    $total_tax = $total_tax + $relation['tax_total'];
                                                    $total_amount = ($relation['rate']*$relation['quantity']);
                                                    if($this->common->get_particular('mst_quotation_settings',array('quotation_settings_name'=>'quotation_tax_included'),'quotation_settings_value')== 1){
                                                        $total_total = $total_total + $relation['total']; 
                                                    }else{
                                                        $total_total = $total_total+$total_amount;
                                                    }
                                                    ?>
                                                    <tr>
                                                        <td style="width: 10px"><strong><?php echo next_number($key); ?></strong></td>
                                                        <td><label><?php echo $relation['product_name']; ?></label></td>
                                                        <?php if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')== 1)){ ?>
                                                            <td><?php echo $relation['brand_name']; ?></td>
                                                        <?php } ?>
                                                        <?php if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_category'),'product_settings_value')== 1)){ ?>
                                                            <td><?php echo $relation['category_name']; ?></td>
                                                        <?php } ?> 
                                                        <?php if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_subcategory'),'product_settings_value')== 1)){ ?>
                                                            <td><?php echo $relation['sub_category_name']; ?></td>
                                                        <?php } ?>
                                                        <td><label><?php echo $relation['quantity']; ?></label></td>
                                                        <td><label>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($relation['rate']); ?></label></td>
                                                        <?php if($this->common->get_particular('mst_quotation_settings',array('quotation_settings_name' => 'quotation_tax_included'),'quotation_settings_value')== 1) { ?>
                                                            <td><label>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($relation['quantity']*$relation['rate'])); ?></label></td>
                                                            <td><label><?php echo $relation['tax_percent']; ?> % </label></td>
                                                            <td><label>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($relation['tax_total']); ?></label></td>
                                                            <td><label>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($relation['total']); ?></label></td>
                                                        <?php } else { ?>
                                                            <td><label>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($relation['quantity']*$relation['rate'])); ?></label></td> 
                                                        <?php } ?>
                                                    </tr>
                                                <?php } ?>
                                                <tr>
                                                    <td colspan='<?php if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')== 1)){ ?>3
                                                        <?php } else{ ?>2<?php } ?>'><strong class="float-right">TOTAL</strong></td>
                                                    <?php if($this->common->get_particular('mst_quotation_settings',array('quotation_settings_name' => 'quotation_tax_included'),'quotation_settings_value')== 1) { ?>
                                                        <td colspan='<?php if($this->common->get_particular('mst_quotation_settings',array('quotation_settings_name' => 'quotation_tax_included'),'quotation_settings_value')== 1) { ?>2<?php } else{ ?>1<?php } ?>'><strong><label><?php echo $total_quantity; ?></label></strong></td>
                                                        <td><strong>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($total_amount);?></strong></td>
                                                        <td></td>
                                                        <td><strong>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($total_tax); ?></strong></td>
                                                        <td><label><strong>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($total_total); ?></strong></label></td> 
                                                    <?php }else{ ?>
                                                       <td><strong><?php echo $total_quantity;?></strong></td>
                                                       <td></td>
                                                       <td><label><strong>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($total_total); ?></strong></label></td>
                                                   <?php } ?>
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