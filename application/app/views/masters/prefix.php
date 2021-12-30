<div class="main-content">
  <div class="page-content">
    <div class="container-fluid">
      <!-- start page title -->
      <div class="row">
        <div class="col-12">
          <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">Add Prefix</h4>
            <div class="page-title-right">
              <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="javascript: void(0);">Prefix</a></li>
                <li class="breadcrumb-item active">Add Prefix</li>
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
                  <div class="col-lg-12">
                    <div class="card"> 
                      <div class="row">
                        <div class="col-lg-12">
                          <ul class="nav nav-tabs" role="tablist">
                            <?php if($headings){ 
                              foreach ($headings as $key => $heading) { ?>
                                <li class="nav-item" style="min-width: 100px;"><a class="nav-link <?php if($key==0){ echo 'active'; } ?>" data-toggle="tab" href="#prefix<?php echo $key;?>" role="tab"><span class="hidden-xs-down" style="font-weight: 600;"><?php echo $heading->prefix_heading;?></span></a> </li>
                              <?php } }?>  
                            </ul> 
                            <div class="tab-content tabcontent-border">
                              <br>
                              <?php if($headings){
                                foreach ($headings as $key => $heading) { ?>
                                 <div class="tab-pane <?php if($key==0){ echo 'active'; } ?>" id="prefix<?php echo $key;?>" role="tabpanel">
                                  <?php foreach ($prefixs as $prekey => $prefix) {
                                    if($prefix->prefix_heading == $heading->prefix_heading){ ?>
                                      <div class="p-20">
                                        <div class="row ">
                                          <div class="col-md-3">
                                            <div class="row">
                                              <div class="form-group col-md-12">
                                                <label class="control-label"><?php echo $prefix->prefix_label; ?></label>
                                                <input type="text" id="<?php echo $prefix->prefix_name; ?>" name="<?php echo $prefix->prefix_name; ?>[0]" class="form-control" placeholder="PLEASE ENTER PREFIX" value="<?php echo $prefix->prefix_value; ?>">
                                              </div> 
                                            </div>
                                          </div> 
                                          <div class="col-md-3">
                                            <div class="row">
                                              <div class="form-group col-md-12">
                                                <label class="control-label">NEXT NUMBER</label>
                                                <input type="text" id="<?php echo $prefix->prefix_name; ?>" name="<?php echo $prefix->prefix_name; ?>[1]" class="form-control" placeholder="PLEASE ENTER PREFIX" value="<?php echo $prefix->prefix_count; ?>">
                                              </div> 
                                            </div>
                                          </div> 
                                        </div>
                                      </div>
                                    <?php }  } ?>
                                  </div>
                                <?php } } ?>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-9">
                       <div class="form-group">
                       </div> 
                     </div>
                     <?php if($headings){ ?>
                       <div class="col-sm-3">
                         <div class="form-group">
                           <button type="submit" class="btn btn-primary mr-1 waves-effect waves-light">Save Changes</button>
                           <button type="submit" class="btn btn-secondary waves-effect">Cancel</button>
                         </div> 
                       </div>
                     <?php  } ?>
                   </div>
                 </form>
               </div>
             </div>
           </div>
         </div>
       </div>
     </div>
   </div>