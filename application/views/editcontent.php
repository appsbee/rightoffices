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
                            Update Content   <a  href='javascript:history.back()' class='btn btn-success' style="margin-left: 800px;">Back</a>
                        </header> -->
                             <header class="panel-heading">
                        <div class="col-sm-12">
                        <div class="col-sm-10 no-margin" style="padding-left:0;">
                        <h4> Update Content   </h4></div>
                        <div class="col-sm-2">
                        <div class="pull-right"> <a  href='javascript:history.back()' class='btn btn-success'>Back</a>     </div>
                        
                         </div>
                         
                         </div> <div class="clearfix"></div>           
                    </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form" method="POST" action="<?php echo base_url('content/update_content_data');?>">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Title</label>
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="<?php echo $content_details['title'];?>">
                                </div>
								<div class="form-group">
                                    <label for="exampleInputEmail1">Description</label>
                                    <textarea class="form-control" id="description" name="description" placeholder="Description"><?php echo $content_details['description'];?></textarea>
                                    <script type="text/javascript">
                                        CKEDITOR.replace( 'description' );
                                    </script>
                                </div>
								<input type="hidden" name="id" id="id" value="<?php echo $content_details['id'];?>" />
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
			
			
			
			