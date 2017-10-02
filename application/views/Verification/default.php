                                                          
    <style>
        .floatright{float:right;}
        .hr{
                border-top: 1px solid #BDB4BC;
    border-bottom: 1px solid white;
        }
        .body{    background-color: #f4f4f4;}
        .form-textbox, .form-dropdown{
   
    outline: 0;
    height: 25px;
    width:100%;
    padding-left: 10px;
   
   
   -moz-box-sizing: border-box; // Added rule
   -webkit-box-sizing: border-box; // Added rule
    box-sizing:border-box; // Added rule
}
    </style>
    <div class="container">
    <hr class="hr" />
    <div class="row">
        <div class="col-sm-12"></div>
    </div>
    <div class="row">
        <div class="col-sm-6 text-right">
            <label style="    font-size: 29px;"> Purpose of Verification : </label>
        </div>
        <div class="col-sm-2">
            <select name="ddlprupose" id="ddlprupose" style="font-size: 16px; font-weight: bold;">
                <!--<option value="0">SELECT ONE</option>-->
                <option selected=selected>Verification for Abroad</option>
                <!--<option>Departmental Verification</option>-->
            </select>
        </div>
    </div>

    <div class="row">
        <hr />
        <div class="col-sm-3  text-right">
            <label style="font-size: 18px;"> Verification For:</label> 
        </div>
        <div class="col-sm-7">
            <label class='radio-inline' style=" font-size: 18px; font-weight: 500;">
                <input type='radio' value='1' id='SSCOnly' name='verFor' style="width: 27px;    height: 15px;">
                SSC ONLY (matric)
            </label>
            <label class='radio-inline'  style="    font-size: 18px; font-weight: 500;">
                <input type='radio' id='HSSConly' value='2' name='verFor' style="width: 27px;    height: 15px;">
                HSSC ONLY(inter)
            </label>
            <label class='radio-inline'  style="    font-size: 18px; font-weight: 500;">
                <input type='radio' id='both' value='3' name='verFor' style="width: 50px;    height: 15px;">
                BOTH(matric + inter)
            </label>
        </div>
    </div>

    <div id="divSSC" style="display:none;">
        <hr class="hr" />
        <div class="row">
            <div class="col-sm-12 panel-heading " style="text-align: left;">
                <H3><b><u>SSC Information</u></b></H3>

            </div>
        </div>
        
        <div class="row">
            <div class="col-sm-1 text-right " >
                <label >Roll No:</label>
            </div>
            <div class="col-sm-2 ">
                <input type="text" id="sscrno" class="form-textbox"/>
            </div>
        </div>
        <br />
        <div class="row">
            <div class="col-sm-1  text-right">
                <label >Year:</label>
            </div>
            <div class="col-sm-2">
                <select id="ddlsscYear" class="form-dropdown" >
                    <option value="0">--select year--</option>
                    <option value="2016">2016</option>
                    <option value="2015">2015</option>
                    <option value="2014">2014</option>
                    <option value="2013">2013</option>
                    <option value="2012">2012</option>
                    <option value="2011">2011</option>
                    <option value="2010">2010</option>
                    <option value="2009">2009</option>
                    <option value="2008">2008</option>
                    <option value="2007">2007</option>
                    <option value="2006">2006</option>
                    <option value="2005">2005</option>
                    <option value="2004">2004</option>
                    <option value="2003">2003</option>
                    <option value="2002">2002</option>
                    <option value="2001">2001</option>
                    <option value="2000">2000</option>
                    <option value="1">BEFORE 2000</option>

                </select>
            </div>
        </div>
        <br />
        <div class="row">
            <div class="col-sm-1 " >
                <label class="control-label text-right" >Session:</label>
            </div>
            <div class="col-sm-2">
                <select id="ddlsscSess" class="form-dropdown">
                    <option value="0">--select session--</option>
                    <option value="1">ANNUAL</option>
                    <option value="2">SUPPLEMANTARY</option>
                </select>
            </div>
            <div class="col-sm-1">
                  <!--<label class="floatright" id="lblDisplyMessage" style="display: none; color: blue; font-weight: bold; font-size: large;">Please Enter Name and Marks</label>-->
            </div>
            <div class="col-sm-2 ">
                <label class="floatright" id="lblDisplyNameSSC" style="display: none;">Candidate Name:</label>
            </div>
            <div class="col-sm-5" style="text-align: left;">
                <input type="text" id="txtsscName" style="display: none; width:66%;" />
            </div>
        </div>
        <br />
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-2">
                <input type="button" class="btn btn-info" id = "btnVerifySSCRollNo" name="btnVerifySSCRollNo" onclick="verifyRollNo(10,sscrno.value, ddlsscYear.value, ddlsscSess.value)" value="VERIFY ROLL NO." />    
            </div>
            <div class="col-sm-3 " >
                <label class="floatright" id="lblDisplyObtMarksSSC" style="display: none;">Obtained Marks:</label>
            </div>
            <div class="col-sm-5"  style="text-align: left;">
                <input type="text" id="txtsscObtMarks" style="display: none;" />
            </div>
        </div>     
        <br />
        <div class="row">    
            <div class="col-sm-2 text-right " >
                <label >Number of Copies:</label>
            </div>
            <div class="col-sm-1 ">
                <input type="number" id="sscNumberOfCopies" value="1" class="form-textbox" style="width: 40px; height: 30px;"/>
            </div>     
            <div class="col-sm-3 " >
                <p>(Rs. 500 Per Extra copy)</p>
            </div>
        </div>
        <br />

    </div>


    <div id="divHSSC" style="display:none;">
        <hr class="hr" />
        <div class="row">
            <div class="col-sm-12 panel-heading" style="text-align: left;">
                <H3><b><u>HSSC Information</u></b></H3>

            </div>
        </div>
        <div class="row">
            <div class="col-sm-1 text-right" >
                <label >Roll No:</label>
            </div>
            <div class="col-sm-2 ">
                <input type="text" id="Hsscrno" class="form-textbox" />
            </div>
        </div>
        <br />
        <div class="row">
            <div class="col-sm-1  text-right">
                <label>Year:</label>
            </div>
            <div class="col-sm-2">
                <select id="ddlHsscYear" class="form-dropdown">
                    <option value="0">--select year--</option>
                    <option value="2016">2016</option>
                    <option value="2015">2015</option>
                    <option value="2014">2014</option>
                    <option value="2013">2013</option>
                    <option value="2012">2012</option>
                    <option value="2011">2011</option>
                    <option value="2010">2010</option>
                    <option value="2009">2009</option>
                    <option value="2008">2008</option>
                    <option value="2007">2007</option>
                    <option value="2006">2006</option>
                    <option value="2005">2005</option>
                    <option value="2004">2004</option>
                    <option value="2003">2003</option>
                    <option value="2002">2002</option>
                    <option value="2001">2001</option>
                    <option value="2000">2000</option>
                    <option value="1">BEFORE 2000</option>  
                </select>
            </div>
        </div>
        <br />
        <div class="row">
            <div class="col-sm-1 " >
                <label >Session:</label>
            </div>
            <div class="col-sm-2">
                <select id="ddlHsscSess" class="form-dropdown">
                    <option value="0">--select session--</option>
                    <option value="1">ANNUAL</option>
                    <option value="2">SUPPLEMANTARY</option>
                </select>
            </div>
            <div class="col-sm-1"></div>
            <div class="col-sm-2 ">
                <label class="floatright" id="lblDisplyNameHSSC" style="display: none;" >Candidate Name:</label>
            </div>
            <div class="col-sm-5" style="text-align: left;">
                <input type="text" id="txtHsscName" style="width:66%; display: none;" />
            </div>
        </div>
        <br />
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-2">
                <input type="button" class="btn btn-info" value="VERIFY ROLL NO." onclick="verifyRollNo(12,Hsscrno.value, ddlHsscYear.value, ddlHsscSess.value)"/>    
            </div>
            <div class="col-sm-3 ">
                <label class="floatright" id="lblDisplyObtMarksHSSC" style="display: none;">Obtained Marks:</label>
            </div>
            <div class="col-sm-5"  style="text-align: left;">
                <input type="text" id="txtHsscObtMarks" style="display: none;"/>
            </div>
        </div>
        <br />
        <div class="row">    
            <div class="col-sm-2 text-right " >
                <label >Number of Copies:</label>
            </div>
            <div class="col-sm-1 text-left">
                <input type="number" id="hsscNumberOfCopies" value="1" class="form-textbox" style="width: 40px; height: 30px;"/>
            </div>  
             <div class="col-sm-3 " >
                <p>(Rs. 500 Per Extra copy)</p>
            </div>   
        </div>
        <br />

    </div>

    <div id="divOtherinfo" style="display:none;">
        <hr class="hr" />
        <div class="row">
            <div class="col-sm-12" style="text-align: left;">
                <H3><b><u>OTHER Information</u></b></H3> 
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2 text-right">
                <label>CELL No:</label>
            </div>
            <div class="col-sm-2" >
                <input type="text" id="txtMobNo" class="form-textbox" />
            </div>
        </div>
        <br />
        <div class="row">
            <div class="col-lg-2 text-right">
                <label >IBCC Office:</label>
            </div>
            <div class="col-sm-2">
                <select id="ddlIBCCOffice" class="form-dropdown">
                    <option value="0">--select one--</option>
                    <option value="lhr">LAHORE</option>
                    <option value="isb">ISLAMABAD</option>
                </select>
            </div>
        </div>
        <br />
        <hr />
        <div class="col-sm-12 panel-heading" style="text-align: left;">
            <H3><b><u>ATTACHEMENTS</u></b></H3>

        </div>

        <div class="row" id="rowAttachPicture" >
            <div class="col-sm-3 text-right" >
                <label>PICTURE:</label>
            </div>               
            <div class="col-sm-2">
                <input type='file' id="inputFile" align="left" onchange="return ValidateFileUpload(this,'inputFile','#image_upload_preview');"/>
            </div>
            <div class="col-sm-4 text-left" >
                <img id="image_upload_preview" style="width:140px; height: 140px;" alt="Candidate Image">
            </div>
            <!--<div class="col-sm-1">
                <input type="button" value="Upload" id="btnPICUpload" />
            </div>   -->
        </div>
        <div class="row">
            <div class="col-sm-3 text-right">
                <label>CNIC COPY:</label>
            </div>
            <div class="col-sm-2">
                <input type="file" id="inputImageCnic" align="left" onchange="return ValidateFileUpload(this,'inputImageCnic','#cnic_upload_preview');" />
            </div>
            <div class="col-sm-4 text-left">
                <img id="cnic_upload_preview" style="width:140px; height: 140px;" alt="CNIC">
            </div>
<!--            <div class="col-sm-1">
                <input type="button" value="Upload" id="btnCNICUpload" />
            </div>              -->
        </div>
        <div class="row">
            <div class="col-sm-3 text-right">
                <label>SSC CERTIFICATE COPY:</label>
            </div>
            <div class="col-sm-2">
                <input type="file" id="inputImageSSCCOPY" align="left" onchange="return ValidateFileUpload(this,'inputImageSSCCOPY','#SSC_upload_preview');"/>
            </div>
            <div class="col-sm-4 text-left">
                <img id="SSC_upload_preview" style="width:140px; height: 140px;" alt="SSC CERTIFICATE">
            </div>
            <!--<div class="col-sm-1">
                <input type="button" value="Upload" id="btnSSCUpload" />
            </div>              -->
        </div>
        <div class="row">
            <div class="col-sm-3 text-right">
                <label>HSSC CERTIFICATE COPY:</label>
            </div>
            <div class="col-sm-2">
                <input type="file" id="inputImageHSSCCOPY" align="left" onchange="return ValidateFileUpload(this,'inputImageHSSCCOPY','#HSSC_upload_preview');" />
            </div>
            <div class="col-sm-4 text-left">
                <img id="HSSC_upload_preview" style="width:140px; height: 140px;" alt="HSSC CERTIFICATE">
            </div>
            <!--<div class="col-sm-1">
                <input type="button" value="Upload" id="btnHSSCUpload" />
            </div>-->
        </div>
        <br />
        <div class="row">
            <div class="col-sm-12 text-center">
                <button type="button" class="btn btn-primary btn-lg ">
                    APPLY FOR VERIFICATION
                </button>
            </div>


        </div>
    </div>
      

   
  