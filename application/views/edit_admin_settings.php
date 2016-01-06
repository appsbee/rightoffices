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
          <?php if ($this->session->flashdata('msgtype') && $this->session->flashdata('msgtype')=='success'){?>
          <div class="alert alert-success alert-block fade in">
            <button type="button" class="close close-sm" data-dismiss="alert">
            <i class="fa fa-times"></i>
            </button>
            <?php echo $this->session->flashdata('msg'); ?>
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
          <!--    <header class="panel-heading">
            Profile Setting   <a  href='javascript:history.back()' class='btn btn-success' style="margin-left: 800px;">Back</a>
          </header>      -->
          <header class="panel-heading">
            <div class="col-sm-12">
              <div class="col-sm-10 no-margin" style="padding-left:0;">
              <h4>Profile Setting   </h4></div>
              <div class="col-sm-2">
                <div class="pull-right"> <a  href='javascript:history.back()' class='btn btn-success'>Back</a>     </div>
                
              </div>
              
              </div> <div class="clearfix"></div>
            </header>
            <div class="panel-body">
              <div class="position-center">
                <form role="form" method="POST" action="<?php echo base_url('settings/update_admin_data');?>" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="email" >Email</label>
                    <input disabled="disabled" type="email" class="form-control" id="email" name="email" placeholder="Enter email" value="<?php echo $admin_details['email'];?>">
                  </div>
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="<?php echo $admin_details['name'];?>">
                  </div>
                  <div class="form-group">
                    <label for="phone_no">Phone No</label>
                    <input type="text" class="form-control" id="phone_no" name="phone_no" placeholder="Enter phone no" value="<?php echo $admin_details['phone_no'];?>">
                  </div>
                  <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="exampleInputFile" id="image" name="image">
                  </div>
                  <input type="hidden" name="user_id" id="user_id" value="<?php echo $admin_details['id'];?>" />
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
              <h4>Change Password</h4>
            </header>
            <div class="panel-body">
              <div class="position-center">
                <form role="form" method="POST" action="<?php echo base_url('settings/change_password');?>">
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" value="<?php echo set_value('password');?>" class="form-control" id="password" name="password" placeholder="Enter password">
                  </div>
                  <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" value="<?php echo set_value('confirm_password');?>" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm password">
                  </div>
                  
                  <input type="hidden" name="user_id" id="user_id" value="<?php echo $admin_details['id'];?>" />
                  <button type="submit" class="btn btn-info">Update</button>
                </form>
              </div>
            </div>
          </section>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <section class="panel messages-container">
            
            <header class="panel-heading">
              <h4>SYNC FEPI DATA</h4>
            </header>
            <div class="panel-body">
              <div class="position-center">
                <div class="radio single-row">
                  <input tabindex="3" type="radio"  value="old"  id="old" name="synctype" checked="checked">
                  <label class='control-label' for='old'><strong>Only new FEPI data and keep the prior changes</strong></label>
                </div>
                <div class="radio single-row">
                  <input tabindex="3" type="radio"  value="new"  id="new" name="synctype">
                  <label class='control-label' for='new'><strong>Purge the local FEPI data and re-sync all </strong></label>
                </div>
                <div style="position:relative;"><button type="button" class="btn btn-info" id='syncbtn'>Sync</button>
                  <div id="loader" style="display:none; position: absolute; bottom:1px; left:60px;">
                    
                    <!-- <button class="" style="background: none; outline: none; border: none;"> <span class="btn glyphicon glyphicon glyphicon-refresh glyphicon-refresh-animate"></span>  </button>-->
                    <a href="#" class="load" id="" data-text-loading="Loading..."><img src="<?php echo base_url()?>public/images/lazyload.gif" /></a>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
      
    </section>
  </section>
  <!--main content end-->
  
  <script>
  $(document).ready(function() {
    $('#syncbtn').click(function() {
      var type;
      type = $('input[name=synctype]:checked').val();
      if (type == 'old') {
        $('#loader').show();
        $('#syncbtn').prop('disabled', true);

        $.ajax({
          url: "<?php echo base_url('fepi/update_data'); ?>",
          cache: false,
          type: 'POST',
          dataType: 'text',
          data: 'type=' + type,
          success: function(msg) {
            msg = JSON.parse(msg);
            var message = '', classStr = '';
            if(msg.status){
              message = 'Sync successfull.';
              classStr = 'success';
            }else{
              message = 'Some error occured while sycning, Please try again.';
              classStr = 'danger';
            }
            var str = '<div class="alert alert-' + classStr + ' alert-block fade in"><button type="button" class="close close-sm" data-dismiss="alert"><i class="fa fa-times"></i></button>' + message + '</div>';
            $('.messages-container').prepend(str);
            $('#loader').hide();
            $('#syncbtn').prop('disabled', false);
          }
        });
      } else {
        flag = confirm('Would you like to continue ? ');
        if (flag) {
          $('#loader').show();
          $('#syncbtn').prop('disabled', true);

          $.ajax({
            url: "<?php echo base_url('fepi/update_data'); ?>",
            cache: false,
            type: 'POST',
            dataType: 'text',
            data: 'type=' + type,
            success: function(msg) {
              msg = JSON.parse(msg);
              var message = '', classStr = '';
              if(msg.status){
                message = 'Sync successfull.';
                classStr = 'success';
              }else{
                message = 'Some error occured while sycning, Please try again.';
                classStr = 'danger';
              }
              var str = '<div class="alert alert-' + classStr + ' alert-block fade in"><button type="button" class="close close-sm" data-dismiss="alert"><i class="fa fa-times"></i></button>' + message + '</div>';
              $('.messages-container').prepend(str); 
              $('#loader').hide();
              $('#syncbtn').prop('disabled', false);
            }
          });
        }
      }
    });

  });
  </script>