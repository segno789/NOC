
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
     <div class="form-group">    
        <div class="row">
            <div class="col-md-offset-3 col-md-6">
                <input type="button" value="Cancel" id="gotoNocApp" name="gotoNocApp" onclick="window.location.href = '<?=base_url()?>'" class="btn btn-danger btn-block">
            </div>
        </div>
    </div>
       
    <?php 
    $colorClass = "";
    $Msg = "";

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
    else if($info['ismigrated']==0 && $info['isverified']==0 )
    {
        $colorClass ="class='alert alert-warning fade in alert-dismissable'";
        $Msg = "Application Under Process (Fee not verified!)";
    }
    else if($info['ismigrated']==0 && $info['isverified']==1 )
    {
        $colorClass ="class='alert alert-info fade in alert-dismissable'";
        $Msg = "Application Under Process (Fee verified!)";
    }
    else if($info['ismigrated']==0 && $info['isverified']==1 && $info['remarks']!="")
    {
        $colorClass ="class='alert alert-danger fade in alert-dismissable'";
        $Msg = "Application can not proceed due to ".$info['remarks'];
    }

    if(isset($info['app_No']))
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

        <fieldset>
            <div class="form-group">
                <div class="col-md-offset-3 col-md-6">
                    <label  class="control-label">Application ID:</label>
                    <input type="text" class="form-control" id='lblAppNo' value="<?php echo $info['app_No'];  ?>" readonly="readonly">    
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-offset-3 col-md-6">
                    <label class="control-label">Name:</label>
                    <input type="text" class="form-control" value="<?php echo $info['name'];  ?>" readonly="readonly">    
                </div>

            </div>
      
         
        </fieldset> 

        <?php
    } 
    ?>
</form>









