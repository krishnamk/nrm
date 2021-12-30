
<style type="text/css">
body{font-family: Poppins,sans-serif;}
	
	.modal-dialog {
		max-width: 640px;
	}
	.vocher{ padding: 20px 10px;float: left;width: 100%;}
	.vocher_heder{background: #d4e2d8;border: 1px solid #333; border-radius: 10px;float: left;width: 100%;    padding-bottom: 5px;}
	.voch_right{float: right; text-transform: uppercase;width: 200px;}
	.voch_right h4 {
		background: #fff;
		border: 1px solid #333;
		border-radius: 8px;
		padding: 7px;
		margin-bottom: 0;
		border-top: 0;
		border-right: 0;
		margin-top: 0;
	}
	.vocher_line {
		float: left;
		width: 100%;
		padding: 0 10px;
		margin-top: 0;
		margin-bottom: 5px;

	}
	.vocher_line p {
		float: left;
		margin-right: 10px;
		margin-bottom: 5px;
		font-size: 16px;
		margin-top: 0;
		width: 100%;
	}
	.vocher_line span {
	    width: 100%;
		display: block;
		height: 21px;
		font-size: 16px;
		float: left;
		text-align: center;
	}
	.vocher_body{margin-top: 4px;background: #d4e2d8;border:1px solid #333; border-radius: 10px;float: left;width: 100%;}
	.vocher_body table,.vocher_body table tr {width: 100%;border-collapse: collapse;}
	.vocher_body table tr td,.vocher_body table tr th{padding: 5px;      height: 30px;  text-align: center; border-right: 1px solid #333;font-size: 16px; border-bottom: 1px solid #333;}

	.vocher_body table tr td:last-child,.vocher_body table tr th:last-child{border-right: none;}
	.vocher_body table tr:last-child{border-bottom: none;}

	.vocher_footer {background: #d4e2d8;border: 1px solid #333; border-radius: 10px;float: left;width: 100%; padding: 10px 0px; margin-top: 4px; margin-top: 3px;  }
	.vocher_footer .vocher_line p{font-size: 17px;}
	.vocher_footer .vocher_line span{font-size: 16px;height: 23px;}
	.vocher_footer .vocher_line{margin-bottom: 5px;}
	.float_left{float: left;}
</style>
<div class="vocher">

	<div class="vocher_heder">
		
		<div class="voch_right" style="text-align:center;"><h4>Sales Voucher</h4>

		</div>

		<div class="vocher_line">
			<div class="float_left" style="width:120px;"><p>Voucher No.</p></div>
			
			<div class="float_left" style="width:220px;text-align: center;border-bottom: 1px solid #333; height:22px;">
				<span><?php echo $receipt['receipt_number']; ?> </span>
			</div>
			
		</div>
		<div class="vocher_line">
			<div class="float_left" style="width:120px;"><p>Date</p></div>
			
			<div class="float_left" style="width:220px;text-align: center;border-bottom: 1px solid #333;">
				<span>
					<?php echo date('d-m-Y',strtotime($receipt['receipt_date'])); ?>
				</span>
			</div>
		</div>
	</div>

	<div class="vocher_body">
		<table>
			<thead>
				<tr>
					<th style="width:62%">PARTICULARS</th>
					<th style="border-right:none; width:38%;">RS.</th>
					<!-- <th style="border:none;">P.</th> -->
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><?php echo $receipt['customer_name']; ?></td>
					<td style="border-right:none;">&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($receipt['paid_amount']); ?></td>
					<!-- <td style="border:none;"></td> -->
				</tr>
				<tr>
					<td><?php echo $receipt['payment_type']; ?>-
						<?php if($receipt['payment_type'] == 'net_banking'){ 
							if(isset($receipt)){ echo $receipt['bank_name']; } ?>
						<?php }elseif($receipt['payment_type'] == 'cheque'){
							if(isset($receipt)){ echo $receipt['cheque_no']; }}
							elseif($receipt['payment_type'] == 'upi_id'){if(isset($receipt)){ echo $receipt['upi_id'];}
						}?>
					</td>
					<td style="border-right:none;"></td>
					<!-- <td style="border:none;"></td> -->
				</tr>
				<tr>
					<td></td>
					<td style="border-right:none;"></td>
					<!-- <td style="border:none;"></td> -->
				</tr>
				<tr >
					<td style="text-align:right;border-bottom:none;">Total Rs.</td>
					<td style="border-right:none;border-bottom:none;">&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($receipt['paid_amount']); ?></td>
					<!-- <td style="border:none;"></td> -->
				</tr>
			</tbody>
		</table>
	</div>

	<div class="vocher_footer">
		<div class="vocher_line">
			<div style="width:29.5%" class="float_left">
				<p>Revived With Thanks</p>
			</div>
			<div style="width:69.5%;border-bottom:1px solid #333;text-align:center;" class="float_left">
				<span style="width:57.5%"><?php echo ucfirst(convert_number_to_words(round($receipt['paid_amount']))); ?></span>
			</div>
			
		</div>
		<div class="vocher_line">
			<div style="width:14.5%;" class="float_left">
				<p>Prepared </p>
			</div>
			<div style="width:38%;border-bottom:1px solid #333;text-align:center;height:20px;" class="float_left">
					
			</div>
		
		</div>
		<div class="vocher_line float_left" style="width:34.5%">
			<div style="width:32.5%;" class="float_left">
				<p>Passed </p>
			</div>
			<div style="width:60%;border-bottom:1px solid #333;text-align:center;height:20px;" class="float_left">
					
			</div>
			
		</div>
		<div class="vocher_line float_left" style="width:58.5%">
			<div style="width:46.5%;" class="float_left">
				<p>Receiver's Signature </p>
			</div>
			<div style="width:53%;border-bottom:1px solid #333;text-align:center;height:20px;" class="float_left">
					
			</div>
		</div>
	</div>

</div>