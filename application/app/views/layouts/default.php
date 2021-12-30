<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title><?php echo $template['title']; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Multipurpose Billing Software" name="description" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/favicon.ico');?>">
    <!-- Bootstrap Css -->
    <link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?php echo base_url('assets/css/icons.min.css');?>" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?php echo base_url('assets/css/app.min.css');?>" id="app-style" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/libs/select2/css/select2.min.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css'); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('assets/libs/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css'); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('assets/libs/bootstrap-timepicker/css/bootstrap-timepicker.min.css'); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css'); ?>" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url('assets/libs/%40chenfengyuan/datepicker/datepicker.min.css'); ?>">
    <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- DataTables -->
    <link href="<?php echo base_url('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css');?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css');?>" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="<?php echo base_url('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css');?>" rel="stylesheet" type="text/css" />

    <script src="<?php echo base_url('assets/libs/jquery/jquery.min.js');?>"></script>
    <!-- select 2 plugin -->
    <script src="<?php echo base_url('assets/libs/select2/js/select2.min.js');?>"></script>
    <!-- Drach checkjs -->
</head>
<body data-sidebar="dark" class="sidebar-enable vertical-collpsed">
    <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner-chase">
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
            </div>
        </div>
    </div>
    <!-- Begin page -->
    <div id="layout-wrapper">
        <?php $this->load->view('includes/header'); ?>
        <!-- ========== Left Sidebar Start ========== -->
        <?php $this->load->view('includes/sidebar'); ?>
        <!-- Left Sidebar End -->
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <?php echo $template['body']; ?>
        <!-- ============================================================== -->
        <!-- end main content-->
        <?php $this->load->view('includes/footer'); ?>
    </div>
    <!-- END layout-wrapper -->
    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>
    <!-- Modal -->
    <div id="responsive-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
       <div class="modal-dialog modal-lg">
        <div class="modal-content" id="model-content">
        </div>
    </div>
</div>
<!-- JAVASCRIPT -->

<script src="<?php echo base_url('assets/libs/bootstrap/js/bootstrap.bundle.min.js');?>"></script>
<script src="<?php echo base_url('assets/libs/metismenu/metisMenu.min.js');?>"></script>
<script src="<?php echo base_url('assets/libs/simplebar/simplebar.min.js');?>"></script>
<script src="<?php echo base_url('assets/libs/node-waves/waves.min.js');?>"></script>

<script src="<?php echo base_url('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/libs/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/libs/bootstrap-timepicker/js/bootstrap-timepicker.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/libs/%40chenfengyuan/datepicker/datepicker.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/pages/form-advanced.init.js'); ?>"></script>
<!-- dropzone plugin -->
<script src="<?php echo base_url('assets/libs/dropzone/min/dropzone.min.js');?>"></script>
<!-- init js -->
<script src="<?php echo base_url('assets/js/pages/ecommerce-select2.init.js');?>"></script>
<script src="<?php echo base_url('assets/js/pages/dashboard.init.js');?>"></script>
<script src="<?php echo base_url('assets/libs/bs-custom-file-input/bs-custom-file-input.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/pages/form-element.init.js');?>"></script>
<!-- Required datatable js -->
<script src="<?php echo base_url('assets/libs/datatables.net/js/jquery.dataTables.min.js');?>"></script>
<script src="<?php echo base_url('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js');?>"></script>
<!-- Buttons examples -->
<script src="<?php echo base_url('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js');?>"></script>
<script src="<?php echo base_url('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js');?>"></script>
<script src="<?php echo base_url('assets/libs/jszip/jszip.min.js');?>"></script>
<!-- <script src="<?php echo base_url('assets/libs/pdfmake/build/pdfmake.min.js');?>"></script> -->
<script src="<?php echo base_url('assets/libs/pdfmake/build/vfs_fonts.js');?>"></script>
<script src="<?php echo base_url('assets/libs/datatables.net-buttons/js/buttons.html5.min.js');?>"></script>
<script src="<?php echo base_url('assets/libs/datatables.net-buttons/js/buttons.print.min.js');?>"></script>
<script src="<?php echo base_url('assets/libs/datatables.net-buttons/js/buttons.colVis.min.js');?>"></script>
<!-- Responsive examples -->
<script src="<?php echo base_url('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js');?>"></script>
<script src="<?php echo base_url('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js');?>"></script>
<!-- Datatable init js -->
<script src="<?php echo base_url('assets/js/pages/datatables.init.js');?>"></script>

