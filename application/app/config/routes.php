<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'user';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//Login
$route['login']				=	'user';
$route['forget_password']	=	'user/forget_password';
$route['dashboard']			= 	'user/dashboard';
$route['logout']			=	'user/logout';

//Products
$route['new_product']			=	'products/new_product';
$route['product_list']			=	'products/product_list';
$route['product_edit/(:num)']	=	'products/product_edit/$1';
$route['product_delete/(:num)']	=	'products/product_delete/$1';

//Stock Inventory
$route['stock_list']				=	'stock/stock_list';
$route['stock_inward']				=	'stock/stock_inward';
$route['stock_adjustment']			=	'stock/stock_adjustment';
$route['stock_sheet_update']		=	'stock/stock_sheet_update';
$route['product_template_download']	=	'stock/product_template_download';
$route['stock_upload']				=	'stock/stock_upload';
$route['stock_inward_outward_details/(:num)']	= 'stock/stock_inward_outward_details/$1';
$route['stock_inward_list']				= 'stock/stock_inward_list';
$route['stock_adjustment_list']			= 'stock/stock_adjustment_list';

//Master
$route['company']							=	'masters/company';
$route['company_list']						=	'masters/company_list';
$route['company_edit/(:num)']				=	'masters/company_edit/$1';
$route['company_delete/(:num)']				=	'masters/company_delete/$1';
$route['new_customer']			 			=	'masters/new_customer';
$route['customer_list']			 			=	'masters/customer_list';
$route['customer_edit/(:num)']	 			=	'masters/customer_edit/$1';
$route['customer_delete/(:num)'] 			=	'masters/customer_delete/$1';
$route['new_supplier']						=	'masters/new_supplier';
$route['supplier_list']			 			= 	'masters/supplier_list';
$route['supplier_edit/(:num)']	 			=	'masters/supplier_edit/$1';
$route['supplier_delete/(:num)']			=	'masters/supplier_delete/$1';
$route['size']					 			=	'masters/size';
$route['size_list']				 			=	'masters/size_list';
$route['size_edit/(:num)']		 			=	'masters/size_edit/$1';
$route['size_delete/(:num)']				=	'masters/size_delete/$1';
$route['unit']								=	'masters/unit';
$route['unit_list']				 			=	'masters/unit_list';
$route['unit_edit/(:num)']		 			=	'masters/unit_edit/$1';
$route['unit_delete/(:num)']				=	'masters/unit_delete/$1';
$route['colour']				 			=	'masters/colour';
$route['colour_list']			 			=	'masters/colour_list';
$route['colour_edit/(:num)']	 			=	'masters/colour_edit/$1';
$route['colour_delete/(:num)']				=	'masters/colour_delete/$1';
$route['secondary_unit']					=	'masters/secondary_unit';
$route['secondary_unit_list']				=	'masters/secondary_unit_list';
$route['secondary_unit_edit/(:num)']		=	'masters/secondary_unit_edit/$1';
$route['secondary_unit_delete/(:num)']		=	'masters/secondary_unit_delete/$1';
$route['tax']					 			=	'masters/tax';
$route['tax_list']				 			=	'masters/tax_list';
$route['tax_edit/(:num)']		 			=	'masters/tax_edit/$1';
$route['tax_delete/(:num)']					=	'masters/tax_delete/$1';
$route['expenses_category']		 			=	'masters/expenses_category';
$route['expenses_category_list'] 			=	'masters/expenses_category_list';
$route['expenses_category_edit/(:num)'] 	=	'masters/expenses_category_edit/$1';
$route['expenses_category_delete/(:num)']	=	'masters/expenses_category_delete/$1';
$route['transport']							=	'masters/transport';
$route['transport_list']					=	'masters/transport_list';
$route['transport_edit/(:num)']				=	'masters/transport_edit/$1';
$route['transport_delete/(:num)']			=	'masters/transport_delete/$1';
$route['branch']							=	'masters/branch';
$route['branch_list']						=	'masters/branch_list';
$route['branch_edit/(:num)']				=	'masters/branch_edit/$1';
$route['branch_delete/(:num)']				=	'masters/branch_delete/$1';
$route['brand']								=	'masters/brand';
$route['brand_list']						=	'masters/brand_list';
$route['brand_edit/(:num)']					=	'masters/brand_edit/$1';
$route['brand_delete/(:num)']				=	'masters/brand_delete/$1';
$route['category']							=	'masters/category';
$route['category_list']						=	'masters/category_list';
$route['category_edit/(:num)']				=	'masters/category_edit/$1';
$route['category_delete/(:num)']			=	'masters/category_delete/$1';
$route['sub_category']						=	'masters/sub_category';
$route['sub_category_list']					=	'masters/sub_category_list';
$route['sub_category_edit/(:num)']			=	'masters/sub_category_edit/$1';
$route['sub_category_delete/(:num)']		=	'masters/sub_category_delete/$1';
$route['prefix']							=	'masters/prefix';
$route['sub_module']						=	'masters/sub_module';
$route['sub_module_list']					=	'masters/sub_module_list';
$route['sub_module_edit/(:num)']			=	'masters/sub_module_edit/$1';
$route['sub_module_delete/(:num)']			=	'masters/sub_module_delete/$1';
$route['sales_person']						=	'masters/sales_person';
$route['sales_person_list']					=	'masters/sales_person_list';
$route['sales_person_edit/(:num)']			=	'masters/sales_person_edit/$1';
$route['sales_person_delete/(:num)']		=	'masters/sales_person_delete/$1';
//PRODUCT TYPE
$route['product_type']						=	'masters/product_type';
$route['product_type_list']					=	'masters/product_type_list';
$route['product_type_edit/(:num)']			=	'masters/product_type_edit/$1';
$route['product_type_delete/(:num)']		=	'masters/product_type_delete/$1';

