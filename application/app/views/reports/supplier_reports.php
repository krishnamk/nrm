<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Purchase List</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">List</a></li>
                                <li class="breadcrumb-item active">Purchase</li>
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
                                            <div class="form-group col-md-2">
                                                <label class="control-label">SELECT COMPANY</label>
                                                <select id="get_company_id" name="company_id" class="form-control form-control-danger">
                                                    <?php if($company_lists){ echo $company_lists; } ?>
                                                </select>
                                            </div>
                                        <?php } else{ ?>
                                            <div class="form-group col-md-2">
                                                <label class="control-label">SELECT COMPANY</label>
                                                <select id="get_company_id" name="company_id" class="form-control form-control-danger">
                                                    <?php if($company_lists){ echo $company_lists; } ?>
                                                </select>
                                            </div>

                                        <?php } ?>
                                    <?php } ?>
                                    <div class="form-group col-md-2">
                                        <label class="control-label">SUPPLIER NAME</label>
                                        <select  name="supplier_id" class="form-control select2" >
                                            <?php if($suppliers){ echo $suppliers; } ?>
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
                                    <div class="form-group col-md-3">
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
                                            <input type="submit" class="btn btn-primary"  id='filter' value="FILTER">
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
                                    <th style="width: 150px">PURCHASE DATE</th>
                                    <th>PURCHASE NO</th>
                                    <th>SUPPLIER NAME</th>
                                    <th>GST NUMBER</th>
                                    <!-- <th>TAX %</th> -->
                                    <th style="text-align: center;">NET TOTAL</th>
                                    <th style="text-align: center;">TAX</th>
                                    <th>TOTAL</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($lists){
                                    $total_amount = 0;
                                    $total_gst = 0;
                                    $total = 0;
                                    foreach ($lists as $key => $list) {  
                                        $total_amount  = $total_amount+$list['new_total'];
                                        $total_gst     = $total_gst+$list['new_tax'];
                                        $total = $total_amount + $total_gst;?>
                                        <tr>
                                            <td><?php echo ($key+1); ?></td>
                                            <td><?php echo date('d-m-Y',strtotime($list['purchase_date']));?></td>
                                            <td><?php echo $list['purchase_number']; ?></td>
                                            <td><?php echo $list['supplier_name']; ?></td>
                                            <td><?php echo $list['supplier_gst']; ?></td>
                                            <!-- <td><?php echo $list['tax_percentage']; ?></td> -->
                                            <td style="text-align: right;">&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia(($list['new_total']-$list['new_tax'])); ?></td>
                                            <td style="text-align: right;">&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($list['new_tax']); ?></td>
                                            <td style="text-align: right;">&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia(($list['new_total'])); ?></td>
                                        </tr>
                                    <?php } } ?>
                                    <tr>
                                        <td colspan="5"><strong>GRAND TOTAL : </strong></td>
                                        <td style="text-align:right;"><b><?php if($total_amount!="") { echo MoneyFormatIndia($total_amount); } else{  echo "0.00"; } ?></b></td>
                                        <td style="text-align:right;"><b>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($total_gst); ?></b></td>
                                        <td style="text-align:right;"><b>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($total); ?></b></td>
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