<!-- App js -->
<script src="<?php echo base_url('assets/js/app.js');?>"></script>
<script type="text/javascript">
    $('body').on('click','.filter',function(e){
        e.preventDefault();
        var filter = $(this).attr('data-val');
        if(filter == "YEAR"){
            var date_from = "<?php echo date('Y-04-01'); ?>";
            var date_to = "<?php echo date('Y-03-31',strtotime('+1 year'));?>";
        }else if(filter == "MONTH"){
            var date_from = "<?php echo date('Y-m-01'); ?>";
            var date_to = "<?php echo date('Y-m-t');?>";
        }else{
            var date_from = "<?php echo date('Y-m-d'); ?>";
            var date_to = "<?php echo date('Y-m-d');?>";
        }
        $.ajax({
            url: '<?php echo base_url('user/get_datewise_details'); ?>',
            method:'post',
            data:{'date_from':date_from,'date_to':date_to}
        }).done(function(response){
            var res = $.parseJSON(response);
            $("#total_invoices").val(res.total_invoices);
            $("#total_dcs").val(res.total_dcs);
            $("#total_estimates").val(res.total_estimates);
            $("#total_purchase").val(res.total_purchase);
            $("#tbl_quotations").val(res.tbl_quotations);
            $("#total_products").val(res.total_products);
            $("#total_customers").val(res.total_customers);
            $("#total_suppliers").val(res.total_suppliers);
            $("#total_invoice_payments").val(res.total_invoice_payments);
            $("#total_pending_payments").val(res.total_pending_payments);
            $("#balance_amount").val(res.balance_amount);
            $("#total_purchase_payments").val(res.total_purchase_payments);
            $("#total_purchase_pending_payments").val(res.total_purchase_pending_payments);
            $("#purchase_balance_amount").val(res.purchase_balance_amount);
        });
        
    });
    $('body').on('click','.cancel',function(e){
       e.preventDefault();
       var link = $(this).attr('href');
       if(confirm('ARE YOU SURE ?')){
        window.location.replace(link);
    }else{
        return false;
    }
});
    $('body').on('click','.get_model_content',function(e){
        e.preventDefault();
        var url = $(this).attr('href');
        $.ajax({
            url : url,
            method : 'get'
        }).done(function(response){
            $('#model-content').empty();
            $('#model-content').append(response);
        });

    });
    $('body').on('click','.remove',function(e){
       e.preventDefault();
       var link = $(this).attr('href');
       if(confirm('ARE YOU SURE ?')){
        window.location.replace(link);
    }else{
        return false;
    }
});
    $('body').on('change','#stock_product_id',function(e){
        e.preventDefault();
        var product_id =  $(this).val();
        $.ajax({
            url: '<?php echo base_url('stock/get_product_details'); ?>',
            method:'post',
            data:{'product_id':product_id}
        }).done(function(response){
            var res = $.parseJSON(response);
            if(res.result=='success'){
                $('#current_qty').val(res.current_qty);
            }
        });
    });
    $('body').on('click','.model',function(e){
        e.preventDefault();
        var link =  $(this).attr('href');
        $.ajax({
            url: link,
            method:'post'
        }).done(function(response){
            var res = $.parseJSON(response);
            if(res.result== "success"){
                $('#model-content').empty();
                $('#model-content').append(res.content);
            }else{
                $('#responsive-modal').modal('hide');
            }
        });
    });
    //USER ACCESS
    $('body').on('change','#user_login',function(e){
        e.preventDefault();
        if ($(this).val() == 1) {
          $('.login_access').show();
      }else{
          $('.login_access').hide();
      }
  });
    //PRODUCT ORDER - GET PRODUCT DETAILS
    $('body').on('change','#purchase_order_product',function(e){
        e.preventDefault();
        var product_id = $("#purchase_order_product").val();
        $.ajax({
            url: '<?php echo base_url('purchase_order/get_product_details'); ?>',
            method:'post',
            data:{'product_id':product_id}
        }).done(function(response){
            var res = $.parseJSON(response);
            if(res.result=='success'){
             if(res.brand_name!=""){
                $('#purchase_order_brand').val(res.brand_name);
            }  
            if(res.brand_name!=""){
                $('#purchase_order_category').val(res.category_name);
            }               
            $('#purchase_order_quantity').val('');
            $('#purchase_order_amount').val('');
        }else{
            $('#purchase_order_quantity').val('');
        }
    });
    });
    //PRODUCT ORDER - ADD TEMPRORY TABLE
    $('body').on('click','.new_purchase_order_add',function(e){
        e.preventDefault();
        var product_id  = $("#purchase_order_product").val();
        var quantity    = $("#purchase_order_quantity").val();
        var rate        = $("#purchase_order_rate").val();
        var amount      = $("#purchase_order_amount").val();
        $.ajax({
            url: '<?php echo base_url('purchase_order/add_temprory_purchase_order'); ?>',
            method:'post',
            data:{'product_id':product_id,'quantity':quantity,'rate':rate,'amount':amount}
        }).done(function(response){
            var res = $.parseJSON(response);
            if(res.result=='success'){
                $('.listings').empty();
                $('.listings').append(res.listings);
                $("#purchase_order_product").val('');
                $("#purchase_order_brand").val('');
                $("#purchase_order_quantity").val('');
                $("#purchase_order_rate").val('');
                $("#purchase_order_amount").val('');
            }else{
                $('.listings').empty();
                $("#purchase_order_product").val('');
                $("#purchase_order_brand").val('');
                $("#purchase_order_quantity").val('');
                $("#purchase_order_rate").val('');
                $("#purchase_order_amount").val('');
            }
        });
    });
    $('body').on('click','.temp_purchase_order_remove',function(e){
        e.preventDefault();
        var purchase_order_temp_id =  $(this).attr('data-id');
        $.ajax({
            url: '<?php echo base_url('purchase_order/remove_temp_purchase_order'); ?>',
            method:'post',
            data:{'purchase_order_temp_id':purchase_order_temp_id}
        }).done(function(response){
            var res = $.parseJSON(response);
            $('.message').empty();
            $('.message').append(res.display_message);
            setInterval(function(){$('.message').empty()},5000);
            $('.listings').empty();
            $('.listings').append(res.listings);
        });
    });
    //PRODUCT ORDER RATE CALCULATIONS
    $('body').on('click change','#purchase_order_rate',function(e){
        e.preventDefault();
        var product_quantity = $("#purchase_order_quantity").val();
        var product_rate = $("#purchase_order_rate").val();
        $.ajax({
            url: '<?php echo base_url('purchase_order/purchase_order_calculation'); ?>',
            method:'post',
            data:{'product_quantity':product_quantity,'product_rate':product_rate}
        }).done(function(response){
            var res = $.parseJSON(response);
            if(res.result=='success'){
                $('#purchase_order_amount').val(res.amount);
            }else{
                $('#purchase_order_amount').val('');
            }
        });
    });
    //PRODUCT - GET PRODUCT DETAILS
    $('body').on('change','#purchase_product',function(e){
        e.preventDefault();
        var product_id = $("#purchase_product").val();
        $.ajax({
            url: '<?php echo base_url('purchase/get_product_details'); ?>',
            method:'post',
            data:{'product_id':product_id}
        }).done(function(response){
            var res = $.parseJSON(response);
            if(res.result=='success'){
                // if(res.brand_name!=""){
                //     $('#purchase_brand').val(res.brand_name);
                // }
                if(res.category_name!=""){
                    $('#purchase_category').val(res.category_name);
                }
                $('#purchase_rate').val(res.product_price);
            }else{
                $('#purchase_product').val('');
                $('#purchase_quantity').val('');
            }
        });
    });
    $('body').on('keyup keydown change','#purchase_quantity',function(e){
        var purchase_rate       = $('#purchase_rate').val();
        var purchase_quantity   = $('#purchase_quantity').val();
        if(purchase_rate == ""){
            purchase_rate = 0;
        }
        $.ajax({
            url: '<?php echo base_url('purchase/purchase_calculation'); ?>',
            method:'post',
            data:{'purchase_rate':purchase_rate,'purchase_quantity':purchase_quantity}
        }).done(function(response){
            var res = $.parseJSON(response);
            if(res.result=='success'){
                $('#purchase_total').val(res.total);
            }else{
                $('#purchase_total').val(0);
            }
        });
    });
    $('body').on('click','#purchase_total',function(e){
        var purchase_rate       = $('#purchase_rate').val();
        var purchase_quantity   = $('#purchase_quantity').val();
        if(purchase_rate == ""){
            purchase_rate = 0;
        }
        $.ajax({
            url: '<?php echo base_url('purchase/purchase_calculation'); ?>',
            method:'post',
            data:{'purchase_rate':purchase_rate,'purchase_quantity':purchase_quantity}
        }).done(function(response){
            var res = $.parseJSON(response);
            if(res.result=='success'){
                $('#purchase_total').val(res.total);
            }else{
                $('#purchase_total').val(0);
            }
        });
    });
    //PURCHASE WITHOUT DC AND WITHOUT TAX
    $('body').on('click','.new_purchase_add',function(e){
        e.preventDefault();
        $('.error').hide();
        var product_id = $("#purchase_product").val();
        var purchase_rate = $("#purchase_rate").val();
        var purchase_quantity   = $('#purchase_quantity').val();
        var purchase_total = $("#purchase_total").val();
        var purchase_brand = $("#purchase_brand").val();
        var purchase_category = $("#purchase_category").val();
        $.ajax({
            url: '<?php echo base_url('purchase/add_temprory_purchase'); ?>',
            method:'post',
            data:{'product_id':product_id,'purchase_rate':purchase_rate,'purchase_quantity':purchase_quantity,'purchase_total':purchase_total,'purchase_brand':purchase_brand,'purchase_category':purchase_category}
        }).done(function(response){
            var res = $.parseJSON(response);
            if(res.result=='success'){
                $('.listings').empty();
                $('.listings').append(res.listings);
                $("#purchase_product").val('');
                //$("#purchase_brand").val('');
                $("#purchase_category").val('');
                $("#purchase_quantity").val('');
                $("#purchase_rate").val('');
                $("#purchase_total").val('');
                $("#purchase_with_tax_id").val('');
                $("#tax_total").val('');
            }else{
                $('.listings').empty();
                $("#purchase_product").val('');
                //$("#purchase_brand").val('');
                $("#purchase_category").val('');
                $("#purchase_quantity").val('');
                $("#purchase_rate").val('');
                $("#purchase_total").val('');
                $("#purchase_with_tax_id").val('');
                $("#tax_total").val('');
            }
        });
    });
    //PURCHASE WITH TAX
    $('body').on('click','.new_purchase_add_withtax',function(e){
        e.preventDefault();
        $('.error').hide();
        var product_id = $("#purchase_product").val();
        var purchase_rate = $("#purchase_rate").val();
        var purchase_quantity   = $('#purchase_quantity').val();
        var tax_id = $('#purchase_with_tax_id').val();
        var tax_total = $('#tax_total').val()
        var purchase_total = $("#purchase_total").val();
        var purchase_brand = $("#purchase_brand").val();
        var purchase_category = $("#purchase_category").val();
        $.ajax({
            url: '<?php echo base_url('purchase/add_temprory_purchase'); ?>',
            method:'post',
            data:{'product_id':product_id,'purchase_rate':purchase_rate,'purchase_quantity':purchase_quantity,'tax_id':tax_id,'tax_total':tax_total,'purchase_total':purchase_total,'purchase_brand':purchase_brand,'purchase_category':purchase_category}
        }).done(function(response){
            var res = $.parseJSON(response);
            if(res.result=='success'){
                $('.listings').empty();
                $('.listings').append(res.listings);
                $("#purchase_product").val('');
                //$("#purchase_brand").val('');
                $("#purchase_category").val('');
                $("#purchase_quantity").val('');
                $("#purchase_rate").val('');
                $("#purchase_total").val('');
            }else{
                $('.listings').empty();
                $("#purchase_product").val('');
                //$("#purchase_brand").val('');
                $("#purchase_category").val('');
                $("#purchase_quantity").val('');
                $("#purchase_rate").val('');
                $("#purchase_total").val('');
            }
        });
    });
    $('body').on('click','.temp_purchase_remove',function(e){
        e.preventDefault();
        var current = $(this);
        var purchase_dc_relation_id =  $(this).attr('data-id');
        var removed_rows = $("#removed_rows").val();
        var removed_rows = removed_rows +','+ purchase_dc_relation_id;
        //alert (removed_rows);exit;
        $("#removed_rows").val(removed_rows);
        current.parent().parent().remove();
    });
    //temprory purchase delete
    $('body').on('click','.temp_purchase_delete',function(e){
        e.preventDefault();
        var current = $(this);
        var purchase_relation_temp_id =  $(this).attr('data-id');
        $.ajax({
            url: '<?php echo base_url('purchase/temp_purchase_delete'); ?>',
            method:'post',
            data:{ 'purchase_relation_temp_id':purchase_relation_temp_id}
        }).done(function(response){
            var res = $.parseJSON(response);
            if(res.result=='success'){
                current.parent().parent().remove();
            }
        });
    });
    //PURCHASE WITH TAX
    $('body').on('click','#purchase_with_tax_id',function(e){ 
        e.preventDefault();
        var tax_id = $(this).val();
        var tax_type = 2;
        var quantity = $('#purchase_quantity').val();
        var rate = $('#purchase_rate').val();
        var amount = $('#purchase_total').val();
        $.ajax({ 
            url : '<?php echo base_url('purchase/purchase_product_total_calculations'); ?>',
            method : 'post',
            data:{'tax_id':tax_id,'tax_type':tax_type,'quantity': quantity,'rate': rate,'amount': amount}
        }).done(function(response){
            var res = $.parseJSON(response);
            if(res.result=='success'){
                $('#tax_percentage').val(res.tax_percentage); 
                $('#tax_total').val(res.total_tax); 
                $('#purchase_total').val(res.product_total);
            }else{
                $('#tax_percentage').val(''); 
                $('#tax_total').val('');
                $('#purchase_total').val(''); 
            }
        });
    });
    //PURCHASE RETURN
    $('body').on('change','#purchase_return_supplier',function(e){
        var supplier_id =  $(this).val();
        $.ajax({
            url: '<?php echo base_url('purchase_return/get_purchase_bills'); ?>',
            method:'post',
            data:{ 'supplier_id':supplier_id}
        }).done(function(response){
            //alert(response);
            var res = $.parseJSON(response);
            $('#purchase_return_purchase_id').empty();
            $('#purchase_return_purchase_id').append(res.purchase_bills);
        });
    });
    $('body').on('change','#purchase_return_purchase_id',function(e){
        var supplier_id =  $('#purchase_return_supplier').val();
        var purchase_id =  $(this).val();
        $.ajax({
            url: '<?php echo base_url('purchase_return/get_purchase_products'); ?>',
            method:'post',
            data:{ 'supplier_id':supplier_id,'purchase_id':purchase_id}
        }).done(function(response){
            $(".purchase_return_product").show();
            $('.purchase_return_product_list').empty();
            $('.purchase_return_product_list').append(response);
        });
    });
    $('body').on('keyup keydown change','.quantity',function(e){
        var key = $(this).attr('data-id');
        var current_qty = $('.current_quantity'+key).val();
        var new_qty = $('.quantity'+key).val();
        if(parseInt(new_qty) <= parseInt(current_qty)){
            $('.purchase_return_create').show();
            $('.quantity'+key).css("border-color", "green");
        }else{
            $('.purchase_return_create').hide();
            $('.quantity'+key).css("border-color", "red");
        }
        $('.checkbox'+key).prop('checked', true);
    });
    //PURCHASE DC - GET PRODUCT DETAILS
    $('body').on('change','#purchase_dc_product',function(e){
        e.preventDefault();
        var product_id = $("#purchase_dc_product").val();
        $.ajax({
            url: '<?php echo base_url('purchase_dc/get_product_details'); ?>',
            method:'post',
            data:{'product_id':product_id}
        }).done(function(response){
            var res = $.parseJSON(response);
            if(res.result=='success'){
                if(res.brand_name!=""){
                    $('#purchase_dc_brand').val(res.brand_name);
                }                
                $('#purchase_dc_desc').val(res.product_description);
            }else{
                $('#purchase_product').val('');
                $('#purchase_dc_brand').val('');
                $('#purchase_dc_desc').val('');
            }
        });
    });
    $('body').on('click','.new_purchase_dc_add',function(e){
        e.preventDefault();
        var product_id              = $("#purchase_dc_product").val();
        var purchase_dc_quantity    = $('#purchase_dc_quantity').val();
        $.ajax({
            url: '<?php echo base_url('purchase_dc/add_temprory_purchase_dc'); ?>',
            method:'post',
            data:{'product_id':product_id,'purchase_dc_quantity':purchase_dc_quantity}
        }).done(function(response){
            var res = $.parseJSON(response);
            if(res.result=='success'){
                $('.listings').empty();
                $('.listings').append(res.listings);
                $("#purchase_dc_product").val('');
                $("#purchase_dc_brand").val('');
                $("#purchase_dc_quantity").val('');
                $("#purchase_dc_desc").val('');
                $("#purchase_dc_product").val('');
            }else{
                $('.listings').empty();
                $("#purchase_dc_desc").val('');
                $("#purchase_dc_product").val('');
                $("#purchase_dc_brand").val('');
                $("#purchase_dc_quantity").val('');
                $("#purchase_dc_product").val('');
            }
        });
    });
    $('body').on('click','.temp_purchase_dc_remove',function(e){
        e.preventDefault();
        var purchase_dc_temp_id =  $(this).attr('data-id');
        $.ajax({
            url: '<?php echo base_url('purchase_dc/remove_temp_purchase_dc'); ?>',
            method:'post',
            data:{'purchase_dc_temp_id':purchase_dc_temp_id}
        }).done(function(response){
            var res = $.parseJSON(response);
            $('.message').empty();
            $('.message').append(res.display_message);
            setInterval(function(){$('.message').empty()},5000);
            $('.listings').empty();
            $('.listings').append(res.listings);
            $("#purchase_dc_product").val('');
            $("#purchase_dc_brand").val('');
        });
    });
    //PURCHASE DC - GET DC NO
    $('body').on('change','#purchase_supplier',function(e){
        e.preventDefault();
        var supplier_id = $("#purchase_supplier").val();
        $.ajax({
            url: '<?php echo base_url('purchase/get_supplier_based_dc'); ?>',
            method:'post',
            data:{'supplier_id':supplier_id}
        }).done(function(response){
            var res = $.parseJSON(response);
            if(res.result=='success'){
                $('#purchase_dc_no').empty();
                $('#purchase_dc_no').append(res.purchase_dcs);
            }else{
                $('#purchase_dc_no').empty();
            }
        });
    });
    $('body').on('change','#purchase_dc_no',function(e){
        var purchase_dc_no = $(this).val();
        $.ajax({
            url: '<?php echo base_url('purchase/get_purchase_dc_details'); ?>',
            method:'post',
            data:{'purchase_dc_no':purchase_dc_no}
        }).done(function(response){
            var res = $.parseJSON(response);
            if(res.result=='success'){
                $('.listings').empty();
                $('.listings').append(res.listings);
                //$('#add_purchase_dc_new').empty();
                $('#add_purchase_dc_new').attr('data-id',res.count);
            }else{
                $('.listings').empty();
            }
        });
    });
    $('body').on('click','.add_purchase_dc_new',function(e){
        var key = $(this).attr('data-id');
        $.ajax({ 
            url : '<?php echo base_url('purchase/add_purchase_dc_new_row'); ?>',
            method : 'post',
            data:{'key':key}
        }).done(function(response){
            var res = $.parseJSON(response);
            if(res.result=='success'){
                $('.listings').append(res.listings);
                //$('.add_purchase_dc_new').empty();
                $('.add_purchase_dc_new').attr('data-id',res.count);
            }else{
                $('.listings').empty();
            }
        });
    });
    $('body').on('click','.remove_current_dc_row',function(e){
       e.preventDefault();
       var current = $(this);
       current.parent().parent().remove();
   });
    $('body').on('change','.add_purchase_product',function(e){
        var product_id = $(this).val();
        var key = $(this).attr('data-id');
        $.ajax({ 
            url : '<?php echo base_url('purchase/get_product_details'); ?>',
            method : 'post',
            data:{'product_id':product_id}
        }).done(function(response){
            var res = $.parseJSON(response);
            if(res.result=='success'){
                $('.add_product_brand'+key).val(res.brand_name); 
            }else{
                $('.add_product_brand'+key).empty();
            }
        });
    });
    $('body').on('click','.add_product_amount',function(e){
        var key = $(this).attr('data-id');
        var quantity = $('.add_product_quantity'+key).val();
        var rate = $('.add_product_rate'+key).val();
        $.ajax({ 
            url : '<?php echo base_url('purchase/purchase_product_calculations'); ?>',
            method : 'post',
            data:{'quantity':quantity,'rate':rate}
        }).done(function(response){
            var res = $.parseJSON(response);
            if(res.result=='success'){
                $('.add_product_amount'+key).val(res.amount); 
            }else{
                $('.add_product_amount'+key).empty();
            }
        });
    });
    $('body').on('change','.add_purchase_tax',function(e){
        var key = $(this).attr('data-id');
        var tax_id = $(this).val();
        var tax_type = $('#tax_type').val();
        var quantity = $('.add_product_quantity'+key).val();
        var rate = $('.add_product_rate'+key).val();
        var amount = $('.add_product_amount'+key).val();
        $.ajax({ 
            url : '<?php echo base_url('purchase/purchase_product_total_calculations'); ?>',
            method : 'post',
            data:{'tax_id':tax_id,'tax_type':tax_type,'quantity': quantity,'rate': rate,'amount': amount}
        }).done(function(response){
            var res = $.parseJSON(response);
            if(res.result=='success'){
                $('.tax_percentage'+key).val(res.tax_percentage); 
                $('.add_product_tax_value'+key).val(res.total_tax); 
                $('.add_product_total'+key).val(res.product_total); 
            }else{
                $('.tax_percentage'+key).empty(); 
                $('.add_product_tax_value'+key).empty();
                $('.add_product_total'+key).empty(); 
            }
        });
    });
    $('body').on('keyup keydown change','.add_product_rate',function(e){
        var key = $(this).attr('data-id');
        var tax_id = $('.add_purchase_tax'+key).val();
        var tax_type = $('#tax_type').val();
        var quantity = $('.add_product_quantity'+key).val();
        var rate = $('.add_product_rate'+key).val();
        $.ajax({ 
            url : '<?php echo base_url('purchase/purchase_product_total_calculations'); ?>',
            method : 'post',
            data:{'quantity':quantity,'rate':rate,'tax_id':tax_id,'tax_type':tax_type}
        }).done(function(response){
            var res = $.parseJSON(response);
            if(res.result=='success'){
                $('.add_product_amount'+key).val(res.amount);
                $('.tax_percentage'+key).val(res.tax_percentage); 
                $('.add_product_tax_value'+key).val(res.total_tax); 
                $('.add_product_total'+key).val(res.product_total); 
            }else{
                $('.add_product_amount'+key).empty();
                $('.tax_percentage'+key).val(res.tax_percentage); 
                $('.add_product_tax_value'+key).val(res.total_tax); 
                $('.add_product_total'+key).val(res.product_total);
            }
        });
    });
    //ADD CUSTOMER POPUP
    $('body').on('click','.add_customer',function(e){ 
        $.ajax({
            url: '<?php echo base_url('masters/customer_popup'); ?>',
            method:'get'
        }).done(function(response){
            $('#model-content').empty();
            $('#model-content').append(response); 
        });
    });
    $('body').on('click','.new-customer',function(e){ 
        $.ajax({
            url: '<?php echo base_url('masters/customer_popup'); ?>',
            method:'post',
            data : $('#new-customer').serialize()
        }).done(function(response){
            var res = $.parseJSON(response); 
            $('#responsive-modal').modal('hide');
            location.reload();
        });
    });
    //ADD SUPPLIER POPUP
    $('body').on('click','.add_supplier',function(e){ 
        $.ajax({
            url: '<?php echo base_url('masters/supplier_popup'); ?>',
            method:'get'
        }).done(function(response){
            $('#model-content').empty();
            $('#model-content').append(response); 
        });
    });
    $('body').on('click','.new-supplier',function(e){ 
        $.ajax({
            url: '<?php echo base_url('masters/supplier_popup'); ?>',
            method:'post',
            data : $('#new-supplier').serialize()
        }).done(function(response){
            var res = $.parseJSON(response); 
            $('#responsive-modal').modal('hide');
            location.reload();
        });
    });
    //ADD PRODUCT POPUP
    $('body').on('click','.add_product',function(e){ 
        $.ajax({
            url: '<?php echo base_url('products/product_popup'); ?>',
            method:'get'
        }).done(function(response){
            $('#model-content').empty();
            $('#model-content').append(response); 
        });
    });
    $('body').on('click','.new-product',function(e){ 
        $.ajax({
            url: '<?php echo base_url('products/product_popup'); ?>',
            method:'post',
            data : $('#new-product').serialize(),
        }).done(function(response){
           var res = $.parseJSON(response); 
           console.log (res);
           $(".modal-body").html("<p>The Product added successfully!</p>");
           $('.new-product').attr("disabled", "disabled"); 
           if(res.result=='success'){
            $('#purchase_dc_product').empty();
            $('#purchase_dc_product').append(res.product.product_detail);
            $('#purchase_dc_desc').val(res.product.product_description);
            $('#purchase_dc_brand').val(res.product.brand_name);
        }else{
            $('#purchase_dc_product').val('');
            $('#purchase_dc_desc').val('');
                //$('#purchase_dc_brand').val('');
            }
        });
    });
    //PURCHASE - PAYMENTS
    $('body').on('click','.add_purchase_payment_show',function(e){
        e.preventDefault();
        current = $(this);
        $('.add_purchase_payment_view').show();
        current.empty().append('HIDE PAYMENT');
        current.removeClass('add_purchase_payment_show').addClass('add_purchase_payment_hide');
        current.removeClass('btn-success').addClass('btn-danger');
    });
    $('body').on('change','#payment_type',function(e){
        if($(this).val() !=''){
            $('.payment_details').hide()
            $('.'+$(this).val()).show()
        }else{
            $('.payment_details').hide();
        }
    });
    //QUOTATION - GET PRODUCT DETAILS
    $('body').on('change','#quotation_product',function(e){
        e.preventDefault();
        var product_id = $("#quotation_product").val();
        $.ajax({
            url: '<?php echo base_url('quotation/get_product_details'); ?>',
            method:'post',
            data:{'product_id':product_id}
        }).done(function(response){
            var res = $.parseJSON(response);
            if(res.result=='success'){
                if(res.brand_name!=""){
                    $('#quotation_brand').val(res.brand_name);
                }
                $('#quotation_rate').val(res.product_price);
            }else{
                $('#quotation_product').val('');
                $('#quotation_quantity').val('');
            }
        });
    });
    //QUOTATION RATE CALCULATIONS
    $('body').on('click','#quotation_amount',function(e){
        e.preventDefault();
        var product_quantity = $("#quotation_quantity").val();
        var product_rate = $("#quotation_rate").val();
        $.ajax({
            url: '<?php echo base_url('quotation/quotation_calculation'); ?>',
            method:'post',
            data:{'product_quantity':product_quantity,'product_rate':product_rate}
        }).done(function(response){
            var res = $.parseJSON(response);
            if(res.result=='success'){
                $('#quotation_amount').val(res.amount);
            }else{
                $('#quotation_amount').val('');
            }
        });
    });
    $('body').on('change','#quotation_quantity',function(e){
        e.preventDefault();
        var product_quantity = $("#quotation_quantity").val();
        var product_rate = $("#quotation_rate").val();
        $.ajax({
            url: '<?php echo base_url('quotation/quotation_calculation'); ?>',
            method:'post',
            data:{'product_quantity':product_quantity,'product_rate':product_rate}
        }).done(function(response){
            var res = $.parseJSON(response);
            if(res.result=='success'){
                $('#quotation_amount').val(res.amount);
            }else{
                $('#quotation_amount').val('');
            }
        });
    });
    $('body').on('change','#quotation_rate',function(e){
        e.preventDefault();
        var product_quantity = $("#quotation_quantity").val();
        var product_rate = $("#quotation_rate").val();
        $.ajax({
            url: '<?php echo base_url('quotation/quotation_calculation'); ?>',
            method:'post',
            data:{'product_quantity':product_quantity,'product_rate':product_rate}
        }).done(function(response){
            var res = $.parseJSON(response);
            if(res.result=='success'){
                $('#quotation_amount').val(res.amount);
            }else{
                $('#quotation_amount').val('');
            }
        });
    });
     //QUOTATION - ADD TEMPRORY TABLE
     $('body').on('click','.new_quotation_add',function(e){
        e.preventDefault();
        var product_id  = $("#quotation_product").val();
        var quantity    = $("#quotation_quantity").val();
        var rate        = $("#quotation_rate").val();
        var amount      = $("#quotation_amount").val();
        $.ajax({
            url: '<?php echo base_url('quotation/add_temprory_quotation'); ?>',
            method:'post',
            data:{'product_id':product_id,'quantity':quantity,'rate':rate,'amount':amount}
        }).done(function(response){
            var res = $.parseJSON(response);
            if(res.result=='success'){
                $('.listings').empty();
                $('.listings').append(res.listings);
                $("#quotation_product").val('');
                $("#quotation_brand").val('');
                $("#quotation_quantity").val('');
                $("#quotation_rate").val('');
                $("#quotation_amount").val('');
            }else{
                $('.listings').empty();
                $("#quotation_product").val('');
                $("#quotation_brand").val('');
                $("#quotation_quantity").val('');
                $("#quotation_rate").val('');
                $("#quotation_amount").val('');
            }
        });
    });
     $('body').on('click','.temp_quotation_remove',function(e){
        e.preventDefault();
        var quotation_temp_id =  $(this).attr('data-id');
        $.ajax({
            url: '<?php echo base_url('quotation/remove_temp_quotation'); ?>',
            method:'post',
            data:{'quotation_temp_id':quotation_temp_id}
        }).done(function(response){
            var res = $.parseJSON(response);
            $('.message').empty();
            $('.message').append(res.display_message);
            setInterval(function(){$('.message').empty()},5000);
            $('.listings').empty();
            $('.listings').append(res.listings);
        });
    });
     $('body').on('keyup','#quotation_quantity',function(e){
        var product_qty =  $(this).val();
        var product_id =  $('#quotation_product').val();
        $.ajax({
            url: '<?php echo base_url('quotation/check_product_qty'); ?>',
            method:'post',
            data:{'product_id':product_id,'product_qty':product_qty}
        }).done(function(response){
            var res = $.parseJSON(response);
            if(res.result=='success'){
                $("#quotation_quantity").css("border-color", "green");
                $("#quotation_quantity").css("border-width", "2px");
                $('.message').empty();
                $('.message').append(res.display_message);
                setInterval(function(){$('.message').empty()},10000);
                $('.new_quotation_add').show();
            }else{
                $("#quotation_quantity").css("border-color", "red");
                $("#quotation_quantity").css("border-width", "2px");
                $('.message').empty();
                $('.message').append(res.display_message);
                setInterval(function(){$('.message').empty()},10000);
                if(res.overquantity == 1){
                    $('.new_quotation_add').show();
                }else{
                    $('.new_quotation_add').hide();
                }
            }
        });
    });
    //QUOTATION - PAYMENTS
    $('body').on('click','.add_quotation_payment_show',function(e){
        e.preventDefault();
        current = $(this);
        $('.add_quotation_payment_view').show();
        current.empty().append('HIDE PAYMENT');
        current.removeClass('add_quotation_payment_show').addClass('add_quotation_payment_hide');
        current.removeClass('btn-success').addClass('btn-danger');
    });
    //DC - GET PRODUCT DETAILS
    $('body').on('change','#dc_product',function(e){
        e.preventDefault();
        var product_id = $("#dc_product").val();
        $.ajax({
            url: '<?php echo base_url('dc/get_product_details'); ?>',
            method:'post',
            data:{'product_id':product_id}
        }).done(function(response){
            var res = $.parseJSON(response);
            if(res.result=='success'){
                if(res.brand_name!=""){
                    $('#dc_brand').val(res.brand_name);
                }                
                $('#dc_desc').val(res.product_description);
            }else{
                $('#dc_product').val('');
                $('#dc_brand').val('');
                $('#dc_desc').val('');
            }
        });
    });
    $('body').on('click','.new_dc_add',function(e){
        e.preventDefault();
        var product_id  = $("#dc_product").val();
        var quantity    = $("#dc_quantity").val();
        $.ajax({
            url: '<?php echo base_url('dc/add_temprory_dc'); ?>',
            method:'post',
            data:{'product_id':product_id,'quantity':quantity}
        }).done(function(response){
            var res = $.parseJSON(response);
            if(res.result=='success'){
                $('.listings').empty();
                $('.listings').append(res.listings);
                $("#dc_product").val('');
                $("#dc_brand").val('');
                $("#dc_quantity").val('');
                $("#dc_desc").val('');
                $("#dc_product").val('');
            }else{
                $('.listings').empty();
                $("#dc_desc").val('');
                $("#dc_product").val('');
                $("#dc_brand").val('');
                $("#dc_quantity").val('');
                $("#dc_product").val('');
            }
        });
    });
    $('body').on('click','.temp_dc_remove',function(e){
        e.preventDefault();
        var dc_temp_id =  $(this).attr('data-id');
        $.ajax({
            url: '<?php echo base_url('dc/remove_temp_dc'); ?>',
            method:'post',
            data:{'dc_temp_id':dc_temp_id}
        }).done(function(response){
            var res = $.parseJSON(response);
            $('.message').empty();
            $('.message').append(res.display_message);
            setInterval(function(){$('.message').empty()},5000);
            $('.listings').empty();
            $('.listings').append(res.listings);
            $("#dc_product").val('');
            $("#dc_brand").val('');
        });
    });
    $('body').on('keyup','#dc_quantity',function(e){
        var product_qty =  $(this).val();
        var product_id =  $('#dc_product').val();
        $.ajax({
            url: '<?php echo base_url('dc/check_product_qty'); ?>',
            method:'post',
            data:{'product_id':product_id,'product_qty':product_qty}
        }).done(function(response){
            var res = $.parseJSON(response);
            if(res.result=='success'){
                $("#dc_quantity").css("border-color", "green");
                $("#dc_quantity").css("border-width", "2px");
                $('.message').empty();
                $('.message').append(res.display_message);
                setInterval(function(){$('.message').empty()},10000);
                $('.new_dc_add').show();
            }else{
                $("#dc_quantity").css("border-color", "red");
                $("#dc_quantity").css("border-width", "2px");
                $('.message').empty();
                $('.message').append(res.display_message);
                setInterval(function(){$('.message').empty()},10000);
                if(res.overquantity == 1){
                    $('.new_dc_add').show();
                }else{
                    $('.new_dc_add').hide();
                }
            }
        });
    });
   //  //ESTIMATE - GET PRODUCT DETAILS
   //  $('body').on('change','#estimate_product',function(e){
   //      e.preventDefault();
   //      var product_id = $("#estimate_product").val();
   //      $.ajax({
   //          url: '<?php echo base_url('estimate/get_product_details'); ?>',
   //          method:'post',
   //          data:{'product_id':product_id}
   //      }).done(function(response){
   //          var res = $.parseJSON(response);
   //          if(res.result=='success'){
   //              if(res.brand_name!=""){
   //                  $('#estimate_brand').val(res.brand_name);
   //              }
   //              $('#estimate_rate').val(res.product_price);
   //          }else{
   //              $('#estimate_product').val('');
   //              $('#estimate_quantity').val('');
   //          }
   //      });
   //  });
   //  //ESTIMATE RATE CALCULATIONS
   //  $('body').on('click','#estimate_amount',function(e){
   //      e.preventDefault();
   //      var product_quantity = $("#estimate_quantity").val();
   //      var product_rate = $("#estimate_rate").val();
   //      $.ajax({
   //          url: '<?php echo base_url('estimate/estimate_calculation'); ?>',
   //          method:'post',
   //          data:{'product_quantity':product_quantity,'product_rate':product_rate}
   //      }).done(function(response){
   //          var res = $.parseJSON(response);
   //          if(res.result=='success'){
   //              $('#estimate_amount').val(res.amount);
   //          }else{
   //              $('#estimate_amount').val('');
   //          }
   //      });
   //  });
   //  $('body').on('change','#estimate_quantity',function(e){
   //      e.preventDefault();
   //      var product_quantity = $("#estimate_quantity").val();
   //      var product_rate = $("#estimate_rate").val();
   //      $.ajax({
   //          url: '<?php echo base_url('estimate/estimate_calculation'); ?>',
   //          method:'post',
   //          data:{'product_quantity':product_quantity,'product_rate':product_rate}
   //      }).done(function(response){
   //          var res = $.parseJSON(response);
   //          if(res.result=='success'){
   //              $('#estimate_amount').val(res.amount);
   //          }else{
   //              $('#estimate_amount').val('');
   //          }
   //      });
   //  });
   //  $('body').on('change','#estimate_rate',function(e){
   //      e.preventDefault();
   //      var product_quantity = $("#estimate_quantity").val();
   //      var product_rate = $("#estimate_rate").val();
   //      $.ajax({
   //          url: '<?php echo base_url('estimate/estimate_calculation'); ?>',
   //          method:'post',
   //          data:{'product_quantity':product_quantity,'product_rate':product_rate}
   //      }).done(function(response){
   //          var res = $.parseJSON(response);
   //          if(res.result=='success'){
   //              $('#estimate_amount').val(res.amount);
   //          }else{
   //              $('#estimate_amount').val('');
   //          }
   //      });
   //  });
   //   //ESTIMATE - ADD TEMPRORY TABLE
   //   $('body').on('click','.new_estimate_add',function(e){
   //      e.preventDefault();
   //      var product_id  = $("#estimate_product").val();
   //      var quantity    = $("#estimate_quantity").val();
   //      var rate        = $("#estimate_rate").val();
   //      var amount      = $("#estimate_amount").val();
   //      $.ajax({
   //          url: '<?php echo base_url('estimate/add_temprory_estimate'); ?>',
   //          method:'post',
   //          data:{'product_id':product_id,'quantity':quantity,'rate':rate,'amount':amount}
   //      }).done(function(response){
   //          var res = $.parseJSON(response);
   //          if(res.result=='success'){
   //              $('.listings').empty();
   //              $('.listings').append(res.listings);
   //              $("#estimate_product").val('');
   //              $("#estimate_brand").val('');
   //              $("#estimate_quantity").val('');
   //              $("#estimate_rate").val('');
   //              $("#estimate_amount").val('');
   //          }else{
   //              $('.listings').empty();
   //              $("#estimate_product").val('');
   //              $("#estimate_brand").val('');
   //              $("#estimate_quantity").val('');
   //              $("#estimate_rate").val('');
   //              $("#estimate_amount").val('');
   //          }
   //      });
   //  });
   //   $('body').on('click','.temp_estimate_remove',function(e){
   //      e.preventDefault();
   //      var estimate_temp_id =  $(this).attr('data-id');
   //      $.ajax({
   //          url: '<?php echo base_url('estimate/remove_temp_estimate'); ?>',
   //          method:'post',
   //          data:{'estimate_temp_id':estimate_temp_id}
   //      }).done(function(response){
   //          var res = $.parseJSON(response);
   //          $('.message').empty();
   //          $('.message').append(res.display_message);
   //          setInterval(function(){$('.message').empty()},5000);
   //          $('.listings').empty();
   //          $('.listings').append(res.listings);
   //      });
   //  });
   //   $('body').on('keyup','#estimate_quantity',function(e){
   //      var product_qty =  $(this).val();
   //      var product_id =  $('#estimate_product').val();
   //      $.ajax({
   //          url: '<?php echo base_url('estimate/check_product_qty'); ?>',
   //          method:'post',
   //          data:{'product_id':product_id,'product_qty':product_qty}
   //      }).done(function(response){
   //          var res = $.parseJSON(response);
   //          if(res.result=='success'){
   //              $("#estimate_quantity").css("border-color", "green");
   //              $("#estimate_quantity").css("border-width", "2px");
   //              $('.message').empty();
   //              $('.message').append(res.display_message);
   //              setInterval(function(){$('.message').empty()},10000);
   //              $('.new_estimate_add').show();
   //          }else{
   //              $("#estimate_quantity").css("border-color", "red");
   //              $("#estimate_quantity").css("border-width", "2px");
   //              $('.message').empty();
   //              $('.message').append(res.display_message);
   //              setInterval(function(){$('.message').empty()},10000);
   //              if(res.overquantity == 1){
   //                  $('.new_estimate_add').show();
   //              }else{
   //                  $('.new_estimate_add').hide();
   //              }
   //          }
   //      });
   //  });
   //  //ESTIMATE - PAYMENTS
   //  $('body').on('click','.add_estimate_payment_show',function(e){
   //      e.preventDefault();
   //      current = $(this);
   //      $('.add_estimate_payment_view').show();
   //      current.empty().append('HIDE PAYMENT');
   //      current.removeClass('add_estimate_payment_show').addClass('add_estimate_payment_hide');
   //      current.removeClass('btn-success').addClass('btn-danger');
   //  });
   //  //DC GENERATE - ESTIMATE (MULTIPLE DC)
   //  $('body').on('click change','#dc_customer',function(e){
   //      e.preventDefault();
   //      var customer_id = $("#dc_customer").val();
   //      $.ajax({
   //          url: '<?php echo base_url('dc/get_customer_based_dc'); ?>',
   //          method:'post',
   //          data:{'customer_id':customer_id}
   //      }).done(function(response){
   //          var res = $.parseJSON(response);
   //          if(res.result=='success'){
   //              $('#estimate_no').empty();
   //              $('#estimate_no').append(res.estimate_no);
   //          }else{
   //              $('#estimate_no').empty();
   //          }
   //      });
   //  });
   //  $('body').on('change','#estimate_no',function(e){
   //      var estimate_no = $(this).val();
   //      $.ajax({
   //          url: '<?php echo base_url('dc/get_estimate_details'); ?>',
   //          method:'post',
   //          data:{'estimate_no':estimate_no}
   //      }).done(function(response){
   //          var res = $.parseJSON(response);
   //          if(res.result=='success'){
   //              $('.listings').empty();
   //              $('.listings').append(res.listings);
   //          }else{
   //              $('.listings').empty();
   //          }
   //      });
   //  });
   //  $('body').on('click','.remove_current_dc_row',function(e){
   //     e.preventDefault();
   //     var current = $(this);
   //     current.parent().parent().remove();
   // });
   //  //MULTIPLER DC GENERATE - IN ESTIMATE
   //  $('body').on('click change','#estimate_customer',function(e){
   //      e.preventDefault();
   //      var customer_id = $("#estimate_customer").val();
   //      $.ajax({
   //          url: '<?php echo base_url('estimate/get_customer_based_estimate'); ?>',
   //          method:'post',
   //          data:{'customer_id':customer_id}
   //      }).done(function(response){
   //          var res = $.parseJSON(response);
   //          if(res.result=='success'){
   //              $('#estimate_dc_no').empty();
   //              $('#estimate_dc_no').append(res.dc_no);
   //          }else{
   //              $('#estimate_dc_no').empty();
   //          }
   //      });
   //  });
   //  $('body').on('change','#estimate_dc_no',function(e){
   //      var dc_no = $(this).val();
   //      $.ajax({
   //          url: '<?php echo base_url('estimate/get_estimate_dc_details'); ?>',
   //          method:'post',
   //          data:{'dc_no':dc_no}
   //      }).done(function(response){
   //          var res = $.parseJSON(response);
   //          if(res.result=='success'){
   //              $('.listings').empty();
   //              $('.listings').append(res.listings);
   //          }else{
   //              $('.listings').empty();
   //          }
   //      });
   //  });
   //  $('body').on('click','.remove_current_estimate_row',function(e){
   //     e.preventDefault();
   //     var current = $(this);
   //     current.parent().parent().remove();
   // });


