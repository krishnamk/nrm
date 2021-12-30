<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Apps</li>
                <?php
                $menus = menu_list();
                if($menus){ 
                    $user = $this->common->get_array('mst_users',array('user_id' => $this->session->userdata('user_id')));
                    foreach ($menus as $key => $menu) {
                        if(in_array($menu['module_id'], explode(',', $user['modules']))||($this->session->userdata('access_level')< ADMIN)){
                            echo "<li>";
                            if($menu['submenus']){
                                echo '<a href="javascript: void(0);" class="has-arrow waves-effect">';
                                echo '<i class="'.$menu['module_icon'].'"></i>';
                                echo '<span>'.strtoupper($menu['module_name']).'</span></a>';
                                echo '<ul class="sub-menu" aria-expanded="false">';
                                foreach ($menu['submenus'] as $key => $submenu) {
                                    if(in_array($submenu['sub_module_id'], explode(',', $user['submodules']))||($this->session->userdata('access_level')< ADMIN)){
                                        echo '<li><a href="'.base_url($submenu['sub_module_path']).'">'.strtoupper($submenu['sub_module_name']).'</a></li>';
                                    }
                                }
                                echo '</ul>';
                            }else{
                                echo '<a href="'.base_url($menu['module_path']).'" class="has-arrow waves-effect">';
                                echo '<i class="'.$menu['module_icon'].'"></i>';
                                echo '<span>'.strtoupper($menu['module_name']).'</span></a>';
                            }
                            echo "</li>";
                        }
                    }
                } ?> 
            </ul>
        </div>
    </div>
</div>