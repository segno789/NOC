<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Consolidated_Corrections extends CI_Controller {

    /**
    * Index Page for this controller.
    *
    * Maps to the following URL
    *         http://example.com/index.php/welcome
    *    - or -
    *         http://example.com/index.php/welcome/index
    *    - or -
    * Since this controller is set as the default controller in
    * config/routes.php, it's displayed at http://example.com/
    *
    * So any other public methods not prefixed with an underscore will
    * map to /index.php/welcome/<method_name>
    * @see http://codeigniter.com/user_guide/general/urls.html
    */
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        //this condition checks the existence of session if user is not accessing  
        //login method as it can be accessed without user session
        /*$this->load->library('session');
        if( !$this->session->userdata('logged_in') && $this->router->method != 'login' ) {
        redirect('login');
        }*/
    }
    public function index()
    {
        //  DebugBreak();
        /* // 
        $this->load->helper('url');

        $data = array(); 
        $info = array(); 

        $this->load->library('PDFFWithOutPage');
        $pdf=new PDFFWithOutPage();   
        $pdf->SetAutoPageBreak(true,2);
        $pdf->AddPage('L',"A4");
        $this->makeNoc($pdf,$info);
        $pdf->Output('Result.pdf', 'I');  
        */
        $data = array(
            'isselected' => '3',
        );
        //   $this->load->model('Admission_model');
        $this->load->library('session');

        $error ="";

        if($this->session->flashdata('downerror'))
        {
            $error = $this->session->flashdata('downerror');
        }
        else{
            $error = "";
        }

        $this->load->view('common/Consolidated_Corrections/commonheader_Correction.php');
        $mydata = array('error'=>$error);

        $this->load->view('Consolidated_Corrections/default.php',$mydata);

        $this->load->view('common/Consolidated_Corrections/verCorrection.php');
    }
    private function makeNoc($pdf,$info)
    {

        $info = $info[0][0];
        $Session= 'ANNUAL';  
        //$info['iyear'] = 2016;     

        $filepath = $this->generatepath($info['Rno'],$info['class'],$info['iyear'],$info['sess']);





        //$filepath = base_url().'assets/img/download.jpg';
        $fontSize = 10; 
        $marge    = .95;   // between barcode and hri in pixel
        $bx        = 90.6;  // barcode center
        $by        = 77.75;  // barcode center
        $height   = 5.7;   // barcode height in 1D ; module size in 2D
        $width    = .26;  // barcode height in 1D ; not use in 2D
        $angle    = 0;   // rotation in degrees

        $code     = '222020';     // barcode (CP852 encoding for Polish and other Central European languages)
        $type     = 'code128';
        $black    = '000000'; // color in hex
        $Y = 3;
        $x = 5;

        //Left Side
        $dotx= 113.8;
        $pdf->Image(base_url()."assets/img/border.png",5,3, 122,205, "PNG");
        $pdf->Image(base_url()."assets/img/dots.png",$dotx,7.5, 30,40, "PNG");
        $pdf->Image(base_url()."assets/img/dots.png",$dotx,47.5, 30,40, "PNG");
        $pdf->Image(base_url()."assets/img/dots.png",$dotx,87.5, 30,40, "PNG");
        $pdf->Image(base_url()."assets/img/dots.png",$dotx,127.5, 30,40, "PNG");
        $pdf->Image(base_url()."assets/img/dots.png",$dotx,167.5, 30,40, "PNG");

        $pdf->SetTextColor(0 ,0,0);
        $pdf->SetFont('Arial','U',14);
        $pdf->SetXY(.1,18);
        $pdf->MultiCell(130, 5,"BOARD OF INTERMEDIATE & SECONDARY EDUCATION, GUJRANWALA", '', "C",0);
        $pdf->Image(base_url()."assets/img/icon2.png",6,30, 38,36, "PNG");

        $pdf->SetFont('Arial','B',11);
        $pdf->SetXY(38.2,40);
        $pdf->Cell(0, 0.2, "MIGRATION CERTIFICATE", 0.25, "C");


        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(56.2,45);
        $pdf->Cell(0, 0.2, "(NOC)", 0.25, "C");
        $pdf->Image($filepath,90,33, 30,35, "jpg"); 

        /*   if( $decodedImg!==false )
        {
        //  Save image to a temporary location
        if( file_put_contents(TEMPIMGLOC,$decodedImg)!==false )
        {
        //  Open new PDF document and print image


        //  Delete image from server
        unlink(TEMPIMGLOC);
        }
        }*/



        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(10.2,70);
        $pdf->Cell(0, 0.2, "App.No.", 0.25, "C");

        $pdf->SetFont('Arial','BU',10);
        $pdf->SetXY(25.2,70);
        $pdf->Cell(0, 0.2, $info['app_No'], 0.25, "C");

        //barcode
        $mybar = $info['app_No']."@".$info['class']."@".$info['sess']."@".$info['iyear'];
        $Barcode = $mybar;

        $bardata = Barcode::fpdf($pdf, $black, $bx, $by, $angle, $type, array('code'=>$Barcode), $width, $height);

        $len = $pdf->GetStringWidth($bardata['hri']);
        Barcode::rotate(-$len / 2, ($bardata['height'] / 2) + $fontSize + $marge, $angle, $xt, $yt);

        $pdf->SetFillColor(255,0,0);
        // $pdf->SetLineWidth(.005);
        $pdf->SetAlpha(.2);
        $pdf->Image(base_url()."assets/img/icon2.png",18,80, 100,100, "PNG");
        $pdf->SetAlpha(1);



        $rx = 14.2;

        $pdf->SetFont('Arial','',10);
        $pdf->SetXY($rx,85);
        $pdf->Cell(0, 0.2, "Name:", 0.25, "C");

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY($rx+30,82.8);
        $pdf->MultiCell(100, 5,$info["name"], '', "L",0);

        $pdf->SetFont('Arial','',10);
        $pdf->SetXY($rx,95);
        $pdf->Cell(0, 0.2, "Father's Name:", 0.25, "C");

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY($rx+30,92.8);
        $pdf->MultiCell(100, 5,$info['fname'], '', "L",0);


        $pdf->SetFont('Arial','',10);
        $pdf->SetXY($rx,105);
        $pdf->Cell(0, 0.2, "Enrolment No:", 0.25, "C");

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY($rx+30,102.8);
        $pdf->MultiCell(100, 5,$info['strregno'], '', "L",0);

        $pdf->SetFont('Arial','',10);
        $pdf->SetXY($rx,115);
        $pdf->Cell(0, 0.2, "Roll No:", 0.25, "C");

        $class_ = $info['class'];
        $sess_  = $info['sess'];

        $sess_name = "";
        $class_name = "";
        $status_name = "";
        Switch($sess_)
        {
            case 1:
                $sess_name = "Annual";
                break;
            case 2:
                $sess_name = "Supplementary";
                break;
            default:
            $sess_name = "No Session Selected!";
            break;

        }
        Switch($class_)
        {
            case 9:
                $class_name = "SSC-I";
                break;
            case 10:
                $class_name = "SSC-II";
                break;
            case 11:
                $class_name = "HSSC-I";
                break;
            case 12:
                $class_name = "HSSC-II";
                break;
            default:
            $class_name = "No Class Selected!";
            break;

        }
        Switch($info['status'])
        {
            case 1:
                $status_name = "Pass";
                break;
            case 2:
                $status_name = "Fail";
                break;
            case 3:
                $status_name = "Fail";
                break;

            default:
                $status_name = "";
                break;

        }
        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY($rx+30,112.8);
        $pdf->MultiCell(100, 5,$info['Rno']."  ".$class_name."  ".$sess_name." ".$info['iyear']." ".$status_name, '', "L",0); //158745 SSC-I Annual 2016 Pass

        $pdf->SetFont('Arial','',10);
        $pdf->SetXY($rx,125);
        $pdf->Cell(0, 0.2, "Issued For:", 0.25, "C");

        $pdf->SetFont('Arial','B',8);
        $pdf->SetXY($rx+30,122.8);
        $pdf->MultiCell(90, 5,$info['MigTo'], '', "L",0);

        $pdf->SetFont('Arial','B',11);
        $pdf->SetXY($rx,140);
        $pdf->Cell(0, 0.2, "Fee Details", 0.25, "C");

        $pdf->SetFont('Arial','',10);
        $pdf->SetXY($rx,150);
        $pdf->Cell(0, 0.2, "Challan No:", 0.25, "C");

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY($rx+30,147.8);
        $pdf->MultiCell(100, 5,$info['Challan_No'], '', "L",0);

        $pdf->SetFont('Arial','',10);
        $pdf->SetXY($rx,155);
        $pdf->Cell(0, 0.2, "Date:", 0.25, "C");

        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY($rx+30,152.8);
        $pdf->MultiCell(100, 5,date('d-M-Y h:i A'), '', "L",0);     //09 September, 2016

        $pdf->SetFont('Arial','',10);
        $pdf->SetXY($rx,160);
        $pdf->Cell(0, 0.2, "Amount:", 0.25, "C");

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY($rx+30,157.8);
        $pdf->MultiCell(100, 5,"Rs. 1600/-", '', "L",0);

        $pdf->SetFont('Arial','',10);
        $pdf->SetXY(10.2,190);

        $pdf->Cell(0, 0.2, date('d-M-Y h:i A'), 0.25, "C");
        $pdf->SetFont('Arial','',12);
        $pdf->SetXY(10.2,190);
        $pdf->Cell(0, 0.2, "_______________", 0.25, "C");
        $pdf->SetFont('Arial','',12);
        $pdf->SetXY(20.2,195);
        $pdf->Cell(0, 0.2, "Dated", 0.25, "C");


        $pdf->SetFont('Arial','',12);
        $pdf->SetXY(48.2,190);
        $pdf->Cell(0, 0.2, "_______________", 0.25, "C");
        $pdf->Image('assets/img/SignOfficial.png',49.2,172, 25,25, "png"); 
        $pdf->SetFont('Arial','',12);
        $pdf->SetXY(58.2,195);
        $pdf->Cell(0, 0.2, "Official", 0.25, "C");

        $pdf->SetFont('Arial','',12);
        $pdf->SetXY(86.2,190);
        $pdf->Cell(0, 0.2, "______________", 0.25, "C");
        $pdf->SetFont('Arial','',12);
        $pdf->SetXY(88.2,195);
        $pdf->Cell(0, 0.2, "Superintendent", 0.25, "C");
        $pdf->Image('assets/img/SignSup.png',89.2,165.5, 25,25, "png"); 


        //Right Side
        $pdf->Image(base_url()."assets/img/border.png",130,3, 163,205, "PNG");
        $pdf->SetTextColor(0 ,0,0);
        $pdf->SetFont('Arial','U',14);
        $pdf->SetXY(134.2,18);
        $pdf->MultiCell(160, 5,"BOARD OF INTERMEDIATE & SECONDARY EDUCATION, GUJRANWALA", '', "C",0);
        $pdf->Image(base_url()."assets/img/icon2.png",135,30, 38,36, "PNG");
        $pdf->SetFont('Arial','B',11);
        $pdf->SetXY(185.2,40);
        $pdf->Cell(0, 0.2, "MIGRATION CERTIFICATE", 0.25, "C");

        $pdf->Image($filepath,250,30, 30,35, "jpg");  
        $pdf->Image('assets/img/Stamp.png',240,44, 30,30, "png"); 
        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(205.2,44);
        $pdf->Cell(0, 0.2, "(NOC)", 0.25, "C");


        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(140.2,70);
        $pdf->Cell(0, 0.2, "App.No.", 0.25, "C");

        $pdf->SetFont('Arial','BU',10);
        $pdf->SetXY(155.2,70);
        $pdf->Cell(0, 0.2, $info['app_No'], 0.25, "C");

        $bx        = 240.6;  // barcode center

        $bardata = Barcode::fpdf($pdf, $black, $bx, $by, $angle, $type, array('code'=>$Barcode), $width, $height);

        $len = $pdf->GetStringWidth($bardata['hri']);
        Barcode::rotate(-$len / 2, ($bardata['height'] / 2) + $fontSize + $marge, $angle, $xt, $yt);



        $pdf->SetAlpha(.2);
        $pdf->Image(base_url()."assets/img/icon2.png",158,80, 100,100, "PNG");
        $pdf->SetAlpha(1);

        $rx = 150.2;
        $ry = 100;
        $pdf->SetFont('Arial','',10);
        $pdf->SetXY($rx,$ry);
        $pdf->Cell(0, 0.2, "Name of Candidate:", 0.25, "C");

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY($rx+40,$ry-2.8);
        $pdf->MultiCell(100, 5,$info['name'], '', "L",0);

        $pdf->SetFont('Arial','',10);
        $pdf->SetXY($rx,$ry+10);
        $pdf->Cell(0, 0.2, "Father's Name:", 0.25, "C");

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY($rx+40,$ry+10-2.8);
        $pdf->MultiCell(100, 5,$info['fname'], '', "L",0);


        $pdf->SetFont('Arial','',10);
        $pdf->SetXY($rx,$ry+20);
        $pdf->Cell(0, 0.2, "Enrolment No:", 0.25, "C");

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY($rx+40,$ry+20-2.8);
        $pdf->MultiCell(100, 5,$info['strregno'], '', "L",0);

        $pdf->SetFont('Arial','',10);
        $pdf->SetXY($rx,$ry+30);
        $pdf->Cell(0, 0.2, "Roll No:", 0.25, "C");

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY($rx+40,$ry+30-2.8);
        $pdf->MultiCell(100, 5,$info['Rno']."  ".$class_name."  ".$sess_name." ".$info['iyear']." ".$status_name, '', "L",0);     //158745 SSC-I Annual 2016 Pass


        $pdf->SetFont('Arial','',12);
        $pdf->SetXY($rx,$ry+40);
        $pdf->MultiCell(118, 5,"The Candidate is permitted to migrate from the Jurisdiction of the Board for Studies or apperance in an examination from", '', "J",0);

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY($rx,$ry+50);
        $pdf->MultiCell(125, 5,$info['MigTo'], '', "L",0);




        $pdf->SetFont('Arial','',12);
        $pdf->SetXY(136.2,192);
        $pdf->Cell(0, 0.2, "Dated", 0.25, "C");
        $pdf->SetFont('Arial','',8);
        $pdf->SetXY(147.2,192);
        $pdf->Cell(0, 0.2," ".date('d-M-Y h:i A'), 0.25, "C");
        $pdf->SetFont('Arial','',12);
        $pdf->SetXY(147.2,192);
        $pdf->Cell(0, 0.2, "_____________", 0.25, "C");



        $pdf->SetFont('Arial','',12);
        $pdf->SetXY(178.2,192);
        $pdf->Cell(0, 0.2, "Official", 0.25, "C");

        $pdf->SetFont('Arial','',12);
        $pdf->SetXY(191.2,192);
        $pdf->Cell(0, 0.2, "_____________", 0.25, "C");

        $pdf->Image('assets/img/SignOfficial.png',191.2,172, 25,25, "png"); 


        $pdf->SetFont('Arial','',12);
        $pdf->SetXY(225.2,192);
        $pdf->Cell(0, 0.2, "Superintendent", 0.25, "C");
        $pdf->SetFont('Arial','',12);
        $pdf->SetXY(254.2,192);
        $pdf->Cell(0, 0.2, "_____________", 0.25, "C"); 
        $pdf->Image('assets/img/SignSup.png',255.2,168, 25,25, "png"); 



    }
    public function getForm()
    {

        // DebugBreak();
        $AppNo = $this->uri->segment(3);

        $this->load->library('session');

        $Logged_In_Array = $this->session->all_userdata();
        //$user = $Logged_In_Array['logged_in'];
        $this->load->model('Consolidated_corrections_model');

        // $start_formno = $this->uri->segment(3);
        //   $end_formno = $this->uri->segment(5);
        //  $fetch_data = array('AppNo'=>$AppNo);
        $result = array('data'=>$this->Consolidated_corrections_model->Downolad_data($AppNo));
        //Print_Form_Formnowise


        if(empty($result['data'])){
            $this->session->set_flashdata('error', $Condition);
            redirect('Registration/FormPrinting');
            return;

        }
        $data = $result['data'][0];
        $this->load->library('pdf_rotate');
        $pdf = new pdf_rotate('P','in',"A4");
        $lmargin =1.5;
        $rmargin =7.3;
        $pdf ->SetRightMargin(80);

        $pdf->SetAutoPageBreak(false);
        $pdf->AddPage();
        $x = 0.55;
        $Y = -0.20;
        $pdf->SetFont('Arial','U',12);
        $pdf->SetXY(1.2,0.2);
        $pdf->Cell(0, 0.2, "BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, GUJRANWALA", 0.25, "C");

        $corrFor = '';
        $certifytype = '';
        $oldcertkind = '';
        $newcertkind = '';
        $text1 = "";
        $text2 = "";
        $text3 = "";
        $text4 = "";
        $text5 = "";
      //  DebugBreak();
       // $data['CorrType'] =1;
        if($data['CorrType'] == 1)
        {
            $corrFor = "STUDENT'S NAME";
            $certifytype = "Name";
            $oldcertkind = $data['OldName'];
            $newcertkind = $data['NewName'];
            $pdf->SetFont('Arial','B',9);
        //$pdf->SetFont('Arial','',12);
        $pdf->SetXY(0.5,0.95+$Y);
        
        $pdf->Cell(0.5,0.5,"Candidate Demand Correction ".$certifytype."   ",0,0,"L",0,false);
        $pdf->SetFont('Arial','BU',9);
        $pdf->SetXY(2.800,1.09+$Y); 
        $pdf->MultiCell(2.272 ,0.15,strtoupper($oldcertkind).'',0,'L',false);
        
        $pdf->SetFont('Arial','B',9);
        //$pdf->SetFont('Arial','',12);
        $pdf->SetXY(0.5,01.2+$Y);
        
        $pdf->Cell(0.5,0.5,"Candidate Demand Correction ".$certifytype."(in urdu)____________________________ to ___________________________",0,0,"L",0,false);
        
        
        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(4.800,0.95+$Y); 
        $pdf->Cell(0.5,0.5," to ",0,0,"L",0,false);
        
        
        $pdf->SetFont('Arial','BU',9);
        $pdf->SetXY(5.30,1.09+$Y); 
        $pdf->MultiCell(3.0,0.15,strtoupper($newcertkind).'',0,'L',false);
        /*
        //$pdf->Cell(0.5,0.5,'_____________________________',0,0,"L",0,false);
        /*$pdf->SetFont('Arial','BU',9);
        $pdf->SetXY(2.70,0.95+$Y); 
        $pdf->Cell(0.5,0.5,strtoupper($oldcertkind),0,0,"L",0,false);
        $pdf->SetXY(4.20,0.95+$Y);
        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(0.5,0.5," to ",0,0,"L",0,false);
        $pdf->SetXY(4.50,0.95+$Y);
        $pdf->SetFont('Arial','BU',9);
        $pdf->Cell(0.5,0.5,strtoupper($newcertkind),0,0,"L",0,false);*/
        }
        else if($data['CorrType'] == 2)
        {
            $corrFor = "STUDENT'S FATHER NAME";
            $certifytype = "Father's Name";
            $oldcertkind = $data['OldFname'];
            $newcertkind = $data['NewFname'];
            
        $pdf->SetXY(0.5,0.95+$Y);
        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(0.5,0.5,"Candidate Demand Correction ".$certifytype."   ",0,0,"L",0,false);
        $pdf->SetFont('Arial','BU',9);
        $pdf->SetXY(3.300,1.09+$Y); 
        $pdf->MultiCell(2.3,0.15,strtoupper($oldcertkind).'',0,'L',false);
        
        $pdf->SetFont('Arial','B',9);
        //$pdf->SetFont('Arial','',12);
        $pdf->SetXY(0.5,01.2+$Y);
        $pdf->Cell(0.5,0.5,"Candidate Demand Correction ".$certifytype."(in urdu)_______________________ to ________________________",0,0,"L",0,false);
        
        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(5.300,0.95+$Y); 
        $pdf->Cell(0.5,0.5," to  ",0,0,"L",0,false);
        
        
        $pdf->SetFont('Arial','BU',9);
        $pdf->SetXY(5.60,1.09+$Y); 
        $pdf->MultiCell(3.0,0.15,strtoupper($newcertkind).'',0,'L',false);
            
            
            
            $pdf->SetFont('Arial','B',9);
        //$pdf->SetFont('Arial','',12);
        
        
        
        
        $pdf->SetXY(0.5,0.95+$Y);
        
        //$pdf->Cell(0.5,0.5,"Candidate Demand Correction ".$certifytype." <".strtoupper($oldcertkind).">"." to <".strtoupper($newcertkind).">",0,0,"L",0,false);
        }
        else if($data['CorrType'] == 3)
        {
            $corrFor = "STUDENT'S DATE OF BIRTH";
            $certifytype = "Date of Birth";
            $oldcertkind = $data['OldDob'];
            $newcertkind = $data['NewDob'];
            $pdf->SetFont('Arial','B',9);
        //$pdf->SetFont('Arial','',12);
        $pdf->SetXY(0.5,0.95+$Y);
        
       // $pdf->Cell(0.5,0.5,"Candidate Demand Correction ".$certifytype." <".strtoupper($oldcertkind).">"." to <".strtoupper($newcertkind).">",0,0,"L",0,false);
        $pdf->SetXY(0.5,0.95+$Y);
            $pdf->SetFont('Arial','B',9);
        $pdf->Cell(0.5,0.5,"Candidate Demand Correction ".$certifytype." ",0,0,"L",0,false);
        $pdf->SetFont('Arial','BU',9);
        $pdf->SetXY(3.1500,1.14+$Y); 
        $pdf->MultiCell(2.3,0.15,$oldcertkind,0,'L',false);
        
         $pdf->SetFont('Arial','B',9);
        //$pdf->SetFont('Arial','',12);
        $pdf->SetXY(0.5,01.2+$Y);
         $pdf->Cell(0.5,0.5,"Candidate Demand Correction ".$certifytype." (in words)__________________________________________________",0,0,"L",0,false);
        
        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(3.8100,0.97+$Y); 
        $pdf->Cell(0.5,0.5," to  ",0,0,"L",0,false);
        
        
        $pdf->SetFont('Arial','BU',9);
        $pdf->SetXY(4.0,1.14+$Y); 
        $pdf->MultiCell(3.0,0.15,$newcertkind,0,'L',false);
            
            
            
            $pdf->SetFont('Arial','B',9);
        }
        else if($data['CorrType'] == 4)
        {
            $corrFor = "STUDENT'S NAME SPELLING";
            $certifytype = "Name Spelling";
            $oldcertkind = $data['OldName'];
            $newcertkind = $data['NewName'];
            $pdf->SetFont('Arial','B',9);
        //$pdf->SetFont('Arial','',12);
       $pdf->SetXY(0.5,0.95+$Y);
        
        $pdf->Cell(0.5,0.5,"Candidate Demand Correction ".$certifytype."   ",0,0,"L",0,false);
        $pdf->SetFont('Arial','BU',9);
        $pdf->SetXY(3.30,1.09+$Y); 
        $pdf->MultiCell(2.3,0.15,strtoupper($oldcertkind).'',0,'L',false);
        
         $pdf->SetFont('Arial','B',9);
        //$pdf->SetFont('Arial','',12);
        $pdf->SetXY(0.5,01.2+$Y);
        
        $pdf->Cell(0.5,0.5,"Candidate Demand Correction ".$certifytype." (in urdu)______________________ to ________________________",0,0,"L",0,false);
        
        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(4.800,0.95+$Y); 
        $pdf->Cell(0.5,0.5," to ",0,0,"L",0,false);
        
        
        $pdf->SetFont('Arial','BU',9);
        $pdf->SetXY(5.10,1.09+$Y); 
        $pdf->MultiCell(3.0,0.15,strtoupper($newcertkind).'',0,'L',false);
        }
        else if($data['CorrType'] == 5)
        {
       // DebugBreak();
            $corrFor = "STUDENT'S FATHER NAME SPELLING";
            $certifytype = "Father's Name Spelling";
            $oldcertkind = $data['OldFname'];
            $newcertkind = $data['NewFname'];
             $pdf->SetXY(0.5,0.95+$Y);
            $pdf->SetFont('Arial','B',9);
        $pdf->Cell(0.5,0.5,"Candidate Demand Correction ".$certifytype."   ",0,0,"L",0,false);
        $pdf->SetFont('Arial','BU',9);
        $pdf->SetXY(3.800,1.09+$Y); 
        $pdf->MultiCell(2.3,0.15,strtoupper($oldcertkind).'',0,'L',false);
        
        
         $pdf->SetFont('Arial','B',9);
        //$pdf->SetFont('Arial','',12);
        $pdf->SetXY(0.5,01.2+$Y);
        $pdf->Cell(0.5,0.5,"Candidate Demand Correction ".$certifytype."(in urdu)___________________ to _____________________",0,0,"L",0,false);
        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(5.7500,0.95+$Y); 
        $pdf->Cell(0.5,0.5," to  ",0,0,"L",0,false);
        
        
        $pdf->SetFont('Arial','BU',9);
        $pdf->SetXY(6.0,1.09+$Y); 
        $pdf->MultiCell(2.3,0.15,strtoupper($newcertkind).'',0,'L',false);
            
            
        
       // $pdf->Cell(0.5,0.5,"Candidate Demand Correction ".$certifytype." <".strtoupper($oldcertkind).">"." to <".strtoupper($newcertkind).">",0,0,"L",0,false);
        }


        $pdf->SetFont('Arial','',8);
        $pdf->SetXY(2.48,0.4);
        $pdf->Cell(0, 0.2, strtoupper("CORRECTION FORM FOR ".$corrFor), 0.25, "C");

        //--------------------------- Form No & Rno
        $pdf->SetFont('Arial','B',12);
        $pdf->SetXY(1.2,0.65+$Y);
        $pdf->Cell( 0.5,0.5,"Application No:".$data['AppNo'],0,'L');
        $pdf->SetXY(5.8,0.65+$Y);

        
        //$text  = "Candidate Demand Correction ";
       
        
       
        $pdf->SetXY(5.8,0.65+$Y);
        
        //".$certifytype." ". $oldcertkind.' to '.$newcertkind.'
        
        
        //------ Picture Box on Centre      

        // DebugBreak();
        
        if($data['CorrFor']==1)
        {
        $Barcode = $data['AppNo']."@".@$data['matrno'].'@'.$data['matSess'].'@'.$data["matYear"]."@10";
        }
        else if($data['CorrFor']==2)
        {
        $Barcode = $data['AppNo']."@".@$data['rno'].'@'.$data['sess'].'@'.$data["iyear"]."@10";
        }
        
        $Barcode = $data['AppNo']."@".@$data['rno'].'@'.$data['sess'].'@'.$data["iyear"];
       // DebugBreak();
        $image =  $this->set_barcode($Barcode);
     
       
        $pdf->Image("assets/img/logo2.png",0.4, 0.2, 0.65, 0.65, "PNG");
        $pdf->SetFont('Arial','',8);

        $pdf->Image('assets/img/download123.jpg',6.5, 1.6+$Y, 0.70, 0.70, "JPG");
        
        $FontSize=7;
        $HeightLine1= 1.75;
        $HeightLine2=2.0;
        $Y = -0.5;
        $pdf->Image(BARCODE_PATH.$image,3.3, 1.1+$Y  ,2.4,0.24,"PNG");
        
        $pdf->SetXY(0.5,1.7+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Name:",0,'L');
        $pdf->SetFont('Arial','B',$FontSize);
        $pdf->SetXY(1.5,1.7+$Y);
        $pdf->Cell(0.5,0.5,$data["OldName"],0,'L');
        //--------------------------- FATHER NAME 

        $pdf->SetXY(0.5, 1.85+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Father's Name:",0,'L');
        $pdf->SetFont('Arial','B',$FontSize);
        $pdf->SetXY(1.5,1.85+$Y);
        $pdf->Cell(0.5,0.5,$data["OldFname"],0,'L');
        
        $pdf->SetXY(0.5, 2.0+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Inter Info:",0,'L');
        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(1.5,2.0+$Y);
       // DebugBreak();
        $intersess = "";
        if(@$data['sess']==1)
        {
        $intersess = "A";
        }
        else if(@$data['sess']==2)
        {
        $intersess = "S";
        }
        $interinfo = @$data['rno']." (".$intersess." , ".@$data['iyear']." ) ".$data["InterRegNo"];
        $matsess = "";
        if(@$data['matSess']==1)
        {
        $matsess = "A";
        }
        else if(@$data['matSess']==2)
        {
        $matsess = "S";
        }
        $matricinfo = @$data['matrno']." (".$matsess." , ".@$data['matYear']." ) ".$data["matRegNo"];
        $pdf->Cell(0.5,0.5,$interinfo,0,'L');

        $pdf->SetXY(0.5, 2.15+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"SSC Info:",0,'L');
        $pdf->SetXY(1.5,2.15+$Y);
        //$pdf->Cell(0.5,0.5,"403058 ( A,2013, BISE, GUJRANWALA )",0,'L');
        $pdf->SetFont('Arial','B',9);   
        $pdf->Cell(0.5,0.5,$matricinfo,0,'L');   
        
        
        $pdf->SetXY(3.5+$x,1.85+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell(0.5,0.5,"Father CNIC:",0,'R');

        $pdf->SetFont('Arial','B',$FontSize);
        $pdf->SetXY(4.5+$x,1.85+$Y);
        $pdf->Cell(0.5,0.5,$data["FNIC"],0,'L');
        //--------------------------- BAY FORM NO line 
        $pdf->SetXY(3.5+$x, 1.70+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Bay Form No:",0,'L');
        $pdf->SetFont('Arial','B',$FontSize);
        $pdf->SetXY(4.5+$x,1.70+$Y);
        $pdf->Cell(0.5,0.5,$data["BForm"],0,'L');
        $pdf->SetXY(3.5+$x,2.0+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Mobile No:",0,'L');
        $pdf->SetFont('Arial','B',$FontSize);
        $pdf->SetXY(4.5+$x,2.0+$Y);
        $pdf->Cell(0.5,0.5,$data["MobNo"],0,'L');
        
        $pdf->SetXY(0.5,2.30+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Email",0,'L');
        $pdf->SetFont('Arial','B',$FontSize);
        $pdf->SetXY(1.5,2.30+$Y);
        $pdf->Cell(0.5,0.5,$data["CandEmail"],0,'L');
        
        $pdf->SetXY(0.5,2.65+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->MultiCell( 1.2,0.1,"Changing/Correction Reason:",'','L',0);
        $pdf->SetFont('Arial','B',$FontSize);
        $pdf->SetXY(1.50,2.65+$Y);
        $pdf->MultiCell(5, .1,$data['CorrectionReason'], '', "L",0);
        
        $pdf->SetXY(0.5,2.73+$Y);
        $pdf->SetFont('Arial','',7);
        $pdf->Cell( 0.5,0.5,"Address:",0,'L');
        $pdf->SetFont('Arial','B',7);
        $pdf->SetXY(1.5,2.93+$Y);
        $pdf->MultiCell(5, .1,$data['Address'], '', "L",0);
        
        
        $sex ="";
        if($data["sex"]==1)
        {
        $sex ="MALE";
        }
        else
        if($data["sex"]==2)
        {
        $sex ="FEMALE";
        }
        else
        {
        $sex = "";
        }
        $pdf->SetFont('Arial','B',$FontSize);
        $pdf->SetXY(6.6,2.45+$Y);                                               
        $pdf->Cell(0.5,0.5,$sex,0,'L');
        
        $pdf->SetXY(0.3, 3.10+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->MultiCell(1.0,0.1,"District / Institute Name:",0,'R',0);
        $pdf->SetXY(1.5, 2.92+$Y);
        $pdf->SetFont('Arial','B',$FontSize);
        $pdf->Cell( 0.5,0.5,@$data["inst_name"],0,'L');
        if($data["sex"])
        $pdf->SetXY(1.5, 2.92+$Y);
        $pdf->SetFont('Arial','B',7);
        $pdf->Cell( 0.5,0.5,'',0,'L');
         $pdf->SetXY(0.5,3.16+$Y);
        $pdf->SetFont('Arial','',7);
        $pdf->Cell( 0.5,0.5,"Address(in urdu):__________________________________________________________________________________________________________________",0,'L');
        
        $Y =$Y+0.29;
        $Y = $Y -.5;
       // $pdf->Image('assets/img/crossed.jpg',6.2,5.35+$Y, 1.3,0.15, "jpeg");  
        $pdf->SetXY(6.1,3.8+$Y);
        $pdf->Cell(1.4,1.5,'',1,0,'C',0); 
        $pdf->SetXY(6.3,3.8+$Y);
        $pdf->SetFont('Arial','B',9);
        $pdf->MultiCell(1.1,0.2, 'Paste recent photograph & must be cross attested by the Head/Deputy Head of institution',0,'C'); 

        $pdf->SetXY(6.1,5.5+$Y);
        $pdf->Cell(1.4,0.56,'',1,0,'C',0); 
        $pdf->SetXY(6.2,5.88+$Y);
        $pdf->SetFont('Arial','B',7);
        $pdf->MultiCell(1.1,0.2, 'Thumb Impression',0,'C'); 


        $Y = $Y -1.45;
        $boxWidth = 2.6;

        $this->load->library('NumbertoWord');
        $obj    = new NumbertoWord();
        $obj->toWords($data['TotalFee'],"Only.","");
        $feeInWords = ucwords($obj->words);//strtoupper(cNum2Words($totalfee)); 

      
        
        
        
        $pdf->SetXY(3.0,5.75+$Y);
        $pdf->SetFont('Arial','b',8);
        $pdf->Cell(0.2,0.5,"Stamp/Signature",0,'R');
        
        $pdf->SetXY(3.0,6.095+$Y);
        $pdf->SetFont('Arial','',8);
        $pdf->MultiCell( 1.2,0.1,"Headmaster/Headmistress/Principal Head Of Institution Name",'','L',0);
        //$pdf->Cell(0.2,0.5,"",0,'R');
        
        /*$pdf->SetXY(3.5,6.15+$Y);
        $pdf->SetFont('Arial','',8);
        $pdf->Cell(0.2,0.5,"Head Of Institution Name",0,'R');  */
        
        /*$pdf->SetXY(3.5,6.35+$Y);
        $pdf->SetFont('Arial','',8);
        $pdf->Cell(0.2,0.5,"School/College Code",0,'R'); */
       
        $pdf->SetXY(3.0,6.3+$Y);
        $pdf->SetFont('Arial','',8);
        $pdf->Cell(0.2,0.5,"CNIC : _________________________",0,'R');

        $pdf->SetXY(3.0,6.6+$Y);
        $pdf->SetFont('Arial','',8);
        $pdf->Cell(0.2,0.5,"Name : _________________________",0,'R');
         //$oldcertkind = "";
         //$newcertkind ="";
        $pdf->SetXY(0.5,5.05+$Y);
        $pdf->SetFont('Arial','b',9);
        $pdf->Cell(0.5,0.5,"Affidavit:-",0,'R');
        $pdf->SetXY(1.2,5.25+$Y);
        $pdf->SetFont('Arial','',8);
        $pdf->MultiCell(4.9, .15,"It is to certify that all the above information is correct and I change/correct my ".$certifytype." ". strtoupper($oldcertkind).' to '.strtoupper($newcertkind).'. I also certify that I am not a Government or Semi-Government Servant and if i make any mistake then the BORAD will authorise to take necessary action agianst me.',0, "J",0);

        $pdf->SetXY(0.5,5.75+$Y);
        $pdf->SetFont('Arial','b',7);
        $pdf->MultiCell( 1.2,0.1,"Candidate's Signature in Urdu",'','L',0);
        $pdf->SetXY(1.5,5.69+$Y);
        $pdf->Cell(1.8,0.5,"______________________",0,'R');
        $pdf->SetXY(0.5,6.25+$Y);
        $pdf->SetFont('Arial','b',7);
        $pdf->MultiCell( 1.2,0.1,"Candidate's Signature in English",'','L',0);
        $pdf->SetXY(1.5,6.15+$Y);
        $pdf->Cell(1.8,0.5,"_____________________",0,'R');

        $pdf->SetXY(0.2,6.6+$Y);
        $pdf->SetFillColor(0,0,0);                                     
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(0.2,0.5,"Branch Copy",0,'L');
        
        $pdf->SetXY(0.2,6.95+$Y);
        $pdf->SetFillColor(0,0,0);
        $pdf->SetTextColor(255,255,255);
        $pdf->SetFont('Arial','B',7);
        $pdf->Cell($boxWidth,0.2,'Due Date: '.date("d-m-y",strtotime("+10 days")),1,0,'C',1); 
        
        $pdf->SetXY(0.5,7.0+$Y);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial','B',7);
        $pdf->Cell(0.2,0.5,"Printing Date: " .date('d-M-Y h:i A'),0,'L');

        $pdf->SetXY(3.2,6.80+$Y);
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0.5,0.5,"CMD Account No. 00427900072103",0,'L');

        $pdf->SetXY(3.2,7+$Y);
        $pdf->SetFont('Arial','B',$FontSize+1.3);
        $pdf->Cell( 0.5,0.5,"Bank Challan No.  ".$data['AppNo'],0,'L');
        
        
        $Y = $Y - 0.5;
      
        $loawer = strtolower($corrFor);
        
        $pdf->SetXY(0.5, 7.73+$Y);
        $pdf->SetFont('Arial','',$FontSize+1.5);
        $pdf->Cell( 0.5,0.5,ucwords($loawer).':  '.$data['CorrectionFee'].'/-',0,'L');
        
        $pdf->SetXY(3.2, 7.73+$Y);
        $pdf->SetFont('Arial','',$FontSize+1.5);
        $pdf->Cell( 0.5,0.5,"Form Fee:  ".$data['FormFee']."/-",0,'L');
        
        $pdf->SetXY(0.5, 7.96+$Y);
        $pdf->SetFont('Arial','b',$FontSize+2.0);
        $pdf->Cell( 0.5,0.5,"Total Amount Rs.",0,'L');
        $data['TotalFee'] = $data['TotalFee'];
        $pdf->SetXY(1.5, 7.96+$Y);
        $pdf->SetFont('Arial','b',8);
        $pdf->Cell( 0.5,0.5,'  '.$data['TotalFee'].' /-',0,'L');
        
         $pdf->SetXY(2, 7.96+$Y);
        $pdf->SetFont('Arial','',$FontSize-0.5);
        $pdf->Cell( 0.5,0.5,"Amount in Words:",0,'L');
        
        $pdf->SetXY(2.8, 7.96+$Y);
        $pdf->SetFont('Arial','B',7);
        $pdf->Cell( 0.5,0.5,ucwords($feeInWords),0,'L');
        
         $pdf->SetXY(4, 8.3+$Y);
        $pdf->SetFont('Arial','b',$FontSize+0.5);
        $pdf->Cell( 0.5,0.5,"Manager/Cashier:___________________________ ",0,'L');
        
        $pdf->SetXY(0,5.0+3.0+$Y);
        $pdf->SetFont('Arial','',10);

        $pdf->Image('assets/img/cutter.jpg',0.2,8.8+$Y, 9.2,0.09, "jpeg"); 
        
        $Y = $Y -1;

       $pdf->SetFont('Arial','U',12);
        $pdf->SetXY(1.2,10.05+$Y);
        $pdf->Cell(0, 0.2, "BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, GUJRANWALA", 0.25, "C");
        
        $pdf->SetXY(0.2,10.14+$Y);
        $pdf->SetFillColor(0,0,0);                                     
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(0.2,0.5,"Candidate Copy",0,'L');
        $pdf->Image(BARCODE_PATH.$image,5.3, 10.55+$Y  ,2.4,0.24,"PNG");
        
        $pdf->SetFont('Arial','',8);
        $pdf->SetXY(2.48,10.25+$Y);
        $pdf->Cell(0, 0.2, strtoupper("CORRECTION FORM FOR ".$corrFor), 0.25, "C");
        
        $pdf->SetXY(0.2,10.45+$Y);
        $pdf->SetFillColor(0,0,0);
        $pdf->SetTextColor(255,255,255);
        $pdf->SetFont('Arial','B',7);
        $pdf->Cell($boxWidth,0.2,'Due Date: '.date("d-m-y",strtotime("+10 days")),1,0,'C',1); 
        
        $pdf->SetXY(0.5,10.49+$Y);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial','B',7);
        $pdf->Cell(0.2,0.5,"Printing Date: " .date('d-M-Y h:i A'),0,'L');

        $pdf->SetXY(3.2,10.30+$Y);
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0.5,0.5,"CMD Account No. 00427900072103",0,'L');

        
         $pdf->SetXY(6.6,10.9+$Y);
        $pdf->Cell(1.4,0.65,'',1,0,'C',0); 
        $pdf->SetXY(6.8,11.25+$Y);
        $pdf->SetFont('Arial','b',$FontSize+10);
        $pdf->MultiCell(1.1,0.2, 'O.W.O',0,'C'); 
        
        $pdf->SetXY(3.2,10.49+$Y);
        $pdf->SetFont('Arial','B',$FontSize+1.3);
        $pdf->Cell( 0.5,0.5,"Bank Challan No.  ".$data['AppNo'],0,'L');
       
        $pdf->SetXY(0.5, 10.73+$Y);
        $pdf->SetFont('Arial','',$FontSize+1.5);
        $pdf->Cell( 0.5,0.5,'Name'.':  '.$data['OldName'],0,'L');
        
        $pdf->SetXY(3.2, 10.73+$Y);
        $pdf->SetFont('Arial','',$FontSize+1.5);
        $pdf->Cell( 0.5,0.5,"Father's Name:  ".$data['OldFname'],0,'L');
       
        $pdf->SetXY(0.5, 10.93+$Y);
        $pdf->SetFont('Arial','',$FontSize+1.5);
        $pdf->Cell( 0.5,0.5,ucwords($loawer).':  '.$data['CorrectionFee'].'/-',0,'L');
        
        $pdf->SetXY(3.2, 10.93+$Y);
        $pdf->SetFont('Arial','',$FontSize+1.5);
        $pdf->Cell( 0.5,0.5,"Form Fee:  ".$data['FormFee']."/-",0,'L');
        
        $pdf->SetXY(0.5, 11.16+$Y);
        $pdf->SetFont('Arial','b',$FontSize+2.0);
        $pdf->Cell( 0.5,0.5,"Total Amount Rs.",0,'L');
        $data['TotalFee'] = $data['TotalFee'];
        $pdf->SetXY(1.5, 11.16+$Y);
        $pdf->SetFont('Arial','b',8);
        $pdf->Cell( 0.5,0.5,'  '.$data['TotalFee'].' /-',0,'L');
        
         $pdf->SetXY(2, 11.16+$Y);
        $pdf->SetFont('Arial','',$FontSize-0.5);
        $pdf->Cell( 0.5,0.5,"Amount in Words:",0,'L');
        
        $pdf->SetXY(2.8, 11.16+$Y);
        $pdf->SetFont('Arial','B',7);
        $pdf->Cell( 0.5,0.5,ucwords($feeInWords),0,'L');
        
         $pdf->SetXY(4, 11.3+$Y);
        $pdf->SetFont('Arial','b',$FontSize+0.5);
        $pdf->Cell( 0.5,0.5,"Manager/Cashier:___________________________ ",0,'L');
        
        $pdf->Image('assets/img/cutter.jpg',0.2,11.7+$Y, 9.2,0.09, "jpeg");  

        $pdf->SetFont('Arial','U',12);
        $pdf->SetXY(1.2,11.87+$Y);
        $pdf->Cell(0, 0.2, "BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, GUJRANWALA", 0.25, "C");
          
        $pdf->SetFont('Arial','',8);
        $pdf->SetXY(2.48,12.05+$Y);
        $pdf->Cell(0, 0.2, strtoupper("CORRECTION FORM FOR ".$corrFor), 0.25, "C");

        $pdf->SetXY(0.2,11.94+$Y);
        $pdf->SetFillColor(0,0,0);                                     
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(0.2,0.5,"Board Copy: (Along with Scroll) ",0,'L');
        $pdf->Image(BARCODE_PATH.$image,5.3, 12.4+$Y  ,2.4,0.24,"PNG");
        
        $pdf->SetXY(0.2,12.25+$Y);
        $pdf->SetFillColor(0,0,0);
        $pdf->SetTextColor(255,255,255);
        $pdf->SetFont('Arial','B',7);
        $pdf->Cell($boxWidth,0.2,'Due Date: '.date("d-m-y",strtotime("+10 days")),1,0,'C',1); 

        $pdf->SetXY(0.5,12.3+$Y);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial','B',7);
        $pdf->Cell(0.2,0.5,"Printing Date: " .date('d-M-Y h:i A'),0,'L');

        $pdf->SetXY(3.2,12.15+$Y);
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0.5,0.5,"CMD Account No. 00427900072103",0,'L');

        $pdf->SetXY(3.2,12.3+$Y);
        $pdf->SetFont('Arial','B',$FontSize+1.3);
        $pdf->Cell( 0.5,0.5,"Bank Challan No.  ".$data['AppNo'],0,'L');
         $Y = $Y -0.25;
       
         $pdf->SetXY(0.5, 12.73+$Y);
        $pdf->SetFont('Arial','',$FontSize+1.5);
        $pdf->Cell( 0.5,0.5,'Name'.':  '.$data['OldName'],0,'L');
        
        $pdf->SetXY(3.2, 12.73+$Y);
        $pdf->SetFont('Arial','',$FontSize+1.5);
        $pdf->Cell( 0.5,0.5,"Father's Name:  ".$data['OldFname'],0,'L');
       
        $pdf->SetXY(0.5, 12.93+$Y);
        $pdf->SetFont('Arial','',$FontSize+1.5);
        $pdf->Cell( 0.5,0.5,ucwords($loawer).':  '.$data['CorrectionFee'].'/-',0,'L');
        
        $pdf->SetXY(3.2, 12.93+$Y);
        $pdf->SetFont('Arial','',$FontSize+1.5);
        $pdf->Cell( 0.5,0.5,"Form Fee:  ".$data['FormFee']."/-",0,'L');
        
        $pdf->SetXY(0.5, 13.16+$Y);
        $pdf->SetFont('Arial','b',$FontSize+2.0);
        $pdf->Cell( 0.5,0.5,"Total Amount Rs.",0,'L');
        $data['TotalFee'] = $data['TotalFee'];
        $pdf->SetXY(1.5, 13.16+$Y);
        $pdf->SetFont('Arial','b',8);
        $pdf->Cell( 0.5,0.5,'   '.$data['TotalFee'].'/-',0,'L');
        
         $pdf->SetXY(2, 13.16+$Y);
        $pdf->SetFont('Arial','',$FontSize-0.5);
        $pdf->Cell( 0.5,0.5,"Amount in Words:",0,'L');
        
        $pdf->SetXY(2.8, 13.16+$Y);
        $pdf->SetFont('Arial','B',7);
        $pdf->Cell( 0.5,0.5,ucwords($feeInWords),0,'L');
        
         $pdf->SetXY(4, 13.3+$Y);
        $pdf->SetFont('Arial','b',$FontSize+0.5);
        $pdf->Cell( 0.5,0.5,"Manager/Cashier:___________________________ ",0,'L');
        
        $Y = $Y -0.35;
        

        $pdf->Image('assets/img/cutter.jpg',0.2,14.1+$Y, 8.3,0.09, "jpeg");  
         $Y = $Y +0.25;
        $pdf->SetFont('Arial','U',12);
        $pdf->SetXY(1.2,13.97+$Y);
        $pdf->Cell(0, 0.2, "BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, GUJRANWALA", 0.25, "C");     
        
         $pdf->SetFont('Arial','',8);
        $pdf->SetXY(2.48,14.13+$Y);
        $pdf->Cell(0, 0.2, strtoupper("CORRECTION FORM FOR ".$corrFor), 0.25, "C");

        $pdf->SetXY(0.2,14.02+$Y);
        $pdf->SetFillColor(0,0,0);                                     
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(0.2,0.5,"Bank Copy",0,'L');
        $pdf->Image(BARCODE_PATH.$image,5.3, 14.41+$Y  ,2.4,0.24,"PNG");  
        $pdf->SetXY(0.2,14.33+$Y);
        $pdf->SetFillColor(0,0,0);
        $pdf->SetTextColor(255,255,255);
        $pdf->SetFont('Arial','B',7);
        $pdf->Cell($boxWidth,0.2,'Due Date: '.date("d-m-y",strtotime("+10 days")),1,0,'C',1); 

        $pdf->SetXY(0.5,14.38+$Y);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial','B',7);
        $pdf->Cell(0.2,0.5,"Printing Date: " .date('d-M-Y h:i A'),0,'L');

        $pdf->SetXY(3.2,14.20+$Y);
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0.5,0.5,"CMD Account No. 00427900072103",0,'L');

        $pdf->SetXY(3.2,14.38+$Y);
        $pdf->SetFont('Arial','B',$FontSize+1.3);
        $pdf->Cell( 0.5,0.5,"Bank Challan No.  ".$data['AppNo'],0,'L');
          $Y = $Y -0.15;
          $pdf->SetXY(0.5, 14.73+$Y);
        $pdf->SetFont('Arial','',$FontSize+1.5);
        $pdf->Cell( 0.5,0.5,'Name'.':  '.$data['OldName'],0,'L');
        
        $pdf->SetXY(3.2, 14.73+$Y);
        $pdf->SetFont('Arial','',$FontSize+1.5);
        $pdf->Cell( 0.5,0.5,"Father's Name:  ".$data['OldFname'],0,'L');
       
        $pdf->SetXY(0.5, 14.93+$Y);
        $pdf->SetFont('Arial','',$FontSize+1.5);
        $pdf->Cell( 0.5,0.5,ucwords($loawer).':  '.$data['CorrectionFee'].'/-',0,'L');
        
        $pdf->SetXY(3.2, 14.93+$Y);
        $pdf->SetFont('Arial','',$FontSize+1.5);
        $pdf->Cell( 0.5,0.5,"Form Fee:  ".$data['FormFee']."/-",0,'L');
        
        $pdf->SetXY(0.5, 15.16+$Y);
        $pdf->SetFont('Arial','b',$FontSize+2.0);
        $pdf->Cell( 0.5,0.5,"Total Amount Rs.  ".$data['TotalFee']."/-",0,'L');
      
        /*$pdf->SetXY(1.5, 13.16+$Y);
        $pdf->SetFont('Arial','b',8);
        $pdf->Cell( 0.5,0.5,$data['TotalFee'].' /-',0,'L');           */
        
         $pdf->SetXY(2, 15.16+$Y);
        $pdf->SetFont('Arial','',$FontSize-0.5);
        $pdf->Cell( 0.5,0.5,"Amount in Words:",0,'L');
        
        $pdf->SetXY(2.8, 15.16+$Y);
        $pdf->SetFont('Arial','B',7);
        $pdf->Cell( 0.5,0.5,ucwords($feeInWords),0,'L');
        
         $pdf->SetXY(4, 15.3+$Y);
        $pdf->SetFont('Arial','b',$FontSize+0.5);
        $pdf->Cell( 0.5,0.5,"Manager/Cashier:___________________________ ",0,'L');    

        $pdf->Output($data["AppNo"].'.pdf', 'I');
    }
    public function Correction_form()
    {
       // DebugBreak();
        $data = array(
            'isselected' => '3',
        );
        if(!isset($_POST))
        {
            return false;
        }
        //   $this->load->model('Admission_model');
        $this->load->library('session');

        $error ="";

        if($this->session->flashdata('downerror'))
        {
            $error = $this->session->flashdata('downerror');
        }
        else{
            $error = "";
        }

        $this->load->view('common/Consolidated_Corrections/commonheader_Correction.php');
        $mydata = array('error'=>$error,'data'=>$_POST);

        $this->load->view('Consolidated_Corrections/Correction_form.php',$mydata);

        $this->load->view('common/Consolidated_Corrections/verCorrection.php');
    }
    public function Correction_form_insert()
    {

        //DebugBreak();
        $this->load->helper('url');
        $data = array(

            'isselected' => '0',
        );
        $this->load->library('session');
        $this->load->model('Consolidated_corrections_model');
        //  $data1 = array('Inst_Id'=>$Inst_Id);
        if(!( $this->session->flashdata('BatchList_update')))
        {

            $error_msg = '';  
        }
        else{
            $error_msg = $this->session->flashdata('BatchList_update');
        }
        //  DebugBreak();
        $ddlpurpose = $_POST['ddlpurpose'];
        $cand_name = strtoupper(@$_POST['cand_name']);
        $corr_cand_name = strtoupper(@$_POST['corr_cand_name']);
        $father_name = strtoupper(@$_POST['father_name']);
        $corr_father_name = strtoupper(@$_POST['corr_father_name']);
        $corr_dob = @$_POST['corr_dob'];
        $BForm = $_POST['BForm'];
        $FNIC = $_POST['FNIC'];
        $Email = strtoupper(@$_POST['Email']);
        $MobNo = $_POST['MobNo'];
        $candReason = strtoupper(@$_POST['candReason']);
        $Addr = strtoupper(@$_POST['Addr']);
        $hid_sscrno = $_POST['hid_sscrno'];
        $hid_sscyear = $_POST['hid_sscyear'];
        $hid_sscsess = $_POST['hid_sscsess'];
        $hid_hsscrno = $_POST['hid_hsscrno'];
        $hid_hsscyear = $_POST['hid_hsscyear'];
        $hid_hsscsess = $_POST['hid_hsscsess'];
        $hid_hsssClass = $_POST['hid_hsscClass'];
        if($ddlpurpose == 1 || $ddlpurpose == 4)
        {
            if($cand_name == "")
            {
                $data = $_POST;
                $data['error'] = "";
                //redirect()
            }
            else if($corr_cand_name == "")
            {
            }
        }
        if($ddlpurpose == 2 || $ddlpurpose == 5)
        {
            if($father_name == "")
            {
            }
            else if($corr_father_name == "")
            {
            }

        }
        if($ddlpurpose == 3)
        {

            if($corr_dob == "")
            {

            }

        }
      //  DebugBreak();
        $picpath = "";
        if($_POST['verFor']==1)
        {
         $picpath = $this->generatepath($hid_sscrno,10,$hid_sscyear,$hid_sscsess);
        }
        else if($_POST['verFor']==2)
        {
         $picpath = $this->generatepath($hid_hsscrno,$hid_hsssClass,$hid_hsscyear,$hid_hsscsess);
        }
        $_POST['picpath'] = $picpath;
        //generatepath($)
        //DebugBreak();
        $user_info  =  $this->Consolidated_corrections_model->Correction_form_insert($_POST);
        $user_info_arr = array('info'=>$user_info,'errors_RB_restore'=>$error_msg);
        // $NinthStdData = array('data'=>$this->BiseCorrections_model->get9thObjectionStdData());
        //$Logged_In_Array = $this->session->all_userdata();
        //$userinfo = $Logged_In_Array['logged_in'];
        $this->load->view('common/Consolidated_Corrections/commonheader_Correction.php',$user_info);
        //$this->load->view('common/menu.php',$data);
        $this->load->view('Consolidated_Corrections/FormDownloaded.php',$user_info_arr);
        $this->load->view('common/Consolidated_Corrections/verCorrection.php');
        /*if($user_info != "" && $user_info != false)
        {

        }   */


    }
    public function get_ssc_data()
    {
          //debugBreak();
        $rno= $_POST['rno'];
        $year= $_POST['year'];
        $sess=  $_POST['sess'];
        $dob = $_POST['dob'];
        $migto = 1;//$_POST['brd'];

        if($rno == "" || $rno == 0 || strlen($rno) < 5)
        {
            $value[0][0]['Mesg_server']  = "Please Provide Correct Roll No. ";
            echo json_encode($value);
        }
        else
            if($year == "" || $year == 0)
            {
                $value[0][0]['Mesg_server']  = "Please Select Year. If you do so, Refresh the Web Page.";
                echo json_encode($value);  
            }
            else
                if($sess == "" || $sess == 0)
                {
                    $value[0][0]['Mesg_server']  = "Please Select Session.";  
                    echo json_encode($value);  
                }
                else
                    if($dob == "" || $dob == 0)
                    {
                        $value[0][0]['Mesg_server']  = "Please Select DOB. ";
                        echo json_encode($value);  
                    }
                    else
                        if($migto == "" || $migto == 0)
                        {
                            $value[0][0]['Mesg_server']  = "Please Select Migrated Board.";
                            echo json_encode($value);  
                        }

                        else
                        {
                            $this->load->model('Consolidated_corrections_model');
                            $displaydob =  $dob;
                            $dob = date('d-m-Y',strtotime($dob));
                            $value = array($this->Consolidated_corrections_model->getresult_matric($rno,$year,$sess,$dob)) ;
                            if($value[0] != -1)
                            {
                                $value[0][0]['Mesg_server'] = '';
                              //  if(@$value[0][0]['Mesg'] == '')
                              //  {
                                   /* $path = $this->generatepath($value[0][0]['SSC_RNo'],$value[0][0]['SSC_CLASS'],$value[0][0]['SSC_Year'],$value[0][0]['SSC_Sess']);
                                    $isexit = file_exists($path);
                                    if(!file_exists($path))
                                    {
                                        $temp[0][0]['Mesg_server']  = 'Your Picture is missing' ;
                                        echo json_encode($temp);   
                                    }
                                    else
                                    {
                                        $type = pathinfo($path, PATHINFO_EXTENSION);
                                        $data = file_get_contents($path);
                                        $value[0][0]['PicPath'] = 'data:image/' . $type . ';base64,' . base64_encode($data);
                                        $value[0][0]['dob'] = $displaydob;
                                        echo json_encode($value);   
                                    } */

                                //}
                               // else
                               // {
                                   $value = $value[0][0] ;
                                    
                                    echo json_encode($value);    
                               // }


                            }
                            else
                            {
                                $value['Mesg_server']  = "Record Not Found.";
                                echo json_encode($value);    
                            }

        }


    }

    public function get_hssc_data()

    {
        //debugBreak();
        $rno = $_POST['RollNO'];
        $year = $_POST['vYear'];
        $sess =  $_POST['sess'];
        $matrno = $_POST['matrno'];
        //   $migto = $_POST['brd'];
        $intclass = $_POST['vClass'];

        if($rno == "" || $rno == 0 || strlen($rno) < 5)
        {
            $value[0][0]['Mesg_server']  = "Please Provide Correct Inter Roll No. ";
            echo json_encode($value);
        }
        else if($matrno == "" || $matrno == 0 || strlen($matrno) < 5)
        {
            $value[0][0]['Mesg_server']  = "Please Provide Correct Matric Roll No. ";
            echo json_encode($value);
        }
        else
            if($year == "" || $year == 0)
            {
                $value[0][0]['Mesg_server']  = "Please Select Year. If you do so, Refresh the Web Page.";
                echo json_encode($value);  
            }
            else
                if($sess == "" || $sess == 0)
                {
                    $value[0][0]['Mesg_server']  = "Please Select Session.";  
                    echo json_encode($value);  
                }
                else
                    if($intclass == "" || $intclass == 0)
                    {
                        $value[0][0]['Mesg_server']  = "Please Select Inter Class.";  
                        echo json_encode($value);  
                    }

                    /*else
                    if($migto == "" || $migto == 0)
                    {
                    $value[0][0]['Mesg_server']  = "Please Select Migrated Board.";
                    echo json_encode($value);  
                    }    */

                    else
                    {
                        $this->load->model('Consolidated_corrections_model');

                        $value = array($this->Consolidated_corrections_model->Pre_Matric_data($rno,$year,$sess,$matrno,$intclass)) ;
                        if($value[0] == false)
                        {
                            $value[0][0]['Mesg_server'] = 'No Record Found Against Your Given Information.';
                        }
                        /*else
                        {
                        // DebugBreak();
                        $path = $this->generatepath($value[0][0]['rno'],$value[0][0]['class'],$value[0][0]['iyear'],$value[0][0]['sess']);
                        $isexit = file_exists($path);
                        if(!file_exists($path))
                        {
                        $temp[0][0]['Mesg_server']  = 'Your Picture is missing' ;
                        echo json_encode($temp);   
                        }
                        else
                        {
                        $type = pathinfo($path, PATHINFO_EXTENSION);
                        $data = file_get_contents($path);
                        $value[0][0]['PicPath'] = 'data:image/' . $type . ';base64,' . base64_encode($data);

                        }  
                        $value[0][0]['Mesg_server'] = '';
                        }*/

                        // debugBreak();
                        $mydata = $value[0][0];
                        echo json_encode($mydata);

        }


    }

    public function Insert_ssc_data()
    {  

        $rno= $_POST['rno'];
        $year= $_POST['year'];
        $sess=  $_POST['sess'];
        $dob = $_POST['dob'];
        $migto = $_POST['migto'];
        $this->load->model('Verification_model');
        $info = array($this->Verification_model->insert_DATA_matric($rno,$year,$sess,date('Y-m-d',strtotime($dob)),$migto)) ;
        echo json_encode($info);



    }
    public function Insert_hssc_data()
    {
        $rno= $_POST['rno'];
        $year= $_POST['year'];
        $sess=  $_POST['sess'];
        $matrno = $_POST['matrno'];
        $intclass = $_POST['intclass'];
        $migto = $_POST['migto'];
        $this->load->model('Verification_model');
        $info = array($this->Verification_model->insert_DATA_inter($rno,$year,$sess,$matrno,$intclass,$migto)) ;
        echo json_encode($info);



    }
    public function downloadPage()
    {
        $info['app_No'] = $appno = $this->uri->segment(3);
        $this->load->view('common/commonheader_Verification.php');
        $this->load->view('NOC/FormDownloaded.php',$info);
        $this->load->view('common/verfooter.php');    
    }
    public function statusPage()
    {
        //   DebugBreak();
        $this->load->library('session');
        if($this->session->flashdata('noc_status'))
        {
            $alldata = $this->session->flashdata('noc_status'); 
            $alldata['remarks'] = $alldata[0]['remarks'];
            $alldata=$alldata[0];
            //  var_dump($alldata)      ;
        }
        else{
            $alldata['remarks'] = "";
        }

        $this->load->view('common/Consolidated_Corrections/commonheader_Correction.php',$alldata);
        $this->load->view('Consolidated_Corrections/default.php',$alldata);
        $this->load->view('common/Consolidated_Corrections/verCorrection.php',$alldata);    
    }
    public function statusPage_server()
    {
        //  DebugBreak();
        $appno = @$_POST['appNo'];
        if(!isset($appno))
        {
            return ;
        }
        //  $this->load->model('Verification_model');
        $this->load->model('Consolidated_corrections_model');
        if(isset($_POST['btnchk']))
        {
            $this->load->library('session');  

            $info = array($this->Consolidated_corrections_model->check_status($appno)) ; 


            $this->session->set_flashdata('noc_status',$info[0]);
            redirect('Consolidated_corrections/statusPage');
            return;    

        }
        if(isset($_POST['btnDownloadForm']))
        {
            redirect('noc/Print_challan_Form/'.$appno);
            return;   
        }






    }
    public function Download_NOC()
    {
        // DebugBreak();
        $appno = $this->uri->segment(3);
        $this->load->model('Verification_model');
        $info = array($this->Verification_model->Downolad_data($appno)) ;
        $this->load->library('PDFFWithOutPage');
        $pdf=new PDFFWithOutPage();   
        $pdf->SetAutoPageBreak(true,2);
        $pdf->AddPage('L',"A4");
        $this->makeNoc($pdf,$info);
        $pdf->Output('Result.pdf', 'I');  
        return;  
    }
    public function Print_challan_Form()
    {


       
        $formno = $this->uri->segment(3);

        $this->load->model('Consolidated_corrections_model');
        //$this->load->library('session');
        $this->load->library('NumbertoWord');
        //DebugBreak();
        $result = array($this->Consolidated_corrections_model->Downolad_data($formno)) ;
        $result = $result[0] ;
        //$Logged_In_Array = $this->session->all_userdata();
        //$user = $Logged_In_Array['logged_in'];
        // $this->load->model('NinthCorrection_model');
        //$grp_cd = $this->uri->segment(3);
        // $fetch_data = array('Inst_cd'=>$user['Inst_Id'],'formno'=>$formno);
        //  DebugBreak();
        //$result = $this->NinthCorrection_model->Print_challan_Form($fetch_data);
        //   $result = array('data'=>$this->NinthCorrection_model->Print_challan_Form($fetch_data));

        $this->load->library('pdf_rotate');
        //   $pdf = new PDF_Rotate('P','in',"A4"); 
        // $this->load->library('PDFFWithOutPage'); 
        //$pdf=new PDFFWithOutPage();   
        // $pdf->SetAutoPageBreak(true,2);
        //$pdf->AddPage('L',"A4");
        //for each type of correction total 7 types of corrections are now
        $ctid=1;  //correction type of id starts from one and multiples by 2 for next type of correction id
        //   $displayfeetitle=array(1=>'Name Correction', 2=>'Father Name Correction', 3=>'DOB Correction', 4=>'FNIC Correction', 5=>'B-Form Correction', 6=>'Picture Change', 7=>'Group Change', 8=>'Subject Change');
        // $feestructure = array();
        //  for($i=1;$i<=8;$i++){
        //$feetitle =  $result = array('data'=>$this->NinthCorrection_model->Print_challan_Form($fetch_data));
        // DebugBreak();
        if($result[0]['isother'] ==1)
        {
            $feestructure[]    =  "1600";    
            $displayfeetitle[] =  'NOC For Other Board';    
        }

        /*$feestructure[16]=$result[0]['BFormFee'];
        $feestructure[32]=$result[0]['PicFee'];
        $feestructure[64]=$result[0]['GroupFee'];
        $feestructure[128]=$result[0]['SubjectFee'];*/
        //  $ctid *= 2;
        // }
        //$totalfee \\


        $fontSize = 10; 
        $marge    = .95;   // between barcode and hri in pixel
        $bx        = 35.6;  // barcode center
        $by        = 23.75;  // barcode center
        $height   = 5.7;   // barcode height in 1D ; module size in 2D
        $width    = .26;  // barcode height in 1D ; not use in 2D
        $angle    = 0;   // rotation in degrees

        $code     = '222020';     // barcode (CP852 encoding for Polish and other Central European languages)
        $type     = 'code128';
        $black    = '000000'; // color in hex
        $Y = 3;
        $x = 5;

        $turn=1;     
        $pdf=new PDF_Rotate("P","in","A4");
        $pdf->AliasNbPages();
        $pdf->SetTitle("Challan Form | Application NOC Form");
        $pdf->SetMargins(0.5,0.5,0.5);
        $pdf->AddPage();
        $generatingpdf=false;
        $challanCopy=array(1=>"Depositor Copy",  2=>"OWO Branch Copy",3=>"Bank Copy", 4=>"Board Copy",);
        $challanMSG=array(1=>"(May be deposited in any HBL Branch)",2=>"(To be sent to the OWO Branch Via BISE One Window)", 3=>"(To be retained with HBL)", 4=>"(To be sent to the Board via HBL Branch aloongwith scroll)"  );
        $challanNo = $result[0]['Challan_No']; 

        /* if(date('Y-m-d',strtotime(Correction_Last_Date))>=date('Y-m-d'))
        {
        $rule_fee   =  $this->NinthCorrection_model->getreulefee(1); 
        $challanDueDate  = date('d-m-Y',strtotime($rule_fee[0]['End_Date'] )) ;
        }
        else
        {
        $rule_fee   =  $this->NinthCorrection_model->getreulefee(2); 
        $challanDueDate  = date('d-m-Y',strtotime($rule_fee[0]['End_Date'] )) ;
        }
        */
        //  DebugBreak();
        $obj    = new NumbertoWord();
        $obj->toWords($feestructure[0],"Only.","");
        // $pdf->Cell( 0.5,0.5,ucwords($obj->words),0,'L');
        $feeInWords = ucwords($obj->words);//strtoupper(cNum2Words($totalfee)); 

        //-------------------- PRINT BARCODE
        //  $pdf->SetDrawColor(0,0,0);
        $temp = $challanNo.'@'.$result[0]['app_No'].'@'.$result[0]['class'].'@2016@'.$result[0]['sess'];
        $image =  $this->set_barcode($temp);
        //DebugBreak();
        $bx        = 240.6;  // barcode center


        $Barcode = $temp;

        // $bardata = Barcode::fpdf($pdf, $black, $bx, $by, $angle, $type, array('code'=>$Barcode), $width, $height);

        //$len = $pdf->GetStringWidth($bardata['hri']);
        // Barcode::rotate(-$len / 2, ($bardata['height'] / 2) + $fontSize + $marge, $angle, $xt, $yt);
        // $temp =  $this->set_barcode($temp);

        $yy = 0.05;
        $dyy = 0.1;
        $corcnt = 0;
        for ($j=1;$j<=4;$j++) 
        {




            $yy = 0.04;
            if($turn==1){$dyy=0.1;} 
            else {
                if($turn==2){$dyy=2.65;} else  if($turn==3) {$dyy=5.2; } else {$dyy=7.75 ; $turn=0;}
            }
            $corcnt = 0;
            $pdf->SetFont('Arial','BI',11);
            $pdf->SetXY(1.0,$yy+$dyy);
            //   DebugBreak();
            $pdf->Cell(2.45, 0.4, "BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, GUJRANWALA", 0.25, "L");
            $pdf->Image(base_url()."assets/img/logo2.PNG",0.30,$yy+$dyy, 0.50,0.50, "PNG", "http://www.bisegrw.com");





            //  $pdf->Image(BARCODE_PATH.$Barcode,3.2, 1.15+$yy ,1.8,0.20,"PNG");
            //   $pdf->Image(BARCODE_PATH.$temp,5.8, $yy+$dyy+0.30 ,1.8,0.20,"PNG");
            $pdf->Image(base_url().BARCODE_PATH.$image,5.8, $yy+$dyy+0.30 ,1.8,0.20,"PNG");
            $challanTitle = $challanCopy[$j];
            $generatingpdf=true;


            if($turn==1){$dy=0.4;} else {
                if($turn==2){$dy=2.9;} else  if($turn==3) {$dy=5.5; }else {$dy=8.1 ; $turn=0;}
            }
            $turn++;
            $y = 0.08;

            //$pdf->SetFont('Arial','BI',14);
            //$pdf->SetXY(5.5,$y+$dy);
            //$pdf->Image(BARCODE_PATH.$image,3.2, 0.61  ,1.8,0.20,"PNG");
            //$pdf->Cell(0.5, $y, $challanCopy[$j], 0.25, "L");

            $pdf->SetFont('Arial','BI',9);
            $pdf->SetXY(1.0,$y+$dy);
            $pdf->Cell(0.5, $y, $challanCopy[$j], 0.25, "L");
            $w = $pdf->GetStringWidth($challanCopy[$j]);
            $pdf->SetXY($w+1.2,$y+$dy);
            $pdf->SetFont('Arial','I',7);
            $pdf->Cell(0, $y, $challanMSG[$j], 0.25, "L");

            $pdf->SetXY($w+1.4,$y+$dy+0.15);
            $pdf->SetFont('Arial','I',7);
            $pdf->Cell(0, $y, 'NOC', 0.25, "L");

            $y += 0.25;
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(0.5,$y+$dy-0.01);
            $pdf->SetFillColor(0,0,0);
            $pdf->Cell(1.5,0.2,'',1,0,'C',1);
            $pdf->SetFillColor(255,255,255);
            $pdf->SetTextColor(255,255,255);
            $pdf->SetXY(0.5,$y+$dy-0.01);
            $pdf->Cell(0, 0.25, "Due Date: ".date("d/m/y",strtotime("+10 days")), 0.25, "C");
            $pdf->SetTextColor(0,0,0);
            $pdf->SetFont('Arial','BI',8);
            $pdf->SetXY(2.0,$y+$dy-0.04);
            $pdf->Cell(0, 0.25, "Printing Date: ".date("d/m/y",time())."  Account Title: BISE, GUJRANWALA   CMD Account No. 00427900072103", 0.25, "C");
            //CMD Account No. 00427900072103
            //--------------------------- Fee Description
            $pdf->SetXY(2.8,$y+$dy);
            $pdf->SetFont('Arial','U',8);
            $pdf->Cell(0.5,0.5,"Fee Description",0,'L');

            //  DebugBreak();
            //--------------------------- Challan Depositor Information
            $pdf->SetXY(4,$y+0.1+$dy);
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell( 0.5,0.3,"Bank Challan No:".$challanNo."           Application No.".$result[0]['app_No'],0,2,'L');
            $pdf->SetFont('Arial','U',9);
            $pdf->Cell(0.5,0.25, "Particulars Of Depositor",0,2,'L');
            $pdf->SetX(4.0);
            $pdf->SetFont('Arial','B',8);
            //DebugBreak();
            if(intval($result[0]['sex'])==1){$sodo="S/O ";}else{$sodo="D/O ";}
            $pdf->Cell(0.5,0.25,$result[0]['name'].'    '.$sodo.$result[0]['fname'],0,2,'L');
            // $pdf->Cell(0.5,0.25,,0,2,'L');
            $pdf->SetX(4);
            $pdf->SetFont('Arial','I',6.5);
            // DebugBreak();
            //$pdf->Cell(0.5,0.3,"Institute Code: ".$user['Inst_Id'].'-'.$user['inst_Name'],0,2,'L');
            $pdf->MultiCell(4, .1, "",0);
            $pdf->SetXY(4,$y+1.15+$dy);
            $pdf->SetFont('Arial','B',9);
            $pdf->Cell(0.5,0.3,"Amount in Words: ".$feeInWords,0,2,'L');

            $x = 0.55;
            $y += 0.2;

            //------------- Fee Statement
            //  DebugBreak();
            $ctid=1;
            $multiply=1;

            /*    foreach ($feestructure as $value) {
            //  $value = $value * 2;

            $pdf->SetFont('Arial','',9);
            $pdf->SetXY(0.5,$y+$dy);
            $pdf->Cell( 0.5,0.5,$displayfeetitle[$ctid],0,'L');
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(3,$y+$dy);
            $pdf->Cell(0.8,0.5,$feestructure[$ctid],0,'C');
            $ctid *= 2;
            $y += 0.18;
            }*/
            //             DebugBreak();
            $total =  count($feestructure);
            for ($k = 0; $k<count($feestructure); $k++){


                $pdf->SetFont('Arial','',9);
                $pdf->SetXY(0.5,$y+$dy);

                //$feestructure = array(1=>0, 2=>0, 4=>0, 8=>0, 16=>0, 32=>0, 64=>0, 128=>0);
                $pdf->Cell( 0.5,0.5,$displayfeetitle[$k],0,'L');
                $pdf->SetFont('Arial','B',10);
                $pdf->SetXY(3,$y+$dy);
                $pdf->Cell(0.8,0.5,$feestructure[$k],0,'C');
                $y += 0.18;
                $corcnt = $k;




            }

            //------------- Total Amount


            if($corcnt ==0){
                $y += 1.0;
            }
            else if($corcnt ==1){
                $y += .7;
            }
            else if($corcnt ==2){
                $y += .6;
            }
            else if($corcnt ==3){
                $y += .4;
            }
            else if($corcnt ==4){
                $y += .3;
            }
            else if($corcnt ==5){
                $y += .2;
            }

            else if($corcnt ==6){
                $y += .16;
            }
            $y += -0.2;
            $pdf->SetFont('Arial','B',12);
            $pdf->SetXY(0.5,($y)+$dy);
            $pdf->Cell( 0.5,0.5,"Total Amount: ",0,'L');
            $pdf->SetFont('Arial','B',12);
            $pdf->SetXY(3,$y+$dy);
            $pdf->Cell(0.8,0.5,'1600/-',0,'C');

            //------------- Signature
            $y += 0.2;
            $pdf->SetFont('Arial','',10);
            $pdf->SetXY(0.5,$y+$dy);
            $pdf->Cell(0.5,0.5, 'Cashier: ___________________',0,'L');
            $pdf->SetXY(5.6,$y+$dy);
            $pdf->Cell(0.5,0.5, 'Manager: _________________',0,'L');    

            if ($turn>1){
                $y += 0.4;
                $pdf->Image( base_url().'assets/img/cut_line.png' ,0.3,$y+$dy, 7.5,0.15, "PNG");   
                // $pdf->Image("images/cut_line.png",0.3,$y+$dy, 7.5,0.15, "PNG");
            }
            // break;             
        }  
        if ($generatingpdf==true)
        {
            $pdf->Output('challanform.pdf','I');
        } else {
            $containsError=true;
            $errorMessage = "<br />Your Application is not found in accordance with given Application No.";
        }  

        //======================================================================================
        //  }

        //  $pdf->Output($data["Sch_cd"].'.pdf', 'I');
    }

    private function generatepath($rno,$class,$year,$sess)
    {
        $basepath = DIRPATH;
        $clsvr = '';
        $picyear= substr($year, -2);
        $folderno = '';
        if($class == 10  OR $class == 9)
        {
            $clsvr = 'MA'; 

        }
        else if($class == 12  OR $class == 11)
        {
            $clsvr = 'IA';
        }

        if($rno>=100001 && $rno<=150000)
        {
            $folderno = '1st';
        }
        else if($rno>=150001 && $rno<=200000)
        {
            $folderno = '2nd';
        }
        else if($rno>=200001 && $rno<=250000)
        {
            $folderno = '3rd';
        }
        else if($rno>=250001 && $rno<=300000)
        {
            $folderno = '4th';
        }
        else if($rno>=300001 && $rno<=350000)
        {
            if($class ==  10 OR $class ==  9)
                $folderno = '5th';
            else if($class ==  12 OR $class ==  11)
                $folderno = '6th';
        }
        else if($rno>=350001 && $rno<400000)
        {
            if($class ==  10 OR $class ==  9)
                $folderno = '6th';
            else if($class ==  12 OR $class ==  11)
                $folderno = '7th';
        }
        else if($rno>=400001 && $rno<=450000)
        {
            if($class ==  10 OR $class ==  9)
                $folderno = '7th';
            else if($class ==  12 OR $class ==  11)
                $folderno = '8th';

        }
        else if($rno>=450001 && $rno<=500000)
        {
            if($class ==  10 OR $class ==  9)
                $folderno = '8th';
            else if($class ==  12 OR $class ==  11)
                $folderno = '9th';
        }
        else if($rno>=500001 && $rno<550000)
        {
            $folderno = '9th';
        }
        else if($rno>=550001 && $rno<600000)
        {
            $folderno = '10th';
        }
        else if($rno>=600001 && $rno<650000)
        {
            $folderno = '11th';
        }


        $pic = 'Pic'.$picyear.'-'.$clsvr ;

        $foldername =   $clsvr.  $folderno .$picyear;
        $basepath =  $basepath.'\\'.$pic.'\\'. $foldername.'\\';
        return  $basepath.$rno.".jpg";
    }
    private function set_barcode($code)
    {
        //DebugBreak()  ;
        //load library
        $this->load->library('zend');
        //load in folder Zend
        $this->zend->load('Zend/Barcode');


        $file = Zend_Barcode::draw('code128','image', array('text' => $code,'drawText'=>false), array());
        //$code = $code;
        $store_image = imagepng($file,BARCODE_PATH."{$code}.png");
        return $code.'.png';

    }








}