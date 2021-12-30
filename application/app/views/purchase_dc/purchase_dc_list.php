<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Purchase DC List</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">List</a></li>
                                <li class="breadcrumb-item active">Purchase DC</li>
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
                            <div class="button-items" style="text-align: right;">
                                <a href="<?php echo base_url('purchase_dc');?>" class="btn btn-primary waves-effect waves-light"><i class="bx bxs-comment-add font-size-16 align-middle mr-2"></i>Add Purchase DC</a>
                            </div><br>
                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Date</th>
                                        <th>Purchase DC No</th>
                                        <th>DC No</th>
                                        <th>Supplier</th>
                                        <th>Purchase DC Qty</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($lists){ 
                                        foreach($lists as $key => $purchase_dc) { ?>
                                            <tr>
                                                <td><?php echo $key+1;?></td>
                                                <td><?php echo date('d-m-Y',strtotime($purchase_dc['purchase_dc_date']));?></td>
                                                <td><?php echo $purchase_dc['purchase_dc_number'];?></td>
                                                <td><?php echo $purchase_dc['purchase_dc_no'];?></td>
                                                <td><?php echo $purchase_dc['supplier_name'];?></td>
                                                <td><?php echo $purchase_dc['quantity'];?></td>
                                                <td><?php echo dc_status($purchase_dc['dc_status']); ?></td>
                                                <td>
                                                    <a href="<?php echo base_url('purchase_dc_view/'.$purchase_dc['purchase_dc_id']);?>" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="View"><i class="mdi mdi-view-compact-outline"></i></a>
                                                    <?php if($purchase_dc['dc_status']==1) { ?> 
                                                        <a href="<?php echo base_url('purchase_dc_edit/'.$purchase_dc['purchase_dc_id']);?>" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Edit"><i class="mdi mdi-comment-edit"></i></a>
                                                    <?php } ?>
                                                    <a href="<?php echo base_url('purchase_dc_remove/'.$purchase_dc['purchase_dc_id']);?>" class="btn btn-danger cancel" data-toggle="tooltip" data-placement="top" title="Delete"><i class="mdi mdi-delete-circle"></i></a>
                                                </td>
                                            </tr>
                                        <?php } }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->
            </div>
        </div>
    </div>