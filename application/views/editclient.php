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
                                <strong><?php echo validation_errors(); ?></strong>
                            </div>
							<?php }?>
                        <header class="panel-heading">
                            Update Client
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form" method="POST" action="<?php echo base_url('client/update_client_data');?>">
								<div class="form-group">
                                    <label for="exampleInputEmail1">Title</label>
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter firstname" value="<?php echo $client_details['title'];?>">
                                </div>
								<div class="form-group">
                                    <label for="exampleInputEmail1">Firstname</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter firstname" value="<?php echo $client_details['first_name'];?>">
                                </div>
								<div class="form-group">
                                    <label for="exampleInputEmail1">Lastname</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter lastname" value="<?php echo $client_details['last_name'];?>">
                                </div>
								<div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value="<?php echo $client_details['email'];?>">
                                </div>
								<div class="form-group">
                                    <label for="exampleInputEmail1">Company</label>
                                    <input type="text" class="form-control" id="company" name="company" placeholder="Enter company" value="<?php echo $client_details['company'];?>">
                                </div>
								<div class="form-group">
                                    <label for="exampleInputEmail1">Phone no</label>
                                    <input type="text" class="form-control" id="phone_no" name="phone_no" placeholder="Enter phone no" value="<?php echo $client_details['phone_no'];?>">
                                </div>
								<div class="form-group">
                                    <label for="exampleInputEmail1">Office size</label>
                                    <input type="text" class="form-control" id="office_size" name="office_size" placeholder="Enter office size" value="<?php echo $client_details['office_size'];?>">
                                </div>
								<div class="form-group">
                                    <label for="exampleInputEmail1">Note</label>
                                    <input type="text" class="form-control" id="note" name="note" placeholder="Enter note" value="<?php echo $client_details['note'];?>">
                                </div>
                                
								<input type="hidden" name="user_id" id="user_id" value="<?php echo $client_details['id'];?>" />
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
								<storng><?php echo $this->session->flashdata('msg'); ?></storng>
                            </div>
				<?php }?> 
                        <header class="panel-heading">
                            Change Password
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form" method="POST" action="<?php echo base_url('client/change_password');?>">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Password</label>
                                    <input type="password" value="<?php echo set_value('password');?>" class="form-control" id="password" name="password" placeholder="Enter password">
                                </div>
								<div class="form-group">
                                    <label for="exampleInputEmail1">Confirm Password</label>
                                     <input type="password" value="<?php echo set_value('confirm_password');?>" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm password">
                                </div>
								
								<input type="hidden" name="user_id" id="user_id" value="<?php echo $client_details['id'];?>" />
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
			
			
			
			