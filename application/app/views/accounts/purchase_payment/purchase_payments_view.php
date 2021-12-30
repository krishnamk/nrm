<div class="modal-header">
  <h5 class="modal-title"><strong>PAYMENT VIEW</strong></h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="modal-body payment_repost_pop">
  <div class="col-lg-12">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
              <tr>
                <th><h5><strong>Payment Number : </strong></h5></th>
                <td><strong><?php if(isset($payment)){ echo $payment['payment_number']; } ?></strong></td>
              </tr>
              <tr>
                <th><h5><strong>Payment Date : </strong></h5></th>
                <td><strong><?php if(isset($payment)){ echo date('d-m-Y',strtotime($payment['payment_date'])); } ?></strong></td>
              </tr>
              <tr>
                <th><strong><h5>Supplier : </strong></h5></th>
                <td><strong><?php if(isset($payment)){ echo $payment['supplier_name']; } ?></strong></td>
              </tr>
              <tr>
                <th><h5><strong>Payment Type : </strong></h5></th>
                <td><strong><?php if(isset($payment)){ echo payment_type($payment['payment_type']); } ?></strong></td>
              </tr>                

              <?php if($payment['payment_type'] == 'net_banking'){ ?>
                <tr>
                  <th><strong><h5>Bank Name : </strong></h5></th>
                  <td><strong><?php if(isset($payment)){ echo $payment['bank_name']; } ?></strong></td>
                </tr>
              <?php } ?>
              <?php if($payment['payment_type'] == 'cheque'){ ?>
                <tr>
                  <th><strong><h5>Cheque No : </strong></h5></th>
                  <td><strong><?php if(isset($payment)){ echo $payment['cheque_no']; } ?></strong></td>
                </tr>
              <?php } ?>
              <?php if($payment['payment_type'] == 'upi_id'){ ?>
                <tr>
                  <th><strong><h5>UPI ID : </strong></h5></th>
                  <td><strong><?php if(isset($payment)){ echo $payment['upi_id']; } ?></strong></td>
                </tr>
              <?php } ?>
              <tr>
                <th><strong><h5>Paid Amount : </strong></h5></th>
                <td>&#8377;&nbsp;&nbsp;&nbsp;<strong><?php if(isset($payment)){ echo MoneyFormatIndia($payment['paid_amount']); } ?></strong></td>
              </tr>
              <tr>
                <th><strong><h5>Remarks : </strong></h5></th>
                <td><strong><?php if(isset($payment)){ echo $payment['remarks']; } ?></strong></td>
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