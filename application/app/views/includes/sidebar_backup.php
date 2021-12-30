<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Apps</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-receipt"></i>
                        <span>Sales</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <?php if($this->common->get_particular('mst_settings',array('settings_name' => 'quotation_module'),'settings_value')==1){ ?>
                            <li><a href="<?php echo base_url('quotation_list'); ?>">Quotation</a></li>
                        <?php } ?>
                        <?php if($this->common->get_particular('mst_settings',array('settings_name' => 'dc_module'),'settings_value')==1){ ?>
                            <li><a href="<?php echo base_url('dc_list'); ?>">DC</a></li>
                        <?php } ?>
                        <?php if($this->common->get_particular('mst_settings',array('settings_name' => 'estimate_module'),'settings_value')==1){ ?>
                            <li><a href="<?php echo base_url('estimate_list'); ?>">Estimation</a></li>
                        <?php } ?>
                        <?php if($this->common->get_particular('mst_settings',array('settings_name' => 'invoice_module'),'settings_value')==1){ ?>
                            <li><a href="<?php echo base_url('invoice_list'); ?>">Invoice</a></li>
                        <?php } ?>
                        <?php if($this->common->get_particular('mst_settings',array('settings_name' => 'gatepass_module'),'settings_value')==1){ ?>
                            <li><a href="invoices-list.html">Gate Pass</a></li>
                        <?php } ?>
                        <?php if($this->common->get_particular('mst_settings',array('settings_name' => 'sales_return_module'),'settings_value')==1){ ?>
                            <li><a href="<?php echo base_url('sales_return_list'); ?>">Sales Return</a></li>
                        <?php } ?>
                        <?php if($this->common->get_particular('mst_settings',array('settings_name' => 'sales_exchange_module'),'settings_value')==0){ ?>
                            <li><a href="invoices-list.html">Sales Exchange</a></li>
                        <?php } ?>
                    </ul>
                </li>
                <?php if($this->common->get_particular('mst_settings',array('settings_name' => 'purchase_module'),'settings_value')==1){ ?>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-purchase-tag"></i>
                            <span>Purchase</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <?php if($this->common->get_particular('mst_purchase_settings',array('purchase_settings_name' => 'purchase_dc'),'purchase_settings_value')==1){ ?>
                                <li><a href="<?php echo base_url('purchase_dc_list'); ?>">Purchase DC</a></li>
                            <?php } ?>
                            <li><a href="<?php echo base_url('purchase_list'); ?>">Purchase</a></li>
                            <?php if($this->common->get_particular('mst_purchase_settings',array('purchase_settings_name' => 'purchase_order'),'purchase_settings_value')==1){ ?>
                                <li><a href="<?php echo base_url('purchase_order_list'); ?>">Purchase Order</a></li>
                            <?php } ?>
                            <li><a href="<?php echo base_url('purchase_return_list');?>">Purchase Return</a></li>
                            <?php if($this->common->get_particular('mst_settings',array('settings_name' => 'purchase_exchange'),'settings_value')==1){ ?>
                                <li><a href="crypto-lending.html">Purchase Exchange</a></li>
                            <?php } ?>
                        </ul>
                    </li>
                <?php } ?>
                <?php if($this->common->get_particular('mst_settings',array('settings_name' => 'expenses_module'),'settings_value')==1){ ?>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-rss"></i>
                            <span>Expenses</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="<?php echo base_url('expenses_list'); ?>">New Expenses</a></li>
                        </ul>
                    </li>
                <?php } ?>
                <?php if($this->common->get_particular('mst_settings',array('settings_name' => 'inventory_module'),'settings_value')==1){ ?>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-briefcase-alt-2"></i>
                            <span>Inventory</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="<?php echo base_url('stock_list');?>">Stock List</a></li>
                            <!-- <?php if($this->common->get_particular('mst_settings',array('settings_name' => 'inventory_opening_stock'),'settings_value')==1) { ?> 
                                <li><a href="<?php echo base_url('stock_list');?>">Opening Stock</a></li>
                                <?php } ?> -->
                                <li><a href="<?php echo base_url('stock_inward_list');?>">Stock Inward</a></li>
                                <?php if($this->common->get_particular('mst_settings',array('settings_name' => 'inventory_stock_adjustment'),'settings_value')==1) { ?>
                                    <li><a href="<?php echo base_url('stock_adjustment_list'); ?>">Stock Adjustments</a></li><?php } ?>
                                </ul>
                            </li>
                        <?php } ?>
                        <?php if($this->common->get_particular('mst_settings',array('settings_name' => 'payment_module'),'settings_value')==1){ ?>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bxl-paypal"></i>
                                    <span>Payments</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <?php if($this->common->get_particular('mst_settings',array('settings_name' => 'purchase_module'),'settings_value')==1){ ?>
                                        <li><a href="<?php echo base_url('purchase_payment_list'); ?>">Purchase</a></li>
                                    <?php } ?>
                                    <?php if($this->common->get_particular('mst_settings',array('settings_name' => 'quotation_payment_module'),'settings_value')==1){ ?>
                                        <li><a href="<?php echo base_url('quotation_payment_list'); ?>">Quotation</a></li>
                                    <?php } ?>
                                    <?php if($this->common->get_particular('mst_settings',array('settings_name' => 'estimate_payment_module'),'settings_value')==1){ ?>
                                        <li><a href="<?php echo base_url('estimate_payment_list'); ?>">Estimate</a></li>
                                    <?php } ?>
                                    <?php if($this->common->get_particular('mst_settings',array('settings_name' => 'invoice_payment_module'),'settings_value')==1){ ?>
                                        <li><a href="<?php echo base_url('invoice_payment_list'); ?>">Invoice</a></li>
                                    <?php } ?>
                                    <?php if($this->common->get_particular('mst_settings',array('settings_name' => 'expenses_module'),'settings_value')==1) { ?>
                                        <li><a href="projects-overview.html">Expenses</a></i>
                                        <?php } ?>
                                    </ul>
                                </li>
                            <?php } ?>
                            <?php if($this->common->get_particular('mst_settings',array('settings_name' => 'report_module'),'settings_value')==1){ ?>
                                <li>
                                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                                        <i class="bx bx-share-alt"></i>
                                        <span>Reports</span>
                                    </a>
                                    <ul class="sub-menu" aria-expanded="true">
                                        <li><a href="javascript: void(0);" class="has-arrow">Sales</a>
                                            <ul class="sub-menu" aria-expanded="true">
                                                <li><a href="javascript: void(0);">Closing Balance</a></li>
                                                <?php if($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'customer_opening_balance'),'product_settings_value')==1){ ?>
                                                    <li><a href="javascript: void(0);">Opening Balance</a></li>
                                                <?php } ?>
                                                <?php if($this->common->get_particular('mst_settings',array('settings_name' => 'sales_gst_report'),'settings_value')==1){ ?>
                                                    <li><a href="javascript: void(0);">GST Report</a></li>
                                                <?php } ?>
                                                <?php if($this->common->get_particular('mst_settings',array('settings_name' => 'inventory_module'),'settings_value')==1){ ?>
                                                    <li><a href="javascript: void(0);">Pending Stock Reports</a></li>
                                                <?php } ?>
                                            </ul>
                                        </li>
                                    </ul>
                                    <ul class="sub-menu" aria-expanded="true">
                                        <li><a href="javascript: void(0);" class="has-arrow">Purchase</a>
                                            <ul class="sub-menu" aria-expanded="true">
                                                <li><a href="javascript: void(0);">Closing Balance</a></li>
                                                <?php if($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'supplier_opening_balance'),'product_settings_value')==1){ ?>
                                                    <li><a href="javascript: void(0);">Opening Balance</a></li>
                                                <?php } ?>
                                                <?php if($this->common->get_particular('mst_settings',array('settings_name' => 'purchase_gst_report'),'settings_value')==1){ ?>
                                                    <li><a href="javascript: void(0);">GST Report</a></li>
                                                <?php } ?>
                                                <?php if($this->common->get_particular('mst_settings',array('settings_name' => 'inventory_module'),'settings_value')==1){ ?>
                                                    <li><a href="javascript: void(0);">Pending Stock Reports</a></li>
                                                <?php } ?>
                                            </ul>
                                        </li>
                                    </ul>
                                    <ul class="sub-menu" aria-expanded="true">
                                        <li><a href="javascript: void(0);" class="has-arrow">Extra</a>
                                            <ul class="sub-menu" aria-expanded="true">
                                                <?php if($this->common->get_particular('mst_settings',array('settings_name' => 'productwise_report'),'settings_value')==1) { ?>
                                                    <li><a href="javascript: void(0);">Product wise Reports</a></li>
                                                <?php } ?>
                                                <?php if($this->common->get_particular('mst_settings',array('settings_name' => 'expenses_module'),'settings_value')==1) { ?>
                                                    <li><a href="javascript: void(0);">Expense Reports</a></li>
                                                <?php } ?>
                                                <li><a href="javascript: void(0);">Customer Based Reports</a></li>
                                                <li><a href="javascript: void(0);">Supplier Based Reports</a></li>
                                                <?php if($this->common->get_particular
                                                    ('mst_settings',array('settings_name' => 'salesperson_based_report'),'settings_value')==1) { ?>
                                                        <li><a href="javascript: void(0);">Sales Person Based Reports</a></li>
                                                    <?php } ?>
                                                    <?php if($this->common->get_particular('mst_settings',array('settings_name' => 'daily_sales_report'),'settings_value')==1) { ?>
                                                        <li><a href="javascript: void(0);">Daily Sales Reports</a></li>
                                                    <?php } ?>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                <?php } ?>
                                <?php if($this->common->get_particular('mst_settings',array('settings_name' => 'log_module'),'settings_value')==1){ ?>
                                    <li>
                                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                                            <i class="bx bxs-log-in-circle"></i>
                                            <span>Logs</span>
                                        </a>
                                        <ul class="sub-menu" aria-expanded="true">
                                            <li><a href="<?php echo base_url('logs'); ?>" class="has-arrow">Log Details</a>
                                            </li>
                                        </ul>
                                    </li>
                                <?php } ?>
                                <li>
                                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                                        <i class="bx bx-store"></i>
                                        <span>Masters</span>
                                    </a>
                                    <ul class="sub-menu" aria-expanded="false">
                                        <li><a href="<?php echo base_url('company_list'); ?>">Company</a></li>
                                        <?php if($this->common->get_particular('mst_general_settings',array('general_settings_name' => 'multiple_branch'),'general_settings_value')==1){ ?>
                                            <li><a href="<?php echo base_url('branch_list'); ?>">Branch</a></li>
                                        <?php } ?>
                                        <li><a href="<?php echo base_url('user_list');?>">User</a></li>
                                        <li><a href="<?php echo base_url('access_level_list');?>">Access Level</a></li>
                                        <li><a href="<?php echo base_url('sub_module_list');?>">Sub Module</a></li>
                                        <li><a href="<?php echo base_url('customer_list');?>">Customers</a></li>
                                        <li><a href="<?php echo base_url('supplier_list');?>">Suppliers</a></li>
                                        <li><a href="<?php echo base_url('product_list'); ?>">Products</a></li>
                                        <?php if($this->common->get_particular('mst_settings',array('settings_name' => 'expenses_module'),'settings_value')==1){ ?>
                                            <li><a href="<?php echo base_url('expenses_category_list'); ?>">Expenses Category</a></li>
                                        <?php } ?>
                                        <?php if($this->common->get_particular('mst_settings',array('settings_name' => 'size_master'),'settings_value')==1) { ?>
                                            <li><a href="<?php echo base_url('size_list'); ?>">Size</a></li>
                                        <?php } ?>
                                        <?php if($this->common->get_particular('mst_settings',array('settings_name' => 'product_unit_master'),'settings_value')==1) { ?>
                                            <li><a href="<?php echo base_url('unit_list'); ?>">Units</a></li>
                                        <?php } ?>
                                        <?php if($this->common->get_particular('mst_settings',array('settings_name' =>'colour_master' ),'settings_value')==1) { ?>
                                            <li><a href="<?php echo base_url('colour_list'); ?>">Colours</a></li>
                                        <?php } ?>
                                        <?php if($this->common->get_particular('mst_settings',array('settings_name' => 'transport_master'),'settings_value')==1) { ?>
                                            <li><a href="<?php echo base_url('transport_list'); ?>">Transport</a></li>
                                        <?php } ?>
                                        <?php if($this->common->get_particular('mst_settings',array('settings_name' => 'brand_master'),'settings_value')==1) { ?>
                                            <li><a href="<?php echo base_url('brand_list'); ?>">Brand</a></li>
                                        <?php } ?>
                                        <?php if($this->common->get_particular('mst_settings',array('settings_name' => 'category_master'),'settings_value')==1) { ?>
                                            <li><a href="<?php echo base_url('category_list'); ?>">Category</a></li>
                                        <?php } ?>
                                        <?php if($this->common->get_particular('mst_settings',array('settings_name' => 'subcategory_master'),'settings_value')==1) { ?>
                                            <li><a href="<?php echo base_url('sub_category_list'); ?>">Sub Category</a></li>
                                        <?php } ?>
                                        <!-- <li><a href="<?php echo base_url('prefix'); ?>">Prefix</a></li> -->
                                        <?php if($this->common->get_particular('mst_settings',array('settings_name' => 'tax_master'),'settings_value')==1) { ?>
                                            <li><a href="<?php echo base_url('tax_list'); ?>">Tax</a></li>
                                        <?php } ?>
                                        <?php if($this->common->get_particular('mst_settings',array('settings_name' => 'secondary_unit_master'),'settings_value')==1) { ?>
                                            <li><a href="<?php echo base_url('secondary_unit_list'); ?>">Secondary Units</a></li>
                                        <?php } ?>
                                        <!-- <li><a href="ecommerce-add-product.html">Users</a></li> -->
                                    </ul>
                                </li>
                                <li>
                                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                                        <i class="bx bx-cog"></i>
                                        <span>Settings</span>
                                    </a>
                                    <ul class="sub-menu" aria-expanded="false">
                                        <li><a href="<?php echo base_url('product_settings'); ?>">Product Settings</a></li>
                                        <li><a href="<?php echo base_url('branch_settings'); ?>">Company Settings</a></li>
                                        <li><a href="<?php echo base_url('user_settings'); ?>">User Settings</a></li>
                                        <li><a href="<?php echo base_url('report_settings'); ?>">Report Settings</a></li>
                                        <li><a href="<?php echo base_url('payment_settings'); ?>">Payment Settings</a></li>
                                        <li><a href="<?php echo base_url('estimate_settings'); ?>">Estimate Settings</a></li>
                                        <li><a href="<?php echo base_url('prefix_settings'); ?>">Prefix Settings</a></li>
                                        <li><a href="<?php echo base_url('tax_settings'); ?>">Tax Settings</a></li>
                                        <li><a href="<?php echo base_url('invoice_settings'); ?>">Invoice Settings</a></li>
                                        <li><a href="<?php echo base_url('dc_settings'); ?>">DC Settings</a></li>
                                        <li><a href="<?php echo base_url('module_settings'); ?>">Module Settings</a></li>
                                        <li><a href="<?php echo base_url('extra_settings'); ?>">Extra Settings</a></li>
                                    </ul>
                                </li>
