<footer style="margin-top: 30px;">
    <p>
        &copy; <?php echo date("Y"); ?> BISE Gujranwala All Rights Reserved.
    </p>
</footer>

<!--Add the following script at the bottom of the web page (before </body></html>)--> 
<script type="text/javascript" async="async" defer="defer" data-cfasync="false" src="https://mylivechat.com/chatinline.aspx?hccid=93646887"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/contents/jquery-1.10.2.min.js"></script>   
<link href="<?php echo base_url();?>assets/contents/bootstrap.min.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo base_url();?>assets/contents/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/alertify.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.fancybox.pack.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.mask.js"></script>




<script>
    $(document).ready(function () {

        $( "#corr_dob, #sscdob" ).datepicker({ dateFormat: 'dd-mm-yy',changeMonth: true, changeYear: true, maxDate: new Date(2002,1,1),yearRange: '1970:2002'}).val();
        $("#btnVerifyHSSCRollNo").click(function(){
            $("#btnVerifySSCRollNo").click();
        })
        
        $("#BForm,#FNIC").mask("99999-9999999-9",{placeholder:"_"});
        $("#MobNo").mask("9999-9999999",{placeholder:"_"});
        $("#corr_cand_name, corr_father_name").keypress(function(event){
        var inputValue = event.which;
        // allow letters and whitespaces only.
        if(!(inputValue >= 65 && inputValue <= 120) && (inputValue != 32 && inputValue != 0)) { 
         alertify.error('Please Use characters Only');
                return false;
            event.preventDefault(); 
        }
    });
        $("#sscrno,#BForm,#FNIC,#MobNo").keypress(function (e) {
            var challan = $("#sscrno").val();    
            if(challan.length >= 8 && (e.which != 13)) 
            {
                alertify.error('You cannot enter more than 8 digits');
                return false;
            }
            else if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) && (e.which != 13)) 
            {
                alertify.error('Please Use Numaric Only');
                return false;
            }
        });
        
        
        $("#aTermsConditionsPopup").click(function()
        {
            $.fancybox("#instruction");
        })
     $("#aTermsConditionsPopupHssc").click(function()
    {
     $.fancybox("#instruction");
    })
        $("#ddlpurpose").change(function(){
            if(this.value==3)
            {
                //$("input[name='verFor']:checked").val("1");
                $("#SSCOnly").prop('checked', true);
                $("#divSSC").show();
                $("#HSSConly").attr('disabled', true);

            }
            else
            {
                //$("input[name='verFor']:checked").val("1");
                $("#SSCOnly").removeAttr('checked'); 
                $("#divSSC").hide();
                $("#HSSConly").attr('disabled', false);


            }
        })  

        $("#btnsubmitUpdateEnrol").click(function(){
            //corr_dob
            // alertify.error("Hello button called");

            var cand_name =  $("#cand_name").val();
            var bform = $("#BForm").val();
            var FNIC = $("#FNIC").val();
            var MobNo = $("#MobNo").val();
            var candReason = $("#candReason").val();
            var Email = $("#Email").val();
            var addr = $("#Addr").val();
            var ddlpurpose = $("#ddlpurpose").val();
            var corr_father_name = $("#corr_father_name").val();
            var corr_cand_name = $("#corr_cand_name").val();
            var corr_dob = $("#corr_dob").val();

            // ddlpurpose 1 = Name Correction , 2 = Fname Correction , 3 = DOB Correction , 4 = Name Spelling Correction , 5 = Fname Spelling Correction.

            if(ddlpurpose == 1 || ddlpurpose == 4)
            {   
                if(cand_name == "")
                {
                    alertify.error("Please try again later due to some problem. If it still exist. Please contact Computer Cell Developer Section.")
                    return false
                }
                else if (corr_cand_name == "")
                {
                    alertify.error("Please Enter Correct Name First.");
                    $("#corr_cand_name").focus();
                    return false
                }
                 else if(corr_cand_name.trim().length < 3)
                {
                    alertify.error("Please Enter Correct Name First.")
                    return false
                }
            }

            else if(ddlpurpose == 2 || ddlpurpose == 5)
            {
                if(cand_name.trim() == "")
                {
                    alertify.error("Please try again later due to some problem. If it still exist. Please contact Computer Cell Developer Section.")
                    return false
                }
                else if (corr_father_name == "")
                {
                    alertify.error("Please Enter Correct Father Name First");
                    $("#corr_father_name").focus();
                    return false
                }
                 else if(corr_father_name.trim().length < 3)
                {
                    alertify.error("Please Enter Correct Father Name First.")
                    return false
                }
                
            }

            if(ddlpurpose == 3)
            {
                if(corr_dob == "")
                {
                    alertify.error("Please try again later due to some problem. If it still exist. Please contact Computer Cell Developer Section.")
                    return false
                }
                else if (corr_dob == "")
                {
                    alertify.error("Please Enter Correct Date of Birth First");
                    $("#corr_dob").focus();
                    return false
                }
                 else if (corr_dob.length.trim() < 10)
                {
                    alertify.error("Please Enter Correct Date of Birth in appropriate format First");
                    $("#corr_dob").focus();
                    return false
                }
            }

            if(bform == "")
            {
                alertify.error("Please Enter BFORM / CNIC First.");
                $("#BForm").focus();
                return false
            }
             else if(bform.length < 15)
            {
                alertify.error("Please Enter Correct BFORM.");
                $("#BForm").focus();
                return false
            }
            else if(FNIC == "")
            {
                alertify.error("Please Enter Father's CNIC First.");
                $("#FNIC").focus();
                return false
            }
            else if(FNIC.length < 15)
            {
                alertify.error("Please Enter Correct Father's CNIC First.");
                $("#FNIC").focus();
                return false
            }
            else if(Email.trim() == "")
            {
                alertify.error("Please Enter Email Address First");
                $("#Email").focus();
                return false
            }
            else if(MobNo == "")
            {
                alertify.error("Please Enter Mobile Number First.");
                $("#MobNo").focus();
                return false
            }
            else if(MobNo.length < 12)
            {
                alertify.error("Please Enter Correct Mobile Number First.");
                $("#MobNo").focus();
                return false
            }
            else if(candReason.trim() == "")
            {
                alertify.error("Please Enter Reason First");
                $("#candReason").focus();
                return false
            }
            
            else if(addr.trim() == "")
            {
                alertify.error("Please Enter Postal Address First");
                $("#Addr").focus();
                return false
            }
            else if(addr.trim().length < 3)
            {
                alertify.error("Please Enter Postal Address First");
                $("#Addr").focus();
                return false
            }
            else
            {
            
                 $("#btnsubmitUpdateEnrol").text("Please wait...").prop('disabled', true);
               
                $("#corr_form").submit();
            }



        })

        $("#btnVerifySSCRollNo").click(function (){

            //debugger;
            var termsssc = $('#terms').prop('checked'); 
            var termshssc = $('#termshssc').prop('checked'); 
            var ddlprupose = $("#ddlpurpose").val();
            var verFor =  $("input[name='verFor']:checked").val();
            var sscrno = $("#sscrno").val();
            var tsscrno = $("#tsscrno").val();
            var Hsscrno =$("#Hsscrno").val();
            var ddlHsscYear = $("#ddlHsscYear").val();
            var ddlHsscSess = $("#ddlHsscSess").val();
            var ddlHsscClass = $("#ddlHsscClass").val();
            var sscdob = $("#sscdob").val();
            var ddlsscYear = $("#ddlsscYear").val();
            var ddlsscSess = $("#ddlsscSess").val();

            if(verFor == 1)
            {
                if(ddlprupose == 0 )
                {
                    alertify.error("Please Correction Purpose First. ");
                    $("#ddlpurpose").focus();
                    return false;
                }
                if(sscrno == "" || sscrno == 0)
                {
                    alertify.error("Please write SSC Rno. ");
                    $("#sscrno").focus();
                    return false;
                }
                else  if(sscdob == "")
                {
                    alertify.error("Please write Date of Birth First");
                    $("#sscdob").focus();
                    return false;
                }
                else if(ddlsscYear == 0)
                {
                    alertify.error("Please Select SSC Year First. ");
                    $("#ddlsscYear").focus();
                    return false;
                }
                else if(ddlsscSess == 0)
                {
                    alertify.error("Please write SSC Session First. ");
                    $("#ddlsscSess").focus();
                    return false;
                }
                else if (terms == false)
                {
                    alertify.error("Please check the Terms and Conditions Check");
                    $('#terms').focus();
                    return false;
                }
                else
                {
                    $("#btnVerifySSCRollNo").val("Please wait...").prop('disabled', true);
                    var status = verifyRollNo_tenth(10,sscrno,ddlsscYear,ddlsscSess,sscdob);
                }

            }
            else if(verFor == 2)
            {


                if(ddlprupose == 0 )
                {
                    alertify.error("Please Correction Purpose First. ");
                    $("#ddlpurpose").focus();
                    return false;
                }
                else
                    if(tsscrno == "" ||  tsscrno == 0 )
                    {
                        alertify.error("Please write SSC Rno. ");
                        $("#tsscrno").focus();
                        return false;
                    }
                    else
                        if(Hsscrno == "" ||  Hsscrno == 0 )
                        {
                            alertify.error("Please write HSSC Rno. ");
                            $("#Hsscrno").focus();
                            return false;
                        }

                        else if(ddlHsscYear == 0)
                        {
                            alertify.error("Please Select HSSC Year First. ");
                            $("#ddlHsscYear").focus();
                            return false;
                        }
                        else if(ddlHsscSess == 0)
                        {
                            alertify.error("Please write HSSC Session First. ");
                            $("#ddlHsscSess").focus();
                            return false;
                        }
                        else if(ddlHsscClass == 0)
                        {
                            alertify.error("Please Select Class First");
                            $("#ddlHsscClass").focus();
                            return false;
                        }
                        else if (termshssc == false)
                        {
                            alertify.error("Please check the Terms and Conditions Check");
                            $('#termshssc').focus();
                            return false;
                        }
                        else
                        {
                            var status = verifyRollNo(12,Hsscrno,ddlHsscYear,ddlHsscSess,tsscrno);
                            /*  if(status = true)
                            {

                            } */
                        }

            }
            else
            {
                return false;
            }



        })
        function hideall() {
            $('#divSSC').hide();
            $('#divHSSC').hide();
            $('#divOtherinfo').hide();
        }


        $('input[type=radio][name=verFor]').change(function () {
            // debugger;
            var option = $('input[type=radio][name=verFor]:checked').val();
            if (option == 1) {
                hideall();
                $('#divSSC').show();
                $('#divOtherinfo').show();
            }
            else if (option == 2) {
                hideall();
                $('#divHSSC').show();
                $('#divOtherinfo').show();
            }
            else if (option == 3) {
                hideall();
                $('#divSSC').show();
                $('#divHSSC').show();
                $('#divOtherinfo').show();
            }
        });


    });
    function verifyRollNo(vClass,RollNO, vYear ,sess,matrno){

        jQuery.ajax({                    
            type: "POST",
            url: "<?php echo base_url(); ?>" + "Consolidated_Corrections/get_hssc_data",
            beforeSend: function() {  $('.mPageloader').show(); },
            complete: function() { $('.mPageloader').hide();},
            dataType: 'json',
            data: {vClass: vClass, RollNO: RollNO, vYear: vYear, sess: sess,matrno:matrno},                            
            success: function(json) {
                //var listitems;
                //alert('Hi i am success' );
                //    console.log("json my data = " +json.name); 
                //console.log(json.retData[0].obt_mrk); 


                if ( json.Mesg_server) {
                    // alert(json.d.length)
                    alertify.error("NO DATA FOUND AGINST YOUR PROVIDED INFORMATION!");
                    // $("#sscdob").val('');
                    $("#ddlHsscYear").val(0);
                    $("#ddlHsscSess").val(0);
                    $("#ddlHsscClass").val(0);
                    $("#tsscrno").val('');
                    $("#Hsscrno").val('');
                    $('input[name=terms]').attr('checked', false);
                    //$("#tsscrno").val();

                }
                else
                    if(vClass == 12) 
                    {                                               
                        /*$('#txtHsscName').val(json.name);                          
                        $('#txtHsscObtMarks').val(json.obt_mrk);                          
                        $('#txtHsscName').attr('readonly', true);
                        $('#txtHsscObtMarks').attr('readonly', true);   */
                        $('#CandName').val(json.Name);  
                        $('#CandFName').val(json.Fname);  
                        $('#CandDOB').val(json.Dob);  
                        $('#CandSSCRno').val(json.SSC_RNo);  
                        $('#CandSSCSess').val(json.SSC_Sess);  
                        $('#CandSSCYear').val(json.SSC_Year);  
                        $('#CandSSCBrdcd').val(json.SSC_Brd_cd);  
                        $('#CandSSCStatus').val(json.SSC_status); 
                        $('#CandHSSCRno').val(json.rno);  
                        $('#CandHSSCSess').val(json.sess);  
                        $('#CandHSSCYear').val(json.iyear);  
                        $('#CandHSSCStatus').val(json.status);
                        $('#BForm').val(json.BForm);
                        $('#Fnic').val(json.FNIC);

                        $("#corr_form").submit(); 
                        return true;    
                        //$('#lblDisplyMessage').show();

                    }




                if(vYear == 2000){                            
                    $('#rowAttachPicture').show();
                }
                //   $("#corr_form").submit();    



                // console.log(url);
                //$('#pvtZone').empty();
                //$('#pvtZone').append('<option value="0">SELECT ZONE</option>');
                //$.each(json, function (key, data) {

                //console.log(key)

                /*  $.each(data, function (index, data) {

                // console.log('Zone Name :', data.zone_name , ' Zone Code : ' ,data.zone_cd)
                listitems +='<option value=' + data.zone_cd + '>' + data.zone_name + '</option>';
                //$('#pvtZone').append('<option value=' + data.zone_cd + '>' + data.zone_name + '</option>');
                //console.log('Zone Name :', data.zone_cd)
                //console.log('Zone Name :', data)
                })*/
                //})
                //$('#pvtZone').append(listitems)
                /*console.log(data.length);
                for (var i = 0; i < data.length; i++) {

                console.log(" Thesil : "+ data[i].zone_name);
                // var checkBox = "<input type='checkbox' data-price='" + data[i].Price + "' name='" + data[i].Name + "' value='" + data[i].ID + "'/>" + data[i].Name + "<br/>";
                // $(checkBox).appendTo('#modifiersDiv');
                }*/
                //if (json)
                //{
                //var obj = jQuery.parseJSON(json);
                //  console.log(json.teh[0].zone_name);
                //alert( obj['teh']['Class']);
                //   alert(res.Sess);
                //   alert(res.Class);
                //   //debugger;
                //   Show Entered Value
                //   jQuery("div#result").show();
                //   jQuery("div#value").html(res.username);
                //   jQuery("div#value_pwd").html(res.pwd);
                //}

            },                        
            error: function(request, status, error){
                alert(request.responseText);
            }
        });

        //  $("#corr_form").submit(); 

    } 
    function verifyRollNo_tenth(vClass,RollNO, vYear ,sess,dob){

        jQuery.ajax({                    
            type: "POST",
           beforeSend: function() {  $('.mPageloader').show(); },
           complete: function() { $('.mPageloader').hide();},
            url: "<?php echo base_url(); ?>" + "Consolidated_Corrections/get_ssc_data",
            dataType: 'json',
            data: {vClass: vClass, rno: RollNO, year: vYear, sess: sess,dob:dob},                            
            success: function(json) {
                /*   if(vClass == 10) {
                $('#txtsscName').show();
                $('#txtsscObtMarks').show();
                $('#lblDisplyNameSSC').show();
                $('#lblDisplyObtMarksSSC').show();
                }*/
                // console.log(json);
                if ( json.Mesg_server) {
                    // alert(json.d.length)
                    alertify.error("NO DATA FOUND AGINST YOUR PROVIDED INFORMATION!");
                    $("#sscdob").val('');
                    $("#ddlsscYear").val(0);
                    $("#ddlsscSess").val(0);
                    $("#sscrno").val('');
                    $('input[name=terms]').attr('checked', false);
                    $("#btnVerifySSCRollNo").val("VERIFY ROLL NO.").prop('disabled', false);
                    //$("#tsscrno").val();

                }
                else if(json.name.length> 0)
                {   

                    $('#CandName').val(json.name);  
                    $('#CandFName').val(json.Fname);  
                    //$('#CandDOB').val(json.Dob);  
                    $('#CandSSCRno').val(json.SSC_RNo);  
                    $('#CandSSCSess').val(json.SSC_Sess);  
                    $('#CandSSCYear').val(json.SSC_Year);  
                    $('#CandSSCBrdcd').val(json.SSC_brd_cd);  
                    //   $('#CandSSCStatus').val(json.SSC_status); 
                    $('#CandHSSCRno').val(json.irno);  
                    $('#CandHSSCSess').val(json.interSess);  
                    $('#CandHSSCYear').val(json.iyear);  
                    $('#CandHSSCStatus').val(json.Inter);  
                    $('#BForm').val(json.BForm);
                    $('#Fnic').val(json.FNIC);

                    $('#txtsscObtMarks').val(json.obt_mrk);                          
                    $('#txtsscName').attr('readonly', true);
                    $('#txtsscObtMarks').attr('readonly', true);

                    $("#corr_form").submit();   
                    //$('#lblDisplyMessage').show();



                    // return true;  
                }
                else{
                }

                if(vYear == 2000){                            
                    $('#rowAttachPicture').show();
                }

            },                        
            error: function(request, status, error){
                alert(request.responseText);
            }
        });
        
    } 
    function checkstatus()
    {
        // debugger;
        var appno = $("#appNo").val();
        if(appno == "")
        {
            alertify.error("Please write you application no. First");
            $("#appNo").focus();
            return false;
        }
        else
        {
            return true 
        }


    }

    function download_chk()
    {
        // debugger;
        var appno = $("#appNo").val();
        if(appno == "")
        {
            alertify.error("Please write you application no. First");
            $("#appNo").focus();
            return false;
        }
        else
        {
            window.location.href = '<?=base_url()?>Consolidated_Corrections/getForm/'+appno 
        }


    } 

    //------------------------file upload review-------------------------------

    function ValidateFileUpload(a,inputFile,fileReview) { 
        debugger;                                                                                         
        var fuData = document.getElementById(inputFile);
        var FileUploadPath = fuData.value;
        if (FileUploadPath == '') {
            alert("Please upload an image");
            jQuery(fileReview).removeAttr('src');
        } 
        else {
            var Extension = FileUploadPath.substring(
                FileUploadPath.lastIndexOf('.') + 1).toLowerCase();
            if (Extension == "jpeg" || Extension == "jpg") {
                if (fuData.files && fuData.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $(fileReview).attr('src', e.target.result);
                    }
                    reader.readAsDataURL(fuData.files[0]);
                }
            } 
            else {
                document.getElementById(inputFile).removeAttr('value');
                jQuery(fileReview).removeAttr('src');
                alert("Image only allows file types of JPEG. ");
                return false;
            }
        }
        var file_size = document.getElementById(inputFile)[0].files[0].size;
        if(file_size>30480) {                                    
            document.getElementById(inputFile).removeAttr('value');
            jQuery(fileReview).removeAttr('src');
            alert("File size can be between 30KB"); 
            return false;
        } 
    } 
    //------------------------end, file upload review-------------------------------
</script>        




</body>
</html>

