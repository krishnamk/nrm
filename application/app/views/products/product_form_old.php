<style type="text/css">
    .model-dialog{
        max-width: 750px;
    }
</style> 

<div class="modal-header">
    <h4 class="modal-title">NEW PRODUCT</h4>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">
    <form id="new-product">
        <!-- GENERAL DETAILS -->
        <div class="row">
            <div class="col-sm-3">
             <div class="form-group">
                <label><b><h6>General Informations</h6></b></label>
            </div> 
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <label>Product Name</label>
                <input id="product_name" name="product_name" type="text" class="form-control" value="<?php if(isset($products)){
                    echo $products['product_name'];
                } ?>">
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="productdesc">Product Description</label>
                <input type="text" class="form-control" name="product_description" id="product_description" value="<?php if(isset($products)){
                    echo $products['product_description'];
                } ?>">
            </div>
        </div>
        <?php if($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_stylecode'),'product_settings_value')== 1) { ?>
            <div class="col-sm-2">
                <div class="form-group">
                    <label >Product Code</label>
                    <input id="product_stylecode" name="product_stylecode" type="text" class="form-control" value="<?php if(isset($products)){
                        echo $products['product_stylecode'];
                    } ?>">
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="row">
        <div class="col-sm-3">
        </div>
        <?php if($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_hsncode'),'product_settings_value')== 1) { ?>
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="hsn_code">HSN Code</label>
                    <input id="product_hsncode" name="product_hsncode" type="text" class="form-control" value="<?php if(isset($products)){
                        echo $products['product_hsncode'];
                    } ?>">
                </div>
            </div>
        <?php } ?>
        <?php if($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_itemcode'),'product_settings_value')== 1) { ?>
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="item_code">Item Code</label>
                    <input id="product_itemcode" name="product_itemcode" type="text" class="form-control" value="<?php if(isset($products)){
                        echo $products['product_itemcode'];
                    } ?>">
                </div>
            </div>
        <?php } ?>
        <?php if($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_barcode'),'product_settings_value')== 1) { ?>
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="bar_code">Bar Code</label>
                    <input id="product_barcode" name="product_barcode" type="text" class="form-control" value="<?php if(isset($products)){
                        echo $products['product_barcode'];
                    } ?>">
                </div>
            </div>
        <?php } ?>
    </div>
    <hr>
    <!-- PRODUCT INFORMATION DETAILS -->
    <div class="row">
        <div class="col-sm-3">
         <div class="form-group">
            <label ><b><h6>Product Informations</h6></b></label>
        </div> 
    </div>
    <?php if($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')== 1) { ?>
        <div class="col-sm-3">
            <div class="form-group">
                <label class="control-label">Brand</label>
                <select class="form-control" name="product_brand">
                    <?php if(isset($products)){ echo brand($products['product_brand']); }else{ brand(); }  ?> 
                </select>
            </div>
        </div>
    <?php } ?>
    <?php if($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_category'),'product_settings_value')== 1) { ?>
        <div class="col-sm-3">
            <div class="form-group">
                <label class="control-label">Category</label>
                <select class="form-control" name="product_category">
                    <?php if(isset($products)){ echo category($products['product_category']); }else{ category(); }  ?>
                </select>
            </div>
        </div>
    <?php } ?>
    <?php if($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_subcategory'),'product_settings_value')== 1) { ?>
        <div class="col-sm-3">
            <div class="form-group">
                <label class="control-label">Sub Category</label>
                <select class="form-control" name="product_subcategory">
                    <?php if(isset($products)){ echo sub_category($products['product_subcategory']); }else{ sub_category(); }  ?>
                </select>
            </div>
        </div>
    <?php } ?>
</div>
<hr>
<!-- PRICING DETAILS -->
<div class="row">
    <div class="col-sm-3">
     <div class="form-group">
        <label ><b><h6>Pricing Details</h6></b></label>
    </div> 
</div>
<?php if($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_mrp_price'),'product_settings_value')== 1) { ?>
    <div class="col-sm-2">
        <div class="form-group">
            <label for="mrp_price">MRP Price</label>
            <input id="product_mrp" name="product_mrp" type="text" class="form-control" value="<?php if(isset($products)){
                echo $products['product_mrp'];
            } ?>">
        </div>
    </div>
