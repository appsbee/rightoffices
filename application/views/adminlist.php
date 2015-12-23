<!--main content start-->
            <section id="main-content">
                <section class="wrapper">
                <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        Admin List
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
                        <th>Email</th>
                        <th>Name</th>
                        <th>Phone No</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                     <?php if(empty($users)) {
                                    echo 'No record found';
                                ?>
                                <?php }else{ 
                                    $i=1;
                                    foreach($users as $user){
                                ?>
                    <tr class="gradeA">
                        <td><?php echo $i; ?></td>    
                         <td><?php echo $user['email']; ?></td>
                        <td><?php echo $user['name']; ?></td>
                        <td><?php echo $user['phone_no']; ?></td>
                        <td><a href="<?php echo base_url("admin/edit_admin/".$user['id']); ?>" class="todo-edit"  name="<?php echo $user['id'];?>"><i class="ico-pencil"></i></a>
                                         <a href="#" class="todo-remove"  name="<?php echo $user['id'];?>"><i class="ico-close"></i></a></td>
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
	$('.todo-remove').click(function(){
	    var result;
		var user_id=$(this).attr('name');
	    result=confirm("Would you like to proceed ?");
		if(result){
			$.ajax({
					  url: "<?php echo base_url('admin/delete_admin'); ?>",
					  cache: false,
					  type: 'POST',
					  dataType:'text',
					  data : 'user_id='+user_id,
					  success: function(msg){
						alert(msg);
						window.location="<?php echo base_url('admin/get_admin_list'); ?>";
					  }
				});	
		}
	});
});
</script>