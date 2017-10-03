
<?php
@$info = $info[0][0];
?>
<form enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>NOC/statusPage_server" >

    <div class="form-group">    
        <div class="row">
            <div class="col-md-12">
                <h3 align="center" class="bold">1- Check Status Section</h3>
            </div>
        </div>
    </div>

    <div class="form-group">    
        <div class="row">
            <div class="col-md-offset-3 col-md-6">
                <div class="alert alert-info fade in alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close"></a>
                    <strong>View your application status</strong>
                </div>
            </div>
        </div>
    </div>


    <div class="form-group">    
        <div class="row">
            <div class="col-md-offset-3 col-md-6">
                <label class="control-label" for="tsscrno" >Application No</label>
                <input type="text" id="appNo" maxlength="8" name="appNo" class="form-control" >
            </div>
        </div>
    </div>

    <div class="form-group">    
        <div class="row">
            <div class="col-md-offset-3 col-md-6">
                <input type="submit" value="Check Status" id="btnchk" name="btnchk" onclick="return check_downloand();" class="btn btn-primary btn-block">
            </div>
        </div>
    </div>
    <?php 
    $colorClass = "";
    $Msg = "";
      DebugBreak();
    if($info['IsActive']==0)
    {
        $colorClass ="class='alert alert-danger fade in alert-dismissable'";
        $Msg = "Application DELETED.";
    }
    else if($info['ismigrated']==1)
    {
        $colorClass ="class='alert alert-success fade in alert-dismissable'";
        $Msg = "Application Completed";
    }
    else if($info['ismigrated']==0 && $info['remarks']!="")
    {
        $colorClass ="class='alert alert-danger fade in alert-dismissable'";
        $Msg = "Application can not proceed due to ".$info['remarks'];
    }
    else if($info['ismigrated']==0 && $info['isverified']==0)
    {
        $colorClass ="class='alert alert-warning fade in alert-dismissable'";
        $Msg = "Application Under Process (Fee not verified!)";
    }
    else if($info['ismigrated']==0 && $info['isverified']==1 )
    {
        $colorClass ="class='alert alert-info fade in alert-dismissable'";
        $Msg = "Application Under Process (Fee verified!)";
    }
    /*else if($info['ismigrated']==0 && $info['isverified']==1 && $info['remarks']!="")
    {
        $colorClass ="class='alert alert-danger fade in alert-dismissable'";
        $Msg = "Application can not proceed due to ".$info['remarks'];
    } */

    if(isset($info['app_No']))
    {
        ?>

        <div class="form-group">    
            <div class="row">
                <div class="page-head-image col-md-offset-5">
                    <?php 
                    if(file_exists($info['picPath']))
                    {
                        $type = pathinfo(@$info['picPath'], PATHINFO_EXTENSION); 
                        @$image_path_selected = 'data:image/' . $type . ';base64,' . base64_encode(file_get_contents(@$info['picPath']));
                    } 
                    else 
                    {
                        @$image_path_selected = base_url()."assets/img/BrowseImage.png";
                    }  
                    ?>
                    <img id="previewImg" style="width:140px; height: 140px;" class="img-rounded" src="<?php echo  $image_path_selected ?> " alt="Candidate Image">
                </div>
            </div>
        </div>

        <div class="form-group">    
            <div class="row">
                <div class="col-md-offset-3 col-md-6">
                    <div <?php echo $colorClass; ?>>
                        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close"></a>
                        <strong>
                            <?php echo $Msg; ?>
                        </strong>
                    </div>
                </div>
            </div>
        </div>

        <fieldset>
            <div class="form-group">
                <div class="col-md-offset-3 col-md-6">
                    <label  class="control-label">Application ID:</label>
                    <input type="text" class="form-control" id='lblAppNo' value="<?php echo $info['app_No'];  ?>" readonly="readonly">    
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-offset-3 col-md-6">
                    <label  class="control-label">Roll No:</label>
                    <input type="text" class="form-control" value="<?php echo $info['Rno']."  "; 
                        if($info['class']==9)
                            {echo 'SSC-I'."  "; }
                        else if($info['class']==10)
                            {echo 'SSC-II'."  "; }
                            else if($info['class']==11)
                                {echo 'HSSC-I'."  "; }
                                else if($info['class']==12) 
                                    {echo 'HSSC-II'."  "; }  

                                    if($info['sess']==1)
                        {
                            echo 'Annual'."  ".$info['iyear']."  ";
                        }
                        else if($info['sess']==2)
                        {
                            echo 'Supplymentary'."  ".$info['iyear']."  ";
                        }

                        if($info['status']==1)
                        {
                            echo 'PASSED'."  ";
                        }
                        else if($info['status']==2)
                        {
                            echo 'FAIL'."  ";
                        }
                        else if($info['status']==3)
                        {
                            echo 'ABSENT'."  ";
                        }
                        ?>" readonly="readonly">
                </div>

            </div>
            <div class="form-group">
                <div class="col-md-offset-3 col-md-6">
                    <label class="control-label">Name:</label>
                    <input type="text" class="form-control" value="<?php echo $info['name'];  ?>" readonly="readonly">    
                </div>

            </div>
            <div class="form-group">
                <div class="col-md-offset-3 col-md-6">
                    <label class="control-label">Father Name:</label>
                    <input type="text" class="form-control" value="<?php echo $info['fname'];  ?>" readonly="readonly">    
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-offset-3 col-md-6">
                    <label class="control-label">Migration Applied for Board/University:</label>
                    <textarea rows="3" cols="50" class="form-control" readonly><?php echo $info['MigTo'];  ?></textarea>
                </div>
            </div>

            <div class="form-group">    
                <div class="row">
                    <div class="col-md-offset-3 col-md-6">
                    </div>
                </div>
            </div>

            <div class="form-group">    
                <div class="row">
                    <div class="col-md-offset-3 col-md-6">
                        <?php
                        if($info['ismigrated']==1 && $info['IsActive']==1)
                        {
                            ?>
                            <input type="button" value="Download NOC" id="DownloadNOC" name="DownloadNOC" onclick="return check_downloand();" class="btn btn-primary btn-block">
                            <input type="button" value="Cancel" id="gotoNocApp" name="gotoNocApp" onclick="window.location.href = '<?=base_url();?>NOC/'" class="btn btn-danger btn-block">
                            <?php
                        }
                        else if($info['ismigrated']==0 && $info['isverified']==0 && $info['IsActive']==1)
                        {
                            ?>
                            <input type="submit" value="Download Challan Form" id="btnDownloadForm" name="btnDownloadForm" onclick="return check_downloand();" class="btn btn-primary btn-block">
                            <input type="button" value="Cancel" id="gotoNocApp" name="gotoNocApp" onclick="window.location.href = '<?=base_url();?>NOC/'" class="btn btn-danger btn-block">
                            <?php
                        } 
                        ?> 
                    </div>
                </div>
            </div>     
        </fieldset> 

        <?php
    } 
    ?>
