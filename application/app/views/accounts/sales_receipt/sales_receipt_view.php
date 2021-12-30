<div class="modal-header">
  <h5 class="modal-title"><strong>RECEIPT VIEW</strong></h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="modal-body receipt_repost_pop">
  <div class="col-lg-12">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
              <tr>
                <th><h5><strong>Receipt Number : </strong></h5></th>
                <td><strong><?php if(isset($receipt)){ echo $receipt['receipt_number']; } ?></strong></td>
              </tr>
              <tr>
                <th><h5><strong>Receipt Date : </strong></h5></th>
                <td><strong><?php if(isset($receipt)){ echo date('d-m-Y',strtotime($receipt['receipt_date'])); } ?></strong></td>
              </tr>
              <tr>
                <th><strong><h5>Customer : </strong></h5></th>
                <td><strong><?php if(isset($receipt)){ echo $receipt['customer_name']; } ?></strong></td>
              </tr>
              <tr>
                <th><h5><strong>Receipt Type : </strong></h5></th>
                <td><strong><?php if(isset($receipt)){ echo payment_type($receipt['payment_type']); } ?></strong></td>
              </tr>               

              <?php if($receipt['payment_type'] == 'net_banking'){ ?>
                <tr>
                  <th><strong><h5>Bank Name : </strong></h5></th>
                  <td><strong><?php if(isset($receipt)){ echo $receipt['bank_name']; } ?></strong></td>
                </tr>
              <?php } ?>
              <?php if($receipt['payment_type'] == 'cheque'){ ?>
                <tr>
                  <th><strong><h5>Cheque No : </strong></h5></th>
                  <td><strong><?php if(isset($receipt)){ echo $receipt['cheque_no']; } ?></strong></td>
                </tr>
              <?php } ?>
              <?php if($receipt['payment_type'] == 'upi_id'){ ?>
                <tr>
                  <th><strong><h5>UPI ID : </strong></h5></th>
                  <td><strong><?php if(isset($receipt)){ echo $receipt['upi_id']; } ?></strong></td>
                </tr>
              <?php } ?>
              <tr>
                <th><strong><h5>Paid Amount : </strong></h5></th>
                <td>&#8377;&nbsp;&nbsp;&nbsp;<strong><?php if(isset($receipt)){ echo MoneyFormatIndia($receipt['paid_amount']); } ?></strong></td>
              </tr>
              <tr>
                <th><strong><h5>Remarks : </strong></h5></th>
                <td><strong><?php if(isset($receipt)){ echo $receipt['remarks']; } ?></strong></td>
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
  .receipt_repost_pop .row {
    padding-bottom: 10px;
    border-bottom: 1px solid #e9ecef;
    margin-top: 5px;
    padding-top: 10px;
  }
</style>