//INVOICE - GET PRODUCT DETAILS
$('body').on('change','#invoice_product',function(e){
    e.preventDefault();
    var product_id = $("#invoice_product").val();
    $.ajax({
        url: '<?php echo base_url('invoice/get_product_details'); ?>',
        method:'post',
        data:{'product_id':product_id}
    }).done(function(response){
        var res = $.parseJSON(response);
        if(res.result=='success'){
            if(res.brand_name!=""){
                $('#invoice_brand').val(res.brand_name);
            }
            $('#invoice_rate').val(res.product_price);
        }else{
            $('#invoice_product').val('');
            $('#invoice_quantity').val('');
        }
    });
});
    //INVOICE RATE CALCULATIONS
    $('body').on('click','#invoice_amount',function(e){
        e.preventDefault();
        var product_quantity = $("#invoice_quantity").val();
        var product_rate = $("#invoice_rate").val();
        $.ajax({
            url: '<?php echo base_url('invoice/invoice_calculation'); ?>',
            method:'post',
            data:{'product_quantity':product_quantity,'product_rate':product_rate}
        }).done(function(response){
            var res = $.parseJSON(response);
            if(res.result=='success'){
                $('#invoice_amount').val(res.amount);
            }else{
                $('#invoice_amount').val('');
            }
        });
    });
    $('body').on('change','#invoice_quantity',function(e){
        e.preventDefault();
        var product_quantity = $("#invoice_quantity").val();
        var product_rate = $("#invoice_rate").val();
        $.ajax({
            url: '<?php echo base_url('invoice/invoice_calculation'); ?>',
            method:'post',
            data:{'product_quantity':product_quantity,'product_rate':product_rate}
        }).done(function(response){
            var res = $.parseJSON(response);
            if(res.result=='success'){
                $('#invoice_amount').val(res.amount);
            }else{
                $('#invoice_amount').val('');
            }
        });
    });
    $('body').on('change','#invoice_rate',function(e){
        e.preventDefault();
        var product_quantity = $("#invoice_quantity").val();
        var product_rate = $("#invoice_rate").val();
        $.ajax({
            url: '<?php echo base_url('invoice/invoice_calculation'); ?>',
            method:'post',
            data:{'product_quantity':product_quantity,'product_rate':product_rate}
        }).done(function(response){
            var res = $.parseJSON(response);
            if(res.result=='success'){
                $('#invoice_amount').val(res.amount);
            }else{
                $('#invoice_amount').val('');
            }
        });
    });
     //INVOICE - ADD TEMPRORY TABLE
     $('body').on('click','.new_invoice_add',function(e){
        e.preventDefault();
        var product_id  = $("#invoice_product").val();
        var quantity    = $("#invoice_quantity").val();
        var rate        = $("#invoice_rate").val();
        var amount      = $("#invoice_amount").val();
        $.ajax({
            url: '<?php echo base_url('invoice/add_temprory_invoice'); ?>',
            method:'post',
            data:{'product_id':product_id,'quantity':quantity,'rate':rate,'amount':amount}
        }).done(function(response){
            var res = $.parseJSON(response);
            if(res.result=='success'){
                $('.listings').empty();
                $('.listings').append(res.listings);
                $("#invoice_subtotal").val(res.sub_total);
                $("#invoice_product").val('');
                $("#invoice_brand").val('');
                $("#invoice_quantity").val('');
                $("#invoice_rate").val('');
                $("#invoice_amount").val('');
            }else{
                $('.listings').empty();
                $("#invoice_product").val('');
                $("#invoice_brand").val('');
                $("#invoice_quantity").val('');
                $("#invoice_rate").val('');
                $("#invoice_amount").val('');
            }
        });
    });
     $('body').on('click','.temp_invoice_remove',function(e){
        e.preventDefault();
        var invoice_temp_id =  $(this).attr('data-id');
        $.ajax({
            url: '<?php echo base_url('invoice/remove_temp_invoice'); ?>',
            method:'post',
            data:{'invoice_temp_id':invoice_temp_id}
        }).done(function(response){
            var res = $.parseJSON(response);
            $('.message').empty();
            $('.message').append(res.display_message);
            setInterval(function(){$('.message').empty()},5000);
            $('.listings').empty();
            $('.listings').append(res.listings);
            $("#invoice_subtotal").val(res.sub_total);
            $("#invoice_subtotal").trigger('change');
        });
    });
     $('body').on('keyup','#invoice_quantity',function(e){
        var product_qty =  $(this).val();
        var product_id =  $('#invoice_product').val();
        $.ajax({
            url: '<?php echo base_url('invoice/check_product_qty'); ?>',
            method:'post',
            data:{'product_id':product_id,'product_qty':product_qty}
        }).done(function(response){
            var res = $.parseJSON(response);
            if(res.result=='success'){
                $("#invoice_quantity").css("border-color", "green");
                $("#invoice_quantity").css("border-width", "2px");
                $('.message').empty();
                $('.message').append(res.display_message);
                setInterval(function(){$('.message').empty()},10000);
                $('.new_invoice_add').show();
            }else{
                $("#invoice_quantity").css("border-color", "red");
                $("#invoice_quantity").css("border-width", "2px");
                $('.message').empty();
                $('.message').append(res.display_message);
                setInterval(function(){$('.message').empty()},10000);
                if(res.overquantity == 1){
                    $('.new_invoice_add').show();
                }else{
                    $('.new_invoice_add').hide();
                }
            }
        });
    });
    //INVOICE - PAYMENTS
    $('body').on('click','.add_invoice_payment_show',function(e){
        e.preventDefault();
        current = $(this);
        $('.add_invoice_payment_view').show();
        current.empty().append('HIDE PAYMENT');
        current.removeClass('add_invoice_payment_show').addClass('add_invoice_payment_hide');
        current.removeClass('btn-success').addClass('btn-danger');
    });
     //MULTIPLER DC GENERATE - IN INVOICE
     $('body').on('click change','#invoice_customer',function(e){
        e.preventDefault();
        var customer_id = $("#invoice_customer").val();
        $.ajax({
            url: '<?php echo base_url('invoice/get_customer_based_invoice'); ?>',
            method:'post',
            data:{'customer_id':customer_id}
        }).done(function(response){
            var res = $.parseJSON(response);
            if(res.result=='success'){
                $('#invoice_dc_no').empty();
                $('#invoice_dc_no').append(res.dc_no);
            }else{
                $('#invoice_dc_no').empty();
            }
        });
    });
     $('body').on('change','#invoice_dc_no',function(e){
        var dc_no = $(this).val();
        $.ajax({
            url: '<?php echo base_url('invoice/get_invoice_dc_details'); ?>',
            method:'post',
            data:{'dc_no':dc_no}
        }).done(function(response){
            var res = $.parseJSON(response);
            if(res.result=='success'){
                $('.listings').empty();
                $('.listings').append(res.listings);
            }else{
                $('.listings').empty();
            }
        });
    });
     $('body').on('click','.remove_current_invoice_row',function(e){
       e.preventDefault();
       var current = $(this);
       current.parent().parent().remove();
   });
     //DC GENERATE - INVOICE (MULTIPLE DC)
     $('body').on('click change','#dc_customer',function(e){
        e.preventDefault();
        var customer_id = $("#dc_customer").val();
        $.ajax({
            url: '<?php echo base_url('dc/get_customer_based_dc'); ?>',
            method:'post',
            data:{'customer_id':customer_id}
        }).done(function(response){
            var res = $.parseJSON(response);
            if(res.result=='success'){
                $('#invoice_no').empty();
                $('#invoice_no').append(res.invoice_no);
            }else{
                $('#invoice_no').empty();
            }
        });
    });
     $('body').on('change','#invoice_no',function(e){
        var invoice_no = $(this).val();
        $.ajax({
            url: '<?php echo base_url('dc/get_invoice_details'); ?>',
            method:'post',
            data:{'invoice_no':invoice_no}
        }).done(function(response){
            var res = $.parseJSON(response);
            if(res.result=='success'){
                $('.listings').empty();
                $('.listings').append(res.listings);
            }else{
                $('.listings').empty();
            }
        });
    });
     //DISCOUNT MODULE
     $('body').on('keyup keydown change','.add_invoice_productwise_discount',function(e){
        var key = $(this).attr('data-id');
        var tax_percentage = $('.add_invoice_tax_value'+key).val();
        var tax_type = $('#invoice_tax_type').val();
        var quantity = $('.add_invoice_quantity'+key).val();
        var discount_percentage = $('.add_invoice_productwise_discount'+key).val(); 
        var rate = $('.add_invoice_rate'+key).val();
        $.ajax({ 
            url : '<?php echo base_url('invoice/invoice_product_total_calculations'); ?>',
            method : 'post',
            data:{'quantity':quantity,'rate':rate,'tax_percentage':tax_percentage,'tax_type':tax_type,'discount_percentage':discount_percentage}
        }).done(function(response){
            var res = $.parseJSON(response);
            if(res.result=='success'){
                $('.after_discount_price'+key).val(res.amount);
                $('.tax_percentage'+key).val(res.tax_percentage); 
                $('.add_invoice_tax_total'+key).val(res.total_tax); 
                $('.add_invoice_total'+key).val(res.product_total);
            }else{
                $('.after_discount_price'+key).empty();
                $('.tax_percentage'+key).val(res.tax_percentage); 
                $('.add_invoice_tax_total'+key).val(res.total_tax); 
                $('.add_invoice_total'+key).val(res.product_total);
            }
        });
    });
     $('body').on('keyup keydown change','.add_invoice_rate',function(e){
        var key = $(this).attr('data-id');
        var tax_percentage = $('.add_invoice_tax_value'+key).val();
        var tax_type = $('#invoice_tax_type').val();
        var quantity = $('.add_invoice_quantity'+key).val();
        var discount_percentage = $('.add_invoice_productwise_discount'+key).val(); 
        var rate = $('.add_invoice_rate'+key).val();
        $.ajax({ 
            url : '<?php echo base_url('invoice/invoice_product_total_calculations'); ?>',
            method : 'post',
            data:{'quantity':quantity,'rate':rate,'tax_percentage':tax_percentage,'tax_type':tax_type,'discount_percentage':discount_percentage}
        }).done(function(response){
            var res = $.parseJSON(response);
            if(res.result=='success'){
                $('.after_discount_price'+key).val(res.amount);
                $('.tax_percentage'+key).val(res.tax_percentage); 
                $('.add_invoice_tax_total'+key).val(res.total_tax); 
                $('.add_invoice_total'+key).val(res.product_total); 
            }else{
                $('.after_discount_price'+key).empty();
                $('.tax_percentage'+key).val(res.tax_percentage); 
                $('.add_invoice_tax_total'+key).val(res.total_tax); 
                $('.add_invoice_total'+key).val(res.product_total);
            }
        });
    });
     $('body').on('keyup keydown change','.add_invoice_tax_value',function(e){
        var key = $(this).attr('data-id');
        var tax_percentage = $('.add_invoice_tax_value'+key).val();
        var tax_type = $('#invoice_tax_type').val();
        var quantity = $('.add_invoice_quantity'+key).val();
        var discount_percentage = $('.add_invoice_productwise_discount'+key).val(); 
        var rate = $('.add_invoice_rate'+key).val();
        $.ajax({ 
            url : '<?php echo base_url('invoice/invoice_product_total_calculations'); ?>',
            method : 'post',
            data:{'quantity':quantity,'rate':rate,'tax_percentage':tax_percentage,'tax_type':tax_type,'discount_percentage':discount_percentage}
        }).done(function(response){
            var res = $.parseJSON(response);
            if(res.result=='success'){
                $('.after_discount_price'+key).val(res.amount);
                $('.tax_percentage'+key).val(res.tax_percentage); 
                $('.add_invoice_tax_total'+key).val(res.total_tax); 
                $('.add_invoice_total'+key).val(res.product_total); 
            }else{
                $('.after_discount_price'+key).empty();
                $('.tax_percentage'+key).val(res.tax_percentage); 
                $('.add_invoice_tax_total'+key).val(res.total_tax); 
                $('.add_invoice_total'+key).val(res.product_total);
            }
        });
    });
     $('body').on('keyup keydown change','.add_invoice_quantity',function(e){
        var key = $(this).attr('data-id');
        var tax_percentage = $('.add_invoice_tax_value'+key).val();
        var tax_type = $('#invoice_tax_type').val();
        var quantity = $('.add_invoice_quantity'+key).val();
        var discount_percentage = $('.add_invoice_productwise_discount'+key).val(); 
        var rate = $('.add_invoice_rate'+key).val();
        $.ajax({ 
            url : '<?php echo base_url('invoice/invoice_product_total_calculations'); ?>',
            method : 'post',
            data:{'quantity':quantity,'rate':rate,'tax_percentage':tax_percentage,'tax_type':tax_type,'discount_percentage':discount_percentage}
        }).done(function(response){
            var res = $.parseJSON(response);
            if(res.result=='success'){
                $('.after_discount_price'+key).val(res.amount);
                $('.tax_percentage'+key).val(res.tax_percentage); 
                $('.add_invoice_tax_total'+key).val(res.total_tax); 
                $('.add_invoice_total'+key).val(res.product_total); 
            }else{
                $('.after_discount_price'+key).empty();
                $('.tax_percentage'+key).val(res.tax_percentage); 
                $('.add_invoice_tax_total'+key).val(res.total_tax); 
                $('.add_invoice_total'+key).val(res.product_total);
            }
        });
    });
     $('body').on('change click','.dc_check_box',function(e){
        var total = 0;
        $( ".dc_check_box" ).each(function(){
            if($(this).prop("checked") == true){
                var key = $(this).attr('data-id');
                if($('#add_invoice_total'+key).length){
                    var value = $('#add_invoice_total'+key).val();
                    total = parseFloat(total) + parseFloat(value);
                }
            }
            $('#invoice_subtotal').val(total);
            $('#invoice_subtotal').trigger('change');
        });
    });
     $('body').on('change click','.estimate_dc_check_box',function(e){
        var total = 0;
        $( ".estimate_dc_check_box" ).each(function(){
            if($(this).prop("checked") == true){
                var key = $(this).attr('data-id');
                if($('#add_estimate_total'+key).length){
                    var value = $('#add_estimate_total'+key).val();
                    total = parseFloat(total) + parseFloat(value);
                }
            }
            $('#estimate_subtotal').val(total);
            $('#estimate_subtotal').trigger('change');
        });
    });
     $('body').on('keyup keydown change click','#invoice_other_expenses',function(e){
        var total = 0;
        var subtotal = $('#invoice_subtotal').val();
        var other_expenses = $('#invoice_other_expenses').val();
        if($("#invoice_cash_discount").val()!=""){
            var invoice_cash_discount = $("#invoice_cash_discount").val();
        }else{
            var invoice_cash_discount = 0;
        }
        if($("#invoice_transportaion_charges").val()){
            var invoice_transportaion_charges = $("#invoice_transportaion_charges").val();
        }else{
            var invoice_transportaion_charges = 0;
        }
        if($("#invoice_loading_charges").val()!=""){
            var invoice_loading_charges = $("#invoice_loading_charges").val();
        }else{
            var invoice_loading_charges = 0;
        }
        total = (parseFloat(subtotal) - parseFloat(invoice_cash_discount))  + parseFloat(other_expenses)+parseFloat(invoice_transportaion_charges)+parseFloat(invoice_loading_charges);
        $('#invoice_total').val(total);
        $('#invoice_subtotal').trigger('change');
    });
     $('body').on('keyup keydown change click','#invoice_transportaion_charges',function(e){
        var total = 0;
        var subtotal = $('#invoice_subtotal').val();
        var transportaion_charges = $('#invoice_transportaion_charges').val();
        if($("#invoice_cash_discount").val()!=""){
            var invoice_cash_discount = $("#invoice_cash_discount").val();
        }else{
            var invoice_cash_discount = 0;
        }
        if($("#invoice_other_expenses").val()){
            var invoice_other_expenses = $("#invoice_other_expenses").val();
        }else{
            var invoice_other_expenses = 0;
        }
        if($("#invoice_loading_charges").val()!=""){
            var invoice_loading_charges = $("#invoice_loading_charges").val();
        }else{
            var invoice_loading_charges = 0;
        }
        total = (parseFloat(subtotal) - parseFloat(invoice_cash_discount))  + parseFloat(invoice_other_expenses)+parseFloat(transportaion_charges)+parseFloat(invoice_loading_charges);
        $('#invoice_total').val(total);
        $('#invoice_subtotal').trigger('change');
    });
     $('body').on('keyup keydown change click','#invoice_loading_charges',function(e){
        var total = 0;
        var subtotal = $('#invoice_subtotal').val();
        var loading_charges = $('#invoice_loading_charges').val();
        if($("#invoice_cash_discount").val()!=""){
            var invoice_cash_discount = $("#invoice_cash_discount").val();
        }else{
            var invoice_cash_discount = 0;
        }
        if($("#invoice_other_expenses").val()){
            var invoice_other_expenses = $("#invoice_other_expenses").val();
        }else{
            var invoice_other_expenses = 0;
        }
        if($("#invoice_transportaion_charges").val()!=""){
            var invoice_transportaion_charges = $("#invoice_transportaion_charges").val();
        }else{
            var invoice_transportaion_charges = 0;
        }
        total = (parseFloat(subtotal) - parseFloat(invoice_cash_discount))  + parseFloat(invoice_other_expenses)+parseFloat(invoice_transportaion_charges)+parseFloat(loading_charges);
        $('#invoice_total').val(total);
        $('#invoice_subtotal').trigger('change');
    });
     $('body').on('keyup keydown change click','#invoice_cash_discount',function(e){
        var total = 0;
        var subtotal = $('#invoice_subtotal').val();
        var invoice_cash_discount = $('#invoice_cash_discount').val();
        if($("#invoice_other_expenses").val()){
            var invoice_other_expenses = $("#invoice_other_expenses").val();
        }else{
            var invoice_other_expenses = 0;
        }
        if($("#invoice_transportaion_charges").val()!=""){
            var invoice_transportaion_charges = $("#invoice_transportaion_charges").val();
        }else{
            var invoice_transportaion_charges = 0;
        }
        if($("#invoice_loading_charges").val()!=""){
            var invoice_loading_charges = $("#invoice_loading_charges").val();
        }else{
            var invoice_loading_charges = 0;
        }
        total = (parseFloat(subtotal) - parseFloat(invoice_cash_discount))  + parseFloat(invoice_other_expenses)+parseFloat(invoice_transportaion_charges)+parseFloat(invoice_loading_charges);
        $('#invoice_total').val(total);
        $('#invoice_subtotal').trigger('change');
    });
     $('body').on('keyup keydown change click','#invoice_total',function(e){
        var total = 0;
        var subtotal = $('#invoice_subtotal').val();
        if($("#invoice_cash_discount").val()!=""){
            var invoice_cash_discount = $("#invoice_cash_discount").val();
        }else{
            var invoice_cash_discount = 0;
        }
        if($("#invoice_other_expenses").val()){
            var invoice_other_expenses = $("#invoice_other_expenses").val();
        }else{
            var invoice_other_expenses = 0;
        }
        if($("#invoice_transportaion_charges").val()!=""){
            var invoice_transportaion_charges = $("#invoice_transportaion_charges").val();
        }else{
            var invoice_transportaion_charges = 0;
        }
        if($("#invoice_loading_charges").val()){
            var loading_charges = $("#invoice_loading_charges").val();
        }else{
            var loading_charges = 0;
        }
        total = (parseFloat(subtotal) - parseFloat(invoice_cash_discount))  + parseFloat(invoice_other_expenses)+parseFloat(invoice_transportaion_charges)+parseFloat(loading_charges);
        $('#invoice_total').val(total);
    });
    //INVOICE EDIT 
    $('body').on('change click','.add_invoice_total',function(e){
        var key                 = $(this).attr('data-id');
        var dc_relation_id      = $('.dc_check_box_edit'+key).val();
        var quantity            = $('.add_invoice_quantity'+key).val();
        var rate                = $('.add_invoice_rate'+key).val();
        var discount_percentage = $('.add_invoice_productwise_discount'+key).val(); 
        var discount_price      = $('.after_discount_price'+key).val();
        var tax_percentage      = $('.add_invoice_tax_value'+key).val();
        var tax_total           = $('.add_invoice_tax_total'+key).val();
        var total               = $('.add_invoice_total'+key).val();  
        $.ajax({ 
            url : '<?php echo base_url('invoice/invoice_edit_temp_products'); ?>',
            method : 'post',
            data:{'dc_relation_id':dc_relation_id,'quantity':quantity,'rate':rate,'tax_percentage':tax_percentage,'discount_price':discount_price,'discount_percentage':discount_percentage,'tax_total':tax_total,'total':total}
        }).done(function(response){
            var res = $.parseJSON(response);
            if(res.result=='success'){
                $('#invoice_subtotal').val(res.sub_total);
            }else{
                $('#invoice_subtotal').empty();
            }
        });
    });
    $('body').on('keyup keydown change click','.invoice_overall_discount',function(e){
        var invoice_overall_discount    = $(this).val();
        $('.add_invoice_productwise_discount').val(invoice_overall_discount); 
        $('.add_invoice_productwise_discount').trigger('change');
    });
    //SALES RETURN
    $('body').on('change','#sales_return_customer',function(e){
        var customer_id =  $(this).val();
        $.ajax({
            url: '<?php echo base_url('sales_return/get_sales_bills'); ?>',
            method:'post',
            data:{ 'customer_id':customer_id}
        }).done(function(response){
            var res = $.parseJSON(response);
            $('#sales_return_invoice_id').empty();
            $('#sales_return_invoice_id').append(res.sales_bills);
        });
    });
    $('body').on('change','#sales_return_invoice_id',function(e){
        var customer_id =  $('#sales_return_customer').val();
        var invoice_id =  $(this).val();
        $.ajax({
            url: '<?php echo base_url('sales_return/get_sales_products'); ?>',
            method:'post',
            data:{ 'customer_id':customer_id,'invoice_id':invoice_id}
        }).done(function(response){
            $(".sales_return_product").show();
            $('.sales_return_product_list').empty();
            $('.sales_return_product_list').append(response);
        });
    });
    $('body').on('keyup keydown change','.quantity',function(e){
        var key = $(this).attr('data-id');
        var current_qty = $('.current_quantity'+key).val();
        var new_qty = $('.quantity'+key).val();
        if(parseInt(new_qty) <= parseInt(current_qty)){
            $('.sales_return_create').show();
            $('.quantity'+key).css("border-color", "green");
        }else{
            $('.sales_return_create').hide();
            $('.quantity'+key).css("border-color", "red");
        }
        $('.checkbox'+key).prop('checked', true);
    });
    //ESTIMATE - GET PRODUCT DETAILS
    $('body').on('change','#estimate_product',function(e){
        e.preventDefault();
        var product_id = $("#estimate_product").val();
        $.ajax({
            url: '<?php echo base_url('estimate/get_product_details'); ?>',
            method:'post',
            data:{'product_id':product_id}
        }).done(function(response){
            var res = $.parseJSON(response);
            if(res.result=='success'){
                if(res.brand_name!=""){
                    $('#estimate_brand').val(res.brand_name);
                }
                $('#estimate_rate').val(res.product_price);
            }else{
                $('#estimate_product').val('');
                $('#estimate_quantity').val('');
            }
        });
    });
    //ESTIMATE RATE CALCULATIONS
    $('body').on('click','#estimate_amount',function(e){
        e.preventDefault();
        var product_quantity = $("#estimate_quantity").val();
        var product_rate = $("#estimate_rate").val();
        $.ajax({
            url: '<?php echo base_url('estimate/estimate_calculation'); ?>',
            method:'post',
            data:{'product_quantity':product_quantity,'product_rate':product_rate}
        }).done(function(response){
            var res = $.parseJSON(response);
            if(res.result=='success'){
                $('#estimate_amount').val(res.amount);
            }else{
                $('#estimate_amount').val('');
            }
        });
    });
    $('body').on('change','#estimate_quantity',function(e){
        e.preventDefault();
        var product_quantity = $("#estimate_quantity").val();
        var product_rate = $("#estimate_rate").val();
        $.ajax({
            url: '<?php echo base_url('estimate/estimate_calculation'); ?>',
            method:'post',
            data:{'product_quantity':product_quantity,'product_rate':product_rate}
        }).done(function(response){
            var res = $.parseJSON(response);
            if(res.result=='success'){
                $('#estimate_amount').val(res.amount);
            }else{
                $('#estimate_amount').val('');
            }
        });
    });
    $('body').on('change','#estimate_rate',function(e){
        e.preventDefault();
        var product_quantity = $("#estimate_quantity").val();
        var product_rate = $("#estimate_rate").val();
        $.ajax({
            url: '<?php echo base_url('estimate/estimate_calculation'); ?>',
            method:'post',
            data:{'product_quantity':product_quantity,'product_rate':product_rate}
        }).done(function(response){
            var res = $.parseJSON(response);
            if(res.result=='success'){
                $('#estimate_amount').val(res.amount);
            }else{
                $('#estimate_amount').val('');
            }
        });
    });
     //ESTIMATE - ADD TEMPRORY TABLE
     $('body').on('click','.new_estimate_add',function(e){
        e.preventDefault();
        var product_id  = $("#estimate_product").val();
        var quantity    = $("#estimate_quantity").val();
        var rate        = $("#estimate_rate").val();
        var amount      = $("#estimate_amount").val();
        $.ajax({
            url: '<?php echo base_url('estimate/add_temprory_estimate'); ?>',
            method:'post',
            data:{'product_id':product_id,'quantity':quantity,'rate':rate,'amount':amount}
        }).done(function(response){
            var res = $.parseJSON(response);
            if(res.result=='success'){
                $('.listings').empty();
                $('.listings').append(res.listings);
                $("#estimate_subtotal").val(res.sub_total);
                $("#estimate_product").val('');
                $("#estimate_brand").val('');
                $("#estimate_quantity").val('');
                $("#estimate_rate").val('');
                $("#estimate_amount").val('');
            }else{
                $('.listings').empty();
                $("#estimate_product").val('');
                $("#estimate_brand").val('');
                $("#estimate_quantity").val('');
                $("#estimate_rate").val('');
                $("#estimate_amount").val('');
            }
        });
    });
     $('body').on('click','.temp_estimate_remove',function(e){
        e.preventDefault();
        var estimate_temp_id =  $(this).attr('data-id');
        $.ajax({
            url: '<?php echo base_url('estimate/remove_temp_estimate'); ?>',
            method:'post',
            data:{'estimate_temp_id':estimate_temp_id}
        }).done(function(response){
            var res = $.parseJSON(response);
            $('.message').empty();
            $('.message').append(res.display_message);
            setInterval(function(){$('.message').empty()},5000);
            $('.listings').empty();
            $('.listings').append(res.listings);
            $("#estimate_subtotal").val(res.sub_total);
            $("#estimate_subtotal").trigger('change');
        });
    });
     $('body').on('keyup','#estimate_quantity',function(e){
        var product_qty =  $(this).val();
        var product_id =  $('#estimate_product').val();
        $.ajax({
            url: '<?php echo base_url('estimate/check_product_qty'); ?>',
            method:'post',
            data:{'product_id':product_id,'product_qty':product_qty}
        }).done(function(response){
            var res = $.parseJSON(response);
            if(res.result=='success'){
                $("#estimate_quantity").css("border-color", "green");
                $("#estimate_quantity").css("border-width", "2px");
                $('.message').empty();
                $('.message').append(res.display_message);
                setInterval(function(){$('.message').empty()},10000);
                $('.new_estimate_add').show();
            }else{
                $("#estimate_quantity").css("border-color", "red");
                $("#estimate_quantity").css("border-width", "2px");
                $('.message').empty();
                $('.message').append(res.display_message);
                setInterval(function(){$('.message').empty()},10000);
                if(res.overquantity == 1){
                    $('.new_estimate_add').show();
                }else{
                    $('.new_estimate_add').hide();
                }
            }
        });
    });
    //ESTIMATE - PAYMENTS
    $('body').on('click','.add_estimate_payment_show',function(e){
        e.preventDefault();
        current = $(this);
        $('.add_estimate_payment_view').show();
        current.empty().append('HIDE PAYMENT');
        current.removeClass('add_estimate_payment_show').addClass('add_estimate_payment_hide');
        current.removeClass('btn-success').addClass('btn-danger');
    });
     //MULTIPLER DC GENERATE - IN ESTIMATE
     $('body').on('click change','#estimate_customer',function(e){
        e.preventDefault();
        var customer_id = $("#estimate_customer").val();
        $.ajax({
            url: '<?php echo base_url('estimate/get_customer_based_estimate'); ?>',
            method:'post',
            data:{'customer_id':customer_id}
        }).done(function(response){
            var res = $.parseJSON(response);
            if(res.result=='success'){
                $('#estimate_dc_no').empty();
                $('#estimate_dc_no').append(res.dc_no);
            }else{
                $('#estimate_dc_no').empty();
            }
        });
    });
     $('body').on('change','#estimate_dc_no',function(e){
        var dc_no = $(this).val();
        var customer_id = $("#estimate_customer").val();
        $.ajax({
            url: '<?php echo base_url('estimate/get_estimate_dc_details'); ?>',
            method:'post',
            data:{'dc_no':dc_no,'customer_id':customer_id}
        }).done(function(response){
            var res = $.parseJSON(response);
            if(res.result=='success'){
                $('.listings').empty();
                $('.listings').append(res.listings);
            }else{
                $('.listings').empty();
            }
        });
    });
     $('body').on('click','.remove_current_estimate_row',function(e){
       e.preventDefault();
       var current = $(this);
       current.parent().parent().remove();
   });
     //DC GENERATE - ESTIMATE (MULTIPLE DC)
     $('body').on('click change','#dc_customer',function(e){
        e.preventDefault();
        var customer_id = $("#dc_customer").val();
        $.ajax({
            url: '<?php echo base_url('dc/get_customer_based_dc'); ?>',
            method:'post',
            data:{'customer_id':customer_id}
        }).done(function(response){
            var res = $.parseJSON(response);
            if(res.result=='success'){
                $('#estimate_no').empty();
                $('#estimate_no').append(res.estimate_no);
            }else{
                $('#estimate_no').empty();
            }
        });
    });
     $('body').on('change','#estimate_no',function(e){
        var estimate_no = $(this).val();
        $.ajax({
            url: '<?php echo base_url('dc/get_estimate_details'); ?>',
            method:'post',
            data:{'estimate_no':estimate_no}
        }).done(function(response){
            var res = $.parseJSON(response);
            if(res.result=='success'){
                $('.listings').empty();
                $('.listings').append(res.listings);
            }else{
                $('.listings').empty();
            }
        });
    });
     //DISCOUNT MODULE
     $('body').on('keyup keydown change','.add_estimate_productwise_discount',function(e){
        var key = $(this).attr('data-id');
        var tax_percentage = $('.add_estimate_tax_value'+key).val();
        var tax_type = $('#estimate_tax_type').val();
        var quantity = $('.add_estimate_quantity'+key).val();
        var discount_percentage = $('.add_estimate_productwise_discount'+key).val(); 
        var rate = $('.add_estimate_rate'+key).val();
        $.ajax({ 
            url : '<?php echo base_url('estimate/estimate_product_total_calculations'); ?>',
            method : 'post',
            data:{'quantity':quantity,'rate':rate,'tax_percentage':tax_percentage,'tax_type':tax_type,'discount_percentage':discount_percentage}
        }).done(function(response){
            var res = $.parseJSON(response);
            if(res.result=='success'){
                $('.after_discount_price'+key).val(res.amount);
                $('.tax_percentage'+key).val(res.tax_percentage); 
                $('.add_estimate_tax_total'+key).val(res.total_tax); 
                $('.add_estimate_total'+key).val(res.product_total);
            }else{
                $('.after_discount_price'+key).empty();
                $('.tax_percentage'+key).val(res.tax_percentage); 
                $('.add_estimate_tax_total'+key).val(res.total_tax); 
                $('.add_estimate_total'+key).val(res.product_total);
            }
        });
    });
     $('body').on('keyup keydown change','.add_estimate_rate',function(e){
        var key = $(this).attr('data-id');
        var tax_percentage = $('.add_estimate_tax_value'+key).val();
        var tax_type = $('#estimate_tax_type').val();
        var quantity = $('.add_estimate_quantity'+key).val();
        var discount_percentage = $('.add_estimate_productwise_discount'+key).val(); 
        var rate = $('.add_estimate_rate'+key).val();
        $.ajax({ 
            url : '<?php echo base_url('estimate/estimate_product_total_calculations'); ?>',
            method : 'post',
            data:{'quantity':quantity,'rate':rate,'tax_percentage':tax_percentage,'tax_type':tax_type,'discount_percentage':discount_percentage}
        }).done(function(response){
            var res = $.parseJSON(response);
            if(res.result=='success'){
                $('.after_discount_price'+key).val(res.amount);
                $('.tax_percentage'+key).val(res.tax_percentage); 
                $('.add_estimate_tax_total'+key).val(res.total_tax); 
                $('.add_estimate_total'+key).val(res.product_total); 
            }else{
                $('.after_discount_price'+key).empty();
                $('.tax_percentage'+key).val(res.tax_percentage); 
                $('.add_estimate_tax_total'+key).val(res.total_tax); 
                $('.add_estimate_total'+key).val(res.product_total);
            }
        });
    });
     $('body').on('keyup keydown change','.add_estimate_tax_value',function(e){
        var key = $(this).attr('data-id');
        var tax_percentage = $('.add_estimate_tax_value'+key).val();
        var tax_type = $('#estimate_tax_type').val();
        var quantity = $('.add_estimate_quantity'+key).val();
        var discount_percentage = $('.add_estimate_productwise_discount'+key).val(); 
        var rate = $('.add_estimate_rate'+key).val();
        $.ajax({ 
            url : '<?php echo base_url('estimate/estimate_product_total_calculations'); ?>',
            method : 'post',
            data:{'quantity':quantity,'rate':rate,'tax_percentage':tax_percentage,'tax_type':tax_type,'discount_percentage':discount_percentage}
        }).done(function(response){
            var res = $.parseJSON(response);
            if(res.result=='success'){
                $('.after_discount_price'+key).val(res.amount);
                $('.tax_percentage'+key).val(res.tax_percentage); 
                $('.add_estimate_tax_total'+key).val(res.total_tax); 
                $('.add_estimate_total'+key).val(res.product_total); 
            }else{
                $('.after_discount_price'+key).empty();
                $('.tax_percentage'+key).val(res.tax_percentage); 
                $('.add_estimate_tax_total'+key).val(res.total_tax); 
                $('.add_estimate_total'+key).val(res.product_total);
            }
        });
    });
     $('body').on('keyup keydown change','.add_estimate_quantity',function(e){
        var key = $(this).attr('data-id');
        var tax_percentage = $('.add_estimate_tax_value'+key).val();
        var tax_type = $('#estimate_tax_type').val();
        var quantity = $('.add_estimate_quantity'+key).val();
        var discount_percentage = $('.add_estimate_productwise_discount'+key).val(); 
        var rate = $('.add_estimate_rate'+key).val();
        $.ajax({ 
            url : '<?php echo base_url('estimate/estimate_product_total_calculations'); ?>',
            method : 'post',
            data:{'quantity':quantity,'rate':rate,'tax_percentage':tax_percentage,'tax_type':tax_type,'discount_percentage':discount_percentage}
        }).done(function(response){
            var res = $.parseJSON(response);
            if(res.result=='success'){
                $('.after_discount_price'+key).val(res.amount);
                $('.tax_percentage'+key).val(res.tax_percentage); 
                $('.add_estimate_tax_total'+key).val(res.total_tax); 
                $('.add_estimate_total'+key).val(res.product_total); 
            }else{
                $('.after_discount_price'+key).empty();
                $('.tax_percentage'+key).val(res.tax_percentage); 
                $('.add_estimate_tax_total'+key).val(res.total_tax); 
                $('.add_estimate_total'+key).val(res.product_total);
            }
        });
    });
     $('body').on('change click','.dc_to_estimate_check_box',function(e){
        var total = 0;
        $( ".dc_to_estimate_check_box" ).each(function(){
            if($(this).prop("checked") == true){
                var key = $(this).attr('data-id');
                if($('#add_estimate_total'+key).length){
                    var value = $('#add_estimate_total'+key).val();
                    total = parseFloat(total) + parseFloat(value);
                }
            }
            console.log(total);
            $('#estimate_subtotal').val(total);
            $('#estimate_subtotal').trigger('change');
        });
    });
     $('body').on('keyup keydown change click','#estimate_other_expenses',function(e){
        var total = 0;
        var subtotal = $('#estimate_subtotal').val();
        var other_expenses = $('#estimate_other_expenses').val();
        if($("#estimate_cash_discount").val()!=""){
            var estimate_cash_discount = $("#estimate_cash_discount").val();
        }else{
            var estimate_cash_discount = 0;
        }
        if($("#estimate_transportaion_charges").val()){
            var estimate_transportaion_charges = $("#estimate_transportaion_charges").val();
        }else{
            var estimate_transportaion_charges = 0;
        }
        if($("#estimate_loading_charges").val()!=""){
            var estimate_loading_charges = $("#estimate_loading_charges").val();
        }else{
            var estimate_loading_charges = 0;
        }
        total = (parseFloat(subtotal) - parseFloat(estimate_cash_discount))  + parseFloat(other_expenses)+parseFloat(estimate_transportaion_charges)+parseFloat(estimate_loading_charges);
        $('#estimate_total').val(total);
        $('#estimate_subtotal').trigger('change');
    });
     $('body').on('keyup keydown change click','#estimate_transportaion_charges',function(e){
        var total = 0;
        var subtotal = $('#estimate_subtotal').val();
        var transportaion_charges = $('#estimate_transportaion_charges').val();
        if($("#estimate_cash_discount").val()!=""){
            var estimate_cash_discount = $("#estimate_cash_discount").val();
        }else{
            var estimate_cash_discount = 0;
        }
        if($("#estimate_other_expenses").val()){
            var estimate_other_expenses = $("#estimate_other_expenses").val();
        }else{
            var estimate_other_expenses = 0;
        }
        if($("#estimate_loading_charges").val()!=""){
            var estimate_loading_charges = $("#estimate_loading_charges").val();
        }else{
            var estimate_loading_charges = 0;
        }
        total = (parseFloat(subtotal) - parseFloat(estimate_cash_discount))  + parseFloat(estimate_other_expenses)+parseFloat(transportaion_charges)+parseFloat(estimate_loading_charges);
        $('#estimate_total').val(total);
        $('#estimate_subtotal').trigger('change');
    });
     $('body').on('keyup keydown change click','#estimate_loading_charges',function(e){
        var total = 0;
        var subtotal = $('#estimate_subtotal').val();
        var loading_charges = $('#estimate_loading_charges').val();
        if($("#estimate_cash_discount").val()!=""){
            var estimate_cash_discount = $("#estimate_cash_discount").val();
        }else{
            var estimate_cash_discount = 0;
        }
        if($("#estimate_other_expenses").val()){
            var estimate_other_expenses = $("#estimate_other_expenses").val();
        }else{
            var estimate_other_expenses = 0;
        }
        if($("#estimate_transportaion_charges").val()!=""){
            var estimate_transportaion_charges = $("#estimate_transportaion_charges").val();
        }else{
            var estimate_transportaion_charges = 0;
        }
        total = (parseFloat(subtotal) - parseFloat(estimate_cash_discount))  + parseFloat(estimate_other_expenses)+parseFloat(estimate_transportaion_charges)+parseFloat(loading_charges);
        $('#estimate_total').val(total);
        $('#estimate_subtotal').trigger('change');
    });
     $('body').on('keyup keydown change click','#estimate_cash_discount',function(e){
        var total = 0;
        var subtotal = $('#estimate_subtotal').val();
        var estimate_cash_discount = $('#estimate_cash_discount').val();
        if($("#estimate_other_expenses").val()){
            var estimate_other_expenses = $("#estimate_other_expenses").val();
        }else{
            var estimate_other_expenses = 0;
        }
        if($("#estimate_transportaion_charges").val()!=""){
            var estimate_transportaion_charges = $("#estimate_transportaion_charges").val();
        }else{
            var estimate_transportaion_charges = 0;
        }
        if($("#estimate_loading_charges").val()!=""){
            var estimate_loading_charges = $("#estimate_loading_charges").val();
        }else{
            var estimate_loading_charges = 0;
        }
        total = (parseFloat(subtotal) - parseFloat(estimate_cash_discount))  + parseFloat(estimate_other_expenses)+parseFloat(estimate_transportaion_charges)+parseFloat(estimate_loading_charges);
        $('#estimate_total').val(total);
        $('#estimate_subtotal').trigger('change');
    });
     $('body').on('keyup keydown change click','#estimate_total',function(e){
        var total = 0;
        var subtotal = $('#estimate_subtotal').val();
        if($("#estimate_cash_discount").val()!=""){
            var estimate_cash_discount = $("#estimate_cash_discount").val();
        }else{
            var estimate_cash_discount = 0;
        }
        if($("#estimate_other_expenses").val()){
            var estimate_other_expenses = $("#estimate_other_expenses").val();
        }else{
            var estimate_other_expenses = 0;
        }
        if($("#estimate_transportaion_charges").val()!=""){
            var estimate_transportaion_charges = $("#estimate_transportaion_charges").val();
        }else{
            var estimate_transportaion_charges = 0;
        }
        if($("#estimate_loading_charges").val()!=""){
            var loading_charges = $("#estimate_loading_charges").val();
        }else{
            var loading_charges = 0;
        }
        total = (parseFloat(subtotal) - parseFloat(estimate_cash_discount))  + parseFloat(estimate_other_expenses)+parseFloat(estimate_transportaion_charges)+parseFloat(loading_charges);
        $('#estimate_total').val(total);
    });
    //ESTIMATE EDIT 
    $('body').on('change click','.add_estimate_total',function(e){
        var key                 = $(this).attr('data-id');
        var dc_relation_id      = $('.dc_to_estimate_check_box_edit'+key).val();
        var quantity            = $('.add_estimate_quantity'+key).val();
        var rate                = $('.add_estimate_rate'+key).val();
        var discount_percentage = $('.add_estimate_productwise_discount'+key).val(); 
        var discount_price      = $('.after_discount_price'+key).val();
        var tax_percentage      = $('.add_estimate_tax_value'+key).val();
        var tax_total           = $('.add_estimate_tax_total'+key).val();
        var total               = $('.add_estimate_total'+key).val();  
        $.ajax({ 
            url : '<?php echo base_url('estimate/estimate_edit_temp_products'); ?>',
            method : 'post',
            data:{'dc_relation_id':dc_relation_id,'quantity':quantity,'rate':rate,'tax_percentage':tax_percentage,'discount_price':discount_price,'discount_percentage':discount_percentage,'tax_total':tax_total,'total':total}
        }).done(function(response){
            var res = $.parseJSON(response);
            if(res.result=='success'){
                $('#estimate_subtotal').val(res.sub_total);
            }else{
                $('#estimate_subtotal').empty();
            }
        });
    });
    $('body').on('keyup keydown change click','.estimate_overall_discount',function(e){
        var estimate_overall_discount    = $(this).val();
        $('.add_estimate_productwise_discount').val(estimate_overall_discount); 
        $('.add_estimate_productwise_discount').trigger('change');
    });
    $('body').on('click change','#company_id',function(e){
        var company_id   =  $(this).val();
        var prefix_value =  $('#prefix_value').val();
        $.ajax({
            url: '<?php echo base_url('user/get_company_invoice_details'); ?>',
            method:'post',
            data:{'company_id':company_id,'prefix_value':prefix_value}
        }).done(function(response){
            var res = $.parseJSON(response);
            if(res.result=='success'){
                $('#dc_number').val(res.prefix_number);
                $('#quotation_number').val(res.prefix_number);
                $('#estimate_number').val(res.prefix_number);
                $('#invoice_number').val(res.prefix_number);
                $('#sales_return_number').val(res.prefix_number);
                $('#purchase_number').val(res.prefix_number);
                $('#purchase_order_number').val(res.prefix_number);
                $('#purchase_return_number').val(res.prefix_number);
                $('#purchase_dc_number').val(res.prefix_number);
                $('#expense_number').val(res.prefix_number);
            }else{
                $('#dc_number').val('');
                $('#quotation_number').val();
                $('#estimate_number').val();
                $('#invoice_number').val();
                $('#sales_return_number').val();
                $('#purchase_number').val();
                $('#purchase_order_number').val();
                $('#purchase_return_number').val();
                $('#purchase_dc_number').val();
                $('#expense_number').val();
            }
        });
    });
    $('body').on('change','#user_access_level',function(e){
        e.preventDefault();
        var access_level = $(this).val();
        $.ajax({
            url: '<?php echo base_url('user/access_level_list'); ?>',
            method:'post',
            data:{'access_level':access_level}
        }).done(function(response){
            var res = $.parseJSON(response);
            if(res.result=='success'){
                $('.listings').empty();
                $('.listings').append(res.listings);
            }else{
                $('.listings').empty();
            }
        });
    });
    $('body').on('change','#product_type',function(e){
        var product_type = $(this).val();
        $.ajax({
            url     : '<?php echo base_url('products/get_product_type_base_value'); ?>',
            method  : 'post',
            data    :{'product_type_id' : product_type }
        }).done(function(response){
            var res = $.parseJSON(response);
            if(res.result=='success'){
                $('#product_type_base_value').val(res.product_type_base_value);
                if(res.product_type_base_value == '0'){
                    $('.brand').hide();
                    $('.category').hide();
                    $('.sub_category').hide();
                }else if(res.product_type_base_value == '1'){
                    $('.brand').show();
                    $('.category').show();
                    $('.sub_category').show();
                }else if(res.product_type_base_value == '2'){
                    $('.brand').hide();
                    $('.category').show();
                    $('.sub_category').show();
                }else{
                    $('.brand').show();
                    $('.category').show();
                    $('.sub_category').show();
                }
            }
        });
    });
</script>
</body>
</html>