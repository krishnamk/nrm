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
		<tr style="width:100%"><td style="width:100%;text-align:center;font-size:24px;padding-bottom:10px;"><b>DAY REPORTS</b></td></tr>
	</table>
	<table style="text-align:center;">
		<tr>
			<td><?php if(isset($date_from)){ if($date_from!=''){ echo 'FROM: <b> '.date('d-m-Y',strtotime($date_from)); }} ?></b></td>
			<td><?php if(isset($date_from)){ if($date_from!=''){ echo 'To: <b> '.date('d-m-Y',strtotime($date_to)); }} ?></b></td>
			<td><?php  if(isset($payment_type)){ if($payment_type!=''){ echo 'PAYMENT TYPE: <b>'.$payment_type; }} ?> </b></td>
		</tr>
	</table>
	<table class="table">
		<thead>
			<tr>
				<th>Date</th>
				<th>Name</th>
				<th>Particular</th>
				<th>Payment Type</th>
				<th>Remarks</th>
				<th>Vch Type</th>
				<th>Vch No</th>
				<th>Debit</th>
				<th>Credit</th>
			</tr>
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
</body>
</html>