<!--main content start-->
            <?php $loginuser=$this->session->userdata('admin');    ?>
            <section id="main-content">
                <section class="wrapper">
<div class="row">
	<div class="col-md-12">
                <section class="panel">
                    <div class="panel-body profile-information">
                       <div class="col-md-2">
                           <div class="profile-pic text-center">
                               <?php 
                                  
                                   if(!empty($loginuser['profileimage'])){
                                   $image= explode('.',$loginuser['profileimage']);   
                                   $user_image=$image[0].'_mid.'.$image[1];
                                   $imagepath=base_url().'upload/images/admin/'.$user_image;
                                   }else{
                                      $imagepath=base_url().'public/images/lock_thumb.jpg';
                                   }
                               ?>
                               <img src="<?php echo $imagepath; ?>" alt=""/>
                           </div>
                       </div>  
                       <div class="col-md-5">
                           <div class="profile-desk">
                               <h1><?php  echo  $loginuser['name']; ?></h1>
                               <span class="text-muted"><?php echo  $loginuser['email']; ?></span>
                               <p>
                                   Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                                   Aenean porttitor vestibulum imperdiet. Ut auctor accumsan erat, 
                                   a vulputate metus tristique non. Aliquam aliquam vel orci quis sagittis.
                               </p>
                               <a href="<?php echo base_url('settings/get_profile/'.$loginuser['id']); ?>" class="btn btn-primary">View Profile</a>
                           </div>
                       </div>
                       <div class="col-md-5">
                          <!-- <div class="profile-statistics">
                               <h1>1240</h1>
                               <p>This Week Sales</p>
                               <h1>$5,61,240</h1>
                               <p>This Week Earn</p>
                               <ul>
                                   <li>
                                       <a href="#">
                                           <i class="fa fa-facebook"></i>
                                       </a>
                                   </li>
                                   <li class="active">
                                       <a href="#">
                                           <i class="fa fa-twitter"></i>
                                       </a>
                                   </li>
                                   <li>
                                       <a href="#">
                                           <i class="fa fa-google-plus"></i>
                                       </a>
                                   </li>
                               </ul>
                           </div>-->
                          <section class="panel">
                        <header class="panel-heading">
                            New registered user <span style="float:right;"><?php echo date('d-m-Y');?></span>
                        </header>
                        <div class="panel-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                </tr>
                                </thead>
                                <tbody>
                                 <?php if(!empty($users)){
                                  $i=1;
                                  foreach($users as $user){
                                  ?>
	                             <tr>
	                             <td><?php echo $i; ?></td>
	                             <td><?php echo $user['first_name'].' '.$user['last_name']; ?></td>
	                             <td><?php echo $user['email']; ?></td>
	                             </tr>
                              <?php $i++; }
                              }?>
                                </tbody>
                            </table>
                        </div>

                    </section>
                       </div>   
                    </div>
                </section>

