<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Expenses List</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">List</a></li>
                                <li class="breadcrumb-item active">Expenses</li>
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
                                <a href="<?php echo base_url('expense');?>" class="btn btn-primary waves-effect waves-light"><i class="bx bxs-comment-add font-size-16 align-middle mr-2"></i>Add Expenses</a>
                            </div><br>
                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Expense Number</th>
                                        <th>Date</th>
                                        <th>Expense Category</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($lists){

                                        foreach ($lists as $key => $list) { ?>

                                            <tr>

                                                <td><?php echo $key+1;?></td>

                                                <td><?php echo $list['expense_number'];?></td>

                                                <td><?php echo date('d-m-Y',strtotime($list['expense_date']));?></td>

                                                <td><?php echo $list['expense_category'];?></td>

                                                <td><b><i class="fa fa-rupee-sign"></i>&nbsp;<?php echo $list['expense_amount'];?></b></td>

                                                <td><?php echo expense_status($list['expense_status']); ?></td>

                                                <td>

                                                    <a href="<?php echo base_url('expense_view/'.$list['expense_id']);?>" class="btn btn-primary"><i class="fa fa-eye"></i></a>&nbsp;

                                                        <?php if($this->session->userdata('access_level') <= 2){

                                                            if($list['expense_status']==0){ ?>

                                                             <a href="<?php echo base_url('expense_edit/'.$list['expense_id']);?>" class="btn btn-warning"><i class="fa fa-pencil-alt"></i></a> &nbsp; 
                                                             <a href="<?php echo base_url('expense_remove/'.$list['expense_id']);?>" class="btn btn-danger cancel"><i class="fa fa-trash"></i>&nbsp;REMOVE</a>

                                                         <?php } ?>

                                                         <?php if($list['expense_status']==1){ ?>

                                                            <a href="<?php echo base_url('expense_paid/'.$list['expense_id']);?>" class="btn btn-success cancel"><i class="fa fa-check"></i>&nbsp;PAID</a>

                                                        <?php } }?>
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