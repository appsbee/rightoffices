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
                            <a href="javascript:;">
                                <i class="fa fa fa-user"></i>
                                <span>Admin User Management</span>
                            </a>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa fa-user"></i>
                                <span>Content Management</span>
                            </a>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
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
                            <a href="javascript:;">
                                <i class="fa fa fa-user"></i>
                                <span>Admin User Management</span>
                            </a>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa fa-user"></i>
                                <span>Content Management</span>
                            </a>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
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