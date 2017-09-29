
 <style type="text/css">
   
.corr_check_box{
        width: 20px;    height: 20px;
}

    </style>
<div class="dashboard-wrapper class wysihtml5-supported">
    <div class="left-sidebar">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget">
                    <div class="widget-header" id="lblFormNo">
                        <div class="title">
                           <?php
                      //   DebugBreak();
                                       //echo @$data['ddlpurpose'];  
                                     ?>
                        </div>

                    </div>
                    <div class="widget-body">

                        <form class="form-horizontal no-margin" id="corr_form" name="corr_form" action="<?php  echo base_url(); ?>Consolidated_Corrections/Correction_form_insert" method="post" enctype="multipart/form-data">

                            <div class="control-group">
                                <h3 class="span4 title">
                                 <?php if(@$data['ddlpurpose'] == 1)
                               {
                               echo "Name Correction Form";
                               }
                               else if(@$data['ddlpurpose'] == 4) 
                               {
                               echo "Name Spelling Correction Form";
                               }
                               else if(@$data['ddlpurpose'] == 2) 
                               {
                               echo "Father's Name Correction Form";
                               }
                               else if(@$data['ddlpurpose'] == 5) 
                               {
                               echo "Father's Name Spelling Correction Form";
                               }
                               else if(@$data['ddlpurpose'] == 3) 
                               {
                               echo "Date of Birth Correction Form";
                               }
                               ?>
                                </h3>
                                </br>
                            <img src="../../assets/img/OnlineCorrectoin.jpg" alt="" style="width: 530px;">
                                <div class="controls controls-row">
                                    <input type="hidden" class="span2 hidden" id="ddlpurpose" name="ddlpurpose" value=" <?php echo @$data['ddlpurpose']; ?>">
                                 
                                </div>
                            </div>
                         
                           
                            <div id="div_confirmation">
                           
                            </div>
                            
                              <?php if(@$data['ddlpurpose'] == 1 || @$data['ddlpurpose'] == 4)
                               {
                               ?>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Candidate Name :
                                </label>
                                <div class="controls controls-row">
                                    <input class="span3" readonly="readonly"  type="text" id="cand_name" style="text-transform: uppercase;" name="cand_name" placeholder="Candidate Name" maxlength="60"  value="<?php   echo  @$data['CandName']; ?>" <?php  echo "readonly='readonly'";  ?>  >

                                  <!--  <label class="control-label span2" for="lblfather_name" >
                                        Correction  Candidate Name :  <input type="checkbox" class="corr_check_box" style="width: 20px;    height: 20px;" id="c0" name="c[]" value="1">
                                    </label> -->
                                    <label class="control-label span2" > Required Candidate Name:</label>
                                    <input class="span3" id="corr_cand_name" name="corr_cand_name" style="text-transform: uppercase; display:block;" type="text" placeholder="Candidate Name" maxlength="20" >
                                </div>

                            </div>
                            <?php } 
                            if(@$data['ddlpurpose'] == 2 || @$data['ddlpurpose'] == 5)
                            {
                            
                            ?>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Father's Name :
                                </label>
                                <div class="controls controls-row">
                                    <input class="span3" readonly="readonly" id="father_name" name="father_name" style="text-transform: uppercase;" type="text" placeholder="Father's Name" maxlength="60" value="<?php echo  @$data['CandFName']; ?>" <?php  echo "readonly='readonly'";  ?> required="required">
                                 
                                   <!-- <label class="control-label span2" >
                                        Correction  Father's Name :  <input type="checkbox" class="corr_check_box" id="c1" name="c[]" value="2" style="width: 20px;    height: 20px;"> 
                                    </label> -->
                                     <label class="control-label span2" > Required Father Name:</label>
                                    <input class="span3" id="corr_father_name" type="text"  style="text-transform: uppercase; display:block;" name="corr_father_name" placeholder="Father's Name"  maxlength="20">
                                </div>
                            </div>
                            <?php }
                            if(@$data['ddlpurpose'] == 3)
                            {
                            
                            ?>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Date of Birth:(dd-mm-yyyy)
                                </label>

                                <div class="controls controls-row">
                                    <input class="span3" type="text"  name="dob" placeholder="DOB" value="<?php $source = @$data['sscdob']; $date = new DateTime($source); echo $date->format('d-m-Y'); ?>" required="required" readonly="readonly"  <?php echo "readonly='readonly'"; ?> >

                                    <!--<label class="control-label span2" >
                                        Correction Date of Birth : <input type="checkbox" class="corr_check_box" id="c2" name="c[]" value="3" style="width: 20px;    height: 20px;"> 
                                    </label>                                                                                    -->
                                     <label class="control-label span2" > Required Date of Birth Name:</label>
                                    <input class="span3" id="corr_dob" name="corr_dob" readonly="readonly" style="display: block;"  type="text" placeholder="dd-mm-yyyy">
                                </div>
                            </div>
                             <?php } ?>
                        
                           <div class="control-group">
                                <label class="control-label span1" >
                                   Candidate B Form / CNIC :
                                </label>
                                <div class="controls controls-row">
                                    <input class="span3" id="BForm" name="BForm" style="text-transform: uppercase;" type="text" placeholder="B Form / CNIC" maxlength="60" value="<?php if(@$data['BForm']!=""){ echo @$data['BForm'];}  ?>" <?php if(@$data['BForm']!=""){  echo "readonly='readonly'";}  ?> required="required">
                                 
                                    <label class="control-label span2" >
                                        Father's CNIC : 
                                    </label> 
                                    <input class="span3" id="FNIC"  type="text"  style="text-transform: uppercase; " name="FNIC" placeholder="Father's CNIC" value="<?php  if(@$data['Fnic'] != ""){echo @$data['Fnic'];} ?>" <?php  if(@$data['Fnic'] != ""){echo "readonly='readonly'";}    ?>  maxlength="60">
                                </div>
                            </div>
                            
                              <div class="control-group">
                                <label class="control-label span1" >
                                   Candidate Email:
                                </label>
                                <div class="controls controls-row">
                                    <input class="span3"  id="Email" name="Email" style="text-transform: uppercase;" type="Email" placeholder="email@example.com" maxlength="50" value="<?php echo  @$data['Email']; ?>" required="required">
                                 
                                    <label class="control-label span2" >
                                        Candidate Mobile No: 
                                    </label> 
                                    <input class="span3" id="MobNo"  type="text"  style="text-transform: uppercase; " name="MobNo" placeholder="Mobile No."  maxlength="12">
                                </div>
                            </div>
                            
                            
                            <div class="control-group">
                                <label class="control-label span1" >
                                   Correction Authentic Reason :
                                </label>
                                <div class="controls controls-row">
                               <textarea id="candReason" name="candReason" class="span8"  cols="12" rows="4"   required="required" style="text-transform: uppercase;"  placeholder="Correction Reason"></textarea>
                                </div>
                            </div>
                              <div class="control-group">
                                <label class="control-label span1" >
                                   Address :
                                </label>
                                <div class="controls controls-row">
                                    <textarea id="Addr" name="Addr" class="span8"  cols="12" rows="4"   required="required" style="text-transform: uppercase;"  placeholder="Address"></textarea>
                                </div>
                            </div>

                            <div class="form-actions no-margin">
                                <input type="hidden"   value="<?php  echo @$data['CandSSCRno']; ?>" id="hid_sscrno" name="hid_sscrno">
                                <input type="hidden"   value="<?php  echo @$data['CandSSCYear']; ?>" id="hid_sscyear"  name="hid_sscyear">
                                <input type="hidden"   value="<?php  echo @$data['CandSSCSess']; ?>" id="hid_sscsess" name="hid_sscsess">
                                <input type="hidden"   value="<?php  echo @$data['CandHSSCRno']; ?>" id="hid_hsscrno" name="hid_hsscrno">
                                <input type="hidden"   value="<?php  echo @$data['CandHSSCYear']; ?>" id="hid_hsscyear"  name="hid_hsscyear">
                                <input type="hidden"   value="<?php  echo @$data['CandHSSCSess']; ?>" id="hid_hsscsess" name="hid_hsscsess">
                                <input type="hidden"   value="<?php  echo @$data['ddlHsscClass']; ?>" id="hid_hsscClass" name="hid_hsscClass">
                                <input type="hidden"   value="<?php  echo @$data['verFor']; ?>" id="verFor" name="verFor">
                                <button type="button" id="btnsubmitUpdateEnrol" name="btnsubmitUpdateEnrol" class="btn btn-large btn-info center " >
                                    Apply for Correction
                                </button>
                                <input type="button" class="btn btn-large btn-danger" value="Cancel" id="btnCancel" name="btnCancel" onclick="return CancelAlert();" >
                                <div class="clearfix">
                                </div>
                            </div>
                           
                        </form>
                        <script type="text/javascript">



 

                            function checks(){
                                debugger;
                                var msg = "Are You Sure You want to Cancel this Form ?"
                                alertify.confirm(msg, function (e) {
                                    if (e) {
                                          return true;
                                        // user clicked "ok"
                                       // window.location.href ='<?php echo base_url(); ?>index.php/Registration/EditForms';
                                    } else {
                                        return false; 
                                        // user clicked "cancel"

                                    }
                                });
                               /* var status  =  //check_NewEnrol_validation();
                                if(status == 0)
                                {

                                    return false;    
                                }
                                else
                                {

                                    return true;
                                } */


                            }
                            function CancelAlert()
                            {
                                var msg = "Are You Sure You want to Cancel this Form ?"
                                alertify.confirm(msg, function (e) {
                                    if (e) {
                                        // user clicked "ok"
                                        window.location.href ='<?php echo base_url(); ?>Consolidated_Corrections';
                                    } else {
                                        // user clicked "cancel"

                                    }
                                });
                            }
                            
                        </script>

                    </div>  

                </div>
            </div>
        </div>
    </div>
</div>