//ACCESS LEVEL
$route['access_level_list']					= 'masters/access_level_list';
$route['access_level']						= 'masters/access_level';
$route['access_level_block/(:num)']			= 'masters/access_level_block/$1';
$route['access_level_unblock/(:num)']		= 'masters/access_level_unblock/$1';
$route['access_level_update/(:num)']		= 'masters/access_level_update/$1';
$route['access_level_remove/(:num)']		= 'masters/access_level_remove/$1';

//EXPENSES
$route['expense'] 							= 'expenses/expense';
$route['expenses_list'] 					= 'expenses/expenses_list';
$route['expense_paid/(:any)'] 				= 'expenses/expense_paid/$1';
$route['expense_edit/(:any)'] 				= 'expenses/expense_edit/$1';
$route['expense_view/(:any)'] 				= 'expenses/expense_view/$1';
$route['expense_print/(:any)'] 				= 'expenses/expense_print/$1';
$route['expense_remove/(:any)'] 			= 'expenses/expense_remove/$1';
$route['expense_download/(:any)'] 			= 'expenses/expense_download/$1';

//USER ACCESS RIGHTS
$route['user_list']					= 	'user/user_list';
$route['new_user']				    = 	'user/new_user'; 
$route['user_remove/(:any)']		= 	'user/user_remove/$1';
$route['user_edit/(:any)']			= 	'user/user_edit/$1';

//Settings

$route['branch_settings']		=	'settings/branch_settings';
$route['user_settings']			=	'settings/user_settings';
$route['report_settings']		=	'settings/report_settings';
$route['payment_settings']		=	'settings/payment_settings';
$route['estimate_settings']		=	'settings/estimate_settings';
$route['prefix_settings']		=	'settings/prefix_settings';
$route['tax_settings']			=	'settings/tax_settings';
$route['invoice_settings']		=	'settings/invoice_settings';
$route['dc_settings']			=	'settings/dc_settings';

$route['module_settings']		=	'settings/module_settings';
$route['sub_module_settings']	=	'settings/sub_module_settings';
$route['extra_settings']		=	'settings/extra_settings';
$route['invoice_settings']		=	'settings/invoice_settings';
$route['general_settings']		=	'settings/general_settings';
$route['quotation_settings']	=	'settings/quotation_settings';
$route['purchase_settings']		=	'settings/purchase_settings';
$route['product_settings']		=	'settings/product_settings';


//PURCHASE ORDER
$route['purchase_order_list']			=	'purchase_order/purchase_order_list';
$route['purchase_order']				=	'purchase_order/purchase_order';
$route['purchase_order_view/(:num)']	=	'purchase_order/purchase_order_view/$1';
$route['purchase_order_edit/(:num)']	=	'purchase_order/purchase_order_edit/$1';
$route['purchase_order_remove/(:num)']	=	'purchase_order/purchase_order_remove/$1';
$route['purchase_order_download/(:num)']=	'purchase_order/purchase_order_download/$1';
$route['purchase_order_print/(:num)']	=	'purchase_order/purchase_order_print/$1';
$route['purchase_order_mail/(:num)']	=	'purchase_order/purchase_order_mail/$1';

//PURCHASE 
$route['purchase_list']					=	'purchase/purchase_list';
$route['purchase']						=	'purchase/purchase';
$route['purchase_view/(:num)']			=	'purchase/purchase_view/$1';
$route['purchase_edit/(:num)']			=	'purchase/purchase_edit/$1';
$route['purchase_remove/(:num)']		=	'purchase/purchase_remove/$1';
$route['purchase_print/(:num)']			=	'purchase/purchase_print/$1';
$route['purchase_download/(:num)']		=	'purchase/purchase_download/$1';
$route['change_purchase_setting/(:any)']= 	'purchase/change_purchase_setting/$1';

