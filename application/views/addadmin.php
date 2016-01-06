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
                      <!--  <header class="panel-heading">
                            Create Admin   <a  href='javascript:history.back()' class='btn btn-success' style="margin-left: 800px;">Back</a>
                        </header>  -->
                                                    <header class="panel-heading">
                        <div class="col-sm-12">
                        <div class="col-sm-10 no-margin" style="padding-left:0;">
                        <h4>Create Admin   </h4></div>
                        <div class="col-sm-2">
                        <div class="pull-right"> <a  href='javascript:history.back()' class='btn btn-success'>Back</a>     </div>
                        
                         </div>
                         
                         </div> <div class="clearfix"></div>           
                    </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form" method="POST" action="<?php echo base_url('admin/create_admin');?>" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
                                </div>
                                <div class="form-group">
                                    <label for="phone_no">Phone No</label>
                                    <input type="text" class="form-control" id="phone_no" name="phone_no" placeholder="Enter phone no">
                                </div>
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <input type="file" class="exampleInputFile" id="image" name="image">
                                </div>
                                <button type="submit" class="btn btn-info">Add</button>
                            </form>
                            </div>

                        </div>
                    </section>       
    </div>
</div>

                   
                </section>
            </section>
            <!--main content end-->
            
            
            
            