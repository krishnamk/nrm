<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php echo $purchase_order_details['purchase_order_number']; ?></title>
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
       <th width="100%" style=" border: none;"> <h3>PURCHASE RETURN</h3></th>
     </tr>
   </tbody></table>
   <table class="invoice_main">
    <tbody>
      <tr style="border-bottom: none;" class="invoice_top_res">
        <td style="border-right: none;width:25%;">  <span><b>PURCHASE RETURN NO:</b></span></td>
        <td style="width:25%;"> <span><?php echo $purchase_return_details['purchase_return_number'];?></span></td>
        <td style="border-right: none;width:25%;">  <span><b>DATE:</b></span></td>
        <td style="width:25%;"> <span> <?php echo date('d-m-Y',strtotime($purchase_return_details['purchase_return_date']));?></span></td>
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
            <p  style="font-size: 14px"><b><?php echo $supplier_details['supplier_name'];?></b></p>
            <p><?php echo $supplier_details['supplier_address1']; ?>,</p>
            <p><?php echo $supplier_details['supplier_address2']; ?></p>
            <p><?php echo $supplier_details['supplier_city']; ?></p>
            <p><?php echo $supplier_details['state_name'].'-'.$supplier_details['supplier_pincode']; ?></p>
            <p><?php echo 'PHONE - '.$supplier_details['supplier_phone'];?></p>
            <p><?php if($supplier_details['supplier_gst']!=''){ echo 'GST - '.$supplier_details['supplier_gst']; } ?></p>
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
          <th style="border-color:black;color: #fff;"><h5 class="no-margin-bottom text-center">QUANTITY</h5></th>
          <th style="border-color:black;color: #fff;"><h5 class="no-margin-bottom text-center">RATE</h5></th>
          <th style="border-color:black;color: #fff;"><h5 class="no-margin-bottom text-center">TOTAL</h5></th>
        </tr>
      </thead>
      <tbody>
        <?php
        $total_quantity = 0;
        $total_amount = 0;
        foreach ($relations as $key => $relation) {
          $total_quantity = $total_quantity + $relation['return_quantity'];
          $total_amount = $total_amount + ($relation['return_quantity']*$relation['rate']);
          ?>
          <tr>
            <td class="text-center" style="border-color:black;text-align:center;"><?php echo next_number($key); ?></td>
            <td class="text-center" style="border-color:black;text-align:center;"><?php echo $relation['product_name'];?></td>
            <?php if($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')== 1) { ?>
              <td class="text-center" style="border-color:black;text-align:center;"><?php echo $relation['brand_name'];?></td>
            <?php } ?>
            <td class="text-center" style="border-color:black;text-align:center;"><?php echo $relation['return_quantity'];?></td>
            <td class="text-center" style="border-color:black;text-align:center;">&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($relation['rate']); ?></td>
            <td class="text-center" style="border-color:black;text-align:center;">&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($relation['rate']*$relation['return_quantity']); ?></td>
          </tr>
        <?php } ?>
        <tr>
          <td colspan="<?php if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')== 1)){ ?>3<?php } else{ ?>2<?php } ?>" class="text-center" style="border-color:black;text-align:right;"><b>TOTAL QTY</b></td>
          <td class="text-center" style="border-color:black;text-align:center;"><b><?php echo $total_quantity; ?></b></td>
          <td class="text-center" style="border-color:black;text-align:center;"><b>TOTAL</b></td>
          <td class="text-center" style="border-color:black;text-align:center;"><b>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($total_amount); ?></b></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
</body>
</html>