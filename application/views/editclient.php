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
                     <!--   <header class="panel-heading">
                            Update Client   <a  href='javascript:history.back()' class='btn btn-success' style="margin-left: 800px;">Back</a>
                        </header>    -->
                        <header class="panel-heading">
                        <div class="col-sm-12">
                        <div class="col-sm-10 no-margin" style="padding-left:0;">
                        <h4>Update Client   </h4></div>
                        <div class="col-sm-2">
                        <div class="pull-right"> <a  href='javascript:history.back()' class='btn btn-success'>Back</a>     </div>
                        
                         </div>
                         
                         </div> <div class="clearfix"></div>           
                    </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form" method="POST" action="<?php echo base_url('client/update_client_data');?>">
								<div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter firstname" value="<?php echo $client_details['title'];?>">
                                </div>
								<div class="form-group">
                                    <label for="first_name">Firstname</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter firstname" value="<?php echo $client_details['first_name'];?>">
                                </div>
								<div class="form-group">
                                    <label for="last_name">Lastname</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter lastname" value="<?php echo $client_details['last_name'];?>">
                                </div>
								<div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value="<?php echo $client_details['email'];?>">
                                </div>
								<div class="form-group">
                                    <label for="company">Company</label>
                                    <input type="text" class="form-control" id="company" name="company" placeholder="Enter company" value="<?php echo $client_details['company'];?>">
                                </div>
								<div class="form-group">
                                    <label for="phone_no">Phone no</label>
                                    <input type="text" class="form-control" id="phone_no" name="phone_no" placeholder="Enter phone no" value="<?php echo $client_details['phone_no'];?>">
                                </div>
								<div class="form-group">
                                    <label for="office_size">Office size</label>
                                    <input type="text" class="form-control" id="office_size" name="office_size" placeholder="Enter office size" value="<?php echo $client_details['office_size'];?>">
                                </div>
								<div class="form-group">
                                    <label for="note">Note</label>
                                    <input type="text" class="form-control" id="note" name="note" placeholder="Enter note" value="<?php echo $client_details['note'];?>">
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name='status' id='status' class="form-control">
                                    <?php if($client_details['status']){?>
                                    <option value="<?php echo $client_details['status']?>" selected="selected">Active</option>
                                    <option value="0">Inactive</option>
                                    <?php }else{?>
                                    <option value="<?php echo $client_details['status']?>" selected="selected">Inactive</option>
                                    <option value="1">Active</option>
                                    <?php }?>
                                    </select>
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
		                
							
                        <header class="panel-heading">
                           <h4>Add Notes</h4> 
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form" method="POST" action="<?php echo base_url('client/add_notes');?>">
                                <div class="form-group">
                                    <label for="property">Property</label>
                                    <textarea rows="6" class="form-control" id="property" name="property"></textarea>
                                </div>
								<input type="hidden" name="user_id" id="user_id" value="<?php echo $client_details['id'];?>" />
                                <button type="submit" class="btn btn-info">Add</button>
                            </form>
                            </div>

                        </div>
                    </section>       
    </div>
</div>
<!-- mail-->
<div class="row">
	<div class="col-lg-12">
        <section class="panel"> 
                        <header class="panel-heading">
                          <h4>  Send Email</h4>
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form" method="POST" action="<?php echo base_url('client/send_mail_notification');?>">
                                <div class="form-group">
                                    <label for="subject">Subject</label>
                                    <input type="text"  class="form-control" id="subject" name="subject" placeholder="Subject">
                                </div>
								<div class="form-group">
                                    <label for="message">Message</label>
                                   <textarea rows="6" class="form-control" id="message" name="message" placeholder="Message"></textarea>
                                </div>
								<input type="hidden" name="user_id" id="user_id" value="<?php echo $client_details['id'];?>" />
                                 <input type="hidden" name="formtype" id="formtype" value="normalform" />
                                <button type="submit" class="btn btn-info">Send</button>
                            </form>
                            </div>

                        </div>
                    </section>       
    </div>
</div>
<!-- mail-->
                  
                </section>
            </section>
            <!--main content end-->
			
			
			
			