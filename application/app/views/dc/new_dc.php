<div class="main-content"> 
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18"><?php echo 'NEW'; ?> DELIVERY CHALLAN</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                <li class="breadcrumb-item active">Dc</li>
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
                        <form method="post" id="dc_form">
                            <!-- GENERAL DETAILS -->
                            <div class="form-body">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <input type="hidden" class="form-control" name="prefix_value" id="prefix_value" value="dc_no">
                                                <?php if($this->common->get_particular('mst_general_settings',array('general_settings_name' => 'multiple_company'),'general_settings_value')==1){?>
                                                    <?php if($this->session->userdata('access_level') <= 2) {  ?>
                                                        <div class="form-group col-md-3">
                                                            <label class="control-label">SELECT COMPANY</label>
                                                            <select id="company_id" name="company_id" class="form-control form-control-danger">
                                                                <option value="">SELECT COMPANY</option>
                                                                <?php if(isset($dc_details)) { ?>  <option value='<?php $company_id = $this->common->get_particular('company_details',array('company_name' => $company_list),'company_id'); echo $company_lists; ?>'><?php echo $company_lists; ?></option>";
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
                                            <input type="hidden" name="company_id" id="company_id" class="form-control" value="<?php if(isset($dc_details)){ echo $dc_details['company_id']; }else{ echo $this->session->userdata['company_id']; } ?>" readonly >
                                        <?php } ?>
                                        <?php if($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'multiple_estimate_to_dc_generate'),'estimate_settings_value') == 1) { ?> 
                                            <div class="form-group col-md-2">
                                                <label class="control-label">DC NUMBER</label>
                                                <input type="text" name="dc_number" id="dc_number" class="form-control" placeholder="DC NUMBER" value="<?php if(isset($dc_details['dc_number'])){echo $dc_details['dc_number'];}else{echo $dc_number;} ?>" readonly >
                                            </div> 
                                            <div class="form-group col-md-2">
                                                <label class="control-label">DATE</label>
                                                <input type="date" name="dc_date" id="dc_date" class="form-control form-control-danger" placeholder="DATE" value="<?php if(isset($dc_details)){echo $dc_details['dc_date'];}else{echo date('Y-m-d');} ?>">
                                            </div>
                                            <div class="form-group col-md-1">
                                                <label class="control-label">REF NO</label>
                                                <input type="text" name="ref_no" id="ref_no" class="form-control" value="<?php if(isset($dc_details['ref_no'])){echo $dc_details['ref_no'];}?>">
                                            </div>
                                        <?php } else { ?> 
                                            <div class="form-group col-md-2">
                                                <label class="control-label">DC NUMBER</label>
                                                <input type="text" name="dc_number" id="dc_number" class="form-control" placeholder="DC NUMBER" value="<?php if(isset($dc_details['dc_number'])){echo $dc_details['dc_number'];}else{echo $dc_number;} ?>" readonly >
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label class="control-label">DATE</label>
                                                <input type="date" name="dc_date" id="dc_date" class="form-control form-control-danger" placeholder="DATE" value="<?php if(isset($dc_details)){echo $dc_details['dc_date'];}else{echo date('Y-m-d');} ?>">
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label class="control-label">REF NO</label>
                                                <input type="text" name="ref_no" id="ref_no" class="form-control" value="<?php if(isset($dc_details['ref_no'])){echo $dc_details['ref_no'];}?>">
                                            </div>
                                        <?php } ?>
                                        <?php if($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'multiple_estimate_to_dc_generate'),'estimate_settings_value') == 1) { ?> 
                                            <div class="form-group col-md-2">
                                                <label class="control-label">CUSTOMER</label>
                                                <select id="dc_customer" name="dc_customer" class="form-control form-control-danger select2">
                                                    <?php echo $customers; ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-1">
                                                <label class="control-label col-lg-12">&nbsp;</label>
                                                <a class="btn btn-primary add_customer" href="#" alt="default" data-toggle="modal" data-target="#responsive-modal"  ><i class="fa fa-plus"></i></a>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label class="control-label">ESTIMATE NO</label>
                                                <select id="estimate_no" name="estimate_no[]" class="form-control select2" multiple="multiple" onselect="$(this).select">
                                                 <?php if(isset($estimate_no)){ echo $estimate_no; } ?> 
                                             </select>
                                         </div> 
                                     <?php } else{ ?>
                                        <div class="form-group col-md-3">
                                            <label class="control-label">CUSTOMER</label>
                                            <select id="dc_customer" name="dc_customer" class="form-control form-control-danger select2">
                                                <?php echo $customers; ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-1">
                                            <label class="control-label col-lg-12">&nbsp;</label>
                                            <a class="btn btn-primary add_customer" href="#" alt="default" data-toggle="modal" data-target="#responsive-modal"  ><i class="fa fa-plus"></i></a>
                                        </div> 
                                    <?php } ?>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label class="control-label">TRANSPORT MODE</label>
                                        <select id="transport_mode" name="transport_mode" class="form-control form-control-danger">
                                            <?php if(isset($dc_details)){ echo transport_mode_options($dc_details['transport_mode']); }else{ echo transport_mode_options($this->common->get_particular('mst_settings',array('settings_name' => 'default_transport_mode'),'settings_value' )); } ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="control-label">TRANSPORT NAME</label>
                                        <input type="text" name="transport_name" id="transport_name" class="form-control" placeholder="ENTER TRANSPORT NAME" value="<?php if(isset($dc_details)){ echo $dc_details['transport_name']; }else{ echo $this->common->get_particular('mst_settings',array('settings_name' => 'default_transport_name'),'settings_value' ); }
                                    ?>">
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="control-label">TRANSPORT VECHILE NO</label>
                                    <input type="text" id="transport_vechile_no" name="transport_vechile_no" class="form-control form-control-danger" value="<?php if(isset($dc_details)){ echo $dc_details['transport_vechile_no']; } ?>">
                                </div>

                            </div>
                        </div>
                    </div>
                    <hr>
                    <?php if($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'multiple_estimate_to_dc_generate'),'estimate_settings_value') != 1) { ?> 
                        <div class="row  dc_product_list" style="<?php //if(isset($purchase_details)){ echo'display: block;';}else{ echo'display: none;'; } ?>">
                            <div class="col-md-12">
                              <h4 class="card-title m-t-20">DC ORDER PRODUCTS</h4>
                          </div>
                          <hr>
                          <div class="card-body">
                            <div class="row" style="margin-bottom: 20px;">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <label class="control-label">PRODUCT</label>
                                            <select class="form-control select2" name="dc_product" id="dc_product">
                                                <?php product();?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-1">
                                            <label class="control-label col-lg-12">&nbsp;</label>
                                            <a class="btn btn-primary add_product" href="#" alt="default" data-toggle="modal" data-target="#responsive-modal"  ><i class="fa fa-plus"></i></a>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label class="control-label">PRODUCT DESCRIPTION</label>
                                            <input type="text" name="dc_desc" id="dc_desc" class="form-control" >
                                        </div>
                                        <?php if($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')== 1) { ?>
                                            <div class="form-group col-md-2">
                                                <label class="control-label">BRAND</label>
                                                <input type="text" name="dc_brand" id="dc_brand" class="form-control" >
                                            </div>
                                        <?php } ?>
                                        <div class="form-group col-md-2">
                                            <label class="control-label">QUANTITY</label>
                                            <input type="text" name="dc_quantity" id="dc_quantity" class="form-control" >
                                        </div>
                                        <div class="form-group col-md-1">
                                            <label class="control-label" style="width: 100%;">&nbsp;</label>
                                            <a class="btn btn-primary form-control new_dc_add"  style="color:white;width: 50px;"><i class="fa fa-plus" style="color:white;"></i></a>
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
                                        <th scope="col">DESCRIPTION</th>
                                        <?php if($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')== 1) { ?>
                                            <th scope="col">BRAND NAME</th>
                                        <?php } ?>
                                        <?php if($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_category'),'product_settings_value')== 1) { ?>
                                            <th scope="col">CATEGORY NAME</th>
                                        <?php } ?>
                                        <?php if($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_subcategory'),'product_settings_value')== 1) { ?>
                                            <th scope="col">SUB CATEGORY NAME</th>
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
                                    <a href="<?php echo base_url('dc'); ?>" class="btn btn-dark">CANCEL</a>
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