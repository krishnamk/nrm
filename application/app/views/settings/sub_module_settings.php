<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Sub Module Settings</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Settings</a></li>
                                <li class="breadcrumb-item active">Sub Module Settings</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 message"><?php message(); ?></div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="post">
                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <ul class="nav nav-tabs nav-tabs-custom nav-justified mb-3" id="pills-tab" role="tablist">
                                            <?php $menus = module_list();
                                            if($menus){
                                                foreach ($menus as $key => $menu) {
                                                    $active = ($key==0) ? 'active' : '' ;
                                                    echo '<li class="nav-item">
                                                    <a class="nav-link '.$active.'" id="pills-home-tab" data-toggle="pill" 
                                                    href="#pills-sales'.$key.'" role="tab" aria-controls="pills-home" aria-selected="true">'.$menu['module_name'].'</a>
                                                    </li>'; 
                                                }
                                            } ?>
                                        </ul> 
                                        <div class="tab-content p-3" id="pills-tabContent">
                                            <?php
                                            if($menus){
                                                $count = 0;
                                                foreach ($menus as $key => $menu) { 
                                                    ?>
                                                    <div class="tab-pane fade show <?php if($key == 0){ echo "active";} ?>" id="pills-sales<?php echo $key; ?>" role="tabpanel" aria-labelledby="pills-home-tab">
                                                        <?php if($menu['submenus']){ ?>
                                                            <div class="row"><h6><strong><?php echo $menu['module_name']; ?> - MODULE</strong></h6></div>
                                                            <div class="row p-3">
                                                                <?php
                                                                foreach ($menu['submenus'] as $key => $submenu) { ?>
                                                                    <div class="square-switch col-2">
                                                                        <div class="row p-3"><h6><?php echo strtoupper($submenu['sub_module_name']); ?></h6></div>
                                                                        <input type="checkbox" id="square-switch<?php echo next_number($count); ?>" value="<?php echo $submenu['sub_module_id']; ?>" name="submodules[]" 
                                                                        <?php if($submenu['sub_module_id'] && $submenu['status'] == 1){ echo "checked"; } ?> switch="bool">
                                                                        <label for="square-switch<?php echo next_number($count); ?>" data-on-label="Yes"
                                                                            data-off-label="No" value = <?php echo $submenu['sub_module_id']; ?>></label>
                                                                        </div>
                                                                    <?php $count = next_number($count); }  ?>
                                                                </div>
                                                            <?php } ?>
                                                        </div>
                                                    <?php } } ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-12">
                                           <div class="form-group">
                                             <button type="submit" class="btn btn-primary mr-1 waves-effect waves-light">Save Changes</button>
                                             <button type="submit" class="btn btn-secondary waves-effect">Cancel</button>
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