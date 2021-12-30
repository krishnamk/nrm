<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18"><?php if(isset($user)) { echo "Edit User";}else{ "New User"; } ?></h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">User</a></li>
                                <li class="breadcrumb-item active">Add User</li>
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
                            <form method="post">
                                <!-- GENERAL DETAILS -->

                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label><b><h6>General Informations</h6></b></label>
                                        </div> 
                                    </div>
                                    <?php if($this->common->get_particular('mst_general_settings',array('general_settings_name' => 'single_company'),'general_settings_value')==1){ ?>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label>Select Company</label>
                                                <input type="hidden" name="company_id" class="form-control" value="<?php $company_id = $this->common->get_particular('company_details',array('company_status' => 1),'company_id'); echo $company_id; ?>" readonly>
                                                <input type="text" id="company_id" class="form-control" value="<?php $company = $this->common->get_particular('company_details',array('company_status' => 1),'company_name'); echo $company; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>User Name</label>
                                                <input id="name" name="name" type="text" class="form-control" value="<?php if(isset($user)){echo $user['name'];}else { } ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>User Email</label>
                                                <input type="text" class="form-control" name="email" id="email" value="<?php if(isset($user)){echo $user['email'];} ?>">
                                            </div>
                                        </div>
                                    <?php } elseif($this->common->get_particular('mst_general_settings',array('general_settings_name' => 'multiple_branch'),'general_settings_value')==1){ ?>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label>Select Branch</label>
                                                <select name="company_id" id="company_id" class="form-control">
                                                    <?php if(isset($user)){ echo branch($user['company_id']); }else{ branch(); }  ?> 
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>User Name</label>
                                                <input id="name" name="name" type="text" class="form-control" value="<?php if(isset($user)){echo $user['name'];}else { } ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>User Email</label>
                                                <input type="text" class="form-control" name="email" id="email" value="<?php if(isset($user)){echo $user['email'];} ?>">
                                            </div>
                                        </div>
                                    <?php } else { ?>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>User Name</label>
                                                <input id="name" name="name" type="text" class="form-control" value="<?php if(isset($user)){echo $user['name'];}else { } ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>User Email</label>
                                                <input type="text" class="form-control" name="email" id="email" value="<?php if(isset($user)){echo $user['email'];} ?>">
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>

                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label><b><h6></h6></b></label>
                                        </div> 
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>User Phone</label>
                                            <input id="phone" name="phone" type="text" class="form-control" value="<?php if(isset($user)){echo $user['phone'];} ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>User Mobile</label>
                                            <input id="mobile" name="mobile" type="text" class="form-control" value="<?php if(isset($user)){echo $user['mobile'];} ?>">
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <!-- LOGIN CREDENTIALS DETAILS -->
                                <div class="row">
                                    <div class="col-sm-4">
                                           <div class="form-group">
                                            <label ><b><h6>Login Details</h6></b></label>
                                        </div> 
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>LOGIN ACCESS</label>
                                            <select id="user_login"  name="user_login" class="form-control">
                                                <option>SELECT</option>
                                                <option <?php if(isset($user)){ if($user['user_login'] == 1){ echo "selected"; } } ?> value="1">YES</option>
                                                <option <?php if(isset($user)){ if($user['user_login'] == 0){ echo "selected"; } } ?> value="0">NO</option>
                                            </select>
                                        </div>
                                    </div>
                                <?php if(isset($user)){ ?> 
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>USER NAME</label>
                                                <input type="text" name="username" class="form-control" value="<?php if(isset($user)){ echo $user['username']; } ?>" >
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>PASSWORD</label>
                                                <input type="password" name="password" class="form-control" value="<?php if(isset($user)){ echo strrev($user['rev_str']); } ?>" >
                                            </div>
                                        </div>
                                    </div>
                                
                            <?php } else{ ?> 
                                <div class="row login_access" style="<?php if(isset($user)){ if($user['user_login'] == 1){ echo 'display: block;'; }else{  echo 'display: none;';  } }else{ echo 'display: none;'; } ?>" >
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>USER NAME</label>
                                            <input type="text" name="username" class="form-control" value="" >
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>PASSWORD</label>
                                            <input type="password" name="password" class="form-control" value="">
                                        </div>
                                    </div>
                                </div>
                            <?php } ?> 
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label><h6>Company Access</h6></label>
                                </div>
                            </div>
                            <?php if(isset($user)){ ?> 
                                <?php 
                                if($company_lists){ ?>
                                    <?php foreach ($company_lists as $key => $company_list) { ?>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                             <div class="square-switch">
                                                <input type="checkbox" name="access_company[]" 
                                                value="<?php $company_id = $this->common->get_particular('company_details',array('company_name' => $company_list),'company_id'); echo $company_id;?>" <?php if(isset($company_list)){ if($company_list) { echo "checked"; } } ?>>
                                                <label class="form-check-label" for="customSwitchsizelg<?php echo $key; ?>"><?php echo strtoupper($company_list); ?></label>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        <?php } else{ ?>
                            <?php 
                            if($this->session->userdata('access_level') == "1") {
                                $company_lists = $this->user->get_company_list();
                                if($company_lists){ ?>
                                    <?php foreach($company_lists as $key => $company_list) { 
                                        foreach ($company_list as $company_key => $company_name) { ?>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                 <div class="square-switch">
                                                    <input type="checkbox" name="access_company[]" value="<?php $company_id = $this->common->get_particular('company_details',array('company_name' => $company_name),'company_id'); echo $company_id; ?>"  
                                                    <?php if(isset($company_name)){ if(in_array($company_name, explode(',',$company_name)) ){ echo "checked"; } } ?> >
                                                    <label class="form-check-label" for="customSwitchsizelg<?php echo $key; ?>"><?php echo strtoupper($company_name); ?></label>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } }?>

                                <?php } ?>
                            <?php }else{ 
                                if($company_lists){ ?>
                                    <?php foreach($company_lists as $key => $company_list) { 
                                        foreach ($company_list as $company_key => $company_name) { ?>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                 <div class="square-switch">
                                                    <input type="checkbox" name="access_company[]" value="<?php $company_id = $this->common->get_particular('company_details',array('company_name' => $company_name),'company_id'); echo $company_id; ?>"  
                                                    <?php if(isset($company_name)){ if(in_array($company_name, explode(',',$company_name)) ){ echo "checked"; } } ?> >
                                                    <label class="form-check-label" for="customSwitchsizelg<?php echo $key; ?>"><?php echo strtoupper($company_name); ?></label>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } }?>
                                <?php } }?>
                            <?php } ?>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-4">
                               <div class="form-group">
                                <label ><b><h6>Access Details</h6></b></label>
                            </div> 
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>ACCESS NAME</label>
                                <select class="form-control" name="access_level" id="user_access_level"> <?php if(isset($user)){ echo access_level_options($user['access_level']); }else{ echo access_level_options(); } ?></select>
                            </div>
                        </div>
                    </div>

                    <div class="card-body col-md-12">
                        <div class="table-responsive m-t-20">
                            <table class="table table-bordered table-responsive-lg">
                                <thead>
                                    <tr>
                                        <th scope="col">MODULE ACCESS LEVELS</th>
                                    </tr>
                                </thead>
                                <tbody class="listings">
                                    <?php if(isset($temp_products)){
                                        echo $temp_products;
                                    }else{
                                        echo '<tr><td>NO ACCESS ADDED</td></tr>';
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-sm-3">
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
