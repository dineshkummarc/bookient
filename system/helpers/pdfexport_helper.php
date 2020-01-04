<?php 


if ( ! function_exists('exportMeAsDOMPDF'))
{
         function exportMeAsDOMPDF($htmView,$fileName) {

                    $CI =& get_instance();
                    $CI->load->helper(array('dompdf', 'file'));
                    $CI->load->helper('file');
                    $pdfName = $fileName;
                    $pdfData = pdf_create($htmView, $pdfName);
                    write_file('Progress Repost', $pdfData);   
        }
}

?>