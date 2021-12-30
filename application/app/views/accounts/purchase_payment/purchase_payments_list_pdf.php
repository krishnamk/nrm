<!DOCTYPE html>
<html lang="en">
<head>
  <title> PURCHASE PAYMENT </title>
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
       <th width="100%" style=" border: none;"> <h3><?php echo $company_details['company_name']; ?> PURCHASE PAYMENT REPORTS</h3></th>
     </tr>
   </tbody></table>
   <br>
    <table style="border:1px solid #000; " class="table " border="2" width="100%">
      <thead >
        <tr style="background: rgba(21,76,133,1); ">
          <th style="border-color:black;color: #fff;"><h5 class="no-margin-bottom text-center">S.NO</h5></th>
          <th style="border-color:black;color: #fff;"><h5 class="no-margin-bottom text-center">PAYMENT DATE</h5></th>
          <th style="border-color:black;color: #fff;"><h5 class="no-margin-bottom text-center">PAYMENT NO</h5></th>
          <th style="border-color:black;color: #fff;"><h5 class="no-margin-bottom text-center">SUPPLIER NAME</h5></th>
          <th style="border-color:black;color: #fff;"><h5 class="no-margin-bottom text-center">PAYMENT TYPE</h5></th>
          <th style="border-color:black;color: #fff;"><h5 class="no-margin-bottom text-center">REMARKS</h5></th>
          <th style="border-color:black;color: #fff;"><h5 class="no-margin-bottom text-center">PAID AMOUNT</h5></th>
        </tr>
      </thead>
      <tbody>
        <?php if($lists){ 
          $total_amount = 0;
          foreach ($lists as $key => $list) { 
            $total_amount = $total_amount + $list['paid_amount'];?>
            <tr>
              <td class="text-center" style="border-color:black;text-align:center;"><?php echo next_number($key); ?></td>
              <td class="text-center" style="border-color:black;text-align:center;"><?php echo date('d-m-Y',strtotime($list['payment_date']));?></td>
              <td class="text-center" style="border-color:black;text-align:center;"><?php echo $list['payment_number'];?></td>
              <td class="text-center" style="border-color:black;text-align:center;"><?php echo $list['supplier_name'];?></td>
              <td class="text-center" style="border-color:black;text-align:center;"><?php echo $list['payment_type'];?></td>
              <td class="text-center" style="border-color:black;text-align:center;"><?php echo $list['remarks'];?></td>
              <td class="text-center" style="border-color:black;text-align:center;">&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($list['paid_amount']);?></td>
            </tr>
          <?php } ?>
          <tr>
            <td colspan="6" class="text-center" style="border-color:black;text-align:right;"><b>TOTAL</b></td>
            <td class="text-center" style="border-color:black;text-align:center;">&#8377;&nbsp;&nbsp;&nbsp;<b><?php echo MoneyFormatIndia($total_amount); ?></b></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>
</body>
</html>