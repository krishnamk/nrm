<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Day Report List</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">List</a></li>
                                <li class="breadcrumb-item active">Day Report</li>
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
                                        <label class="control-label">FROM</label>
                                        <input type="date" id="date_from" name="date_from" class="form-control" value="<?php if(isset($date_from)){ if($date_from!=''){ echo date('Y-m-d',strtotime($date_from)); }}else{ echo date('Y-m-d'); } ?>" >
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="control-label">TO</label>
                                        <input type="date" id="date_to" name="date_to" class="form-control" value="<?php if(isset($date_from)){ if($date_from!=''){ echo date('Y-m-d',strtotime($date_to)); }}else{ echo date('Y-m-d'); } ?>" >
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="control-label">TYPE</label>
                                        <select id="payment_type" name="payment_type" class="form-control select2" >
                                            <option value="">SELECT TYPE</option>
                                            <option <?php if(isset($payment_type)){ if($payment_type=='cash'){ echo 'selected'; } } ?> value="cash">CASH</option>
                                            <option <?php if(isset($payment_type)){ if($payment_type=='cheque'){ echo 'selected'; } } ?> value="cheque">CHEQUE</option>
                                            <option <?php if(isset($payment_type)){ if($payment_type=='net_banking'){ echo 'selected'; } } ?> value="net_banking">INTERNET BANKING</option>
                                            <option <?php if(isset($payment_type)){ if($payment_type=='upi'){ echo 'selected'; } } ?> value="upi">UPI</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
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
                        <h3 class="card-title">DAY REPORT</h3>
                    </div>
                    <div class="card-body">
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <th>Date</th>
                                <th>Name</th>
                                <th>Particular</th>
                                <th>Payment Type</th>
                                <th>Remarks</th>
                                <th>Vch Type</th>
                                <th>Vch No</th>
                                <th>Debit</th>
                                <th>Credit</th>
                            </thead>
                            <tbody> 
                                <?php
                                $total_credit = 0;
                                $total_debit = 0;
                                $opening_balance_debit = 0;
                                $opening_balance_credit = 0;
                                $opening_debit = ( $previous_purchases +$previous_purchase_payments+$previous_expenses);
                                $opening_credit = ( $previous_payments + $previous_sales);
                                if($opening_debit > $opening_credit){
                                    $opening_balance_debit = ( $opening_debit - $opening_credit );
                                }
                                if($opening_debit < $opening_credit){
                                    $opening_balance_credit = ( $opening_credit - $opening_debit );
                                }
                                echo '<tr>
                                <td colspan="7" align="right"> <strong>OPENING BALANCE</strong></td>
                                <td align="right">&#8377;&nbsp;&nbsp;&nbsp;'.MoneyFormatIndia($opening_balance_debit).'</td>
                                <td align="right"><strong>&#8377;&nbsp;&nbsp;&nbsp;'.MoneyFormatIndia($opening_balance_credit).'</strong></td>
                                </tr>';
                                $total_debit  = $opening_balance_debit;
                                $total_credit = $opening_balance_credit;
                                if($sales){
                                    $sales_remarks = "";
                                    $payment_type = "";
                                    foreach ($sales as $salekey => $sale) {
                                        $payment_type = $sale['payment_type'];
                                        if($sale['payment_type'] == "net_banking"){
                                            $sales_remarks = $sale['bank_name'];
                                        }elseif($sale['payment_type'] == "cheque"){
                                            $sales_remarks = $sale['cheque_no'];
                                        }elseif($sale['payment_type'] == "cash"){
                                            $sales_remarks = $sale['remarks'];
                                        }else{
                                            $sales_remarks = $sale['upi_id'];
                                        }
                                        if($payments){
                                            $remarks = "";
                                            $payment_type = "";
                                            foreach ($payments as $paymentkey => $payment) {
                                                if(strtotime($payment['payment_date']) <= strtotime($sale['receipt_date'])){
                                                    $total_credit = $total_credit + $payment['paid_amount'];
                                                    $payment_type = $payment['payment_type'];
                                                    if($payment['payment_type'] == "net_banking"){
                                                        $remarks = $payment['bank_name'];
                                                    }elseif($payment['payment_type'] == "cheque"){
                                                        $remarks = $payment['cheque_no'];
                                                    }elseif($payment['payment_type'] == "cash"){
                                                        $remarks = $payment['remarks'];
                                                    }else{
                                                        $remarks = $payment['upi_id'];
                                                    }
                                                    echo '<tr>
                                                    <td>'.date('d/m/Y',strtotime($payment['payment_date'])).'</td>
                                                    <td>'.$payment['name'].'</td>
                                                    <td>Invoice Payment</td>
                                                    <td>'.$payment_type.'</td>
                                                    <td>'.$remarks.'</td>
                                                    <td><strong>INVOICE PAYMENT</strong></td>
                                                    <td>'.$payment['invoice_number'].'</td>
                                                    <td></td>
                                                    <td align="right"><strong>&#8377;&nbsp;&nbsp;&nbsp;'.MoneyFormatIndia($payment['paid_amount']).'</strong></td>
                                                    </tr>';
                                                    unset($payments[$paymentkey]);
                                                }
                                            }
                                        }
                                        if($purchase_payments){
                                            $remarks = "";
                                            $payment_type = "";
                                            foreach ($purchase_payments as $purchase_paymentkey => $purchase_payment) {
                                                if(strtotime($purchase_payment['payment_date']) <= strtotime($sale['receipt_date'])){
                                                    $total_debit = $total_debit + $purchase_payment['paid_amount'];
                                                    $payment_type = $purchase_payment['payment_type'];
                                                    if($purchase_payment['payment_type'] == "net_banking"){
                                                        $remarks = $purchase_payment['bank_name'];
                                                    }elseif($purchase_payment['payment_type'] == "cheque"){
                                                        $remarks = $purchase_payment['cheque_no'];
                                                    }elseif($purchase_payment['payment_type'] == "cash"){
                                                        $remarks = $purchase_payment['remarks'];
                                                    }else{
                                                        $remarks = $purchase_payment['upi_id'];
                                                    }
                                                    echo '<tr>
                                                    <td>'.date('d/m/Y',strtotime($purchase_payment['payment_date'])).'</td>
                                                    <td>'.$purchase_payment['name'].'</td>
                                                    <td>Purchase Payment</td>
                                                    <td>'.$payment_type.'</td>
                                                    <td>'.$remarks.'</td>
                                                    <td><strong>PURCHASE PAYMENT</strong></td>
                                                    <td>'.$purchase_payment['purchase_number'].'</td>
                                                    <td align="right"><strong>&#8377;&nbsp;&nbsp;&nbsp;'.MoneyFormatIndia($purchase_payment['paid_amount']).'</strong></td>
                                                    <td></td>
                                                    </tr>';
                                                    unset($purchase_payment[$purchase_paymentkey]);
                                                }
                                            }
                                        }
                                        if($purchases){
                                            $remarks = "";
                                            $payment_type = "";
                                            foreach ($purchases as $purchasekey => $purchase) {
                                                if(strtotime($purchase['payment_date']) <= strtotime($sale['receipt_date'])){
                                                    $total_debit = $total_debit + $purchase['paid_amount'];
                                                    $payment_type = $purchase['payment_type'];
                                                    if($purchase['payment_type'] == "net_banking"){
                                                        $remarks = $purchase['bank_name'];
                                                    }elseif($purchase['payment_type'] == "cheque"){
                                                        $remarks = $purchase['cheque_no'];
                                                    }elseif($purchase['payment_type'] == "cash"){
                                                        $remarks = $purchase['remarks'];
                                                    }else{
                                                        $remarks = $purchase['upi_id'];
                                                    }
                                                    echo '<tr>
                                                    <td>'.date('d/m/Y',strtotime($purchase['payment_date'])).'</td>
                                                    <td>'.$purchase['name'].'</td>
                                                    <td>Purchases </td>
                                                    <td>'.$payment_type.'</td>
                                                    <td>'.$remarks.'</td>
                                                    <td><strong>PURCHASE</strong></td>
                                                    <td>'.$purchase['payment_number'].'</td>
                                                    <td align="right"><strong>&#8377;&nbsp;&nbsp;&nbsp;'.MoneyFormatIndia($purchase['paid_amount']).'</strong></td>
                                                    <td></td>
                                                    </tr>';
                                                    unset($purchases[$purchasekey]);
                                                }
                                            }
                                        }
                                        if($expenses){
                                            $remarks = "";
                                            $payment_type = "";
                                            foreach ($expenses as $expensekey => $expense) {
                                                if(strtotime($expense['expense_date']) <= strtotime($sale['receipt_date'])){
                                                    $total_debit = $total_debit + $expense['expense_amount'];
                                                    $remarks = $expense['expense_remark'];
                                                    $payment_type = "cash";
                                                    echo '<tr>
                                                    <td>'.date('d/m/Y',strtotime($expense['expense_date'])).'</td>
                                                    <td>'.$expense['name'].'</td>
                                                    <td>Expenses </td>
                                                    <td>'.$payment_type.'</td>
                                                    <td>'.$remarks.'</td>
                                                    <td><strong>EXPENSES</strong></td>
                                                    <td>'.$expense['expense_number'].'</td>
                                                    <td align="right"><strong>&#8377;&nbsp;&nbsp;&nbsp;'.MoneyFormatIndia($expense['expense_amount']).'</strong></td>
                                                    <td></td>
                                                    </tr>';
                                                    unset($expenses[$expensekey]);
                                                }
                                            }
                                        }
                                        $total_credit = $total_credit + $sale['paid_amount'];
                                        echo '<tr>
                                        <td>'.date('d/m/Y',strtotime($sale['receipt_date'])).'</td>
                                        <td>'.$sale['name'].'</td>
                                        <td>Sales </td>
                                        <td>'.$payment_type.'</td>
                                        <td>'.$sales_remarks.'</td>
                                        <td><strong>SALES</strong></td>
                                        <td>'.$sale['receipt_number'].'</td>
                                        <td></td>
                                        <td align="right"><strong>&#8377;&nbsp;&nbsp;&nbsp;'.MoneyFormatIndia($sale['paid_amount']).'</strong></td>
                                        </tr>';
                                    }
                                }
                                if($payments){
                                    $payment_remarks = "";
                                    $payment_type = "";
                                    foreach ($payments as $paymentkey => $payment) {
                                        $payment_type = $payment['payment_type'];
                                        if($payment['payment_type'] == "net_banking"){
                                            $payment_remarks = $payment['bank_name'];
                                        }elseif($payment['payment_type'] == "cheque"){
                                            $payment_remarks = $payment['cheque_no'];
                                        }elseif($payment['payment_type'] == "cash"){
                                            $payment_remarks = $payment['remarks'];
                                        }else{
                                            $payment_remarks = $payment['upi_id'];
                                        }
                                        if($purchases){
                                            foreach ($purchases as $purchasekey => $purchase) {
                                                if(strtotime($purchase['payment_date']) <= strtotime($payment['payment_date'])){
                                                    $total_debit = $total_debit + $purchase['paid_amount'];
                                                    echo '<tr>
                                                    <td>'.date('d/m/Y',strtotime($purchase['payment_date'])).'</td>
                                                    <td>'.$purchase['name'].'</td>
                                                    <td>Purchases </td>
                                                    <td>'.$purchase['remarks'].'</td>
                                                    <td><strong>PURCHASE</strong></td>
                                                    <td>'.$purchase['payment_number'].'</td>
                                                    <td align="right"><strong>&#8377;&nbsp;&nbsp;&nbsp;'.MoneyFormatIndia($purchase['paid_amount']).'</strong></td>
                                                    <td></td>
                                                    </tr>';
                                                    unset($purchases[$purchasekey]);
                                                }
                                            }
                                        }
                                        if($expenses){
                                            foreach ($expenses as $expensekey => $expense) {
                                                if(strtotime($expense['expense_date']) <= strtotime($payment['payment_date'])){
                                                    $total_debit = $total_debit + $expense['expense_amount'];
                                                    echo '<tr>
                                                    <td>'.date('d/m/Y',strtotime($expense['expense_date'])).'</td>
                                                    <td>'.$expense['name'].'</td>
                                                    <td>Expenses </td>
                                                    <td>'.$expense['expense_remark'].'</td>
                                                    <td><strong>EXPENSES</strong></td>
                                                    <td>'.$expense['expense_number'].'</td>
                                                    <td align="right"><strong>&#8377;&nbsp;&nbsp;&nbsp;'.MoneyFormatIndia($expense['expense_amount']).'</strong></td>
                                                    <td></td>
                                                    </tr>';
                                                    unset($expenses[$expensekey]);
                                                }
                                            }
                                        }
                                        $total_credit = $total_credit + $payment['paid_amount'];
                                        echo '<tr>
                                        <td>'.date('d/m/Y',strtotime($payment['payment_date'])).'</td>
                                        <td>'.$payment['name'].'</td>
                                        <td>Invoice Payment </td>
                                        <td>'.$payment_type.'</td>
                                        <td>'.$payment_remarks.'</td>
                                        <td><strong>INVOICE PAYMENT</strong></td>
                                        <td>'.$payment['invoice_number'].'</td>
                                        <td></td>
                                        <td align="right"><strong>&#8377;&nbsp;&nbsp;&nbsp;'.MoneyFormatIndia($payment['paid_amount']).'</strong></td>
                                        </tr>';
                                    }
                                }
                                if($purchases){
                                    foreach ($purchases as $purchasekey => $purchase) {
                                        if($expenses){
                                            foreach ($expenses as $expensekey => $expense) {
                                                if(strtotime($expense['expense_date']) <= strtotime($purchase['payment_date'])){
                                                    $total_debit = $total_debit + $expense['expense_amount'];
                                                    echo '<tr>
                                                    <td>'.date('d/m/Y',strtotime($expense['expense_date'])).'</td>
                                                    <td>'.$expense['name'].'</td>
                                                    <td>Expenses </td>
                                                    <td>'.$expense['expense_remark'].'</td>
                                                    <td><strong>EXPENSES</strong></td>
                                                    <td>'.$expense['expense_number'].'</td>
                                                    <td align="right"><strong>&#8377;&nbsp;&nbsp;&nbsp;'.MoneyFormatIndia($expense['expense_amount']).'</strong></td>
                                                    <td></td>
                                                    </tr>';
                                                    unset($expenses[$expensekey]);
                                                }
                                            }
                                        }
                                        $total_debit = $total_debit + $purchase['paid_amount'];
                                        echo '<tr>
                                        <td>'.date('d/m/Y',strtotime($purchase['payment_date'])).'</td>
                                        <td>'.$purchase['name'].'</td>
                                        <td>Purchases </td>
                                        <td>'.$purchase['remarks'].'</td>
                                        <td><strong>PURCHASE</strong></td>
                                        <td>'.$purchase['payment_number'].'</td>
                                        <td align="right"><strong>&#8377;&nbsp;&nbsp;&nbsp;'.MoneyFormatIndia($purchase['paid_amount']).'</strong></td>
                                        <td></td>
                                        </tr>';
                                    }
                                }
                                if($expenses){
                                    foreach ($expenses as $expensekey => $expense) {
                                        $total_debit = $total_debit + $expense['expense_amount'];
                                        echo '<tr>
                                        <td>'.date('d/m/Y',strtotime($expense['expense_date'])).'</td>
                                        <td>'.$expense['name'].'</td>
                                        <td>Expenses </td>
                                        <td>'.$expense['expense_remark'].'</td>
                                        <td><strong>EXPENSES</strong></td>
                                        <td>'.$expense['expense_number'].'</td>
                                        <td align="right"><strong>&#8377;&nbsp;&nbsp;&nbsp;'.MoneyFormatIndia($expense['expense_amount']).'</strong></td>
                                        <td></td>
                                        </tr>';
                                    }
                                }
                                ?>
                                <tr>
                                    <td colspan="7" align="right"><strong>TOTAL</strong></td>
                                    <td align="right"><strong>&#8377;<?php echo MoneyFormatIndia($total_debit); ?></strong></td>
                                    <td align="right"><strong>&#8377;<?php echo MoneyFormatIndia($total_credit); ?></strong></td>
                                </tr>
                                <tr>
                                    <td colspan="7" align="right"><strong>CLOSING BALANCE</strong></td>
                                    <td align="right"><strong><?php if($total_debit > $total_credit){ echo MoneyFormatIndia($total_debit - $total_credit); } ?></strong></td>
                                    <td align="right"><strong><?php if($total_debit < $total_credit){ echo MoneyFormatIndia($total_credit - $total_debit); } ?></strong></td>
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