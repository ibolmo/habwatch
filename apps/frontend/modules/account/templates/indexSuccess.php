<?php echo $form->renderFormTag(url_for('@account')) ?>
	<div class="block">
		<div class="column border span-10 append-1">
			<fieldset id="account_essentials"> 
				<legend>Essentials</legend>
				<table id="account_essential_table" class="settings_table">
					<tr>
						<td class="span-7"><label for="field_username">Username</label></td>
						<td><?php echo $form->getObject()->User ?></td>
					</tr>
					<tr>
						<td class="span-7"><label for="fields_first">First Name</label></td>
						<td><input id="fields_first" name="first_name" type="text" value="<?php echo $form->get ?>" /></td>
					</tr>
					<tr>
						<td><label for="fields_last">Last Name</label></td>
						<td><input id="fields_last" name="last_name" type="text" value="<?php echo $account->last_name ?>" /></td>
					</tr>
					<tr>
						<td><label for="fields_password">New Password</label></td>
						<td><input id="fields_password" name="password" type="password"></td>
					</tr>
					<tr>
						<td><label for="fields_password-confirmation">Confirm Password</label></td>
						<td><input id="fields_password-confirmation" name="password-confirmation" type="password"></td>
					</tr>
				</table>
			</fieldset>
			
			<fieldset id="account_privacy"> 
				<legend>Privacy</legend> 
				<p>
					You may disable any phone number, or email address to stop receiving messages from Networked Naturalist.
				</p>
			</fieldset>		
		</div>
		<div class="column span-12 prepend-1">
			
			<fieldset id="account_phone_numbers"> 
				<legend>Phone Numbers</legend>
				<table id="account_phone_numbers_table" class="settings_table">
					<tr>
						<td class="span-4"><label for="field_phone_number_primary">Primary</label></td>
						<td><input id="field_phone_number_primary" name="phone_number[primary][number]" <?php echo @$primary_phone->disabled ? 'class="disabled"' : '' ?>value="<?php echo @$primary_phone->number ?>" /></td>
						<td style="width: 25px;">
							<a href="#" class="disable_field"><?php echo @$primary_phone->disabled ? 'enable' : 'disable' ?></a>
							<input type="checkbox" class="invisible" name="phone_number[primary][disabled]" <?php echo @$primary_phone->disabled ? 'checked="checked"' : '' ?> />
						</td>
						<td style="width: 25px;">&nbsp;</td>
					</tr>
					<tr>
						<td rowspan="<?php echo count($phones) + 2 ?>" id="additional_phone_numbers_row"><label for="field_phone_number_1">Additional</label></td>
					</tr>
					<?php foreach ($phones as $i => $phone): ?>
					<tr>
						<td><input <?php echo ($i == 0) ? 'id="field_phone_number_1"' : '' ?> name="phone_number[<?php echo $i ?>][number]" <?php echo @$phone->disabled ? 'class="disabled"' : '' ?>value="<?php echo @$phone->number ?>" /></td>
						<td>
							<a href="#" class="disable_field"><?php echo @$phone->disabled ? 'enable' : 'disable' ?></a>
							<input type="checkbox" class="invisible" name="phone_number[<?php echo $i ?>][disabled]" <?php echo @$phone->disabled ? 'checked="checked"' : '' ?> />
						</td>
						<td><a href="#" class="remove_field">remove</a></td>
					</tr>
					<?php endforeach ?>
					<tr>
						<td class="center"><a href="#" class="add_field">Add more</a></td>
						<td colspan="2">&nbsp;</td>
					</tr>
				</table>
			</fieldset>
			
			<fieldset id="account_email_addresses"> 
				<legend>Email Addresses</legend>
				<table id="account_email_addresses_table" class="settings_table">
					<tr>
						<td class="span-4"><label for="field_email_address_primary">Primary</label></td>
						<td><input id="field_email_address_primary" name="email_address[primary][address]" <?php echo @$primary_email->disabled ? 'class="disabled"' : '' ?>value="<?php echo @$primary_email->address ?>" /></td>
						<td style="width: 25px;">
							<a href="#" class="disable_field"><?php echo @$primary_email->disabled ? 'enable' : 'disable' ?></a>
							<input type="checkbox" class="invisible" name="email_address[primary][disabled]" <?php echo @$primary_email->disabled ? 'checked="checked"' : '' ?> />
						</td>
						<td style="width: 25px;">&nbsp;</td>
					</tr>
					<tr>
						<td rowspan="<?php echo count($emails) + 2 ?>" id="additional_email_addresses_row"><label for="field_email_address_1">Additional</label></td>
					</tr>
					<?php foreach ($emails as $i => $email): ?>
					<tr>
						<td><input <?php echo ($i == 0) ? 'id="field_email_address_1"' : '' ?> name="email_address[<?php echo $i ?>][address]" <?php echo @$email->disabled ? 'class="disabled"' : '' ?>value="<?php echo @$email->address ?>" /></td>
						<td>
							<a href="#" class="disable_field"><?php echo @$email->disabled ? 'enable' : 'disable' ?></a>
							<input type="checkbox" class="invisible" name="email_address[<?php echo $i ?>][disabled]" <?php echo @$email->disabled ? 'checked="checked"' : '' ?> />
						</td>
						<td><a href="#" class="remove_field">remove</a></td>
					</tr>
					<?php endforeach ?>
					<tr>
						<td class="center"><a href="#" class="add_field">Add more</a></td>
						<td colspan="2">&nbsp;</td>
					</tr>
				</table>
			</fieldset>
			
		</div>
	</div>
	<div class="actions center"> 
		<input name="action[save]" accesskey="s" type="submit" value="Save Changes"> 
	</div>
	<?php return; ?>
	
	<table cellpadding="0" cellspacing="0" border="0">
		<tr>
		  <td>First Name: </td>
		  <td><input type="text" name="first" size="35" maxlength="50" value="<?php echo $row->first_name; ?>" /></td>
		</tr>
		<tr>
		  <td></td>
		</tr>
		<tr>
		    <td>Last Name:</td>
		    <td><input type="text" name="last" size="35" maxlength="50" value="<?php echo $row->last_name; ?>" /></td>
		</tr>
		<tr>
		  <td></td>
		</tr>
		<tr>
		    <td>Email Address:</td>
		    <td><input type="text" name="email" size="35" maxlength="100" value="<?php echo $row->email; ?>" /></td>
		</tr>
		<tr>
		    <td></td>
		</tr>
		<tr>
		    <td>Time Zone:</td>
		    <td>
				<?php 
			        $gmt = $row->timezone;
			        if($gmt == NULL) $gmt = "-8";
			    ?>
				<select name="gmt">
				    <option value="-12"<?php if($gmt == "-12"){echo "selected=\"selected\""; } ?>>(GMT -12:00) Eniwetok, Kwajalein</option>
				    <option value="-11"<?php if($gmt == "-11"){echo "selected=\"selected\""; } ?>>(GMT -11:00) Midway Island, Samoa</option>
				    <option value="-10"<?php if($gmt == "-10"){echo "selected=\"selected\""; } ?>>(GMT -10:00) Hawaii</option>
				    <option value="-9"<?php if($gmt == "-9"){echo "selected=\"selected\""; } ?>>(GMT -9:00) Alaska</option>
				    <option value="-8"<?php if($gmt == "-8"){echo "selected=\"selected\""; } ?>>(GMT -8:00) Pacific Time (US &amp; Canada)</option>
				    <option value="-7"<?php if($gmt == "-7"){echo "selected=\"selected\""; } ?>>(GMT -7:00) Mountain Time (US &amp; Canada)</option>
					<option value="-6"<?php if($gmt == "-6"){echo "selected=\"selected\""; } ?>>(GMT -6:00) Central Time (US &amp; Canada), Mexico City</option>
				    <option value="-5"<?php if($gmt == "-5"){echo "selected=\"selected\""; } ?>>(GMT -5:00) Eastern Time (US &amp; Canada), Bogota, Lima</option>
				    <option value="-4"<?php if($gmt == "-4"){echo "selected=\"selected\""; } ?>>(GMT -4:00) Atlantic Time (Canada), Caracas, La Paz</option>
				    <option value="-3.5"<?php if($gmt == "-3.5"){echo "selected=\"selected\""; } ?>>(GMT -3:30) Newfoundland</option>
				    <option value="-3"<?php if($gmt == "-3"){echo "selected=\"selected\""; } ?>>(GMT -3:00) Brazil, Buenos Aires, Georgetown</option>
				    <option value="-2"<?php if($gmt == "-2"){echo "selected=\"selected\""; } ?>>(GMT -2:00) Mid-Atlantic</option>
				    <option value="-1"<?php if($gmt == "-1"){echo "selected=\"selected\""; } ?>>(GMT -1:00 hour) Azores, Cape Verde Islands</option>
				    <option value="0"<?php if($gmt == "0"){echo "selected=\"selected\""; } ?>>(GMT) Western Europe Time, London, Lisbon, Casablanca</option>
				    <option value="1"<?php if($gmt == "1"){echo "selected=\"selected\""; } ?>>(GMT +1:00 hour) Brussels, Copenhagen, Madrid, Paris</option>
				    <option value="2"<?php if($gmt == "2"){echo "selected=\"selected\""; } ?>>(GMT +2:00) Kaliningrad, South Africa</option>
				    <option value="3"<?php if($gmt == "3"){echo "selected=\"selected\""; } ?>>(GMT +3:00) Baghdad, Riyadh, Moscow, St. Petersburg</option>
				    <option value="3.5"<?php if($gmt == "3.5"){echo "selected=\"selected\""; } ?>>(GMT +3:30) Tehran</option>
				    <option value="4"<?php if($gmt == "4"){echo "selected=\"selected\""; } ?>>(GMT +4:00) Abu Dhabi, Muscat, Baku, Tbilisi</option>
				    <option value="4.5"<?php if($gmt == "4.5"){echo "selected=\"selected\""; } ?>>(GMT +4:30) Kabul</option>
				    <option value="5"<?php if($gmt == "5"){echo "selected=\"selected\""; } ?>>(GMT +5:00) Ekaterinburg, Islamabad, Karachi, Tashkent</option>
				    <option value="5.5"<?php if($gmt == "5.5"){echo "selected=\"selected\""; } ?>>(GMT +5:30) Bombay, Calcutta, Madras, New Delhi</option>
				    <option value="6"<?php if($gmt == "6"){echo "selected=\"selected\""; } ?>>(GMT +6:00) Almaty, Dhaka, Colombo</option>
				    <option value="7"<?php if($gmt == "7"){echo "selected=\"selected\""; } ?>>(GMT +7:00) Bangkok, Hanoi, Jakarta</option>
				    <option value="8"<?php if($gmt == "8"){echo "selected=\"selected\""; } ?>>(GMT +8:00) Beijing, Perth, Singapore, Hong Kong</option>
				    <option value="9"<?php if($gmt == "9"){echo "selected=\"selected\""; } ?>>(GMT +9:00) Tokyo, Seoul, Osaka, Sapporo, Yakutsk</option>
				    <option value="9.5"<?php if($gmt == "9.5"){echo "selected=\"selected\""; } ?>>(GMT +9:30) Adelaide, Darwin</option>
				    <option value="10"<?php if($gmt == "10"){echo "selected=\"selected\""; } ?>>(GMT +10:00) Eastern Australia, Guam, Vladivostok</option>
				    <option value="11"<?php if($gmt == "11"){echo "selected=\"selected\""; } ?>>(GMT +11:00) Magadan, Solomon Islands, New Caledonia</option>
				    <option value="12"<?php if($gmt == "12"){echo "selected=\"selected\""; } ?>>(GMT +12:00) Auckland, Wellington, Fiji, Kamchatka</option>
				</select>
			</td>
		</tr>
		<tr>
		    <td>&nbsp;
		</tr>
		<tr>
		    <td>Phone Number: +1</td>
		    <td>&nbsp;(<input type="text" name="area" size="3" maxlength="3" value="<?php echo $row->phoneArea; ?>" />) &nbsp;&nbsp;<input type="text" name="phoneFirst" size="3" maxlength="3" value="<?php echo $row->phoneFirst; ?>" /> - <input type="text" name="phoneLast" size="4" maxlength="4" value="<?php echo $row->phoneLast; ?>" /></td>
		</tr>
		<tr>
		    <td>
		    <td>&nbsp;</td>
		</tr>
		
		<tr>
			<td>Want to receive SMS messages:</td>
			<td>
				<select name="SMSAllowed">
				    <option value="<?php echo $row->SMSAllowed; ?>" > 
					    <?php if ($row->SMSAllowed == 1) { echo "Yes"; } else { echo "No"; } ?>
					</option>
			    	<option value="<?php echo !$row->SMSAllowed; ?>" > 
				    	<?php if ($row->SMSAllowed == 1) { echo "No"; } else { echo "Yes"; } ?>
					</option>
		    	</select>
	    	</td>
		</tr>
	</table>
    <div align="center">
		<input type="submit" value="Update Account" name="Update Account" /> 
	</div>
</form> 
    
<hr class="space" />

<form method="POST" enctype="multipart/form-data" name="updateAccount" action="<?php echo base_url() ?>/account/updateAccountPassword/">
	<table cellpadding="0" cellspacing="0" border="0">
		<tr>
			<td>Change Password: </td>
			<td>&nbsp;<input type="password" name="password" size="35" maxlength="50" /></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>Confirm Password: </td>
			<td>&nbsp;<input type="password" name="password_check" size="35" maxlength="50" /></td>
		</tr>
    </table>
	<div align="center">
		<input type="submit" value="Update Password" name="Update Password" /> 
	</div>
</form>