//PURCHASE DC
$route['purchase_dc_list']				=	'purchase_dc/purchase_dc_list';
$route['purchase_dc']					=	'purchase_dc/purchase_dc';
$route['purchase_dc_remove/(:num)']		=	'purchase_dc/purchase_dc_remove/$1';
$route['purchase_dc_view/(:num)']		=	'purchase_dc/purchase_dc_view/$1';
$route['purchase_dc_edit/(:num)']		=	'purchase_dc/purchase_dc_edit/$1';
$route['purchase_dc_print/(:num)']		=	'purchase_dc/purchase_dc_print/$1';
$route['purchase_dc_download/(:num)']	=	'purchase_dc/purchase_dc_download/$1';

// PURCHASE RETURN
$route['purchase_return']					= 'purchase_return/purchase_return';
$route['purchase_return_list']				= 'purchase_return/purchase_return_list';
$route['purchase_return_view/(:any)']		= 'purchase_return/purchase_return_view/$1';
$route['purchase_return_edit/(:any)']		= 'purchase_return/purchase_return_edit/$1';
$route['purchase_return_print/(:any)']		= 'purchase_return/purchase_return_print/$1';
$route['purchase_return_delete/(:any)']		= 'purchase_return/purchase_return_delete/$1';
$route['purchase_return_download/(:any)']	= 'purchase_return/purchase_return_download/$1';
$route['purchase_return_status_change/(:any)']	= 'purchase_return/purchase_return_status_change/$1';

//PURCHASE PAYMENTS
$route['purchase_payment_list']					=	'payments/purchase_payment_list';
$route['purchase_payments_bill_details/(:any)']	=	'payments/purchase_payments_bill_details/$1';
$route['add_payment_bills']						=	'payments/add_payment_bills';

// QUOTATION
$route['quotation']							= 'quotation/quotation';
$route['quotation_list']					= 'quotation/quotation_list';
$route['quotation_edit/(:any)']				= 'quotation/quotation_edit/$1';
$route['quotation_view/(:any)']				= 'quotation/quotation_view/$1';
$route['quotation_remove/(:any)']			= 'quotation/quotation_remove/$1';
$route['quotation_print/(:any)']			= 'quotation/quotation_print/$1';
$route['quotation_download/(:any)']			= 'quotation/quotation_download/$1';
$route['qt_generate_dc/(:any)']				= 'quotation/qt_generate_dc/$1';

//QUOTATION PAYMENT
$route['quotation_payment_list']				='quotation/quotation_payment_list';
$route['quotation_payments_bill_details/(:any)']='quotation/quotation_payments_bill_details/$1';
$route['add_quotation_payment_bills']			='quotation/add_quotation_payment_bills';

// DC
$route['dc']								= 'dc/dc';
$route['dc_list']							= 'dc/dc_list';
$route['dc_edit/(:any)']					= 'dc/dc_edit/$1';
$route['dc_view/(:any)']					= 'dc/dc_view/$1';
$route['dc_print/(:any)']					= 'dc/dc_print/$1';
$route['dc_download/(:any)']				= 'dc/dc_download/$1';
$route['dc_delete/(:any)']					= 'dc/dc_delete/$1';
$route['dc_approve/(:any)']					= 'dc/dc_approve/$1';
$route['dc_complete/(:any)']				= 'dc/dc_complete/$1';

// ESTIMATE
$route['estimate']							= 'estimate/estimate';
$route['estimate_list']						= 'estimate/estimate_list';
$route['estimate_edit/(:any)']				= 'estimate/estimate_edit/$1';
$route['estimate_view/(:any)']				= 'estimate/estimate_view/$1';
$route['estimate_remove/(:any)']			= 'estimate/estimate_remove/$1';
$route['estimate_print/(:any)']				= 'estimate/estimate_print/$1';
$route['estimate_download/(:any)']			= 'estimate/estimate_download/$1';
$route['estimate_generate_dc/(:any)']		= 'estimate/estimate_generate_dc/$1';
$route['change_estimate_setting/(:any)']	= 'estimate/change_estimate_setting/$1';

//ESTIMATE PAYMENT
$route['estimate_payment_list']				   ='estimate/estimate_payment_list';
$route['estimate_payments_bill_details/(:any)']='estimate/estimate_payments_bill_details/$1';
$route['add_estimate_payment_bills']		   ='estimate/add_estimate_payment_bills';

