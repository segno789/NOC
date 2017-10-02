<div class="dashboard-wrapper">
    <div class="left-sidebar">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget">
                    <div class="widget-header">
                        <div class="title" style="float: none !important;">
                            <label class="welcome_note myEngheading" style="float: left;">Please Provide Your Previous Exam Information</label>
                            <label class="myUrduheading" style="float: right;"> براۓ مہربانی سابقہ امتحان کی معلومات فراہم کریں </label>
                        </div>

                    </div>
                    <div class="widget-body">
                        <div id="dt_example" class="example_alt_pagination">
                            <div class="info"  style="position:relative;margin:0;padding:0;overflow:hidden;">
                                <!--FORM START-->
                                <form enctype="multipart/form-data" id="ReturnStatus" name="ReturnStatus" method="post" action="<?php echo base_url(); ?>/index.php/Admission/Pre_Matric_data" >
                                    <table width="99%" class="tbl_form fresh_cand" >
                                        <tbody>

                                            <tr>
                                                <td style="text-align: left;"><label class=mytblmargin><b>Date of Birth</b><br /><span class="mytblmargin">(DD-MM-YYYY)</span></label></td>
                                                <td><input type="text" class="panjang custom required" id="dob" name="dob" value="<?= @$dob?>"></td> 

                                                <td style="text-align: left;"><b class=mytblmargin>Old Roll No </b></td>
                                                <td><input required="required" type="text" class="panjang custom required" id="oldRno" name="oldRno" value="<?= @$oldRno ?>" maxlength="6" /></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: left;"><b class=mytblmargin>Class</b></td>
                                                <td><select id="oldClass" class="custom" name="oldClass">
                                                        <option value="10" <?php if(@$oldClass == 10) echo 'selected'?> >10</option>
                                                        <option value="9" <?php if(@$oldClass == 9) echo 'selected'?> >09</option>
                                                    </select></td>
                                                <td style="text-align: left;"><b class=mytblmargin>Year</b></td>
                                                <td><select id="oldYear" class="custom" name="oldYear">
                                                        <option value="2014" <?php if(@$oldYear == 2014) echo 'selected' ?> >2014</option>
                                                        <option value="2015" <?php if(@$oldYear == 2015) echo 'selected' ?> >2015</option>
                                                        <option value="2016" <?php if(@$oldYear == 2016) echo 'selected' ?>>2016</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: left;"><b class=mytblmargin>Session</b></td>
                                                <td><select id="oldSess" class="custom" name="oldSess">
                                                        <option value="1"  <?php if(@$oldSess == 1) echo 'selected' ?> >Annual</option>
                                                        <option value="2"  <?php if(@$oldSess == 2) echo 'selected' ?>>Supplementary</option>
                                                    </select>
                                                </td>
                                                <td style="text-align: left;"><b class=mytblmargin>Board</b></td>
                                                <td>
                                                    <select id="sec_board" class="custom" name="oldBrd_cd">
                                                        <option value="1" <?php if(@$oldBrd_cd == 1) echo 'selected' ?>>BISE, GUJRANWALA</option>
                                                        <option value="2" <?php if(@$oldBrd_cd == 2) echo 'selected' ?>>BISE,  LAHORE</option>
                                                        <option value="3" <?php if(@$oldBrd_cd == 3) echo 'selected' ?>>BISE,  RAWALPINDI</option>
                                                        <option value="4" <?php if(@$oldBrd_cd == 4) echo 'selected' ?>>BISE,  MULTAN</option>
                                                        <option value="5" <?php if(@$oldBrd_cd == 5) echo 'selected' ?>>BISE,  FAISALABAD</option>
                                                        <option value="6" <?php if(@$oldBrd_cd == 6) echo 'selected' ?>>BISE,  BAHAWALPUR</option>
                                                        <option value="7" <?php if(@$oldBrd_cd == 7) echo 'selected' ?>>BISE,  SARGODHA</option>
                                                        <option value="8" <?php if(@$oldBrd_cd == 8) echo 'selected' ?>>BISE,  DERA GHAZI KHAN</option>
                                                        <option value="9" <?php if(@$oldBrd_cd == 9) echo 'selected' ?>>FBISE, ISLAMABAD</option>
                                                        <option value="10" <?php if(@$oldBrd_cd == 10) echo 'selected' ?>>BISE, MIRPUR</option>
                                                        <option value="11" <?php if(@$oldBrd_cd == 11) echo 'selected' ?>>BISE, ABBOTTABAD</option>
                                                        <option value="12" <?php if(@$oldBrd_cd == 12) echo 'selected' ?>>BISE, PESHAWAR</option>
                                                        <option value="13" <?php if(@$oldBrd_cd == 13) echo 'selected' ?>>BISE, KARACHI</option>
                                                        <option value="14" <?php if(@$oldBrd_cd == 14) echo 'selected' ?>>BISE, QUETTA</option>
                                                        <option value="15" <?php if(@$oldBrd_cd == 15) echo 'selected' ?>>BISE, MARDAN</option>
                                                        <option value="16" <?php if(@$oldBrd_cd == 16) echo 'selected' ?>>FBISE, ISLAMABAD</option>
                                                        <option value="17" <?php if(@$oldBrd_cd == 17) echo 'selected' ?>>CAMBRIDGE</option>
                                                        <option value="18" <?php if(@$oldBrd_cd == 18) echo 'selected' ?>>AIOU, ISLAMABAD</option>
                                                        <option value="19" <?php if(@$oldBrd_cd == 19) echo 'selected' ?>>BISE, KOHAT</option>
                                                        <option value="20" <?php if(@$oldBrd_cd == 20) echo 'selected' ?>>KARAKURUM</option>
                                                        <option value="21" <?php if(@$oldBrd_cd == 21) echo 'selected' ?>>MALAKAN</option>
                                                        <option value="22" <?php if(@$oldBrd_cd == 22) echo 'selected' ?>>BISE, BANNU</option>
                                                        <option value="23" <?php if(@$oldBrd_cd == 23) echo 'selected' ?>>BISE, D.I.KHAN</option>
                                                        <option value="24" <?php if(@$oldBrd_cd == 24) echo 'selected' ?>>AKUEB, KARACHI</option>
                                                        <option value="25" <?php if(@$oldBrd_cd == 25) echo 'selected' ?>>BISE, HYDERABAD</option>
                                                        <option value="26" <?php if(@$oldBrd_cd == 26) echo 'selected' ?>>BISE, LARKANA</option>
                                                        <option value="27" <?php if(@$oldBrd_cd == 27) echo 'selected' ?>>BISE, MIRPUR(SINDH)</option>
                                                        <option value="28" <?php if(@$oldBrd_cd == 28) echo 'selected' ?>>BISE, SUKKUR</option>
                                                        <option value="29" <?php if(@$oldBrd_cd == 29) echo 'selected' ?>>BISE, SWAT</option>
                                                        <option value="30" <?php if(@$oldBrd_cd == 30) echo 'selected' ?>>SBTE KARACHI</option>
                                                        <option value="31" <?php if(@$oldBrd_cd == 31) echo 'selected' ?>>PBTE, LAHORE</option>
                                                        <option value="32" <?php if(@$oldBrd_cd == 32) echo 'selected' ?>>AFBHE RAWALPINDI</option>
                                                        <option value="33" <?php if(@$oldBrd_cd == 33) echo 'selected' ?>>BIE, KARACHI</option>
                                                        <option value="34" <?php if(@$oldBrd_cd == 34) echo 'selected' ?>>BISE SAHIWAL</option>
                                                        <option value="35" <?php if(@$oldBrd_cd == 35) echo 'selected' ?>>ISLAMIC UNIVERSITY</option>                                
                                                    </select>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>


                                    <div class="">
                                        <?php

                                        if(@$spl_cd != '' || @$spl_cd != null ) 
                                        {
                                            echo'<span style="font-size: 16pt; color:red;">Your Admissoin cannot be processed due to '.@$result2.'</span>';
                                        }
                                        else if(@$NextRno_Sess_Year != '' || @$NextRno_Sess_Year != null ) {
                                            echo'<span style="font-size: 16pt; color:red;">You have already appeared in  </span>';
                                            @$parts = explode(",", @$NextRno_Sess_Year);
                                            @$nxtrno = @$parts[0];
                                            @$nxtsess = @$parts[1];
                                            @$nxtyear = @$parts[2];

                                            if(@$nxtsess == '1')
                                            {
                                                @$nxtsess = 'Matric Annual';
                                            }
                                            else{
                                                @$nxtsess = 'Matric Supplementary';
                                            }
                                            echo'<span style="font-size: 16pt; color:red;">' . @$nxtsess . '</span>';
                                            echo'<span style="font-size: 16pt; color:red;">' . ',    ' . '</span>';
                                            echo'<span style="font-size: 16pt; color:red;">' . @$nxtyear . '</span>';
                                            echo'<span style="font-size: 16pt; color:red;">' . '   Against Roll No  = ' . '</span>';
                                            echo'<span style="font-size: 16pt; color:red;">' . @$nxtrno . '</span>';
                                        }

                                        else if(@$exam_type == 16){
                                            ?>
                                            <div align="center" id="option">
                                                <input type="radio" class="nationality_class" id="CatType1" value="1" name="CatType" style="width: 20px;height: 20px;">
                                                Marks Improvement &nbsp;&nbsp;
                                                <input type="radio" class="nationality_class" id="CatType2" value="2" name="CatType" style="width: 20px;height: 20px;">
                                                Additional</br>    
                                            </div>
                                            <?php }  
                                        else if(@$exam_type == 17){ ?>
                                            <span style="font-size: 16pt; color:red;">You have Already Appeared in Marks Improve and Additional Subjects</span>
                                            <?php } 
                                        else if(@$exam_type == 18){ ?>
                                            <span style="font-size: 16pt; color:red;">Your Result is NOT Clear</span>
                                            <?php } ?>
                                    </div>
                                    <div>
                                        <?php echo @$error; ?>
                                    </div>
                                    <div style="vertical-align:bottom;margin-top: 20px;">
                                        <input type="submit" value="Proceed" id="getinfoproceed"  name="getinfoproceed" onclick="return checkrno()" class="jbtn jmedium jblack">
                                        <input type="button" value="Cancel" onclick="return CancelAlert();"  class="jbtn jmedium jblack">
                                    </div>
                                </form>
                            </div>
                            <table width="99%">
                                <tbody>
                                    <tr>
                                        <th><b></b></th>
                                        <td colspan="2">
                                        </td>
                                    </tr> 
                                    <tr> 
                                        <td>
                                        </td>                      
                                        <td colspan="2" class="return_msg" style="color:#FF0000;font-size: 18px;">
                                            <?php 
                                            if(@$_GET['nrno'] >0)
                                            {
                                                if(@$_GET['nsession'] == 1)
                                                {
                                                    $sname = "Annual";
                                                }
                                                else if(@$_GET['nsession'] == 2)
                                                {
                                                    $sname = "Supplementary";
                                                }
                                                echo "You are appeared in  <b>$sname, ".$_GET['nyear']."</b> with Roll Number: <b>".$_GET['nrno']."</b>";    
                                            }
                                            if(@$_GET['nsplc'] != '')
                                            {
                                                echo "You are <b>".$_GET['nsplc']."</b></br> Please clear your objection from Matric Branch B.I.S.E Gujranwala";   
                                            }
                                            ?>
                                        </td>
                                        <td>
                                        </td>

                                    </tr>    
                                    <tr>
                                    </tr>                
                                </tbody>
                            </table>    

                            <?php
                            if(Session == '1'){
                                echo " <div class='black_bg' style='     margin-left: 0px;width: 99%;'> <table width='96%' style=' margin-left: 21px;text-transform: uppercase;'>
                                <tr>

                                <td width='50%' align='left'>                                           
                                <label class='myEngheading welcome_note'>For Fresh Composite(9th & 10th)</label>
                                </td>
                                <td class='myUrduheading' style='text-align: right;'>پہلی بار امتحان مے شمولیت کرنے والے امیدواران   (نہم اور دھم ) کے لیے </td>
                                <tr><td> <label class='myEngheading welcome_note'>Appeared before 2016 </label></td>
                                <td class=myUrduheading>٢٠١٤ سے پہلے امتحان دینے والے امیدواران </td></tr>
                                <tr><td><label class='myEngheading welcome_note'>candidates migrated from other Boards</label></td>
                                <td class='myUrduheading'>ایسے امیدواران جو دوسرے بورڈ سے آئے ہوں</td></tr>
                                <tr><td> <label class='myEngheading welcome_note'>Aama Passed Candidates </label></td>
                                <td class='myUrduheading'>عامہ پاس امیدواران کے لیے</td></tr>
                                <tr><td><label class='myEngheading welcome_note'>Aditional Candidates </label></td>
                                <td class=myUrduheading>اضافی مضامین دینے والے امیدواران </td></tr>
                                <tr><td><label class='myEngheading welcome_note'>Deaf And Dumb Candidates </label></td>
                                <td class='myUrduheading'>گونگے اور بہرے امیدواران کے لیے </td></tr>
                                <tr> <td colspan='2'> 
                                <input type='button' value='Click Here' onclick='window.parent.location='New-Pvt-Admission.php';' class='jbtn jmedium jblack'>
                                <!--<a href='New-Pvt-Admission.php' ><span style='color:#F00; font-size:25px; text-align: center;'> Click Here </span></a> -->

                                </td></tr>
                                </table>  </div>";
                            }
                            else{
                                echo "<hr>";
                            }
                            ?>
                            <p>  <strong style=" font-size: 24px;"> Please follow this fee structure </strong></p>
                            <img src="<?php echo base_url(); ?>assets/css_matric/images/matric_fee.png"  alt="Home Slide 3" />
                            <p>   <strong> Submit above fee + form fee+ processing fee+ Certificate Fee=100+195+550</strong></p>
                            <p >   <strong> Result will be RL-FEE if any student submit less fee than above criteria.</strong></p>
                            <div class="clearfix">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>



    </div>
</div>

<script type="text/javascript">


    function CancelAlert()
    {
        var msg = "Are You Sure You want to Cancel this Form ?"
        alertify.confirm(msg, function (e) {
            if (e) {
                window.location.href ='<?php echo base_url(); ?>index.php/Admission/index';
            } else {
            }
        });
    }


    function checkrno()
    {
        //debugger;
        var rno = document.getElementById("oldRno").value;//$("#oldRno").val();
        var dob = document.getElementById("dob").value; //$("#dob").val();


        if(dob == "")
        {
            alertify.error("Please write your Date of birth.")
            return false;
        }
        else if(rno == "0" || rno == '')
        {
            alertify.error("Please provide a valid Roll Number.")  

            return false;  
        }
    }
</script>