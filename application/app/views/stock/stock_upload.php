<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Stock Upload</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                                <li class="breadcrumb-item active">Stock Upload</li>
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
                            <form  method="post" enctype="multipart/form-data">
                                <div class="form-body">
                            <div class="card-body">
                                <div class="row  ">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label class="control-label">UPLOAD EXCEL FILE</label>
                                            </div> 
                                        </div> 
                                         <div class="row">
                                    <div class="input-group col-md-6">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Upload</span>
                                            <input type="hidden" name="product_file_upload" class="" id="product_file_upload" value="1">
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" name="product_file" class="custom-file-input" id="inputGroupFile01">
                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="card-body">
                                        <button type="submit" class="btn btn-success"> <i class="fa fa-upload"></i>&nbsp;&nbsp;UPLOAD</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                                <!-- <div class="form-body">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label class="control-label">UPLOAD EXCEL FILE</label>
                                                    </div> 
                                                </div> 
                                                <div class="row">
                                                    <div class="input-group col-md-6">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Upload</span>
                                                            <input type="hidden" name="product_file_upload" class="" id="product_file_upload" value="1">
                                                        </div>
                                                        <div class="custom-file">
                                                            <input type="file" name="product_file" class="custom-file-input" id="inputGroupFile01">
                                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <div class="card-body">
                                                    <button type="submit" class="btn btn-success"> <i class="fa fa-upload"></i>&nbsp;&nbsp;UPLOAD</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                                </form>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->
            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
    </div>