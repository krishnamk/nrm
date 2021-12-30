<div class="main-content"> 
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">JOURNAL</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Journal</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 message"><?php message(); ?></div>
            </div>
            <div class="row add_estimate_journal_view"  >
                <div class="col-md-12">
                    <div class="card">
                        <form class="form-horizontal" method="post" action="">
                        <br>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="control-label">JOURNAL NUMBER</label>
                                    <input type="text" id="journal_number" name="journal_number" class="form-control" placeholder="JOURNAL NUMBER" value="<?php echo $journal_number; ?>" readonly>
                                </div>
                                <div class="form-group col-md-6" style="">
                                    <label class="control-label">JOURNAL DATE</label>
                                    <input type="date" id="journal_date" name="journal_date" class="form-control" placeholder="JOURNAL DATE" value="<?php echo $journal_date; ?>" >
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="control-label">JOURNAL TYPE</label>
                                    <select class="form-control" id="journal_type" name="journal_type">
                                        <option value="customer" <?php if(isset($journal)){ if($journal['journal_type'] =='customer'){ echo "selected"; } }else{ echo "selected";} ?> >FOR CUSTOMER</option>
                                        <option value="supplier" <?php if(isset($journal)){ if($journal['journal_type'] =='supplier'){ echo "selected"; } }?>>FROM SUPPLIER</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6 for for_supplier">
                                    <label class="control-label">SUPPLIER</label>
                                    <select class="form-control select2" id="supplier_id" name="supplier_id">
                                        <?php if(isset($journal)){ suppliers($journal['supplier_id']); }else{ suppliers(); } ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-6 for for_customer">
                                    <label class="control-label">CUSTOMER</label>
                                    <select class="form-control select2" id="customer_id" name="customer_id">
                                        <?php if(isset($journal)){ customers($journal['customer_id']); }else{ customers(); } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="control-label">AMOUNT</label>
                                    <input type="text" id="amount" name="amount" class="form-control" placeholder="PLEASE ENTER AMOUNT" value="<?php if(isset($journal)){ echo $journal['amount']; } ?>" >
                                </div>
                                <div class="form-group col-md-6 " >
                                    <label class="control-label">REMARKS</label>
                                    <input type="text" id="remarks" name="remarks" class="form-control" placeholder="PLEASE REMARKS" value="<?php if(isset($journal)){ echo $journal['remarks']; } ?>" >
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <button type="submit" class="btn btn-success add_estimate_journal float-right"> <i class="fa fa-pencil"></i><?php if(isset($journal)){ echo "UPDATE"; }else{ echo "CREATE"; } ?></button>
                                </div>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
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