<div class="white-bg">
	<div id="printArea" style="background: #fff">
		<style type="text/css">
			.header_logo {
				text-align: center;
			}

			.inner_area {
				margin-left: 10px;
				margin-right: 10px;
			}

			table {
				width: 100%;
				background-color: transparent;
				max-width: 100%;
				display: table;
				border-collapse: collapse;
				border-spacing: 0;
			}

			td {
				padding: 4px;
			}

			.border-line {
				border-bottom: 1px solid;
				margin-left: -11px;
				width: 874px;
			}

			.content-body {}

			th,
			tr,
			td,
			table,
			tbody,
			thead {
				border-color: #ddd;
				border: 0;
			}

			
		</style>
		<?php //echo '<pre>';print_r($hotel_booking_info);exit; 
		?>
		<div class="row">
			<div class="col-md-12" style="background: #fff;text-align: left; border:1px solid #ddd; padding: 10px">
				<div class="header_logo">
					<img src="<?php echo base_url(); ?>assets/images/logo.png" width="150">
					<h1 class="mb-1">Booking Voucher</h1>
				</div>
				<div class="address-header" style="text-align: center;">
					<div style="clear: both;"></div>
					<span style="text-align: center;">Tel:(+91) 9714631903 Email: info@travelfreeby.com</span>
				</div>
				<div class="content-body">
					<p><span>Dear <?php echo $passenger_info[0]->title . ' ' . ucfirst($passenger_info[0]->first_name) . ' ' . ucfirst($passenger_info[0]->last_name); ?>,</span></p>
					<?php if ($hotel_booking_info->agentid > 0) { ?>
						<p>Thank you for booking</p>
					<?php } else { ?>
						<p>Thank you for choosing us and congratulations on booking your hotel accommodation. Your payment of <span style="font-weight: bold;"> <?php echo 'INR ' . number_format($hotel_booking_info->total_cost); ?></span> has been successful and we look forward to serving you better.</p>
					<?php } ?>
					<p>Please find below your hotel voucher for your trip. You need to present the accommodation voucher at the hotel reception at the time of check-in.</p>
				</div>
				<table border="1" class="table1" cellspacing="0" cellpadding="5" style="border-collapse: collapse;">
					<tbody>
						<tr>
							<td colspan="4" bgcolor="#e9e9e9"><strong>HOTEL DETAILS</strong></td>
						</tr>
						<tr>
							<td colspan="1" width="20%">Hotel Name :</td>
							<td colspan="3"><?php echo ucwords(strtolower($hotel_booking_info->hotel_name)); ?></td>
						</tr>
						<tr>
							<td colspan="1">City :</td>
							<td colspan="3"><?php echo $hotel_booking_info->city; ?></td>
						</tr>
						<tr>
							<td colspan="1">Address :</td>
							<td colspan="3"><?php echo $hotel_booking_info->address; ?></td>
						</tr>
						<tr>
							<td colspan="1">Phone :</td>
							<td colspan="1"><?php echo $hotel_booking_info->phone; ?></td>
							<!-- <td colspan="1" width="20%">Fax</td>
							<td colspan="1"><?php //echo $hotel_booking_info->fax; 
											?></td> -->
						</tr>
						<?php if ($hotel_booking_info->emailid != '') { ?>
							<tr>
								<td colspan="1">Email :</td>
								<td colspan="3"><?php echo $hotel_booking_info->emailid; ?></td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
				<table border="1" class="table2" cellspacing="0" cellpadding="5" style="border-collapse: collapse;">
					<tbody>
						<tr>
							<td colspan="4" bgcolor="#e9e9e9"><strong>BOOKING DETAILS</strong></td>
						</tr>
						<tr>
							<td colspan="1" width="20%">Booking Date :</td>
							<td colspan="1" width="20%"><?php echo $hotel_booking_info->Booking_Date; ?></td>
							<td colspan="1" width="20%">Booking ID :</td>
							<td colspan="1"><?php echo $hotel_booking_info->uniqueRefNo; ?></td>
						</tr>
						<tr>
							<td colspan="1">Booking Status :</td>
							<td colspan="1">
								<?php
								if ($hotel_booking_info->Booking_Status == 'Success' || $hotel_booking_info->Booking_Status == 'Confirmed' || $hotel_booking_info->Booking_Status == 'Vouchered' && $hotel_booking_info->Cancellation_Status == '') {
									echo '<span style="color:green"><strong>CONFIRMED</strong></span>';
								} else if ($hotel_booking_info->Booking_Status == 'Success' || $hotel_booking_info->Booking_Status == 'Confirmed' || $hotel_booking_info->Booking_Status == 'Vouchered' && $hotel_booking_info->Cancellation_Status == 'Cancelled') {
									echo '<span style="color:red"><strong>CANCELLED</strong></span>';
								} else if ($hotel_booking_info->Booking_Status == 'On Request') {
									echo '<span style="color:red"><strong>On Request</strong></span>';
								} else {
									echo '<span style="color:red"><strong>FAILED</strong></span>';
								}
								?>
							</td>
							<td colspan="1">Hotel Reference :</td>
							<td colspan="1"><?php echo $hotel_booking_info->Booking_RefNo; ?></td>
						</tr>
						<tr>
							<td colspan="1">Check-in Date :</td>
							<td colspan="1"><?php echo $hotel_booking_info->check_in; ?>
								<?php
								if (!empty($hotel_booking_info->checkintime)) {
									echo $hotel_booking_info->checkintime;
								} else {
									echo '03:00 PM';
								}
								?>
							</td>
							<td colspan="1">Check-Out Date :</td>
							<td colspan="1"><?php echo $hotel_booking_info->check_out; ?>
								<?php
								if (!empty($hotel_booking_info->checkouttime)) {
									echo $hotel_booking_info->checkouttime;
								} else {
									echo '11:00 AM';
								}
								?>
							</td>
						</tr>
						<tr>
							<td colspan="1">Pax Name :</td>
							<td colspan="3">
								<?php foreach ($passenger_info as $guests) { ?>
									<?php echo $guests->title ?> <?php echo ucfirst($guests->first_name) . ' ' . ucfirst($guests->last_name); ?><br>
								<?php } ?>
							</td>
						</tr>
					</tbody>
				</table>
				<?php
				$search_array = unserialize($hotel_booking_info->searcharray);
				$room_type = explode(', - ', $hotel_booking_info->room_type);
				$room_name = explode(',', $room_type[0]);
				$cancel_policy = explode('||', rtrim($hotel_booking_info->cancellation_policy, '||'));
				$incl = explode(',', rtrim($hotel_booking_info->inclusion));
				?>
				<table border="1" class="table3" cellspacing="0" cellpadding="5" style="border-collapse: collapse;">
					<thead>
						<tr bgcolor="#e9e9e9">
							<th style="text-align: left;"></th>
							<th style="text-align: left;">ROOM TYPE</th>
							<th style="text-align: left;">ADULTS</th>
							<th style="text-align: left;">CHILD(REN)</th>
							<?php //if(!empty($search_array['childs_ages'])){ 
							?>
							<th style="text-align: left;">CHILD(REN) AGE</th>
							<?php //} 
							?>
							<th style="text-align: left;">MEAL BASIS</th>
						</tr>
					</thead>
					<?php for ($i = 0; $i < $hotel_booking_info->room_count; $i++) {
					?>
						<?php
						if (empty($room_name[$i])) {
							$rrom = $room_name[$i - 1];
						} else {
							$rrom = $room_name[$i];
						}
						?>
						<tbody>
							<tr style="text-align: left;">
								<td><?php echo $i + 1 ?></td>
								<td><?php echo ucwords(strtolower($rrom)); ?></td>
								<td><?php echo $search_array['adults'][$i]; ?></td>
								<?php if ($search_array['childs'][$i] > 0) { ?>
									<td><?php echo $search_array['childs'][$i]; ?></td>
								<?php } else { ?>
									<td> - </td>
								<?php } ?>
								<?php if (!empty($search_array['childs_ages'])) { ?>
									<td><?php echo $search_array['childs_ages'][$i]; ?></td>
								<?php } else { ?>
									<td> - </td>
								<?php } ?>
								<?php if (!empty($incl[$i])) {
								?>
									<td><?php if ($incl[$i] == 'None') {
											echo 'Room Only';
										} else {
											echo $incl[$i];
										}
										?></td>
								<?php } else { ?>
									<td>Room Only</td>
								<?php } ?>
							</tr>
						</tbody>
					<?php } ?>
				</table>
				<table border="1" class="table3" cellspacing="0" cellpadding="5" style="border-collapse: collapse;">
					<thead>
						<tr>
							<th bgcolor="#e9e9e9" style="text-align: left;">CANCELLATION POLICY</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($cancel_policy as $policy) { ?>
							<tr style="">
								<td><?php echo $policy ?></td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
				<table border="1" class="table3" width="100%" cellspacing="0" cellpadding="5" style="border-collapse: collapse;">
					<thead>
						<tr>
							<th bgcolor="#e9e9e9" width="10%" style="text-align: left;">Fare Breakup</th>
							<th bgcolor="#e9e9e9" width="10%" style="text-align: left;">Hotel Fare</th>
							<th bgcolor="#e9e9e9" width="10%" style="text-align: left;">SGST</th>
							<th bgcolor="#e9e9e9" width="10%" style="text-align: left;">CGST</th>
							<!-- <th bgcolor="#e9e9e9" width="10%" style="text-align: left;">Deals</th> -->
							<th bgcolor="#e9e9e9" width="10%" style="text-align: left;">Grand Total</th>
						</tr>
					</thead>
					<tbody>
						<tr style="">
							<td width="10%"></td>
							<td width="10%">INR <?php echo number_format($hotel_booking_info->Net_Amount + $hotel_booking_info->Admin_Markup); ?></td>
							<td width="10%">INR <?php echo number_format($hotel_booking_info->Payment_Charge / 2); ?></td>
							<td width="10%">INR <?php echo number_format($hotel_booking_info->Payment_Charge / 2); ?></td>
							<!-- <td width="10%">INR <?php //if ($hotel_booking_info->deals != '') {echo $hotel_booking_info->deals;} else {echo '  --';}
														?></td> -->
							<td width="10%">INR <?php echo number_format($hotel_booking_info->total_cost) ?></td>
						</tr>
					</tbody>
				</table>
				<!-- <table border="1" class="table3" cellspacing="0" cellpadding="5" style="border-collapse: collapse;">
					<thead>
						<tr>
							<th bgcolor="#e9e9e9" style="text-align: left;">For Hotel Use Only</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								This service is payable by <?php //echo strtoupper($hotel_booking_info->Api_Name); 
															?>. Payment for extras to be collected by clients.
							</td>
						</tr>
					</tbody>
				</table> -->
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
</div>