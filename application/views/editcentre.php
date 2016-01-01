<!--main content start-->
            <section id="main-content">
                <section class="wrapper">
                <div class="row">
    <div class="col-lg-12">
        <section class="panel">
                            <?php 
                                    if(validation_errors()!=''){
                            ?>
                            <div class="alert alert-warning fade in">
                                <button type="button" class="close close-sm" data-dismiss="alert">
                                    <i class="fa fa-times"></i>
                                </button>
                                <?php echo validation_errors(); ?>
                            </div>
                            <?php }?>
                            <?php if ($this->session->flashdata('msgtype') && $this->session->flashdata('msgtype')=='error'){?>
                <div class="alert alert-success alert-warning fade in">
                                <button type="button" class="close close-sm" data-dismiss="alert">
                                    <i class="fa fa-times"></i>
                                </button>
                               <?php echo $this->session->flashdata('msg'); ?>
                            </div>
                <?php }?> 
                       <!-- <header class="panel-heading">
                            Update Centre  <a  href='javascript:history.back()' class='btn btn-success' style="margin-left: 800px;">Back</a>
                        </header>-->
                                                    <header class="panel-heading">
                        <div class="col-sm-12">
                        <div class="col-sm-10 no-margin" style="padding-left:0;">
                        <h4>Update Centre   </h4></div>
                        <div class="col-sm-2">
                        <div class="pull-right"> <a  href='javascript:history.back()' class='btn btn-success'>Back</a>     </div>
                        
                         </div>
                         
                         </div> <div class="clearfix"></div>           
                    </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form" method="POST" action="<?php echo base_url('centre/update_centre_data');?>">
                                 <div class="form-group">
                                    <label for="exampleInputEmail1">CentreDescription</label>
                                    <textarea class="form-control" id="CentreDescription" name="CentreDescription" placeholder="Centre Description" rows="5"><?php echo $centre_details['CentreDescription'];?> </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">OperatorCode</label>
                                    <input type="text" class="form-control" id="OperatorCode" name="OperatorCode" placeholder="OperatorCode" value="<?php echo $centre_details['OperatorCode'];?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">City</label>
                                    <input type="text" class="form-control" id="City" name="City" placeholder="City" value="<?php echo $centre_details['City'];?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Address</label>
                                    <input type="text" class="form-control" id="Address" name="Address" placeholder="Address" value="<?php echo $centre_details['Address'];?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Postcode</label>
                                    <input type="text" class="form-control" id="Postcode" name="Postcode" placeholder="Postcode" value="<?php echo $centre_details['Postcode'];?>">
                                 </div>    
                                <input type="hidden" name="CentreId" id="CentreId" value="<?php echo $centre_details['CentreID'];?>" />
                                <button type="submit" class="btn btn-info">Update</button>
                            </form>
                            </div>

                        </div>
                    </section>       
    </div>
</div>
                 
                </section>
            </section>
            <!--main content end-->
            
            
            
            