// INVOICE
$route['invoice']							= 'invoice/invoice';
$route['invoice_list']						= 'invoice/invoice_list';
$route['invoice_edit/(:any)']				= 'invoice/invoice_edit/$1';
$route['invoice_view/(:any)']				= 'invoice/invoice_view/$1';
$route['invoice_remove/(:any)']				= 'invoice/invoice_remove/$1';
$route['invoice_print/(:any)']				= 'invoice/invoice_print/$1';
$route['invoice_download/(:any)']			= 'invoice/invoice_download/$1';
$route['invoice_generate_dc/(:any)']		= 'invoice/invoice_generate_dc/$1';
$route['change_invoice_setting/(:any)']	= 'invoice/change_invoice_setting/$1';

//invoice PAYMENT
$route['invoice_payment_list']					='invoice/invoice_payment_list';
$route['invoice_payments_bill_details/(:any)']	='invoice/invoice_payments_bill_details/$1';
$route['add_invoice_payment_bills']			    ='invoice/add_invoice_payment_bills';

// SALES RETURN
$route['sales_return']					= 'sales_return/sales_return';
$route['sales_return_list']				= 'sales_return/sales_return_list';
$route['sales_return_view/(:any)']		= 'sales_return/sales_return_view/$1';
$route['sales_return_edit/(:any)']		= 'sales_return/sales_return_edit/$1';
$route['sales_return_print/(:any)']		= 'sales_return/sales_return_print/$1';
$route['sales_return_delete/(:any)']	= 'sales_return/sales_return_delete/$1';
$route['sales_return_download/(:any)']	= 'sales_return/sales_return_download/$1';
$route['sales_return_status_change/(:any)']	= 'sales_return/sales_return_status_change/$1';

//LOG DETAILS
$route['logs']							= 'logs';
$route['log_details/(:any)']			= 'logs/log_details/$1';
$route['change_log_status/(:any)']		= 'logs/change_log_status/$1';

//REPORT
$route['customer_report']				=	'reports/customer_report';
$route['supplier_report']				=	'reports/supplier_report';
$route['sales_gst_reports']				=	'reports/sales_gst_reports';
$route['purchase_gst_reports']			=	'reports/purchase_gst_reports';
$route['sales_person_based_report']		=	'reports/sales_person_based_report';
$route['product_report']				=	'reports/product_report';
$route['hsncode_report']				=	'reports/hsncode_report';
$route['day_report']					=	'reports/day_report';
//ACCOUNTS MODULE REPORT
$route['receipt_reports']				=	'reports/receipt_reports';
$route['payment_reports']				=	'reports/payment_reports';

//BUYERS PO EXCEL UPLOAD
$route['buyers_po_excel_upload']					=	'buyers_po/buyers_po_excel_upload';
$route['buyers_po_excel_list']						=	'buyers_po/buyers_po_excel_list';
$route['buyers_po_excel_view/(:any)']				=	'buyers_po/buyers_po_excel_view/$1';
$route['buyers_po_excel_print/(:any)']				=	'buyers_po/buyers_po_excel_print/$1';
$route['buyers_po_convert_into_quotation/(:any)']	=	'buyers_po/buyers_po_convert_into_quotation/$1';

// ACCOUNTS
$route['sales_receipt_list']				= 'accounts/sales_receipt_list';
$route['sales_receipt']						= 'accounts/sales_receipt';
$route['sales_receipt_view/(:any)']			= 'accounts/sales_receipt_view/$1';
$route['sales_receipt_edit/(:any)']			= 'accounts/sales_receipt_edit/$1';
$route['sales_receipt_remove/(:any)']		= 'accounts/sales_receipt_remove/$1';
$route['sales_receipt_voucher/(:any)']		= 'accounts/sales_receipt_voucher/$1';
$route['sales_receipts_voucher_print/(:any)']= 'accounts/sales_receipt_voucher_print/$1';

$route['purchase_payments_list']			= 'accounts/purchase_payments_list';
$route['purchase_payments']					= 'accounts/purchase_payments';
$route['purchase_payments_view/(:any)']		= 'accounts/purchase_payments_view/$1';
$route['purchase_payments_voucher/(:any)']	= 'accounts/purchase_payments_voucher/$1';
$route['purchase_payments_voucher_print/(:any)']= 'accounts/purchase_payments_voucher_print/$1';
$route['purchase_payments_edit/(:any)']		= 'accounts/purchase_payments_edit/$1';
$route['purchase_payments_remove/(:any)']	= 'accounts/purchase_payments_remove/$1';

$route['journal_list']						= 'accounts/journal_list';
$route['journal']							= 'accounts/journal';
$route['journal_view/(:any)']				= 'accounts/journal_view/$1';
$route['journal_edit/(:any)']				= 'accounts/journal_edit/$1';
$route['journal_remove/(:any)']				= 'accounts/journal_remove/$1';



