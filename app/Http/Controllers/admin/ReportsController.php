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
use Carbon\Carbon;
use PDF;
use DB;
use App\User;
use App\Models\{Family_book,Visit,Children,Wive,Receiving_aid};


class ReportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function ViewCPDRReport(Request $Request)
    {
        $perm = Auth::user()->role->permissions->where('title','Reports');
        if ($perm != '[]') 
            {   
                $Receiving_aids = Receiving_aid::select('id', 'date', 'number')->groupBy('date')->get();
                $arr = array('Receiving_aids' => $Receiving_aids);
                return view('admin/reports/ViewCPDRReport',$arr);
            }

        else{return view('public/404');} 
        
    }

    public function CPDRReport(Request $Request)
    {
        $perm = Auth::user()->role->permissions->where('title','Reports');
        if ($perm != '[]') 
            {   
                $this->InitinalHeaderFooter();
                $this->InitinalPDF();
                $this->GeneralInfo($Request->date , $Request->number);
                $this->EndPDF();
            }

        else{return view('public/404');} 
        
    }

    public function ViewReport3(Request $Request)
    {
        $perm = Auth::user()->role->permissions->where('title','Reports');
        if ($perm != '[]') 
            {   
                $Visits = Visit::all();
                $arr = array('Visits' => $Visits); 
                return view('admin/reports/ViewReport3',$arr);
            }

        else{return view('public/404');} 
        
    }

    public function ViewPhoneNumber(Request $Request)
    {
        $perm = Auth::user()->role->permissions->where('title','Reports');
        if ($perm != '[]') 
            {   
                $Family_books = Family_book::where('status_from_organization','مقبول')->get();
                $arr = array('Family_books' => $Family_books); 
                return view('admin/reports/ViewPhoneNumber',$arr);
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
            $pdf->Image(public_path('templates/cpdr.jpg'), 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
            // restore auto-page-break status
            //$pdf->SetAutoPageBreak(TRUE, $bMargin);
            // set the starting point for the page content
            $pdf->setPageMark();

            //$logo = '<img src="templates/WFP_logo.png" width="75">';
            //PDF::writeHTMLCell(20, '', 180, 3,$logo, 0, 0, 0, true, 'C', true);
            //$logo = '<img src="templates/logo-sm.png" width="75">';
            //PDF::writeHTMLCell(20, '', 10, 3,$logo, 0, 0, 0, true, 'C', true);

        });

        // Custom Footer
        PDF::setFooterCallback(function($pdf) {
            // Position at 15 mm from bottom
            //$pdf->SetY(-8);
        });
    }

    public function InitinalPDF(){

        // set document information
        PDF::SetTitle('Report_CPDR_'.Carbon::now()->format('d/m/yy'));
        
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
        //PDF::SetProtection(array('modify','copy'), '', null, 0, null);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
            require_once(dirname(__FILE__).'/lang/eng.php');
            PDF::setLanguageArray($l);
        }

        // ---------------------------------------------------------

        // set font
        PDF::SetFont('freeserifbi', '', 10);

        // writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

        PDF::AddPage('P','A4');
    }

    public function GeneralInfo($date , $number){

        $info = '<table style="border-collapse: collapse;" border="1"><tbody>
                <tr>
                    <td colspan="12">1. General Information</td>
                </tr>
                <tr>
                    <td colspan="2">Activity</td>
                    <td colspan="4">Livelihood - Asset creation and livelihood support activities</td>
                    <td colspan="2">CSP</td>
                    <td colspan="4">SY02</td>
                </tr>
                <tr>
                    <td colspan="2">Cooperating Partner</td>
                    <td colspan="10">Fouadi - The Foundation of Advancing Development Integration</td>
                </tr>
                <tr>
                    <td colspan="2">Reporting Period</td>
                    <td colspan="4">'.Carbon::parse(Carbon::now())->format('F').'</td>
                    <td colspan="2">Feeding days</td>
                    <td colspan="4">30</td>
                </tr>
                <tr>
                    <td colspan="2">Location(s)</td>
                    <td colspan="10">Syria - Aleppo - As-safira</td>
                </tr>
                </tbody></table><br><br>';
        PDF::writeHTMLCell(200, '', 5,50, $info, 0,1, 0, true, 'C', true);

        $Family_books = Family_book::where('status_from_organization','مقبول')->get();

        $y1 = Receiving_aid::join('family_books','family_books.id' , '=', 'receiving_aids.family_books_id')->where('family_books.status_from_organization','مقبول')->where('family_books.gender_participant','ذكر')->whereBetween('family_books.age_years',['18','59'])->where('receiving_aids.date',$date)->count();
        $y2 = Receiving_aid::join('family_books','family_books.id' , '=', 'receiving_aids.family_books_id')->where('family_books.status_from_organization','مقبول')->where('family_books.gender_participant','أنثى')->whereBetween('family_books.age_years',['18','59'])->where('receiving_aids.date',$date)->count();
        $y1111 = Receiving_aid::join('family_books','family_books.id' , '=', 'receiving_aids.family_books_id')->where('family_books.status_from_organization','مقبول')->where('family_books.gender_participant','ذكر')->where('family_books.age_years','>',59)->where('receiving_aids.date',$date)->count();
        $y2222 = Receiving_aid::join('family_books','family_books.id' , '=', 'receiving_aids.family_books_id')->where('family_books.status_from_organization','مقبول')->where('family_books.gender_participant','أنثى')->where('family_books.age_years','>',59)->where('receiving_aids.date',$date)->count();
        $y11111 = Receiving_aid::join('family_books','family_books.id' , '=', 'receiving_aids.family_books_id')->where('family_books.status_from_organization','مقبول')->where('family_books.gender_participant','ذكر')->where('family_books.age_years','<',18)->where('receiving_aids.date',$date)->count();
        $y22222 = Receiving_aid::join('family_books','family_books.id' , '=', 'receiving_aids.family_books_id')->where('family_books.status_from_organization','مقبول')->where('family_books.gender_participant','أنثى')->where('family_books.age_years','<',18)->where('receiving_aids.date',$date)->count();
        $ry1 = $y1 + $y2 ;
        $ry1111 = $y1111 + $y2222 ;
        $ry11111 = $y11111 + $y22222 ;

        $result1 = $y1 + $y1111 + $y11111 ;
        $result2 = $y2 + $y2222 + $y22222 ;
        $result3 = $ry1 + $ry1111 + $ry11111 ;

        $y3 = Receiving_aid::join('family_books','family_books.id' , '=', 'receiving_aids.family_books_id')->where('family_books.status_from_organization','مقبول')->where('family_books.gender_participant','ذكر')->where('family_books.residence_status_id',4)->whereBetween('family_books.age_years',['18','59'])->where('receiving_aids.date',$date)->count();
        $y4 = Receiving_aid::join('family_books','family_books.id' , '=', 'receiving_aids.family_books_id')->where('family_books.status_from_organization','مقبول')->where('family_books.gender_participant','ذكر')->where('family_books.residence_status_id',1)->whereBetween('family_books.age_years',['18','59'])->where('receiving_aids.date',$date)->count();
        $y5 = Receiving_aid::join('family_books','family_books.id' , '=', 'receiving_aids.family_books_id')->where('family_books.status_from_organization','مقبول')->where('family_books.gender_participant','ذكر')->where('family_books.residence_status_id',2)->whereBetween('family_books.age_years',['18','59'])->where('receiving_aids.date',$date)->count();
        $y6 = Receiving_aid::join('family_books','family_books.id' , '=', 'receiving_aids.family_books_id')->where('family_books.status_from_organization','مقبول')->where('family_books.gender_participant','ذكر')->where('family_books.residence_status_id',3)->whereBetween('family_books.age_years',['18','59'])->where('receiving_aids.date',$date)->count();

        $y7 = Receiving_aid::join('family_books','family_books.id' , '=', 'receiving_aids.family_books_id')->where('family_books.status_from_organization','مقبول')->where('family_books.gender_participant','أنثى')->where('family_books.residence_status_id',4)->whereBetween('family_books.age_years',['18','59'])->where('receiving_aids.date',$date)->count();
        $y8 = Receiving_aid::join('family_books','family_books.id' , '=', 'receiving_aids.family_books_id')->where('family_books.status_from_organization','مقبول')->where('family_books.gender_participant','أنثى')->where('family_books.residence_status_id',1)->whereBetween('family_books.age_years',['18','59'])->where('receiving_aids.date',$date)->count();
        $y9 = Receiving_aid::join('family_books','family_books.id' , '=', 'receiving_aids.family_books_id')->where('family_books.status_from_organization','مقبول')->where('family_books.gender_participant','أنثى')->where('family_books.residence_status_id',2)->whereBetween('family_books.age_years',['18','59'])->where('receiving_aids.date',$date)->count();
        $y10 = Receiving_aid::join('family_books','family_books.id' , '=', 'receiving_aids.family_books_id')->where('family_books.status_from_organization','مقبول')->where('family_books.gender_participant','أنثى')->where('family_books.residence_status_id',3)->whereBetween('family_books.age_years',['18','59'])->where('receiving_aids.date',$date)->count();
        $ry2 = $y3 + $y7 ;
        $ry3 = $y4 + $y8 ;
        $ry4 = $y5 + $y9 ;
        $ry5 = $y6 + $y10 ;

        $table1 = '<table style="border-collapse: collapse;" border="1"><tbody>
                    <tr>
                        <td colspan="12">2. Number of Beneficiaries</td>
                    </tr>
                    <tr>
                        <td rowspan="2">Participants group</td>
                        <td colspan="3">Total Participants</td>
                        <td colspan="3">New Participants (out of Total)</td>
                        <td colspan="5">Resident Status (percentage or figures)</td>
                    </tr>
                    <tr>
                        <td>Male</td>
                        <td>Female</td>
                        <td>Tota</td>
                        <td>Male</td>
                        <td>Female</td>
                        <td>Total</td>
                        <td>-</td>
                        <td>Resident</td>
                        <td>Refugees</td>
                        <td>Returnees</td>
                        <td>IDPs</td>
                    </tr>
                    <tr>
                        <td >Adult (18-59 yrs)</td>
                        <td >'.$y1.'</td>
                        <td >'.$y2.'</td>
                        <td >'.$ry1.'</td>
                        <td >-</td>
                        <td >-</td>
                        <td >-</td>
                        <td>Male</td>
                        <td>'.$y3.'</td>
                        <td>'.$y4.'</td>
                        <td>'.$y5.'</td>
                        <td>'.$y6.'</td>
                    </tr>
                    <tr>
                        <td >Adult ( >=60 yrs)</td>
                        <td >'.$y1111.'</td>
                        <td >'.$y2222.'</td>
                        <td >'.$ry1111.'</td>
                        <td >'.$y11111.'</td>
                        <td >'.$y22222.'</td>
                        <td >'.$ry11111.'</td>
                        <td>Female</td>
                        <td>'.$y7.'</td>
                        <td>'.$y8.'</td>
                        <td>'.$y9.'</td>
                        <td>'.$y10.'</td>
                    </tr>
                    <tr>
                        <td>Total</td>
                        <td>'.$result1.'</td>
                        <td>'.$result2.'</td>
                        <td>'.$result3.'</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>Total</td>
                        <td>'.$ry2.'</td>
                        <td>'.$ry3.'</td>
                        <td>'.$ry4.'</td>
                        <td>'.$ry5.'</td>
                    </tr>
                    </tbody></table><br><br>';
        PDF::writeHTMLCell(200, '', 5,'', $table1, 0,1, 0, true, 'C', true);

        /*$x1 = Family_book::join('receiving_aids','family_books.id' , '=', 'receiving_aids.family_books_id')->join('childrens','family_books.id' , '=', 'childrens.family_book_id')->where('receiving_aids.date',$date)->where('family_books.status_from_organization','مقبول')->where('childrens.gender','ذكر')->whereBetween('childrens.age_month',['0','23'])->count();

        $x2 = Family_book::join('receiving_aids','family_books.id' , '=', 'receiving_aids.family_books_id')->join('childrens','family_books.id' , '=', 'childrens.family_book_id')->where('receiving_aids.date',$date)->where('family_books.status_from_organization','مقبول')->where('childrens.gender','أنثى')->whereBetween('childrens.age_month',['0','23'])->count();*/

        $x1 = Family_book::join('receiving_aids','family_books.id' , '=', 'receiving_aids.family_books_id')->join('childrens','family_books.id' , '=', 'childrens.family_book_id')->where('receiving_aids.date',$date)->where('family_books.status_from_organization','مقبول')->where('childrens.gender','ذكر')->whereBetween('childrens.age_years',['0','2'])->count();

        $x2 = Family_book::join('receiving_aids','family_books.id' , '=', 'receiving_aids.family_books_id')->join('childrens','family_books.id' , '=', 'childrens.family_book_id')->where('receiving_aids.date',$date)->where('family_books.status_from_organization','مقبول')->where('childrens.gender','أنثى')->whereBetween('childrens.age_years',['0','2'])->count();
        $r1 = $x1+$x2;

        /*$x4 = Family_book::join('receiving_aids','family_books.id' , '=', 'receiving_aids.family_books_id')->join('childrens','family_books.id' , '=', 'childrens.family_book_id')->where('receiving_aids.date',$date)->where('family_books.status_from_organization','مقبول')->where('childrens.gender','ذكر')->whereBetween('childrens.age_month',['24','59'])->count();
        $x5 = Family_book::join('receiving_aids','family_books.id' , '=', 'receiving_aids.family_books_id')->join('childrens','family_books.id' , '=', 'childrens.family_book_id')->where('receiving_aids.date',$date)->where('family_books.status_from_organization','مقبول')->where('childrens.gender','أنثى')->whereBetween('childrens.age_month',['24','59'])->count();*/

        $x4 = Family_book::join('receiving_aids','family_books.id' , '=', 'receiving_aids.family_books_id')->join('childrens','family_books.id' , '=', 'childrens.family_book_id')->where('receiving_aids.date',$date)->where('family_books.status_from_organization','مقبول')->where('childrens.gender','ذكر')->whereBetween('childrens.age_years',['3','4'])->count();
        $x5 = Family_book::join('receiving_aids','family_books.id' , '=', 'receiving_aids.family_books_id')->join('childrens','family_books.id' , '=', 'childrens.family_book_id')->where('receiving_aids.date',$date)->where('family_books.status_from_organization','مقبول')->where('childrens.gender','أنثى')->whereBetween('childrens.age_years',['3','4'])->count();

        $r2 = $x4+$x5;

        $x7 = Family_book::join('receiving_aids','family_books.id' , '=', 'receiving_aids.family_books_id')->join('childrens','family_books.id' , '=', 'childrens.family_book_id')->where('receiving_aids.date',$date)->where('family_books.status_from_organization','مقبول')->where('childrens.gender','ذكر')->whereBetween('childrens.age_years',['5','11'])->count();
        $x8 = Family_book::join('receiving_aids','family_books.id' , '=', 'receiving_aids.family_books_id')->join('childrens','family_books.id' , '=', 'childrens.family_book_id')->where('receiving_aids.date',$date)->where('family_books.status_from_organization','مقبول')->where('childrens.gender','أنثى')->whereBetween('childrens.age_years',['5','11'])->count();

        $r3 = $x7+$x8;

        $x10 = Family_book::join('receiving_aids','family_books.id' , '=', 'receiving_aids.family_books_id')->join('childrens','family_books.id' , '=', 'childrens.family_book_id')->where('receiving_aids.date',$date)->where('family_books.status_from_organization','مقبول')->where('childrens.gender','ذكر')->whereBetween('childrens.age_years',['12','17'])->count();
        $x11 = Family_book::join('receiving_aids','family_books.id' , '=', 'receiving_aids.family_books_id')->join('childrens','family_books.id' , '=', 'childrens.family_book_id')->where('receiving_aids.date',$date)->where('family_books.status_from_organization','مقبول')->where('childrens.gender','أنثى')->whereBetween('childrens.age_years',['12','17'])->count();
        $x12 = Family_book::join('receiving_aids','family_books.id' , '=', 'receiving_aids.family_books_id')->join('wives','family_books.id' , '=', 'wives.family_book_id')->where('receiving_aids.date',$date)->where('family_books.status_from_organization','مقبول')->whereBetween('wives.age_years',['12','17'])->count();
        $x3 = Receiving_aid::join('family_books','family_books.id' , '=', 'receiving_aids.family_books_id')->where('family_books.status_from_organization','مقبول')->whereBetween('family_books.age_years_husband',['12','17'])->where('receiving_aids.date',$date)->count();

        $r4 = $x10+$x11+$x12+$x3;
        $x11 = $x11 + $x12;
        $x10 = $x10 + $x3;
        
        $x13 = Family_book::join('receiving_aids','family_books.id' , '=', 'receiving_aids.family_books_id')->join('childrens','family_books.id' , '=', 'childrens.family_book_id')->where('receiving_aids.date',$date)->where('family_books.status_from_organization','مقبول')->where('childrens.gender','ذكر')->whereBetween('childrens.age_years',['18','59'])->count();
        $x14 = Family_book::join('receiving_aids','family_books.id' , '=', 'receiving_aids.family_books_id')->join('childrens','family_books.id' , '=', 'childrens.family_book_id')->where('receiving_aids.date',$date)->where('family_books.status_from_organization','مقبول')->where('childrens.gender','أنثى')->whereBetween('childrens.age_years',['18','59'])->count();
        $x15 = Family_book::join('receiving_aids','family_books.id' , '=', 'receiving_aids.family_books_id')->join('wives','family_books.id' , '=', 'wives.family_book_id')->where('receiving_aids.date',$date)->where('family_books.status_from_organization','مقبول')->whereBetween('wives.age_years',['18','59'])->count();
        $x6 = Receiving_aid::join('family_books','family_books.id' , '=', 'receiving_aids.family_books_id')->where('family_books.status_from_organization','مقبول')->whereBetween('family_books.age_years_husband',['18','59'])->where('receiving_aids.date',$date)->count();

        $r5 = $x13+$x14+$x15+$x6;
        $x14 = $x14 + $x15;
        $x13 = $x13 + $x6;
        
        $x16 = Receiving_aid::join('family_books','family_books.id' , '=', 'receiving_aids.family_books_id')->where('family_books.status_from_organization','مقبول')->where('family_books.age_years_husband','>=',60)->where('receiving_aids.date',$date)->count();
        $x17 = Family_book::join('receiving_aids','family_books.id' , '=', 'receiving_aids.family_books_id')->join('wives','family_books.id' , '=', 'wives.family_book_id')->where('receiving_aids.date',$date)->where('family_books.status_from_organization','مقبول')->where('wives.age_years','>=',60)->count();
        $x166 = Family_book::join('receiving_aids','family_books.id' , '=', 'receiving_aids.family_books_id')->join('childrens','family_books.id' , '=', 'childrens.family_book_id')->where('receiving_aids.date',$date)->where('family_books.status_from_organization','مقبول')->where('childrens.gender','ذكر')->where('childrens.age_years','>=',60)->count();
        $x177 = Family_book::join('receiving_aids','family_books.id' , '=', 'receiving_aids.family_books_id')->join('childrens','family_books.id' , '=', 'childrens.family_book_id')->where('receiving_aids.date',$date)->where('family_books.status_from_organization','مقبول')->where('childrens.gender','أنثى')->where('childrens.age_years','>=',60)->count();

        $r6 = $x16+$x17+$x166+$x177;

        $r7 = $x1 + $x4 + $x7 + $x10 + $x13 + $x16 + $x166;
        $r8 = $x2 + $x5 + $x8 + $x11 + $x14 + $x17 + $x177;
        $r9 = $r1 + $r2 + $r3 + $r4 + $r5 + $r6;

        $x1666 = $x16 + $x166 ;
        $x1777 = $x17 + $x177 ;
        $x18 = Family_book::join('receiving_aids','family_books.id' , '=', 'receiving_aids.family_books_id')->join('childrens','family_books.id' , '=', 'childrens.family_book_id')->where('receiving_aids.date',$date)->where('family_books.status_from_organization','مقبول')->where('childrens.gender','ذكر')->where('residence_status_id',4)->count();
        $x19 = Receiving_aid::join('family_books','family_books.id' , '=', 'receiving_aids.family_books_id')->where('family_books.status_from_organization','مقبول')->where('residence_status_id',4)->where('receiving_aids.date',$date)->count();

        $r10 = $x18+$x19;

        $x20 = Family_book::join('receiving_aids','family_books.id' , '=', 'receiving_aids.family_books_id')->join('childrens','family_books.id' , '=', 'childrens.family_book_id')->where('receiving_aids.date',$date)->where('family_books.status_from_organization','مقبول')->where('childrens.gender','ذكر')->where('residence_status_id',1)->count();
        $x21 = Receiving_aid::join('family_books','family_books.id' , '=', 'receiving_aids.family_books_id')->where('family_books.status_from_organization','مقبول')->where('residence_status_id',1)->where('receiving_aids.date',$date)->count();

        $r11 = $x20+$x21;

        $x22 = Family_book::join('receiving_aids','family_books.id' , '=', 'receiving_aids.family_books_id')->join('childrens','family_books.id' , '=', 'childrens.family_book_id')->where('receiving_aids.date',$date)->where('family_books.status_from_organization','مقبول')->where('childrens.gender','ذكر')->where('residence_status_id',2)->count();
        $x23 = Receiving_aid::join('family_books','family_books.id' , '=', 'receiving_aids.family_books_id')->where('family_books.status_from_organization','مقبول')->where('residence_status_id',2)->where('receiving_aids.date',$date)->count();

        $r12 = $x22+$x23;

        $x24 = Family_book::join('receiving_aids','family_books.id' , '=', 'receiving_aids.family_books_id')->join('childrens','family_books.id' , '=', 'childrens.family_book_id')->where('receiving_aids.date',$date)->where('family_books.status_from_organization','مقبول')->where('childrens.gender','ذكر')->where('residence_status_id',3)->count();
        $x25 = Receiving_aid::join('family_books','family_books.id' , '=', 'receiving_aids.family_books_id')->where('family_books.status_from_organization','مقبول')->where('residence_status_id',3)->where('receiving_aids.date',$date)->count();
        $r13 = $x24+$x25;

        $x26 = Family_book::join('receiving_aids','family_books.id' , '=', 'receiving_aids.family_books_id')->join('childrens','family_books.id' , '=', 'childrens.family_book_id')->where('receiving_aids.date',$date)->where('family_books.status_from_organization','مقبول')->where('childrens.gender','أنثى')->where('residence_status_id',4)->count();
        $x27 = Family_book::join('receiving_aids','family_books.id' , '=', 'receiving_aids.family_books_id')->join('wives','family_books.id' , '=', 'wives.family_book_id')->where('receiving_aids.date',$date)->where('family_books.status_from_organization','مقبول')->where('residence_status_id',4)->count();


        $r14 = $x26+$x27;

        $x28 = Family_book::join('receiving_aids','family_books.id' , '=', 'receiving_aids.family_books_id')->join('childrens','family_books.id' , '=', 'childrens.family_book_id')->where('receiving_aids.date',$date)->where('family_books.status_from_organization','مقبول')->where('childrens.gender','أنثى')->where('residence_status_id',1)->count();
        $x29 = Family_book::join('receiving_aids','family_books.id' , '=', 'receiving_aids.family_books_id')->join('wives','family_books.id' , '=', 'wives.family_book_id')->where('receiving_aids.date',$date)->where('family_books.status_from_organization','مقبول')->where('residence_status_id',1)->count();

        $r15 = $x28+$x29;

        $x30 = Family_book::join('receiving_aids','family_books.id' , '=', 'receiving_aids.family_books_id')->join('childrens','family_books.id' , '=', 'childrens.family_book_id')->where('receiving_aids.date',$date)->where('family_books.status_from_organization','مقبول')->where('childrens.gender','أنثى')->where('residence_status_id',2)->count();
        $x31 = Family_book::join('receiving_aids','family_books.id' , '=', 'receiving_aids.family_books_id')->join('wives','family_books.id' , '=', 'wives.family_book_id')->where('receiving_aids.date',$date)->where('family_books.status_from_organization','مقبول')->where('residence_status_id',2)->count();

        $r16 = $x30+$x31;

        $x32 = Family_book::join('receiving_aids','family_books.id' , '=', 'receiving_aids.family_books_id')->join('childrens','family_books.id' , '=', 'childrens.family_book_id')->where('receiving_aids.date',$date)->where('family_books.status_from_organization','مقبول')->where('childrens.gender','أنثى')->where('residence_status_id',3)->count();
        $x33 = Family_book::join('receiving_aids','family_books.id' , '=', 'receiving_aids.family_books_id')->join('wives','family_books.id' , '=', 'wives.family_book_id')->where('receiving_aids.date',$date)->where('family_books.status_from_organization','مقبول')->where('residence_status_id',3)->count();

        $r17 = $x32+$x33;


        $r18 = $r10 + $r14;
        $r19 = $r11 + $r15;
        $r20 = $r12 + $r16;
        $r21 = $r13 + $r17;

        $Total = $r18 + $r19 + $r20 + $r21;

        $table2 = '<table style="border-collapse: collapse;" border="1"><tbody>
                    <tr>
                        <td rowspan="2">Beneficiary group</td>
                        <td colspan="3">Total Beneficiaries</td>
                        <td colspan="3">New Beneficiaries (out of Total)</td>
                        <td colspan="5">Resident Status</td>
                    </tr>
                    <tr>
                        <td>Male</td>
                        <td>Female</td>
                        <td>Total</td>
                        <td>Male</td>
                        <td>Female</td>
                        <td>Total</td>
                        <td>-</td>
                        <td>Resident</td>
                        <td>Refugees</td>
                        <td>Returnees</td>
                        <td>IDPs</td>
                    </tr>
                    <tr>
                        <td>Children (0-23mnths)</td>
                        <td>'.$x1.'</td>
                        <td>'.$x2.'</td>
                        <td>'.$r1.'</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td rowspan="2">Male</td>
                        <td rowspan="2">'.$r10.'</td>
                        <td rowspan="2">'.$r11.'</td>
                        <td rowspan="2">'.$r12.'</td>
                        <td rowspan="2">'.$r13.'</td>
                    </tr>
                    <tr>
                        <td>Children (24-59mnths)</td>
                        <td>'.$x4.'</td>
                        <td>'.$x5.'</td>
                        <td>'.$r2.'</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                    <tr>
                    <td>Children (5-11 yrs)</td>
                        <td>'.$x7.'</td>
                        <td>'.$x8.'</td>
                        <td>'.$r3.'</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td rowspan="2">Female</td>
                        <td rowspan="2">'.$r14.'</td>
                        <td rowspan="2">'.$r15.'</td>
                        <td rowspan="2">'.$r16.'</td>
                        <td rowspan="2">'.$r17.'</td>
                    </tr>
                    <tr>
                        <td>Children (12 -17 yrs)</td>
                        <td>'.$x10.'</td>
                        <td>'.$x11.'</td>
                        <td>'.$r4.'</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>Adult (18-59 yrs)</td>
                        <td>'.$x13.'</td>
                        <td>'.$x14.'</td>
                        <td>'.$r5.'</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td rowspan="2">Subtotal</td>
                        <td rowspan="2">'.$r18.'</td>
                        <td rowspan="2">'.$r19.'</td>
                        <td rowspan="2">'.$r20.'</td>
                        <td rowspan="2">'.$r21.'</td>
                    </tr>
                    <tr>
                        <td>Adult 60+</td>
                        <td>'.$x1666.'</td>
                        <td>'.$x1777.'</td>
                        <td>'.$r6.'</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>Total</td>
                        <td>'.$r7.'</td>
                        <td>'.$r8.'</td>
                        <td>'.$r9.'</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>Total</td>
                        <td colspan="4">'.$Total.'</td>
                    </tr>
                    </tbody>
                    </table>';
        PDF::writeHTMLCell(200, '', 5,'', $table2, 0,1, 0, true, 'C', true);

    }

    /*public function GeneralInfo(){

        $info = '<table style="border-collapse: collapse;" border="1"><tbody>
                <tr>
                    <td colspan="12">1. General Information</td>
                </tr>
                <tr>
                    <td colspan="2">Activity</td>
                    <td colspan="4">Livelihood - Asset creation and livelihood support activities</td>
                    <td colspan="2">CSP</td>
                    <td colspan="4">SY02</td>
                </tr>
                <tr>
                    <td colspan="2">Cooperating Partner</td>
                    <td colspan="10">Fouadi - The Foundation of Advancing Development Integration</td>
                </tr>
                <tr>
                    <td colspan="2">Reporting Period</td>
                    <td colspan="4">'.Carbon::parse(Carbon::now())->format('F').'</td>
                    <td colspan="2">Feeding days</td>
                    <td colspan="4">30</td>
                </tr>
                <tr>
                    <td colspan="2">Location(s)</td>
                    <td colspan="10">Syria - Aleppo - As-safira</td>
                </tr>
                </tbody></table><br><br>';
        PDF::writeHTMLCell(200, '', 5,50, $info, 0,1, 0, true, 'C', true);

        $Family_books = Family_book::where('status_from_organization','مقبول')->get();

        $table1 = '<table style="border-collapse: collapse;" border="1"><tbody>
                    <tr>
                        <td colspan="12">2. Number of Beneficiaries</td>
                    </tr>
                    <tr>
                        <td rowspan="2">Participants group</td>
                        <td colspan="3">Total Participants</td>
                        <td colspan="3">New Participants (out of Total)</td>
                        <td colspan="5">Resident Status (percentage or figures)</td>
                    </tr>
                    <tr>
                        <td>Male</td>
                        <td>Female</td>
                        <td>Total</td>
                        <td>Male</td>
                        <td>Female</td>
                        <td>Total</td>
                        <td>-</td>
                        <td>Resident</td>
                        <td>Refugees</td>
                        <td>Returnees</td>
                        <td>IDPs</td>
                    </tr>
                    <tr>
                        <td rowspan="2">Adult (18-59 yrs)</td>
                        <td rowspan="2">'.$Family_books->where('gender_participant','ذكر')->whereBetween('age_years',['18','59'])->count().'</td>
                        <td rowspan="2">'.$Family_books->where('gender_participant','أنثى')->whereBetween('age_years',['18','59'])->count().'</td>
                        <td rowspan="2">'.$Family_books->where('status_from_organization','مقبول')->whereBetween('age_years',['18','59'])->count().'</td>
                        <td rowspan="2">-</td>
                        <td rowspan="2">-</td>
                        <td rowspan="2">-</td>
                        <td>Male</td>
                        <td>'.$Family_books->where('status_from_organization','مقبول')->where('gender_participant','ذكر')->where('residence_status_id',4)->count().'</td>
                        <td>'.$Family_books->where('status_from_organization','مقبول')->where('gender_participant','ذكر')->where('residence_status_id',1)->count().'</td>
                        <td>'.$Family_books->where('status_from_organization','مقبول')->where('gender_participant','ذكر')->where('residence_status_id',2)->count().'</td>
                        <td>'.$Family_books->where('status_from_organization','مقبول')->where('gender_participant','ذكر')->where('residence_status_id',3)->count().'</td>
                    </tr>
                    <tr>
                        <td>Female</td>
                        <td>'.$Family_books->where('status_from_organization','مقبول')->where('gender_participant','أنثى')->where('residence_status_id',4)->count().'</td>
                        <td>'.$Family_books->where('status_from_organization','مقبول')->where('gender_participant','أنثى')->where('residence_status_id',1)->count().'</td>
                        <td>'.$Family_books->where('status_from_organization','مقبول')->where('gender_participant','أنثى')->where('residence_status_id',2)->count().'</td>
                        <td>'.$Family_books->where('status_from_organization','مقبول')->where('gender_participant','أنثى')->where('residence_status_id',3)->count().'</td>
                    </tr>
                    <tr>
                        <td>Total</td>
                        <td>'.$Family_books->where('gender_participant','ذكر')->whereBetween('age_years',['18','59'])->count().'</td>
                        <td>'.$Family_books->where('gender_participant','أنثى')->whereBetween('age_years',['18','59'])->count().'</td>
                        <td>'.$Family_books->where('status_from_organization','مقبول')->whereBetween('age_years',['18','59'])->count().'</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>Total</td>
                        <td>'.$Family_books->where('status_from_organization','مقبول')->where('residence_status_id',4)->count().'</td>
                        <td>'.$Family_books->where('status_from_organization','مقبول')->where('residence_status_id',1)->count().'</td>
                        <td>'.$Family_books->where('status_from_organization','مقبول')->where('residence_status_id',2)->count().'</td>
                        <td>'.$Family_books->where('status_from_organization','مقبول')->where('residence_status_id',3)->count().'</td>
                    </tr>
                    </tbody></table><br><br>';
        PDF::writeHTMLCell(200, '', 5,'', $table1, 0,1, 0, true, 'C', true);

        $x1 = Children::join('family_books','family_books.id' , '=', 'childrens.family_book_id')->where('family_books.status_from_organization','مقبول')->where('childrens.gender','ذكر')->whereBetween('childrens.age_month',['0','23'])->count();
        $x2 = Children::join('family_books','family_books.id' , '=', 'childrens.family_book_id')->where('family_books.status_from_organization','مقبول')->where('childrens.gender','أنثى')->whereBetween('childrens.age_month',['0','23'])->count();

        $r1 = $x1+$x2;

        $x4 = Children::join('family_books','family_books.id' , '=', 'childrens.family_book_id')->where('family_books.status_from_organization','مقبول')->where('childrens.gender','ذكر')->whereBetween('childrens.age_month',['24','59'])->count();
        $x5 = Children::join('family_books','family_books.id' , '=', 'childrens.family_book_id')->where('family_books.status_from_organization','مقبول')->where('childrens.gender','أنثى')->whereBetween('childrens.age_month',['24','59'])->count();

        $r2 = $x4+$x5;

        $x7 = Children::join('family_books','family_books.id' , '=', 'childrens.family_book_id')->where('family_books.status_from_organization','مقبول')->where('childrens.gender','ذكر')->whereBetween('childrens.age_years',['6','11'])->count();
        $x8 = Children::join('family_books','family_books.id' , '=', 'childrens.family_book_id')->where('family_books.status_from_organization','مقبول')->where('childrens.gender','أنثى')->whereBetween('childrens.age_years',['6','11'])->count();

        $r3 = $x7+$x8;

        $x10 = Children::join('family_books','family_books.id' , '=', 'childrens.family_book_id')->where('family_books.status_from_organization','مقبول')->where('childrens.gender','ذكر')->whereBetween('childrens.age_years',['12','17'])->count();
        $x11 = Children::join('family_books','family_books.id' , '=', 'childrens.family_book_id')->where('family_books.status_from_organization','مقبول')->where('childrens.gender','أنثى')->whereBetween('childrens.age_years',['12','17'])->count();
        $x12 = Wive::join('family_books','family_books.id' , '=', 'wives.family_book_id')->where('family_books.status_from_organization','مقبول')->whereBetween('wives.age_years',['12','17'])->count();
        $x3 = $Family_books->where('status_from_organization','مقبول')->whereBetween('age_years_husband',['12','17'])->count();

        $r4 = $x10+$x11+$x12+$x3;
        $x11 = $x11 + $x12;
        $x10 = $x10 + $x3;
        
        $x13 = Children::join('family_books','family_books.id' , '=', 'childrens.family_book_id')->where('family_books.status_from_organization','مقبول')->where('childrens.gender','ذكر')->whereBetween('childrens.age_years',['18','59'])->count();
        $x14 = Children::join('family_books','family_books.id' , '=', 'childrens.family_book_id')->where('family_books.status_from_organization','مقبول')->where('childrens.gender','أنثى')->whereBetween('childrens.age_years',['18','59'])->count();
        $x15 = Wive::join('family_books','family_books.id' , '=', 'wives.family_book_id')->where('family_books.status_from_organization','مقبول')->whereBetween('wives.age_years',['18','59'])->count();
        $x6 = $Family_books->where('status_from_organization','مقبول')->whereBetween('age_years_husband',['18','59'])->count();

        $r5 = $x13+$x14+$x15+$x6;
        $x14 = $x14 + $x15;
        $x13 = $x13 + $x6;
        
        $x16 = $Family_books->where('status_from_organization','مقبول')->where('age_years_husband','>=',60)->count();
        $x17 = Wive::join('family_books','family_books.id' , '=', 'wives.family_book_id')->where('family_books.status_from_organization','مقبول')->where('wives.age_years','>=',60)->count();

        $r6 = $x16+$x17;

        $r7 = $x1 + $x4 + $x7 + $x10 + $x13 + $x16;
        $r8 = $x2 + $x5 + $x8 + $x11 + $x14 + $x17;
        $r9 = $r1 + $r2 + $r3 + $r4 + $r5 + $r6;

        $x18 = Children::join('family_books','family_books.id' , '=', 'childrens.family_book_id')->where('family_books.status_from_organization','مقبول')->where('family_books.residence_status_id',4)->where('childrens.gender','ذكر')->count();
        $x19 = $Family_books->where('status_from_organization','مقبول')->where('residence_status_id',4)->count();

        $r10 = $x18+$x19;

        $x20 = Children::join('family_books','family_books.id' , '=', 'childrens.family_book_id')->where('family_books.status_from_organization','مقبول')->where('family_books.residence_status_id',1)->where('childrens.gender','ذكر')->count();
        $x21 = $Family_books->where('status_from_organization','مقبول')->where('residence_status_id',1)->count();

        $r11 = $x20+$x21;

        $x22 = Children::join('family_books','family_books.id' , '=', 'childrens.family_book_id')->where('family_books.status_from_organization','مقبول')->where('family_books.residence_status_id',2)->where('childrens.gender','ذكر')->count();
        $x23 = $Family_books->where('status_from_organization','مقبول')->where('residence_status_id',2)->count();

        $r12 = $x22+$x23;

        $x24 = Children::join('family_books','family_books.id' , '=', 'childrens.family_book_id')->where('family_books.status_from_organization','مقبول')->where('family_books.residence_status_id',3)->where('childrens.gender','ذكر')->count();
        $x25 = $Family_books->where('status_from_organization','مقبول')->where('residence_status_id',3)->count();

        $r13 = $x24+$x25;

        $x26 = Children::join('family_books','family_books.id' , '=', 'childrens.family_book_id')->where('family_books.status_from_organization','مقبول')->where('family_books.residence_status_id',4)->where('childrens.gender','أنثى')->count();
        $x27 = Wive::join('family_books','family_books.id' , '=', 'wives.family_book_id')->where('family_books.status_from_organization','مقبول')->where('family_books.residence_status_id',4)->count();

        $r14 = $x26+$x27;

        $x28 = Children::join('family_books','family_books.id' , '=', 'childrens.family_book_id')->where('family_books.status_from_organization','مقبول')->where('family_books.residence_status_id',1)->where('childrens.gender','أنثى')->count();
        $x29 = Wive::join('family_books','family_books.id' , '=', 'wives.family_book_id')->where('family_books.status_from_organization','مقبول')->where('family_books.residence_status_id',1)->count();

        $r15 = $x28+$x29;

        $x30 = Children::join('family_books','family_books.id' , '=', 'childrens.family_book_id')->where('family_books.status_from_organization','مقبول')->where('family_books.residence_status_id',2)->where('childrens.gender','أنثى')->count();
        $x31 = Wive::join('family_books','family_books.id' , '=', 'wives.family_book_id')->where('family_books.status_from_organization','مقبول')->where('family_books.residence_status_id',2)->count();

        $r16 = $x30+$x31;

        $x32 = Children::join('family_books','family_books.id' , '=', 'childrens.family_book_id')->where('family_books.status_from_organization','مقبول')->where('family_books.residence_status_id',3)->where('childrens.gender','أنثى')->count();
        $x33 = Wive::join('family_books','family_books.id' , '=', 'wives.family_book_id')->where('family_books.status_from_organization','مقبول')->where('family_books.residence_status_id',3)->count();

        $r17 = $x32+$x33;


        $r18 = $r10 + $r14;
        $r19 = $r11 + $r15;
        $r20 = $r12 + $r16;
        $r21 = $r13 + $r17;

        $Total = $r18 + $r19 + $r20 + $r21;

        $table2 = '<table style="border-collapse: collapse;" border="1"><tbody>
                    <tr>
                        <td rowspan="2">Beneficiary group</td>
                        <td colspan="3">Total Beneficiaries</td>
                        <td colspan="3">New Beneficiaries (out of Total)</td>
                        <td colspan="5">Resident Status</td>
                    </tr>
                    <tr>
                        <td>Male</td>
                        <td>Female</td>
                        <td>Total</td>
                        <td>Male</td>
                        <td>Female</td>
                        <td>Total</td>
                        <td>-</td>
                        <td>Resident</td>
                        <td>Refugees</td>
                        <td>Returnees</td>
                        <td>IDPs</td>
                    </tr>
                    <tr>
                        <td>Children (0-23mnths)</td>
                        <td>'.$x1.'</td>
                        <td>'.$x2.'</td>
                        <td>'.$r1.'</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td rowspan="2">Male</td>
                        <td rowspan="2">'.$r10.'</td>
                        <td rowspan="2">'.$r11.'</td>
                        <td rowspan="2">'.$r12.'</td>
                        <td rowspan="2">'.$r13.'</td>
                    </tr>
                    <tr>
                        <td>Children (24-59mnths)</td>
                        <td>'.$x4.'</td>
                        <td>'.$x5.'</td>
                        <td>'.$r2.'</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                    <tr>
                    <td>Children (6-11 yrs)</td>
                        <td>'.$x7.'</td>
                        <td>'.$x8.'</td>
                        <td>'.$r3.'</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td rowspan="2">Female</td>
                        <td rowspan="2">'.$r14.'</td>
                        <td rowspan="2">'.$r15.'</td>
                        <td rowspan="2">'.$r16.'</td>
                        <td rowspan="2">'.$r17.'</td>
                    </tr>
                    <tr>
                        <td>Children (12 -17 yrs)</td>
                        <td>'.$x10.'</td>
                        <td>'.$x11.'</td>
                        <td>'.$r4.'</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>Adult (18-59 yrs)</td>
                        <td>'.$x13.'</td>
                        <td>'.$x14.'</td>
                        <td>'.$r5.'</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td rowspan="2">Subtotal</td>
                        <td rowspan="2">'.$r18.'</td>
                        <td rowspan="2">'.$r19.'</td>
                        <td rowspan="2">'.$r20.'</td>
                        <td rowspan="2">'.$r21.'</td>
                    </tr>
                    <tr>
                        <td>Adult 60+</td>
                        <td>'.$x16.'</td>
                        <td>'.$x17.'</td>
                        <td>'.$r6.'</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>Total</td>
                        <td>'.$r7.'</td>
                        <td>'.$r8.'</td>
                        <td>'.$r9.'</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>Total</td>
                        <td colspan="4">'.$Total.'</td>
                    </tr>
                    </tbody>
                    </table>';
        PDF::writeHTMLCell(200, '', 5,'', $table2, 0,1, 0, true, 'C', true);

    }*/

    public function EndPDF(){
        // reset pointer to the last page
        PDF::lastPage();

        // ---------------------------------------------------------

        //Close and output PDF document
        PDF::Output('Report_CPDR_'.Carbon::now()->format('d/m/yy').'.pdf', 'I');

        //============================================================+
        // END OF FILE
        //============================================================+
    }

}