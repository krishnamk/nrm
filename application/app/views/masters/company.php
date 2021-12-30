<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18"><?php if(isset($company)){ echo 'Edit Company'; }else{ echo 'New Company'; } ?></h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Company</a></li>
                                <li class="breadcrumb-item active">Add Company</li>
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
                        <div class="card-body">
                            <form method="post" enctype="multipart/form-data">
                                <!-- GENERAL DETAILS -->
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label><b><h6>General Informations</h6></b></label>
                                        </div> 
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Company Name</label>
                                            <input type="text" id="company_name" name="company_name" class="form-control" placeholder="PLEASE ENTER NAME" value="<?php if(isset($company)){ echo $company['company_name']; } ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Company Location</label>
                                            <input type="text" id="company_location" name="company_location" class="form-control" placeholder="PLEASE ENTER LOCATION" value="<?php if(isset($company)){ echo $company['company_location']; } ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label><b><h6></h6></b></label>
                                        </div> 
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Company Email</label>
                                            <input type="text" id="company_email" name="company_email" class="form-control" placeholder="PLEASE ENTER EMAIL ADDRESS" value="<?php if(isset($company)){ echo $company['company_email']; } ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Company Phone</label>
                                            <input type="text" id="company_phone" name="company_phone" class="form-control" placeholder="PLEASE ENTER PHONE NUMBER" value="<?php if(isset($company)){ echo $company['company_phone']; } ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label><b><h6></h6></b></label>
                                        </div> 
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Company Mobile</label>
                                            <input type="text" id="company_contact_no" name="company_contact_no" class="form-control" placeholder="PLEASE ENTER MOBILE NUMBER" value="<?php if(isset($company)){ echo $company['company_contact_no']; } ?>">
                                        </div>
                                    </div>
                                    <?php if($this->common->get_particular('mst_general_settings',array('general_settings_name' => 'gst_number'),'general_settings_value')==1){?>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Company GST</label>
                                                <input type="text" id="company_gst" name="company_gst" class="form-control" placeholder="PLEASE ENTER GST" value="<?php if(isset($company)){ echo $company['company_gst']; } ?>">
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                                <hr>
                                <!-- ADDRESS INFORMATION DETAILS -->
                                <div class="row">
                                    <div class="col-sm-4">
                                     <div class="form-group">
                                        <label ><b><h6>Address Details</h6></b></label>
                                    </div> 
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Company Address1</label>
                                        <input type="text" id="company_address1" name="company_address1" class="form-control" placeholder="PLEASE ENTER ADDRESS 1" value="<?php if(isset($company)){ echo $company['company_address1']; } ?>">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Company Address2</label>
                                        <input type="text" id="company_address2" name="company_address2" class="form-control" placeholder="PLEASE ENTER ADDRESS 2" value="<?php if(isset($company)){ echo $company['company_address2']; } ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label><b><h6></h6></b></label>
                                    </div> 
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Company City</label>
                                        <input type="text" id="company_city" name="company_city" class="form-control" placeholder="PLEASE ENTER CITY" value="<?php if(isset($company)){ echo $company['company_city']; } ?>">
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Pincode</label>
                                        <input type="text" id="company_pincode" name="company_pincode" class="form-control" placeholder="PLEASE ENTER PINCODE" value="<?php if(isset($company)){ echo $company['company_pincode']; } ?>">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>State</label>
                                        <select id="company_state" name="company_state" class="form-control" >
                                            <?php if(isset($company)){ echo state($company['company_state']); }else{ state(); } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <hr>   
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label><b><h6>Banking Details</h6></b></label>
                                    </div> 
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Bank Name</label>
                                        <input type="text" id="company_bank_name" name="company_bank_name" class="form-control" placeholder="PLEASE ENTER BANK NAME" value="<?php if(isset($company)){ echo $company['company_bank_name']; } ?>">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Account Name</label>
                                        <input type="text" id="company_account_name" name="company_account_name" class="form-control" placeholder="PLEASE ENTER ACCOUNT NAME" value="<?php if(isset($company)){ echo $company['company_account_name']; } ?>">
                                    </div>
                                </div>
                            </div> 
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label><b><h6></h6></b></label>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Account Number</label>
                                        <input type="text" id="company_account_number" name="company_account_number" class="form-control" placeholder="PLEASE ENTER ACCOUNT NUMBER" value="<?php if(isset($company)){ echo $company['company_account_number']; } ?>">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>IFSC Code</label>
                                        <input type="text" id="company_ifsc_code" name="company_ifsc_code" class="form-control" placeholder="PLEASE ENTER IFSC CODE" value="<?php if(isset($company)){ echo $company['company_ifsc_code']; } ?>">
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="col-lg-12">
                                <div class="accordion" id="accordionExample">
                                    <div class="card">
                                        <div class="card-header" id="headingOne">
                                            <h2 class="mb-0">
                                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    PREFIX DETAILS
                                                </button>
                                            </h2>
                                        </div>
                                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                                    <li class="nav-item">
                                                        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" 
                                                        href="#pills-sales" role="tab" aria-controls="pills-home" aria-selected="true">SALES</a>
                                                    </li>
                                                    <?php if($this->common->get_particular('mst_sub_modules',array('sub_module_name' => 'Purchase'),'status')==1){ ?>
                                                        <li class="nav-item">
                                                            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-purchase" role="tab" aria-controls="pills-contact" aria-selected="false">PURCHASE</a>
                                                        </li>
                                                    <?php } ?>
                                                    <?php if($this->common->get_particular('mst_sub_modules',array('sub_module_name' => 'Sales Return'),'status')==1){ ?>
                                                        <li class="nav-item">
                                                            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-return" role="tab" aria-controls="pills-contact" aria-selected="false">RETURN</a>
                                                        </li>
                                                    <?php } ?>
                                                    <?php if($this->common->get_particular('mst_sub_modules',array('sub_module_name' => 'Expenses'),'status')==1){ ?>
                                                        <li class="nav-item">
                                                            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-expense" role="tab" aria-controls="pills-contact" aria-selected="false">EXPENSES</a>
                                                        </li>
                                                    <?php } ?>
                                                    <?php if($this->common->get_particular('mst_modules',array('module_name' => 'ACCOUNTS'),'module_status')==1){ ?>
                                                        <li class="nav-item">
                                                            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-accounts" role="tab" aria-controls="pills-contact" aria-selected="false">ACCOUNTS</a>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                                <div class="tab-content" id="pills-tabContent">
                                                    <div class="tab-pane fade show active" id="pills-sales" role="tabpanel" aria-labelledby="pills-home-tab">
                                                        <div class="row">
                                                            <div class="form-group col-md-6">
                                                                <label class="control-label">ESTIMATE PREFIX</label>
                                                                <input type="text" id="estimate_prefix_value" name="estimate_prefix_value" class="form-control" placeholder="PLEASE ENTER ESTIMATE PREFIX" value="<?php if(isset($company)){ echo $company['estimate_prefix_value']; } ?>">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="control-label">NEXT ESTIMATE NO</label>
                                                                <input type="text" id="estimate_prefix_count" name="estimate_prefix_count" class="form-control" placeholder="PLEASE ENTER ESTIMATE NEXT NO" value="<?php if(isset($company)){ echo $company['estimate_prefix_count']; } ?>">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-md-6">
                                                                <label class="control-label">QUOTATION PREFIX</label>
                                                                <input type="text" id="quotation_prefix_value" name="quotation_prefix_value" class="form-control" placeholder="PLEASE ENTER QUOTATION PREFIX" value="<?php if(isset($company)){ echo $company['quotation_prefix_value']; } ?>">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="control-label">NEXT QUOTATION NO</label>
                                                                <input type="text" id="quotation_prefix_count" name="quotation_prefix_count" class="form-control" placeholder="PLEASE ENTER QUOTATION NEXT NO" value="<?php if(isset($company)){ echo $company['quotation_prefix_count']; } ?>">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-md-6">
                                                                <label class="control-label">DC PREFIX</label>
                                                                <input type="text" id="dc_prefix_value" name="dc_prefix_value" class="form-control" placeholder="PLEASE ENTER DC PREFIX" value="<?php if(isset($company)){ echo $company['dc_prefix_value']; } ?>">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="control-label">NEXT DC NO</label>
                                                                <input type="text" id="dc_prefix_count" name="dc_prefix_count" class="form-control" placeholder="PLEASE ENTER DC NEXT NO" value="<?php if(isset($company)){ echo $company['dc_prefix_count']; } ?>">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-md-6">
                                                                <label class="control-label">INVOICE PREFIX</label>
                                                                <input type="text" id="invoice_prefix_value" name="invoice_prefix_value" class="form-control" placeholder="PLEASE ENTER INVOICE PREFIX" value="<?php if(isset($company)){ echo $company['invoice_prefix_value']; } ?>">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="control-label">NEXT INVOICE NO</label>
                                                                <input type="text" id="invoice_prefix_count" name="invoice_prefix_count" class="form-control" placeholder="PLEASE ENTER INVOICE NEXT NO" value="<?php if(isset($company)){ echo $company['invoice_prefix_count']; } ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="pills-purchase" role="tabpanel" aria-labelledby="pills-contact-tab">
                                                        <?php if($this->common->get_particular('mst_sub_modules',array('sub_module_name' => 'Purchase Order'),'status')==1){ ?>
                                                            <div class="row">
                                                                <div class="form-group col-md-6">
                                                                    <label class="control-label">PURCHASE ORDER PREFIX</label>
                                                                    <input type="text" id="purchase_prefix_value" name="purchase_prefix_value" class="form-control" placeholder="PLEASE ENTER PURCHASE PREFIX" value="<?php if(isset($company)){ echo $company['purchase_prefix_value']; } ?>">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label class="control-label">NEXT PURCHASE ORDER NO</label>
                                                                    <input type="text" id="purchase_prefix_count" name="purchase_prefix_count" class="form-control" placeholder="PLEASE ENTER PURCHASE NEXT NO" value="<?php if(isset($company)){ echo $company['purchase_prefix_count']; } ?>">
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                        <?php if($this->common->get_particular('mst_sub_modules',array('sub_module_name' => 'Purchase DC'),'status')==1){ ?>
                                                            <div class="row">
                                                                <div class="form-group col-md-6">
                                                                    <label class="control-label">PURCHASE DC PREFIX</label>
                                                                    <input type="text" id="purchase_dc_prefix_value" name="purchase_dc_prefix_value" class="form-control" placeholder="PLEASE ENTER PURCHASE DC PREFIX" value="<?php if(isset($company)){ echo $company['purchase_dc_prefix_value']; } ?>">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label class="control-label">NEXT PURCHASE DC NO</label>
                                                                    <input type="text" id="purchase_dc_prefix_count" name="purchase_dc_prefix_count" class="form-control" placeholder="PLEASE ENTER PURCHASE DC NEXT NO" value="<?php if(isset($company)){ echo $company['purchase_dc_prefix_count']; } ?>">
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                        <?php if($this->common->get_particular('mst_sub_modules',array('sub_module_name' => 'Purchase'),'status')==1){ ?>
                                                            <div class="row">
                                                                <div class="form-group col-md-6">
                                                                    <label class="control-label">PURCHASE PREFIX</label>
                                                                    <input type="text" id="purchase_prefix_value" name="purchase_prefix_value" class="form-control" placeholder="PLEASE ENTER PURCHASE PREFIX" value="<?php if(isset($company)){ echo $company['purchase_prefix_value']; } ?>">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label class="control-label">NEXT PURCHASE NO</label>
                                                                    <input type="text" id="purchase_prefix_count" name="purchase_prefix_count" class="form-control" placeholder="PLEASE ENTER PURCHASE NEXT NO" value="<?php if(isset($company)){ echo $company['purchase_prefix_count']; } ?>">
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="tab-pane fade" id="pills-return" role="tabpanel" aria-labelledby="pills-contact-tab">
                                                        <?php if($this->common->get_particular('mst_sub_modules',array('sub_module_name' => 'Purchase Return'),'status')==1){ ?>
                                                            <div class="row">
                                                                <div class="form-group col-md-6">
                                                                    <label class="control-label">PURCHASE RETURN PREFIX</label>
                                                                    <input type="text" id="purchase_return_prefix_value" name="purchase_return_prefix_value" class="form-control" placeholder="PLEASE ENTER PURCHASE RETURN PREFIX" value="<?php if(isset($company)){ echo $company['purchase_return_prefix_value']; } ?>">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label class="control-label">NEXT PURCHASE RETURN NO</label>
                                                                    <input type="text" id="purchase_return_prefix_count" name="purchase_return_prefix_count" class="form-control" placeholder="PLEASE ENTER PURCHASE RETURN NEXT NO" value="<?php if(isset($company)){ echo $company['purchase_return_prefix_count']; } ?>">
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                        <div class="row">
                                                            <div class="form-group col-md-6">
                                                                <label class="control-label">SALES RETURN PREFIX</label>
                                                                <input type="text" id="sales_return_prefix_value" name="sales_return_prefix_value" class="form-control" placeholder="PLEASE ENTER SALES RETURN PREFIX" value="<?php if(isset($company)){ echo $company['sales_return_prefix_value']; } ?>">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="control-label">NEXT SALES RETURN NO</label>
                                                                <input type="text" id="sales_return_prefix_count" name="sales_return_prefix_count" class="form-control" placeholder="PLEASE ENTER SALES RETURN NEXT NO" value="<?php if(isset($company)){ echo $company['sales_return_prefix_count']; } ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="pills-expense" role="tabpanel" aria-labelledby="pills-contact-tab">
                                                     <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label class="control-label">EXPENSE PREFIX</label>
                                                            <input type="text" id="expense_prefix_value" name="expense_prefix_value" class="form-control" placeholder="PLEASE ENTER EXPENSE PREFIX" value="<?php if(isset($company)){ echo $company['expense_prefix_value']; } ?>">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label class="control-label">NEXT EXPENSE NO</label>
                                                            <input type="text" id="expense_prefix_count" name="expense_prefix_count" class="form-control" placeholder="PLEASE ENTER EXPENSE NEXT NO" value="<?php if(isset($company)){ echo $company['expense_prefix_count']; } ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="pills-accounts" role="tabpanel" aria-labelledby="pills-contact-tab">
                                                 <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label class="control-label">SALES RECEIPT PREFIX</label>
                                                        <input type="text" id="sales_receipt_prefix_value" name="sales_receipt_prefix_value" class="form-control" placeholder="PLEASE ENTER RECEIPT PREFIX" value="<?php if(isset($company)){ echo $company['sales_receipt_prefix_value']; } ?>">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="control-label">NEXT RECEIPT NO</label>
                                                        <input type="text" id="sales_receipt_prefix_count" name="sales_receipt_prefix_count" class="form-control" placeholder="PLEASE ENTER RECEIPT NEXT NO" value="<?php if(isset($company)){ echo $company['sales_receipt_prefix_count']; } ?>">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label class="control-label">PURCHASE PAYMENT PREFIX</label>
                                                        <input type="text" id="purchase_payment_prefix_value" name="purchase_payment_prefix_value" class="form-control" placeholder="PLEASE ENTER PURCHASE PAYMENT PREFIX" value="<?php if(isset($company)){ echo $company['purchase_payment_prefix_value']; } ?>">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="control-label">NEXT PURCHASE PAYMENT NO</label>
                                                        <input type="text" id="purchase_payment_prefix_count" name="purchase_payment_prefix_count" class="form-control" placeholder="PLEASE ENTER PURCHASE PAYMENT NEXT NO" value="<?php if(isset($company)){ echo $company['purchase_payment_prefix_count']; } ?>">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label class="control-label">JOURNAL PREFIX</label>
                                                        <input type="text" id="journal_prefix_value" name="journal_prefix_value" class="form-control" placeholder="PLEASE ENTER JOURNAL PREFIX" value="<?php if(isset($company)){ echo $company['journal_prefix_value']; } ?>">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="control-label">NEXT JOURNAL NO</label>
                                                        <input type="text" id="journal_prefix_count" name="journal_prefix_count" class="form-control" placeholder="PLEASE ENTER JOURNAL NEXT NO" value="<?php if(isset($company)){ echo $company['journal_prefix_count']; } ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-9">
                     <div class="form-group">
                     </div> 
                 </div>
                 <div class="col-sm-3">
                     <div class="form-group">
                       <button type="submit" class="btn btn-primary mr-1 waves-effect waves-light">Save Changes</button>
                       <button type="submit" class="btn btn-secondary waves-effect">Cancel</button>
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
</div>