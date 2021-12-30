<div class="modal-header">
  <h4 class="modal-title"><strong>JOURNAL VIEW</strong></h4>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="modal-body journal_repost_pop">
  <div class="col-lg-12">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <tr>
                  <th><h5><strong>Journal Number : </strong></h5></th>
                  <td><strong><?php if(isset($journal)){ echo $journal['journal_number']; } ?></strong></td>
                </tr>
                <tr>
                  <th><h5><strong>Journal Date : </strong></h5></th>
                  <td><strong><?php if(isset($journal)){ echo date('d-m-Y',strtotime($journal['journal_date'])); } ?></strong></td>
                </tr>
                <tr>
                  <th><h5><strong>Journal Type : </strong></h5></th>
                  <td><strong><?php if(isset($journal)){ echo $journal['journal_type']; } ?></strong></td>
                </tr>               
                
                <?php if($journal['journal_type'] == "supplier"){ ?>
                  <tr>
                    <th><strong><h5>Supplier : </strong></h5></th>
                    <td><strong><?php if(isset($journal)){ echo $journal['supplier_name']; } ?></strong></td>
                  </tr>
                <?php } ?>
                <?php if($journal['journal_type'] == "customer"){ ?>
                  <tr>
                    <th><strong><h5>Customer : </strong></h5></th>
                    <td><strong><?php if(isset($journal)){ echo $journal['customer_name']; } ?></strong></td>
                  </tr>
                <?php } ?>
                <tr>
                  <th><strong><h5>Amount : </strong></h5></th>
                  <td>&#8377;&nbsp;&nbsp;&nbsp;<strong><?php if(isset($journal)){ echo MoneyFormatIndia($journal['amount']); } ?></strong></td>
                </tr>
                <tr>
                  <th><strong><h5>Remarks : </strong></h5></th>
                  <td><strong><?php if(isset($journal)){ echo $journal['remarks']; } ?></strong></td>
                </tr>
            </table>
          </div>
        </div>
      </div> <!-- end col -->
    </div>
  </div>
</div>
<div class="modal-footer"> 
  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>

<style type="text/css">
  .modal.show .modal-dialog {max-width:800px;width: 100%;}
  .payment_repost_pop .row {
    padding-bottom: 10px;
    border-bottom: 1px solid #e9ecef;
    margin-top: 5px;
    padding-top: 10px;
  }
</style>