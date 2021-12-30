<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Product Settings</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Settings</a></li>
                                <li class="breadcrumb-item active">Product Settings</li>
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
                                            <label for="example-text-input" class="col-md-5 col-form-label">Product Code</label>
                                            <div class="col-md-5">
                                                <div class="square-switch">
                                                    <input type="checkbox" name="style_code" id="square-switch1" switch="bool" checked/>
                                                    <label for="square-switch1" data-on-label="Yes"
                                                    data-off-label="No"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-md-5 col-form-label">Item Code</label>
                                            <div class="col-md-5">
                                                <div class="square-switch">
                                                    <input type="checkbox" name="itemcode"  id="square-switch2" switch="bool" checked/>
                                                    <label for="square-switch2" data-on-label="Yes"
                                                    data-off-label="No"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-md-5 col-form-label">Hsn Code</label>
                                            <div class="col-md-5">
                                             <div class="square-switch">
                                                <input type="checkbox" name="hsncode" id="square-switch3" switch="bool" checked/>
                                                <label for="square-switch3" data-on-label="Yes"
                                                data-off-label="No"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-md-5 col-form-label">Bar Code</label>
                                        <div class="col-md-5">
                                            <div class="square-switch">
                                                <input type="checkbox" name="barcode" id="square-switch4" switch="bool" checked/>
                                                <label for="square-switch4" data-on-label="Yes"
                                                data-off-label="No"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-md-5 col-form-label">MRP Price</label>
                                        <div class="col-md-5">
                                            <div class="square-switch">
                                                <input type="checkbox" name="mrp_price" id="square-switch5" switch="bool" checked/>
                                                <label for="square-switch5" data-on-label="Yes"
                                                data-off-label="No"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-md-5 col-form-label">Selling Price</label>
                                        <div class="col-md-5">
                                            <div class="square-switch">
                                                <input type="checkbox" name="selling_price" id="square-switch6" switch="bool" checked/>
                                                <label for="square-switch6" data-on-label="Yes"
                                                data-off-label="No"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-md-5 col-form-label">Market Price</label>
                                        <div class="col-md-5">
                                            <div class="square-switch">
                                                <input type="checkbox" name="market_price" id="square-switch7" switch="bool" checked/>
                                                <label for="square-switch7" data-on-label="Yes"
                                                data-off-label="No"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-md-5 col-form-label">Purchase Price</label>
                                        <div class="col-md-5">
                                            <div class="square-switch">
                                                <input type="checkbox" name="purchase_price" id="square-switch8" switch="bool" checked/>
                                                <label for="square-switch8" data-on-label="Yes"
                                                data-off-label="No"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-md-5 col-form-label">Unit</label>
                                        <div class="col-md-5">
                                            <div class="square-switch">
                                                <input type="checkbox" name="unit" id="square-switch9" switch="bool" checked/>
                                                <label for="square-switch9" data-on-label="Yes"
                                                data-off-label="No"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-md-5 col-form-label">Size</label>
                                        <div class="col-md-5">
                                            <div class="square-switch">
                                                <input type="checkbox" name="size" id="square-switch10" switch="bool" checked/>
                                                <label for="square-switch10" data-on-label="Yes"
                                                data-off-label="No"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-md-5 col-form-label">Colour</label>
                                        <div class="col-md-5">
                                            <div class="square-switch">
                                                <input type="checkbox" name="colour" id="square-switch11" switch="bool" checked/>
                                                <label for="square-switch11" data-on-label="Yes"
                                                data-off-label="No"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-md-5 col-form-label">Brand</label>
                                        <div class="col-md-5">
                                            <div class="square-switch">
                                                <input type="checkbox" name="brand" id="square-switch12" switch="bool" checked/>
                                                <label for="square-switch12" data-on-label="Yes"
                                                data-off-label="No"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-md-5 col-form-label">Category</label>
                                        <div class="col-md-5">
                                            <div class="square-switch">
                                                <input type="checkbox" name="category" id="square-switch13" switch="bool" checked/>
                                                <label for="square-switch13" data-on-label="Yes"
                                                data-off-label="No"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-md-5 col-form-label">Sub Category</label>
                                        <div class="col-md-5">
                                            <div class="square-switch">
                                                <input type="checkbox" name="sub_category" id="square-switch14" switch="bool" checked/>
                                                <label for="square-switch14" data-on-label="Yes"
                                                data-off-label="No"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-md-5 col-form-label">Tax</label>
                                        <div class="col-md-5">
                                            <div class="square-switch">
                                                <input type="checkbox" name="tax" id="square-switch15" switch="bool" checked/>
                                                <label for="square-switch15" data-on-label="Yes"
                                                data-off-label="No"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-md-5 col-form-label">UOM</label>
                                        <div class="col-md-5">
                                            <div class="square-switch">
                                                <input type="checkbox" name="uom" id="square-switch16" switch="bool" checked/>
                                                <label for="square-switch16" data-on-label="Yes"
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