<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">DC Settings</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Settings</a></li>
                                <li class="breadcrumb-item active">DC Settings</li>
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
                                        <label for="example-text-input" class="col-md-12 col-form-label"><h4>New DC:</h4></label>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    <label for="example-text-input" class="col-md-5 col-form-label">Stock Add</label>
                                                    <div class="col-md-5">
                                                        <div class="square-switch">
                                                            <input type="checkbox" name="new_dc_stock_add" id="square-switch13" switch="bool" checked/>
                                                            <label for="square-switch13" data-on-label="Yes"
                                                            data-off-label="No"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    <label for="example-text-input" class="col-md-5 col-form-label">Stock Reduce</label>
                                                    <div class="col-md-5">
                                                        <div class="square-switch">
                                                            <input type="checkbox" name="new_dc_stock_remove"  id="square-switch14" switch="bool" checked/>
                                                            <label for="square-switch14" data-on-label="Yes"
                                                            data-off-label="No"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <label for="example-text-input" class="col-md-12 col-form-label"><h4>DC Cancel:</h4></label>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    <label for="example-text-input" class="col-md-5 col-form-label">Stock Add</label>
                                                    <div class="col-md-5">
                                                        <div class="square-switch">
                                                            <input type="checkbox" name="dc_cancel_stock_add" id="square-switch15" switch="bool" checked/>
                                                            <label for="square-switch15" data-on-label="Yes"
                                                            data-off-label="No"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    <label for="example-text-input" class="col-md-5 col-form-label">Stock Reduce</label>
                                                    <div class="col-md-5">
                                                        <div class="square-switch">
                                                            <input type="checkbox" name="dc_cancel_stock_remove"  id="square-switch16" switch="bool" checked/>
                                                            <label for="square-switch16" data-on-label="Yes"
                                                            data-off-label="No"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <label for="example-text-input" class="col-md-12 col-form-label"><h4>DC Type:</h4></label>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    <label for="example-text-input" class="col-md-5 col-form-label">DC Inward</label>
                                                    <div class="col-md-5">
                                                        <div class="square-switch">
                                                            <input type="checkbox" name="dc_inward" id="square-switch17" switch="bool" checked/>
                                                            <label for="square-switch17" data-on-label="Yes"
                                                            data-off-label="No"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    <label for="example-text-input" class="col-md-5 col-form-label">DC Outward</label>
                                                    <div class="col-md-5">
                                                        <div class="square-switch">
                                                            <input type="checkbox" name="dc_outward"  id="square-switch18" switch="bool" checked/>
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