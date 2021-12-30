<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Logs</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">All Logs</a></li>
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
                                        <th>Log Category</th>
                                        <th>Log Count</th>
                                        <th>Log Details</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($categories){ 
                                        foreach ($categories as $key => $category) { 
                                            $active = ($key==0) ? 'active' : '' ;
                                            $count = ($category['log_notification']) ? count($category['log_notification']) : 0 ; ?>
                                            <tr>
                                                <td><?php echo $key+1;?></td>
                                                <td><?php echo strtoupper($category['log_category_name']);?></td>
                                                <td><?php echo '<a class="nav-link '.$active.'" data-bs-toggle="tab" href="#tab'.$key.'" role="tab">'.$count.'</a>'?></td>
                                                <?php $logs = $this->logs->get_log_counts($category['log_category_id']); 
                                                if($logs['count']!="0") {  ?>
                                                    <td>Unread Logs &nbsp;&nbsp;&nbsp;<span class="badge badge-danger badge-pill"><?php echo $logs['count']; ?></span></td> 
                                                <?php } else{ ?>
                                                    <td>All readed &nbsp;&nbsp;&nbsp;<span class="badge badge-success badge-pill"><?php echo $logs['count']; ?></span></td>
                                                <?php } ?>
                                                <td><a href="<?php echo base_url('log_details/'.$category['log_category_id']);?>" class="btn btn-primary"><i class="mdi mdi-clock-outline"></i></a></td>
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