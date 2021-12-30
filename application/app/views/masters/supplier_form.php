<div class="modal-header">
    <h4 class="modal-title">NEW SUPPLIER</h4>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body"> 
    <form id="new-supplier">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <!-- GENERAL DETAILS -->
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label><b><h6><strong>General Informations:</strong></h6></b></label>
                            </div> 
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Supplier Name</label>
                                <input id="supplier_name" name="supplier_name" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Supplier Email</label>
                                <input type="text" class="form-control" name="supplier_email" id="supplier_email">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label><b><h6><strong>Contact Details:</strong></h6></b></label>
                            </div> 
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Supplier Phone</label>
                                <input id="supplier_phone" name="supplier_phone" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Supplier Mobile</label>
                                <input id="supplier_mobile" name="supplier_mobile" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <!-- ADDRESS INFORMATION DETAILS -->
                    <div class="row">
                        <div class="col-sm-4">
                         <div class="form-group">
                            <label ><b><h6><strong>Address Details:</strong></h6></b></label>
                        </div> 
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Street</label>
                            <input id="supplier_address1" name="supplier_address1" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Locality</label>
                            <input id="supplier_address2" name="supplier_address2" type="text" class="form-control">
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
                            <label>City</label>
                            <input id="supplier_city" name="supplier_city" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label>Pincode</label>
                            <input id="supplier_pincode" name="supplier_pincode" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>State</label>
                            <select class="form-control" name="supplier_state">
                                <?php state();?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <!-- GST DETAILS -->
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label><b><h6><strong>Extra Informations:</strong></h6></b></label>
                    </div> 
                </div>
                <?php if($this->common->get_particular('mst_general_settings',array('general_settings_name' => 'gst_number'),'general_settings_value')==1){?>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Supplier GST</label>
                            <input id="supplier_gst" name="supplier_gst" type="text" class="form-control"> 
                        </div>
                    </div>
                <?php } ?>
                <?php if($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'supplier_opening_balance'),'product_settings_value')==1){?>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Opening Balance</label>
                            <input id="supplier_opening_balance" name="supplier_opening_balance" type="text" class="form-control">
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
</form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-danger waves-effect waves-light new-supplier">ADD SUPPLIER</button>
</div>