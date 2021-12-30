<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Stock List</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">List</a></li>
                                <li class="breadcrumb-item active">Stock</li>
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
                      <form method="post">
                          <div class="card">
                              <!-- /.card-header -->
                              <div class="card-body">
                                  <div class="row">
                                    <div class="form-group col-md-3">
                                        <label class="control-label">PRODUCT TYPE</label>
                                        <select  name="product_type_id" class="form-control select2" >
                                            <?php if($product_type){ echo $product_type; } ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="control-label">PRODUCT</label>
                                        <select  name="product_id" class="form-control select2" >
                                            <?php if($products){ echo $products; } ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="col-lg-12">&nbsp;</label>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="radio">VIEW
                                                    <input type="radio" name="option" value="view" <?php if(isset($option)){ if($option=='view'){ echo "checked";} }else{echo "checked";}?> >
                                                    <span class="checkround"></span>
                                                </label>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="radio">PDF
                                                    <input type="radio" name="option" value="print" <?php if(isset($option)){ if($option=='print'){ echo "checked";} }?> >
                                                    <span class="checkround"></span>
                                                </label>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="radio">EXCEL
                                                    <input type="radio" name="option" value="excel" <?php if(isset($option)){ if($option=='excel'){ echo "checked";} }?> >
                                                    <span class="checkround"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-1">
                                        <label class="control-label">&nbsp;</label>
                                        <div class="col-md-12 float-lg-right">
                                            <input type="submit" class="btn btn-primary"  id='filter' value="FILTER">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="button-items" style="text-align: right;">
                            <a href="<?php echo base_url('stock_sheet_update'); ?>" class="btn btn-primary waves-effect waves-light"><i class="bx bxs-comment-add font-size-16 align-middle mr-2"></i>Update Stock</a>
                        </div><br>
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <?php if($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_image'),'product_settings_value')== 1) { ?>
                                        <th>Image</th>
                                    <?php } ?>
                                    <th>Product Name</th>
                                    <?php if($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_type'),'product_settings_value')== 1) { ?>
                                        <th>Brand Name</th>
                                        <th>Category Name</th>
                                        <th>Sub Category Name</th>
                                    <?php } ?>
                                    <th>Quantity</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($stocks){ 
                                    foreach($stocks as $key => $stock) { ?>
                                        <tr>
                                            <td><?php echo $key+1;?></td>
                                            <?php if($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_image'),'product_settings_value')== 1) { ?>
                                                <td><img src="<?php product_image($stock['product_image']); ?>" style="height: 100px;width: 100px;"></td>
                                            <?php } ?>
                                            <td><?php $product_name = $this->common->get_particular('mst_products',array('product_id' => $stock['product_id'],'status' => 1),'product_name'); 
                                            echo $product_name;?></td>
                                            <?php if($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_type'),'product_settings_value')== 1) { ?>
                                                <td><?php if(isset($stock['brand_name'])){ echo $stock['brand_name']; }else{ echo "-"; } ?></td>
                                                <td><?php if(isset($stock['category_name'])){ echo $stock['category_name']; }else{ echo "-"; } ?>  </td>
                                                <td><?php if(isset($stock['sub_category_name'])){ echo $stock['sub_category_name']; }else{ echo "-"; } ?></td>
                                            <?php } ?>
                                            <td><?php echo $stock['quantity'];?></td>
                                            <td>
                                                <a href="<?php echo base_url('stock_inward_outward_details/'.$stock['product_id']); ?>" class="btn btn-primary waves-effect waves-light model" data-toggle="modal" data-target="#responsive-modal">View Details</a>
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