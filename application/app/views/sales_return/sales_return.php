<div class="main-content">  
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 message"><?php message(); ?></div>
            </div>
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="page-title"><?php if(isset($sales_return_details)){ echo "SALES RETURN EDIT"; }else{ echo "SALES RETURN"; } ?></h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <form method="post" id="return_form">
                            <!-- GENERAL DETAILS -->
                            <div class="form-body">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <input type="hidden" class="form-control" name="prefix_value" id="prefix_value" value="sales_return_no">
                                                <?php if($this->common->get_particular('mst_general_settings',array('general_settings_name' => 'multiple_company'),'general_settings_value')==1){?>
                                                    <?php if($this->session->userdata('access_level') <= 2) {  ?>
                                                        <div class="form-group col-md-3">
                                                            <label class="control-label">SELECT COMPANY</label>
                                                            <select id="company_id" name="company_id" class="form-control form-control-danger">
                                                                <option value="">SELECT COMPANY</option>
                                                                <?php if(isset($sales_return_details)) { ?>  <option value='<?php $company_id = $this->common->get_particular('company_details',array('company_name' => $company_list),'company_id'); echo $company_lists; ?>'><?php echo $company_lists; ?></option>";
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
                                            <input type="hidden" name="company_id" id="company_id" class="form-control" value="<?php if(isset($sales_return_details)){ echo $sales_return_details['company_id']; }else{ echo $this->session->userdata['company_id']; } ?>" readonly >
                                        <?php } ?>
                                        <div class="form-group col-md-2">
                                            <label class="control-label">SALES RETURN NO</label>
                                            <input type="text" name="sales_return_number" id="sales_return_number" class="form-control" placeholder="RETURN NUMBER" value="<?php if(isset($sales_return_details)){ echo $sales_return_details['sales_return_number']; }else{ echo $sales_return_number; } ?>">
                                        </div> 
                                        <div class="form-group col-md-2">
                                            <label class="control-label">DATE</label>
                                            <input type="date" name="sales_return_date" id="sales_return_date" class="form-control form-control-danger" placeholder="DATE" value="<?php if(isset($sales_return_details)){ echo date('Y-m-d',strtotime($sales_return_details['sales_return_date'])); }else{ echo date('Y-m-d'); } ?>">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label class="control-label">CUSTOMERS</label>
                                            <select id="sales_return_customer" name="sales_return_customer" class="form-control form-control-danger">
                                                <?php echo $customers; ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">
                                           <label class="control-label">SALES BILL NO</label>
                                           <select id="sales_return_invoice_id" name="sales_return_invoice_id" class="form-control form-control-danger">
                                            <?php if(isset($sales_return_details)){ echo $sales_bills; } ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="control-label">REMARKS</label>
                                        <textarea class="form-control" name="sales_return_remarks" id="sales_return_remarks"><?php if(isset($sales_return_details)){ echo $sales_return_details['sales_return_remarks']; } ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-body sales_return_product" style="<?php if(isset($sales_return_details)){echo 'display: block;'; }else{echo 'display: none;'; } ?>">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4>RETURN PRODUCTS</h4>
                            </div>
                        </div>
                        <div class="row sales_return_product_list">
                            <?php if(isset($sales_return_details)){ echo $listings; } ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-actions col-md-12">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="<?php echo base_url('sales_return_list'); ?>" class="btn btn-dark">CANCEL</a>
                                </div>
                                <?php if(isset($sales_return_details)){ ?>
                                    <div class="col-md-6 ">
                                        <button type="submit" class="btn btn-success float-right sales_return_create" value="1"> <i class="fa fa-check"></i> <?php echo 'UPDATE'; ?></button>
                                    </div>
                                <?php }else{ ?>
                                    <div class="col-md-4 ">
                                        <button type="submit" class="btn btn-success float-right sales_return_create" name="partially_completed" value="1"> <i class="fa fa-check"></i> <?php echo 'PARTIALLY COMPLETED'; ?></button>
                                    </div>
                                    <div class="col-md-2 ">
                                        <button type="submit" class="btn btn-info float-right sales_return_create" name="completed" value="1"> <i class="fa fa-check"></i> <?php if(isset($sales_return_details)){echo 'UPDATE'; }else{echo 'COMPLETED'; } ?></button>
                                    </div>
                                <?php } ?>
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
