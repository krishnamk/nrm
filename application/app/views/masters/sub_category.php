<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Add Sub Category</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Sub Category</a></li>
                                <li class="breadcrumb-item active">Add Sub Category</li>
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
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label><b><h6>General Informations</h6></b></label>
                                        </div> 
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Brand</label>
                                            <select name="brand_id" id="brand_id" class="form-control">
                                                <?php if(isset($sub_categories)){ echo brand($sub_categories['brand_id']); }else{ brand(); }  ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Category</label>
                                            <select name="category_id" id="category_id" class="form-control">
                                                <?php if(isset($sub_categories)){ echo category($sub_categories['category_id']); }else{ category(); }  ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Sub Category Name</label>
                                            <input id="sub_category_name" name="sub_category_name" type="text" class="form-control" value="<?php if(isset($sub_categories)){echo $sub_categories['sub_category_name'];} ?>">
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