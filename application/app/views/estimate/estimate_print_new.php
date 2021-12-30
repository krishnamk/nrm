<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo $estimate_details['estimate_number']; ?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style type="text/css">
		.container{width: 1000px; margin: 0 auto;}
		body{    font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;}
		table.table_all tbody > tr > td {
			height: 20px;
		}
		table.table_all{}
		@page {
			size: 8in 11.25in;
			margin: 1mm 1mm 1mm 1mm;
		}
		h5{margin: 0;}
		ul{padding: 0; margin: 0; }
		ul li{list-style: none;}
		table ul {display: inline-block}
		.invice_table { border:1px solid #ccd0d6; border-collapse: collapse; }
		.invice_table tr th,.invice_table tr td{border:1px solid #ccd0d6; width: 120px; text-align: center;}
		table{border:1px solid #ccd0d6; width: 100%; border-collapse: collapse;}
		table tbody{background: #154c85; color: #fff;}
		table tr,table tr td,table  tr th{border: 1px solid #ccd0d6;}
		table tr td,table  tr th{font-size: 12px;padding:3px;}
		table.noborder tr,table.noborder tr td,table.noborder  tr th,table.noborder{border: none;text-align:center;}
		table ul {display: inline-block;list-style: none;}
		ul  li{float: left;}
		.logo_footer {display: inline-block;}
		.logo_footer p{float: left;}
	</style>
</head>
<body>
	<div class="container">
		<div class="row no-margin">
			<table style="width: 100%; border: none; margin-bottom: 10px;">
				<tbody>
					<tr style="border: none;">
						<td width="100%" style=" border: none; text-align:center;">  <img src="<?php echo base_url('assets/images/nrm_logo.jpg');?>" alt="" height="46"></td>
					</tr>

					<tr style="border: none;">
						<td colspan="2" style="text-align:center;font-weight: bold;">
							<p><?php echo $company_details['company_address1']; ?>,
								<?php echo $company_details['company_address2']; ?>,
								<?php echo $company_details['company_city']; ?>,
								<?php echo $company_details['company_pincode']; ?></p>
								<p>Phone No : <?php echo $company_details['company_phone']; ?>,
									<?php echo $company_details['company_contact_no']; ?></p>
								</td>
							</tr>
						</tbody>
					</table>
					<table style="width: 100%; border: none; margin-bottom: 15px;">
						<tbody>
							<tr style="border: none;">
								<td  colspan="2" style="text-align:center;font-weight: bold;padding:6px 0;background:#2e75b6;color:#fff;font-size:15px;">Estimate</td>
							</tr>
							<tr style="border: none;">
								<td width="50%" style="padding:5px;">Estimate No    : <?php echo $estimate_details['estimate_number']; ?></td>
								<td width="50%" style="padding:5px;">Transport Mode  : <?php echo $dc_details['transport_mode']; ?></td>
							</tr>
							<tr style="border: none;">
								<td style="padding:5px;">Estimate date   : <?php echo date('d-m-Y',strtotime($estimate_details['estimate_date'])); ?></td>
								<td style="padding:5px;">Vehicle number: <?php echo $dc_details['transport_vechile_no']; ?></td>
							</tr>
							<tr style="border: none;">
								<td style="padding:5px;">Reverse Charge (Y/N): <?php echo $estimate_details['reverse_charge']; ?></td>
								<td style="padding:5px;">Date of Supply  :  <?php echo date('d-m-Y',strtotime($estimate_details['date_of_supply'])); ?></td>
							</tr>
							<tr style="border: none;">
								<td style="padding:5px;">State : <?php echo $company_details['state_name']; ?></td>
								<td style="padding:5px;">Place of Supply : <?php echo $estimate_details['place_of_supply']; ?></td>
							</tr>
							<tr style="border: none;">
								<td style="padding:5px;">Code : <?php echo $customer_details['customer_state']; ?></td>
								<td style="padding:5px;">Total bundle :<?php echo $estimate_details['total_bundle']; ?></td>
							</tr>
						</tbody>
					</table>

					<table style="width: 100%; border: none; margin-bottom: 15px;">
						<tbody>

							<tr style="border: none;">
								<td colspan="2" style="text-align:center;font-weight: bold;padding:5px 0;background:#2e75b6;color:#fff;font-size:15px;">Bill to Party</td>
							</tr>
							<tr style="border: none;">
								<td width="50%" style="padding:5px;">Name : <?php echo $customer_details['customer_name']; ?></td>
								<td width="50%" style="padding:5px;">GSTIN    : <?php echo $customer_details['customer_gst']; ?></td>
							</tr>


							<tr style="border: none;">
								<td  style="padding:5px;">Mobile : <?php echo $customer_details['customer_phone']; ?></td>
								<td  style="padding:5px;">State : <?php echo $customer_details['state_name']; ?></td>
							</tr>
							<tr style="border: none;">
								<td   style="padding:5px;">Address : <?php echo $customer_details['customer_address1']; ?>, <?php echo $customer_details['customer_address2']; ?>,<?php echo $customer_details['customer_city']; ?> - <?php echo $customer_details['customer_pincode']; ?></td>
								<td  style="padding:5px;">HSN Code : 61091000</td>
							</tr>

						</tbody>
					</table>
					<table  style="width: 100%;border: none; margin-bottom: 15px;">

						<thead style="border: none;">
							<tr style="background:#2e75b6;border: none;">
								<th style="color:#fff;border: none;">DC.No</th>
								<th style="color:#fff;border: none;">Product Description</th>
								<th style="color:#fff;border: none;">Rate(&#8377;)</th>
								<th style="color:#fff;border: none;">Qty</th>
								<th style="color:#fff;border: none;">Amount</th>
								<th style="color:#fff;border: none;">Discount</th>
								<th style="color:#fff;border: none; width:120px;">Discount Amount</th>
								<th style="color:#fff;border: none;width:70px;">TOTAL</th>

							</tr>
						</thead>
						<tbody>
							<?php if($relations){
								$total_quantity = 0;
								$total_tax = 0;
								$total_amount = 0;
								$final_amount = 0;
								$total_before_tax = 0;
								$total_after_tax = 0;
								$final_price = 0;
								foreach ($relations as $key => $relation) { 
									$total_quantity=$total_quantity + $relation['quantity'];
									$amount = $relation['rate']*$relation['quantity'];
									$total_tax = $total_tax + $relation['tax_total'];
									$total_amount = $total_amount + $amount;
									$total_before_tax = $total_before_tax + $relation['pre_total'];
									$total_after_tax = $total_before_tax+$total_tax;
									//$final_amount = floor($total_after_tax);
									$final_amount = (round($total_after_tax)-$total_after_tax);
									$final_price = asDollars($final_amount);

									?>
									<tr style="height:100%;">
										<td style="width: 10px"><strong><?php echo $dc_details['dc_number']; ?></strong></td>
										<td><?php $product_description = $this->common->get_particular('mst_products',array('product_id' =>$relation['product_id']),'product_description'); echo $product_description; ?></td>
										<td  style="text-align:right;">&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($relation['rate']); ?></td>
										<td><?php echo $relation['quantity']; ?></td>
										<td  style="text-align:right;">&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($relation['rate']*$relation['quantity']); ?></td>
										<td><?php echo $relation['discount_percentage']; ?> % </td>
										<td  style="text-align:right;">&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($amount-$relation['pre_total']); ?></td>
										<td  style="text-align:right;">&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($relation['pre_total']); ?></td>
									</tr>
								<?php } }?>
								<tr>
									<td style="background:#2e75b6;color:#fff;font-size:16px;text-align:center;" colspan="3">Total</td>
									<td><?php echo $total_quantity ?></td>
									<td></td>

									<td style="background:#d0d0d0;text-align:right;" colspan="2">Total Amount Before Tax</td>
									<td style="background:#d0d0d0;text-align:right;">&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($total_before_tax); ?></td>
								</tr>
							</tbody>
						</table>

						<table  style="width: 100%;border: none; margin-bottom: 15px;">

							<tbody>
								<tr>
									<td colspan="3" rowspan="2" style="text-align:center;background:#d0d0d0;">
										<img style="margin-right:6px;" src="<?php echo base_url('assets/images/invoice_logo_1.jpg');?>"  alt="" height="30">
										<img style="margin-right:6px;" src="<?php echo base_url('assets/images/invoice_logo_2.jpg');?>"  alt="" height="30">
										<img style="margin-right:6px;" src="<?php echo base_url('assets/images/invoice_logo_3.jpg');?>"  alt="" height="30">
									</td>
									<td colspan="2" style="text-align:center;">Common Seal</td>
									<td colspan="2" style="text-align:center;font-size:14px;font-weight:bold;">For NRM KNITTEX</td>
									
								</tr>
								<tr>
									<td colspan="2" style="height:80px;"></td>
									<td colspan="2" style="height:80px;"></td>
								</tr>

							</tbody>
						</table>
					</div>
				</div>
			</body>
			</html>