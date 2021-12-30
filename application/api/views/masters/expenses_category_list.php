<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-expenses_category-18">Expenses Category List</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">List</a></li>
                                <li class="breadcrumb-item active">Expenses Category</li>
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
                                <a href="<?php echo base_url('expenses_category');?>" class="btn btn-primary waves-effect waves-light"><i class="bx bxs-comment-add font-expenses_category-16 align-middle mr-2"></i>Add Expenses Category</a>
                            </div><br>
                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Expenses Category Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($expenses_categories){ 
                                        foreach($expenses_categories as $key => $expenses_category) { ?>
                                    <tr>
                                        <td><?php echo $key+1;?></td>
                                        <td><?php echo $expenses_category['expense_category'];?></td>
                                        <td>
                                            <a href="<?php echo base_url('expenses_category_edit/'.$expenses_category['expense_category_id']);?>" class="btn btn-success"><i class="mdi mdi-comment-edit"></i></a>
                                            <a href="<?php echo base_url('expenses_category_delete/'.$expenses_category['expense_category_id']);?>" class="btn btn-danger cancel"><i class="mdi mdi-delete-circle"></i></a>
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