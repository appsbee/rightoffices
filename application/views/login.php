<div class="container">
  <form class="form-signin" action="<?php echo base_url('login');?>" method="POST">
    <h2 class="form-signin-heading"> <img src="<?php echo base_url(); ?>public/images/logo.png" alt=""></h2>
    <div class="login-wrap"> 
        <!-- <div class="alert alert-danger">
          <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
          <?php // echo validation_errors(); ?>
        </div>
        <div class="clear:both;"></div> -->
		    
        <div class="user-login-info">
            <input type="text" class="form-control" name="email" id="email" placeholder="User ID" value="<?php echo set_value('email'); ?>" autofocus>
            <input type="password" class="form-control" placeholder="Password" name="password" id="password">
        </div>
        <label class="checkbox">
            <input type="checkbox" value="remember-me"> Remember me
            <span class="pull-right">
                <a data-toggle="modal" href="#myModal"> Forgot Password?</a>

            </span>
        </label>
        <!--<button class="btn btn-lg btn-login btn-block" type="submit">Sign in</button>
        <a href="index.html" class="btn btn-lg btn-login btn-block">Sign in</a>-->
		  <input type="submit" class="btn btn-lg btn-login btn-block" name="submit" id="submit">

        <div class="registration">
            Don't have an account yet?
            <a class="" href="registration.html">
                Create an account
            </a>
        </div>

    </div>

      <!-- Modal -->
      <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h4 class="modal-title">Forgot Password ?</h4>
                  </div>
                  <div class="modal-body">
                      <p>Enter your e-mail address below to reset your password.</p>
                      <input type="text" name="email1" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">

                  </div>
                  <div class="modal-footer">
                      <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                      <button class="btn btn-success" type="button">Submit</button>
                  </div>
              </div>
          </div>
      </div>
      <!-- modal -->

  </form>

</div>



