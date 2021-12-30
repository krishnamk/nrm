<div class="main-content"> 
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">RECEIPT</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Sales Receipt</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 message"><?php message(); ?></div>
            </div>
            <div class="row add_estimate_receipt_view"  >
                <div class="col-md-12">
                    <div class="card">
                        <form class="form-horizontal" method="post">
                            <br>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="control-label">RECEIPT NUMBER</label>
                                        <input type="text" id="receipt_number" name="receipt_number" class="form-control" placeholder="RECEIPT NUMBER" value="<?php echo $receipt_number; ?>" readonly>
                                    </div>
                                    <div class="form-group col-md-6" style="">
                                        <label class="control-label">RECEIPT DATE</label>
                                        <input type="date" id="receipt_date" name="receipt_date" class="form-control" placeholder="RECEIPT DATE" value="<?php echo $receipt_date; ?>" >
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="control-label">SELECT TYPE</label>
                                        <select class="form-control select2" id="customer_type_id" name="customer_type_id">
                                            <?php if(isset($receipt['customer_type_id'])){ customer_type($receipt['customer_type_id']); }else{ customer_type(); } ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label">CUSTOMER</label>
                                        <select class="form-control select2" id="customer_id" name="customer_id">
                                            <?php if(isset($receipt['customer_id'])){ customers($receipt['customer_id']); }else{ customers(); } ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label">PAYMENT TYPE</label>
                                        <select class="form-control payment_type" id="payment_type" name="payment_type">
                                            <option  value="">SELECT PAYMENT TYPE</option>
                                            <option <?php if(isset($receipt)){ if($receipt['payment_type'] =="cash"){ echo "selected"; } } ?> value="cash">CASH</option>
                                            <option  <?php if(isset($receipt)){ if($receipt['payment_type'] =="cheque"){ echo "selected"; } } ?> value="cheque">CHEQUE</option>
                                            <option <?php if(isset($receipt)){ if($receipt['payment_type'] =="net_banking"){ echo "selected"; } } ?> value="net_banking">INTERNET BANKING</option>
                                            <option <?php if(isset($receipt)){ if($receipt['payment_type'] =="upi_id"){ echo "selected"; } } ?> value="upi_id">UPI</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label">PAID AMOUNT</label>
                                        <input type="text" id="paid_amount" name="paid_amount" class="form-control" placeholder="ENTER AMOUNT" value="<?php if(isset($receipt)){ echo $receipt['paid_amount']; } ?>" >
                                    </div>
                                    <div class="form-group col-md-6 cheque payment_details" style="<?php if(isset($receipt)){ if($receipt['payment_type'] =="cheque"){ echo "display: block;"; }else{echo 'display: none;';} }else{ echo 'display: none;'; } ?>">
                                        <label class="control-label">CHEQUE NUMBER</label>
                                        <input type="text" id="checque_number" name="checque_number" class="form-control" placeholder="ENTER CHECQUE NUMBER" value="<?php if(isset($receipt)){ echo $receipt['cheque_no']; } ?>" >
                                    </div>
                                    <div class="form-group col-md-6 net_banking payment_details" style="<?php if(isset($receipt)){ if($receipt['payment_type'] =="net_banking"){ echo "display: block;"; }else{echo 'display: none;';} }else{ echo 'display: none;'; } ?>">
                                        <label class="control-label">BANK NAME</label>
                                        <input type="text" id="bank_name" name="bank_name" class="form-control" placeholder="ENTER BANK NAME" value="<?php if(isset($receipt)){ echo $receipt['bank_name']; } ?>" >
                                    </div>
                                    <div class="form-group col-md-6 upi_id payment_details" style="<?php if(isset($receipt)){ if($receipt['payment_type'] =="upi_id"){ echo "display: block;"; }else{echo 'display: none;';} }else{ echo 'display: none;'; } ?>">
                                        <label class="control-label">UPI</label>
                                        <input type="text" id="upi_id" name="upi_id" class="form-control" placeholder="ENTER UPI ID" value="<?php if(isset($receipt)){ echo $receipt['upi_id']; } ?>" >
                                    </div>
                                    <div class="form-group col-md-6 " >
                                        <label class="control-label">REMARKS</label>
                                        <input type="text" id="payment_remark" name="payment_remark" class="form-control" placeholder="ENTER REMARKS" value="<?php if(isset($receipt)){ echo $receipt['remarks']; } ?>" >
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <button type="submit" class="btn btn-success add_estimate_payment float-right"> <i class="fa fa-pencil"></i> SAVE</button>
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