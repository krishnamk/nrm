<div class="col-md-12">
    <div class="table-responsive">
        <table id="file_export" class="table table-striped table-bordered display">
            <thead>
                <tr>
                    <th>S.NO</th>
                    <th>RETURN</th>
                    <th>PRODUCT NAME</th>
                    <th>BRAND NAME</th>
                    <th>SALES QUANTITY</th>
                    <th>RETURN QUANTITY</th>
                </tr>
            </thead>
            <tbody>
                <?php if($relations){
                    foreach ($relations as $key => $relation) { ?>
                        <tr>
                            <td><?php echo next_number($key); ?></td>
                            <td><input type="checkbox" name="invoice_relation_id[<?php echo $key; ?>]" class="form-control checkbox<?php echo $key; ?>" style="width:15px;text-align: center;" value="<?php echo $relation['invoice_relation_id']; ?>" <?php if(isset($return_details)){ echo 'checked'; } ?>></td>
                            <td><?php echo $relation['product_name']; ?></td>
                            <td><?php echo $relation['brand_name']; ?></td>
                            <td>
                                <input type="hidden" style="width:60px;float: left;" class="form-control invoice_quantities <?php echo $key; ?>" data-id="<?php echo $key; ?>" value="<?php echo $relation['quantity']; ?>" readonly>
                                <!-- <input type="text" name="current_quantity[<?php echo $key; ?>]" style="width:60px;float: left;" class="form-control current_quantity current_quantity<?php echo $key; ?>" data-id="<?php echo $key; ?>" value="<?php echo $relation['available_quantity']; ?>" readonly> -->
                                 <input type="text" name="current_quantity[<?php echo $key; ?>]" style="width:60px;float: left;" class="form-control current_quantity current_quantity<?php echo $key; ?>" data-id="<?php echo $key; ?>" value="<?php if(isset($sales_return_details)){ echo $relation['return_quantity']; } else { echo $relation['quantity']; } ?>" readonly>
                                
                            </td>
                            <td>
                                <input type="text" name="return_quantity[<?php echo $key; ?>]" class="form-control quantity quantity<?php echo $key; ?>" data-id="<?php echo $key; ?>" style="width:60px;float: left;" value="<?php if(isset($return_details)){ echo $relation['return_quantity']; }else{ echo 0;} ?>" onclick="$(this).select();">
                            </td>
                        </tr>
                    <?php } } ?>
                </tbody>
            </table>
        </div>
    </div>