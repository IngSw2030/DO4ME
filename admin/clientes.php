<?php      include(dirname(__FILE__).'/header.php');include(dirname(__FILE__).'/user_session_check.php');include(dirname(dirname(__FILE__)).'/objed4ms/class_users.php');include(dirname(dirname(__FILE__)).'/objed4ms/class_order_client_info.php');$database=new do4me_db();$conn=$database->conned4m();$database->conn=$conn;$user=new do4me_users();$order_client_info=new do4me_order_client_info();$user->conn=$conn;$order_client_info->conn=$conn;?>    <div id="d4ma-customers-listing" class="panel tab-content">        <div class="panel panel-default">            <div class="panel-heading">                <h1 class="panel-title"><?php echo $label_language_values['customers'];?></h1>            </div>			<div class="panel-body">				<ul class="nav nav-tabs">					<li class="ad4mive"><a data-toggle="tab" href="#registered-customers-listing"><?php echo $label_language_values['registered_customers'];?></a></li>					<li><a data-toggle="tab" href="#guest-customers-listing"><?php echo $label_language_values['guest_customers'];?></a></li>				</ul>				<div class="tab-content">					<div id="registered-customers-listing" class="tab-pane fade in ad4mive">						<h3><?php echo $label_language_values['registered_customers'];?></h3>						<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModalregister"><?php echo $label_language_values['registered_customers'];?></button>						<div id="myModalregister" class="modal fade" role="dialog">						  <div class="modal-dialog">							<!-- Modal content-->							<div class="modal-content">							  <div class="modal-header">								<button type="button" class="close" data-dismiss="modal">&times;</button>								<h4 class="modal-title">Registered Customer Information</h4>							  </div>							  <div class="modal-body">							  <form id="registered-client-table1" style="overflow:hidden;" method="post"> 									<table class="form-horizontal col-xs-12" cellspacing="0">										<tbody>										<tr class="form-field form-required">											<td class="col-xs-4"><label for="ab-newstaff-fullname" class="control-label"><?php echo $label_language_values['preferred_email'];?></label></td>											<td class=" col-xs-10 pull-left"><input type="text" class="form-control d4m_email add_show_error_class show-error" id="d4m_email" name="d4m_email" required="required" placeholder="<?php echo $label_language_values['your_valid_email_address']; ?>" /></td>										</tr>										<tr class="form-field form-required">											<td class="col-xs-4"><label for="ab-newstaff-fullname" class=""><?php echo $label_language_values['preferred_password'];?></label></td>											<td class=" col-xs-10 pull-left"><input type="password" class="form-control d4m_password" id="d4m_password" name="d4m_password" required="required" placeholder="<?php echo $label_language_values['password']; ?>" /></td>										</tr>										<tr class="form-field form-required">											<td class="col-xs-4"><label for="ab-newstaff-fullname" class=""><?php echo $label_language_values['first_name'];?></label></td>											<td class=" col-xs-10 pull-left"><input type="text" class="form-control d4m_first_name" id="d4m_first_name" name="d4m_first_name" required="required"  placeholder="<?php echo $label_language_values['your_first_name']; ?>" /></td>										</tr>										<tr class="form-field form-required">											<td class="col-xs-4"><label for="ab-newstaff-fullname" class=""><?php echo $label_language_values['last_name'];?></label></td>											<td class=" col-xs-10 pull-left"><input type="text" class="form-control d4m_last_name" id="d4m_last_name" name="d4m_last_name" required="required"  placeholder="<?php echo $label_language_values['your_last_name']; ?>" /></td>										</tr>										<tr class="form-field form-required">											<td class="col-xs-4"><label for="ab-newstaff-fullname" class=""><?php echo $label_language_values['phone'];?></label></td>											<td class="col-xs-10 pull-left"><input type="tel" class="form-control d4m_phone" id="d4m_phone" name="d4m_phone" required="required" placeholder="Your Phone Number" /></td>																					</tr>										<tr class="form-field form-required">											<td class="col-xs-4"><label for="ab-newstaff-fullname" class=""><?php echo $label_language_values['street_address'];?></label></td>											<td class=" col-xs-10 pull-left"><textarea name="d4m_address" id="d4m_address" class="form-control d4m_address" rows="" col="10" placeholder="<?php echo $label_language_values['street_address_placeholder']; ?>"></textarea>										</tr>										<tr class="form-field form-required">											<td class="col-xs-4"><label for="ab-newstaff-fullname" class=""><?php echo $label_language_values['zip_code'];?></label></td>											<td class=" col-xs-10 pull-left"><input type="text" class="form-control d4m_zip_code" id="d4m_zip_code" name="d4m_zip_code" required="required" placeholder="<?php echo $label_language_values['zip_code_placeholder']; ?>" /></td>										</tr>										<tr class="form-field form-required">											<td class="col-xs-4"><label for="ab-newstaff-fullname" class=""><?php echo $label_language_values['city'];?></label></td>											<td class=" col-xs-10 pull-left"><input type="text" class="form-control d4m_city" id="d4m_city" name="d4m_city" required="required" placeholder="<?php echo $label_language_values['city_placeholder']; ?>" /></td>										</tr>										<tr class="form-field form-required">											<td class="col-xs-4"><label for="ab-newstaff-fullname" class=""><?php echo $label_language_values['state'];?></label></td>											<td class=" col-xs-10 pull-left"><input type="text" class="form-control d4m_state" id="d4m_state" name="d4m_state" required="required" placeholder="<?php echo $label_language_values['state_placeholder']; ?>" /></td>										</tr>																				</tbody>									</table>															</div>							  <div class="modal-footer">								<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $label_language_values['close'];?></button>								<button type="button" class="btn btn-success d4m_register_customer_btn"><?php echo $label_language_values['create'];?></button>							</div>							</div>						  </div>						  </form>						</div>												<div id="accordion" class="panel-group">							<table id="registered-client-table" class="display responsive nowrap table table-striped table-bordered" cellspacing="0" width="100%">								<thead>								<tr>									<th><?php echo $label_language_values['client_name'];?></th>									<th><?php echo $label_language_values['email'];?></th>									<th><?php echo $label_language_values['phone'];?></th>									<th><?php echo $label_language_values['bookings'];?></th>								</tr>								</thead>								<tbody>								<?php 								$reg_user_data = $user->readall();								while($r_data = mysqli_fetch_array($reg_user_data)){																			$booking = $user->get_users_totalbookings($r_data['id']);									?>										<tr id="myregisted_<?php  echo $r_data['id'];?>">											<td><?php if($r_data['first_name'] != '' && $r_data['last_name'] != ''){echo $r_data['first_name'].' '.$r_data['last_name'];}elseif($r_data['first_name'] != '' && $r_data['last_name'] == ''){echo $r_data['first_name'];}elseif($r_data['first_name'] == '' && $r_data['last_name'] != ''){echo $r_data['last_name'];}elseif($r_data['first_name'] == '' && $r_data['last_name'] == ''){echo 'N/A';} ?></td>											<td><?php echo $r_data['user_email']; ?></td>											<td><?php if(strlen($r_data['phone'])>6){echo $r_data['phone'];}else{echo 'N/A';} ?></td>											<td class="d4m-bookings-td">												<a class="btn btn-primary <?php  if($booking == 0){													echo "disabled";												}												else{echo "myregistercust_bookings";}?>" data-id="<?php echo $r_data['id'];?>" href="#registered-details"  data-toggle="modal">													<?php  echo $label_language_values['bookings'];?><span class="badge br-10"><?php echo $booking;?></span>												</a>																																			<a data-id="<?php echo $r_data['id'];?>" class="btn btn-danger col-sm-offset-1" data-toggle="popover" rel="popover" data-placement='left' title="Delete this customer?"><i class="fa fa-trash"></i> <?php  echo $label_language_values['delete'];?></a>																								<div id="popover-delete-servicess" style="display: none;">													<div class="arrow"></div>													<table class="form-horizontal" cellspacing="0">														<tbody>														<tr>															<td>																<a data-id="<?php echo $r_data['id'];?>" value="Delete" class="btn btn-danger btn-sm mybtndelete_register_customers_entry" ><?php echo $label_language_values['yes'];?></a>																<button id="d4m-close-popover-customerss" class="btn btn-default btn-sm" href="javascript:void(0)"><?php echo $label_language_values['cancel'];?></button>															</td>														</tr>														</tbody>													</table>												</div>												<!-- end pop up -->											</td>										</tr>									<?php 																	}								?>								</tbody>							</table>							<div id="registered-details" class="modal fade booking-details-modal">								<div class="modal-dialog modal-lg">									<div class="modal-content">										<div class="modal-header">											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>											<h4 class="modal-title"><?php echo $label_language_values['registered_customers_bookings'];?></h4>										</div>										<div class="modal-body myregcust_modal">											<div class="table-responsive">												<table id="registered-client-booking-details_new" class="display table table-striped table-bordered" cellspacing="0" width="100%">													<thead>													<tr>														<th style="width: 9px !important;">#</th>														<th style="width: 67px !important;"><?php echo $label_language_values['cleaning_service'];?></th>														<th style="width: 44px !important;"><?php echo $label_language_values['booking_serve_date'];?></th>														<th style="width: 39px !important;"><?php echo $label_language_values['booking_status'];?></th>														<th style="width: 70px !important;"><?php echo $label_language_values['payment_method'];?></th>														<th style="width: 257px !important;"><?php echo $label_language_values['more_details'];?></th>													</tr>													</thead>													<tbody id="details_booking_display">												  													</tbody>												</table>											</div>										</div>									</div>								</div>							</div>						</div>					</div>					<div id="guest-customers-listing" class="tab-pane fade">						<h3><?php echo $label_language_values['guest_customers'];?></h3>						<div id="accordion" class="panel-group">							<table id="guest-client-table" class="display responsive nowrap table table-striped table-bordered" cellspacing="0" width="100%">								<thead>								<tr>									<th><?php echo $label_language_values['client_name'];?></th>									<th><?php echo $label_language_values['email'];?></th>									<th><?php echo $label_language_values['phone'];?></th>									<th><?php echo $label_language_values['bookings'];?></th>								</tr>								</thead>								<tbody>								<?php 								$guest_user_data =  $user->read_all_guestuser();								while($g_data = mysqli_fetch_array($guest_user_data)){									?>									<tr id="myguest_<?php  echo $g_data['order_id'];?>">										<td><?php if($g_data['client_name'] != ''){echo $g_data['client_name'];}else{echo 'N/A';} ?></td>										<td><?php echo $g_data['client_email']; ?></td>										<td><?php if(strlen($g_data['client_phone'])>6){echo $g_data['client_phone'];}else{echo 'N/A';} ?></td>										<td class="d4m-bookings-td">											<a class="btn btn-primary myguestcust_bookings" data-email="<?php echo $g_data['client_email']; ?>" href="#guest-details" data-toggle="modal" data-id="<?php echo $g_data['order_id'];?>">												<?php  echo $label_language_values['bookings'];?>																							</a>											<a data-id="<?php echo $g_data['order_id'];?>" class="btn btn-danger col-sm-offset-1 mybtndelete_guest_customers_entry"><i class="fa fa-trash"></i> <?php  echo $label_language_values['delete'];?></a>										</td>									</tr>								<?php 								}								?>								</tbody>							</table>							<div id="guest-details" class="modal fade booking-details-modal">								<div class="modal-dialog modal-lg">									<div class="modal-content">										<div class="modal-header">											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>											<h4 class="modal-title"><?php echo $label_language_values['guest_customers_bookings'];?></h4>										</div>										<div class="modal-body">											<div class="table-responsive">												<table id="guest-client-booking-details_new" class="display responsive nowrap table table-striped table-bordered" cellspacing="0" width="100%">													<thead>													<tr>														<th style="width: 9px !important;">#</th>														<th style="width: 67px !important;"><?php echo $label_language_values['cleaning_service'];?></th>														<th style="width: 44px !important;"><?php echo $label_language_values['booking_serve_date'];?></th>														<th style="width: 39px !important;"><?php echo $label_language_values['booking_status'];?></th>														<th style="width: 70px !important;"><?php echo $label_language_values['payment_method'];?></th>														<th style="width: 257px !important;"><?php echo $label_language_values['more_details'];?></th>													</tr>													</thead>													<tbody id="details_booking_display_guest">													</tbody>												</table>											</div>										</div>									</div>								</div>							</div>						</div>					</div>				</div>			</div>        </div>    </div><?php include(dirname(__FILE__).'/footer.php');?>