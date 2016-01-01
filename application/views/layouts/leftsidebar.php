<!--sidebar start-->
            <aside>
                <div id="sidebar" class="nav-collapse">
				   <?php 
				   		$url=$this->uri->segment(1);
						$userdetails = $this->session->userdata('admin'); 
				   ?>
				   						
                    <!-- sidebar menu start-->
                    <ul class="sidebar-menu" id="nav-accordion">
					    <?php 
						if($userdetails['role'] == 'SA'){
						?>    
						<li>
                            <a  href="<?php echo base_url('dashboard'); ?>" <?php if($url=='dashboard'){?> class="active" <?php }?>>
                                <i class="fa fa-dashboard"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="sub-menu">
                            <a href="<?php echo base_url('admin/get_admin_list'); ?>" <?php if($url=='admin'){?> class="active" <?php }?>>
                                <i class="fa fa-user"></i>
                                <span>Admin Management</span>
                            </a>
                        </li>
                        <li class="sub-menu">
                            <a href="<?php echo base_url('centre/get_centre_list'); ?>" <?php if($url=='centre'){?> class="active" <?php }?>>
                                <i class="fa fa fa-user"></i>
                                <span>Manage Business Center</span>
                            </a>
                        </li>
                        <li class="sub-menu">
                            <a href="<?php echo base_url('client/get_client_list'); ?>" <?php if($url=='client'){?> class="active" <?php }?>">
                                <i class="fa fa fa-user"></i>
                                <span>Client Management</span>
                            </a>
                        </li>
                        <li class="sub-menu">
                            <a href="<?php echo base_url('content/get_content_list'); ?>" <?php if($url=='content'){?> class="active" <?php }?>">
                                <i class="fa fa fa-user"></i>
                                <span>Content Management</span>
                            </a>
                        </li>
                        <li class="sub-menu">
                            <a href="<?php echo base_url('metakeyword/get_metakeyword_list'); ?>" <?php if($url=='metakeyword'){?> class="active" <?php }?>">
                                <i class="fa fa fa-user"></i>
                                <span>Metakeyword Management</span>
                            </a>
                        </li>
                        <li class="sub-menu">
                            <a href="<?php echo base_url('settings/get_profile/'.$userdetails['id']); ?>" <?php if($url=='settings'){?> class="active" <?php }?>">
                                <i class="fa fa fa-user"></i>
                                <span>Settings</span>
                            </a>
                        </li>
						<?php 
						}else{
						?>
						<li>
                            <a  href="<?php echo base_url('dashboard'); ?>" <?php if($url=='dashboard'){?> class="active" <?php }?>>
                                <i class="fa fa-dashboard"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="sub-menu">
                            <a href="<?php echo base_url('centre/get_centre_list'); ?>" <?php if($url=='centre'){?> class="active" <?php }?>>
                                <i class="fa fa fa-user"></i>
                                <span>Manage Business Center</span>
                            </a>
                        </li>
                        <li class="sub-menu">
                            <a href="<?php echo base_url('client/get_client_list'); ?>" <?php if($url=='client'){?> class="active" <?php }?>">
                                <i class="fa fa fa-user"></i>
                                <span>Client Management</span>
                            </a>
                        </li>
                        <li class="sub-menu">
                            <a href="<?php echo base_url('content/get_content_list/'); ?>" <?php if($url=='content'){?> class="active" <?php }?>">
                                <i class="fa fa fa-user"></i>
                                <span>Content Management</span>
                            </a>
                        </li>
                        <li class="sub-menu">
                            <a href="<?php echo base_url('metakeyword/get_metakeyword_list'); ?>" <?php if($url=='metakeyword'){?> class="active" <?php }?>">
                                <i class="fa fa fa-user"></i>
                                <span>Metakeyword Management</span>
                            </a>
                        </li>
                        <li class="sub-menu">
                            <a href="<?php echo base_url('settings/get_profile/'.$userdetails['id']); ?>" <?php if($url=='settings'){?> class="active" <?php }?>">
                                <i class="fa fa fa-user"></i>
                                <span>Settings</span>
                            </a>
                        </li>
						<?php }?>
                    </ul>
                    <!-- sidebar menu end-->
                </div>
            </aside>
            <!--sidebar end-->