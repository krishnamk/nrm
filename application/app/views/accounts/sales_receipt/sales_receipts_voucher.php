
<style type="text/css">
	.modal-dialog {
		max-width: 640px;
	}
	.vocher{border: 2px solid #333; padding: 20px 10px;float: left;width: 100%;}
	.vocher_heder{background: #d4e2d8;border: 1px solid #333; border-radius: 10px;float: left;width: 100%;    padding-bottom: 5px;}
	.voch_right{float: right; text-transform: uppercase;}
	.voch_right h4 {
		background: #fff;
		border: 1px solid #333;
		border-radius: 8px;
		padding: 7px;
		margin-bottom: 0;
		border-top: 0;
		border-right: 0;
	}
	.vocher_line {
		float: left;
		width: 100%;
		padding: 0 10px;
		margin-bottom: 5px;
	}
	.vocher_line p {
		float: left;
		margin-right: 10px;
		margin-bottom: 5px;
		font-size: 16px;
	}
	.vocher_line span {
		width: 70px;
		display: block;
		height: 21px;
		font-size: 16px;
		border-bottom: 1px solid #333;
		float: left;
		text-align: center;
	}
	.vocher_body{margin-top: 4px;background: #d4e2d8;border:1px solid #333; border-radius: 10px;float: left;width: 100%;}
	.vocher_body table{width: 100%;}
	.vocher_body tr td,.vocher_body tr th{padding: 5px;      height: 30px;  text-align: center; border-right: 1px solid #333;font-size: 16px;}
	.vocher_footer {background: #d4e2d8;border: 1px solid #333; border-radius: 10px;float: left;width: 100%; padding: 10px 0px; margin-top: 4px; margin-top: 3px;  }
	.vocher_footer .vocher_line p{font-size: 17px;}
	.vocher_footer .vocher_line span{font-size: 16px;height: 23px;}
	.vocher_footer .vocher_line{margin-bottom: 5px;}
</style>
<div class="vocher">

	<div class="vocher_heder">
		
		<div class="voch_right"><h4>Sales Voucher</h4>

		</div>

		<div class="vocher_line">
			<p>Voucher No.</p><span style="width:50%;"><?php echo $receipt['receipt_number']; ?></span>
		</div>
		<div class="vocher_line">
			<p>Date </p><span style="width:120px;">
				<?php echo date('d-m-Y',strtotime($receipt['receipt_date'])); ?>
			</span>
		</div>
	</div>

	<div class="vocher_body">
		<table>
			<thead>
				<tr style="border-bottom:1px solid #333;">
					<th>PARTICULARS</th>
					<th style="border:none;">RS.</th>
					<!-- <th style="border:none;">P.</th> -->
				</tr>
			</thead>
			<tbody>
				<tr style="border-bottom:1px solid #333;">
					<td><?php echo $receipt['customer_name']; ?></td>
					<td>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($receipt['paid_amount']); ?></td>
					<!-- <td style="border:none;"></td> -->
				</tr>
				<tr style="border-bottom:1px solid #333;">
					<td><?php echo $receipt['payment_type']; ?>-
						<?php if($receipt['payment_type'] == 'net_banking'){ 
							if(isset($receipt)){ echo $receipt['bank_name']; } ?>
						<?php }elseif($receipt['payment_type'] == 'cheque'){
							if(isset($receipt)){ echo $receipt['cheque_no']; }}
							elseif($receipt['payment_type'] == 'upi_id'){if(isset($receipt)){ echo $receipt['upi_id'];}
						}?>
					</td>
					<td></td>
					<!-- <td style="border:none;"></td> -->
				</tr>
				<tr style="border-bottom:1px solid #333;">
					<td></td>
					<td></td>
					<!-- <td style="border:none;"></td> -->
				</tr>
				<tr >
					<td style="text-align:right;">Total Rs.</td>
					<td>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($receipt['paid_amount']); ?></td>
					<!-- <td style="border:none;"></td> -->
				</tr>
			</tbody>
		</table>
	</div>

	<div class="vocher_footer">
		<div class="vocher_line">
			<p style="width:40.5%">Revived With Thanks</p><span style="width:57.5%"><?php echo ucfirst(convert_number_to_words(round($receipt['paid_amount']))); ?></span>
		</div>
		<div class="vocher_line">
			<p>Prepared </p><span style="width:40%;"></span>
		</div>
		<div class="vocher_line" style="width:37.5%">
			<p>Passed </p><span style="width:66%;"></span>
		</div>
		<div class="vocher_line" style="width:62.5%">
			<p>Receiver's Signature </p><span style="width:50%;"></span>
		</div>
	</div>

		<a href="<?php echo base_url('sales_receipts_voucher_print/'.$receipt['receipt_id']);?>" style="margin-right: 5px;margin-top:10px;" class="btn btn-primary float-right"><i class="fa fa-print"></i>&nbsp;Print</a>
</div>