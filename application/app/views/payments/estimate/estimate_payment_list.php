<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Estimate Payment List</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">List</a></li>
                                <li class="breadcrumb-item active">Payment</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 message"><?php message(); ?></div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Estimate Date</th>
                                        <th>Estimate No</th>
                                        <th>Customer Name</th>
                                        <th>Estimate Amount</th>
                                        <th>Payment Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($lists){
                                        foreach ($lists as $key => $list) { ?>
                                            <tr>
                                                <td><?php echo $key+1;?></td>
                                                <td><?php echo date('d M Y',strtotime($list['estimate_date']));?></td>
                                                <td><?php echo $list['estimate_number'];?></td>
                                                <td><?php echo strtoupper($list['customer_name']);?></td>
                                                <td><b><i class="fa fa-rupee-sign"></i>&nbsp;&nbsp;&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($list['estimate_amount']); ?></b></td>
                                                <!-- <td><?php echo payment_status($list['estimate_status']);?></td> -->
                                                <td><a href="#" data-toggle="tooltip" data-placement="top" title="Balance Amt - <?php if(isset($list['balance_amount'])){ echo $list['balance_amount'];}else{echo $list['estimate_amount'];}?>"><?php echo payment_status($list['estimate_status']);?></a>
                                                </td>
                                                <td><a href="<?php echo base_url('estimate_payments_bill_details/'.$list['estimate_payments_id']);?>" class="btn btn-primary"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;
                                                   <!--                   <?php if($list['estimate_status'] !=2){ ?><a href="<?php echo base_url('estimate_payments_remove/'.$list['estimate_payments_id']);?>" class="btn btn-danger"><i class="fa fa-trash"></i></a><?php } ?>-->
                                               </td>
                                           </tr>
                                       <?php    }
                                   } ?>
                               </tbody>
                           </table>
                       </div>
                   </div>
               </div> <!-- end col -->
           </div> <!-- end row -->
       </div>
   </div>
</div>