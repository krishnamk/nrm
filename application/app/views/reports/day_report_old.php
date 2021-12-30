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
                                            <option>SELECT TYPE</option>
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
                                $opening_debit = ( $previous_purchases +$previous_purchase_payments+$previous_expenses + $previous_journals_customer );
                                $opening_credit = ( $previous_payments + $previous_sales + $previous_journals_supplier );
                                if($opening_debit > $opening_credit){
                                    $opening_balance_debit = ( $opening_debit - $opening_credit );
                                }
                                if($opening_debit < $opening_credit){
                                    $opening_balance_credit = ( $opening_credit - $opening_debit );
                                }
                                echo '<tr>
                                <td colspan="6" align="right"> <strong>OPENING BALANCE</strong></td>
                                <td align="right">'.MoneyFormatIndia($opening_balance_debit).'</td>
                                <td align="right"><strong>'.MoneyFormatIndia($opening_balance_credit).'</strong></td>
                                </tr>';
                                $total_debit  = $opening_balance_debit;
                                $total_credit = $opening_balance_credit;
                                if($sales){
                                    foreach ($sales as $salekey => $sale) {
                                        if($payments){
                                            foreach ($payments as $paymentkey => $payment) {
                                                if(strtotime($payment['payment_date']) <= strtotime($sale['receipt_date'])){
                                                    $total_credit = $total_credit + $payment['paid_amount'];
                                                    echo '<tr>
                                                    <td>'.date('d/m/Y',strtotime($payment['payment_date'])).'</td>
                                                    <td>'.$payment['name'].'</td>
                                                    <td>Invoice Payment</td>
                                                    <td>'.$payment['remarks'].'</td>
                                                    <td><strong>PAYMENT</strong></td>
                                                    <td>'.$payment['invoice_number'].'</td>
                                                    <td></td>
                                                    <td align="right"><strong>'.MoneyFormatIndia($payment['paid_amount']).'</strong></td>
                                                    </tr>';
                                                    unset($payments[$paymentkey]);
                                                }
                                            }
                                        }
                                        if($purchase_payments){
                                            foreach ($purchase_payments as $purchase_paymentkey => $purchase_payment) {
                                                if(strtotime($purchase_payment['payment_date']) <= strtotime($sale['receipt_date'])){
                                                    $total_debit = $total_debit + $purchase_payment['paid_amount'];
                                                    echo '<tr>
                                                    <td>'.date('d/m/Y',strtotime($purchase_payment['payment_date'])).'</td>
                                                    <td>'.$purchase_payment['name'].'</td>
                                                    <td>Purchase Payment</td>
                                                    <td>'.$purchase_payment['remarks'].'</td>
                                                    <td><strong>PURCHASE PAYMENT</strong></td>
                                                    <td>'.$purchase_payment['purchase_number'].'</td>
                                                    <td align="right"><strong>'.MoneyFormatIndia($purchase_payment['paid_amount']).'</strong></td>
                                                    <td></td>
                                                    </tr>';
                                                    unset($purchase_payment[$purchase_paymentkey]);
                                                }
                                            }
                                        }
                                        if($journals){
                                            foreach ($journals as $journalkey => $journal) {
                                                if(strtotime($journal['journal_date']) <= strtotime($sale['receipt_date'])){
                                                    if($journal['journal_type'] == "customer" ){
                                                        $total_debit = $total_debit + $journal['amount'];
                                                        echo '<tr>
                                                        <td>'.date('d/m/Y',strtotime($journal['journal_date'])).'</td>
                                                        <td>'.$journal['name'].'</td>
                                                        <td>Journals - Received Discount</td>
                                                        <td>'.$journal['remarks'].'</td>
                                                        <td><strong>JOURNALS</strong></td>
                                                        <td>'.$journal['journal_number'].'</td>
                                                        <td align="right"><strong>'.MoneyFormatIndia($journal['amount']).'</strong></td>
                                                        <td></td>
                                                        </tr>';
                                                    }else{
                                                        $total_credit = $total_credit + $journal['amount'];
                                                        echo '<tr>
                                                        <td>'.date('d/m/Y',strtotime($journal['journal_date'])).'</td>
                                                        <td>'.$journal['name'].'</td>
                                                        <td>Journals - Discount</td>
                                                        <td>'.$journal['remarks'].'</td>
                                                        <td><strong>JOURNALS</strong></td>
                                                        <td>'.$journal['journal_number'].'</td>
                                                        <td></td>
                                                        <td align="right"><strong>'.MoneyFormatIndia($journal['amount']).'</strong></td>
                                                        </tr>';
                                                    }
                                                    unset($journals[$journalkey]);
                                                }
                                            }
                                        }
                                        if($purchases){
                                            foreach ($purchases as $purchasekey => $purchase) {
                                                if(strtotime($purchase['payment_date']) <= strtotime($sale['receipt_date'])){
                                                    $total_debit = $total_debit + $purchase['paid_amount'];
                                                    echo '<tr>
                                                    <td>'.date('d/m/Y',strtotime($purchase['payment_date'])).'</td>
                                                    <td>'.$purchase['name'].'</td>
                                                    <td>Purchases </td>
                                                    <td>'.$purchase['remarks'].'</td>
                                                    <td><strong>PURCHASE</strong></td>
                                                    <td>'.$purchase['payment_number'].'</td>
                                                    <td align="right"><strong>'.MoneyFormatIndia($purchase['paid_amount']).'</strong></td>
                                                    <td></td>
                                                    </tr>';
                                                    unset($purchases[$purchasekey]);
                                                }
                                            }
                                        }
                                        if($expenses){
                                            foreach ($expenses as $expensekey => $expense) {
                                                if(strtotime($expense['expense_date']) <= strtotime($sale['receipt_date'])){
                                                    $total_debit = $total_debit + $expense['expense_amount'];
                                                    echo '<tr>
                                                    <td>'.date('d/m/Y',strtotime($expense['expense_date'])).'</td>
                                                    <td>'.$expense['name'].'</td>
                                                    <td>Expenses </td>
                                                    <td>'.$expense['expense_remark'].'</td>
                                                    <td><strong>EXPENSES</strong></td>
                                                    <td>'.$expense['expense_number'].'</td>
                                                    <td align="right"><strong>'.MoneyFormatIndia($expense['expense_amount']).'</strong></td>
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
                                        <td>'.$sale['remarks'].'</td>
                                        <td><strong>SALES</strong></td>
                                        <td>'.$sale['receipt_number'].'</td>
                                        <td></td>
                                        <td align="right"><strong>'.MoneyFormatIndia($sale['paid_amount']).'</strong></td>
                                        </tr>';
                                    }
                                }
                                if($payments){
                                    foreach ($payments as $paymentkey => $payment) {
                                        if($journals){
                                            foreach ($journals as $journalkey => $journal) {
                                                if(strtotime($journal['journal_date']) <= strtotime($payment['payment_date'])){
                                                    if($journal['journal_type'] == "customer" ){
                                                        $total_debit = $total_debit + $journal['amount'];
                                                        echo '<tr>
                                                        <td>'.date('d/m/Y',strtotime($journal['journal_date'])).'</td>
                                                        <td>'.$journal['name'].'</td>
                                                        <td>Journals - Received Discount</td>
                                                        <td>'.$journal['remarks'].'</td>
                                                        <td><strong>JOURNAL2</strong></td>
                                                        <td>'.$journal['journal_number'].'</td>
                                                        <td align="right"><strong>'.MoneyFormatIndia($journal['amount']).'</strong></td>
                                                        <td></td>
                                                        </tr>';
                                                    }else{
                                                        $total_credit = $total_credit + $journal['amount'];
                                                        echo '<tr>
                                                        <td>'.date('d/m/Y',strtotime($journal['journal_date'])).'</td>
                                                        <td>'.$journal['name'].'</td>
                                                        <td>Journals - Discount </td>
                                                        <td>'.$journal['remarks'].'</td>
                                                        <td><strong>JOURNAL2</strong></td>
                                                        <td>'.$journal['journal_number'].'</td>
                                                        <td></td>
                                                        <td align="right"><strong>'.MoneyFormatIndia($journal['amount']).'</strong></td>
                                                        </tr>';
                                                    }
                                                    unset($journals[$journalkey]);
                                                }
                                            }
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
                                                    <td align="right"><strong>'.MoneyFormatIndia($purchase['paid_amount']).'</strong></td>
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
                                                    <td align="right"><strong>'.MoneyFormatIndia($expense['expense_amount']).'</strong></td>
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
                                        <td>Payment </td>
                                        <td>'.$payment['remarks'].'</td>
                                        <td><strong>PAYMENT</strong></td>
                                        <td>'.$payment['invoice_number'].'</td>
                                        <td></td>
                                        <td align="right"><strong>'.MoneyFormatIndia($payment['paid_amount']).'</strong></td>
                                        </tr>';
                                    }
                                }
                                if($journals){
                                    foreach ($journals as $journalkey => $journal) {
                                        if($purchases){
                                            foreach ($purchases as $purchasekey => $purchase) {
                                                if(strtotime($purchase['payment_date']) <= strtotime($journal['journal_date'])){
                                                    $total_debit = $total_debit + $purchase['paid_amount'];
                                                    echo '<tr>
                                                    <td>'.date('d/m/Y',strtotime($purchase['payment_date'])).'</td>
                                                    <td>'.$purchase['name'].'</td>
                                                    <td>Purchases </td>
                                                    <td>'.$purchase['remarks'].'</td>
                                                    <td><strong>PURCHASE</strong></td>
                                                    <td>'.$purchase['payment_number'].'</td>
                                                    <td align="right"><strong>'.MoneyFormatIndia($purchase['paid_amount']).'</strong></td>
                                                    <td></td>
                                                    </tr>';
                                                    unset($purchases[$purchasekey]);
                                                }
                                            }
                                        }
                                        if($expenses){
                                            foreach ($expenses as $expensekey => $expense) {
                                                if(strtotime($expense['expense_date']) <= strtotime($journal['journal_date'])){
                                                    $total_debit = $total_debit + $expense['expense_amount'];
                                                    echo '<tr>
                                                    <td>'.date('d/m/Y',strtotime($expense['expense_date'])).'</td>
                                                    <td>'.$expense['name'].'</td>
                                                    <td>Expenses </td>
                                                    <td>'.$expense['expense_remark'].'</td>
                                                    <td><strong>EXPENSES</strong></td>
                                                    <td>'.$expense['expense_number'].'</td>
                                                    <td align="right"><strong>'.MoneyFormatIndia($expense['expense_amount']).'</strong></td>
                                                    <td></td>
                                                    </tr>';
                                                    unset($expenses[$expensekey]);
                                                }
                                            }
                                        }
                                        if($journal['journal_type'] == "customer" ){
                                            $total_debit = $total_debit + $journal['amount'];
                                            echo '<tr>
                                            <td>'.date('d/m/Y',strtotime($journal['journal_date'])).'</td>
                                            <td>'.$journal['name'].'</td>
                                            <td>Journals - Received Discount </td>
                                            <td>'.$journal['remarks'].'</td>
                                            <td><strong>JOURNALS</strong></td>
                                            <td>'.$journal['journal_number'].'</td>
                                            <td align="right"><strong>'.MoneyFormatIndia($journal['amount']).'</strong></td>
                                            <td></td>
                                            </tr>';
                                        }else{
                                            $total_credit = $total_credit + $journal['amount'];
                                            echo '<tr>
                                            <td>'.date('d/m/Y',strtotime($journal['journal_date'])).'</td>
                                            <td>'.$journal['name'].'</td>
                                            <td>Journals - Discount </td>
                                            <td>'.$journal['remarks'].'</td>
                                            <td><strong>JOURNALS</strong></td>
                                            <td>'.$journal['journal_number'].'</td>
                                            <td></td>
                                            <td align="right"><strong>'.MoneyFormatIndia($journal['amount']).'</strong></td>
                                            </tr>';
                                        }
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
                                                    <td align="right"><strong>'.MoneyFormatIndia($expense['expense_amount']).'</strong></td>
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
                                        <td align="right"><strong>'.MoneyFormatIndia($purchase['paid_amount']).'</strong></td>
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
                                        <td align="right"><strong>'.MoneyFormatIndia($expense['expense_amount']).'</strong></td>
                                        <td></td>
                                        </tr>';
                                    }
                                }
                                ?>
                                <tr>
                                    <td colspan="6" align="right"><strong>TOTAL</strong></td>
                                    <td align="right"><strong>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($total_debit); ?></strong></td>
                                    <td align="right"><strong>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($total_credit); ?></strong></td>
                                </tr>
                                <tr>
                                    <td colspan="6" align="right"><strong>CLOSING BALANCE</strong></td>
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