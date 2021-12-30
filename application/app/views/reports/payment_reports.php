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
                                            <?php if(isset($data)){ customers($data['supplier_id']); }else{ suppliers(); } ?>
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
                        <h3 class="card-title">PAYMENT REPORT</h3>
                    </div>
                    <div class="card-body">
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th style="width: 150px">DATE</th>
                                    <th>Particular</th>
                                    <th>Supplier Name</th>
                                    <th>Vch Type</th>
                                    <th>Vch No</th>
                                    <th>Debit</th>
                                    <th>Credit</th>
                                </tr>
                            </thead>
                            <tbody> 
                                <?php
                                $total_debit = 0;
                                $total_credit = 0;
                                $opening_balance_debit = 0;
                                $opening_balance_credit = 0;
                                if($opening_balance){
                                    if($opening_balance['debit'] > $opening_balance['credit']){
                                        $opening_balance_debit = ( $opening_balance['debit'] - $opening_balance['credit'] );
                                    }
                                    if($opening_balance['debit'] < $opening_balance['credit']){
                                        $opening_balance_credit = ( $opening_balance['credit'] - $opening_balance['debit'] );
                                    }
                                    echo '<tr>
                                    <td colspan="5" align="right"><strong>OPENING BALANCE : </strong></td>
                                    <td  align="right"><strong>&#8377;&nbsp;&nbsp;&nbsp;'.MoneyFormatIndia($opening_balance_debit).'</strong></td>
                                    <td  align="right"><strong>&#8377;&nbsp;&nbsp;&nbsp;'.MoneyFormatIndia($opening_balance_credit).'</strong></td>
                                    </tr>';
                                    $total_debit  = $opening_balance_debit;
                                    $total_credit = $opening_balance_credit;
                                }
                                if(isset($payments)){
                                    foreach ($payments as $paymentkey => $payment) {
                                        if($purchase_bills){
                                            foreach ($purchase_bills as $purchase_billkey =>       $purchase_bill) {
                                                if(strtotime($purchase_bill['purchase_date']) <= strtotime($payment['payment_date'])){
                                                    if($journals){
                                                        foreach ($journals as $journalkey => $journal) {
                                                            if(strtotime($journal['journal_date']) <= strtotime($purchase_bill['purchase_date'])){
                                                                $total_credit = $total_credit + $journal['amount'];
                                                                echo '<tr>
                                                                <td>'.date('d/m/Y',strtotime($journal['journal_date'])).'</td>
                                                                <td>'.$journal['journal_number'].'</td>
                                                                <td>'.$journal['name'].'</td>
                                                                <td><strong>JOURNAL</strong></td>
                                                                <td>'.$journal['journal_number'].'</td>
                                                                <td align="right"><strong>&#8377;&nbsp;&nbsp;&nbsp;'.MoneyFormatIndia($journal['amount']).'</strong></td>
                                                                <td></td>
                                                                </tr>';
                                                                unset($journals[$journalkey]);
                                                            }
                                                        }
                                                    }
                                                    
                                                    $total_credit = $total_credit + $purchase_bill['purchase_amount']; 
                                                    echo '<tr>
                                                    <td>'.date('d/m/Y',strtotime($purchase_bill['purchase_date'])).'</td>
                                                    <td>'.$purchase_bill['purchase_number'].'</td>
                                                    <td>'.$purchase_bill['name'].'</td>
                                                    <td><strong>PURCHASE</strong></td>
                                                    <td>'.$purchase_bill['purchase_number'].'</td>
                                                    <td></td>
                                                    <td align="right"><strong>&#8377;&nbsp;&nbsp;&nbsp;'.MoneyFormatIndia($purchase_bill['purchase_amount']).'</strong></td>
                                                    </tr>';
                                                    unset($purchase_bills[$purchase_billkey]);
                                                }
                                            }
                                        }
                                        if(isset($purchase_bill_payments)){
                                            foreach ($purchase_bill_payments as $purchase_bill_paymentkey => $purchase_bill_payment) {
                                                if(strtotime($purchase_bill_payment['purchase_date']) <= strtotime($payment['payment_date'])){
                                                    $total_debit = $total_debit + $purchase_bill_payment['paid_amount'];
                                                    echo '<tr>
                                                    <td>'.date('d/m/Y',strtotime($purchase_bill_payment['purchase_date'])).'</td>
                                                    <td>'.$purchase_bill_payment['purchase_number'].'</td>
                                                    <td>'.$purchase_bill_payment['name'].'</td>
                                                    <td><strong>PURCHASE PAYMENT</strong></td>
                                                    <td>'.$purchase_bill_payment['purchase_number'].'</td>
                                                    <td align="right"><strong>&#8377;&nbsp;&nbsp;&nbsp;'.MoneyFormatIndia($purchase_bill_payment['paid_amount']).'</strong></td>
                                                    <td></td>
                                                    </tr>';
                                                    unset($purchase_bill_payments[$purchase_bill_paymentkey]);
                                                }
                                            }
                                        }

                                        if(isset($journals)){
                                            foreach ($journals as $journalkey => $journal) {
                                                if(strtotime($journal['journal_date']) <= strtotime($payment['payment_date'])){
                                                    $total_debit = $total_debit + $journal['amount'];
                                                    echo '<tr>
                                                    <td>'.date('d/m/Y',strtotime($journal['journal_date'])).'</td>
                                                    <td>'.$journal['journal_number'].'</td>
                                                    <td>'.$journal['name'].'</td>
                                                    <td><strong>JOURNAL</strong></td>
                                                    <td>'.$journal['journal_number'].'</td>
                                                    <td align="right"><strong>&#8377;&nbsp;&nbsp;&nbsp;'.MoneyFormatIndia($journal['amount']).'</strong></td>
                                                    <td></td>
                                                    </tr>';
                                                    unset($journals[$journalkey]);
                                                }
                                            }
                                        }
                                        // if($payment['payment_type'] == 1){
                                        //     $vch_no =  $payment['payment_number'];
                                        // }else{
                                        //     if($payment['payment_purchase_return_id'] != 0){
                                        //         $vch_no = $this->common->get_particular('tbl_purchase_return',array( 'purchase_return_id' => $payment['payment_purchase_return_id']),'purchase_return_number');
                                        //     }
                                        // }
                                        // $payment_type = ($payment['payment_type'] == 1) ? "payment" : "GOODS RETURN" ;
                                        $vch_no = $payment['payment_number'];
                                        $payment_type = "Payment";
                                        echo '<tr>
                                        <td>'.date('d/m/Y',strtotime($payment['payment_date'])).'</td>
                                        <td>'.$payment['payment_number'].'</td>
                                        <td>'.$payment['name'].'</td>
                                        <td><strong>'.$payment_type.'</strong></td>
                                        <td>'.$vch_no.'</td>
                                        <td align="right"><strong>&#8377;&nbsp;&nbsp;&nbsp;'.MoneyFormatIndia($payment['paid_amount']).'</strong></td>
                                        <td></td>
                                        </tr>';
                                        $total_debit = $total_debit + $payment['paid_amount'];
                                    }
                                }
                                if(isset($purchase_bills)){
                                    foreach ($purchase_bills as $key => $purchase_bill) {
                                        if($journals){
                                            foreach ($journals as $journalkey => $journal) {
                                                if(strtotime($journal['journal_date']) <= strtotime($purchase_bill['purchase_date'])){
                                                    $total_debit = $total_debit + $journal['amount'];
                                                    echo '<tr>
                                                    <td>'.date('d/m/Y',strtotime($journal['journal_date'])).'</td>
                                                    <td>'.$journal['journal_number'].'</td>
                                                    <td>'.$journal['name'].'</td>
                                                    <td><strong>JOURNAL</strong></td>
                                                    <td>'.$journal['journal_number'].'</td>
                                                    <td align="right"><strong>&#8377;&nbsp;&nbsp;&nbsp;'.MoneyFormatIndia($journal['amount']).'</strong></td>
                                                    <td></td>
                                                    </tr>';
                                                    unset($journals[$journalkey]);
                                                }
                                            }
                                        }
                                        
                                        $total_credit = $total_credit + $purchase_bill['purchase_amount'];
                                        echo '<tr>
                                        <td>'.date('d/m/Y',strtotime($purchase_bill['purchase_date'])).'</td>
                                        <td>'.$purchase_bill['purchase_number'].'</td>
                                        <td>'.$purchase_bill['name'].'</td>
                                        <td><strong>PURCHASE</strong></td>
                                        <td>'.$purchase_bill['purchase_number'].'</td>
                                        <td></td>
                                        <td align="right"><strong>&#8377;&nbsp;&nbsp;&nbsp;'.MoneyFormatIndia($purchase_bill['purchase_amount']).'</strong></td>
                                        </tr>';
                                    }
                                }

                                if(isset($purchase_bill_payments)){
                                            //echo "<pre>";print_r($journals);exit;
                                    foreach ($purchase_bill_payments as $purchase_bill_paymentkey => $purchase_bill_payment) {
                                        $total_debit = $total_debit + $purchase_bill_payment['paid_amount'];
                                        echo '<tr>
                                        <td>'.date('d/m/Y',strtotime($purchase_bill_payment['purchase_date'])).'</td>
                                        <td>'.$purchase_bill_payment['purchase_number'].'</td>
                                        <td>'.$purchase_bill_payment['name'].'</td>
                                        <td><strong>PURCHASE PAYMENT</strong></td>
                                        <td>'.$purchase_bill_payment['purchase_number'].'</td>
                                        <td align="right"><strong>&#8377;&nbsp;&nbsp;&nbsp;'.MoneyFormatIndia($purchase_bill_payment['paid_amount']).'</strong></td>
                                        <td></td>
                                        </tr>';
                                        unset($purchase_bill_payments[$purchase_bill_paymentkey]);
                                    }
                                }
                                if(isset($journals)){
                                            //echo "<pre>";print_r($journals);exit;
                                    foreach ($journals as $journalkey => $journal) {
                                        $total_debit = $total_debit + $journal['amount'];
                                        echo '<tr>
                                        <td>'.date('d/m/Y',strtotime($journal['journal_date'])).'</td>
                                        <td>'.$journal['journal_number'].'</td>
                                        <td>'.$journal['name'].'</td>
                                        <td><strong>JOURNAL</strong></td>
                                        <td>'.$journal['journal_number'].'</td>
                                        <td align="right"><strong>&#8377;&nbsp;&nbsp;&nbsp;'.MoneyFormatIndia($journal['amount']).'</strong></td>
                                        <td></td>
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
                                    <td align="right"><strong>&#8377;<?php echo MoneyFormatIndia($total_debit); ?></strong></td>
                                    <td align="right"><strong>&#8377;<?php echo MoneyFormatIndia($total_credit); ?></strong></td>
                                </tr>
                                <tr>
                                    <td colspan="5" align="right"><strong>CLOSING BALANCE : </strong></td>
                                    <td align="right"><strong><?php if($total_debit < $total_credit){ echo MoneyFormatIndia($total_credit - $total_debit); } ?></strong></td>
                                    <td align="right"><strong><?php if($total_debit > $total_credit){ echo MoneyFormatIndia($total_debit - $total_credit); } ?></strong></td>
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