</form>
<?php
if(!isset($info))
{
    ?>
    <hr class="colorgraph">
    <form action="" name="noc_form" id="noc_form" >
        <div class="pull-right" id="instruction" style="width:600px" >
            <img src="<?php echo base_url(); ?>assets/img/Nocinst.jpg" class="img-responsive" alt="NOC Instructions.jpg">
        </div>

        <div class="form-group">    
            <div class="row">
                <div class="col-md-12">
                    <h3 align="center" class="bold">2- Application for NO Objection Certificate</h3>
                </div>
            </div>
        </div>

        <div class="form-group">    
            <div class="row">
                <div class="col-md-offset-3 col-md-3">
                    <label class="control-label" for="ddlprupose" >Type of NOC </label>
                    <select name="ddlprupose" id="ddlprupose" class="form-control" >
                        <option selected=selected>NOC For Other Board</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="control-label" for="nocFor" >NOC For</label>
                    <select name="nocFor" id="nocFor" class="form-control" >
                        <option value="0" selected=selected>SELECT ONE</option>
                        <option value="1">SSC ONLY</option>
                        <option value="2">HSSC ONLY</option>
                    </select>
                </div>
            </div>
        </div>

        <div id="dialog-confirm" title="Please Confirm Your Information in order to Proceed NOC Application."></div>

        <div id="divSSC" style="display:none;">
            <div class="form-group">    
                <div class="row">
                    <div class="col-md-12">
                        <h3 align="center" class="bold">SSC Information</h3>
                    </div>
                </div>
            </div>

            <div class="form-group">    
                <div class="row">
                    <div class="col-md-offset-3 col-md-3">
                        <label class="control-label" for="sscrno" >Roll No</label>
                        <input type="text" id="sscrno" maxlength="6"  class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label class="control-label" for="sscdob" >Date of Birth</label>
                        <input type="text" id="sscdob" name="sscdob" readonly="readonly" class="form-control">
                    </div>
                </div>
            </div>


            <div class="form-group">    
                <div class="row">
                    <div class="col-md-offset-3 col-md-3">
                        <label class="control-label" for="ddlsscYear" >Year</label>
                        <select id="ddlsscYear" class="form-control" >
                            <option value="0">SELECT YEAR</option>
                            <option value="2017">2017</option>
                            <option value="2016">2016</option>
                            <option value="2015">2015</option>
                            <option value="2014">2014</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="control-label" for="ddlsscSess" >Session</label>
                        <select id="ddlsscSess" class="form-control">
                            <option value="0">SELECT SESSION</option>
                            <option value="1">ANNUAL</option>
                            <option value="2">SUPPLEMANTARY</option>
                        </select>
                    </div>
                </div>
            </div>



            <div class="form-group">    
                <div class="row">
                    <div class="col-md-offset-3 col-md-3">
                        <label class="control-label" for="ddlHsscSess" >Class</label>
                        <select id="ddlSscClass" class="form-control" name="ddlHsscSess">
                            <option value="0">SELECT CLASS</option>
                            <option value="9">MATRIC PART-I</option>
                            <option value="10">MATRIC PART-II</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="control-label" for="MobNo" >Mobile No</label>
                        <input type="text" id="MobNo" name="MobNo"  placeholder="0345-1234567" class="form-control">
                    </div>
                </div>
            </div>

            <div class="form-group">    
                <div class="row">
                    <div class="col-md-offset-3 col-md-6">
                        <label class="control-label" for="ddlsscBrd" >Migrate To</label>
                        <select id="ddlsscBrd" class="form-control" name="ddlsscBrd">
                            <option value="0">PLEASE SELECT ONE</option>
                            <option value="2">BISE,  LAHORE</option>
                            <option value="3">BISE,  RAWALPINDI</option>
                            <option value="4">BISE,  MULTAN</option>
                            <option value="5">BISE,  FAISALABAD</option>
                            <option value="6">BISE,  BAHAWALPUR</option>
                            <option value="7">BISE,  SARGODHA</option>
                            <option value="8">BISE,  DERA GHAZI KHAN</option>
                            <option value="9">FBISE, ISLAMABAD</option>
                            <option value="10">BISE, MIRPUR</option>
                            <option value="11">BISE, ABBOTTABAD</option>
                            <option value="12">BISE, PESHAWAR</option>
                            <option value="13">BSE, KARACHI</option>
                            <option value="14">BISE, QUETTA</option>
                            <option value="15">BISE, MARDAN</option>
                            <option value="16">FBISE, ISLAMABAD</option>
                            <option value="17">CAMBRIDGE</option>
                            <option value="18">AIOU, ISLAMABAD</option>
                            <option value="19">BISE, KOHAT</option>
                            <option value="20">KARAKURUM</option>
                            <option value="21">MALAKAN</option>
                            <option value="22">BISE, BANNU</option>
                            <option value="23">BISE, D.I.KHAN</option>
                            <option value="24">AKUEB, KARACHI</option>
                            <option value="25">BISE, HYDERABAD</option>
                            <option value="26">BISE, LARKANA</option>
                            <option value="27">BISE, MIRPUR(SINDH)</option>
                            <option value="28">BISE, SUKKUR</option>
                            <option value="29">BISE, SWAT</option>
                            <option value="30">SBTE KARACHI</option>
                            <option value="31">PBTE, LAHORE</option>
                            <option value="32">AFBHE RAWALPINDI</option>
                            <option value="33">BIE, KARACHI</option>
                            <option value="34">BISE SAHIWAL</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">    
                <div class="row">
                    <div class="col-md-offset-3 col-md-6">
                        <label class="checkbox-inline">
                            <input type='checkbox' name='terms' id='terms'> 
                            I accept all the <a id="aTermsConditionsPopup" href="#">terms & conditions </a> of BISE, Gujranwala
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group">    
                <div class="row">
                    <div class="col-md-offset-3 col-md-6">
                        <input type="button" class="btn btn-primary btn-block" id = "btnVerifySSCRollNo" name="btnVerifySSCRollNo" onclick="return check_validate();" value="Verify Roll Number">
                    </div>
                </div>
            </div>

        </div>


        <div id="divHSSC" style="display:none;">
            <div class="form-group">    
                <div class="row">
                    <div class="col-md-12">
                        <h3 align="center" class="bold">HSSC Information</h3>
                    </div>
                </div>
            </div>



            <div class="form-group">    
                <div class="row">
                    <div class="col-md-offset-3 col-md-3">
                        <label class="control-label" for="tsscrno" >Matric Roll No</label>
                        <input type="text" id="tsscrno" name="sscrno" maxlength="6" class="form-control" >
                    </div>
                    <div class="col-md-3">
                        <label class="control-label" for="Hsscrno" >Inter Roll No</label>
                        <input type="text" id="Hsscrno" name="Hsscrno" maxlength="6"  class="form-control">
                    </div>
                </div>
            </div>


            <div class="form-group">    
                <div class="row">
                    <div class="col-md-offset-3 col-md-3">
                        <label class="control-label" for="ddlHsscYear" >Inter Year</label>
                        <select id="ddlHsscYear" class="form-control" >
                            <option value="0">SELECT YEAR</option>
                            <option value="2017">2017</option>
                            <option value="2016">2016</option>
                            <option value="2015">2015</option>
                            <option value="2014">2014</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="control-label" for="ddlHsscSess" >Inter Session</label>
                        <select id="ddlHsscSess" class="form-control">
                            <option value="0">SELECT SESSION</option>
                            <option value="1">ANNUAL</option>
                            <option value="2">SUPPLEMANTARY</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">    
                <div class="row">
                    <div class="col-md-offset-3 col-md-3">
                        <label class="control-label" for="ddlHsscClass" >Inter Class</label>
                        <select id="ddlHsscClass" class="form-control" name="ddlHsscSess">
                            <option value="0">SELECT CLASS</option>
                            <option value="11">INTER PART-I</option>
                            <option value="12">INTER PART-II</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="control-label" for="MobNo" >Mobile No</label>
                        <input type="text" id="MobNoHssc" name="MobNo"  placeholder="0345-1234567" class="form-control">
                    </div>
                </div>
            </div>


            <div class="form-group">    
                <div class="row">
                    <div class="col-md-offset-3 col-md-6">
                        <label class="control-label" for="ddlHsscBrd" >Migrate To</label>
                        <select id="ddlHsscBrd" class="form-control" name="ddlHsscBrd">
                            <option value="0">PLEASE SELECT ONE</option>
                            <option value="2">BISE,  LAHORE</option>
                            <option value="3">BISE,  RAWALPINDI</option>
                            <option value="4">BISE,  MULTAN</option>
                            <option value="5">BISE,  FAISALABAD</option>
                            <option value="6">BISE,  BAHAWALPUR</option>
                            <option value="7">BISE,  SARGODHA</option>
                            <option value="8">BISE,  DERA GHAZI KHAN</option>
                            <option value="9">FBISE, ISLAMABAD</option>
                            <option value="10">BISE, MIRPUR</option>
                            <option value="11">BISE, ABBOTTABAD</option>
                            <option value="12">BISE, PESHAWAR</option>
                            <option value="13">BSE, KARACHI</option>
                            <option value="14">BISE, QUETTA</option>
                            <option value="15">BISE, MARDAN</option>
                            <option value="16">FBISE, ISLAMABAD</option>
                            <option value="17">CAMBRIDGE</option>
                            <option value="18">AIOU, ISLAMABAD</option>
                            <option value="19">BISE, KOHAT</option>
                            <option value="20">KARAKURUM</option>
                            <option value="21">MALAKAN</option>
                            <option value="22">BISE, BANNU</option>
                            <option value="23">BISE, D.I.KHAN</option>
                            <option value="24">AKUEB, KARACHI</option>
                            <option value="25">BISE, HYDERABAD</option>
                            <option value="26">BISE, LARKANA</option>
                            <option value="27">BISE, MIRPUR(SINDH)</option>
                            <option value="28">BISE, SUKKUR</option>
                            <option value="29">BISE, SWAT</option>
                            <option value="30">SBTE KARACHI</option>
                            <option value="31">PBTE, LAHORE</option>
                            <option value="32">AFBHE RAWALPINDI</option>
                            <option value="33">BIE, KARACHI</option>
                            <option value="34">BISE SAHIWAL</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">    
                <div class="row">
                    <div class="col-md-offset-3 col-md-6">
                        <label class="checkbox-inline">
                            <input type='checkbox' name='terms' id='termshssc'> 
                            I accept all the <a id="aTermsConditionsPopupHssc" href="#">terms & conditions </a> of BISE, Gujranwala
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group">    
                <div class="row">
                    <div class="col-md-offset-3 col-md-6">
                        <input type="button" class="btn btn-primary btn-block" id = "btnVerifyHSSCRollNo" name="btnVerifyHSSCRollNo" onclick="return check_hssc_validate();" value="Verify Roll Number">
                    </div>
                </div>
            </div>
            <div id="dialog-message" title="You can apply for NOC with your following record."></div>
        </div>
    </form>
    <?php
}
?>









