<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Order Sheet Upload</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">List</a></li>
                                <li class="breadcrumb-item active">Dc</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 message"><?php message(); ?></div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <form  method="post" enctype="multipart/form-data">
                            <div class="form-body">
                                <div class="card-body">
                                    <div class="row  ">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="form-group col-md-2">
                                                    <label class="control-label">DATE</label>
                                                    <input type="date" name="date" id="date" class="form-control form-control-danger" placeholder="DATE" value="<?php if(isset($po_details)){ echo date('Y-m-d',strtotime($po_details['date'])); }else{ echo date('Y-m-d'); } ?>">
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label>Customer Name</label>
                                                        <select name="customer_id" id="customers_id" class="form-control">
                                                            <?php echo $customers; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-5">
                                                    <label>Upload File</label>
                                                    <div class="input-group col-md-12">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Upload</span>
                                                            <input type="hidden" name="stock_file_upload" class="" id="stock_file_upload" value="1">
                                                        </div>
                                                        <div class="custom-file">
                                                            <input type="file" name="stock_file" class="custom-file-input" id="inputGroupFile01">
                                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-actions">
                                                        <div class="card-body">
                                                            <button type="submit" class="btn btn-success"> <i class="fa fa-upload"></i>&nbsp;&nbsp;UPLOAD</button>
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
                <!-- end page title -->
            </div>
        </div>
    </div>