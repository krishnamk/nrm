<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Stock Inward</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Stock</a></li>
                                <li class="breadcrumb-item active">Stock Inward</li>
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
                                <!-- GENERAL DETAILS -->
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>Date</label>
                                            <input id="date" name="date" type="text" class="form-control" value="<?php echo date('d-m-Y'); ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Product Name</label>
                                            <select class="form-control" name="product_id">
                                                <?php product();  ?>
                                            </select>
                                        </div> 
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>Stock Inward Qty</label>
                                            <input type="text" class="form-control" name="quantity" id="quantity">
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label>Remarks</label>
                                            <input type="textarea" class="form-control" name="remarks" id="remarks">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-9">
                                     <div class="form-group">
                                     </div> 
                                 </div>
                                 <div class="col-sm-3">
                                     <div class="form-group">
                                       <button type="submit" class="btn btn-primary mr-1 waves-effect waves-light">Save Changes</button>
                                       <button type="submit" class="btn btn-secondary waves-effect">Cancel</button>
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