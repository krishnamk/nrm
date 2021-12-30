<div class="main-content"> 
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">PURCHASE PAYMENT</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Sales Payment</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 message"><?php message(); ?></div>
            </div>
            <div class="row add_estimate_payment_view"  >
                <div class="col-md-12">
                    <div class="card">
                        <form class="form-horizontal" method="post">
                            <br>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="control-label">PAYMENT NUMBER</label>
                                        <input type="text" id="payment_number" name="payment_number" class="form-control" placeholder="PAYMENT NUMBER" value="<?php echo $payment_number; ?>" readonly>
                                    </div>
                                    <div class="form-group col-md-6" style="">
                                        <label class="control-label">PAYMENT DATE</label>
                                        <input type="date" id="payment_date" name="payment_date" class="form-control" placeholder="PAYMENT DATE" value="<?php echo $payment_date; ?>" >
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="control-label">SUPPLIER</label>
                                        <select class="form-control select2" id="supplier_id" name="supplier_id">
                                            <?php if(isset($supplier_id)){ suppliers($supplier_id); }else{ suppliers(); } ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label">PAYMENT TYPE</label>
                                        <select class="form-control payment_type" id="payment_type" name="payment_type">
                                            <option  value="">SELECT PAYMENT TYPE</option>
                                            <option <?php if(isset($payment)){ if($payment['payment_type'] =="cash"){ echo "selected"; } } ?> value="cash">CASH</option>
                                            <option  <?php if(isset($payment)){ if($payment['payment_type'] =="cheque"){ echo "selected"; } } ?> value="cheque">CHEQUE</option>
                                            <option <?php if(isset($payment)){ if($payment['payment_type'] =="net_banking"){ echo "selected"; } } ?> value="net_banking">INTERNET BANKING</option>
                                            <option <?php if(isset($payment)){ if($payment['payment_type'] =="upi_id"){ echo "selected"; } } ?> value="upi_id">UPI</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="control-label">PAID AMOUNT</label>
                                        <input type="text" id="paid_amount" name="paid_amount" class="form-control" placeholder="ENTER AMOUNT" value="<?php if(isset($payment)){ echo $payment['paid_amount']; } ?>" >
                                    </div>
                                    <div class="form-group col-md-6 cheque payment_details" style="<?php if(isset($payment)){ if($payment['payment_type'] =="cheque"){ echo "display: block;"; }else{echo 'display: none;';} }else{ echo 'display: none;'; } ?>">
                                        <label class="control-label">CHEQUE NUMBER</label>
                                        <input type="text" id="checque_number" name="checque_number" class="form-control" placeholder="ENTER CHECQUE NUMBER" value="<?php if(isset($payment)){ echo $payment['cheque_no']; } ?>" >
                                    </div>
                                    <div class="form-group col-md-6 net_banking payment_details" style="<?php if(isset($payment)){ if($payment['payment_type'] =="net_banking"){ echo "display: block;"; }else{echo 'display: none;';} }else{ echo 'display: none;'; } ?>">
                                        <label class="control-label">BANK NAME</label>
                                        <input type="text" id="bank_name" name="bank_name" class="form-control" placeholder="ENTER BANK NAME" value="<?php if(isset($payment)){ echo $payment['bank_name']; } ?>" >
                                    </div>
                                    <div class="form-group col-md-6 upi_id payment_details" style="<?php if(isset($payment)){ if($payment['payment_type'] =="upi_id"){ echo "display: block;"; }else{echo 'display: none;';} }else{ echo 'display: none;'; } ?>">
                                        <label class="control-label">UPI ID</label>
                                        <input type="text" id="upi_id" name="upi_id" class="form-control" placeholder="ENTER UPI ID" value="<?php if(isset($payment)){ echo $payment['upi_id']; } ?>" >
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6 " >
                                        <label class="control-label">REMARKS</label>
                                        <input type="text" id="payment_remark" name="payment_remark" class="form-control" placeholder="ENTER REMARKS" value="<?php if(isset($payment)){ echo $payment['remarks']; } ?>" >
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <button type="submit" class="btn btn-success add_estimate_payment float-right"> <i class="fa fa-pencil"></i> PAY NOW</button>
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