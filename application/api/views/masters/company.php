<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Add Company</h4>
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
                                            <input id="company_name" name="company_name" type="text" class="form-control" value="<?php if(isset($companies)){ echo $companies['company_name'];}?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Company Email</label>
                                            <input type="text" class="form-control" name="company_email" id="company_email" value="<?php if(isset($companies)){ echo $companies['company_email'];}?>">
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
                                            <label>Company Phone</label>
                                            <input id="company_phone" name="company_phone" type="text" class="form-control" value="<?php if(isset($companies)){ echo $companies['company_phone'];}?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Company Mobile</label>
                                            <input id="company_contact_no" name="company_contact_no" type="text" class="form-control" value="<?php if(isset($companies)){ echo $companies['company_contact_no'];}?>">
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
                                                <input id="company_address1" name="company_address1" type="text" class="form-control" value="<?php if(isset($companies)){ echo $companies['company_address1'];}?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Locality</label>
                                                <input id="company_address2" name="company_address2" type="text" class="form-control" value="<?php if(isset($companies)){ echo $companies['company_address2'];}?>">
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
                                                <input id="company_city" name="company_city" type="text" class="form-control" value="<?php if(isset($companies)){ echo $companies['company_city'];}?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label>Pincode</label>
                                                <input id="company_pincode" name="company_pincode" type="text" class="form-control" value="<?php if(isset($companies)){ echo $companies['company_pincode'];}?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>State</label>
                                                <select class="form-control" name="company_state">
                                                    <?php if(isset($companies)){ echo state( $companies['company_state']); }else{ state(); } ?>
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
                                                <label>Company GST</label>
                                                <input id="company_gst" name="company_gst" type="text" class="form-control" value="<?php if(isset($companies)){ echo $companies['company_gst'];}?>">
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