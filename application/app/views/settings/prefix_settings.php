<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Prefix Settings</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Settings</a></li>
                                <li class="breadcrumb-item active">Prefix Settings</li>
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
                                            <label for="example-text-input" class="col-md-5 col-form-label">Financial Year Prefix Required</label>
                                            <div class="col-md-5">
                                                <div class="square-switch">
                                                    <input type="checkbox" name="financial_year_prefix" id="square-switch1" switch="bool" checked/>
                                                    <label for="square-switch1" data-on-label="Yes"
                                                    data-off-label="No"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-md-5 col-form-label">Financial year Increment/Change</label>
                                            <div class="col-md-5">
                                                <div class="square-switch">
                                                    <input type="checkbox" name="financial_year_increment_change"  id="square-switch2" switch="bool" checked/>
                                                    <label for="square-switch2" data-on-label="Yes"
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