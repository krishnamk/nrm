<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Buyers PO List</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">List</a></li>
                                <li class="breadcrumb-item active">Excel List</li>
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
                                <a href="<?php echo base_url('buyers_po_excel_upload');?>" class="btn btn-primary waves-effect waves-light"><i class="bx bxs-comment-add font-size-16 align-middle mr-2"></i>Buyers PO Excel Upload</a>
                            </div><br> 
                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Date</th>
                                        <th>Customer</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($lists){ 
                                        foreach($lists as $key => $list) { ?>
                                            <tr>
                                                <td><?php echo $key+1;?></td>
                                                <td><?php echo date('d-m-Y',strtotime($list['date']));?></td>
                                                <td><?php echo $list['customer_name'];?></td>
                                                <td><?php echo buyers_po_excel_status($list['status']);?></td>
                                                <td>
                                                    <a href="<?php echo base_url('buyers_po_excel_view/'.$list['buyers_po_id']);?>" class="btn btn-primary"><i class="mdi mdi-view-compact-outline"></i></a>
                                                    <?php if($list['status']!="2") { ?> 
                                                        <a href="<?php echo base_url('buyers_po_convert_into_quotation/'.$list['buyers_po_id']);?>" style="margin-right: 5px;" class="btn btn-primary"><i class="bx bxs-truck font-size-16 align-middle mr-2"></i>Generate Quotation</a>
                                                    <?php }elseif($list['status']=="2"){ ?> 
                                                        <a href="#" class="btn btn-warning"><i class="bx bxs-truck font-size-16 align-middle mr-2"></i>Quotation Generated</a>
                                                    <?php } ?>
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