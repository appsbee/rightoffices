<!--main content start-->
            <section id="main-content">
                <section class="wrapper">
<div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        Client List
                    <!--    <table>
                            <form method="POST" action="< ?php echo base_url('client/client_search');?>">
                            <tr>
                            <td>Start Date</td><td><input type="text" name="start_date" id="start_date" /></td>
                            <td>End Date</td><td><input type="text" name="end_date" id="end_date" /></td>
                            <td></td><td><input type="submit" name="submit" id="submit" value="Search" /></td>
                            </tr>
                            </form>
                            </table>-->
                        <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            <a href="javascript:;" class="fa fa-cog"></a>
                            <a href="javascript:;" class="fa fa-times"></a>
                         </span>
                    </header>
                    <div class="panel-body">
                    <div class="adv-table">
                    <table  class="display table table-bordered table-striped" id="dynamic-table">
                    <thead>
                    <tr>
                         
                           <th>No</th>       
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
                    </div>
                </section>
            </div>
        </div>
                </section>
            </section>
            <!--main content end-->			
<script>
$(document).ready(function(){
	//$( "#start_date" ).datepicker({ dateFormat: 'yy-mm-dd' });
	//$( "#end_date" ).datepicker({ dateFormat: 'yy-mm-dd' });
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
	$('#miscaction').change(function() {
  		var value= $(this).val();
		if(value == 1){
			$('input[name="mail"]:checked').each(function() {
   			  console.log(this.value);
			});
		}
	});
});
</script>		
			
			