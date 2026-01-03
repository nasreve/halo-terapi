<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class DemoPdfController extends Controller
{
    public function index()
    {
        $wkwk = "wkwk";
        $pdf = PDF::loadView('visitor.patient.order-history.invoice-download');
        // $pdf = PDF::setOptions(
        //     ['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]
        // );
        $pdf->getDomPDF()->setHttpContext(
            stream_context_create([
                'ssl' => [
                    'allow_self_signed' => TRUE,
                    'verify_peer'       => FALSE,
                    'verify_peer_name'  => FALSE,
                ]
            ])
        );

        return $pdf->download('INVOICE - HT201206003.pdf');
    }
}
