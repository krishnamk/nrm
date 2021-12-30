<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Report Settings</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Settings</a></li>
                                <li class="breadcrumb-item active">Report Settings</li>
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
                                            <label for="example-text-input" class="col-md-5 col-form-label">Closing Balance</label>
                                            <div class="col-md-5">
                                                <div class="square-switch">
                                                    <input type="checkbox" name="closing_balance" id="square-switch1" switch="bool" checked/>
                                                    <label for="square-switch1" data-on-label="Yes"
                                                    data-off-label="No"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-md-5 col-form-label">GST Report</label>
                                            <div class="col-md-5">
                                                <div class="square-switch">
                                                    <input type="checkbox" name="gst_report"  id="square-switch2" switch="bool" checked/>
                                                    <label for="square-switch2" data-on-label="Yes"
                                                    data-off-label="No"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-md-5 col-form-label">Productwise Report</label>
                                            <div class="col-md-5">
                                             <div class="square-switch">
                                                <input type="checkbox" name="productwise_report" id="square-switch3" switch="bool" checked/>
                                                <label for="square-switch3" data-on-label="Yes"
                                                data-off-label="No"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-md-5 col-form-label">Customer Based Report</label>
                                        <div class="col-md-5">
                                            <div class="square-switch">
                                                <input type="checkbox" name="customer_report" id="square-switch4" switch="bool" checked/>
                                                <label for="square-switch4" data-on-label="Yes"
                                                data-off-label="No"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-md-5 col-form-label">Supplier Based Report</label>
                                        <div class="col-md-5">
                                            <div class="square-switch">
                                                <input type="checkbox" name="supplier_report" id="square-switch9" switch="bool" checked/>
                                                <label for="square-switch9" data-on-label="Yes"
                                                data-off-label="No"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-md-5 col-form-label">Sales Person Based Report</label>
                                        <div class="col-md-5">
                                            <div class="square-switch">
                                                <input type="checkbox" name="sales_person_report" id="square-switch10" switch="bool" checked/>
                                                <label for="square-switch10" data-on-label="Yes"
                                                data-off-label="No"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-md-5 col-form-label">Purchase Pending Reports</label>
                                        <div class="col-md-5">
                                            <div class="square-switch">
                                                <input type="checkbox" name="purchase_pending_report" id="square-switch11" switch="bool" checked/>
                                                <label for="square-switch11" data-on-label="Yes"
                                                data-off-label="No"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-md-5 col-form-label">Sales Pending Reports</label>
                                        <div class="col-md-5">
                                            <div class="square-switch">
                                                <input type="checkbox" name="sales_pending_report" id="square-switch12" switch="bool" checked/>
                                                <label for="square-switch12" data-on-label="Yes"
                                                data-off-label="No"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-md-5 col-form-label">Daily Sales Report</label>
                                        <div class="col-md-5">
                                            <div class="square-switch">
                                                <input type="checkbox" name="daily_sales_report" id="square-switch13" switch="bool" checked/>
                                                <label for="square-switch13" data-on-label="Yes"
                                                data-off-label="No"></label>
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