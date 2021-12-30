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
                        <h4 class="page-title"><?php if(isset($purchase_return_details)){ echo "PURCHASE RETURN EDIT"; }else{ echo "PURCHASE RETURN"; } ?></h4>
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
                                                <div class="form-group col-md-2">
                                                    <label class="control-label">PURCHASE RETURN NO</label>
                                                    <input type="text" name="purchase_return_number" id="purchase_return_number" class="form-control" placeholder="RETURN NUMBER" value="<?php if(isset($purchase_return_details)){ echo $purchase_return_details['purchase_return_number']; }else{ echo $purchase_return_number; } ?>">
                                                </div> 
                                                <div class="form-group col-md-2">
                                                    <label class="control-label">DATE</label>
                                                    <input type="date" name="purchase_return_date" id="purchase_return_date" class="form-control form-control-danger" placeholder="DATE" value="<?php if(isset($purchase_return_details)){ echo date('Y-m-d',strtotime($purchase_return_details['purchase_return_date'])); }else{ echo date('Y-m-d'); } ?>">
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label class="control-label">SUPPLIER</label>
                                                    <select id="purchase_return_supplier" name="purchase_return_supplier" class="form-control form-control-danger">
                                                        <?php echo $suppliers; ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-2">
                                                 <label class="control-label">PURCHASE BILL NO</label>
                                                 <select id="purchase_return_purchase_id" name="purchase_return_purchase_id" class="form-control form-control-danger">
                                                    <?php if(isset($purchase_return_details)){ echo $purchase_bills; } ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label class="control-label">REMARKS</label>
                                                <textarea class="form-control" name="purchase_return_remarks" id="purchase_return_remarks"><?php if(isset($purchase_return_details)){ echo $purchase_return_details['purchase_return_remarks']; } ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-body purchase_return_product" style="<?php if(isset($purchase_return_details)){echo 'display: block;'; }else{echo 'display: none;'; } ?>">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4>RETURN PRODUCTS</h4>
                                    </div>
                                </div>
                                <div class="row purchase_return_product_list">
                                    <?php if(isset($purchase_return_details)){ echo $listings; } ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-actions col-md-12">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <a href="<?php echo base_url('purchase_return_list'); ?>" class="btn btn-dark">CANCEL</a>
                                        </div>
                                        <div class="col-md-6 ">
                                            <button type="submit" class="btn btn-success float-right purchase_return_create"> <i class="fa fa-check"></i> <?php if(isset($purchase_return_details)){echo 'UPDATE'; }else{echo 'CREATE'; } ?></button>
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
