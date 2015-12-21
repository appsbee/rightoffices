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
                            Centre List
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
                                    <th>Description</th>
									<th>Address</th>
									<th>City</th>
									<th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(empty($centres)) {
									echo 'No record found';
								?>
								<?php }else{ 
								    $i=1;
									foreach($centres as $centre){
								?>
									<tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $centre['CentreDescription']; ?></td>
									<td><?php echo $centre['Address']; ?></td>
									<td><?php echo $centre['City']; ?></td>
									<td><a href="#abcd" data-toggle="modal" class="btn btn-success test" name="<?php echo $centre['CentreID']; ?>">View</a></td>
                                </tr>
									
								<?php  $i++; } 
								 
								}?>
                                </tbody>
                            </table>
                        </div>
						 <!-- Modal -->
                            <div class="modal fade" id="abcd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
                                <div class="modal-dialog" style="width:1000px;">
                                    <div class="modal-content" >
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title">Centre Details</h4>
                                        </div>
                                        <div class="modal-body" id="centredata" style="max-height: 500px; overflow-y: scroll;">
                                        </div>
                                        <div class="modal-footer">
                                            <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                                            <!-- <button class="btn btn-success" type="button">Save changes</button>-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- modal -->
                     <p><?php echo $links; ?></p>
                    </section>
            </div>
</div>
                  
                </section>
            </section>
            <!--main content end-->
<script>
$(document).ready(function(){
	$('.test').click(function(){
		var CenterId= $(this).attr('name');
		var Centrecontent="";
		var json;
		  $.ajax({
					  url: "<?php echo base_url('centre/get_centre_details'); ?>",
					  cache: false,
					  type: 'POST',
					  dataType:'text',
					  data : 'CenterId='+CenterId,
					  success: function(response){
					  json = $.parseJSON(response);
					  if(json){
						  Centrecontent+='<table class="table table-bordered">';
							  $.each( json, function( key, value ) {
										if(key){
										Centrecontent+='<tr >';
										Centrecontent+='<td>'+key+'</td>';
										Centrecontent+='<td>'+value+'</td>';
										Centrecontent+='</tr>';
										}
								  });
							 Centrecontent+='</table>';
							 $('#centredata').html(Centrecontent);
						    }	
					 }
				});	
	});
});
</script>			
			
			
			