<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">JOURNAL</h4>
                        <div class="page-title-right">
                            <div class="d-flex align-items-center justify-content-end">
                                <div class="col-12 ">
                                    <?php if($this->session->userdata('access_level')<=2){ ?>
                                        <a href="<?php echo base_url('journal');?>" class="btn btn-primary float-right">NEW JOURNAL</a>
                                    <?php } ?>
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
                            <div class="card-body">
                                <br>
                                <div class="row">
                                    <div class="form-group col-md-2">
                                        <label class="control-label">FROM</label>
                                        <input type="date" id="date_from" name="date_from" class="form-control" value="<?php if(isset($date_from)){ if($date_from!=''){ echo date('Y-m-d',strtotime($date_from)); }} ?>" >
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="control-label">TO</label>
                                        <input type="date" id="date_to" name="date_to" class="form-control" value="<?php if(isset($date_from)){ if($date_from!=''){ echo date('Y-m-d',strtotime($date_to)); }} ?>" >
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="control-label">FOR</label>
                                        <select id="journal_type" name="journal_type" class="form-control ">
                                            <option value="">SELECT</option>
                                            <option <?php  if(isset($journal_type)){ if($journal_type == 'customer'){ echo "selected"; } }  ?> value="customer">CUSTOMER</option>
                                            <option <?php  if(isset($journal_type)){ if($journal_type == 'supplier'){ echo "selected"; } } ?> value="supplier">SUPPLIER</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2 for for_customer">
                                        <label class="control-label">CUSTOMER</label>
                                        <select id="customer_id" name="customer_id" class="form-control select2">
                                            <?php  if(isset($customer_id)){ customers($customer_id); }else{ customers(); }?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2 for for_supplier">
                                        <label class="control-label">SUPPLIER</label>
                                        <select id="supplier_id" name="supplier_id" class="form-control select2">
                                            <?php  if(isset($supplier_id)){ suppliers($supplier_id); }else{ suppliers(); }?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="col-lg-12">&nbsp;</label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="radio">VIEW
                                                    <input type="radio" name="option" value="view" <?php if(isset($option)){ if($option=='view'){ echo "checked";} }else{echo "checked";}?> >
                                                    <span class="checkround"></span>
                                                </label>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="radio">PRINT
                                                    <input type="radio" name="option" value="print" <?php if(isset($option)){ if($option=='print'){ echo "checked";} }?> >
                                                    <span class="checkround"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-1">
                                        <label class="control-label col-lg-12">&nbsp;</label>
                                        <input type="submit" class="btn btn-primary" value="FILTER">
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
                        <h3 class="card-title">JOURNAL</h3>
                    </div>
                    <div class="card-body">
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>S.NO</th>
                                    <th>DATE</th>
                                    <th>JOURNAL NUMBER</th>
                                    <th>CUSTOMER / SUPPLIER</th>
                                    <th>DISCOUNT AMOUNT</th>
                                    <th>ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($lists){
                                    foreach ($lists as $key => $list) { ?>
                                        <tr>
                                            <td><?php echo $key+1;?></td>
                                            <td><?php echo date('d-m-Y',strtotime($list['journal_date']));?></td>
                                            <td><?php echo $list['journal_number'];?></td>
                                            <td><?php if($list['customer_id'] != 0){ echo $list['customer_name'].'-'.$list['customers_mobile']; }else{ echo $list['supplier_name'].'-'.$list['supplier_mobile']; }?></td>
                                            <td>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($list['amount']);?></td>
                                            <td>
                                                <a href="<?php echo base_url('journal_view/'.$list['journal_id']);?>" class="btn btn-primary get_model_content"  data-toggle="modal" data-target="#responsive-modal"  data-toggle="tooltip" data-placement="top" title="Journal View" style="margin-top:5px;"><i class="fa fa-eye" ></i></a>&nbsp;
                                                <?php if($this->session->userdata('access_level')!=1){
                                                    if($list['status']==1){ ?>
                                                        <a href="<?php echo base_url('journal_edit/'.$list['journal_id']);?>" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Journal Edit" style="margin-top:5px;"><i class="fa fa-pencil-alt"></i></a> &nbsp;
                                                        <a href="<?php echo base_url('journal_remove/'.$list['journal_id']);?>" class="btn btn-danger cancel" data-toggle="tooltip" data-placement="top" title="Journal Remove" style="margin-top:5px;"><i class="fa fa-trash"></i></a> &nbsp;
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
<script type="text/javascript">
    $(document).ready(function(e){
        var journal_type =  $('#journal_type').val();
        $('.for').hide();
        $('.for_'+journal_type).show();
    });
    $('body').on('change','#journal_type',function(e){
        var journal_type =  $(this).val();
        $('.for').hide();
        $('.for_'+journal_type).show();
    });
</script>