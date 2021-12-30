<style type="text/css">
    td > input {
        width: 80px; 
    }
</style>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18"><?php if(isset($invoice_details)){ echo 'EDIT'; }else{ echo 'NEW'; } ?> INVOICE</h4>
                        <!-- <?php if($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'multiple_dc_to_invoice_generate'),'invoice_settings_value')==1){?>
                            <?php if(empty($invoice_details)){ ?>
                                <div class="page-title-right">
                                    <div class="button-items" style="text-align: right;">
                                        <?php if($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'multiple_dc_to_invoice_generate'),'invoice_settings_value')== 1) { ?> 
                                            <a href="<?php echo base_url('change_invoice_setting/'."1");?>" class="btn btn-success waves-effect waves-light"><i class="bx bxs-comment-add font-size-16 align-middle mr-2"></i>Direct Invoice</a>
                                        <?php } else { ?>
                                            <a href="<?php echo base_url('change_invoice_setting/'."2");?>" class="btn btn-primary waves-effect waves-light"><i class="bx bxs-comment-add font-size-16 align-middle mr-2"></i>DC to Invoice</a>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php } ?> -->
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 message"><?php message(); ?></div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <form method="post" id="invoice_form"> 
                                <!-- GENERAL DETAILS -->
                                <div class="form-body">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <input type="hidden" class="form-control" name="prefix_value" id="prefix_value" value="invoice_no">
                                                    <?php if($this->common->get_particular('mst_general_settings',array('general_settings_name' => 'multiple_company'),'general_settings_value')==1){?>
                                                        <?php if($this->session->userdata('access_level') <= 2) {  ?>
                                                            <div class="form-group col-md-3">
                                                                <label class="control-label">SELECT COMPANY</label>
                                                                <select id="company_id" name="company_id" class="form-control form-control-danger">
                                                                    <option value="">SELECT COMPANY</option>
                                                                    <?php if(isset($invoice_details)) { ?>  <option value='<?php $company_id = $this->common->get_particular('company_details',array('company_name' => $company_list),'company_id'); echo $company_lists; ?>'><?php echo $company_lists; ?></option>";
                                                                <?php }else{ ?> 
                                                                   <?php foreach ($company_lists as $key => $company_list) { ?>
                                                                    echo "
                                                                    <option value='<?php $company_id = $this->common->get_particular('company_details',array('company_name' => $company_list),'company_id'); echo $company_id; ?>'><?php echo $company_list; ?></option>";
                                                                <?php } ?>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                <?php } ?>
                                            <?php } else{ ?>
                                                <input type="hidden" name="company_id" id="company_id" class="form-control" value="<?php if(isset($invoice_details)){ echo $invoice_details['company_id']; }else{ echo $this->session->userdata['company_id']; } ?>" readonly >
                                            <?php } ?>
                                            <?php if($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'multiple_dc_to_invoice_generate'),'invoice_settings_value')!= 1) { ?> 
                                                <div class="form-group col-md-2">
                                                    <label class="control-label">INVOICE NUMBER</label>
                                                    <input type="text" name="invoice_number" id="invoice_number" class="form-control" placeholder="INVOICE NUMBER" value="<?php if(isset($invoice_details)){ echo $invoice_details['invoice_number']; }else{ echo $invoice_number; } ?>" readonly >
                                                </div> 
                                                <div class="form-group col-md-2">
                                                    <label class="control-label">DATE</label>
                                                    <input type="date" name="invoice_date" id="invoice_date" class="form-control form-control-danger" placeholder="DATE" value="<?php if(isset($invoice_details)){ echo date('Y-m-d',strtotime($invoice_details['invoice_date'])); }else{ echo date('Y-m-d'); } ?>">
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label class="control-label">INVOICE TYPE</label>
                                                    <select id="invoice_type" name="invoice_type" class="form-control form-control-danger">
                                                        <option <?php if(isset($invoice_details)){ if($invoice_details['invoice_type']=='1'){ echo "selected";} }else{ echo "selected"; } ?> value="1" >CASH</option>
                                                        <option <?php if(isset($invoice_details)){ if($invoice_details['invoice_type']=='2'){ echo "selected"; } } ?> value="2">CREDIT</option>
                                                    </select>
                                                </div>
                                                <?php if($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'sales_person_include'),'invoice_settings_value')== 1) { ?> 
                                                    <div class="form-group col-md-2">
                                                        <label class="control-label">SALES PERSON</label>
                                                        <select id="invoice_employee" name="invoice_employee" class="form-control form-control-danger select2">
                                                            <?php echo $employees; ?>
                                                        </select>
                                                    </div>
                                                <?php } ?>
                                                <div class="form-group col-md-1">
                                                    <label class="control-label">DISC - %</label>
                                                    <input type="invoice_overall_discount" name="invoice_overall_discount" id="invoice_overall_discount" class="form-control form-control-danger invoice_overall_discount" value="<?php if(isset($invoice_details)){ echo $invoice_details['invoice_overall_discount']; } ?>">
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label class="control-label">CUSTOMER</label>
                                                    <select id="invoice_customer" name="invoice_customer" class="form-control form-control-danger select2">
                                                        <?php echo $customers; ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-1">
                                                    <label class="control-label col-lg-12">&nbsp;</label>
                                                    <a class="btn btn-primary add_customer" href="#" alt="default" data-toggle="modal" data-target="#responsive-modal"  ><i class="fa fa-plus"></i></a>
                                                </div> 

                                            <?php } elseif(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_productwise_discount'),'invoice_settings_value') == 1)) { ?> 
                                                <div class="form-group col-md-2">
                                                    <label class="control-label">INVOICE NUMBER</label>
                                                    <input type="text" name="invoice_number" id="invoice_number" class="form-control" placeholder="invoice NUMBER" value="<?php if(isset($invoice_details)){ echo $invoice_details['invoice_number']; }else{ echo $invoice_number; } ?>" readonly >
                                                </div> 
                                                <div class="form-group col-md-2">
                                                    <label class="control-label">DATE</label>
                                                    <input type="date" name="invoice_date" id="invoice_date" class="form-control form-control-danger" placeholder="DATE" value="<?php if(isset($invoice_details)){ echo date('Y-m-d',strtotime($invoice_details['invoice_date'])); }else{ echo date('Y-m-d'); } ?>">
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label class="control-label">INVOICE TYPE</label>
                                                    <select id="invoice_type" name="invoice_type" class="form-control form-control-danger">
                                                        <option <?php if(isset($invoice_details)){ if($invoice_details['invoice_type']=='1'){ echo "selected";} }else{ echo "selected"; } ?> value="1" >CASH</option>
                                                        <option <?php if(isset($invoice_details)){ if($invoice_details['invoice_type']=='2'){ echo "selected"; } } ?> value="2">CREDIT</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label class="control-label">CUSTOMER</label>
                                                    <select id="invoice_customer" name="invoice_customer" class="form-control form-control-danger select2">
                                                        <?php echo $customers; ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-1">
                                                    <label class="control-label col-lg-12">&nbsp;</label>
                                                    <a href="<?php echo base_url('customer/customer_popup'); ?>" class="btn btn-primary add_customer" data-toggle="modal" data-target="#responsive-modal"><i class="fa fa-plus">&nbsp;</i></a>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label class="control-label">DC NO</label>
                                                    <select id="invoice_dc_no" name="dc_no[]" class="form-control select2" multiple="multiple" onselect="$(this).select">
                                                     <?php if(isset($dc_no)){ echo $dc_no; } ?> 
                                                 </select>
                                             </div>
                                         <?php } elseif(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_overall_discount'),'invoice_settings_value') == 1)) { ?>
                                            <div class="form-group col-md-2">
                                                <label class="control-label">INVOICE NUMBER</label>
                                                <input type="text" name="invoice_number" id="invoice_number" class="form-control" placeholder="invoice NUMBER" value="<?php if(isset($invoice_details)){ echo $invoice_details['invoice_number']; }else{ echo $invoice_number; } ?>" readonly >
                                            </div> 
                                            <div class="form-group col-md-2">
                                                <label class="control-label">DATE</label>
                                                <input type="date" name="invoice_date" id="invoice_date" class="form-control form-control-danger" placeholder="DATE" value="<?php if(isset($invoice_details)){ echo date('Y-m-d',strtotime($invoice_details['invoice_date'])); }else{ echo date('Y-m-d'); } ?>">
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label class="control-label">INVOICE TYPE</label>
                                                <select id="invoice_type" name="invoice_type" class="form-control form-control-danger">
                                                    <option <?php if(isset($invoice_details)){ if($invoice_details['invoice_type']=='1'){ echo "selected";} }else{ echo "selected"; } ?> value="1" >CASH</option>
                                                    <option <?php if(isset($invoice_details)){ if($invoice_details['invoice_type']=='2'){ echo "selected"; } } ?> value="2">CREDIT</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label class="control-label">CUSTOMER</label>
                                                <select id="invoice_customer" name="invoice_customer" class="form-control form-control-danger select2">
                                                    <?php echo $customers; ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-1">
                                                <label class="control-label col-lg-12">&nbsp;</label>
                                                <a href="<?php echo base_url('customer/customer_popup'); ?>" class="btn btn-primary add_customer" data-toggle="modal" data-target="#responsive-modal"><i class="fa fa-plus">&nbsp;</i></a>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label class="control-label">DC NO</label>
                                                <select id="invoice_dc_no" name="dc_no[]" class="form-control select2" multiple="multiple" onselect="$(this).select">
                                                    <?php if(isset($dc_no)){ echo $dc_no; } ?>                              
                                                </select>
                                            </div>
                                            <div class="form-group col-md-1">
                                                <label class="control-label">DISC-%</label>
                                                <input type="invoice_overall_discount" name="invoice_overall_discount" id="invoice_overall_discount" class="form-control form-control-danger invoice_overall_discount" value="<?php if(isset($invoice_details)){ echo $invoice_details['invoice_overall_discount']; } ?>">
                                            </div>


                                        <?php } else { ?>
                                            <div class="form-group col-md-2">
                                                <label class="control-label">INVOICE NUMBER</label>
                                                <input type="text" name="invoice_number" id="invoice_number" class="form-control" placeholder="invoice NUMBER" value="<?php if(isset($invoice_details)){ echo $invoice_details['invoice_number']; }else{ echo $invoice_number; } ?>" readonly >
                                            </div> 
                                            <div class="form-group col-md-2">
                                                <label class="control-label">DATE</label>
                                                <input type="date" name="invoice_date" id="invoice_date" class="form-control form-control-danger" placeholder="DATE" value="<?php if(isset($invoice_details)){ echo date('Y-m-d',strtotime($invoice_details['invoice_date'])); }else{ echo date('Y-m-d'); } ?>">
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label class="control-label">CUSTOMER</label>
                                                <select id="invoice_customer" name="invoice_customer" class="form-control form-control-danger select2">
                                                    <?php echo $customers; ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-1">
                                                <label class="control-label col-lg-12">&nbsp;</label>
                                                <a href="<?php echo base_url('customer/customer_popup'); ?>" class="btn btn-primary add_customer" data-toggle="modal" data-target="#responsive-modal"><i class="fa fa-plus">&nbsp;</i></a>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label class="control-label">DC NO</label>
                                                <select id="invoice_dc_no" name="dc_no[]" class="form-control select2" multiple="multiple" onselect="$(this).select">
                                                    <?php if(isset($dc_no)){ echo $dc_no; } ?>                              
                                                </select>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row  invoice_product_list" style="<?php //if(isset($invoice_details)){ echo'display: block;';}else{ echo'display: none;'; } ?>">
                                <?php if($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'multiple_dc_to_invoice_generate'),'invoice_settings_value')!= 1) { ?> 
                                    <div class="col-md-12">
                                      <h4 class="card-title m-t-20">INVOICE PRODUCTS</h4>
                                  </div>
                                  <hr>
                                  <div class="card-body">
                                    <div class="row" style="margin-bottom: 20px;">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="form-group col-md-3">
                                                    <label class="control-label">PRODUCT</label>
                                                    <select class="form-control select2" name="invoice_product" id="invoice_product">
                                                        <?php product();?>
                                                    </select>
                                                </div>
                                                <?php if($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')== 1) { ?>
                                                    <div class="form-group col-md-2">
                                                        <label class="control-label">BRAND</label>
                                                        <input type="text" name="invoice_brand" id="invoice_brand" class="form-control" readonly="">
                                                    </div>
                                                <?php } ?>
                                                <div class="form-group col-md-2">
                                                    <label class="control-label">RATE</label>
                                                    <input type="text" name="invoice_rate" id="invoice_rate" class="form-control" >
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label class="control-label">QUANTITY</label>
                                                    <input type="text" name="invoice_quantity" id="invoice_quantity" class="form-control" >
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label class="control-label">AMOUNT</label>
                                                    <input type="text" name="invoice_amount" id="invoice_amount" class="form-control" onselect="$(this).select();">
                                                </div>
                                                <div class="form-group col-md-1">
                                                    <label class="control-label" style="width: 100%;">&nbsp;</label>
                                                    <a class="btn btn-primary form-control new_invoice_add"  style="color:white;width: 50px;"><i class="fa fa-plus" style="color:white;"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" id="stock_content">
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="card-body col-md-12">
                                <div class="table-responsive m-t-20">
                                    <table class="table table-bordered table-responsive-lg">
                                        <thead>
                                            <tr>
                                                <th scope="col">S.NO</th>
                                                <th scope="col">PRODUCT NAME</th>
                                                <?php if($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')== 1) { ?>
                                                    <th scope="col">BRAND NAME</th>
                                                <?php } ?>
                                                <?php if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_category'),'product_settings_value')== 1)){ ?>
                                                    <th scope="col">CATEGORY NAME</th>
                                                <?php } ?>
                                                <th scope="col">QUANTITY</th>
                                                <th scope="col">RATE</th>
                                                <?php  if(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_discount'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_productwise_discount'),'invoice_settings_value')== 1)){ ?>
                                                    <th scope="col">DISCOUNT %</th>
                                                    <th scope="col">PRICE</th>
                                                <?php }  elseif(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_discount'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_overall_discount'),'invoice_settings_value')== 1)){ ?>
                                                    <th scope="col">DISCOUNT %</th>
                                                    <th scope="col">PRICE</th>
                                                <?php } ?>
                                                <?php  if($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')== 1){ ?>
                                                    <th scope="col">TAX %</th>
                                                <?php } ?>
                                                <th scope="col">AMOUNT</th>
                                                <?php  if($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'multiple_dc_to_invoice_generate'),'invoice_settings_value')!= 1){ ?>
                                                    <th scope="col">ACTION</th>
                                                <?php } else { ?>
                                                    <th scope="col">SELECT</th>
                                                <?php } ?>
                                                <!--TAX TYPE DEFAULT -->
                                                <?php if($this->common->get_particular('mst_settings',array('settings_name' => 'invoice_tax_type' ),'settings_value') == 1){ ?>
                                                    <input type="hidden" id="invoice_tax_type" value="1">
                                                <?php } else { ?> 
                                                   <input type="hidden" id="invoice_tax_type" value="2">
                                               <?php } ?>
                                           </tr>
                                       </thead>
                                       <tbody class="listings">
                                        <?php if(isset($temp_products)){
                                            echo $temp_products;
                                        }else{
                                            echo '<tr><td colspan="11">NO PRODUCTS ADDED</td></tr>';
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <br>
                        <table class="table table-bordered table-responsive-lg">
                            <tbody class="">
                                <tr>
                                    <td colspan="6"><strong>SUB TOTAL</strong></td>
                                    <td colspan="6">
                                        <input type="text" name="invoice_subtotal" id="invoice_subtotal" class="form-control" value="<?php if(isset($pre_total)){ echo $pre_total; }else{ echo "0"; } ?>" readonly="">
                                        <input type="hidden" id="subtotal" class="form-control" value="" readonly="">
                                    </td> 
                                </tr>
                                <?php  if($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_cash_discount'),'invoice_settings_value')== 1){ ?>
                                    <tr>
                                        <td colspan="6"><strong>CASH DISCOUNT:</strong></td>
                                        <td colspan="6"><input type="text" name="invoice_cash_discount" id="invoice_cash_discount" class="form-control" value="<?php if(isset($invoice_details['invoice_cash_discount'])){echo $invoice_details['invoice_cash_discount'];}else{echo "0";}?>"></td>
                                    </tr>
                                <?php } else { ?>
                                    <input type="hidden" name="invoice_cash_discount" id="invoice_cash_discount" class="form-control" value="0">
                                <?php } ?>
                                <?php  if($this->common->get_particular('mst_general_settings',array('general_settings_name' => 'other_expenses'),'general_settings_value')== 1){ ?>
                                   <tr>
                                    <td colspan="6"><strong>OTHER EXPENSES:</strong></td>
                                    <td colspan="6">
                                        <input type="text" name="invoice_other_expenses" id="invoice_other_expenses" class="form-control" value="<?php if(isset($invoice_details['invoice_other_expenses'])){echo $invoice_details['invoice_other_expenses'];}else{echo "0";}?>">
                                    </td>
                                </tr>
                            <?php } else { ?>
                                <input type="hidden" name="invoice_other_expenses" id="invoice_other_expenses" class="form-control" value="0">
                            <?php } ?>
                            <?php  if($this->common->get_particular('mst_general_settings',array('general_settings_name' => 'transport_charges'),'general_settings_value')== 1){ ?>
                                <tr>
                                    <td colspan="6"><strong>TRANSPORT CHARGES:</strong></td>
                                    <td colspan="6"><input type="text" name="invoice_transportaion_charges" id="invoice_transportaion_charges" class="form-control" value="<?php if(isset($invoice_details['invoice_transportaion_charges'])){echo $invoice_details['invoice_transportaion_charges'];}else{echo "0";}?>"></td>
                                </tr>
                            <?php } else { ?>
                                <input type="hidden" name="invoice_transportaion_charges" id="invoice_transportaion_charges" class="form-control" value="0">
                            <?php } ?>
                            <?php  if($this->common->get_particular('mst_general_settings',array('general_settings_name' => 'loading_unloading_charges'),'general_settings_value')== 1){ ?>
                               <tr>
                                <td colspan="6"><strong>LOADING / UNLOADING CHARGES:</strong></td>
                                <td colspan="6"><input type="text" name="invoice_loading_charges" id="invoice_loading_charges" class="form-control" value="<?php if(isset($invoice_details['invoice_loading_charges'])){echo $invoice_details['invoice_loading_charges'];}else{echo "0";}?>"></td>
                            </tr>
                        <?php } else { ?>
                            <input type="hidden" name="invoice_loading_charges" id="invoice_loading_charges" class="form-control" value="0">
                        <?php } ?>
                        <?php  if($this->common->get_particular('mst_general_settings',array('general_settings_name' => 'bundle'),'general_settings_value')== 1){ ?>
                         <tr>
                            <td colspan="6"><strong>TOTAL BUNDLE:</strong></td>
                            <td colspan="6">
                                <input type="text" name="total_bundle" id="total_bundle" class="form-control" value="<?php if(isset($invoice_details['total_bundle'])){echo $invoice_details['total_bundle'];}else{echo "0";}?>">
                            </td>
                        </tr>
                    <?php } else { ?>
                        <input type="hidden" name="total_bundle" id="total_bundle" class="form-control" value="0">
                    <?php } ?>
                    <?php  if($this->common->get_particular('mst_general_settings',array('general_settings_name' => 'date_of_supply'),'general_settings_value')== 1){ ?>
                     <tr>
                        <td colspan="6"><strong>REVERSE CHARGE (Y/N):</strong></td>
                        <td colspan="6">
                            <input type="text" name="reverse_charge" id="reverse_charge" class="form-control" value="<?php if(isset($invoice_details['reverse_charge'])){echo $invoice_details['reverse_charge'];}else{echo "Y/N";}?>">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6"><strong>DATE OF SUPPLY:</strong></td>
                        <td colspan="6">
                            <input type="text" name="date_of_supply" id="date_of_supply" class="form-control" value="<?php if(isset($invoice_details)){ echo date('Y-m-d',strtotime($invoice_details['date_of_supply'])); }else{ echo date('d-m-Y'); } ?>">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6"><strong>PLACE OF SUPPLY:</strong></td>
                        <td colspan="6">
                            <input type="text" name="place_of_supply" id="place_of_supply" class="form-control" value="<?php if(isset($invoice_details['place_of_supply'])){echo $invoice_details['place_of_supply'];}?>">
                        </td>
                    </tr>
                <?php } ?>
                <tr>
                    <td colspan="6"><strong>TOTAL</strong></td>
                    <td colspan="6"><input type="text" name="total" id="invoice_total" class="form-control" value="<?php if(isset($final_total)){ echo $final_total; }else{ echo "0"; } ?>" readonly=""></td>
                </tr>
            </tbody>
        </table>
        <div class="form-actions col-md-12">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <a href="<?php echo base_url('invoice_list'); ?>" class="btn btn-dark">CANCEL</a>
                    </div>
                    <div class="col-md-6 ">
                        <button type="submit" class="btn btn-success float-right"> <i class="fa fa-check"></i> <?php if(isset($invoice_details)){ echo "UPDATE"; }else{ echo "CREATE"; } ?></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
