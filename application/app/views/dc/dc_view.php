<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">DC VIEW</h4>
                        <div class="page-title-right">
                            <div class="d-flex align-items-center justify-content-end">
                                <div class="col-12 ">
                                    <?php $quotation_id = $this->common->get_particular('tbl_dcs',array('dc_id' => $dc_details['dc_id'],'quotation_id!=' => "0"),'quotation_id'); ?>
                                    <?php if($quotation_id){ ?>
                                        <a href="<?php echo base_url('quotation_view/'.$quotation_id);?>" style="margin-right: 5px;" class="btn btn-dark float-right"><i class="bx bxs-truck font-size-16 align-middle mr-2"></i>&nbsp;Quotation View</a>
                                    <?php } ?>
                                    <a href="<?php echo base_url('dc_print/'.$dc_details['dc_id']);?>" style="margin-right: 5px;" class="btn btn-info float-right"><i class="fa fa-print"></i>&nbsp;Print</a>
                                    <a href="<?php echo base_url('dc_download/'.$dc_details['dc_id']);?>" style="margin-right: 5px;" class="btn btn-success float-right"><i class="fa fa-download"></i>&nbsp;Download</a>
                                    <a href="<?php echo base_url('dc');?>" style="margin-right: 5px;" class="btn btn-danger float-right"><i class="bx bxs-comment-add font-size-16 align-middle mr-2"></i>&nbsp;New DC</a>
                                    <a href="<?php echo base_url('dc_list');?>" style="margin-right: 5px;" class="btn btn-warning float-right"><i class="fa fas fa-backward"></i>&nbsp;BACK</a>
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
                                    <div class="col-lg-6"><h4 class="card-title">DC</h4></div>
                                </div>
                            </div>
                            <hr class="m-t-0 m-b-40"> -->
                            <div class="row">
                                <div class="col-sm-6 mt-3">
                                    <address>
                                        <strong>DC NUMBER :</strong><br>
                                        <?php echo $dc_details['dc_number']; ?>
                                    </address>
                                </div>
                                <div class="col-sm-6 mt-3 text-sm-right">
                                    <address>
                                        <strong>DC DATE :</strong><br>
                                        <?php echo date('d-m-Y',strtotime($dc_details['dc_date'])); ?><br><br>
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
                                            <th>PRODUCT DESCRIPTION</th>
                                            <?php if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')== 1)){ ?>
                                                <th scope="col">BRAND NAME</th>
                                            <?php } ?>
<!--                                             <?php if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_category'),'product_settings_value')== 1)){ ?>
                                                <th scope="col">CATEGORY NAME</th>
                                            <?php } ?> 
                                            <?php if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_subcategory'),'product_settings_value')== 1)){ ?>
                                                <th scope="col">SUB CATEGORY NAME</th>
                                                <?php } ?> -->
                                                <th>QUANTITY</th>
                                           <!--  <th>RATE</th>
                                            <th>AMOUNT</th>
                                            <?php if($this->common->get_particular('mst_settings',array('settings_name' => 'dc_tax_included'),'settings_value')==1){?> 
                                                <th>TAX %</th>
                                                <th>TAX TOTAL</th>
                                                <th>TOTAL</th>   
                                                <?php } ?> -->
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
                                                        <td><label><?php echo $relation['product_name']; ?></label></td>
                                                        <td><label><?php $product_description = $this->common->get_particular('mst_products',array('product_id' => $relation['product_id']),'product_description'); echo $product_description; ?></label></td>
                                                        <?php if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')== 1)){ ?>
                                                            <td><?php echo $relation['brand_name']; ?></td>
                                                        <?php } ?>
                                                        <!-- <?php if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_category'),'product_settings_value')== 1)){ ?>
                                                            <td><?php echo $relation['category_name']; ?></td>
                                                        <?php } ?> 
                                                        <?php if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_subcategory'),'product_settings_value')== 1)){ ?>
                                                            <td><?php echo $relation['sub_category_name']; ?></td>
                                                            <?php } ?> -->
                                                            <td><label><?php echo $relation['quantity']; ?></label></td>
                                                   <!--  <td><label>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($relation['rate']); ?></label></td>
                                                    <td><label>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia(($relation['quantity']*$relation['rate'])); ?></label></td> -->
                                                </tr>
                                            <?php } ?>
                                            <tr>
                                                <td colspan='<?php if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')== 1)){ ?>4
                                                    <?php } else{ ?>3<?php } ?>'><strong class="float-right">TOTAL</strong></td>
                                                    <td><label><?php echo $total_quantity; ?></label></td>
                                                <!-- <td></td>
                                                    <td><label>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($sub_total); ?></label></td> --> 
                                                </tr>
                                            <?php } ?>
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