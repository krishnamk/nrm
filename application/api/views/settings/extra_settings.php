<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Extra Settings</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Settings</a></li>
                                <li class="breadcrumb-item active">Extra Settings</li>
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
                                    <div class="col-sm-12">
                                        <label for="example-text-input" class="col-md-12 col-form-label"><h4>Inventory Settings:</h4></label>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group row">
                                                    <label for="example-text-input" class="col-md-5 col-form-label">Excel Based Upload</label>
                                                    <div class="col-md-5">
                                                        <div class="square-switch">
                                                            <input type="checkbox" name="excel_based_upload" id="square-switch13" switch="bool" checked/>
                                                            <label for="square-switch13" data-on-label="Yes"
                                                            data-off-label="No"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    <label for="example-text-input" class="col-md-5 col-form-label">Excel Based Download</label>
                                                    <div class="col-md-5">
                                                        <div class="square-switch">
                                                            <input type="checkbox" name="excel_based_download"  id="square-switch14" switch="bool" checked/>
                                                            <label for="square-switch14" data-on-label="Yes"
                                                            data-off-label="No"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <label for="example-text-input" class="col-md-12 col-form-label"><h4>Layout Settings:</h4></label>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group row">
                                                    <label for="example-text-input" class="col-md-5 col-form-label">Layout 1</label>
                                                    <div class="col-md-5">
                                                        <div class="square-switch">
                                                            <input type="checkbox" name="layout_1" id="square-switch15" switch="bool" checked/>
                                                            <label for="square-switch15" data-on-label="Yes"
                                                            data-off-label="No"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group row">
                                                    <label for="example-text-input" class="col-md-5 col-form-label">Layout 2</label>
                                                    <div class="col-md-5">
                                                        <div class="square-switch">
                                                            <input type="checkbox" name="dc_cancel_stock_remove"  id="square-switch22" switch="bool" checked/>
                                                            <label for="square-switch16" data-on-label="Yes"
                                                            data-off-label="No"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group row">
                                                    <label for="example-text-input" class="col-md-5 col-form-label">Layout 3</label>
                                                    <div class="col-md-5">
                                                        <div class="square-switch">
                                                            <input type="checkbox" name="layout_3"  id="square-switch20" switch="bool" checked/>
                                                            <label for="square-switch20" data-on-label="Yes"
                                                            data-off-label="No"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <label for="example-text-input" class="col-md-12 col-form-label"><h4>Application Settings:</h4></label>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group row">
                                                    <label for="example-text-input" class="col-md-5 col-form-label">GST Number</label>
                                                    <div class="col-md-5">
                                                        <div class="square-switch">
                                                            <input type="checkbox" name="gst_no" id="square-switch17" switch="bool" checked/>
                                                            <label for="square-switch17" data-on-label="Yes"
                                                            data-off-label="No"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group row">
                                                    <label for="example-text-input" class="col-md-5 col-form-label">Decimal Values(Amount)</label>
                                                    <div class="col-md-5">
                                                        <div class="square-switch">
                                                            <input type="checkbox" name="decimal_values"  id="square-switch18" switch="bool" checked/>
                                                            <label for="square-switch18" data-on-label="Yes"
                                                            data-off-label="No"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group row">
                                                    <label for="example-text-input" class="col-md-5 col-form-label">Currency Symbols</label>
                                                    <div class="col-md-5">
                                                        <div class="square-switch">
                                                            <input type="checkbox" name="currency_symbols"  id="square-switch18" switch="bool" checked/>
                                                            <label for="square-switch18" data-on-label="Yes"
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