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
      height: 50px;
    }
    table.table_all{}
    @page {
      size: 8in 11.25in;
      margin: 1mm 1mm 1mm 1mm;
    }
    h5{margin: 0;}
    ul{padding: 0; margin: 0; }
    ul li{list-style: none;}
    .invice_table { border:1px solid #333; border-collapse: collapse; }
    .invice_table tr th,.invice_table tr td{border:1px solid #333; width: 120px; text-align: center;}
    table{border:1px solid #333; width: 100%; border-collapse: collapse;}
    table tbody{background: #154c85; color: #fff;}
    table tr,table tr td,table  tr th{border: 1px solid #333;}
    table tr td,table  tr th{font-size: 14px;padding:10px;}
    table.noborder tr,table.noborder tr td,table.noborder  tr th,table.noborder{border: none;text-align:center;}
  </style>
</head>
<body>
  <div class="container">
    <div class="row no-margin">
      <table style="width: 100%; border: none;">
        <tbody><tr style="border: none;">
          <th width="100%" style=" border: none;"> <h3>ESTIMATE</h3></th>
        </tr>
      </tbody></table>
      <table class="estimate_main">
        <tbody>
          <tr style="border-bottom: none;" class="estimate_top_res">
            <td style="border-right: none;width:25%;">  <span><b>ESTIMATE NO:</b></span></td>
            <td style="width:25%;"> <span><?php echo $estimate_details['estimate_number'];?></span></td>
            <td style="border-right: none;width:25%;">  <span><b>DATE:</b></span></td>
            <td style="width:25%;"> <span> <?php echo date('d-m-Y',strtotime($estimate_details['estimate_date']));?></span></td>
          </tr>
          <tr>
            <td colspan="2">
              <div class="panel-body" style="border-color: #190909;padding:5px;">
                <h5 style="font-size: 16px"><b>FROM</b></h5>
                <p  style="font-size: 14px"><b><?php echo $company_details['company_name'];?></b></p>
                <p><?php echo $company_details['company_address1']; ?>,</p>
                <p><?php echo $company_details['company_address2']; ?></p>
                <p><?php echo $company_details['company_city']; ?></p>
                <p><?php echo $company_details['state_name'].'-'.$company_details['company_pincode']; ?></p>
                <p><?php echo 'PHONE - '.$company_details['company_phone'];?></p>
                <p><?php if($company_details['company_gst']!=''){ echo 'GST - '.$company_details['company_gst']; } ?></p>
              </div>
            </td>
            <td colspan="2">
              <div class="panel-body" style="border-color: #190909;padding:5px;">
                <h5 style="font-size: 16px"><b>TO</b></h5>
                <p  style="font-size: 14px"><b><?php echo $customer_details['customer_name'];?></b></p>
                <p><?php echo $customer_details['customer_address1']; ?>,</p>
                <p><?php echo $customer_details['customer_address2']; ?></p>
                <p><?php echo $customer_details['customer_city']; ?></p>
                <p><?php echo $customer_details['state_name'].'-'.$customer_details['customer_pincode']; ?></p>
                <p><?php echo 'PHONE - '.$customer_details['customer_phone'];?></p>
                <p><?php if($customer_details['customer_gst']!=''){ echo 'GST - '.$customer_details['customer_gst']; } ?></p>
              </div>
            </td>
          </tr>
        </tbody></table> <br>
        <table style="border:1px solid #000; " class="table " border="2" width="100%">
          <thead >
            <tr style="background: rgba(21,76,133,1); ">
              <th style="border-color:black;color: #fff;"><h5 class="no-margin-bottom text-center">S.NO</h5></th>
              <th style="border-color:black;color: #fff;"><h5 class="no-margin-bottom text-center">PRODUCT NAME</h5></th>
              <?php if($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')== 1) { ?>
                <th style="border-color:black;color: #fff;"><h5 class="no-margin-bottom text-center">BRAND</h5></th>                                            
              <?php } ?>
              <th style="border-color:black;color: #fff;"><h5 class="no-margin-bottom text-center">QTY</h5></th>
              <th style="border-color:black;color: #fff;"><h5 class="no-margin-bottom text-center">RATE</h5></th>
              <?php if(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_productwise_discount'),'estimate_settings_value')== 1)){ ?>
                <th style="border-color:black;color: #fff;"><h5 class="no-margin-bottom text-center">AMOUNT</th>
                  <th style="border-color:black;color: #fff;"><h5 class="no-margin-bottom text-center">DISC %</th>
                    <th style="border-color:black;color: #fff;"><h5 class="no-margin-bottom text-center">DISC AMT</th>
                      <th style="border-color:black;color: #fff;"><h5 class="no-margin-bottom text-center">TOTAL</th>
                      <?php } elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_overall_discount'),'estimate_settings_value')== 1)){ ?>
                        <th style="border-color:black;color: #fff;"><h5 class="no-margin-bottom text-center">AMOUNT</th>
                          <th style="border-color:black;color: #fff;"><h5 class="no-margin-bottom text-center">DISC %</th>
                            <th style="border-color:black;color: #fff;"><h5 class="no-margin-bottom text-center">DISC AMT</th>
                              <th style="border-color:black;color: #fff;"><h5 class="no-margin-bottom text-center">TOTAL</th>
                              <?php } else { ?>
                                <th style="border-color:black;color: #fff;"><h5 class="no-margin-bottom text-center">TOTAL</th>
                                <?php } ?>
                              </tr>
                            </thead>
                            <tbody>
                              <?php if($relations){
                                $total_quantity = 0;
                                $total_tax = 0;
                                $total = 0;
                                $total_amount = 0;
                                $net_total = 0;
                                $pre_total = 0;
                                $final_total = 0;
                                $discount_amt = 0;
                                $discount_total = 0;
                                $total_price = 0;
                                $final_amount = 0;
                                $final_price = 0;
                                foreach ($relations as $key => $relation) {
                                  $total_quantity = $total_quantity + $relation['quantity'];
                                  $amount = $relation['rate']*$relation['quantity'];
                                  $total_amount = $total_amount + $amount;
                                  if(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name'=>'estimate_productwise_discount'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)){
                                    $discount_amt = $amount - $relation['pre_total'];
                                    $discount_total = $discount_total + $discount_amt; 
                                    $total_price = $total_price + ($discount_amt+$amount);  
                                  }
                                  if(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name'=>'estimate_overall_discount'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)){
                                    $discount_amt = $amount - $relation['pre_total'];
                                    $discount_total = $discount_total + $discount_amt; 
                                    $total_price = $total_price + ($discount_amt+$amount);  
                                  }
                                  $final_price = asDollars($total_price);
                                  ?>
                                  <tr>
                                    <td style="width: 10px"><strong><?php echo next_number($key); ?></strong></td>
                                    <td class="text-center" style="border-color:black;text-align:center;"><label><?php echo $relation['product_name']; ?></label></td>
                                    <?php if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')== 1)){ ?>
                                      <td class="text-center" style="border-color:black;text-align:center;"><label><?php echo $relation['brand_name']; ?></label></td>
                                    <?php } ?>
                                    <td class="text-center" style="border-color:black;text-align:center;"><label><?php echo $relation['quantity']; ?></label></td>
                                    <td class="text-center" style="border-color:black;text-align:right;">&#8377;&nbsp;&nbsp;&nbsp;<label><?php echo MoneyFormatIndia($relation['rate']); ?></label></td>
                                    <?php if(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_productwise_discount'),'estimate_settings_value')== 1)){ ?>
                                      <td class="text-center" style="border-color:black;text-align:center;"><label>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia(($relation['quantity']*$relation['rate'])); ?></label></td>
                                      <td class="text-center" style="border-color:black;text-align:center;"><label><?php echo $relation['discount_percentage']; ?> % </label></td>
                                      <td class="text-center" style="border-color:black;text-align:center;"><label>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($discount_amt); ?></label></td>
                                      <td class="text-center" style="border-color:black;text-align:right;"><label>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($discount_amt+$amount); ?></label></td>
                                    <?php } elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_overall_discount'),'estimate_settings_value')== 1)){ ?>
                                      <td class="text-center" style="border-color:black;text-align:center;"><label>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia(($relation['quantity']*$relation['rate'])); ?></label></td>
                                      <td class="text-center" style="border-color:black;text-align:center;"><label><?php echo $relation['discount_percentage']; ?> % </label></td>
                                      <td class="text-center" style="border-color:black;text-align:center;"><label>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($discount_amt); ?></label></td>
                                      <td class="text-center" style="border-color:black;text-align:right;"><label>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($discount_amt+$amount); ?></label></td>
                                    <?php } else { ?>
                                      <td class="text-center" style="border-color:black;text-align:right;"><label>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia(($relation['rate']*$relation['quantity'])); ?></label></td>
                                    <?php } ?>
                                  </tr>
                                <?php } ?>
                                <tr>
                                  <td colspan='<?php if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')== 1)){ ?>3
                                    <?php } else{ ?>2<?php } ?>' style="text-align:right;"><strong>NET TOTAL</strong></td>
                                    <?php if(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_productwise_discount'),'estimate_settings_value')== 1)){ ?>
                                     <td class="text-center" style="border-color:black;text-align:center;"><strong><?php echo $total_quantity;?></strong></td>
                                     <td class="text-center" style="border-color:black;text-align:center;"></td>
                                     <td class="text-center" style="border-color:black;text-align:center;"><label><strong>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($total_amount); ?></strong></label></td>
                                     <td class="text-center" style="border-color:black;text-align:center;"></td>
                                     <td class="text-center" style="border-color:black;text-align:center;"><label><strong>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($discount_total); ?></strong></label></td>
                                     <td class="text-center" style="border-color:black;text-align:right;"><label><strong>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($total_price); ?></strong></label></td>
                                   <?php } elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_overall_discount'),'estimate_settings_value')== 1)){ ?>
                                     <td class="text-center" style="border-color:black;text-align:center;"><strong><?php echo $total_quantity;?></strong></td>
                                     <td class="text-center" style="border-color:black;text-align:center;"></td>
                                     <td class="text-center" style="border-color:black;text-align:center;"><label><strong>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($total_amount); ?></strong></label></td>
                                     <td class="text-center" style="border-color:black;text-align:center;"></td>
                                     <td class="text-center" style="border-color:black;text-align:center;"><label><strong>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($discount_total); ?></strong></label></td>
                                     <td class="text-center" style="border-color:black;text-align:right;"><label><strong>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($total_price); ?></strong></label></td>
                                   <?php } else { ?>
                                     <td class="text-center" style="border-color:black;text-align:center;"><strong><?php echo $total_quantity;?></strong></td>
                                     <td class="text-center" style="border-color:black;text-align:center;"></td>
                                     <td class="text-center" style="border-color:black;text-align:right;"><label><strong>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($total_amount); ?></strong></label></td>
                                   <?php } ?>
                                 </tr>
                                 <?php if(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_productwise_discount'),'estimate_settings_value')== 1)){ 
                                  $final_amount = $final_amount + $total_price; ?>
                                <?php } elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_overall_discount'),'estimate_settings_value')== 1)){ 
                                  $final_amount = $final_amount + $total_price; ?>
                                <?php } else { 
                                  $final_amount = $final_amount + $total_amount; ?>
                                <?php } ?>
                                <?php if($estimate_details['estimate_cash_discount']!="0") {  
                                  $final_amount = $final_amount-$estimate_details['estimate_cash_discount']; ?>
                                  <tr>
                                    <td colspan="<?php if($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')!= 1){ echo "7"; }elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_discount'),'estimate_settings_value')!= 1)) { echo "5"; } elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_productwise_discount'),'estimate_settings_value')== 1)){ echo "8"; }elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_overall_discount'),'estimate_settings_value')== 1)){ echo "8"; }elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_cash_discount'),'estimate_settings_value')== 1)){ echo "5"; }else { echo "6"; }?>" align="right"><b>CASH DISCOUNT</b></td>
                                    <td class="text-right" style="text-align:right;"><?php echo digit_maintainer($estimate_details['estimate_cash_discount']); ?></td>
                                  </tr>
                                <?php } ?>
                                <?php if($estimate_details['estimate_other_expenses']!="0") {  
                                  $final_amount = $final_amount+$estimate_details['estimate_other_expenses']; ?>
                                  <tr>
                                    <td colspan="<?php if($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')!= 1){ echo "7"; }elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_discount'),'estimate_settings_value')!= 1)) { echo "5"; } elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_productwise_discount'),'estimate_settings_value')== 1)){ echo "8"; } elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_overall_discount'),'estimate_settings_value')== 1)){ echo "8"; }elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_cash_discount'),'estimate_settings_value')== 1)){ echo "5"; }else { echo "6"; }?>" align="right"><b><b>OTHER EXPENSES</b></td>
                                    <td class="text-center"  style="text-align:right;"><?php echo digit_maintainer($estimate_details['estimate_other_expenses']); ?></td>
                                  </tr>
                                <?php } ?>
                                <?php if($estimate_details['estimate_transportaion_charges']!="0") {  
                                  $final_amount = $final_amount+$estimate_details['estimate_transportaion_charges']; ?>
                                  <tr>
                                    <td colspan="<?php if($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')!= 1){ echo "7"; }elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_discount'),'estimate_settings_value')!= 1)) { echo "5"; } elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_productwise_discount'),'estimate_settings_value')== 1)){ echo "8"; } elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_overall_discount'),'estimate_settings_value')== 1)){ echo "8"; }elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_cash_discount'),'estimate_settings_value')== 1)){ echo "5"; }else { echo "6"; }?>" align="right"><b>TRANPORTATION CHARGES</b></td>
                                    <td class="text-center"  style="text-align:right;"><?php echo digit_maintainer($estimate_details['estimate_transportaion_charges']); ?></td>
                                  </tr>
                                <?php } ?>
                                <?php if($estimate_details['estimate_loading_charges']!="0") {  
                                  $final_amount = $final_amount+$estimate_details['estimate_loading_charges']; ?>
                                  <tr>
                                    <td colspan="<?php if($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')!= 1){ echo "7"; }elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_discount'),'estimate_settings_value')!= 1)) { echo "5"; } elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_productwise_discount'),'estimate_settings_value')== 1)){ echo "8"; } elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_overall_discount'),'estimate_settings_value')== 1)){ echo "8"; }elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_cash_discount'),'estimate_settings_value')== 1)){ echo "5"; }else { echo "6"; }?>" align="right"><b><b>LOADING/UNLOADING CHARGES</b></td>
                                    <td class="text-center"  style="text-align:right;"><?php echo digit_maintainer($estimate_details['estimate_loading_charges']); ?></td>
                                  </tr>
                                <?php } ?>
                                <tr>
                                  <td colspan="<?php if($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')!= 1){ echo "7"; } elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_discount'),'estimate_settings_value')!= 1)) { echo "5"; } elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_productwise_discount'),'estimate_settings_value')== 1)){ echo "8"; } elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_overall_discount'),'estimate_settings_value')== 1)){ echo "8"; }elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_cash_discount'),'estimate_settings_value')== 1)){ echo "5"; }else { echo "6"; }?>" class="text-align:right;" style="text-align: right;"><b><b> TOTAL </b></td>
                                  <td class="text-center"  style="text-align:right;"><strong><?php echo digit_maintainer($final_amount); ?></strong></td>
                                </tr>
                              <?php } ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </body>
                    </html><!DOCTYPE html>
                    <html lang="en">
                    <head>
                      <title><?php echo $estimate_details['estimate_number']; ?></title>
                      <meta charset="UTF-8">
                      <meta name="viewport" content="width=device-width, initial-scale=1">
                      <style type="text/css">
                        .container{width: 1000px; margin: 0 auto;}
                        body{    font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;}
                        table.table_all tbody > tr > td {
                          height: 50px;
                        }
                        table.table_all{}
                        @page {
                          size: 8in 11.25in;
                          margin: 1mm 1mm 1mm 1mm;
                        }
                        h5{margin: 0;}
                        ul{padding: 0; margin: 0; }
                        ul li{list-style: none;}
                        .invice_table { border:1px solid #333; border-collapse: collapse; }
                        .invice_table tr th,.invice_table tr td{border:1px solid #333; width: 120px; text-align: center;}
                        table{border:1px solid #333; width: 100%; border-collapse: collapse;}
                        table tbody{background: #154c85; color: #fff;}
                        table tr,table tr td,table  tr th{border: 1px solid #333;}
                        table tr td,table  tr th{font-size: 14px;padding:10px;}
                        table.noborder tr,table.noborder tr td,table.noborder  tr th,table.noborder{border: none;text-align:center;}
                      </style>
                    </head>
                    <body>
                      <div class="container">
                        <div class="row no-margin">
                          <table style="width: 100%; border: none;">
                            <tbody><tr style="border: none;">
                              <th width="100%" style=" border: none;"> <h3>estimate</h3></th>
                            </tr>
                          </tbody></table>
                          <table class="estimate_main">
                            <tbody>
                              <tr style="border-bottom: none;" class="estimate_top_res">
                                <td style="border-right: none;width:25%;">  <span><b>estimate NO:</b></span></td>
                                <td style="width:25%;"> <span><?php echo $estimate_details['estimate_number'];?></span></td>
                                <td style="border-right: none;width:25%;">  <span><b>DATE:</b></span></td>
                                <td style="width:25%;"> <span> <?php echo date('d-m-Y',strtotime($estimate_details['estimate_date']));?></span></td>
                              </tr>
                              <tr>
                                <td colspan="2">
                                  <div class="panel-body" style="border-color: #190909;padding:5px;">
                                    <h5 style="font-size: 16px"><b>FROM</b></h5>
                                    <p  style="font-size: 14px"><b><?php echo $company_details['company_name'];?></b></p>
                                    <p><?php echo $company_details['company_address1']; ?>,</p>
                                    <p><?php echo $company_details['company_address2']; ?></p>
                                    <p><?php echo $company_details['company_city']; ?></p>
                                    <p><?php echo $company_details['state_name'].'-'.$company_details['company_pincode']; ?></p>
                                    <p><?php echo 'PHONE - '.$company_details['company_phone'];?></p>
                                    <p><?php if($company_details['company_gst']!=''){ echo 'GST - '.$company_details['company_gst']; } ?></p>
                                  </div>
                                </td>
                                <td colspan="2">
                                  <div class="panel-body" style="border-color: #190909;padding:5px;">
                                    <h5 style="font-size: 16px"><b>TO</b></h5>
                                    <p  style="font-size: 14px"><b><?php echo $customer_details['customer_name'];?></b></p>
                                    <p><?php echo $customer_details['customer_address1']; ?>,</p>
                                    <p><?php echo $customer_details['customer_address2']; ?></p>
                                    <p><?php echo $customer_details['customer_city']; ?></p>
                                    <p><?php echo $customer_details['state_name'].'-'.$customer_details['customer_pincode']; ?></p>
                                    <p><?php echo 'PHONE - '.$customer_details['customer_phone'];?></p>
                                    <p><?php if($customer_details['customer_gst']!=''){ echo 'GST - '.$customer_details['customer_gst']; } ?></p>
                                  </div>
                                </td>
                              </tr>
                            </tbody></table> <br>
                            <table style="border:1px solid #000; " class="table " border="2" width="100%">
                              <thead >
                                <tr style="background: rgba(21,76,133,1); ">
                                  <th style="border-color:black;color: #fff;"><h5 class="no-margin-bottom text-center">S.NO</h5></th>
                                  <th style="border-color:black;color: #fff;"><h5 class="no-margin-bottom text-center">PRODUCT NAME</h5></th>
                                  <th style="border-color:black;color: #fff;"><h5 class="no-margin-bottom text-center">BRAND</h5></th>
                                  <th style="border-color:black;color: #fff;"><h5 class="no-margin-bottom text-center">QTY</h5></th>
                                  <th style="border-color:black;color: #fff;"><h5 class="no-margin-bottom text-center">RATE</h5></th>
                                  <?php if(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_discount'),'estimate_settings_value')!= 1)) { ?>
                                    <th style="border-color:black;color: #fff;"><h5 class="no-margin-bottom text-center">AMOUNT</th>
                                      <th style="border-color:black;color: #fff;"><h5 class="no-margin-bottom text-center">TAX %</th>
                                        <th style="border-color:black;color: #fff;"><h5 class="no-margin-bottom text-center">TAX TOTAL</th>
                                          <th style="border-color:black;color: #fff;"><h5 class="no-margin-bottom text-center">TOTAL</th>
                                          <?php } elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_productwise_discount'),'estimate_settings_value')== 1)){ ?>
                                            <th style="border-color:black;color: #fff;"><h5 class="no-margin-bottom text-center">AMOUNT</th>
                                              <th style="border-color:black;color: #fff;"><h5 class="no-margin-bottom text-center">DISC %</th>
                                                <th style="border-color:black;color: #fff;"><h5 class="no-margin-bottom text-center">DISC AMT</th>
                                                  <th style="border-color:black;color: #fff;"><h5 class="no-margin-bottom text-center">TOTAL</th>
                                                  <?php } elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_overall_discount'),'estimate_settings_value')== 1)){ ?>
                                                    <th style="border-color:black;color: #fff;"><h5 class="no-margin-bottom text-center">AMOUNT</th>
                                                      <th style="border-color:black;color: #fff;"><h5 class="no-margin-bottom text-center">DISC %</th>
                                                        <th style="border-color:black;color: #fff;"><h5 class="no-margin-bottom text-center">DISC AMT</th>
                                                          <th style="border-color:black;color: #fff;"><h5 class="no-margin-bottom text-center">TOTAL</th>
                                                          <?php } elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_discount'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_productwise_discount'),'estimate_settings_value')== 1)){ ?>
                                                            <th style="border-color:black;color: #fff;"><h5 class="no-margin-bottom text-center">AMOUNT</th>
                                                              <th style="border-color:black;color: #fff;"><h5 class="no-margin-bottom text-center">DISC %</th>
                                                                <th style="border-color:black;color: #fff;"><h5 class="no-margin-bottom text-center">NET TOTAL</th>
                                                                  <th style="border-color:black;color: #fff;"><h5 class="no-margin-bottom text-center">TAX %</th>
                                                                    <th style="border-color:black;color: #fff;"><h5 class="no-margin-bottom text-center">TAX TOTAL</th>
                                                                      <th style="border-color:black;color: #fff;"><h5 class="no-margin-bottom text-center">TOTAL</th>
                                                                      <?php }elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_discount'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_overall_discount'),'estimate_settings_value')== 1)){ ?>
                                                                        <th style="border-color:black;color: #fff;"><h5 class="no-margin-bottom text-center">AMOUNT</th>
                                                                          <th style="border-color:black;color: #fff;"><h5 class="no-margin-bottom text-center">DISC %</th>
                                                                            <th style="border-color:black;color: #fff;"><h5 class="no-margin-bottom text-center">NET TOTAL</th>
                                                                              <th style="border-color:black;color: #fff;"><h5 class="no-margin-bottom text-center">TAX %</th>
                                                                                <th style="border-color:black;color: #fff;"><h5 class="no-margin-bottom text-center">TAX TOTAL</th>
                                                                                  <th style="border-color:black;color: #fff;"><h5 class="no-margin-bottom text-center">TOTAL</th>
                                                                                  <?php }else { ?>
                                                                                    <th style="border-color:black;color: #fff;"><h5 class="no-margin-bottom text-center">TOTAL</th>
                                                                                    <?php } ?>
                                                                                  </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                  <?php if($relations){
                                                                                    $total_quantity = 0;
                                                                                    $total_tax = 0;
                                                                                    $total = 0;
                                                                                    $total_amount = 0;
                                                                                    $net_total = 0;
                                                                                    $pre_total = 0;
                                                                                    $final_total = 0;
                                                                                    $discount_amt = 0;
                                                                                    $discount_total = 0;
                                                                                    $total_price = 0;
                                                                                    $final_amount = 0;
                                                                                    foreach ($relations as $key => $relation) {
                                                                                      $total_quantity = $total_quantity + $relation['quantity'];
                                                                                      $amount = $relation['rate']*$relation['quantity'];
                                                                                      $total_tax = $total_tax + $relation['tax_total'];
                                                                                      $total_amount = $total_amount + $amount;
                                                                                      if($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')== 1){
                                                                                        $total = $total_amount + $total_tax;  
                                                                                      }
                                                                                      if(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name'=>'estimate_productwise_discount'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)){
                                                                                        $discount_amt = $amount - $relation['pre_total'];
                                                                                        $discount_total = $discount_total + $discount_amt; 
                                                                                        $total_price = $total_price + ($discount_amt+$amount);  
                                                                                      }
                                                                                      if(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name'=>'estimate_overall_discount'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)){
                                                                                        $discount_amt = $amount - $relation['pre_total'];
                                                                                        $discount_total = $discount_total + $discount_amt; 
                                                                                        $total_price = $total_price + ($discount_amt+$amount);  
                                                                                      }
                                                                                      if(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_discount'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_productwise_discount'),'estimate_settings_value')== 1)){ 
                                                                                        $net_total = $net_total + $relation['pre_total']; 
                                                                                        $pre_total = $relation['pre_total'] + $relation['tax_total'];
                                                                                        $final_total = $final_total + $relation['total'];
                                                                                      }
                                                                                      if(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_discount'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_overall_discount'),'estimate_settings_value')== 1)){ 
                                                                                        $net_total = $net_total + $relation['pre_total']; 
                                                                                        $pre_total = $relation['pre_total'] + $relation['tax_total'];
                                                                                        $final_total = $final_total + $relation['total'];
                                                                                      }
                                                                                      ?>
                                                                                      <tr>
                                                                                        <td style="width: 10px"><strong><?php echo next_number($key); ?></strong></td>
                                                                                        <td class="text-center" style="border-color:black;text-align:center;"><label><?php echo $relation['product_name']; ?></label></td>
                                                                                        <td class="text-center" style="border-color:black;text-align:center;"><label><?php echo $relation['brand_name']; ?></label></td>
                                                                                        <td class="text-center" style="border-color:black;text-align:center;"><label><?php echo $relation['quantity']; ?></label></td>
                                                                                        <td class="text-center" style="border-color:black;text-align:center;"><label>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($relation['rate']); ?></label></td>
                                                                                        <?php if(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_discount'),'estimate_settings_value')!= 1)) { ?>
                                                                                          <td class="text-center" style="border-color:black;text-align:center;"><label>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia(($relation['quantity']*$relation['rate'])); ?></label></td>
                                                                                          <td class="text-center" style="border-color:black;text-align:center;"><label><?php echo $relation['tax_percent']; ?> % </label></td>
                                                                                          <td class="text-center" style="border-color:black;text-align:center;"><label>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($relation['tax_total']); ?></label></td>
                                                                                          <td class="text-center" style="border-color:black;text-align:center;"><label>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($relation['total']); ?></label></td>
                                                                                        <?php } elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_productwise_discount'),'estimate_settings_value')== 1)){ ?>
                                                                                          <td class="text-center" style="border-color:black;text-align:center;"><label>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia(($relation['quantity']*$relation['rate'])); ?></label></td>
                                                                                          <td class="text-center" style="border-color:black;text-align:center;"><label><?php echo $relation['discount_percentage']; ?> % </label></td>
                                                                                          <td class="text-center" style="border-color:black;text-align:center;"><label>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($discount_amt); ?></label></td>
                                                                                          <td class="text-center" style="border-color:black;text-align:center;"><label>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($discount_amt+$amount); ?></label></td>
                                                                                        <?php } elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_overall_discount'),'estimate_settings_value')== 1)){ ?>
                                                                                          <td class="text-center" style="border-color:black;text-align:center;"><label>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia(($relation['quantity']*$relation['rate'])); ?></label></td>
                                                                                          <td class="text-center" style="border-color:black;text-align:center;"><label><?php echo $relation['discount_percentage']; ?> % </label></td>
                                                                                          <td class="text-center" style="border-color:black;text-align:center;"><label>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($discount_amt); ?></label></td>
                                                                                          <td class="text-center" style="border-color:black;text-align:center;"><label>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($discount_amt+$amount); ?></label></td>
                                                                                        <?php } elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_discount'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_productwise_discount'),'estimate_settings_value')== 1)){ ?>
                                                                                          <td class="text-center" style="border-color:black;text-align:center;"><label>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia(($relation['quantity']*$relation['rate'])); ?></label></td>
                                                                                          <td class="text-center" style="border-color:black;text-align:center;"><label><?php echo $relation['discount_percentage']; ?> % </label></td>
                                                                                          <td class="text-center" style="border-color:black;text-align:center;"><label>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($relation['pre_total']); ?></label></td>
                                                                                          <td class="text-center" style="border-color:black;text-align:center;"><label><?php echo $relation['tax_percent']; ?> % </label></td>
                                                                                          <td class="text-center" style="border-color:black;text-align:center;"><label>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($relation['tax_total']); ?></label></td>
                                                                                          <td class="text-center" style="border-color:black;text-align:center;"><label>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($pre_total); ?></label></td>
                                                                                        <?php } elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_discount'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_overall_discount'),'estimate_settings_value')== 1)){ ?>
                                                                                          <td class="text-center" style="border-color:black;text-align:center;"><label>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia(($relation['quantity']*$relation['rate'])); ?></label></td>
                                                                                          <td class="text-center" style="border-color:black;text-align:center;"><label><?php echo $relation['discount_percentage']; ?> % </label></td>
                                                                                          <td class="text-center" style="border-color:black;text-align:center;"><label>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($relation['pre_total']); ?></label></td>
                                                                                          <td class="text-center" style="border-color:black;text-align:center;"><label><?php echo $relation['tax_percent']; ?> % </label></td>
                                                                                          <td class="text-center" style="border-color:black;text-align:center;"><label>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($relation['tax_total']); ?></label></td>
                                                                                          <td class="text-center" style="border-color:black;text-align:center;"><label>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($pre_total); ?></label></td>
                                                                                        <?php }else { ?>
                                                                                          <td class="text-center" style="border-color:black;text-align:center;"><label>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia(($relation['rate']*$relation['quantity'])); ?></label></td>
                                                                                        <?php } ?>
                                                                                      </tr>
                                                                                    <?php } ?>
                                                                                    <tr>
                                                                                      <td colspan='3' style="text-align:right;"><strong>NET TOTAL</strong></td>
                                                                                      <?php if(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_discount'),'estimate_settings_value')!= 1)) { ?>
                                                                                        <td class="text-center" style="border-color:black;text-align:center;"><strong><?php echo $total_quantity;?></strong></td>
                                                                                        <td class="text-center" style="border-color:black;text-align:center;"></td>
                                                                                        <td class="text-center" style="border-color:black;text-align:center;"><label><strong>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($total_amount); ?></strong></label></td>
                                                                                        <td class="text-center" style="border-color:black;text-align:center;"></td>
                                                                                        <td class="text-center" style="border-color:black;text-align:center;"><label><strong>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($total_tax); ?></strong></label></td>
                                                                                        <td class="text-center" style="border-color:black;text-align:center;"><label><strong>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($total); ?></strong></label></td>
                                                                                      <?php } elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_productwise_discount'),'estimate_settings_value')== 1)){ ?>
                                                                                       <td class="text-center" style="border-color:black;text-align:center;"><strong><?php echo $total_quantity;?></strong></td>
                                                                                       <td class="text-center" style="border-color:black;text-align:center;"></td>
                                                                                       <td class="text-center" style="border-color:black;text-align:center;"><label><strong>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($total_amount); ?></strong></label></td>
                                                                                       <td class="text-center" style="border-color:black;text-align:center;"></td>
                                                                                       <td class="text-center" style="border-color:black;text-align:center;"><label><strong>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($discount_total); ?></strong></label></td>
                                                                                       <td class="text-center" style="border-color:black;text-align:center;"><label><strong>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($total_price); ?></strong></label></td>
                                                                                     <?php } elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_overall_discount'),'estimate_settings_value')== 1)){ ?>
                                                                                       <td class="text-center" style="border-color:black;text-align:center;"><strong><?php echo $total_quantity;?></strong></td>
                                                                                       <td class="text-center" style="border-color:black;text-align:center;"></td>
                                                                                       <td class="text-center" style="border-color:black;text-align:center;"><label><strong>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($total_amount); ?></strong></label></td>
                                                                                       <td class="text-center" style="border-color:black;text-align:center;"></td>
                                                                                       <td class="text-center" style="border-color:black;text-align:center;"><label><strong>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($discount_total); ?></strong></label></td>
                                                                                       <td class="text-center" style="border-color:black;text-align:center;"><label><strong>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($total_price); ?></strong></label></td>
                                                                                     <?php } elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_discount'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_productwise_discount'),'estimate_settings_value')== 1)){ ?>
                                                                                       <td class="text-center" style="border-color:black;text-align:center;"><strong><?php echo $total_quantity;?></strong></td>
                                                                                       <td class="text-center" style="border-color:black;text-align:center;"></td>
                                                                                       <td class="text-center" style="border-color:black;text-align:center;"><label><strong>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($total_amount); ?></strong></label></td>
                                                                                       <td class="text-center" style="border-color:black;text-align:center;"></td>
                                                                                       <td class="text-center" style="border-color:black;text-align:center;"><label><strong>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($net_total); ?></strong></label></td>
                                                                                       <td class="text-center" style="border-color:black;text-align:center;"></td>
                                                                                       <td class="text-center" style="border-color:black;text-align:center;"><label><strong>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($total_tax); ?></strong></label></td>
                                                                                       <td class="text-center" style="border-color:black;text-align:center;"><label><strong>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($final_total); ?></strong></label></td>
                                                                                     <?php } elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_discount'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_overall_discount'),'estimate_settings_value')== 1)){ ?>
                                                                                       <td class="text-center" style="border-color:black;text-align:center;"><strong><?php echo $total_quantity;?></strong></td>
                                                                                       <td class="text-center" style="border-color:black;text-align:center;"></td>
                                                                                       <td class="text-center" style="border-color:black;text-align:center;"><label><strong>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($total_amount); ?></strong></label></td>
                                                                                       <td class="text-center" style="border-color:black;text-align:center;"></td>
                                                                                       <td class="text-center" style="border-color:black;text-align:center;"><label><strong>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($net_total); ?></strong></label></td>
                                                                                       <td class="text-center" style="border-color:black;text-align:center;"></td>
                                                                                       <td class="text-center" style="border-color:black;text-align:center;"><label><strong>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($total_tax); ?></strong></label></td>
                                                                                       <td class="text-center" style="border-color:black;text-align:center;"><label><strong>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($final_total); ?></strong></label></td>
                                                                                     <?php }else { ?>
                                                                                       <td class="text-center" style="border-color:black;text-align:center;"><strong><?php echo $total_quantity;?></strong></td>
                                                                                       <td class="text-center" style="border-color:black;text-align:center;"></td>
                                                                                       <td class="text-center" style="border-color:black;text-align:center;"><label><strong>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($total_amount); ?></strong></label></td>
                                                                                     <?php } ?>
                                                                                   </tr>
                                                                                   <?php if(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_discount'),'estimate_settings_value')!= 1)) { 
                                                                                    $final_amount = $final_amount + $total; ?>
                                                                                  <?php } elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_productwise_discount'),'estimate_settings_value')== 1)){ 
                                                                                    $final_amount = $final_amount + $total_price; ?>
                                                                                  <?php } elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_overall_discount'),'estimate_settings_value')== 1)){ 
                                                                                    $final_amount = $final_amount + $total_price; ?>
                                                                                  <?php } elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_discount'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_productwise_discount'),'estimate_settings_value')== 1)){ 
                                                                                    $final_amount = $final_amount + $final_total; ?>
                                                                                  <?php }elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_discount'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_overall_discount'),'estimate_settings_value')== 1)){ 
                                                                                    $final_amount = $final_amount + $final_total; ?>
                                                                                  <?php }else { 
                                                                                    $final_amount = $final_amount + $total_amount; ?>
                                                                                  <?php } ?>
                                                                                  <?php if($estimate_details['estimate_cash_discount']!="0") {  
                                                                                    $final_amount = $final_amount-$estimate_details['estimate_cash_discount']; ?>
                                                                                    <tr>
                                                                                      <td colspan="<?php if(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_discount'),'estimate_settings_value')!= 1)) { echo "9"; } elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_discount'),'estimate_settings_value')!= 1)) { echo "5"; } elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_productwise_discount'),'estimate_settings_value')== 1)){ echo "8"; }elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_overall_discount'),'estimate_settings_value')== 1)){ echo "8"; }elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_discount'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_productwise_discount'),'estimate_settings_value')== 1)){ echo "10"; }elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_discount'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_overall_discount'),'estimate_settings_value')== 1)){ echo "10"; }else { echo "6"; }?>" align="right"><b>OTHER EXPENSES</b></td>
                                                                                      <td class="text-center"><?php echo digit_maintainer($estimate_details['estimate_other_expenses']); ?></td>
                                                                                    </tr>
                                                                                  <?php } ?>
                                                                                  <?php if($estimate_details['estimate_other_expenses']!="0") {  
                                                                                    $final_amount = $final_amount+$estimate_details['estimate_other_expenses']; ?>
                                                                                    <tr>
                                                                                      <td colspan="<?php if(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_discount'),'estimate_settings_value')!= 1)) { echo "9"; } elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_discount'),'estimate_settings_value')!= 1)) { echo "5"; } elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_productwise_discount'),'estimate_settings_value')== 1)){ echo "8"; } elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_overall_discount'),'estimate_settings_value')== 1)){ echo "8"; }elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_discount'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_productwise_discount'),'estimate_settings_value')== 1)){ echo "10"; }elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_discount'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_overall_discount'),'estimate_settings_value')== 1)){ echo "10"; }else { echo "6"; }?>" align="right"><b><b>OTHER EXPENSES</b></td>
                                                                                      <td class="text-center" ><?php echo digit_maintainer($estimate_details['estimate_other_expenses']); ?></td>
                                                                                    </tr>
                                                                                  <?php } ?>
                                                                                  <?php if($estimate_details['estimate_transportaion_charges']!="0") {  
                                                                                    $final_amount = $final_amount+$estimate_details['estimate_transportaion_charges']; ?>
                                                                                    <tr>
                                                                                      <td colspan="<?php if(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_discount'),'estimate_settings_value')!= 1)) { echo "9"; } elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_discount'),'estimate_settings_value')!= 1)) { echo "5"; } elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_productwise_discount'),'estimate_settings_value')== 1)){ echo "8"; } elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_overall_discount'),'estimate_settings_value')== 1)){ echo "8"; }elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_discount'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_productwise_discount'),'estimate_settings_value')== 1)){ echo "10"; }elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_discount'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_overall_discount'),'estimate_settings_value')== 1)){ echo "10"; }else { echo "6"; }?>" align="right"><b>TRANPORTATION CHARGES</b></td>
                                                                                      <td class="text-center" ><?php echo digit_maintainer($estimate_details['estimate_transportaion_charges']); ?></td>
                                                                                    </tr>
                                                                                  <?php } ?>
                                                                                  <?php if($estimate_details['estimate_loading_charges']!="0") {  
                                                                                    $final_amount = $final_amount+$estimate_details['estimate_loading_charges']; ?>
                                                                                    <tr>
                                                                                      <td colspan="<?php if(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_discount'),'estimate_settings_value')!= 1)) { echo "9"; } elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_discount'),'estimate_settings_value')!= 1)) { echo "5"; } elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_productwise_discount'),'estimate_settings_value')== 1)){ echo "8"; } elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_overall_discount'),'estimate_settings_value')== 1)){ echo "8"; }elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_discount'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_productwise_discount'),'estimate_settings_value')== 1)){ echo "10"; }elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_discount'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_overall_discount'),'estimate_settings_value')== 1)){ echo "10"; }else { echo "6"; }?>" align="right"><b><b>LOADING/UNLOADING CHARGES</b></td>
                                                                                      <td class="text-center" ><?php echo digit_maintainer($estimate_details['estimate_loading_charges']); ?></td>
                                                                                    </tr>
                                                                                  <?php } ?>
                                                                                  <tr>
                                                                                    <td colspan="<?php if(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_discount'),'estimate_settings_value')!= 1)) { echo "9"; } elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)){ echo "5"; }elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_discount'),'estimate_settings_value')!= 1)) { echo "5"; } elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_productwise_discount'),'estimate_settings_value')== 1)){ echo "8"; } elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_overall_discount'),'estimate_settings_value')== 1)){ echo "8"; }elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_discount'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_productwise_discount'),'estimate_settings_value')== 1)){ echo "10"; }elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_discount'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_overall_discount'),'estimate_settings_value')== 1)){ echo "10"; }else { echo "6"; }?>" class="text-align:right;" style="text-align: right;"><b><b> TOTAL </b></td>
                                                                                    <td class="text-center" ><strong><?php echo digit_maintainer($final_amount); ?></strong></td>
                                                                                  </tr>
                                                                                <?php } ?>
                                                                              </tbody>
                                                                            </table>
                                                                          </div>
                                                                        </div>
                                                                      </body>
                                                                      </html>