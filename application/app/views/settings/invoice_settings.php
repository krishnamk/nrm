<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Invoice Settings</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Settings</a></li>
                                <li class="breadcrumb-item active">Invoice Settings</li>
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
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="form-group row">
                                            <?php if($invoices) { 
                                                foreach ($invoices as $key => $invoice) { ?>
                                                   <label for="example-text-input" class="col-md-5 col-form-label"><?php echo strtoupper($invoice['settings_name']);?></label>
                                                   <div class="col-md-5">
                                                    <div class="square-switch">
                                                        <input type="checkbox" id="square-switch<?php echo $key; ?>" value="<?php echo $invoice['invoice_settings_id']; ?>" name="invoices[]" 
                                                        <?php if($invoice['invoice_settings_id'] && $invoice['invoice_settings_value'] == 1){ echo "checked"; } ?> switch="bool">
                                                        <label for="square-switch<?php echo $key; ?>" data-on-label="Yes"
                                                            data-off-label="No" value = <?php echo $invoice['invoice_settings_id']; ?>>
                                                            </label>
                                                        </div>
                                                    </div>
                                                <?php }?> 
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                 <div class="form-group">
                                   <button type="submit" class="btn btn-primary mr-1 waves-effect waves-light">Save Changes</button>
                                   <button type="submit" class="btn btn-secondary waves-effect">Cancel</button>
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