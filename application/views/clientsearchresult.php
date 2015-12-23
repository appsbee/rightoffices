<!--main content start-->
            <section id="main-content">
                <section class="wrapper">
<div class="row">
	<div class="col-md-12">
                <section class="panel">
				
                        <header class="panel-heading no-border">
                            Client Search Result <!--<a class="btn btn-success" href="#" style="margin-left:30px; width:100px;">Add Client</a>-->
							
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
									<th>Date</th>
									<th>Status</th>
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
									<td><?php echo date('d-m-Y',strtotime($client['created_at'])); ?></td>
									 <td><?php  
									 		if($client['status']){
									 	?>
										<span style="color:#006600;cursor:pointer;" class="status_active" id="<?php echo $client['id'];?>">Active</span>
										<?php }else{?>
										<span style="color:#FF0000;cursor:pointer;" class="status_inactive" id="<?php echo $client['id'];?>">Inactive</span>
										<?php }?>
									 </td>
								<?php  $i++; } 
								 
								}?>
                                </tbody>
                            </table>
                        </div>
						
                     <p><?php //echo $links; ?></p>
                    </section>
            </div>
</div>
                  
                </section>
            </section>
            <!--main content end-->			
		
			
			