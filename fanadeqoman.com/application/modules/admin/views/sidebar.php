<!-- Sidebar user panel -->
                    <div class="user-panel">
						<?php 
							$res=$this->admin_model->get_profilepic();
							if(isset($res->profile_pic) && $res->profile_pic!=''){
						?>
							<div class="pull-left image">
								<img src="<?php echo IMG_PATH;?><?php echo $res->profile_pic; ?>" class="img-circle" alt="User Image" />
							</div>
                        <?php }else{ ?>
							 <div class="pull-left image">
								<img src="<?php echo WEB_DIR;?>img/avatar3.png" class="img-circle" alt="User Image" />
							 </div>
                        <?php } ?>
                        <?php if(isset($res->firstname) && $res->firstname!=''){   ?>
							<div class="pull-left info">
								<p><?php echo $this->lang->line('Hello'); ?>, <?php echo $res->firstname; ?></p>
								<a href="#"><i class="fa fa-circle text-success"></i> <?php echo $this->lang->line('Online'); ?></a>
							</div>
						<?php }else{ ?>
						
							<div class="pull-left info">
                            <p><?php echo $this->lang->line('Hello'); ?> ,<?php echo $this->lang->line('Admin'); ?> </p>
							<a href="#"><i class="fa fa-circle text-success"></i><?php echo $this->lang->line('Online'); ?> </a>
							</div>
						<?php } ?>
                    </div>
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
								<li><a href="<?php echo WEB_URL;?>index/profile"><i class="fa fa-angle-double-right"></i><?php echo $this->lang->line('Profile'); ?> </a></li>
								<li><a href="<?php echo WEB_URL;?>index/change_password"><i class="fa fa-angle-double-right"></i><?php echo $this->lang->line('Change_Password'); ?> </a></li>
                            </ul>
                        </li>
						
						<li class="treeview">
							<a href="#">
								<i class="fa fa-bar-chart-o"></i>
								<span><?php echo $this->lang->line('Hotel_CRS'); ?> </span>
								<i class="fa fa-angle-left pull-right"></i>
							</a>
							<ul class="treeview-menu">
								<li><a href="<?php echo WEB_URL;?>hotel/hotel_registration"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('Add_Hotel'); ?></a></li>
								<li><a href="<?php echo WEB_URL;?>hotel/hotel_region"><i class="fa fa-angle-double-right"></i> Hotel Region</a></li>
								<li><a href="<?php echo WEB_URL;?>hotel/hotel_payment"><i class="fa fa-angle-double-right"></i> Hotel Payment</a></li>
								<li><a href="<?php echo WEB_URL;?>hotel/hotel_manager"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('Hotel_Manager'); ?></a></li>
								<li><a href="<?php echo WEB_URL;?>hotel/room_list"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('Room_Manager'); ?></a></li>
								<li><a href="<?php echo WEB_URL;?>hotel/price_manager"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('Price_Manager'); ?></a></li>
							</ul>
                        </li>
                        
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-edit"></i> <span><?php echo $this->lang->line('banners'); ?></span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
								<li><a href="<?php echo WEB_URL;?>index/banners"><i class="fa fa-angle-double-right"></i><?php echo $this->lang->line('ban'); ?> </a></li>
								<li><a href="<?php echo WEB_URL;?>index/popular_banners"><i class="fa fa-angle-double-right"></i><?php echo $this->lang->line('popular_ban'); ?> </a></li>
							</ul>
                        </li>
                          <li class="treeview">
                            <a href="#">
                                <i class="fa fa-laptop"></i>
                                <span><?php echo $this->lang->line('static_pages'); ?></span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
							<ul class="treeview-menu">
								<li><a href="<?php echo WEB_URL;?>index/static_pages"><i class="fa fa-angle-double-right"></i><?php echo $this->lang->line('pages'); ?></a></li>
								<li><a href="<?php echo WEB_URL;?>index/emails"><i class="fa fa-angle-double-right"></i><?php echo $this->lang->line('Emails'); ?></a></li>
							</ul>
                        </li>
						<li class="treeview">
                            <a href="#">
                                <i class="fa fa-laptop"></i>
                                <span><?php echo $this->lang->line('Control_Panel'); ?></span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo WEB_URL;?>index/global_settings"><i class="fa fa-angle-double-right"></i><?php echo $this->lang->line('Currency'); ?> </a></li>
                                <li><a href="<?php echo WEB_URL;?>index/payment_gateway"><i class="fa fa-angle-double-right"></i><?php echo $this->lang->line('Payment_Gateway'); ?></a></li>
                                <li><a href="<?php echo WEB_URL;?>index/markup_manager"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('Markup_Management'); ?></a></li>
                                <li><a href="<?php echo WEB_URL;?>index/Star_markup"><i class="fa fa-angle-double-right"></i> Markup as per Hotel Rating</a></li>
                            </ul>
                        </li>
                         <li class="treeview">
                            <a href="#">
                                <i class="fa fa-folder"></i> <span><?php echo $this->lang->line('Booking_Manager'); ?></span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo WEB_URL;?>hotel/B2C_bookingReports"><i class="fa fa-angle-double-right"></i><?php echo $this->lang->line('b2c'); ?> </a></li>
                               <!-- <li><a href="<?php echo WEB_URL;?>hotel/callcenter_bookingReports"><i class="fa fa-angle-double-right"><?php echo $this->lang->line('callcenter'); ?> </i> </a></li>-->
                            </ul>
                        </li>
                         <li class="treeview">
                            <a href="#">
                                <i class="fa fa-folder"></i> <span><?php echo $this->lang->line('Hotel_Supplier'); ?></span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo WEB_URL;?>supplier/supplier_list"><i class="fa fa-angle-double-right"></i><?php echo $this->lang->line('Supplier_List'); ?></a></li>
                                 <li><a href="<?php echo WEB_URL;?>supplier/add_supplier"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('Add_Supplier'); ?></a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-laptop"></i>
                                <span><?php echo $this->lang->line('Users_List'); ?></span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
							<ul class="treeview-menu">
								<li><a href="<?php echo WEB_URL;?>users/users_list"><i class="fa fa-angle-double-right"></i><?php echo $this->lang->line('Users_List'); ?></a></li>
								<li><a href="<?php echo WEB_URL;?>users/add_users"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('Add_User'); ?> </a></li>
							</ul>
                        </li>
                      <li class="treeview">
							<a href="#">
								<i class="fa fa-bar-chart-o"></i>
								<span><?php echo $this->lang->line('Call_Center'); ?></span>
								<i class="fa fa-angle-left pull-right"></i>
							</a>
							<ul class="treeview-menu">
								<li><a href="<?php echo WEB_URL;?>index/callcenter_agentlist"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('Call_Center'); ?></a></li>
								<li><a href="<?php echo WEB_URL;?>index/add_callcenter_agents"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('Add_Call_Center'); ?></a></li>
								<li><a href="<?php echo WEB_URL;?>index/callcenter_creditlist"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('Call_Center_Credit'); ?></a></li>
							</ul>
                        </li>
                     </ul>
