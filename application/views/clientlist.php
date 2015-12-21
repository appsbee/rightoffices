<!--main content start-->
            <section id="main-content">
                <section class="wrapper">
<div class="row">
	<div class="col-md-12">
                <section class="panel">
				<?php if ($this->session->flashdata('msgtype') && $this->session->flashdata('msgtype')=='success'){?>
				<div class="alert alert-success alert-block fade in">
                                <button type="button" class="close close-sm" data-dismiss="alert">
                                    <i class="fa fa-times"></i>
                                </button>
                                <h4>
                                    <i class="icon-ok-sign"></i>
                                    <?php echo $this->session->flashdata('msg'); ?>
                                </h4>
                            </div>
				<?php }?>
                        <header class="panel-heading no-border">
                            Client List <a class="btn btn-success" href="#" style="margin-left:30px; width:100px;">Add Client</a>
                            <span class="tools pull-right">
							    
                                <a href="javascript:;" class="fa fa-chevron-down"></a>
                                <a href="javascript:;" class="fa fa-cog"></a>
                                <a href="javascript:;" class="fa fa-times"></a>
                             </span>
                        </header>
                        <div class="panel-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
									<th>Name</th>
									<th>Email</th>
									<th>Company</th>
									<th>Status</th>
									<th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(empty($clients)) {
									echo 'No record found';
								?>
								<?php }else{ 
								    $i=1;
									foreach($clients as $client){
								?>
									<tr>
                                    <td><?php echo $i; ?></td>
									<td><?php echo $client['first_name'].' '.$client['last_name']; ?></td>
                                    <td><?php echo $client['email']; ?></td>
									<td><?php echo $client['company']; ?></td>
									 <td><?php  
									 		if($client['status']){
									 	?>
										<span style="color:#006600;cursor:pointer;" class="status_active" id="<?php echo $client['id'];?>">Active</span>
										<?php }else{?>
										<span style="color:#FF0000;cursor:pointer;" class="status_inactive" id="<?php echo $client['id'];?>">Inactive</span>
										<?php }?>
									 </td>
									<td><a href="<?php echo base_url('client/edit_client/'.$client['id']); ?>" class="todo-edit"  name="<?php echo $client['id'];?>"><i class="ico-pencil"></i></a>
                                         <a href="#" class="todo-remove"  name="<?php echo $client['id'];?>"><i class="ico-close"></i></a>
									    <!--<a href="#" class="todo-edit"  name="< ?php echo $client['id'];?>"><i class="ico-pencil"></i></a>-->
										 </td>
                                </tr>
									
								<?php  $i++; } 
								 
								}?>
                                </tbody>
                            </table>
                        </div>
						
                     <p><?php echo $links; ?></p>
                    </section>
            </div>
</div>
                  
                </section>
            </section>
            <!--main content end-->			
<script>
$(document).ready(function(){
	$('.todo-remove').click(function(){
		var user_id=$(this).attr('name');
		var result=confirm("Would you like to proceed ?");
		if(result){
			$.ajax({
			url : '<?php echo base_url('client/delete_client');?>',
			type : 'POST',
			data : 'user_id='+user_id,
			dataType : 'text',
			cache : false,
			success : function(msg){
				alert(msg);
				window.location="<?php echo base_url('client/get_client_list'); ?>";
			}
		    });
		}
	});
	$('.status_active').click(function(){
		var user_id=$(this).attr('id');
		var status=$(this).html();
		var self=$(this);
		$.ajax({
			url : '<?php echo base_url('client/change_status');?>',
			data : 'status='+status+'&user_id='+user_id,
			dataType : 'text',
			type:'POST',
			cache:false,
			success:function(msg){
				if(msg==1){
				  self.html('Active');
				  self.css({'color':'#006600'});
				}else {
				  self.html('Inactive');
				  self.css({'color':'#FF0000'});
				}
			}
		});
	});
	$('.status_inactive').click(function(){
		var user_id=$(this).attr('id');
		var status=$(this).html();
		var self=$(this);
		$.ajax({
			url : '<?php echo base_url('client/change_status');?>',
			data : 'status='+status+'&user_id='+user_id,
			dataType : 'text',
			type:'POST',
			cache:false,
			success:function(msg){
				if(msg==1){
				  self.html('Active');
				  self.css({'color':'#006600'});
				}else {
				  self.html('Inactive');
				  self.css({'color':'#FF0000'});
				}
			}
		});
	});
});
</script>		
			
			