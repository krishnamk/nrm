<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php echo $company_details['company_name']; ?> SALES REPORTS</title>
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
       <th width="100%" style=" border: none;"> <h3><?php echo $company_details['company_name']; ?> SALES REPORTS</h3></th>
     </tr>
   </tbody></table>
   <table class="purchase_main">
    <tbody>
      <tr>
        <td colspan="2">
          <div class="panel-body" style="border-color: #190909;padding:5px;">
            <p  style="font-size: 14px"><b><?php echo $company_details['company_name'];?></b></p>
            <p><?php echo $company_details['company_address1']; ?>,</p>
            <p><?php echo $company_details['company_address2']; ?></p>
            <p><?php echo $company_details['company_city']; ?></p>
            <p><?php echo $company_details['state_name'].'-'.$company_details['company_pincode']; ?></p>
            <p><?php echo 'PHONE - '.$company_details['company_phone'];?></p>
            <p><?php if($company_details['company_gst']!=''){ echo 'GST - '.$company_details['company_gst']; } ?></p>
          </div>
        </td>
      </tr>
    </tbody></table> <br>
    <table style="border:1px solid #000; " class="table " border="2" width="100%">
      <thead >
        <tr style="background: rgba(21,76,133,1); ">
          <th style="border-color:black;color: #fff;"><h5 class="no-margin-bottom text-center">S.NO</h5></th>
          <th style="border-color:black;color: #fff;"><h5 class="no-margin-bottom text-center">PURCHASE DATE</h5></th>
          <th style="border-color:black;color: #fff;"><h5 class="no-margin-bottom text-center">PURCHASE NO</h5></th>
          <th style="border-color:black;color: #fff;"><h5 class="no-margin-bottom text-center">SUPPLIER NAME</h5></th>
          <th style="border-color:black;color: #fff;"><h5 class="no-margin-bottom text-center">GST NUMBER</h5></th>
          <!-- <th style="border-color:black;color: #fff;"><h5 class="no-margin-bottom text-center">TAX %</h5></th> -->
          <th style="border-color:black;color: #fff;"><h5 class="no-margin-bottom text-center">NET TOTAL AMOUNT</h5></th>
          <th style="border-color:black;color: #fff;"><h5 class="no-margin-bottom text-center">TAX</h5></th>
          <th style="border-color:black;color: #fff;"><h5 class="no-margin-bottom text-center">TOTAL</h5></th>
        </tr>
      </thead>
      <tbody>
        <?php if($lists){
          $total_amount = 0;
          $total_gst = 0;
          $total = 0;
          foreach ($lists as $key => $list) {   
           $total_amount  = $total_amount+$list['new_total'];
           $total_gst     = $total_gst+$list['new_tax'];
           $total = $total_amount + $total_gst;?>
           <tr>
            <td><?php echo ($key+1); ?></td>
            <td><?php echo date('d-m-Y',strtotime($list['purchase_date']));?></td>
            <td><?php echo $list['purchase_number']; ?></td>
            <td><?php echo $list['supplier_name']; ?></td>
            <td><?php echo $list['supplier_gst']; ?></td>
            <!-- <td><?php echo $list['tax_percentage']; ?></td> -->
            <td style="text-align: right;">&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia(($list['new_total']-$list['new_tax'])); ?></td>
            <td style="text-align: right;">&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($list['new_tax']); ?></td>
            <td style="text-align: right;">&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia(($list['new_total'])); ?></td>
          </tr>
        <?php } } ?>
        <tr>
          <td colspan="5"><strong>GRAND TOTAL : </strong></td>
          <td style="text-align:right;"><b><?php if($total_amount!="") { echo MoneyFormatIndia($total_amount); } else{  echo "0.00"; } ?></b></td>
          <td style="text-align:right;"><b>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($total_gst); ?></b></td>
          <td style="text-align:right;"><b>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($total); ?></b></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
</body>
</html>