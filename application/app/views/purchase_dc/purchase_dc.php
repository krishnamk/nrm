<div class="main-content">
    <div class="page-content">
        <div class="container-fluid"> 
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18"><?php echo 'NEW'; ?> PURCHASE DC ORDER</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Purchase Dc Order</a></li>
                                <li class="breadcrumb-item active">Add Purchase Dc</li>
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
                        <form method="post" id="purchase_dc_form">
                            <!-- GENERAL DETAILS -->
                            <div class="form-body">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <input type="hidden" class="form-control" name="prefix_value" id="prefix_value" value="purchase_dc_no">
                                                <?php if($this->common->get_particular('mst_general_settings',array('general_settings_name' => 'multiple_company'),'general_settings_value')==1){?>
                                                    <?php if($this->session->userdata('access_level') <= 2) {  ?>
                                                        <div class="form-group col-md-3">
                                                            <label class="control-label">SELECT COMPANY</label>
                                                            <select id="company_id" name="company_id" class="form-control form-control-danger">
                                                                <option value="">SELECT COMPANY</option>
                                                                <?php if(isset($purchase_dc_details)) { ?>  <option value='<?php $company_id = $this->common->get_particular('company_details',array('company_name' => $company_list),'company_id'); echo $company_lists; ?>'><?php echo $company_lists; ?></option>";
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
                                            <input type="hidden" name="company_id" id="company_id" class="form-control" value="<?php if(isset($purchase_dc_details)){ echo $purchase_dc_details['company_id']; }else{ echo $this->session->userdata['company_id']; } ?>" readonly >
                                        <?php } ?>
                                        <div class="form-group col-md-2">
                                            <label class="control-label">PURCHASE DC NUMBER</label>
                                            <input type="text" name="purchase_dc_number" id="purchase_dc_number" class="form-control" placeholder="PURCHASE NUMBER" value="<?php if($purchase_dc_number!=""){echo $purchase_dc_number;}else{echo $purchase_dc_number;} ?>" readonly >
                                        </div> 
                                        <div class="form-group col-md-2">
                                            <label class="control-label">DATE</label>
                                            <input type="date" name="purchase_dc_date" id="purchase_dc_date" class="form-control form-control-danger" placeholder="DATE" value="<?php if(isset($purchase_dc_details)){echo $purchase_dc_details['purchase_dc_date'];}else{echo date('Y-m-d');} ?>">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label class="control-label">DC NO</label>
                                            <input type="text" name="purchase_dc_no" id="purchase_dc_no" class="form-control" value="<?php if(isset($purchase_dc_details['purchase_dc_no'])){echo $purchase_dc_details['purchase_dc_no'];}?>">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label class="control-label">REF NO</label>
                                            <input type="text" name="purchase_dc_ref_no" id="purchase_dc_ref_no" class="form-control" value="<?php if(isset($purchase_dc_details['purchase_dc_ref_no'])){echo $purchase_dc_details['purchase_dc_ref_no'];}?>">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label class="control-label">SUPPLIER</label>
                                            <select id="purchase_dc_supplier" name="purchase_dc_supplier" class="form-control form-control-danger select2">
                                                <?php echo $suppliers; ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-1">
                                            <label class="control-label col-lg-12">&nbsp;</label>
                                            <a class="btn btn-primary add_supplier" href="#" alt="default" data-toggle="modal" data-target="#responsive-modal"  ><i class="fa fa-plus"></i></a>
                                        </div> 
                                        <?php if($this->common->get_particular('mst_purchase_settings',array('purchase_settings_name' => 'purchase_stock_add'),'purchase_settings_value')==1){?>
                                            <div class="form-group col-md-1">
                                                <label class="control-label col-lg-12">&nbsp;</label>
                                                <input type="text" name="product_stock_add" id="product_stock_add" class="form-control" value="1" hidden>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row  purchase_dc_product_list" style="<?php //if(isset($purchase_details)){ echo'display: block;';}else{ echo'display: none;'; } ?>">
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
                                                <select class="form-control select2" name="purchase_dc_product" id="purchase_dc_product">
                                                    <?php purchase_product();?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-1">
                                                <label class="control-label col-lg-12">&nbsp;</label>
                                                <a class="btn btn-primary add_product" href="#" alt="default" data-toggle="modal" data-target="#responsive-modal"  ><i class="fa fa-plus"></i></a>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label class="control-label">PRODUCT DESCRIPTION</label>
                                                <input type="text" name="purchase_dc_desc" id="purchase_dc_desc" class="form-control" >
                                            </div>
                                            <?php if($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')== 1) { ?>
                                                <div class="form-group col-md-2">
                                                    <label class="control-label">BRAND</label>
                                                    <input type="text" name="purchase_dc_brand" id="purchase_dc_brand" class="form-control" >
                                                </div>
                                            <?php } ?>
                                            <div class="form-group col-md-2">
                                                <label class="control-label">QUANTITY</label>
                                                <input type="text" name="purchase_dc_quantity" id="purchase_dc_quantity" class="form-control" >
                                            </div>
                                            <div class="form-group col-md-1">
                                                <label class="control-label" style="width: 100%;">&nbsp;</label>
                                                <a class="btn btn-primary form-control new_purchase_dc_add"  style="color:white;width: 50px;"><i class="fa fa-plus" style="color:white;"></i></a>
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
                                                <th scope="col">DESCRIPTION</th>
                                                <?php if($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')== 1) { ?>
                                                    <th scope="col">BRAND NAME</th>
                                                <?php } ?>
                                                <th scope="col">QUANTITY</th>
                                                <th scope="col">ACTION</th>
                                            </tr>
                                        </thead>
                                        <tbody class="listings">
                                            <?php if(isset($temp_products)){
                                                echo $temp_products;
                                            }else{
                                                echo '<tr><td colspan="7">NO PRODUCTS ADDED</td></tr>';
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="form-actions col-md-12">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <a href="<?php echo base_url('purchase_dc'); ?>" class="btn btn-dark">CANCEL</a>
                                        </div>
                                        <div class="col-md-6 ">
                                            <button type="submit" class="btn btn-success float-right"> <i class="fa fa-check"></i> <?php echo "CREATE"; ?></button>
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