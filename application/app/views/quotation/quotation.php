<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18"><?php if(isset($quotation_details)){ echo 'EDIT'; }else{ echo 'NEW'; } ?> QUOTATION</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Quotation</a></li>
                                <li class="breadcrumb-item active">Add Quotation</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 message"><?php message(); ?></div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <form method="post" id="quotation_form">
                            <!-- GENERAL DETAILS -->
                            <div class="form-body">
                                <div class="card-body"> 
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <input type="hidden" class="form-control" name="prefix_value" id="prefix_value" value="quotation_no">
                                                <?php if($this->common->get_particular('mst_general_settings',array('general_settings_name' => 'multiple_company'),'general_settings_value')==1){?> 
                                                    <div class="form-group col-md-3">
                                                        <label class="control-label">SELECT COMPANY</label>
                                                        <select id="company_id" name="company_id" class="form-control form-control-danger">
                                                            <option value="">SELECT COMPANY</option>
                                                            <?php if(isset($quotation_details)) { ?> 
                                                                <option value='<?php $company_id = $this->common->get_particular('company_details',array('company_name' => $company_list),'company_id'); echo $company_lists; ?>'><?php echo $company_lists; ?></option>";
                                                            <?php }else{ ?> 
                                                             <?php foreach ($company_lists as $key => $company_list) { ?>
                                                                echo "
                                                                <option value='<?php $company_id = $this->common->get_particular('company_details',array('company_name' => $company_list),'company_id'); echo $company_id; ?>'><?php echo $company_list; ?></option>";
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            <?php }else{ ?>
                                                <input type="hidden" name="company_id" id="company_id" class="form-control" value="<?php if(isset($quotation_details)){ echo $quotation_details['company_id']; }else{ echo $this->session->userdata['company_id']; } ?>" readonly >
                                            <?php } ?>
                                            <div class="form-group col-md-3">
                                                <label class="control-label">QUOTATION NUMBER</label>
                                                <input type="text" name="quotation_number" id="quotation_number" class="form-control" placeholder="QUOTATION NUMBER" value="<?php if(isset($quotation_details)){ echo $quotation_details['quotation_number']; }else{ echo $quotation_number; } ?>" readonly >
                                            </div> 
                                            <div class="form-group col-md-2">
                                                <label class="control-label">DATE</label>
                                                <input type="date" name="quotation_date" id="quotation_date" class="form-control form-control-danger" placeholder="DATE" value="<?php if(isset($quotation_details)){ echo date('Y-m-d',strtotime($quotation_details['quotation_date'])); }else{ echo date('Y-m-d'); } ?>">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label class="control-label">CUSTOMER</label>
                                                <select id="quotation_customer" name="quotation_customer" class="form-control form-control-danger select2">
                                                    <?php echo $customers; ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-1">
                                                <label class="control-label col-lg-12">&nbsp;</label>
                                                <a href="<?php echo base_url('customer/customer_popup'); ?>" class="btn btn-primary add_customer" data-toggle="modal" data-target="#responsive-modal"><i class="fa fa-plus">&nbsp;</i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row  quotation_product_list" style="<?php //if(isset($quotation_details)){ echo'display: block;';}else{ echo'display: none;'; } ?>">
                                    <div class="col-md-12">
                                      <h4 class="card-title m-t-20">QUOTATION PRODUCTS</h4>
                                  </div>
                                  <hr>
                                  <div class="card-body">
                                    <div class="row" style="margin-bottom: 20px;">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="form-group col-md-3">
                                                    <label class="control-label">PRODUCT</label>
                                                    <select class="form-control select2" name="quotation_product" id="quotation_product">
                                                        <?php product();?>
                                                    </select>
                                                </div>
                                                <?php if($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')== 1) { ?>
                                                    <div class="form-group col-md-2">
                                                        <label class="control-label">BRAND</label>
                                                        <input type="text" name="quotation_brand" id="quotation_brand" class="form-control" readonly="">
                                                    </div>
                                                <?php } ?>
                                                <div class="form-group col-md-2">
                                                    <label class="control-label">RATE</label>
                                                    <input type="text" name="quotation_rate" id="quotation_rate" class="form-control" >
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label class="control-label">QUANTITY</label>
                                                    <input type="text" name="quotation_quantity" id="quotation_quantity" class="form-control" >
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label class="control-label">AMOUNT</label>
                                                    <input type="text" name="quotation_amount" id="quotation_amount" class="form-control" onselect="$(this).select();">
                                                </div>
                                                <div class="form-group col-md-1">
                                                    <label class="control-label" style="width: 100%;">&nbsp;</label>
                                                    <a class="btn btn-primary form-control new_quotation_add"  style="color:white;width: 50px;"><i class="fa fa-plus" style="color:white;"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" id="stock_content">
                                    </div>
                                </div>
                                <div class="card-body col-md-12">
                                    <div class="table-responsive m-t-20">
                                        <table class="table table-bordered table-responsive-lg">
                                            <thead>
                                                <tr>
                                                    <th scope="col">S.NO</th>
                                                    <th scope="col">PRODUCT NAME</th>
                                                    <?php if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')== 1)){ ?>
                                                        <th scope="col">BRAND NAME</th>
                                                    <?php } ?>
                                                    <?php if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_category'),'product_settings_value')== 1)){ ?>
                                                        <th scope="col">CATEGORY NAME</th>
                                                    <?php } ?> 
                                                    <?php if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_subcategory'),'product_settings_value')== 1)){ ?>
                                                        <th scope="col">SUB CATEGORY NAME</th>
                                                    <?php } ?>
                                                    <th scope="col">QUANTITY</th>
                                                    <th scope="col">RATE</th>
                                                    <?php  if($this->common->get_particular('mst_quotation_settings',array('quotation_settings_name' => 'quotation_tax_included'),'quotation_settings_value')== 1){ ?>
                                                        <th scope="col">TAX %</th>
                                                    <?php } ?>
                                                    <th scope="col">AMOUNT</th>
                                                    <th scope="col">ACTION</th>
                                                </tr>
                                            </thead>
                                            <tbody class="listings">
                                                <?php if(isset($temp_products)){
                                                    echo $temp_products;
                                                }else{
                                                    echo '<tr><td colspan="8">NO PRODUCTS ADDED</td></tr>';
                                                } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="form-actions col-md-12">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <a href="<?php echo base_url('quotation_list'); ?>" class="btn btn-dark">CANCEL</a>
                                            </div>
                                            <div class="col-md-6 ">
                                                <button type="submit" class="btn btn-success float-right"> <i class="fa fa-check"></i> <?php if(isset($quotation_details)){ echo "UPDATE"; }else{ echo "CREATE"; } ?></button>
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
