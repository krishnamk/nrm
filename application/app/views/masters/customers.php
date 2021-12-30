<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Add Customers</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Customer</a></li>
                                <li class="breadcrumb-item active">Add Customers</li>
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
                                            <label>Customer Name</label>
                                            <input id="customer_name" name="customer_name" type="text" class="form-control" value="<?php if(isset($customers)){echo $customers['customer_name'];} ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Customer Email</label>
                                            <input type="text" class="form-control" name="customer_email" id="customer_email" value="<?php if(isset($customers)){echo $customers['customer_email'];} ?>">
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
                                            <label>Customer Phone</label>
                                            <input id="customer_phone" name="customer_phone" type="text" class="form-control" value="<?php if(isset($customers)){echo $customers['customer_phone'];} ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Customer Mobile</label>
                                            <input id="customers_mobile" name="customers_mobile" type="text" class="form-control" value="<?php if(isset($customers)){echo $customers['customers_mobile'];} ?>">
                                        </div>
                                    </div>
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
                                                <label>Street</label>
                                                <input id="customer_address1" name="customer_address1" type="text" class="form-control" value="<?php if(isset($customers)){echo $customers['customer_address1'];} ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Locality</label>
                                                <input id="customer_address2" name="customer_address2" type="text" class="form-control" value="<?php if(isset($customers)){echo $customers['customer_address2'];} ?>">
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
                                                <input id="customer_city" name="customer_city" type="text" class="form-control" value="<?php if(isset($customers)){echo $customers['customer_city'];} ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label>Pincode</label>
                                                <input id="customer_pincode" name="customer_pincode" type="text" class="form-control" value="<?php if(isset($customers)){echo $customers['customer_pincode'];} ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>State</label>
                                                <select class="form-control" name="customer_state">
                                                    <?php if(isset($customers)){ echo state( $customers['customer_state']); }else{ state(); } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>   
                                    <!-- GST DETAILS -->
                                    <div class="row">
                                        <div class="col-sm-4">
                                           <div class="form-group">
                                            <label ><b><h6>Extra Informations</h6></b></label>
                                        </div> 
                                    </div>
                                    <?php if($this->common->get_particular('mst_general_settings',array('general_settings_name' => 'gst_number'),'general_settings_value')==1){?>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Customer GST</label>
                                                <input id="customer_gst" name="customer_gst" type="text" class="form-control" value="<?php if(isset($customers)){echo $customers['customer_gst'];} ?>">
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <?php if($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'customer_opening_balance'),'product_settings_value')==1){?>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Opening Balance</label>
                                                <input id="customer_opening_balance" name="customer_opening_balance" type="text" class="form-control" value="<?php if(isset($customers)){echo $customers['customer_opening_balance'];} ?>">
                                            </div>
                                        </div>
                                    <?php } ?>
                                    </div>
                                    <hr>     
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