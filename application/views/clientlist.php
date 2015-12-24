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
                    <div class="clearfix">
                                <div class="btn-group pull-right">
                                    <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">Tools <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="#">With selected mail</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="space15"></div>
                    <table   id="example" class="display table table-bordered table-striped">
                    <thead>
                    <tr>
                           
                           <th>No</th>       
                           <th>Firstname</th>
                           <th>Lastname</th>
                           <th>Email</th>
                           <th>Company</th>
                           <th>Action</th>
                    </tr>
                    </thead>
                    <tfoot>
                        
                    </tfoot>
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
     var table=$('#example').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": "<?php echo base_url('client/get_all_client_list'); ?>",
                    "columnDefs": [ {
                    "targets": -1,
                    "data": null,
                    "defaultContent": "<a data-toggle='modal' class='todo-edit' href='#'><i class='ico-pencil'></i></a><a class='todo-remove' href='#' style='margin-left:20px;'><i class='ico-close'></i></a>"
                     } ] 
                     

                });
    $('#example tbody').on( 'click', '.todo-remove', function () {
        var data = table.row( $(this).parents('tr') ).data();
        result=confirm("Would you like to proceed ?");
        if(result){
            $.ajax({
                      url: "<?php echo base_url('client/delete_client'); ?>",
                      cache: false,
                      type: 'POST',
                      dataType:'text',
                      data : 'user_id='+data[0],
                      success: function(msg){
                        alert(msg);
                        window.location="<?php echo base_url('client/get_client_list'); ?>";
                      }
                });    
        }
    } );
     $('#example tbody').on( 'click', '.todo-edit', function () {
        var data = table.row( $(this).parents('tr') ).data();
        var url="<?php echo base_url('client/edit_client/'); ?>"+'/'+data[0];
        window.location=url;   
    } );
	//$( "#start_date" ).datepicker({ dateFormat: 'yy-mm-dd' });
	//$( "#end_date" ).datepicker({ dateFormat: 'yy-mm-dd' });
	/*$('.todo-remove').click(function(){
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
	}); */
});
</script>		
			
			