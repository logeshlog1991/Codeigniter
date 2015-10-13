<!-- Sidebar user panel -->
                    <div class="user-panel">
						<?php 
							$res=$this->admin_model->get_profilepic();
							if(isset($res->hotel_logo) && $res->hotel_logo!=''){
						?>
							<div class="pull-left image">
								<img src="<?php echo IMG_PATH;?><?php echo $res->hotel_logo; ?>" class="img-circle" alt="User Image" />
							</div>
                        <?php }else{ ?>
							 <div class="pull-left image">
								<img src="<?php echo WEB_DIR;?>img/avatar3.png" class="img-circle" alt="User Image" />
							 </div>
                        <?php } ?>
                        <?php if(isset($res->name) && $res->name!=''){   ?>
							<div class="pull-left info">
							<p>Hello, <?php echo $res->name; ?></p>
								<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
							</div>
						<?php }else{ ?>
						
							<div class="pull-left info">
                            <p>Hello, Supplier</p>
							<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
							</div>
						<?php } ?>
                    </div>
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="active">
                            <a href="<?php echo WEB_URL;?>index/dashboard">
                                <i class="fa fa-dashboard"></i> <span><?php echo $this->lang->line('dashboard'); ?></span>
                            </a>
                        </li>
						<li class="treeview">
                            <a href="#">
                                <i class="fa fa-edit"></i> <span><?php echo $this->lang->line('Manage_Profile'); ?></span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
								<li><a href="<?php echo WEB_URL;?>index/myacc_details"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('Profile'); ?> </a></li>
								<li><a href="<?php echo WEB_URL;?>index/edit_profile"><i class="fa fa-angle-double-right"></i><?php echo $this->lang->line('Edit_My_Profile'); ?></a></li>
								<li><a href="<?php echo WEB_URL;?>index/add_logo"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('Add_Logo'); ?></a></li>
								<li><a href="<?php echo WEB_URL;?>index/change_password"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('Change_Password'); ?></a></li>
                            </ul>
                        </li>
						
						<li class="treeview">
							<a href="#">
								<i class="fa fa-bar-chart-o"></i>
								<span><?php echo $this->lang->line('Hotel_Manager'); ?></span>
								<i class="fa fa-angle-left pull-right"></i>
							</a>
							<ul class="treeview-menu">
								<!--<li><a href="<?php echo WEB_URL;?>hotel/hotel_manager"><i class="fa fa-angle-double-right"></i>Hotel Manager</a></li>-->
								<li><a href="<?php echo WEB_URL;?>hotel/room_list"><i class="fa fa-angle-double-right"></i><?php echo $this->lang->line('Room_Manager'); ?></a></li>
								<!--<li><a href="<?php echo WEB_URL;?>hotel/amenity_list"><i class="fa fa-angle-double-right"></i><?php echo $this->lang->line('Amenity_list'); ?></a></li>-->
								<li><a href="<?php echo WEB_URL;?>hotel/price_manager"><i class="fa fa-angle-double-right"></i><?php echo $this->lang->line('Price_Manager'); ?> </a></li>
								
							</ul>
                        </li>
                        
						<li class="treeview">
                            <a href="#">
                                <i class="fa fa-laptop"></i>
                                <span><?php echo $this->lang->line('Booking_Manager'); ?></span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo WEB_URL;?>hotel/booking_details"><i class="fa fa-angle-double-right"></i><?php echo $this->lang->line('Booking_Details'); ?></a></li>                              
                            </ul>
                        </li>
                     
                     </ul>