<!-- <li>
<a href="javascript: void(0);" class="has-arrow waves-effect">
<i class="bx bx-briefcase-alt-2"></i>
<span>Projects</span>
</a>
<ul class="sub-menu" aria-expanded="false">
<li><a href="projects-grid.html">Projects Grid</a></li>
<li><a href="projects-list.html">Projects List</a></li>
<li><a href="projects-overview.html">Project Overview</a></li>
<li><a href="projects-create.html">Create New</a></li>
</ul>
</li> -->
<!-- <li>
<a href="javascript: void(0);" class="has-arrow waves-effect">
<i class="bx bx-task"></i>
<span>Tasks</span>
</a>
<ul class="sub-menu" aria-expanded="false">
<li><a href="tasks-list.html">Task List</a></li>
<li><a href="tasks-kanban.html">Kanban Board</a></li>
<li><a href="tasks-create.html">Create Task</a></li>
</ul>
</li> -->
<!-- <li>
<a href="javascript: void(0);" class="has-arrow waves-effect">
<i class="bx bxs-user-detail"></i>
<span>Contacts</span>
</a>
<ul class="sub-menu" aria-expanded="false">
<li><a href="contacts-grid.html">User Grid</a></li>
<li><a href="contacts-list.html">User List</a></li>
<li><a href="contacts-profile.html">Profile</a></li>
</ul>
</li> -->
<!-- <li class="menu-title">Pages</li>
<li>
<a href="javascript: void(0);" class="has-arrow waves-effect">
<i class="bx bx-user-circle"></i>
<span>Authentication</span>
</a>
<ul class="sub-menu" aria-expanded="false">
<li><a href="auth-login.html">Login</a></li>
<li><a href="auth-register.html">Register</a></li>
<li><a href="auth-recoverpw.html">Recover Password</a></li>
<li><a href="auth-lock-screen.html">Lock Screen</a></li>
</ul>
</li>
<li>
<a href="javascript: void(0);" class="has-arrow waves-effect">
<i class="bx bx-file"></i>
<span>Utility</span>
</a>
<ul class="sub-menu" aria-expanded="false">
<li><a href="pages-starter.html">Starter Page</a></li>
<li><a href="pages-maintenance.html">Maintenance</a></li>
<li><a href="pages-comingsoon.html">Coming Soon</a></li>
<li><a href="pages-timeline.html">Timeline</a></li>
<li><a href="pages-faqs.html">FAQs</a></li>
<li><a href="pages-pricing.html">Pricing</a></li>
<li><a href="pages-404.html">Error 404</a></li>
<li><a href="pages-500.html">Error 500</a></li>
</ul>
</li>
<li class="menu-title">Components</li>
<li>
<a href="javascript: void(0);" class="has-arrow waves-effect">
<i class="bx bx-tone"></i>
<span>UI Elements</span>
</a>
<ul class="sub-menu" aria-expanded="false">
<li><a href="ui-alerts.html">Alerts</a></li>
<li><a href="ui-buttons.html">Buttons</a></li>
<li><a href="ui-cards.html">Cards</a></li>
<li><a href="ui-carousel.html">Carousel</a></li>
<li><a href="ui-dropdowns.html">Dropdowns</a></li>
<li><a href="ui-grid.html">Grid</a></li>
<li><a href="ui-images.html">Images</a></li>
<li><a href="ui-lightbox.html">Lightbox</a></li>
<li><a href="ui-modals.html">Modals</a></li>
<li><a href="ui-rangeslider.html">Range Slider</a></li>
<li><a href="ui-session-timeout.html">Session Timeout</a></li>
<li><a href="ui-progressbars.html">Progress Bars</a></li>
<li><a href="ui-sweet-alert.html">Sweet-Alert</a></li>
<li><a href="ui-tabs-accordions.html">Tabs & Accordions</a></li>
<li><a href="ui-typography.html">Typography</a></li>
<li><a href="ui-video.html">Video</a></li>
<li><a href="ui-general.html">General</a></li>
<li><a href="ui-colors.html">Colors</a></li>
<li><a href="ui-rating.html">Rating</a></li>
<li><a href="ui-notifications.html">Notifications</a></li>
<li><a href="ui-image-cropper.html">Image Cropper</a></li>
</ul>
</li>
<li>
<a href="javascript: void(0);" class="waves-effect">
<i class="bx bxs-eraser"></i>
<span class="badge badge-pill badge-danger float-right">10</span>
<span>Forms</span>
</a>
<ul class="sub-menu" aria-expanded="false">
<li><a href="form-elements.html">Form Elements</a></li>
<li><a href="form-layouts.html">Form Layouts</a></li>
<li><a href="form-validation.html">Form Validation</a></li>
<li><a href="form-advanced.html">Form Advanced</a></li>
<li><a href="form-editors.html">Form Editors</a></li>
<li><a href="form-uploads.html">Form File Upload</a></li>
<li><a href="form-xeditable.html">Form Xeditable</a></li>
<li><a href="form-repeater.html">Form Repeater</a></li>
<li><a href="form-wizard.html">Form Wizard</a></li>
<li><a href="form-mask.html">Form Mask</a></li>
</ul>
</li> -->
<!-- 
//TABLES
<li>
<a href="javascript: void(0);" class="has-arrow waves-effect">
<i class="bx bx-list-ul"></i>
<span>Tables</span>
</a>
<ul class="sub-menu" aria-expanded="false">
<li><a href="tables-basic.html">Basic Tables</a></li>
<li><a href="tables-datatable.html">Data Tables</a></li>
<li><a href="tables-responsive.html">Responsive Table</a></li>
<li><a href="tables-editable.html">Editable Table</a></li>
</ul>
</li> -->
<!-- 
//CHARTS
<li>
<a href="javascript: void(0);" class="has-arrow waves-effect">
<i class="bx bxs-bar-chart-alt-2"></i>
<span>Charts</span>
</a>
<ul class="sub-menu" aria-expanded="false">
<li><a href="charts-apex.html">Apex Charts</a></li>
<li><a href="charts-echart.html">E Charts</a></li>
<li><a href="charts-chartjs.html">Chartjs Chart</a></li>
<li><a href="charts-flot.html">Flot Chart</a></li>
<li><a href="charts-tui.html">Toast UI Chart</a></li>
<li><a href="charts-knob.html">Jquery Knob Chart</a></li>
<li><a href="charts-sparkline.html">Sparkline Chart</a></li>
</ul>
</li> -->
<!-- <li>
<a href="javascript: void(0);" class="has-arrow waves-effect">
<i class="bx bx-aperture"></i>
<span>Icons</span>
</a>
<ul class="sub-menu" aria-expanded="false">
<li><a href="icons-boxicons.html">Boxicons</a></li>
<li><a href="icons-materialdesign.html">Material Design</a></li>
<li><a href="icons-dripicons.html">Dripicons</a></li>
<li><a href="icons-fontawesome.html">Font awesome</a></li>
</ul>
</li> -->
<!-- 
//MULTIPLE LEVELS
<li>
<a href="javascript: void(0);" class="has-arrow waves-effect">
<i class="bx bx-share-alt"></i>
<span>Multi Level</span>
</a>
<ul class="sub-menu" aria-expanded="true">
<li><a href="javascript: void(0);">Level 1.1</a></li>
<li><a href="javascript: void(0);" class="has-arrow">Level 1.2</a>
<ul class="sub-menu" aria-expanded="true">
<li><a href="javascript: void(0);">Level 2.1</a></li>
<li><a href="javascript: void(0);">Level 2.2</a></li>
</ul>
</li>
</ul>
</li> -->
</ul>
</div>
<!-- Sidebar -->
</div>
</div>