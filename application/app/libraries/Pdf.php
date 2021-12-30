<?php

class Pdf {

    function Pdf() {
        $CI = & get_instance();
        log_message('Debug', 'mPDF class is loaded.');
    }

    function load($param = NULL) {
        require_once APPPATH .'third_party/mpdf/mpdf.php';

        if ($param == NULL) {
            $param = "'utf-8','A5','','','','','','','','','landscape'";
        }
        return new mPDF($param);
    }
    function qrcode($param = NULL) {
        require_once APPPATH .'third_party/mpdf/mpdf.php';
        return new mPDF('utf-8','QR','','','','','','','','','landscape');
    }
    function barcode($param = NULL) {
        require_once APPPATH .'third_party/mpdf/mpdf.php';
        return new mPDF('utf-8','BAR','','','','','','','','','landscape');
    }

}