<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">PAYMENT DETAILS</h4>
                        <div class="page-title-right">
                            <div class="d-flex align-items-center justify-content-end">
                                <div class="col-12 ">
                                 <a href="<?php echo base_url('invoice_payment_list');?>" style="margin-right: 5px;" class="btn btn-primary float-right"><i class="fa fas fa-backward"></i>&nbsp;BACK</a>
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
            <div class="col-12">
                <div class="card">
                    <form class="form-horizontal">
                        <div class="form-body">
                            <div class="card-body">
                                <table class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <tbody>
                                        <tr>
                                            <td><label><strong>INVOICE NUMBER</strong></label></td>
                                            <td><label><?php echo $payment['invoice_number']; ?></label></td>
                                            <td><label><strong>INVOICE DATE</strong></label></td>
                                            <td><label><?php echo date('d-m-Y',strtotime($payment['invoice_date'])); ?></label></td>
                                        </tr>
                                        <tr>
                                            <td><label><strong>CUSTOMER NAME</strong></label></td>
                                            <td><label><?php echo $payment['customer_name']; ?></label></td>
                                            <td><label><strong>INVOICE AMOUNT</strong></label></td>
                                            <td><label>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($payment['invoice_amount']); ?></label></td>
                                        </tr>
                                        <tr>
                                            <td><label><strong> BALANCE AMOUNT </strong></label></td>
                                            <td><label>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($payment['invoice_amount']-$payment['paid_amount'])); ?></label></td>
                                            <td><label><strong>INVOICE STATUS</strong></label></td>
                                            <td><label><?php echo payment_status($payment['invoice_status']); ?></label></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <h4 class="card-title">PAYMENT PAID DETAILS</h4>
        <div class="card-body">
            <table class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                    <tr>
                        <th>S.NO</th>
                        <th>DATE</th>
                        <th>PAID AMOUNT</th>
                        <th>PAYMENT TYPE</th>
                        <th>PAYMENT DETAILS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($payment['history']){
                        foreach ($payment['history'] as $key => $history) { ?>
                            <tr>
                                <td><label><strong><?php echo next_number($key); ?></strong></label></td>
                                <td><label><?php echo date('d-m-Y',strtotime($history['payment_date'])); ?></label></td>
                                <td><i class="fa fa-rupee-sign"></i>&nbsp;&nbsp;<label>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($history['paid_amount'])); ?></label></td>
                                <td><label><?php echo $history['payment_type']; ?></label></td>
                                <td><label><?php if($history['payment_type']=='cash'){
                                    echo 'REMARK : '.$history['remarks'];
                                }elseif($history['payment_type']=='cheque'){
                                    echo 'CHEQUE NUMBER : '.$history['cheque_no'];
                                }elseif($history['payment_type']=='net_banking'){
                                    echo 'BANK NAME : '.$history['bank_name'];
                                }else{
                                    echo 'UPI ID : '.$history['upi_id'];
                                } ?></label></td>
                            </tr>
                        <?php }
                    } ?>
                </tbody>
            </table>
        </div>
        <div class="form-actions">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <button type="submit" class="btn btn-success add_invoice_payment_show float-right" style="<?php if(($payment['invoice_amount']-$payment['paid_amount'])<=0){ echo 'display: none;'; } ?>">ADD PAYMENT</button> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row add_invoice_payment_view" style="display: none;">
            <div class="col-md-12">
                <div class="card">
                    <form class="form-horizontal" method="post" action="<?php echo base_url('invoice/add_invoice_payment_bills');?>">
                        <div class="card-body">
                            <h4 class="card-title">ADD PAYMENT</h4>
                        </div>
                        <hr class="m-t-0 m-b-40">
                        <div class="col-md-12">
                           <div class="row">
                            <div class="form-group col-md-6">
                                <label class="control-label">INVOICE AMOUNT</label>
                                <input type="hidden" id="invoice_payments_id" name="invoice_payments_id" class="form-control" placeholder="invoice AMOUNT" value="<?php echo $payment['invoice_payments_id']; ?>" readonly> 
                                <input type="hidden" id="customer_id" name="customer_id" class="form-control" value="&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($payment['customer_id'])); ?>" readonly> 
                                <input type="text" id="invoice_amount" name="invoice_amount" class="form-control" placeholder="invoice AMOUNT" value="&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($payment['invoice_amount'])); ?>" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">BALANCE AMOUNT</label>
                                <input type="text" style="background-color: #FCF5D8;" id="balance_amount" name="balance_amount" class="form-control form-control-danger" placeholder="BALANCE AMOUNT" value="&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($payment['invoice_amount']-$payment['paid_amount'])); ?>" readonly>
                            </div>
                        </div>
                        <div class="row"> 
                            <div class="form-group col-md-6">
                                <label class="control-label">AMOUNT TO BE PAID</label>
                                <input type="text" id="paid_amount" name="paid_amount" class="form-control" placeholder="PLEASE ENTER AMOUNT" value="&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($payment['invoice_amount']-$payment['paid_amount'])); ?>" >
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">PAYMENT TYPE</label>
                                <select class="form-control payment_type" id="payment_type" name="payment_type">
                                    <option value="">SELECT PAYMENT TYPE</option>
                                    <option value="cash">CASH</option>
                                    <option value="cheque">CHEQUE</option>
                                    <option value="net_banking">NEFT/RTGS</option>
                                    <option value="upi_id">UPI</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6" style="">
                                <label class="control-label">PAYMENT DATE</label>
                                <input type="text" id="payment_date" name="payment_date" class="form-control" placeholder="PAYMENT DATE" value="<?php echo date('d-m-Y'); ?>" >
                            </div>
                            <div class="form-group col-md-6 cash payment_details" style="display: none;">
                                <label class="control-label">REMARKS</label>
                                <input type="text" id="paymentremark" name="remark" class="form-control" placeholder="PLEASE REMARKS" value="" >
                            </div>
                            <div class="form-group col-md-6 cheque payment_details" style="display: none;">
                                <label class="control-label">CHEQUE NUMBER</label>
                                <input type="text" id="cheque_number" name="cheque_number" class="form-control" placeholder="PLEASE ENTER CHEQUE NUMBER" value="" >
                            </div>
                            <div class="form-group col-md-6 net_banking payment_details" style="display: none;">
                                <label class="control-label">TRANSACTION ID</label>
                                <input type="text" id="bank_name" name="bank_name" class="form-control" placeholder="PLEASE ENTER TRANSACTION ID" value="" >
                            </div>
                            <div class="form-group col-md-6 upi_id payment_details" style="display: none;">
                                <label class="control-label">UPI ID</label>
                                <input type="text" id="upi_id" name="upi_id" class="form-control" placeholder="PLEASE ENTER UPI ID" value="" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <button type="submit" class="btn btn-success add_invoice_payment float-right"> <i class="fa fa-pencil"></i> PAY NOW</button>
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