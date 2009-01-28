<form method="post" action="<?= url_for('@account') ?>"
	<div class="block">
		<div class="column border span-10 append-1">
			<fieldset id="account_essentials">
				<legend>Essentials</legend>

				<?php foreach (array($UserForm, $AccountForm) as $Form): ?>
					<?= $Form->renderHiddenFields() ?>
					<?= $Form->renderGlobalErrors() ?>
				<?php endforeach ?>

				<table id="account_essential_table" class="settings_table">
					<?php foreach (array($UserForm, $AccountForm) as $Form): ?>
						<?php foreach ($Form as $Field): ?>
							<tr>
								<td><?= $Field->renderLabel() ?></td>
								<td>
									<?= $Field->renderError() ?>
									<?= $Field->renderHelp() ?>
									<?= $Field->render() ?>
								</td>
							</tr>
						<?php endforeach ?>
					<?php endforeach ?>
				</table>
			</fieldset>

			<fieldset id="account_privacy">
				<legend>Privacy</legend>
				<p>
					You may disable any phone number, or email address to stop receiving messages from <?= sfConfig::get('app_project_name') ?>.
				</p>
			</fieldset>
		</div>
		<div class="column span-12 prepend-1">
			<fieldset id="account_phone_numbers">
				<legend>Phone Numbers</legend>
				<?= $PhoneNumbersForm->renderGlobalErrors() ?>
				<?php foreach ($PhoneNumbersForm->PhoneNumberForms as $PhoneNumberForm): ?>
				    <?= $PhoneNumberForm->renderGlobalErrors() ?>
				    <?= $PhoneNumberForm->renderHiddenFields() ?>
				<?php endforeach ?>
				<table id="account_phone_numbers_table" class="settings_table">
					<?php foreach ($PhoneNumbersForm->PhoneNumberForms as $PhoneNumberForm): ?>
					    <?php foreach ($PhoneNumberForm as $key => $Field): ?>
					        <?php if (!$Field->isHidden()): ?>
					        <tr>
    					        <td><?= $Field->renderLabel() ?></td>
    					        <td>
									<?= $Field->renderError() ?>
									<?= $Field->renderHelp() ?>
									<?= $Field->render() ?>
					            </td>
    					    </tr>
					        <?php endif ?>
					    <?php endforeach ?>
					<?php endforeach ?>
				</table>
			</fieldset>

			<?php /* ?>
			<fieldset id="account_email_addresses">
				<legend>Email Addresses</legend>
				<table id="account_email_addresses_table" class="settings_table">
					<tr>
						<td class="span-4"><label for="field_email_address_primary">Primary</label></td>
						<td><input id="field_email_address_primary" name="email_address[primary][address]" <?= @$primary_email->disabled ? 'class="disabled"' : '' ?>value="<?= @$primary_email->address ?>" /></td>
						<td style="width: 25px;">
							<a href="#" class="disable_field"><?= @$primary_email->disabled ? 'enable' : 'disable' ?></a>
							<input type="checkbox" class="invisible" name="email_address[primary][disabled]" <?= @$primary_email->disabled ? 'checked="checked"' : '' ?> />
						</td>
						<td style="width: 25px;">&nbsp;</td>
					</tr>
					<tr>
						<td rowspan="<?= count($emails) + 2 ?>" id="additional_email_addresses_row"><label for="field_email_address_1">Additional</label></td>
					</tr>
					<?php foreach ($emails as $i => $email): ?>
					<tr>
						<td><input <?= ($i == 0) ? 'id="field_email_address_1"' : '' ?> name="email_address[<?= $i ?>][address]" <?= @$email->disabled ? 'class="disabled"' : '' ?>value="<?= @$email->address ?>" /></td>
						<td>
							<a href="#" class="disable_field"><?= @$email->disabled ? 'enable' : 'disable' ?></a>
							<input type="checkbox" class="invisible" name="email_address[<?= $i ?>][disabled]" <?= @$email->disabled ? 'checked="checked"' : '' ?> />
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
			<?php //*/ ?>
		</div>
	</div>
	<div class="actions center">
		<input name="action[save]" accesskey="s" type="submit" value="Save Changes">
	</div>