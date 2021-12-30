<!DOCTYPE html>
<html lang="en">
<head>
	<title></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style type="text/css">
		body{    font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;}
		@page {
			size: 8in 11.25in;
			margin: 1mm 1mm 1mm 1mm;
		}
		h2{}
		table{width:100%;}
		table tr td{padding:5px 0;}
		.table{border:1px solid #606367; border-collapse: collapse;margin-top:8px;}
		.table tr,.table tr td,.table tr th{border:1px solid #233242;}
		.table tr td{padding:8px;}
		.table tr th{background:#233242; color:#fff;padding:7px 7px;border-right-color:#233242;border-left-color:#233242;}
	</style>
</head>
<body>
	<table>
		<tr style="width:100%"><td style="width:100%;text-align:center;font-size:18px;padding-bottom:10px;"><b>ACCOUNTS - PAYMENT REPORTS</b></td></tr>
	</table>
	<table style="text-align:center;">
		<tr>
			<td><?php if(isset($date_from)){ if($date_from!=''){ echo 'FROM: <b> '.date('d-m-Y',strtotime($date_from)); }} ?></b></td>
			<td><?php if(isset($date_from)){ if($date_from!=''){ echo 'To: <b> '.date('d-m-Y',strtotime($date_to)); }} ?></b></td>
			<td><?php  if(isset($supplier_id)){ if($supplier_id!=''){ echo 'SUPPLIER NAME: <b>'.$supplier_name; }} ?> </b></td>
		</tr>
	</table>
	<table class="table">
		<thead>
			<tr>
				<th>Date</th>
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
</body>
</html>