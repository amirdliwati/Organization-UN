<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use File;
use PDF;
use Carbon\Carbon;
use App\User;
use App\Models\{Receiving_scholarship,Receiving_aid,Project,Family_book};


class ExportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

	public function ExportScholarships(Request $Request)
    {
        $perm = Auth::user()->role->permissions->where('title','Reports');
        if ($perm != '[]') 
            {   
                
                $Receiving_scholarship = Receiving_scholarship::find($Request->input('Receiving_scholarship_id'));
                $Receiving_scholarships = Receiving_scholarship::where('date',$Receiving_scholarship->date)->where('number',$Receiving_scholarship->number)->get();
                    
                $this->InitinalHeaderFooter();
                $this->InitinalPDF();
                foreach ($Receiving_scholarships as $key => $GetReceiving_scholarship) {
                    if ($Request->input('status'.$GetReceiving_scholarship->family_book->id) == 'on'){
                        PDF::AddPage('L','A5');
                        $this->GeneralInfoScholarship($GetReceiving_scholarship->id);
                    }
                }

                $this->EndPDF();
            }

        else{return view('public/404');} 
        
    }

    public function ExportAid(Request $Request)
    {
        $perm = Auth::user()->role->permissions->where('title','Reports');
        if ($perm != '[]') 
            {   
                $Receiving_aid = Receiving_aid::find($Request->input('Receiving_aid_id'));
                $Receiving_aids = Receiving_aid::where('date',$Receiving_aid->date)->where('number',$Receiving_aid->number)->get();
                    
                $this->InitinalHeaderFooter();
                $this->InitinalPDF();
                foreach ($Receiving_aids as $key => $GetReceiving_aid) {
                    if ($Request->input('status'.$GetReceiving_aid->family_book->id) == 'on'){
                        PDF::AddPage('L','A5');
                        $this->GeneralInfoAid($GetReceiving_aid->id);
                    }
                }

                $this->EndPDF();
            }

        else{return view('public/404');} 
        
    }

    public function InitinalHeaderFooter(){
        // help for programming
        // writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true) 
        // Custom Header
        PDF::setHeaderCallback(function($pdf) {

            // get the current page break margin
            $bMargin = $pdf->getBreakMargin();
            // disable auto-page-break
            $pdf->SetAutoPageBreak(false, 0);
            // set bacground image
            $pdf->Image(public_path('templates/template1.PNG'), 0, 0, 210, 148, '', '', '', false, 300, '', false, false, 0);
            // restore auto-page-break status
            //$pdf->SetAutoPageBreak(TRUE, $bMargin);
            // set the starting point for the page content
            $pdf->setPageMark();

        });

        // Custom Footer
        PDF::setFooterCallback(function($pdf) {
            // Position at 15 mm from bottom
            //$pdf->SetY(-8);
        });
    }

    public function InitinalPDF(){

        // set document information
        PDF::SetTitle('export');
        
        // set default monospaced font
        PDF::SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        PDF::SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        PDF::SetHeaderMargin(0);
        PDF::SetFooterMargin(0);

        // set auto page breaks
        PDF::SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        //PDF::SetAutoPageBreak(FALSE, 0);

        // set image scale factor
        PDF::setImageScale(PDF_IMAGE_SCALE_RATIO);

        // Set Protection File
        //PDF::SetProtection(array('modify','copy'), 'Password', null, 0, null);
        PDF::SetProtection(array('modify','copy'), '', null, 0, null);

        // set some language dependent data:
        $lg = Array();
        $lg['a_meta_charset'] = 'UTF-8';
        $lg['a_meta_dir'] = 'rtl';
        $lg['a_meta_language'] = 'fa';
        $lg['w_page'] = 'page';

        // set some language-dependent strings (optional)
        PDF::setLanguageArray($lg);

        // ---------------------------------------------------------

        // set font
        PDF::SetFont('dejavusans', '', 13);

        // writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)
    }

    public function GeneralInfoScholarship($IdScholarship){
        $Receiving_scholarship = Receiving_scholarship::find($IdScholarship);

        //$date = '<strong style="font-size: 15px; color: #5d38de;">'.Carbon::parse(Carbon::now()).'</strong>';
        //PDF::writeHTMLCell(60, '', 130,50, $date, 0,1, 0, true, 'C', true);

        $project = '<strong style="font-size: 13px;">'.Project::find(1)->name.'</strong>';
        PDF::writeHTMLCell(170, '', 20,64, $project, 0,1, 0, true, 'C', true);

        $serial_number = '<strong style="font-size: 15px; color: #5d38de;">'.$Receiving_scholarship->serial_number.'</strong>';
        PDF::writeHTMLCell(60, '', 20,50, $serial_number, 0,1, 0, true, 'C', true);

        $name = '<strong style="font-size: 13px;">'.$Receiving_scholarship->family_book->first_name.' '.$Receiving_scholarship->family_book->last_name.'</strong>';
        PDF::writeHTMLCell(75, '', 32,72, $name, 0,0, 0, true, 'C', true);

        $national_id = '<strong style="font-size: 13px;">'.$Receiving_scholarship->family_book->national_id.'</strong>';
        PDF::writeHTMLCell(45, '', 145,72, $national_id, 0,0, 0, true, 'C', true);

        $items = '<style>
                    table tr td {
                      border: 1px solid black;
                    }
                </style>
                <table><tbody>
                <tr>
                    <th style="width: 50px;"> # </th>
                    <th style="width: 420px;">المواد المسلمة </th>
                    <th style="width: 120px;">الوحدة</th>
                    <th style="width: 90px;">الكمية</th>
                </tr>';
        foreach ($Receiving_scholarship->receiving_scholarship_details as $key => $receiving_scholarship_detail) {
                $num = (int)$key + 1;
            $items .='<tr>
                        <td style="width: 50px;">'.$num.'</td>
                        <td style="width: 415px;">'.$receiving_scholarship_detail->item.'</td>
                        <td style="width: 120px;">'.$receiving_scholarship_detail->measuring_unit->name.'</td>
                        <td style="width: 90px;">'.$receiving_scholarship_detail->quantity.'</td></tr>';
        }
        $items .='</tbody></table>';
        PDF::writeHTMLCell(195, '', 5,85, $items, 0,0, 0, true, 'C', true);

        $employee_name = '<strong style="font-size: 13px;">'.$Receiving_scholarship->employee_name.'</strong>';
        PDF::writeHTMLCell(65, '', 40,137, $employee_name, 0,0, 0, true, 'R', true);

        $name2 = '<strong style="font-size: 13px;">'.$Receiving_scholarship->family_book->first_name.' '.$Receiving_scholarship->family_book->last_name.'</strong>';
        PDF::writeHTMLCell(65, '', 135,137, $name2, 0,0, 0, true, 'R', true);
    }

    public function GeneralInfoAid($IdAid){
        $Receiving_aid = Receiving_aid::find($IdAid);

        //$date = '<strong style="font-size: 15px; color: #5d38de;">'.Carbon::parse(Carbon::now()).'</strong>';
        //PDF::writeHTMLCell(60, '', 130,50, $date, 0,1, 0, true, 'C', true);

        $project = '<strong style="font-size: 13px;">'.Project::find(1)->name.'</strong>';
        PDF::writeHTMLCell(170, '', 20,64, $project, 0,1, 0, true, 'C', true);

        $serial_number = '<strong style="font-size: 15px; color: #5d38de;">'.$Receiving_aid->serial_number.'</strong>';
        PDF::writeHTMLCell(60, '', 20,50, $serial_number, 0,1, 0, true, 'C', true);

        $name = '<strong style="font-size: 13px;">'.$Receiving_aid->family_book->first_name.' '.$Receiving_aid->family_book->last_name.'</strong>';
        PDF::writeHTMLCell(75, '', 32,72, $name, 0,0, 0, true, 'C', true);

        $national_id = '<strong style="font-size: 13px;">'.$Receiving_aid->family_book->national_id.'</strong>';
        PDF::writeHTMLCell(45, '', 145,72, $national_id, 0,0, 0, true, 'C', true);

        $items = '<style>
                    table tr td {
                      border: 1px solid black;
                    }
                </style>
                <table><tbody>
                <tr>
                    <th style="width: 50px;"> # </th>
                    <th style="width: 420px;">المواد المسلمة </th>
                    <th style="width: 120px;">الوحدة</th>
                    <th style="width: 90px;">الكمية</th>
                </tr>';
        foreach ($Receiving_aid->receiving_aid_details as $key => $receiving_aid_detail) {
                $num = (int)$key + 1;
            $items .='<tr>
                        <td style="width: 50px;">'.$num.'</td>
                        <td style="width: 415px;">'.$receiving_aid_detail->item.'</td>
                        <td style="width: 120px;">'.$receiving_aid_detail->measuring_unit->name.'</td>
                        <td style="width: 90px;">'.$receiving_aid_detail->quantity.'</td></tr>';
        }
        $items .='</tbody></table>';
        PDF::writeHTMLCell(195, '', 5,85, $items, 0,0, 0, true, 'C', true);

        $employee_name = '<strong style="font-size: 13px;">'.$Receiving_aid->employee_name.'</strong>';
        PDF::writeHTMLCell(65, '', 40,137, $employee_name, 0,0, 0, true, 'R', true);

        $name2 = '<strong style="font-size: 13px;">'.$Receiving_aid->family_book->first_name.' '.$Receiving_aid->family_book->last_name.'</strong>';
        PDF::writeHTMLCell(65, '', 135,137, $name2, 0,0, 0, true, 'R', true);
    }

    public function EndPDF(){
        // reset pointer to the last page
        PDF::lastPage();

        // ---------------------------------------------------------

        //Close and output PDF document
        PDF::Output('export.pdf', 'I');

        //============================================================+
        // END OF FILE
        //============================================================+
    }

}