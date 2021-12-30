<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php echo $quotation_details['quotation_number']; ?></title>
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
       <th width="100%" style=" border: none;"> <h3>QUOTATION</h3></th>
     </tr>
   </tbody></table>
   <table class="invoice_main">
    <tbody>
      <tr style="border-bottom: none;" class="invoice_top_res">
        <td style="border-right: none;width:25%;">  <span><b>QUOTATION NO:</b></span></td>
        <td style="width:25%;"> <span><?php echo $quotation_details['quotation_number'];?></span></td>
        <td style="border-right: none;width:25%;">  <span><b>DATE:</b></span></td>
        <td style="width:25%;"> <span> <?php echo date('d-m-Y',strtotime($quotation_details['quotation_date']));?></span></td>
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
          <?php if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')== 1)){ ?>
           <th style="border-color:black;color: #fff;"><h5 class="no-margin-bottom text-center">BRAND</h5></th>
         <?php } ?>
         <th style="border-color:black;color: #fff;"><h5 class="no-margin-bottom text-center">QUANTITY</h5></th>
         <th style="border-color:black;color: #fff;"><h5 class="no-margin-bottom text-center">RATE</h5></th>
         <?php if($this->common->get_particular('mst_quotation_settings',array('quotation_settings_name' => 'quotation_tax_included'),'quotation_settings_value')== 1) { ?>
          <th style="border-color:black;color: #fff;"><h5 class="no-margin-bottom text-center">AMOUNT</h5></th>
          <th style="border-color:black;color: #fff;"><h5 class="no-margin-bottom text-center">TAX %</h5></th>
          <th style="border-color:black;color: #fff;"><h5 class="no-margin-bottom text-center">TAX TOTAL</h5></th>
        <?php } ?>
        <th style="border-color:black;color: #fff;"><h5 class="no-margin-bottom text-center">AMOUNT</h5></th>
      </tr>
    </thead>
    <tbody>
      <?php if($relations){
        $total_quantity = 0;
        $total_total = 0;
        $total_tax = 0;
        $total_amount = 0;
        foreach ($relations as $key => $relation) {
         $total_quantity = $total_quantity + $relation['quantity'];
         $total_tax = $total_tax + $relation['tax_total'];
         $total_amount = $relation['rate']*$relation['quantity'];
         if($this->common->get_particular('mst_quotation_settings',array('quotation_settings_name'=>'quotation_tax_included'),'quotation_settings_value')== 1){
          $total_total = $total_total + $relation['total']; 
        }else{
          $total_total = $total_total + $total_amount; 
        }
        ?>
        <tr>
          <td class="text-center" style="border-color:black;text-align:center;"><?php echo next_number($key); ?></td>
          <td class="text-center" style="border-color:black;text-align:center;"><?php echo $relation['product_name'];?></td>
          <?php if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')== 1)){ ?>
            <td class="text-center" style="border-color:black;text-align:center;"><?php echo $relation['brand_name'];?></td>
          <?php } ?>
          <td class="text-center" style="border-color:black;text-align:center;"><?php echo $relation['quantity'];?></td>
          <td class="text-center" style="border-color:black;text-align:center;">&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($relation['rate']); ?></td>
          <?php if($this->common->get_particular('mst_quotation_settings',array('quotation_settings_name' => 'quotation_tax_included'),'quotation_settings_value')== 1) { ?>
            <td class="text-center" style="border-color:black;text-align:center;">&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($relation['quantity']*$relation['rate'])); ?></td>
            <td class="text-center" style="border-color:black;text-align:center;"><?php echo $relation['tax_percent']; ?> % </td>
            <td class="text-center" style="border-color:black;text-align:center;">&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($relation['tax_total']); ?></td>
            <td class="text-center" style="border-color:black;text-align:center;">&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($relation['total']); ?></td>
          <?php } else { ?>
            <td class="text-center" style="border-color:black;text-align:center;">&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($relation['quantity']*$relation['rate'])); ?></td> 
          <?php } ?>
        <?php } ?>
        <tr>
          <td colspan="<?php if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')== 1)){ ?>3
            <?php } else{ ?>2<?php } ?>" class="text-center" style="border-color:black;text-align:right;"><strong class="float-right">TOTAL</strong></td>
            <?php if($this->common->get_particular('mst_quotation_settings',array('quotation_settings_name' => 'quotation_tax_included'),'quotation_settings_value')== 1) { ?>
              <td colspan='<?php if($this->common->get_particular('mst_quotation_settings',array('quotation_settings_name' => 'quotation_tax_included'),'quotation_settings_value')== 1) { ?>1<?php } else{ ?>0<?php } ?>' class="text-center" style="border-color:black;text-align:center;"><strong><label><?php echo $total_quantity; ?></label></strong></td>
              <td></td>
              <td class="text-center" style="border-color:black;text-align:center;"><strong>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($total_amount);?></strong></td>
              <td></td>
              <td class="text-center" style="border-color:black;text-align:center;"><strong>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($total_tax); ?></strong></td>
              <td class="text-center" style="border-color:black;text-align:center;"><label><strong>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($total_total); ?></strong></label></td> 
            <?php }else{ ?>
             <td class="text-center" style="border-color:black;text-align:center;"><strong><?php echo $total_quantity;?></strong></td>
             <td></td>
             <td class="text-center" style="border-color:black;text-align:center;"><label><strong>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($total_total); ?></strong></label></td>
           <?php } ?>
         </tr>
       <?php } ?>
     </tbody>
   </table>
 </div>
</div>
</body>
</html>