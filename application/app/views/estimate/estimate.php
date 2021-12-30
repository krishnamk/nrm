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
                        <h4 class="mb-0 font-size-18"><?php if(isset($estimate_details)){ echo 'EDIT'; }else{ echo 'NEW'; } ?> estimate</h4>
                        <!-- <?php if($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'multiple_dc_to_estimate_generate'),'estimate_settings_value')==1){?>
                            <?php if(empty($estimate_details)){ ?>
                                <div class="page-title-right">
                                    <div class="button-items" style="text-align: right;">
                                        <?php if($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'multiple_dc_to_estimate_generate'),'estimate_settings_value')== 1) { ?> 
                                            <a href="<?php echo base_url('change_estimate_setting/'."1");?>" class="btn btn-success waves-effect waves-light"><i class="bx bxs-comment-add font-size-16 align-middle mr-2"></i>Direct estimate</a>
                                        <?php } else { ?>
                                            <a href="<?php echo base_url('change_estimate_setting/'."2");?>" class="btn btn-primary waves-effect waves-light"><i class="bx bxs-comment-add font-size-16 align-middle mr-2"></i>DC to estimate</a>
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
                            <form method="post" id="estimate_form"> 
                                <!-- GENERAL DETAILS -->
                                <div class="form-body">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <input type="hidden" class="form-control" name="prefix_value" id="prefix_value" value="estimate_no">
                                                    <?php if($this->common->get_particular('mst_general_settings',array('general_settings_name' => 'multiple_company'),'general_settings_value')==1){?>
                                                        <?php if($this->session->userdata('access_level') <= 2) {  ?>
                                                            <div class="form-group col-md-3">
                                                                <label class="control-label">SELECT COMPANY</label>
                                                                <select id="company_id" name="company_id" class="form-control form-control-danger">
                                                                    <option value="">SELECT COMPANY</option>
                                                                    <?php if(isset($estimate_details)) { ?>  <option value='<?php $company_id = $this->common->get_particular('company_details',array('company_name' => $company_list),'company_id'); echo $company_lists; ?>'><?php echo $company_lists; ?></option>";
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
                                                <input type="hidden" name="company_id" id="company_id" class="form-control" value="<?php if(isset($estimate_details)){ echo $estimate_details['company_id']; }else{ echo $this->session->userdata['company_id']; } ?>" readonly >
                                            <?php } ?>
                                            <?php if($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'multiple_dc_to_estimate_generate'),'estimate_settings_value')!= 1) { ?> 
                                                <div class="form-group col-md-2">
                                                    <label class="control-label">ESTIMATE NUMBER</label>
                                                    <input type="text" name="estimate_number" id="estimate_number" class="form-control" placeholder="ESTIMATE NUMBER" value="<?php if(isset($estimate_details)){ echo $estimate_details['estimate_number']; }else{ echo $estimate_number; } ?>" readonly >
                                                </div> 
                                                <div class="form-group col-md-2">
                                                    <label class="control-label">DATE</label>
                                                    <input type="date" name="estimate_date" id="estimate_date" class="form-control form-control-danger" placeholder="DATE" value="<?php if(isset($estimate_details)){ echo date('Y-m-d',strtotime($estimate_details['estimate_date'])); }else{ echo date('Y-m-d'); } ?>">
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label class="control-label">ESTIMATE TYPE</label>
                                                    <select id="estimate_type" name="estimate_type" class="form-control form-control-danger">
                                                        <option <?php if(isset($estimate_details)){ if($estimate_details['estimate_type']=='1'){ echo "selected";} }else{ echo "selected"; } ?> value="1" >CASH</option>
                                                        <option <?php if(isset($estimate_details)){ if($estimate_details['estimate_type']=='2'){ echo "selected"; } } ?> value="2">CREDIT</option>
                                                    </select>
                                                </div>
                                                <?php if($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'sales_person_include'),'estimate_settings_value')== 1) { ?> 
                                                    <div class="form-group col-md-2">
                                                        <label class="control-label">SALES PERSON</label>
                                                        <select id="estimate_employee" name="estimate_employee" class="form-control form-control-danger select2">
                                                            <?php echo $employees; ?>
                                                        </select>
                                                    </div>
                                                <?php } ?>
                                                <div class="form-group col-md-1">
                                                    <label class="control-label">DISC - %</label>
                                                    <input type="estimate_overall_discount" name="estimate_overall_discount" id="estimate_overall_discount" class="form-control form-control-danger estimate_overall_discount" value="<?php if(isset($estimate_details)){ echo $estimate_details['estimate_overall_discount']; } ?>">
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label class="control-label">CUSTOMER</label>
                                                    <select id="estimate_customer" name="estimate_customer" class="form-control form-control-danger select2">
                                                        <?php echo $customers; ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-1">
                                                    <label class="control-label col-lg-12">&nbsp;</label>
                                                    <a class="btn btn-primary add_customer" href="#" alt="default" data-toggle="modal" data-target="#responsive-modal"  ><i class="fa fa-plus"></i></a>
                                                </div> 

                                            <?php } elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_productwise_discount'),'estimate_settings_value') == 1)) { ?> 
                                                <div class="form-group col-md-2">
                                                    <label class="control-label">ESTIMATE NUMBER</label>
                                                    <input type="text" name="estimate_number" id="estimate_number" class="form-control" placeholder="ESTIMATE NUMBER" value="<?php if(isset($estimate_details)){ echo $estimate_details['estimate_number']; }else{ echo $estimate_number; } ?>" readonly >
                                                </div> 
                                                <div class="form-group col-md-2">
                                                    <label class="control-label">DATE</label>
                                                    <input type="date" name="estimate_date" id="estimate_date" class="form-control form-control-danger" placeholder="DATE" value="<?php if(isset($estimate_details)){ echo date('Y-m-d',strtotime($estimate_details['estimate_date'])); }else{ echo date('Y-m-d'); } ?>">
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label class="control-label">ESTIMATE TYPE</label>
                                                    <select id="estimate_type" name="estimate_type" class="form-control form-control-danger">
                                                        <option <?php if(isset($estimate_details)){ if($estimate_details['estimate_type']=='1'){ echo "selected";} }else{ echo "selected"; } ?> value="1" >CASH</option>
                                                        <option <?php if(isset($estimate_details)){ if($estimate_details['estimate_type']=='2'){ echo "selected"; } } ?> value="2">CREDIT</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label class="control-label">CUSTOMER</label>
                                                    <select id="estimate_customer" name="estimate_customer" class="form-control form-control-danger select2">
                                                        <?php echo $customers; ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-1">
                                                    <label class="control-label col-lg-12">&nbsp;</label>
                                                    <a href="<?php echo base_url('customer/customer_popup'); ?>" class="btn btn-primary add_customer" data-toggle="modal" data-target="#responsive-modal"><i class="fa fa-plus">&nbsp;</i></a>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label class="control-label">DC NO</label>
                                                    <select id="estimate_dc_no" name="dc_no[]" class="form-control select2" multiple="multiple" onselect="$(this).select">
                                                     <?php if(isset($dc_no)){ echo $dc_no; } ?> 
                                                 </select>
                                             </div>
                                         <?php } elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_overall_discount'),'estimate_settings_value') == 1)) { ?>
                                            <div class="form-group col-md-2">
                                                <label class="control-label">ESTIMATE NUMBER</label>
                                                <input type="text" name="estimate_number" id="estimate_number" class="form-control" placeholder="ESTIMATE NUMBER" value="<?php if(isset($estimate_details)){ echo $estimate_details['estimate_number']; }else{ echo $estimate_number; } ?>" readonly >
                                            </div> 
                                            <div class="form-group col-md-2">
                                                <label class="control-label">DATE</label>
                                                <input type="date" name="estimate_date" id="estimate_date" class="form-control form-control-danger" placeholder="DATE" value="<?php if(isset($estimate_details)){ echo date('Y-m-d',strtotime($estimate_details['estimate_date'])); }else{ echo date('Y-m-d'); } ?>">
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label class="control-label">ESTIMATE TYPE</label>
                                                <select id="estimate_type" name="estimate_type" class="form-control form-control-danger">
                                                    <option <?php if(isset($estimate_details)){ if($estimate_details['estimate_type']=='1'){ echo "selected";} }else{ echo "selected"; } ?> value="1" >CASH</option>
                                                    <option <?php if(isset($estimate_details)){ if($estimate_details['estimate_type']=='2'){ echo "selected"; } } ?> value="2">CREDIT</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label class="control-label">CUSTOMER</label>
                                                <select id="estimate_customer" name="estimate_customer" class="form-control form-control-danger select2">
                                                    <?php echo $customers; ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-1">
                                                <label class="control-label col-lg-12">&nbsp;</label>
                                                <a href="<?php echo base_url('customer/customer_popup'); ?>" class="btn btn-primary add_customer" data-toggle="modal" data-target="#responsive-modal"><i class="fa fa-plus">&nbsp;</i></a>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label class="control-label">DC NO</label>
                                                <select id="estimate_dc_no" name="dc_no[]" class="form-control select2" multiple="multiple" onselect="$(this).select">
                                                    <?php if(isset($dc_no)){ echo $dc_no; } ?>                              
                                                </select>
                                            </div>
                                            <div class="form-group col-md-1">
                                                <label class="control-label">DISC-%</label>
                                                <input type="estimate_overall_discount" name="estimate_overall_discount" id="estimate_overall_discount" class="form-control form-control-danger estimate_overall_discount" value="<?php if(isset($estimate_details)){ echo $estimate_details['estimate_overall_discount']; } ?>">
                                            </div>


                                        <?php } else { ?>
                                            <div class="form-group col-md-2">
                                                <label class="control-label">ESTIMATE NUMBER</label>
                                                <input type="text" name="estimate_number" id="estimate_number" class="form-control" placeholder="ESTIMATE NUMBER" value="<?php if(isset($estimate_details)){ echo $estimate_details['estimate_number']; }else{ echo $estimate_number; } ?>" readonly >
                                            </div> 
                                            <div class="form-group col-md-2">
                                                <label class="control-label">DATE</label>
                                                <input type="date" name="estimate_date" id="estimate_date" class="form-control form-control-danger" placeholder="DATE" value="<?php if(isset($estimate_details)){ echo date('Y-m-d',strtotime($estimate_details['estimate_date'])); }else{ echo date('Y-m-d'); } ?>">
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label class="control-label">CUSTOMER</label>
                                                <select id="estimate_customer" name="estimate_customer" class="form-control form-control-danger select2">
                                                    <?php echo $customers; ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-1">
                                                <label class="control-label col-lg-12">&nbsp;</label>
                                                <a href="<?php echo base_url('customer/customer_popup'); ?>" class="btn btn-primary add_customer" data-toggle="modal" data-target="#responsive-modal"><i class="fa fa-plus">&nbsp;</i></a>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label class="control-label">DC NO</label>
                                                <select id="estimate_dc_no" name="dc_no[]" class="form-control select2" multiple="multiple" onselect="$(this).select">
                                                    <?php if(isset($dc_no)){ echo $dc_no; } ?>                              
                                                </select>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row  estimate_product_list" style="<?php //if(isset($estimate_details)){ echo'display: block;';}else{ echo'display: none;'; } ?>">
                                <?php if($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'multiple_dc_to_estimate_generate'),'estimate_settings_value')!= 1) { ?> 
                                    <div class="col-md-12">
                                      <h4 class="card-title m-t-20">ESTIMATE PRODUCTS</h4>
                                  </div>
                                  <hr>
                                  <div class="card-body">
                                    <div class="row" style="margin-bottom: 20px;">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="form-group col-md-3">
                                                    <label class="control-label">PRODUCT</label>
                                                    <select class="form-control select2" name="estimate_product" id="estimate_product">
                                                        <?php product();?>
                                                    </select>
                                                </div>
                                                <?php if($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')== 1) { ?>
                                                    <div class="form-group col-md-2">
                                                        <label class="control-label">BRAND</label>
                                                        <input type="text" name="estimate_brand" id="estimate_brand" class="form-control" readonly="">
                                                    </div>
                                                <?php } ?>
                                                <div class="form-group col-md-2">
                                                    <label class="control-label">RATE</label>
                                                    <input type="text" name="estimate_rate" id="estimate_rate" class="form-control" >
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label class="control-label">QUANTITY</label>
                                                    <input type="text" name="estimate_quantity" id="estimate_quantity" class="form-control" >
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label class="control-label">AMOUNT</label>
                                                    <input type="text" name="estimate_amount" id="estimate_amount" class="form-control" onselect="$(this).select();">
                                                </div>
                                                <div class="form-group col-md-1">
                                                    <label class="control-label" style="width: 100%;">&nbsp;</label>
                                                    <a class="btn btn-primary form-control new_estimate_add"  style="color:white;width: 50px;"><i class="fa fa-plus" style="color:white;"></i></a>
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
                                                <?php  if(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_discount'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_productwise_discount'),'estimate_settings_value')== 1)){ ?>
                                                    <th scope="col">DISCOUNT %</th>
                                                    <th scope="col">PRICE</th>
                                                <?php }  elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_discount'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_overall_discount'),'estimate_settings_value')== 1)){ ?>
                                                    <th scope="col">DISCOUNT %</th>
                                                    <th scope="col">PRICE</th>
                                                <?php } ?>
                                                <th scope="col">AMOUNT</th>
                                                <?php  if($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'multiple_dc_to_estimate_generate'),'estimate_settings_value')!= 1){ ?>
                                                    <th scope="col">ACTION</th>
                                                <?php } else { ?>
                                                    <th scope="col">SELECT</th>
                                                <?php } ?>
                                                <!--TAX TYPE DEFAULT -->
                                                <?php if($this->common->get_particular('mst_settings',array('settings_name' => 'estimate_tax_type' ),'settings_value') == 1){ ?>
                                                    <input type="hidden" id="estimate_tax_type" value="1">
                                                <?php } else { ?> 
                                                   <input type="hidden" id="estimate_tax_type" value="2">
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
                                        <input type="text" name="estimate_subtotal" id="estimate_subtotal" class="form-control" value="<?php if(isset($pre_total)){ echo $pre_total; }else{ echo "0"; } ?>" readonly="">
                                        <input type="hidden" id="subtotal" class="form-control" value="" readonly="">
                                    </td> 
                                </tr>
                                <?php  if($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_cash_discount'),'estimate_settings_value')== 1){ ?>
                                    <tr>
                                        <td colspan="6"><strong>CASH DISCOUNT:</strong></td>
                                        <td colspan="6"><input type="text" name="estimate_cash_discount" id="estimate_cash_discount" class="form-control" value="<?php if(isset($estimate_details['estimate_cash_discount'])){echo $estimate_details['estimate_cash_discount'];}else{echo "0";}?>"></td>
                                    </tr>
                                <?php } else { ?>
                                    <input type="hidden" name="estimate_cash_discount" id="estimate_cash_discount" class="form-control" value="0">
                                <?php } ?>
                                <?php  if($this->common->get_particular('mst_general_settings',array('general_settings_name' => 'other_expenses'),'general_settings_value')== 1){ ?>
                                   <tr>
                                    <td colspan="6"><strong>OTHER EXPENSES:</strong></td>
                                    <td colspan="6">
                                        <input type="text" name="estimate_other_expenses" id="estimate_other_expenses" class="form-control" value="<?php if(isset($estimate_details['estimate_other_expenses'])){echo $estimate_details['estimate_other_expenses'];}else{echo "0";}?>">
                                    </td>
                                </tr>
                            <?php } else { ?>
                                <input type="hidden" name="estimate_other_expenses" id="estimate_other_expenses" class="form-control" value="0">
                            <?php } ?>
                            <?php  if($this->common->get_particular('mst_general_settings',array('general_settings_name' => 'transport_charges'),'general_settings_value')== 1){ ?>
                                <tr>
                                    <td colspan="6"><strong>TRANSPORT CHARGES:</strong></td>
                                    <td colspan="6"><input type="text" name="estimate_transportaion_charges" id="estimate_transportaion_charges" class="form-control" value="<?php if(isset($estimate_details['estimate_transportaion_charges'])){echo $estimate_details['estimate_transportaion_charges'];}else{echo "0";}?>"></td>
                                </tr>
                            <?php } else { ?>
                                <input type="hidden" name="estimate_transportaion_charges" id="estimate_transportaion_charges" class="form-control" value="0">
                            <?php } ?>
                            <?php  if($this->common->get_particular('mst_general_settings',array('general_settings_name' => 'loading_unloading_charges'),'general_settings_value')== 1){ ?>
                               <tr>
                                <td colspan="6"><strong>LOADING / UNLOADING CHARGES:</strong></td>
                                <td colspan="6"><input type="text" name="estimate_loading_charges" id="estimate_loading_charges" class="form-control" value="<?php if(isset($estimate_details['estimate_loading_charges'])){echo $estimate_details['estimate_loading_charges'];}else{echo "0";}?>"></td>
                            </tr>
                        <?php } else { ?>
                            <input type="hidden" name="estimate_loading_charges" id="estimate_loading_charges" class="form-control" value="0">
                        <?php } ?>
                        <?php  if($this->common->get_particular('mst_general_settings',array('general_settings_name' => 'bundle'),'general_settings_value')== 1){ ?>
                         <tr>
                            <td colspan="6"><strong>TOTAL BUNDLE:</strong></td>
                            <td colspan="6">
                                <input type="text" name="total_bundle" id="total_bundle" class="form-control" value="<?php if(isset($estimate_details['total_bundle'])){echo $estimate_details['total_bundle'];}else{echo "0";}?>">
                            </td>
                        </tr>
                    <?php } else { ?>
                        <input type="hidden" name="total_bundle" id="total_bundle" class="form-control" value="0">
                    <?php } ?>
                    <?php  if($this->common->get_particular('mst_general_settings',array('general_settings_name' => 'date_of_supply'),'general_settings_value')== 1){ ?>
                     <tr>
                        <td colspan="6"><strong>REVERSE CHARGE (Y/N):</strong></td>
                        <td colspan="6">
                            <input type="text" name="reverse_charge" id="reverse_charge" class="form-control" value="<?php if(isset($estimate_details['reverse_charge'])){echo $estimate_details['reverse_charge'];}else{echo "Y/N";}?>">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6"><strong>DATE OF SUPPLY:</strong></td>
                        <td colspan="6">
                            <input type="text" name="date_of_supply" id="date_of_supply" class="form-control" value="<?php if(isset($estimate_details)){ echo date('Y-m-d',strtotime($estimate_details['date_of_supply'])); }else{ echo date('d-m-Y'); } ?>">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6"><strong>PLACE OF SUPPLY:</strong></td>
                        <td colspan="6">
                            <input type="text" name="place_of_supply" id="place_of_supply" class="form-control" value="<?php if(isset($estimate_details['place_of_supply'])){echo $estimate_details['place_of_supply'];}?>">
                        </td>
                    </tr>
                <?php } ?>
                <tr>
                    <td colspan="6"><strong>TOTAL</strong></td>
                    <td colspan="6"><input type="text" name="total" id="estimate_total" class="form-control" value="<?php if(isset($final_total)){ echo $final_total; }else{ echo "0"; } ?>" readonly=""></td>
                </tr>
            </tbody>
        </table>
        <div class="form-actions col-md-12">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <a href="<?php echo base_url('estimate_list'); ?>" class="btn btn-dark">CANCEL</a>
                    </div>
                    <div class="col-md-6 ">
                        <button type="submit" class="btn btn-success float-right"> <i class="fa fa-check"></i> <?php if(isset($estimate_details)){ echo "UPDATE"; }else{ echo "CREATE"; } ?></button>
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
