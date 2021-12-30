<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Module Settings</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Settings</a></li>
                                <li class="breadcrumb-item active">Module Settings</li>
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
                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-md-5 col-form-label">Estimate Module</label>
                                            <div class="col-md-5">
                                                <div class="square-switch">
                                                    <input type="checkbox" name="estimate_module" id="square-switch1" switch="bool" checked/>
                                                    <label for="square-switch1" data-on-label="Yes"
                                                    data-off-label="No"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-md-5 col-form-label">Quotation Module</label>
                                            <div class="col-md-5">
                                                <div class="square-switch">
                                                    <input type="checkbox" name="quotation_module"  id="square-switch2" switch="bool" checked/>
                                                    <label for="square-switch2" data-on-label="Yes"
                                                    data-off-label="No"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-md-5 col-form-label">DC module</label>
                                            <div class="col-md-5">
                                             <div class="square-switch">
                                                <input type="checkbox" name="dc_module" id="square-switch3" switch="bool" checked/>
                                                <label for="square-switch3" data-on-label="Yes"
                                                data-off-label="No"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-md-5 col-form-label">Purchase Module</label>
                                        <div class="col-md-5">
                                            <div class="square-switch">
                                                <input type="checkbox" name="purchase_module" id="square-switch4" switch="bool" checked/>
                                                <label for="square-switch4" data-on-label="Yes"
                                                data-off-label="No"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-md-5 col-form-label">Sales Order Module</label>
                                        <div class="col-md-5">
                                            <div class="square-switch">
                                                <input type="checkbox" name="sales_order_module" id="square-switch10" switch="bool" checked/>
                                                <label for="square-switch10" data-on-label="Yes"
                                                data-off-label="No"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-md-5 col-form-label">Purchase Order Module</label>
                                        <div class="col-md-5">
                                            <div class="square-switch">
                                                <input type="checkbox" name="purchase_order_module" id="square-switch9" switch="bool" checked/>
                                                <label for="square-switch9" data-on-label="Yes"
                                                data-off-label="No"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-md-5 col-form-label">Expenses Module</label>
                                        <div class="col-md-5">
                                            <div class="square-switch">
                                                <input type="checkbox" name="expenses_module" id="square-switch11" switch="bool" checked/>
                                                <label for="square-switch11" data-on-label="Yes"
                                                data-off-label="No"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-md-5 col-form-label">Other Modules</label>
                                        <div class="col-md-5">
                                            <div class="square-switch">
                                                <input type="checkbox" name="other_module" id="square-switch12" switch="bool" checked/>
                                                <label for="square-switch12" data-on-label="Yes"
                                                data-off-label="No"></label>
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
</div>