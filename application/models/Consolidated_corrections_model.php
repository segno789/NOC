<?php
class Consolidated_corrections_model extends CI_Model 
{
    public function __construct()    {

        $this->load->database(); 
    }

    public function getresult_matric($rno,$year,$sess,$dob)
    {


        $query = $this->db->query("Registration..CORR_GET_STD_MATRIC $rno,$sess,$year,'$dob'");
        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {
            return $query->result_array();


        }
        else
        {
            return  -1;
        }
    }
     public function Correction_form_insert($data)
    {

       //  DebugBreak();
        //  $query = $this->db->query("Registration..NOC_GET_STD_MATRIC $rno,$sess,$year,'$dob'");
              $ddlpurpose = $data['ddlpurpose'];
              $corrFor = $data['verFor'];
              $cand_name = @$data['cand_name'];
              $corr_cand_name = @$data['corr_cand_name'];
              $father_name = strtoupper(@$data['father_name']);
              $corr_father_name =strtoupper(@$data['corr_father_name']);
              $dob = @$data['dob'];
              $corr_dob = @$data['corr_dob'];
              $BForm = $data['BForm'];
              $FNIC = $data['FNIC'];
              $Email = $data['Email'];
              $MobNo = $data['MobNo'];
              $candReason = $data['candReason'];
              $Addr = $data['Addr'];
              $hid_sscrno = $data['hid_sscrno'];
              $hid_sscyear = $data['hid_sscyear'];
             // $hid_sscyear = $data['hid_sscyear'];
              $hid_sscsess = $data['hid_sscsess'];
              $hid_hsscrno = $data['hid_hsscrno'];
              $hid_hsscyear = $data['hid_hsscyear'];
              $hid_hsscsess = $data['hid_hsscsess'];
              $hid_hsscClass = $data['hid_hsscClass'];
              $picpath = $data['picpath'];
              $inst_cd = "";
              $sex = "";
              
            //  DebugBreak();
              if($corrFor == 2)
              {
                 $query = $this->db->query("Registration..Corr_GET_Inter_STD_MAINFO $hid_hsscrno,$hid_hsscClass,$hid_hsscyear,$hid_hsscsess");
        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {

            $info =  $query->result_array();

            $matrno =    @$info[0]['matrno'];
            $sscsess =    @$info[0]['sessofpass'];
            $ssiyear =    @$info[0]['yearofpass'];
            $inst_cd =    @$info[0]['inst_cd'];
            $sex =    @$info[0]['sex'];
            $cand_name =    strtoupper($info[0]['Name']);
            $father_name = strtoupper($info[0]['Fname']);
            $regPvt =  @$info[0]['regPvt'];
            $dist_cd = @$info[0]['dist_cd'];
           

        }
        else
        {
            return  false;
        }
              }
              else if ($corrFor == 1)
              {
              //DebugBreak();
                 $query = $this->db->query("Registration..Prev_Get_Student_Matric_For_Corr $hid_sscrno,$hid_sscyear,$hid_sscsess"); //,$ssiyear,$sscsess,$rno,$year,$sess

            $rowcount = $query->num_rows();
            if($rowcount > 0)
            {
                $checkPreResult =     $query->result_array(); 
                $new_inter_rno =      @$checkPreResult[0]['rno'];
                $new_inter_class =    @$checkPreResult[0]['class'];  
                $new_inter_iyear =    @$checkPreResult[0]['iyear'];  
                $new_inter_sess =     @$checkPreResult[0]['sess'];  
                $inst_cd        =     @$checkPreResult[0]['inst_cd']; 
                $sex =    @$checkPreResult[0]['Gender']; 
                $cand_name =    strtoupper(@$checkPreResult[0]['Name']);
                $father_name = strtoupper(@$checkPreResult[0]['Fname']);
                $regPvt =  @$checkPreResult[0]['regPvt'];
                $dist_cd = @$checkPreResult[0]['dist_cd'];
            }
            
              }
        
        $formno = trim(@$myresult[0]['formno'],' ');
        $class = @$myresult[0]['class'];
        $iyear = @$year;
        //$name = $myresult[0]['name'];
        //$Fname = $myresult[0]['Fname'];
        $fnic = @$myresult[0]['FNIC'];
        $gender = @$myresult[0]['Gender'];
        $strregno = @$myresult[0]['strregno'];

        $status = @$myresult[0]['status'];
        $result1 = @$myresult[0]['result1'];
        $result2 = @$myresult[0]['result2'];

        if(!isset($status))
        {
            $status = 0;  
        }
        if(!isset($result1))
        {
            $result1 = 0;
        }
        if(!isset($result2))
        {
            $result2 = 0;
        }
        if(!isset($cand_name))
        {
            $cand_name = "";
        }
        if(!isset($corr_cand_name))
        {
            $corr_cand_name = "";
        }
        if(!isset($father_name))
        {
            $father_name = "";
        }
        if(!isset($corr_father_name))
        {
            $corr_father_name = "";
        }
        if(!isset($dob))
        {
            $dob = "";
        }
        if(!isset($corr_dob))
        {
            $corr_dob = "";
        }
        //$picpath = '';
        if($inst_cd == "")
        {
        $inst_cd = 0;
        }
        if($sex =="")
        {
        $sex = 0;
        }
        if(@$regPvt == "")
        {
        $regPvt = 0;
        }
        if(@$dist_cd == "")
        {
        $dist_cd = 0;
        }
        //DebugBreak();
        if(!isset($hid_hsscrno)|| $hid_hsscrno == "")
        {
           $hid_hsscrno=0;
        }
        if(!isset($hid_hsscyear) || $hid_hsscyear == "")
        {
               $hid_hsscyear=0;
        }
        if(!isset($hid_hsscsess) || $hid_hsscsess =="")
        {
             $hid_hsscsess = 0;
        }
        
      // debugbreak();
        $query_2 = $this->db->query("Registration..Insert_corr $hid_sscrno,$hid_sscsess,$hid_sscyear,$hid_hsscrno,$hid_hsscyear,$hid_hsscsess,$ddlpurpose,$corrFor,'$cand_name','$corr_cand_name','$father_name','$corr_father_name','$dob','$corr_dob','$BForm','$FNIC','$MobNo','$candReason','$Email','$Addr',$inst_cd,$sex,'$picpath',$regPvt,$dist_cd");
        $rowcount = $query_2->num_rows();
        if($rowcount > 0)
        {
            return $query_2->result_array();
        }
        else
        {   
            return false;

        }
    }
    public function Pre_Matric_data($rno,$year,$sess,$matrno,$intclass)
    {

        //DebugBreak();

        $matched = 0;
        $query = $this->db->query("Registration..Corr_GET_Inter_STD_MAINFO $rno,$intclass,$year,$sess");
        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {
            $info =  $query->result_array();

            $matrno =    $info[0]['matrno'];
            $sscsess =    $info[0]['sessofpass'];
            $ssiyear =    $info[0]['yearofpass'];

            $query = $this->db->query("Registration..Prev_Get_Student_Matric_For_Corr $matrno,$ssiyear,$sscsess"); //,$ssiyear,$sscsess,$rno,$year,$sess

            $rowcount = $query->num_rows();
            if($rowcount > 0)
            {
                $checkPreResult =     $query->result_array(); 
                $new_inter_rno =      $checkPreResult[0]['rno'];
                $new_inter_class =    $checkPreResult[0]['class'];  
                $new_inter_iyear =    $checkPreResult[0]['iyear'];  
                $new_inter_sess =     $checkPreResult[0]['sess'];
                $new_matric_rno =     $checkPreResult[0]['SSC_RNo'];  
                $new_matric_Year =     $checkPreResult[0]['SSC_Year'];  
                $new_matric_Sess =     $checkPreResult[0]['SSC_Sess'];  

                if($matrno != $new_matric_rno || $sscsess != $new_matric_Sess || $ssiyear != $new_matric_Year || $rno !=$new_inter_rno || $intclass != $new_inter_class || $year != $new_inter_iyear || $sess != $new_inter_sess   )
                {
                    return  false;
                }

                if($new_inter_iyear > $year) 
                {

                    $matched = 0;
                }
                else  if($new_inter_sess > $sess && $new_inter_iyear == $year)
                {
                    $matched = 0;
                }
                else
                {
                    $matched = 1;
                    $checkPreResult[0]['Mesg'] = '';
                }

                $checkPreResult[0]['matched']=$matched;
                return $checkPreResult;
            }
            else
            {
                return  false;
            }

        }
        else
        {
            return  false;
        }


        // DebugBreak();

    }
    public function insert_DATA_matric($rno,$year,$sess,$dob,$migratedto)
    {
        $dob1 = date('d-m-Y',strtotime($dob))   ;

        $query = $this->db->query("Registration..NOC_GET_STD_MATRIC $rno,$sess,$year,'$dob1'");
        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {
            $myresult =  $query->result_array();
            $multiquery = $myresult;  
            $this->db->select('app_No');
            $this->db->order_by("app_No", "DESC");
            $formno = $this->db->get_where('Registration..tblMig_testing_purpose', array('isother'=> 1, 'class'=>10));
            $rowcount = $formno->num_rows();
            //  DebugBreak();
            if($rowcount == 0 )
            {
                $formno =  (NOC_APP_NO.'1' );
                // return $formno;
            }
            else
            {
                $row  = $formno->result_array();

                $formno = $row[0]['app_No']+1;
                // return $formno;
            }
            // DebugBreak();
            $app_no =   $formno;
            $formno = $myresult[0]['formno'];
            $rno =    $myresult[0]['SSC_RNo'];
            $sess = $myresult[0]['SSC_Sess'];
            $iyear = $myresult[0]['SSC_Year'];
            $class = $myresult[0]['SSC_CLASS'];
            $name = $myresult[0]['name'];
            $Fname = $myresult[0]['Fname'];
            $fnic = $myresult[0]['FNIC'];
            $gender = $myresult[0]['Gender'];
            $strregno = $myresult[0]['strregno'];

            $status = $myresult[0]['status'];
            $result1 = $myresult[0]['result1'];
            $result2 = $myresult[0]['result2'];

            if(!isset($status))
            {
                $status = 0;  
            }
            if(!isset($result1))
            {
                $result1 = 0;
            }
            if(!isset($result2))
            {
                $result2 = 0;
            }



            $picpath = '';

            // debugbreak();
            $query_2 = $this->db->query("Registration..Insert_NOC_RECORD $app_no,'$formno',$rno,$sess,$iyear,$class,'$name','$Fname','$fnic',$gender,'$strregno',$migratedto,'$picpath',$status,$result1");
            $rowcount = $query_2->num_rows();
            if($rowcount > 0)
            {
                return $query->result_array();
            }
            else
            {   
                $query = $this->db->query("Registration..NOC_GET_INFO $app_no");
                $rowcount = $query->num_rows();
                if($rowcount > 0)
                {
                    return $query->result_array();
                }

            }


        }
        else
        {
            return  -1;
        }
    }
    public function insert_DATA_inter($rno,$year,$sess,$matrno,$intclass,$migratedto)
    {

        // DebugBreak();
        //  $query = $this->db->query("Registration..NOC_GET_STD_MATRIC $rno,$sess,$year,'$dob'");
        $query = $this->db->query("Registration..NOC_GET_Inter_STD_MAINFO $rno,12,$year,$sess");
        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {

            $info =  $query->result_array();

            $matrno =    $info[0]['matrno'];
            $sscsess =    $info[0]['sessofpass'];
            $ssiyear =    $info[0]['yearofpass'];

            $query = $this->db->query("Registration..Prev_Get_Student_Matric_For_NOC $matrno,$ssiyear,$sscsess"); //,$ssiyear,$sscsess,$rno,$year,$sess

            $rowcount = $query->num_rows();
            if($rowcount > 0)
            {
                $checkPreResult =     $query->result_array(); 
                $new_inter_rno =      $checkPreResult[0]['rno'];
                $new_inter_class =    $checkPreResult[0]['class'];  
                $new_inter_iyear =    $checkPreResult[0]['iyear'];  
                $new_inter_sess =     $checkPreResult[0]['sess'];  

            }
            else
            {
                return  false;
            }

        }
        else
        {
            return  false;
        }



        $myresult =  $checkPreResult;
        $multiquery = $myresult;  
        $this->db->select('app_No');
        $this->db->order_by("app_No", "DESC");
        $formno = $this->db->get_where('Registration..tblMig_testing_purpose',array('isother'=> 1, 'class'=>$intclass));
        $rowcount = $formno->num_rows();
        //  DebugBreak();
        if($rowcount == 0 )
        {
            $formno =  (NOC_APP_NO1.'1' );
            // return $formno;
        }
        else
        {
            $row  = $formno->result_array();

            $formno = $row[0]['app_No']+1;
            // return $formno;
        }
        // DebugBreak();
        $app_no =   $formno;
        $formno = trim($myresult[0]['formno'],' ');

        $class = $myresult[0]['class'];
        $iyear = $year;
        $name = $myresult[0]['name'];
        $Fname = $myresult[0]['Fname'];
        $fnic = $myresult[0]['FNIC'];
        $gender = $myresult[0]['Gender'];
        $strregno = $myresult[0]['strregno'];

        $status = $myresult[0]['status'];
        $result1 = $myresult[0]['result1'];
        $result2 = $myresult[0]['result2'];

        if(!isset($status))
        {
            $status = 0;  
        }
        if(!isset($result1))
        {
            $result1 = 0;
        }
        if(!isset($result2))
        {
            $result2 = 0;
        }



        $picpath = '';

        // debugbreak();
        $query_2 = $this->db->query("Registration..Insert_NOC_RECORD $app_no,'$formno',$rno,$sess,$iyear,$class,'$name','$Fname','$fnic',$gender,'$strregno',$migratedto,'$picpath',$status,$result1");
        $rowcount = $query_2->num_rows();
        if($rowcount > 0)
        {
            return $query->result_array();
        }
        else
        {   
            $query = $this->db->query("Registration..NOC_GET_INFO $app_no");
            $rowcount = $query->num_rows();
            if($rowcount > 0)
            {
                return $query->result_array();
            }

        }
    }
    public function Downolad_data ($app_no)
    {
        $query = $this->db->query("Registration..get_corr_formdata $app_no");
        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {
            return $query->result_array();
        }   
    }
    public function check_status ($appNo)
    {
    //DebugBreak();
        $this->db->select('status, remarks');
        //$this->db->order_by("app_No", "DESC");
        $formno = $this->db->get_where('Registration..tblcorr_temp1',array('appNo'=>$appNo));
        $rowcount = $formno->num_rows();
        //  DebugBreak();
        if($rowcount > 0 )
        {
            return $formno->result_array();
            // return $formno;
        }
        else
        {
            return false;
        }
    }
  
}
?>
