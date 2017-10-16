
<form enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>index.php/Traceapplication/TraceFile">
    <?php
    @$info = $info[0];
    if(@$err['Error'])
    {
        ?>
        <div class="alert alert-danger fade in alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
            <strong><?php echo $err['Error'] ?></strong>
        </div>
        <?php
    }
    ?>
    <div id="hideDiv1">
        <div class="form-group">    
            <div class="row">
                <div class="col-md-12">
                    <h3 align="center" class="bold">TRACE YOUR APPLICATION</h3>
                </div>
            </div>
        </div>
        <div class="form-group">    
            <div class="row">
                <div class="col-md-offset-3 col-md-6">
                    <div class="alert alert-info fade in alert-link">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close"></a>
                        <strong>View your application status</strong>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">    
            <div class="row">
                <div class="col-md-offset-3 col-md-6">
                    <label class="control-label" for="tsscrno" >File No/One-Window No</label>
                    <input type="text" id="fileId" maxlength="10" value="<?php echo @$info['fileid'] ?>" name="fileId" class="form-control" >
                </div>
            </div>
        </div>
        <div class="form-group">    
            <div class="row">
                <div class="col-md-offset-3 col-md-6">
                    <input type="submit" value="Check Status" id="btnchk" name="btnchk" class="btn btn-primary btn-block" onclick="return filedId(this)">
                </div>
            </div>
        </div>
    </div>
    <div id="showDiv1">
        <?php
        $colorClass = "";
        $Msg = "";

        if($info['Final_Status'] == "IN PROCESS")
        {
            $colorClass ="class='alert alert-danger fade in alert-dismissable'";
            $Msg = "Final Status : IN PROCESS";
        }
        else if($info['Final_Status']== "COMPLETED.")
        {
            $colorClass ="class='alert alert-success fade in alert-dismissable'";
            $Msg = "Final Status: APPLICATION COMPLETED";
        }

        if(isset($info['Final_Status']))
        {
            ?>
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
            <div class="form-group">    
                <div class="row">
                    <div class="col-md-offset-3 col-md-6">
                        <div class="alert alert-info fade in alert-dismissable" >
                            <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close"></a>
                            <strong>
                                Current Status:  <?php echo $info['Current_Status']; ?>
                            </strong>
                        </div>
                    </div>
                </div>
            </div>
            <fieldset>
                <div class="form-group">
                    <div class="col-md-offset-3 col-md-6">
                        <label  class="control-label">Applicant Name</label>
                        <input type="text" class="form-control" value="<?php echo $info['SubmittedBy'];  ?>" readonly="readonly">    
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-offset-3 col-md-6">
                        <label  class="control-label">File No/One Window No</label>
                        <input type="text" class="form-control" value="<?php echo $info['fileid'];  ?>" readonly="readonly">    
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-offset-3 col-md-6">
                        <label class="control-label">File Name</label>
                        <input type="text" class="form-control" value="<?php echo $info['FileName'];  ?>" readonly="readonly">    
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-offset-3 col-md-6">
                        <label class="control-label">Received Date</label>
                        <input type="text" class="form-control" value="<?php echo date($info['recivedDate']);  ?>" readonly="readonly">    
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-offset-3 col-md-6">
                        <label  class="control-label">Current Branch Name</label>
                        <input type="text" class="form-control" value="<?php echo $info['br_Name'];  ?>" readonly="readonly">    
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-offset-3 col-md-6">
                        <label class="control-label">Remarks</label>
                        <input type="text" class="form-control" value="<?php echo $info['Remarks'];  ?>" readonly="readonly">    
                    </div>
                </div>
            </fieldset> 
            <?php
        } 
        ?>
    </div>
    <?php
    if(isset($info)){
        ?>
        <div id="hideBtnPrint"> 
            <div class="form-group">
                <div class="col-md-offset-3 col-md-6">
                    <label  class="control-label"></label>
                    <input type="button" id="btnTracePrint" class="btn btn-primary btn-block" value="Print">    
                </div>
            </div>
        </div>
        <?php
    }
    ?>
</form>
<script type="text/javascript">
    function filedId(){
        var x = $('#fileId').val();
        if(x == ''){
            alertify.error('Frist Enter Application id');
            $('#fileId').focus();
            return false;
        }
    }
</script>






