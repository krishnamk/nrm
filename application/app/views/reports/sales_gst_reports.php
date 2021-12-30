<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Invoice List</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">List</a></li>
                                <li class="breadcrumb-item active">Invoice</li>
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
                      <form method="post">
                          <div class="card">
                              <!-- /.card-header -->
                              <div class="card-body">
                                  <div class="row">
                                    <?php if($this->common->get_particular('mst_general_settings',array('general_settings_name' => 'multiple_company'),'general_settings_value')==1){?>
                                        <?php if($this->session->userdata('access_level') <= 2) {  ?>
                                            <div class="form-group col-md-3">
                                                <label class="control-label">SELECT COMPANY</label>
                                                <select id="get_company_id" name="company_id" class="form-control form-control-danger">
                                                    <?php if($company_lists){ echo $company_lists; } ?>
                                                </select>
                                            </div>
                                        <?php } else{ ?>
                                            <div class="form-group col-md-3">
                                                <label class="control-label">SELECT COMPANY</label>
                                                <select id="get_company_id" name="company_id" class="form-control form-control-danger">
                                                    <?php if($company_lists){ echo $company_lists; } ?>
                                                </select>
                                            </div>

                                        <?php } ?>
                                    <?php } ?>
                                    <div class="form-group col-md-3">
                                        <label class="control-label">CUSTOMER NAME</label>
                                        <select  name="customer_id" class="form-control select2" >
                                            <?php if($customers){ echo $customers; } ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="control-label">TAX %</label>
                                        <select  name="tax_id" class="form-control" >
                                            <?php if($tax){ echo $tax; } ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="control-label">FROM</label>
                                        <input type="date" name="date_from" class="form-control" placeholder="dd/mm/yyyy">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="control-label">TO</label>
                                        <input type="date" name="date_to" class="form-control" placeholder="dd/mm/yyyy">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="col-lg-12">&nbsp;</label>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="radio">VIEW
                                                    <input type="radio" name="option" value="view" <?php if(isset($option)){ if($option=='view'){ echo "checked";} }else{echo "checked";}?> >
                                                    <span class="checkround"></span>
                                                </label>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="radio">PDF
                                                    <input type="radio" name="option" value="print" <?php if(isset($option)){ if($option=='print'){ echo "checked";} }?> >
                                                    <span class="checkround"></span>
                                                </label>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="radio">EXCEL
                                                    <input type="radio" name="option" value="excel" <?php if(isset($option)){ if($option=='excel'){ echo "checked";} }?> >
                                                    <span class="checkround"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-1">
                                        <label class="control-label">&nbsp;</label>
                                        <div class="col-md-12 float-lg-right">
                                            <input type="submit" class="btn btn-primary"  id='filter' value="CLICK FILTER">
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
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">GST SUMMARY</h3>
                    </div>
                    <div class="card-body">
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th style="width: 50px">S.No</th>
                                    <th style="width: 150px">INVOICE DATE</th>
                                    <th>INVOICE NO</th>
                                    <th>CUSTOMER NAME</th>
                                    <th>GST NUMBER</th>
                                    <th>TAX %</th>
                                    <th style="text-align: center;">TOTAL AMOUNT</th>
                                    <th style="text-align: center;">TAX</th>
                                    <th>IGST</th>
                                    <th>CGST</th>
                                    <th>SGST</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($lists){
                                    $total_amount = 0;
                                    $total_gst = 0;
                                    foreach ($lists as $key => $list) {   
                                       $total_amount  = $total_amount+$list['new_total'];
                                       $total_gst     = $total_gst+$list['new_tax'];?>
                                       <tr>
                                        <td><?php echo ($key+1); ?></td>
                                        <td><?php echo date('d-m-Y',strtotime($list['invoice_date']));?></td>
                                        <td><?php echo $list['invoice_number']; ?></td>
                                        <td><?php echo $list['customer_name']; ?></td>
                                        <td><?php echo $list['customer_gst']; ?></td>
                                        <td><?php echo $list['tax_percentage']; ?></td>
                                        <td style="text-align: right;">&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($list['new_total']); ?></td>
                                        <td style="text-align: right;">&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($list['new_tax']); ?></td>
                                        <?php if($list['company_state'] == $list['customer_state']){ ?>
                                            <td>0</td>
                                            <td>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia(($list['new_tax']/2)); ?></td>
                                            <td>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia(($list['new_tax']/2)); ?></td>
                                        <?php } else{ ?>
                                            <td>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($list['new_tax']); ?></td>
                                            <td>0</td>
                                            <td>0</td>
                                        <?php } ?>
                                    </tr>
                                <?php } } ?>
                                <tr>
                                    <td colspan="6"><strong>GRAND TOTAL : </strong></td>
                                    <td style="text-align:right;"><b><?php if($total_amount!="") { echo MoneyFormatIndia($total_amount); } else{  echo "0.00"; } ?></b></td>
                                    <td style="text-align:right;"><b>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($total_gst); ?></b></td>
                                    <?php foreach ($lists as $key => $list) { 
                                        if($list['company_state'] == $list['customer_state']){ 
                                            $state = 1; //Same State 
                                        }else{ 
                                            $state = 2;//Other State
                                        } }?>
                                        <?php if($state == 1) { ?>
                                            <td>0</td>
                                            <td>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia(($total_gst/2)); ?></td>
                                            <td>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia(($total_gst/2)); ?></td>
                                        <?php } else{ ?>
                                            <td>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($total_gst); ?></td>
                                            <td>0</td>
                                            <td>0</td>
                                        <?php } ?>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div>
    </div>
</div>