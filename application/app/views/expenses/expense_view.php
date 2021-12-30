<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">EXPENSE VIEW</h4>
                        <div class="page-title-right">
                            <div class="d-flex align-items-center justify-content-end">
                                <div class="col-12 ">
                                   <a href="<?php echo base_url('expense_edit/'.$expense_detail['expense_id']);?>" style="margin-right: 5px;" class="btn btn-warning float-right"><i class="fa fa-pencil-alt"></i>&nbsp;&nbsp;EDIT</a>
                                   <?php if($expense_detail['expense_status']==0){ ?>
                                    <a href="<?php echo base_url('expense_paid/'.$expense_detail['expense_id']);?>" style="margin-right: 5px;" class="btn btn-success float-right"><i class="fa fa-rupee-sign"></i>&nbsp;&nbsp;PAID</a>
                                <?php } ?>
                                <a href="<?php echo base_url('expenses_list');?>" style="margin-right: 5px;" class="btn btn-info float-right"><i class="fa fas fa-backward"></i>&nbsp;BACK</a>
                            </div>
                        </div>
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
                    <form class="form-horizontal">
                        <div class="form-body">
                            <div class="card-body">
                                <table class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <tbody>
                                        <tr>
                                            <td><label><strong>EXPENSE NUMBER</strong></label></td>
                                            <td><label><?php echo $expense_detail['expense_number']; ?></label></td>
                                            <td><label><strong>BILL DATE</strong></label></td>
                                            <td><label><?php echo date('d-m-Y',strtotime($expense_detail['expense_date'])); ?></label></td>
                                        </tr>
                                        <tr>
                                            <td><label><strong>BILL NO</strong></label></td>
                                            <td><label><?php echo $expense_detail['expense_billno']; ?></label></td>
                                            <td><label><strong>EXPENSE CATEGORY</strong></label></td>
                                            <td><label><?php echo ($expense_detail['expense_category']); ?></label></td>
                                        </tr>
                                        <tr>
                                            <td><label><strong> RESPONSIBLE PERSON </strong></label></td>
                                            <td><label><?php echo $expense_detail['expense_person']; ?></label></td>
                                            <td><label><strong>EXPENSE STATUS</strong></label></td>
                                            <td><label><?php echo expense_status($expense_detail['expense_status']); ?></label></td>
                                        </tr>
                                        <tr>
                                            <td><label><strong> EXPENSE AMOUNT </strong></label></td>
                                            <td><label><?php echo $expense_detail['expense_amount']; ?></label></td>
                                            <td><label><strong> PERSON NAME </strong></label></td>
                                            <td><label><?php $person_name = $this->common->get_particular('mst_users',array('user_id' => $expense_detail['person_name']),'name'); echo 
                                            $person_name; ?></label></td>
                                        </tr>
                                        <tr>
                                            <td><label><strong>REMARKS</strong></label><strong></strong></td>
                                            <td colspan="8"><strong><?php echo $expense_detail['expense_remark']; ?></strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->
</div>