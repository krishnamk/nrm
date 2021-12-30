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
                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-md-5 col-form-label">Dc Based Invoice</label>
                                            <div class="col-md-5">
                                                <div class="square-switch">
                                                    <input type="checkbox" name="dc_based_invoice" id="square-switch1" switch="bool" checked/>
                                                    <label for="square-switch1" data-on-label="Yes"
                                                    data-off-label="No"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-md-5 col-form-label">Multiple DC</label>
                                            <div class="col-md-5">
                                                <div class="square-switch">
                                                    <input type="checkbox" name="multiple_dc"  id="square-switch2" switch="bool" checked/>
                                                    <label for="square-switch2" data-on-label="Yes"
                                                    data-off-label="No"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-md-5 col-form-label">Shipping Address</label>
                                            <div class="col-md-5">
                                             <div class="square-switch">
                                                <input type="checkbox" name="invoice_shipping_address" id="square-switch3" switch="bool" checked/>
                                                <label for="square-switch3" data-on-label="Yes"
                                                data-off-label="No"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-md-5 col-form-label">Transport Mode</label>
                                        <div class="col-md-5">
                                            <div class="square-switch">
                                                <input type="checkbox" name="invoice_transport" id="square-switch4" switch="bool" checked/>
                                                <label for="square-switch4" data-on-label="Yes"
                                                data-off-label="No"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-md-5 col-form-label">Other Expenses</label>
                                        <div class="col-md-5">
                                            <div class="square-switch">
                                                <input type="checkbox" name="invoice_other_expenses" id="square-switch10" switch="bool" checked/>
                                                <label for="square-switch10" data-on-label="Yes"
                                                data-off-label="No"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-md-5 col-form-label">Pricing Types</label>
                                        <div class="col-md-5">
                                            <div class="square-switch">
                                                <input type="checkbox" name="invoice_price_types" id="square-switch9" switch="bool" checked/>
                                                <label for="square-switch9" data-on-label="Yes"
                                                data-off-label="No"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-md-5 col-form-label">Bundle Count</label>
                                        <div class="col-md-5">
                                            <div class="square-switch">
                                                <input type="checkbox" name="invoice_bundle_count" id="square-switch11" switch="bool" checked/>
                                                <label for="square-switch11" data-on-label="Yes"
                                                data-off-label="No"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-md-5 col-form-label">Sales Person</label>
                                        <div class="col-md-5">
                                            <div class="square-switch">
                                                <input type="checkbox" name="invoice_sales_person" id="square-switch12" switch="bool" checked/>
                                                <label for="square-switch12" data-on-label="Yes"
                                                data-off-label="No"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <label for="example-text-input" class="col-md-12 col-form-label"><h3>Discount:</h3></label>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group row">
                                                <label for="example-text-input" class="col-md-5 col-form-label">Percentage</label>
                                                <div class="col-md-5">
                                                    <div class="square-switch">
                                                        <input type="checkbox" name="invoice_discount_percentage" id="square-switch13" switch="bool" checked/>
                                                        <label for="square-switch13" data-on-label="Yes"
                                                        data-off-label="No"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group row">
                                                <label for="example-text-input" class="col-md-5 col-form-label">Amount</label>
                                                <div class="col-md-5">
                                                    <div class="square-switch">
                                                        <input type="checkbox" name="invoice_discount_amount"  id="square-switch14" switch="bool" checked/>
                                                        <label for="square-switch14" data-on-label="Yes"
                                                        data-off-label="No"></label>
                                                    </div>
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
</div>