<?php } ?>
<?php if($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_market_price'),'product_settings_value')== 1) { ?>
    <div class="col-sm-2">
        <div class="form-group">
            <label for="market_price">Market Price</label>
            <input id="product_market_price" name="product_market_price" type="text" class="form-control" value="<?php if(isset($products)){
                echo $products['product_market_price'];
            } ?>">
        </div>
    </div>
<?php } ?>
<?php if($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_selling_price'),'product_settings_value')== 1) { ?>
    <div class="col-sm-2">
        <div class="form-group">
            <label for="selling_price">Selling Price</label>
            <input id="product_selling_price" name="product_selling_price" type="text" class="form-control" value="<?php if(isset($products)){
                echo $products['product_selling_price'];
            } ?>">
        </div>
    </div>
<?php } ?>
<?php if($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_purchase_price'),'product_settings_value')== 1) { ?>
    <div class="col-sm-3">
        <div class="form-group">
            <label for="purchase_price">Purchase Price</label>
            <input id="product_purchase_price" name="product_purchase_price" type="text" class="form-control" value="<?php if(isset($products)){
                echo $products['product_purchase_price'];
            } ?>">
        </div>
    </div>  
<?php } ?>                            
</div>
<hr>
<!-- TAX INFORMATIONS -->
<div class="row">
    <div class="col-sm-3">
     <div class="form-group">
        <label ><b><h6>Stock & Tax Informations</h6></b></label>
    </div> 
</div>
                                        <!-- <?php if($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_purchase_price'),'product_settings_value')== 1) { ?>
                                            <div class="col-sm-5">
                                                <div class="form-group">
                                                    <label class="control-label">Tax Type</label>
                                                    <select class="form-control" name="product_tax_type">
                                                        <?php tax_type();?>
                                                    </select>
                                                </div>
                                            </div>
                                            <?php } ?> -->
                                            <?php if($this->common->get_particular('mst_settings',array('settings_name' => 'product_opening_stock'),'settings_value')== 1) { ?>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Opening Stock</label>
                                                        <input id="product_opening_stock" name="product_opening_stock" type="text" class="form-control" value="<?php if(isset($products)){
                                                            echo $products['product_opening_stock'];
                                                        } ?>">
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <?php if($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_tax'),'product_settings_value')== 1) { ?>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Tax</label>
                                                        <select class="form-control" name="product_tax">
                                                            <?php if(isset($products)){ echo tax($products['product_tax']); }else{ tax(); }  ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <hr>
                                        <!-- PRICING DETAILS -->
                                        <div class="row">
                                            <div class="col-sm-3">
                                             <div class="form-group">
                                                <label ><b><h6>Extra Informations</h6></b></label>
                                            </div> 
                                        </div>
                                        <?php if($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_unit'),'product_settings_value')== 1) { ?>
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label class="control-label">Units</label>
                                                    <select class="form-control" name="product_unit">
                                                        <?php if(isset($products)){ echo units($products['product_unit']); }else{ units(); }  ?>
                                                    </select>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php if($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_size'),'product_settings_value')== 1) { ?>
                                            <div class="col-sm-2">
                                             <div class="form-group">
                                                <label class="control-label">Size</label>
                                                <select class="form-control" name="product_size">
                                                    <?php if(isset($products)){ echo size($products['product_size']); }else{ size(); }  ?>
                                                </select>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <?php if($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_colour'),'product_settings_value')== 1) { ?>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label class="control-label">Colours</label>
                                                <select class="form-control" name="product_colour">
                                                    <?php if(isset($products)){ echo colours($products['product_colour']); }else{ colours(); }  ?>
                                                </select>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <?php if($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_secondary_unit'),'product_settings_value')== 1) { ?>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="control-label">Secondary Units</label>
                                                <select class="form-control" name="product_secondary_unit">
                                                    <?php if(isset($products)){ echo secondary_unit($products['product_secondary_unit']); }else{ secondary_unit(); }  ?>
                                                </select>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                                <hr>
                                <!-- IMAGE DETAILS -->
                                <?php if($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_image'),'product_settings_value')== 1) { ?>
                                    <div class="row">
                                        <div class="col-sm-3">
                                         <div class="form-group">
                                            <label ><b><h6>Image Upload</h6></b></label>
                                        </div> 
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <input name="product_image" type="file">
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger waves-effect waves-light new-product ">ADD PRODUCTS</button>
                    </div>