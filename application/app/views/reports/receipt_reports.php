<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Sales List</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">List</a></li>
                                <li class="breadcrumb-item active">Sales</li>
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
                                        <label class="control-label">SELECT TYPE</label>
                                        <select  name="customer_type" class="form-control select2" >
                                            <?php if(isset($customer_type)){ customer_type($customer_type); }else{ customer_type(); } ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="control-label">CUSTOMER NAME</label>
                                        <select  name="customer_id" class="form-control select2" >
                                            <?php if(isset($customer_id)){ echo "test"; customers($customer_id); }else{ customers(); } ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="control-label">FROM</label>
                                        <input type="date" name="date_from" class="form-control" placeholder="dd/mm/yyyy" value="<?php if(isset($date_from)){ if($date_from!=""){ echo date('Y-m-d',strtotime($date_from)); }} ?>">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="control-label">TO</label>
                                        <input type="date" name="date_to" class="form-control" placeholder="dd/mm/yyyy" value="<?php if(isset($date_to)){ if($date_to!=""){ echo date('Y-m-d',strtotime($date_to)); }} ?>">
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
                        <h3 class="card-title">RECEIPT REPORT</h3>
                    </div>
                    <div class="card-body">
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th style="width: 150px">DATE</th>
                                    <th>Particular</th>
                                    <th>Customer Name</th>
                                    <th>Bill Type</th>
                                    <th>Vch Type</th>
                                    <th>Vch No</th>
                                    <th>Debit</th>
                                    <th>Credit</th>
                                    <th>Balance</th>
                                </tr>
                            </thead>
                            <tbody> 
                                <?php
                                $total_debit = 0;
                                $total_credit = 0;
                                $balance = 0;
                                $opening_balance_debit = 0;
                                $opening_balance_credit = 0;
                                if($opening_balance){
                                    if($opening_balance['debit'] > $opening_balance['credit']){
                                        $opening_balance_debit = ( $opening_balance['debit'] - $opening_balance['credit'] );
                                    }
                                    if($opening_balance['debit'] < $opening_balance['credit']){
                                        $opening_balance_credit = ( $opening_balance['credit'] - $opening_balance['debit'] );
                                    }
                                   $balance = $opening_balance_debit-$opening_balance_credit;
                                    echo '<tr>
                                    <td colspan="6" align="right"><strong>OPENING BALANCE : </strong></td>
                                    <td  align="right">&#8377;&nbsp;&nbsp;&nbsp;<strong>'.MoneyFormatIndia($opening_balance_debit).'</strong></td>
                                    <td  align="right">&#8377;&nbsp;&nbsp;&nbsp;<strong>'.MoneyFormatIndia($opening_balance_credit).'</strong></td>
                                    
                                    </tr>';
                                    $total_debit  = $opening_balance_debit;
                                    $total_credit = $opening_balance_credit;
                                }
                                if(isset($receipts)){
                                    foreach ($receipts as $receiptkey => $receipt) {
                                        if($bills){
                                            foreach ($bills as $billkey => $bill) {
                                                if(strtotime($bill['invoice_date']) <= strtotime($receipt['receipt_date'])){
                                                    if($journals){
                                                        foreach ($journals as $journalkey => $journal) {
                                                            if(strtotime($journal['journal_date']) <= strtotime($bill['invoice_date'])){
                                                                $total_credit = $total_credit + $journal['amount'];
                                                                $balance = $balance - $journal['amount'];
                                                                echo '<tr>
                                                                <td>'.date('d/m/Y',strtotime($journal['journal_date'])).'</td>
                                                                <td>'.$journal['journal_number'].'</td>
                                                                <td>'.$journal['name'].'</td>
                                                                <td>-</td>
                                                                <td><strong>JOURNAL</strong></td>
                                                                <td>'.$journal['journal_number'].'</td>
                                                                <td></td>
                                                                <td align="right">&#8377;&nbsp;&nbsp;&nbsp;<strong>'.MoneyFormatIndia($journal['amount']).'</strong></td>
                                                                <td align="right">&#8377;&nbsp;&nbsp;&nbsp;<strong>'.MoneyFormatIndia($balance).'</strong></td>
                                                                </tr>';
                                                                unset($journals[$journalkey]);
                                                            }
                                                        }
                                                    }
                                                    
                                                    $total_debit = $total_debit + $bill['invoice_amount'];
                                                    $balance = $balance + $bill['invoice_amount'];
                                                    echo '<tr>
                                                    <td>'.date('d/m/Y',strtotime($bill['invoice_date'])).'</td>
                                                    <td>'.$bill['invoice_number'].'</td>
                                                    <td>'.$bill['name'].'</td>
                                                    <td>-</td>
                                                    <td><strong>SALES</strong></td>
                                                    <td>'.$bill['invoice_number'].'</td>
                                                    <td align="right">&#8377;&nbsp;&nbsp;&nbsp;<strong>'.MoneyFormatIndia($bill['invoice_amount']).'</strong></td>
                                                    <td></td>
                                                    <td align="right">&#8377;&nbsp;&nbsp;&nbsp;<strong>'.MoneyFormatIndia($balance).'</strong></td>
                                                    </tr>';
                                                    unset($bills[$billkey]);
                                                }
                                            }
                                        }
                                        if($estimate_bills){
                                            foreach ($estimate_bills as $estimate_billkey => $estimate_bill) {
                                                if(strtotime($estimate_bill['estimate_date']) <= strtotime($receipt['receipt_date'])){
                                                    if($journals){
                                                        foreach ($journals as $journalkey => $journal) {
                                                            if(strtotime($journal['journal_date']) <= strtotime($estimate_bill['estimate_date'])){
                                                                $total_credit = $total_credit + $journal['amount'];
                                                                $balance = $balance - $journal['amount'];
                                                                echo '<tr>
                                                                <td>'.date('d/m/Y',strtotime($journal['journal_date'])).'</td>
                                                                <td>'.$journal['journal_number'].'</td>
                                                                <td>'.$journal['name'].'</td>
                                                                <td>-</td>
                                                                <td><strong>JOURNAL</strong></td>
                                                                <td>'.$journal['journal_number'].'</td>
                                                                <td></td>
                                                                <td align="right">&#8377;&nbsp;&nbsp;&nbsp;<strong>'.MoneyFormatIndia($journal['amount']).'</strong></td>
                                                                <td align="right">&#8377;&nbsp;&nbsp;&nbsp;<strong>'.MoneyFormatIndia($balance).'</strong></td>
                                                                </tr>';
                                                                unset($journals[$journalkey]);
                                                            }
                                                        }
                                                    }
                                                    
                                                    $total_debit = $total_debit + $estimate_bill['estimate_amount'];
                                                    $balance = $balance + $estimate_bill['estimate_amount'];
                                                    echo '<tr>
                                                    <td>'.date('d/m/Y',strtotime($estimate_bill['estimate_date'])).'</td>
                                                    <td>'.$estimate_bill['estimate_number'].'</td>
                                                    <td>'.$estimate_bill['name'].'</td>
                                                    <td>-</td>
                                                    <td><strong>SALES</strong></td>
                                                    <td>'.$estimate_bill['estimate_number'].'</td>
                                                    <td align="right">&#8377;&nbsp;&nbsp;&nbsp;<strong>'.MoneyFormatIndia($estimate_bill['estimate_amount']).'</strong></td>
                                                    <td></td>
                                                    <td align="right">&#8377;&nbsp;&nbsp;&nbsp;<strong>'.MoneyFormatIndia($balance).'</strong></td>
                                                    </tr>';
                                                    unset($estimate_bills[$estimate_billkey]);
                                                }
                                            }
                                        }
                                        if(isset($bill_payments)){
                                            foreach ($bill_payments as $bill_paymentkey => $bill_payment) {
                                                if(strtotime($bill_payment['invoice_date']) <= strtotime($receipt['receipt_date'])){
                                                    $total_credit = $total_credit + $bill_payment['paid_amount'];
                                                    $balance = $balance - $bill_payment['paid_amount'];
                                                    echo '<tr>
                                                    <td>'.date('d/m/Y',strtotime($bill_payment['invoice_date'])).'</td>
                                                    <td>'.$bill_payment['invoice_number'].'</td>
                                                    <td>'.$bill_payment['name'].'</td>
                                                    <td>-</td>
                                                    <td><strong>SALES PAYMENT</strong></td>
                                                    <td>'.$bill_payment['invoice_number'].'</td>
                                                    <td></td>
                                                    <td align="right">&#8377;&nbsp;&nbsp;&nbsp;<strong>'.MoneyFormatIndia($bill_payment['paid_amount']).'</strong></td>
                                                    <td align="right">&#8377;&nbsp;&nbsp;&nbsp;<strong>'.MoneyFormatIndia($balance).'</strong></td>
                                                    </tr>';
                                                    unset($bill_payments[$bill_paymentkey]);
                                                }
                                            }
                                        }

                                        if(isset($journals)){
                                            foreach ($journals as $journalkey => $journal) {
                                                if(strtotime($journal['journal_date']) <= strtotime($receipt['receipt_date'])){
                                                    $total_credit = $total_credit + $journal['amount'];
                                                    $balance = $balance - $journal['amount'];
                                                    echo '<tr>
                                                    <td>'.date('d/m/Y',strtotime($journal['journal_date'])).'</td>
                                                    <td>'.$journal['journal_number'].'</td>
                                                    <td>'.$journal['name'].'</td>
                                                    <td>-</td>
                                                    <td><strong>JOURNAL</strong></td>
                                                    <td>'.$journal['journal_number'].'</td>
                                                    <td></td>
                                                    <td align="right">&#8377;&nbsp;&nbsp;&nbsp;<strong>'.MoneyFormatIndia($journal['amount']).'</strong></td>
                                                    <td align="right">&#8377;&nbsp;&nbsp;&nbsp;<strong>'.MoneyFormatIndia($balance).'</strong></td>
                                                    </tr>';
                                                    unset($journals[$journalkey]);
                                                }
                                            }
                                        }
                                        if($receipt['receipt_type'] == 1){
                                            $vch_no =  $receipt['receipt_number'];
                                        }else{
                                            if($receipt['receipt_sales_return_id'] != 0){
                                                $vch_no = $this->common->get_particular('tbl_sales_return',array( 'sales_return_id' => $receipt['receipt_sales_return_id']),'sales_return_number');
                                            }
                                        }
                                        $receipt_type = ($receipt['receipt_type'] == 1) ? "RECEIPT" : "GOODS RETURN" ;
                                        $customer_type_id = ($receipt['customer_type_id'] == 1) ? "INVOICE" : "ESTIMATE" ;
                                        $balance = $balance - $receipt['paid_amount'];
                                        echo '<tr>
                                        <td>'.date('d/m/Y',strtotime($receipt['receipt_date'])).'</td>
                                        <td>'.$receipt['receipt_number'].'</td>
                                        <td>'.$receipt['name'].'</td>
                                        <td>'.$customer_type_id.'</td>
                                        <td><strong>'.$receipt_type.'</strong></td>
                                        <td>'.$vch_no.'</td>
                                        <td></td>
                                        <td align="right">&#8377;&nbsp;&nbsp;&nbsp;<strong>'.MoneyFormatIndia($receipt['paid_amount']).'</strong></td>
                                        <td align="right">&#8377;&nbsp;&nbsp;&nbsp;<strong>'.MoneyFormatIndia($balance).'</strong></td>
                                        </tr>';
                                        $total_credit = $total_credit + $receipt['paid_amount'];
                                    }
                                }
                                if(isset($bills)){
                                    foreach ($bills as $key => $bill) {
                                        if($journals){
                                            foreach ($journals as $journalkey => $journal) {
                                                if(strtotime($journal['journal_date']) <= strtotime($bill['invoice_date'])){
                                                    $total_credit = $total_credit + $journal['amount'];
                                                    $balance = $balance - $journal['amount'];
                                                    echo '<tr>
                                                    <td>'.date('d/m/Y',strtotime($journal['journal_date'])).'</td>
                                                    <td>'.$journal['journal_number'].'</td>
                                                    <td>'.$journal['name'].'</td>
                                                    <td>-</td>
                                                    <td><strong>JOURNAL</strong></td>
                                                    <td>'.$journal['journal_number'].'</td>
                                                    <td></td>
                                                    <td align="right">&#8377;&nbsp;&nbsp;&nbsp;<strong>'.MoneyFormatIndia($journal['amount']).'</strong></td>
                                                    <td align="right">&#8377;&nbsp;&nbsp;&nbsp;<strong>'.MoneyFormatIndia($balance).'</strong></td>
                                                    </tr>';
                                                    unset($journals[$journalkey]);
                                                }
                                            }
                                        }
                                        
                                        $total_debit = $total_debit + $bill['invoice_amount'];
                                        $balance = $balance + $bill['invoice_amount'];
                                        echo '<tr>
                                        <td>'.date('d/m/Y',strtotime($bill['invoice_date'])).'</td>
                                        <td>'.$bill['invoice_number'].'</td>
                                        <td>'.$bill['name'].'</td>
                                        <td>-</td>
                                        <td><strong>SALES</strong></td>
                                        <td>'.$bill['invoice_number'].'</td>
                                        <td align="right">&#8377;&nbsp;&nbsp;&nbsp;<strong>'.MoneyFormatIndia($bill['invoice_amount']).'</strong></td>
                                        <td></td>
                                        <td align="right">&#8377;&nbsp;&nbsp;&nbsp;<strong>'.MoneyFormatIndia($balance).'</strong></td>
                                        </tr>';
                                    }
                                }

                                if(isset($bill_payments)){
                                            //echo "<pre>";print_r($journals);exit;
                                    foreach ($bill_payments as $bill_paymentkey => $bill_payment) {
                                        $total_credit = $total_credit + $bill_payment['paid_amount'];
                                        $balance = $balance - $bill_payment['paid_amount'];
                                        echo '<tr>
                                        <td>'.date('d/m/Y',strtotime($bill_payment['invoice_date'])).'</td>
                                        <td>'.$bill_payment['invoice_number'].'</td>
                                        <td>'.$bill_payment['name'].'</td>
                                        <td>-</td>
                                        <td><strong>SALES PAYMENT</strong></td>
                                        <td>'.$bill_payment['invoice_number'].'</td>
                                        <td></td>
                                        <td align="right">&#8377;&nbsp;&nbsp;&nbsp;<strong>'.MoneyFormatIndia($bill_payment['paid_amount']).'</strong></td>
                                        <td align="right">&#8377;&nbsp;&nbsp;&nbsp;<strong>'.MoneyFormatIndia($balance).'</strong></td>
                                        </tr>';
                                        unset($bill_payments[$bill_paymentkey]);
                                    }
                                }
                                if(isset($journals)){
                                            //echo "<pre>";print_r($journals);exit;
                                    foreach ($journals as $journalkey => $journal) {
                                        $total_credit = $total_credit + $journal['amount'];
                                        $balance = $balance - $journal['amount'];
                                        echo '<tr>
                                        <td>'.date('d/m/Y',strtotime($journal['journal_date'])).'</td>
                                        <td>'.$journal['journal_number'].'</td>
                                        <td>'.$journal['name'].'</td>
                                        <td>-</td>
                                        <td><strong>JOURNAL</strong></td>
                                        <td>'.$journal['journal_number'].'</td>
                                        <td></td>
                                        <td align="right">&#8377;&nbsp;&nbsp;&nbsp;<strong>'.MoneyFormatIndia($journal['amount']).'</strong></td>
                                        <td align="right">&#8377;&nbsp;&nbsp;&nbsp;<strong>'.MoneyFormatIndia($balance).'</strong></td>
                                        </tr>';
                                        unset($journals[$journalkey]);
                                    }
                                }
                                ?>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td align="right">&#8377;&nbsp;&nbsp;&nbsp;<strong><?php echo MoneyFormatIndia($total_debit); ?></strong></td>
                                    <td align="right">&#8377;&nbsp;&nbsp;&nbsp;<strong><?php echo MoneyFormatIndia($total_credit); ?></strong></td>
                                    <td align="right">&#8377;&nbsp;&nbsp;&nbsp;<strong><?php echo MoneyFormatIndia($balance); ?></strong></td>
                                </tr>
                                <tr>
                                    <td colspan="6" align="right"><strong>CLOSING BALANCE : </strong></td>
                                    <td align="right"><strong><?php if($total_debit > $total_credit){ ?>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($total_debit - $total_credit); } ?></strong></td>
                                    <td align="right"><strong><?php if($total_debit < $total_credit){ ?>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($total_credit - $total_debit); } ?></strong></td>
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