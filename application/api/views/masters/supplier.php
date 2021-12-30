<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Add Supplier</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Supplier</a></li>
                                <li class="breadcrumb-item active">Add Supplier</li>
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
                                            <label>Supplier Name</label>
                                            <input id="supplier_name" name="supplier_name" type="text" class="form-control" value="<?php if(isset($suppliers)){echo $suppliers['supplier_name'];}?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Supplier Email</label>
                                            <input type="text" class="form-control" name="supplier_email" id="supplier_email" value="<?php if(isset($suppliers)){echo $suppliers['supplier_email'];}?>">
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
                                            <label>Supplier Phone</label>
                                            <input id="supplier_phone" name="supplier_phone" type="text" class="form-control" value="<?php if(isset($suppliers)){echo $suppliers['supplier_phone'];}?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Supplier Mobile</label>
                                            <input id="supplier_mobile" name="supplier_mobile" type="text" class="form-control" value="<?php if(isset($suppliers)){echo $suppliers['supplier_mobile'];}?>">
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
                                                <input id="supplier_address1" name="supplier_address1" type="text" class="form-control" value="<?php if(isset($suppliers)){echo $suppliers['supplier_address1'];}?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Locality</label>
                                                <input id="supplier_address2" name="supplier_address2" type="text" class="form-control" value="<?php if(isset($suppliers)){echo $suppliers['supplier_address2'];}?>">
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
                                                <input id="supplier_city" name="supplier_city" type="text" class="form-control" value="<?php if(isset($suppliers)){echo $suppliers['supplier_city'];}?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label>Pincode</label>
                                                <input id="supplier_pincode" name="supplier_pincode" type="text" class="form-control" value="<?php if(isset($suppliers)){echo $suppliers['supplier_pincode'];}?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>State</label>
                                                <select class="form-control" name="supplier_state">
                                                    <?php if(isset($suppliers)){ echo state( $suppliers['supplier_state']); }else{ state(); } ?>
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
                                    <?php if($this->common->get_particular('mst_settings',array('settings_name' => 'gst_number'),'settings_value')==1){?>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Supplier GST</label>
                                                <input id="supplier_gst" name="supplier_gst" type="text" class="form-control" value="<?php if(isset($suppliers)){echo $suppliers['supplier_gst'];}?>"> 
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <?php if($this->common->get_particular('mst_settings',array('settings_name' => 'supplier_opening_balance'),'settings_value')==1){?>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Opening Balance</label>
                                                <input id="supplier_opening_balance" name="supplier_opening_balance" type="text" class="form-control" value="<?php if(isset($suppliers)){echo $suppliers['supplier_opening_balance'];}?>">
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