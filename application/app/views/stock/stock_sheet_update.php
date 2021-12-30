<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Stock List Upload</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                                <li class="breadcrumb-item active">Stock List Upload</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
             <div class="row">
                <div class="col-lg-12 message"><?php message(); ?></div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Notes</h4><br>
                            <div class="row  ">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="form-group col-md-5">
                                            <label class="control-label"><h6>1.Download - Product Template File :</h6></label>
                                        </div>
                                        <div class="form-group col-md-6"><a href="<?php echo base_url('stock/product_template_download');?>" class="btn btn-primary"><i class="fa fa-file-excel-o"></i>&nbsp;DOWNLOAD</a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="control-label"><h6>2.Update Stock List in The Downloaded Sheet.</h6></label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-5">
                                            <label class="control-label"><h6>3.Finally Upload The Stock Sheet :</h6></label>
                                        </div>
                                        <div class="form-group col-md-6"><a href="<?php echo base_url('stock_upload');?>" class="btn btn-primary"><i class="fa fa-file-excel-o"></i>&nbsp;UPLOAD</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
</div>