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
                    <!-- <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18"><?php if(isset($purchase_details)){ echo 'EDIT'; }else{ echo 'NEW'; } ?> PURCHASE</h4>
                        <?php if(empty($purchase_details)){ ?>
                            <div class="page-title-right">
                                <div class="button-items" style="text-align: right;">
                                    <?php if($this->common->get_particular('mst_sub_modules',array('sub_module_name' => 'Purchase DC'),'status')== 1) { ?> 
                                        <a href="<?php echo base_url('change_purchase_setting/'."1");?>" class="btn btn-success waves-effect waves-light"><i class="bx bxs-comment-add font-size-16 align-middle mr-2"></i>Direct Purchase</a>
                                    <?php } else { ?>
                                        <a href="<?php echo base_url('change_purchase_setting/'."2");?>" class="btn btn-primary waves-effect waves-light"><i class="bx bxs-comment-add font-size-16 align-middle mr-2"></i>DC to Purchase</a>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div> -->
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 message"><?php message(); ?></div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <form method="post" id="purchase_form">
                            <!-- GENERAL DETAILS -->
                            <div class="form-body">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <input type="hidden" class="form-control" name="prefix_value" id="prefix_value" value="purchase_no">
                                                <?php if($this->common->get_particular('mst_general_settings',array('general_settings_name' => 'multiple_company'),'general_settings_value')==1){?>
                                                    <?php if($this->session->userdata('access_level') <= 2) {  ?>
                                                        <div class="form-group col-md-3">
                                                            <label class="control-label">SELECT COMPANY</label>
                                                            <select id="company_id" name="company_id" class="form-control form-control-danger">
                                                                <option value="">SELECT COMPANY</option>
                                                                <?php if(isset($purchase_details)) { ?>  <option value='<?php $company_id = $this->common->get_particular('company_details',array('company_name' => $company_list),'company_id'); echo $company_lists; ?>'><?php echo $company_lists; ?></option>";
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
                                            <input type="hidden" name="company_id" id="company_id" class="form-control" value="<?php if(isset($purchase_details)){ echo $purchase_details['company_id']; }else{ echo $this->session->userdata['company_id']; } ?>" readonly >
                                        <?php } ?>
                                        <div class="form-group col-md-2">
                                            <label class="control-label">PURCHASE NUMBER</label>
                                            <input type="text" name="purchase_number" id="purchase_number" class="form-control" placeholder="PURCHASE NUMBER" value="<?php if(isset($purchase_details)){ echo $purchase_details['purchase_number']; }else{ echo $purchase_number; } ?>" readonly >
                                        </div> 
                                        <div class="form-group col-md-2">
                                            <label class="control-label">DATE</label>
                                            <input type="date" name="purchase_date" id="purchase_date" class="form-control form-control-danger" placeholder="DATE" value="<?php if(isset($purchase_details)){ echo date('Y-m-d',strtotime($purchase_details['purchase_date'])); }else{ echo date('Y-m-d'); } ?>">
                                        </div>
                                        <div class="form-group col-md-1">
                                            <label class="control-label">BILL NO</label>
                                            <input type="text" name="purchase_bill_no" id="purchase_bill_no" class="form-control"value="<?php if(isset($purchase_details)){ echo $purchase_details['purchase_bill_no']; } ?>">
                                        </div>
                                        
                                        <?php if($this->common->get_particular('mst_settings',array('settings_name' => 'purchase_tax_type_show'),'settings_value')==1){?>
                                            <div class="form-group col-md-3">
                                                <label class="control-label">TAX TYPE</label>
                                                <div class="row">
                                                    <div class="btn-group" data-toggle="buttons">
                                                        <label class="btn btn-primary <?php if($this->common->get_particular('mst_settings',array('settings_name' => 'purchase_tax_type' ),'settings_value') == 2){ echo 'active'; } ?>">
                                                            <div class="custom-control custom-radio">
                                                                <input type="radio" id="customRadio5" name="tax_type" class="custom-control-input" <?php if($this->common->get_particular('mst_settings',array('settings_name' => 'purchase_tax_type' ),'settings_value') == 2){ echo 'checked'; } ?> value="2">
                                                                <label class="custom-control-label" for="customRadio5">EXCLUSIVE</label>
                                                            </div>
                                                        </label>
                                                    </div>
                                                    <div class="btn-group" data-toggle="buttons">
                                                        <label class="btn btn-primary <?php if($this->common->get_particular('mst_settings',array('settings_name' => 'purchase_tax_type' ),'settings_value') == 1){ echo 'active'; } ?>">
                                                            <div class="custom-control custom-radio">
                                                                <input type="radio" id="customRadio5" name="tax_type" class="custom-control-input" <?php if($this->common->get_particular('mst_settings',array('settings_name' => 'purchase_tax_type' ),'settings_value') == 1){ echo 'checked'; } ?> value="1">
                                                                <label class="custom-control-label" for="customRadio5">INCLUSIVE</label>
                                                            </div>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } else{?>
                                <?php if($this->common->get_particular('mst_settings',array('settings_name' => 'purchase_tax_type' ),'settings_value') == 1){ ?>
                                    <input type="hidden" name="tax_type" id="tax_type" value="1">
                                <?php } else { ?> 
                                 <input type="hidden" name="tax_type" id="tax_type" value="2">
                             <?php } ?>
                         <?php } ?>

                         <?php if($this->common->get_particular('mst_settings',array('settings_name' => 'purchase_tax_type' ),'settings_value') == 1){ ?>
                             <input type="hidden" name="tax_included" value="1" class="form-control" >
                         <?php }else{ ?>
                             <input type="hidden" name="tax_included" value="0" class="form-control" >
                         <?php } ?>

                         <?php if($this->common->get_particular('mst_purchase_settings',array('purchase_settings_name' => 'purchase_dc'),'purchase_settings_value')==1){?>
                           <div class="form-group col-md-3">
                            <label class="control-label">SUPPLIER</label>
                            <select id="purchase_supplier" name="purchase_supplier" class="form-control select2">
                                <?php echo $suppliers; ?>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">DC NO</label>
                            <select id="purchase_dc_no" name="purchase_dc_no[]" class="form-control select2" multiple="multiple" onselect="$(this).select">
                               <?php if(isset($dc_no)){ echo $dc_no; } ?> 
                           </select>
                       </div>
                       <div class="form-group col-md-1">
                        <label class="control-label col-lg-12">&nbsp;</label>
                        <input type="hidden" name="removed_rows" id="removed_rows" value="">
                        <a class="btn btn-primary add_purchase_dc_new" id="add_purchase_dc_new" data-id="<?php if(isset($total_products)){ echo $total_products; } ?>" data-toggle="tooltip" data-placement="top" title="ADD PRODUCT"><i class="fa fa-plus">&nbsp;</i></a>
                    </div>
                <?php } else{ ?>
                    <div class="form-group col-md-2">
                        <label class="control-label">REF NO</label>
                        <input type="text" name="purchase_ref_no" id="purchase_ref_no" class="form-control" value="<?php if(isset($purchase_details)){ echo $purchase_details['purchase_ref_no']; } ?>">
                    </div>
                    <div class="form-group col-md-3">
                        <label class="control-label">SUPPLIER</label>
                        <select id="purchase_supplier" name="purchase_supplier" class="form-control select2">
                            <?php echo $suppliers; ?>
                        </select>
                    </div>
                <?php } ?>
                <?php if($this->common->get_particular('mst_purchase_settings',array('purchase_settings_name' => 'purchase_stock_add'),'purchase_settings_value')==1){?>
                    <div class="form-group col-md-1">
                        <label class="control-label col-lg-12">&nbsp;</label>
                        <input type="text" name="product_stock_add" id="product_stock_add" class="form-control" value="1" hidden>
                    </div>
                <?php }?>
            </div>
        </div>
    </div>
    <hr>
    <div class="row  purchase_product_list" style="<?php //if(isset($purchase_details)){ echo'display: block;';}else{ echo'display: none;'; } ?>">
        <?php if($this->common->get_particular('mst_purchase_settings',array('purchase_settings_name' => 'purchase_dc'),'purchase_settings_value')==0) { ?> 
           <div class="col-md-12">
              <h4 class="card-title m-t-20">PURCHASE ORDER PRODUCTS</h4>
          </div>
          <hr>
          <div class="card-body">
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-md-12">
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label class="control-label">PRODUCT</label>
                            <select class="form-control select2" name="purchase_product" id="purchase_product">
                                <?php purchase_product();?>
                            </select>
                        </div>
                        <!-- <?php if($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')== 1) { ?>
                            <div class="form-group col-md-2">
                                <label class="control-label">BRAND</label>
                                <input type="text" name="brand_name" id="purchase_brand" class="form-control" readonly="">
                            </div>
                        <?php } ?> -->
                        <?php if($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_category'),'product_settings_value')== 1) { ?>
                            <div class="form-group col-md-2">
                                <label class="control-label">CATEGORY</label>
                                <input type="text" name="category_name" id="purchase_category" class="form-control" readonly="">
                            </div>
                        <?php } ?>
                        <div class="form-group col-md-1">
                            <label class="control-label">QUANTITY</label>
                            <input type="text" name="quantity" id="purchase_quantity" class="form-control" >
                        </div>
                        <div class="form-group col-md-1">
                            <label class="control-label">RATE</label>
                            <input type="text" name="rate" id="purchase_rate" class="form-control" >
                        </div>
                        <?php if($this->common->get_particular('mst_purchase_settings',array('purchase_settings_name' => 'purchase_tax_included'),'purchase_settings_value')==1) { ?>
                         <div class="form-group col-md-1">
                            <label class="control-label">TAX %</label>
                            <select class="form-control" name="tax_id" id="purchase_with_tax_id">
                                <?php tax();?>
                            </select>
                            <input type="hidden" name="tax_percent" id="tax_percent" class="form-control" >
                        </div>
                        <div class="form-group col-md-1">
                            <label class="control-label">TAX</label>
                            <input type="text" name="tax_total" id="tax_total" class="form-control" >
                        </div> 
                    <?php } ?> 
                    <div class="form-group col-md-2">
                        <label class="control-label">TOTAL</label>
                        <input type="text" name="total" id="purchase_total" class="form-control" onselect="$(this).select();">
                    </div>
                    <div class="form-group col-md-1">
                        <label class="control-label" style="width: 100%;">&nbsp;</label>
                        <?php if($this->common->get_particular('mst_purchase_settings',array('purchase_settings_name' => 'purchase_tax_included'),'purchase_settings_value')==1) { ?>
                            <a class="btn btn-primary form-control new_purchase_add_withtax"  style="color:white;width: 50px;"><i class="fa fa-plus" style="color:white;"></i></a>
                        <?php } else { ?> 
                            <a class="btn btn-primary form-control new_purchase_add"  style="color:white;width: 50px;"><i class="fa fa-plus" style="color:white;"></i></a>
                        <?php } ?>
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
                    <?php if($this->common->get_particular('mst_purchase_settings',array('purchase_settings_name' => 'purchase_dc'),'purchase_settings_value')==1) { ?> 
                        <th scope="col" class="style=width:10px;">DC NO</th>
                    <?php } ?>
                    <th scope="col" class="style=width:60px;">PRODUCT NAME</th>
                    <!-- <?php if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')== 1)){ ?>
                        <th scope="col">BRAND NAME</th>
                    <?php } ?> -->
                    <?php if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_category'),'product_settings_value')== 1)){ ?>
                        <th scope="col">CATEGORY NAME</th>
                    <?php } ?>
                    <th scope="col">QUANTITY</th>
                    <th scope="col">RATE</th>
                    <th scope="col">AMOUNT</th>
                    <?php if($this->common->get_particular('mst_purchase_settings',array('purchase_settings_name' => 'purchase_tax_included'),'purchase_settings_value')==1) { ?>
                        <th scope="col">TAX %</th>
                        <th scope="col">TAX</th>
                        <th scope="col">TOTAL</th>
                    <?php } ?>
                    <th scope="col">ACTION</th>
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
<div class="form-actions col-md-12">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <a href="<?php echo base_url('purchase_list'); ?>" class="btn btn-dark">CANCEL</a>
            </div>
            <div class="col-md-6 ">
                <button type="submit" class="btn btn-success float-right"> <i class="fa fa-check"></i> <?php if(isset($purchase_details)){ echo "UPDATE"; }else{ echo "CREATE"; } ?></button>
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