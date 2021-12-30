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
		<tr style="width:100%"><td style="width:100%;text-align:center;font-size:18px;padding-bottom:10px;"><b>ACCOUNTS - SALES REPORTS</b></td></tr>
	</table>
	<table style="text-align:center;">
		<tr>
			<td><?php if(isset($date_from)){ if($date_from!=''){ echo 'FROM: <b> '.date('d-m-Y',strtotime($date_from)); }} ?></b></td>
			<td><?php if(isset($date_from)){ if($date_from!=''){ echo 'To: <b> '.date('d-m-Y',strtotime($date_to)); }} ?></b></td>
			<td><?php  if(isset($customer_id)){ if($customer_id!=''){ echo 'CUSTOMER NAME: <b>'.$customer_name; }} ?> </b></td>
		</tr>
	</table>
	<table class="table">
		<thead>
			<tr>
				<th>Date</th>
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
				<td  align="right"><strong>&#8377;&nbsp;&nbsp;&nbsp;'.MoneyFormatIndia($opening_balance_debit).'</strong></td>
				<td  align="right"><strong>&#8377;&nbsp;&nbsp;&nbsp;'.MoneyFormatIndia($opening_balance_credit).'</strong></td>
				<td  align="right"><strong>&#8377;&nbsp;&nbsp;&nbsp;'.MoneyFormatIndia($balance).'</strong></td>
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
											<td align="right"><strong>&#8377;&nbsp;&nbsp;&nbsp;'.MoneyFormatIndia($journal['amount']).'</strong></td>
											<td align="right"><strong>&#8377;&nbsp;&nbsp;&nbsp;'.MoneyFormatIndia($balance).'</strong></td>
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
								<td align="right"><strong>&#8377;&nbsp;&nbsp;&nbsp;'.MoneyFormatIndia($bill['invoice_amount']).'</strong></td>
								<td></td>
								<td align="right"><strong>&#8377;&nbsp;&nbsp;&nbsp;'.MoneyFormatIndia($balance).'</strong></td>
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
											<td align="right"><strong>&#8377;&nbsp;&nbsp;&nbsp;'.MoneyFormatIndia($journal['amount']).'</strong></td>
											<td align="right"><strong>&#8377;&nbsp;&nbsp;&nbsp;'.MoneyFormatIndia($balance).'</strong></td>
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
								<td align="right"><strong>&#8377;&nbsp;&nbsp;&nbsp;'.MoneyFormatIndia($estimate_bill['estimate_amount']).'</strong></td>
								<td></td>
								<td align="right"><strong>&#8377;&nbsp;&nbsp;&nbsp;'.MoneyFormatIndia($balance).'</strong></td>
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
								<td align="right"><strong>&#8377;&nbsp;&nbsp;&nbsp;'.MoneyFormatIndia($bill_payment['paid_amount']).'</strong></td>
								<td align="right"><strong>&#8377;&nbsp;&nbsp;&nbsp;'.MoneyFormatIndia($balance).'</strong></td>
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
								<td align="right"><strong>&#8377;&nbsp;&nbsp;&nbsp;'.MoneyFormatIndia($journal['amount']).'</strong></td>
								<td align="right"><strong>&#8377;&nbsp;&nbsp;&nbsp;'.MoneyFormatIndia($balance).'</strong></td>
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
					<td align="right"><strong>&#8377;&nbsp;&nbsp;&nbsp;'.MoneyFormatIndia($receipt['paid_amount']).'</strong></td>
					<td align="right"><strong>&#8377;&nbsp;&nbsp;&nbsp;'.MoneyFormatIndia($balance).'</strong></td>
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
								<td align="right"><strong>&#8377;&nbsp;&nbsp;&nbsp;'.MoneyFormatIndia($journal['amount']).'</strong></td>
								<td align="right"><strong>&#8377;&nbsp;&nbsp;&nbsp;'.MoneyFormatIndia($balance).'</strong></td>
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
					<td align="right"><strong>&#8377;&nbsp;&nbsp;&nbsp;'.MoneyFormatIndia($bill['invoice_amount']).'</strong></td>
					<td></td>
					<td align="right"><strong>&#8377;&nbsp;&nbsp;&nbsp;'.MoneyFormatIndia($balance).'</strong></td>
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
					<td align="right"><strong>&#8377;&nbsp;&nbsp;&nbsp;'.MoneyFormatIndia($bill_payment['paid_amount']).'</strong></td>
					<td align="right"><strong>&#8377;&nbsp;&nbsp;&nbsp;'.MoneyFormatIndia($balance).'</strong></td>
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
					<td align="right"><strong>&#8377;&nbsp;&nbsp;&nbsp;'.MoneyFormatIndia($journal['amount']).'</strong></td>
					<td align="right"><strong>&#8377;&nbsp;&nbsp;&nbsp;'.MoneyFormatIndia($balance).'</strong></td>
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
				<td align="right">&#8377;<strong><?php echo MoneyFormatIndia($total_debit); ?></strong></td>
				<td align="right">&#8377;<strong><?php echo MoneyFormatIndia($total_credit); ?></strong></td>
				<td align="right">&#8377;<strong><?php echo MoneyFormatIndia($balance); ?></strong></td>
			</tr>
			<tr>
				<td colspan="6" align="right"><strong>CLOSING BALANCE : </strong></td>
				<td align="right"><strong><?php if($total_debit > $total_credit){ ?>&#8377;<?php echo MoneyFormatIndia($total_debit - $total_credit); } ?></strong></td>
				<td align="right"><strong><?php if($total_debit < $total_credit){ ?>&#8377;<?php echo MoneyFormatIndia($total_credit - $total_debit); } ?></strong></td>
			</tr>
		</tbody>
	</table>
</body>
</html>