    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18">Add Expenses</h4>
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Expenses</a></li>
                                    <li class="breadcrumb-item active">Add Expenses</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 message"><?php message(); ?></div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <form  method="post" id="expense_form"> 
                                <div class="form-body">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <input type="hidden" class="form-control" name="prefix_value" id="prefix_value" value="expense_no">
                                                    <?php if($this->common->get_particular('mst_general_settings',array('general_settings_name' => 'multiple_company'),'general_settings_value')==1){?>
                                                        <?php if($this->session->userdata('access_level') <= 2) {  ?>
                                                            <div class="form-group col-md-2">
                                                                <label class="control-label">SELECT COMPANY</label>
                                                                <select id="company_id" name="company_id" class="form-control form-control-danger">
                                                                    <option value="">SELECT COMPANY</option>
                                                                    <?php if(isset($expense_detail)) { ?>  <option value='<?php $company_id = $this->common->get_particular('company_details',array('company_name' => $company_list),'company_id'); echo $company_lists; ?>'><?php echo $company_lists; ?></option>";
                                                                <?php }else{ ?> 
                                                                   <?php foreach ($company_lists as $key => $company_list) { ?>
                                                                    echo "
                                                                    <option value='<?php $company_id = $this->common->get_particular('company_details',array('company_name' => $company_list),'company_id'); echo $company_id; ?>'><?php echo $company_list; ?></option>";
                                                                <?php } ?>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                <?php } ?>
                                            <?php } ?>
                                            <div class="form-group col-md-4">
                                                <label class="control-label">EXPENSE NUMBER</label>
                                                <input type="text" name="expense_number" id="expense_number" class="form-control" placeholder="EXPENSE NUMBER" value="<?php if(isset($expense_detail)){ echo $expense_detail['expense_number']; }else{ echo $expense_number; } ?>">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label class="control-label">BILL DATE</label>
                                                <input type="date" name="expense_date" id="expense_date" class="form-control form-control-danger" placeholder="DATE" value="<?php if(isset($expense_detail)){ echo date('Y-m-d',strtotime($expense_detail['expense_date'])); }else{ echo date('Y-m-d'); } ?>">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label class="control-label">EXPENSE CATEGORY</label>
                                                <select id="expense_category_id" name="expense_category_id" class="form-control form-control-danger">
                                                    <?php echo $category; ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label class="control-label">RESPONSIBLE PERSON</label>
                                                <input type="text" name="expense_person" id="expense_person" class="form-control" placeholder="ENTER PERSON NAME" value="<?php if(isset($expense_detail)){ echo $expense_detail['expense_person']; } ?>">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label class="control-label">BILL NO</label>
                                                <input type="text" name="expense_billno" id="expense_billno" class="form-control" placeholder="ENTER BILL NO" value="<?php if(isset($expense_detail)){ echo $expense_detail['expense_billno']; } ?>">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label class="control-label">AMOUNT</label>
                                                <input type="text" name="expense_amount" id="expense_amount" class="form-control" placeholder="ENTER AMOUNT" value="<?php if(isset($expense_detail)){ echo $expense_detail['expense_amount']; } ?>">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-4">
                                             <label class="radio"><p><b>UN PAID</b></p>
                                                <input type="radio" name="expense_status" class="expense_status" value="0" <?php if(isset($expense_detail)){ if($expense_detail['expense_status']==0){ echo 'checked'; } }else{ echo 'checked';} ?> >
                                                <span class="checkround"></span>
                                            </label> &nbsp;&nbsp;&nbsp;
                                            <label class="radio"><p><b>PAID</b></p>
                                                <input type="radio" name="expense_status" class="expense_status" value="1" <?php if(isset($expense_detail)){ if($expense_detail['expense_status']==1){ echo 'checked'; } } ?> >
                                                <span class="checkround"></span>
                                            </label>
                                        </div> 
                                        <div class="form-group col-md-4">
                                            <label class="control-label">PERSON NAME</label>
                                            <select id="person_name" name="person_name" class="form-control form-control-danger">
                                                <?php if(isset($expense_detail)){ echo users($expense_detail['person_name']); }else{ echo users(); }  ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="control-label">REMARKS</label>
                                            <textarea class="form-control" name="expense_remark" id="expense_remark"><?php if(isset($expense_detail)){ echo $expense_detail['expense_remark']; } ?></textarea>
                                        </div>
                                    </div>
                                </div> 
                            </div> 
                            <div class="form-actions">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <a href="<?php echo base_url('expenses_list'); ?>" class="btn btn-dark">CANCEL</a>
                                        </div>
                                        <div class="col-md-6 ">
                                            <button type="submit" class="btn btn-success float-right"> <i class="fa fa-check"></i> ADD EXPENSE</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>