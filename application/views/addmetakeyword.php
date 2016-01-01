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
                      <!--  <header class="panel-heading">
                            Add Metakeyword   <a  href='javascript:history.back()' class='btn btn-success' style="margin-left: 800px;">Back</a>
                        </header> -->
                                                    <header class="panel-heading">
                        <div class="col-sm-12">
                        <div class="col-sm-10 no-margin" style="padding-left:0;">
                        <h4>Add Metakeyword   </h4></div>
                        <div class="col-sm-2">
                        <div class="pull-right"> <a  href='javascript:history.back()' class='btn btn-success'>Back</a>     </div>
                        
                         </div>
                         
                         </div> <div class="clearfix"></div>           
                    </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form" method="POST" action="<?php echo base_url('metakeyword/add_metakeyword_details');?>">
                                <button type="button" class="btn btn-info" id='addmore'>+Add More</button>   
                                
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Page</label>
                                        <select class="form-control" id="pagename" name="pagename">
                                        <option value="">Select</option>
                                        <?php 
                                            foreach($content_pagelist as $page){
                                        ?>
                                        <option value="<?php echo $page['title'];?>"><?php echo $page['title'];?></option>       
                                        <?php }?>
                                        </select>
                                    </div>
                                    <div id='contentdata'> 
                                        <div class='subdata'>    
								            <div class="form-group">
                                                <label for="exampleInputEmail1">Keyword</label>
                                                <span id='keycontent'>
                                                <select class="form-control check"  name="keyword[]">
                                                <option value="">Select</option>
                                                <?php
                                                   $keywords=$this->config->item('meta_keywords');
                                                   foreach($keywords as $val){
                                                ?>
                                                   <option value="<?php echo $val; ?>"><?php echo $val; ?></option> 
                                                <?php }?>
                                                </select>
                                                </span>
                                            </div>
								            <div class="form-group">
                                                <label for="exampleInputEmail1">Content</label>
                                                <textarea class="form-control check"  name="content[]" placeholder="content"></textarea>
                                            </div>
                                            
                                        </div>    
                                  </div>
                                <button type="submit" class="btn btn-info">Add</button>
                            </form>
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
    $('#addmore').click(function(){
         var content='';
         var keyword='';
         keyword=$('#keycontent').html();
         content+='<div class="subdata">';
         content+='<button type="button" class="btn btn-info removecontent" >-Remove</button>';
         content+='<div class="form-group"><label for="exampleInputEmail1">Keyword</label>'+keyword+'</div>';
         content+='<div class="form-group"><label for="exampleInputEmail1">Content</label><textarea class="form-control check" name="content[]" placeholder="content"></textarea></div>';
         content+='</div>';
         $('#contentdata').append(content);
    });
    $(document).on('click', '.removecontent', function () {
        $(this).parent('div').remove();
    });
})
</script>		
			
			