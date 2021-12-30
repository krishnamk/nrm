<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Add Secondary Unit</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Secondary Unit</a></li>
                                <li class="breadcrumb-item active">Add Secondary Unit</li>
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
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Unit</label>
                                            <select name="unit_id" id="unit_id" class="form-control">
                                                <?php if(isset($secondary_units)){ echo units($secondary_units['unit_id']); }else{ units(); }  ?> 
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Secondary Unit Name</label>
                                            <input id="secondary_unit_name" name="secondary_unit_name" type="text" class="form-control" value="<?php if(isset($secondary_units)){echo $secondary_units['secondary_unit_name'];} ?>">
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