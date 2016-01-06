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
                        <!--<header class="panel-heading">
                            Update Admin   <a  href='javascript:history.back()' class='btn btn-success'>Back</a>
                        </header>    -->
                        
                            <header class="panel-heading">
                        <div class="col-sm-12">
                        <div class="col-sm-10 no-margin" style="padding-left:0;">
                        <h4>Update Admin   </h4></div>
                        <div class="col-sm-2">
                        <div class="pull-right"> <a  href='javascript:history.back()' class='btn btn-success'>Back</a>     </div>
                        
                         </div>
                         
                         </div> <div class="clearfix"></div>           
                    </header>
                        
                        
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form" method="POST" action="<?php echo base_url('admin/update_admin_data');?>">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value="<?php echo $userdetails['email'];?>">
                                </div>
								<div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="<?php echo $userdetails['name'];?>">
                                </div>
								<div class="form-group">
                                    <label for="phone_no">Phone No</label>
                                    <input type="text" class="form-control" id="phone_no" name="phone_no" placeholder="Enter phone no" value="<?php echo $userdetails['phone_no'];?>">
                                </div>
                                <!--<div class="form-group">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                </div>-->
								<input type="hidden" name="user_id" id="user_id" value="<?php echo $userdetails['id'];?>" />
                                <button type="submit" class="btn btn-info">Update</button>
                            </form>
                            </div>

                        </div>
                    </section>       
    </div>
</div>

<div class="row">
	<div class="col-lg-12">
        <section class="panel">
		                
							<?php if ($this->session->flashdata('msgtype') && $this->session->flashdata('msgtype')=='error'){?>
				<div class="alert alert-success alert-warning fade in">
                                <button type="button" class="close close-sm" data-dismiss="alert">
                                    <i class="fa fa-times"></i>
                                </button>
								<?php echo $this->session->flashdata('msg'); ?>
                </div>
				<?php }?> 
                        <header class="panel-heading">
                            <h4>Change Password</h4>
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form" method="POST" action="<?php echo base_url('admin/change_password');?>">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" value="<?php echo set_value('password');?>" class="form-control" id="password" name="password" placeholder="Enter password">
                                </div>
								<div class="form-group">
                                    <label for="confirm_password">Confirm Password</label>
                                     <input type="password" value="<?php echo set_value('confirm_password');?>" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm password">
                                </div>
								
								<input type="hidden" name="user_id" id="user_id" value="<?php echo $userdetails['id'];?>" />
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
			
			
			
			