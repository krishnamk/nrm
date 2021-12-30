<!DOCTYPE html>
<html lang="en">
<head>
  <title>BUYERS PO EXCEL DETAILS</title>
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
         <th width="100%" style=" border: none;"> <h3>BUYERS PO EXCEL DETAILS</h3></th>
       </tr>
     </tbody></table>
     <table class="invoice_main">
      <tbody>
        <tr>
          <td colspan="2">
            <div class="panel-body" style="border-color: #190909;padding:5px;">
              <p  style="font-size: 14px"><b><?php echo $customer_details['customer_name'];?></b></p>
              <p><?php echo $customer_details['customer_address1']; ?>,</p>
              <p><?php echo $customer_details['customer_address2']; ?></p>
              <p><?php echo $customer_details['customer_city']; ?></p>
              <p><?php echo $customer_details['state_name'].'-'.$customer_details['customer_pincode']; ?></p>
              <p><?php echo 'PHONE - '.$customer_details['customer_phone'];?></p>
              <p><?php if($customer_details['customer_gst']!=''){ echo 'GST - '.$customer_details['customer_gst']; } ?></p><br>
              <p  style="font-size: 14px"><b><?php echo 'DATE - '.date('d-m-Y',strtotime($buyers_po_details['date']));?></b></p>
            </div>
          </td>
        </tr>
      </tbody></table> <br>
      <table style="border:1px solid #000; " class="table " border="2" width="100%">
        <thead >
          <tr style="background: rgba(21,76,133,1); ">
            <th style="border-color:black;color: #fff;"><h5 class="no-margin-bottom text-center">S.NO</h5></th>
            <th style="border-color:black;color: #fff;"><h5 class="no-margin-bottom text-center">VENDOR SKU</h5></th>
            <th style="border-color:black;color: #fff;"><h5 class="no-margin-bottom text-center">SIZE</h5></th>
            <th style="border-color:black;color: #fff;"><h5 class="no-margin-bottom text-center">SKU</h5></th>
            <th style="border-color:black;color: #fff;"><h5 class="no-margin-bottom text-center">PRODUCT NAME</h5></th>
            <th style="border-color:black;color: #fff;"><h5 class="no-margin-bottom text-center">COST</h5></th>
            <th style="border-color:black;color: #fff;"><h5 class="no-margin-bottom text-center">QUANTITY</h5></th>
          </tr>
        </thead>
        <tbody>
          <?php
          $total_quantity = 0;
          foreach ($relations as $key => $relation) {
            $total_quantity = $total_quantity + $relation['quantity'];
            ?>
            <tr>
              <td class="text-center" style="border-color:black;text-align:center;"><?php echo next_number($key); ?></td>
              <td class="text-center" style="border-color:black;text-align:center;"><?php echo $relation['product_stylecode'];?></td>
              <td class="text-center" style="border-color:black;text-align:center;"><?php echo $relation['size_name'];?></td>
              <td class="text-center" style="border-color:black;text-align:center;"><?php echo $relation['product_itemcode'];?></td>
              <td class="text-center" style="border-color:black;text-align:center;"><?php echo $relation['product_name'];?></td>
              <td class="text-center" style="border-color:black;text-align:center;"><?php echo $relation['product_purchase_price'];?></td>
              <td class="text-center" style="border-color:black;text-align:center;"><?php echo $relation['quantity'];?></td>
            </tr>
          <?php } ?>
          <tr>
            <td colspan="6" class="text-center" style="border-color:black;text-align:right;"><b>TOTAL QUANTITY</b></td>
            <td class="text-center" style="border-color:black;text-align:center;"><b><?php echo $total_quantity; ?></b></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>