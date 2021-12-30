<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">PURCHASE PAYMENT</h4>
                        <div class="page-title-right">
                            <div class="d-flex align-items-center justify-content-end">
                                <div class="col-12 ">
                                    <!-- <?php if($this->session->userdata('access_level')!=1){ ?>
                                       <a href="<?php echo base_url('purchase_payments');?>" class="btn btn-primary float-right">NEW PAYMENT</a>
                                       <?php } ?> -->
                                       <a href="<?php echo base_url('purchase_payments');?>" class="btn btn-primary float-right">NEW PAYMENT</a>
                                   </div>
                               </div>
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
                                            <?php if(isset($supplier_id)){ suppliers($supplier_id); }else{ suppliers(); } ?>
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
                        <h3 class="card-title">PURCHASE PAYMENT SUMMARY</h3>
                    </div>
                    <div class="card-body">
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>S.NO</th>
                                    <th>PAYMENT NUMBER</th>
                                    <th>DATE</th>
                                    <th>SUPPLIER</th>
                                    <th>PAID AMOUNT</th>
                                    <th>ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($lists){
                                    foreach ($lists as $key => $list) { ?>
                                        <tr>
                                            <td><?php echo $key+1;?></td>
                                            <td><?php echo $list['payment_number'];?></td>
                                            <td><?php echo date('d-m-Y',strtotime($list['payment_date']));?></td>
                                            <td><?php echo $list['supplier_name'].'-'.$list['supplier_phone'];?></td>
                                            <td>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($list['paid_amount']);?></td>
                                            <td>
                                                <a href="<?php echo base_url('purchase_payments_view/'.$list['payment_id']);?>" class="btn btn-primary get_model_content"  data-toggle="modal" data-target="#responsive-modal" data-placement="top" title="Payment View" style="margin-top:5px;"><i class="fa fa-eye" ></i></a>&nbsp;
                                                <?php if($this->session->userdata('access_level')<=2){
                                                    if($list['status']==1){ ?>
                                                        <a href="<?php echo base_url('purchase_payments_edit/'.$list['payment_id']);?>" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Payment Edit" style="margin-top:5px;"><i class="fa fa-pencil-alt"></i></a> &nbsp;
                                                        <a href="<?php echo base_url('purchase_payments_remove/'.$list['payment_id']);?>" class="btn btn-danger cancel" data-toggle="tooltip" data-placement="top" title="Payment Remove" style="margin-top:5px;"><i class="fa fa-trash"></i></a> &nbsp;
                                                        <a href="<?php echo base_url('purchase_payments_voucher/'.$list['payment_id']);?>" class="btn btn-dark get_model_content"  data-toggle="modal" data-target="#responsive-modal" data-placement="top" title="Payment View" style="margin-top:5px;"><i class="fa fa-sticky-note" aria-hidden="true"></i></a>&nbsp;
                                                    <?php } } ?>
                                                </td>
                                            </tr>
                                        <?php    }
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div>
    </div>
</div>