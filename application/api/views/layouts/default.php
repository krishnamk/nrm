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
    <div id="responsive-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
       <div class="modal-dialog">
        <div class="modal-content" id="model-content">
        </div>
    </div>
</div>
<!-- JAVASCRIPT -->
<script src="<?php echo base_url('assets/libs/jquery/jquery.min.js');?>"></script>
<script src="<?php echo base_url('assets/libs/bootstrap/js/bootstrap.bundle.min.js');?>"></script>
<script src="<?php echo base_url('assets/libs/metismenu/metisMenu.min.js');?>"></script>
<script src="<?php echo base_url('assets/libs/simplebar/simplebar.min.js');?>"></script>
<script src="<?php echo base_url('assets/libs/node-waves/waves.min.js');?>"></script>
<!-- select 2 plugin -->
<script src="<?php echo base_url('assets/libs/select2/js/select2.min.js');?>"></script>
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
<script src="<?php echo base_url('assets/libs/pdfmake/build/pdfmake.min.js');?>"></script>
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
    $('body').on('click','.cancel',function(e){
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
                if(res.brand_name!=""){
                    $('#purchase_brand').val(res.brand_name);
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
    //PURCHASE WITHOUT DC AND WITHOUT TAX
    $('body').on('click','.new_purchase_add',function(e){
        e.preventDefault();
        $('.error').hide();
        var product_id = $("#purchase_product").val();
        var purchase_rate = $("#purchase_rate").val();
        var purchase_quantity   = $('#purchase_quantity').val();
        var purchase_total = $("#purchase_total").val();
        $.ajax({
            url: '<?php echo base_url('purchase/add_temprory_purchase'); ?>',
            method:'post',
            data:{'product_id':product_id,'purchase_rate':purchase_rate,'purchase_quantity':purchase_quantity,'purchase_total':purchase_total}
        }).done(function(response){
            var res = $.parseJSON(response);
            if(res.result=='success'){
                $('.listings').empty();
                $('.listings').append(res.listings);
                $("#purchase_product").val('');
                $("#purchase_brand").val('');
                $("#purchase_quantity").val('');
                $("#purchase_rate").val('');
                $("#purchase_total").val('');
            }else{
                $('.listings').empty();
                $("#purchase_product").val('');
                $("#purchase_brand").val('');
                $("#purchase_quantity").val('');
                $("#purchase_rate").val('');
                $("#purchase_total").val('');
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
        $.ajax({
            url: '<?php echo base_url('purchase/add_temprory_purchase'); ?>',
            method:'post',
            data:{'product_id':product_id,'purchase_rate':purchase_rate,'purchase_quantity':purchase_quantity,'tax_id':tax_id,'tax_total':tax_total,'purchase_total':purchase_total}
        }).done(function(response){
            var res = $.parseJSON(response);
            if(res.result=='success'){
                $('.listings').empty();
                $('.listings').append(res.listings);
                $("#purchase_product").val('');
                $("#purchase_brand").val('');
                $("#purchase_quantity").val('');
                $("#purchase_rate").val('');
                $("#purchase_total").val('');
            }else{
                $('.listings').empty();
                $("#purchase_product").val('');
                $("#purchase_brand").val('');
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
            }else{
                $('.listings').empty();
                $("#purchase_dc_product").val('');
                $("#purchase_dc_brand").val('');
                $("#purchase_dc_quantity").val('');
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
</script>
</body>
</html>