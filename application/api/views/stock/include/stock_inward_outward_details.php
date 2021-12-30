<div class="modal-content" style="width:800px;">
  <div class="modal-header" style="text-align: center;">
    <h5 class="modal-title" id="exampleModalLabel"><?php echo strtoupper($product_name); ?></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="modal-body">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-6">
                <div class="row">
                    <table class="table">
                        <thead>
                            <th style="text-align: center;">STOCK INWARD</th>
                        </thead>
                    </table>
                </div>
                 <div class="row">
                <div class="col-lg-12 message"><?php message(); ?></div>
            </div>
                <div class="row">
                    <table class="table">
                        <thead>
                            <th>S.No</th>
                            <th>Date</th>
                            <th>Qty</th>
                        </thead>
                        <tbody>
                            <?php if($stock_details['stock_inward']){ 
                                foreach($stock_details['stock_inward'] as $key => $stock_inwards) { ?>
                                    <tr>
                                        <td><?php echo $key+1;?></td>
                                        <td><?php echo date('d-m-Y',strtotime($stock_inwards['date']));?></td>
                                        <td><?php echo $stock_inwards['inward_qty'];?></td>
                                    </tr>
                                <?php } }?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="row">
                        <table class="table">
                            <thead>
                                <th style="text-align: center;">STOCK ADJUSTMENT</th>
                            </thead>
                        </table>
                    </div>
                    <div class="row">
                        <table class="table">
                            <thead>
                                <th>S.No</th>
                                <th>Date</th>
                                <th>Qty</th>
                            </thead>
                            <tbody>
                                <?php if($stock_details['stock_adjustment']){ 
                                foreach($stock_details['stock_adjustment'] as $key => $stock_adjustments) { ?>
                                    <tr>
                                        <td><?php echo $key+1;?></td>
                                        <td><?php echo date('d-m-Y',strtotime($stock_adjustments['date']));?></td>
                                        <td><?php echo $stock_adjustments['adjustment_qty'];?></td>
                                    </tr>
                                <?php } }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
    </div>
</div>