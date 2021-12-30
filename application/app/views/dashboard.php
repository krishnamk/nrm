            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0 font-size-18">Dashboard</h4>
                                    <div class="row">
                                    </div>
                                    <div class="float-sm-right">
                                        <ul class="nav nav-pills">
                                           <li class="nav-item">
                                            <button class="btn btn-success btn-sm btn-rounded waves-effect waves-light filter" type="button"  data-val="TODAY">Today</button>
                                        </li>&nbsp;&nbsp;
                                        <li class="nav-item">
                                            <button class="btn btn-warning btn-sm btn-rounded waves-effect waves-light filter" type="button"  data-val="MONTH">Month</button>
                                        </li>&nbsp;&nbsp;
                                        <li class="nav-item">
                                            <button class="btn btn-info btn-sm btn-rounded waves-effect waves-light filter" type="button"  data-val="YEAR">Year</button>
                                        </li>&nbsp;&nbsp;
                                        <!-- <li class="nav-item">
                                            <button class="btn btn-primary btn-sm btn-rounded waves-effect waves-light filter" type="button"  data-val="sms">SMS COUNT</button>
                                        </li>&nbsp;&nbsp; -->
                                        <input type="hidden" name="date_from" id="date_from">
                                        <input type="hidden" name="date_to" id="date_to">

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 message"><?php message(); ?></div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-xl-4">
                            <div class="card overflow-hidden">
                                <div class="bg-soft-primary">
                                    <div class="row">
                                        <div class="col-7">
                                            <div class="text-primary p-3">
                                                <h5 class="text-primary">Ctrl-Next Dashboard</h5>
                                                <p>Sales</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body pt-0">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="avatar-md profile-user-wid mb-6">
                                                <br><br>
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="bx bx-receipt font-size-24"></i>
                                            </div>
                                            <h5 class="font-size-15 text-truncate"><input type="text" id="total_invoice_payments" style="width: 100px;border: none;" value="<?php echo MoneyFormatIndia($total_invoice_payments);?>"></h5>
                                            <h6><p class="text-primary mb-0 text-truncate">Invoice Total</p></h6>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="pt-4">
                                                <div class="row">
                                                    <div class="col-6">
                                                       <h5 class="font-size-15"><input type="text" id="total_pending_payments" style="width: 100px;border: none;" value="<?php echo MoneyFormatIndia($total_pending_payments);?>"></h5>
                                                       <p class="text-muted mb-0">Received Amt</p>
                                                   </div>
                                                   <div class="col-6">
                                                    <h5 class="font-size-15"><input type="text" id="balance_amount" style="width: 100px;border: none;" value="<?php echo MoneyFormatIndia(($total_invoice_payments - $total_pending_payments));?>"></h5>
                                                    <p class="text-muted mb-0">Pending Amt</p>
                                                </div>
                                            </div>
                                            <div class="mt-4">
                                                <a href="<?php echo base_url('invoice_payment_list'); ?>" class="btn btn-primary waves-effect waves-light btn-sm">View Details <i class="mdi mdi-arrow-right ml-1"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card overflow-hidden">
                            <div class="bg-soft-primary">
                                <div class="row">
                                    <div class="col-7">
                                        <div class="text-primary p-3">
                                            <h5 class="text-primary">Purchase</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="avatar-md profile-user-wid mb-6">
                                            <br><br>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="bx bx-file font-size-24"></i>
                                        </div>
                                        <h5 class="font-size-15 text-truncate"><input type="text" id="total_purchase_payments" style="width: 100px;border: none;" value="<?php echo MoneyFormatIndia($total_purchase_payments);?>"></h5>
                                        <h6><p class="text-primary mb-0 text-truncate">Purchase Total</p></h6>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="pt-4">
                                            <div class="row">
                                                <div class="col-6">
                                                   <h5 class="font-size-15"><input type="text" id="total_purchase_pending_payments" style="width: 100px;border: none;" value="<?php echo MoneyFormatIndia($total_purchase_pending_payments);?>"></h5>
                                                   <p class="text-muted mb-0">Paid Amt</p>
                                               </div>
                                               <div class="col-6">
                                                <h5 class="font-size-15"><input type="text" id="purchase_balance_amount" style="width: 100px;border: none;" value="<?php echo MoneyFormatIndia(($total_purchase_payments - $total_purchase_pending_payments));?>"></h5>
                                                <p class="text-muted mb-0">Pending Amt</p>
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <a href="<?php echo base_url('purchase_payment_list'); ?>" class="btn btn-primary waves-effect waves-light btn-sm">View Details <i class="mdi mdi-arrow-right ml-1"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <div class="row">

                        <div class="col-md-4">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-body">
                                            <p class="text-muted font-weight-medium">Total Customer</p>
                                            <h4 class="mb-0"><input type="text" id="total_customers" style="width: 40px;border: none;" value="<?php echo $total_customers;?>"></h4>
                                        </div>

                                        <div class="mini-stat-icon avatar-sm rounded-circle bg-primary align-self-center">
                                            <span class="avatar-title">
                                                <i class="bx bxs-user-check font-size-24"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if($this->common->get_particular('mst_sub_modules',array('sub_module_name' => 'Dc'),'status')== 1){ ?> 
                            <div class="col-md-4">
                                <div class="card mini-stats-wid">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="media-body">
                                                <p class="text-muted font-weight-medium">Total DC</p>
                                                <h4 class="mb-0"><input type="text" id="total_dcs" style="width: 40px;border: none;" value="<?php echo $total_dcs;?>"></h4>
                                            </div>

                                            <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                                                <span class="avatar-title rounded-circle bg-primary">
                                                    <i class="bx bx-receipt font-size-24"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if($this->common->get_particular('mst_sub_modules',array('sub_module_name' => 'Estimation'),'status')== 1){ ?> 
                            <div class="col-md-4">
                                <div class="card mini-stats-wid">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="media-body">
                                                <p class="text-muted font-weight-medium">Total Estimate</p>
                                                <h4 class="mb-0"><input type="text" id="total_estimates" style="width: 40px;border: none;" value="<?php echo $total_estimates;?>"></h4>
                                            </div>

                                            <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                                                <span class="avatar-title rounded-circle bg-primary">
                                                    <i class="bx bx-file font-size-24"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if($this->common->get_particular('mst_sub_modules',array('sub_module_name' => 'Purchase'),'status')== 1){ ?> 
                            <div class="col-md-4">
                                <div class="card mini-stats-wid">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="media-body">
                                                <p class="text-muted font-weight-medium">Total Purchase</p>
                                                <h4 class="mb-0"><input type="text" id="total_purchase" style="width: 40px;border: none;" value="<?php echo $total_purchase;?>"></h4>
                                            </div>

                                            <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                                                <span class="avatar-title rounded-circle bg-primary">
                                                    <i class="bx bxs-down-arrow-square font-size-24"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="col-md-4">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-body">
                                            <p class="text-muted font-weight-medium">Total Products</p>
                                            <h4 class="mb-0"><input type="text" id="total_products" style="width: 40px;border: none;" value="<?php echo $total_products;?>"></h4>
                                        </div>

                                        <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                                            <span class="avatar-title rounded-circle bg-primary">
                                                <i class="bx bxl-product-hunt"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if($this->common->get_particular('mst_sub_modules',array('sub_module_name' => 'Invoice'),'status')== 1){ ?> 
                            <div class="col-md-4">
                                <div class="card mini-stats-wid">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="media-body">
                                                <p class="text-muted font-weight-medium">Total Invoice</p>
                                                <h4 class="mb-0">
                                                    <input type="text" id="total_invoices" style="width: 40px;border: none;" value="<?php echo $total_invoices;?>">
                                                </h4>
                                            </div>

                                            <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                                                <span class="avatar-title rounded-circle bg-primary">
                                                    <i class="bx bxs-up-arrow-square font-size-24"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if($this->common->get_particular('mst_sub_modules',array('sub_module_name' => 'Quotation'),'status')== 1){ ?> 
                            <div class="col-md-4">
                                <div class="card mini-stats-wid">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="media-body">
                                                <p class="text-muted font-weight-medium">Total Quotation</p>
                                                <h4 class="mb-0"><input type="text" id="tbl_quotations" style="width: 40px;border: none;" value="<?php echo $tbl_quotations;?>"></h4>
                                            </div>

                                            <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                                                <span class="avatar-title rounded-circle bg-primary">
                                                    <i class="bx bxs-receipt font-size-24"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if($this->common->get_particular('mst_sub_modules',array('sub_module_name' => 'Purchase'),'status')== 1){ ?> 
                            <div class="col-md-4">
                                <div class="card mini-stats-wid">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="media-body">
                                                <p class="text-muted font-weight-medium">Total Supplier</p>
                                                <h4 class="mb-0"><input type="text" id="total_suppliers" style="width: 40px;border: none;" value="<?php echo $total_suppliers;?>"></h4>
                                            </div>

                                            <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                                                <span class="avatar-title rounded-circle bg-primary">
                                                    <i class="bx bxs-user-pin font-size-24"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <!-- end row -->

                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4 float-sm-left">Purchase Order Email Sent</h4>
                            <div class="float-sm-right">
                                <ul class="nav nav-pills">
                                    <li class="nav-item">
                                        <a href="<?php echo base_url('purchase_order_list'); ?>" class="btn btn-primary btn-sm btn-rounded waves-effect waves-light">View Details <i class="mdi mdi-arrow-right ml-1"></i></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="clearfix"></div>
                            <div id="stacked-column-chart" class="apex-charts" dir="ltr"></div>
                            <div class="table-responsive">
                                <table class="table table-centered table-nowrap mb-0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>S.No</th>
                                            <th>Date</th>
                                            <th>Supplier Name</th>
                                            <th>Total</th>
                                            <th>Mail Status</th>
                                            <th>View Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if($purchase_order_details){ 
                                            if (isset($purchase_order_details['purchase_order_id'])) {
                                                foreach($purchase_order_details as $key => $purchase_order_detail) { ?>
                                                    <tr>
                                                        <td><?php echo $key+1;?></a> </td>
                                                        <td>
                                                            <?php echo date('d-m-Y',strtotime($purchase_order_detail['purchase_order_date']));?>
                                                        </td>
                                                        <td><?php echo $purchase_order_detail['supplier_name'];?></td>
                                                        <td>
                                                            <b>&#8377;&nbsp;&nbsp;&nbsp;</b><?php echo MoneyFormatIndia($purchase_order_detail['total']); ?>
                                                        </td>
                                                        <td>
                                                            <?php if($purchase_order_detail['purchase_order_mail_status'] == "0"){ ?>
                                                                <span class="badge badge-pill badge-soft-danger font-size-12">Not Sent</span>
                                                            <?php  } else{ ?>
                                                                <span class="badge badge-pill badge-soft-success font-size-12">Sent</span>
                                                            <?php } ?>
                                                        </td>
                                                        <td>
                                                            <!-- Button trigger modal -->
                                                            <a href="<?php echo base_url('purchase_order_view/'.$purchase_order_detail['purchase_order_id']);?>" class="btn btn-primary btn-sm btn-rounded waves-effect waves-light" >View Details
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php } }else{ ?>
                                                    <tr> 
                                                        <td colspan="6" style="text-align: center;"> NO DEATAILS ADDED </td>
                                                    </tr>
                                                <?php } }?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4 float-sm-left">Latest Transaction</h4>
                                    <div class="float-sm-right">
                                        <ul class="nav nav-pills">
                                            <li class="nav-item">
                                                <a href="<?php echo base_url('invoice_list'); ?>" class="btn btn-primary btn-sm btn-rounded waves-effect waves-light">View Details <i class="mdi mdi-arrow-right ml-1"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div id="stacked-column-chart" class="apex-charts" dir="ltr"></div>
                                    <div class="table-responsive">
                                        <table class="table table-centered table-nowrap mb-0">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th style="width: 40px;">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                                                            <label class="custom-control-label" for="customCheck1">&nbsp;</label>
                                                        </div>
                                                    </th>
                                                    <th>S.No</th>
                                                    <th>Billing Name</th>
                                                    <th>Date</th>
                                                    <th>Total</th>
                                                    <th>Payment Status</th>
                                                    <th>Payment Method</th>
                                                    <th>View Details</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if($invoice_details){ 
                                                    foreach($invoice_details as $key => $invoice_detail) { ?>
                                                        <tr>
                                                            <td>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" id="customCheck2">
                                                                    <label class="custom-control-label" for="customCheck2">&nbsp;</label>
                                                                </div>
                                                            </td>
                                                            <td><a href="javascript: void(0);" class="text-body font-weight-bold"><?php echo $key+1;?></a> </td>
                                                            <td><?php echo $invoice_detail['customer_name'];?></td>
                                                            <td>
                                                                <?php echo date('d-m-Y',strtotime($invoice_detail['invoice_date']));?>
                                                            </td>
                                                            <td>
                                                                <b>&#8377;&nbsp;&nbsp;&nbsp;</b><?php echo MoneyFormatIndia($invoice_detail['invoice_total']); ?>
                                                            </td>
                                                            <td>
                                                                <?php if($invoice_detail['payment_status'] == 2){ ?>
                                                                   <span class="badge badge-pill badge-soft-success font-size-12">Paid</span>
                                                               <?php  } elseif($invoice_detail['payment_status'] == 0) { ?>
                                                                <span class="badge badge-pill badge-soft-danger font-size-12">Unpaid</span>
                                                            <?php } else{ ?>
                                                                <span class="badge badge-pill badge-soft-warning font-size-12">Partially Paid</span>
                                                            <?php } ?>
                                                        </td>
                                                        <td>
                                                            <?php if($invoice_detail['payment_type'] == "0"){ ?>
                                                                <span class="badge badge-pill badge-soft-danger font-size-12">Un Paid</span>
                                                            <?php  } elseif($invoice_detail['payment_type'] == "cash") { ?>
                                                                <span class="badge badge-pill badge-soft-success font-size-12">Cash</span>
                                                            <?php } elseif($invoice_detail['payment_type'] == "net_banking") { ?>
                                                                <span class="badge badge-pill badge-soft-primary font-size-12">Net Banking</span>
                                                            <?php }else{ ?>
                                                                <span class="badge badge-pill badge-soft-warning font-size-12">Cheque</span>
                                                            <?php } ?>
                                                        </td>
                                                        <td>
                                                            <!-- Button trigger modal -->
                                                            <a href="<?php echo base_url('invoice_view/'.$invoice_detail['invoice_id']);?>" class="btn btn-primary btn-sm btn-rounded waves-effect waves-light" >View Details
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php } }?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- end table-responsive -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            <!-- Modal -->
            <div class="modal fade exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Order Details</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p class="mb-2">Product id: <span class="text-primary">#SK2540</span></p>
                            <p class="mb-4">Billing Name: <span class="text-primary">Neal Matthews</span></p>

                            <div class="table-responsive">
                                <table class="table table-centered table-nowrap">
                                    <thead>
                                        <tr>
                                            <th scope="col">Product</th>
                                            <th scope="col">Product Name</th>
                                            <th scope="col">Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">
                                                <div>
                                                    <img src="assets/images/product/img-7.png" alt="" class="avatar-sm">
                                                </div>
                                            </th>
                                            <td>
                                                <div>
                                                    <h5 class="text-truncate font-size-14">Wireless Headphone (Black)</h5>
                                                    <p class="text-muted mb-0">$ 225 x 1</p>
                                                </div>
                                            </td>
                                            <td>$ 255</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">
                                                <div>
                                                    <img src="assets/images/product/img-4.png" alt="" class="avatar-sm">
                                                </div>
                                            </th>
                                            <td>
                                                <div>
                                                    <h5 class="text-truncate font-size-14">Phone patterned cases</h5>
                                                    <p class="text-muted mb-0">$ 145 x 1</p>
                                                </div>
                                            </td>
                                            <td>$ 145</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <h6 class="m-0 text-right">Sub Total:</h6>
                                            </td>
                                            <td>
                                                $ 400
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <h6 class="m-0 text-right">Shipping:</h6>
                                            </td>
                                            <td>
                                                Free
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <h6 class="m-0 text-right">Total:</h6>
                                            </td>
                                            <td>
                                                $ 400
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end modal -->


        </div>