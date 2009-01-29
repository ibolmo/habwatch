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
					<?php foreach ($PhoneNumbersForm->PhoneNumberForms as $i => $Form): ?>
					    <tr>
                            <?php if ($i == 0): ?>
        					<td class="span-4">
        					    <?= $Form['number']->renderLabel() ?>
    					    </td>
                            <?php endif ?>
        					<td>
        					    <?= $Form['number'] ?>
        				    </td>
        					<td <?= ($i == 0) ? 'style="width: 25px"' : '' ?>>
        						<a href="#" class="disable_field"><?= (bool) $Form['disabled']->getValue() ? 'enable' : 'disable' ?></a>
        						<?= $Form['disabled']->render(); //array('class' => 'invisible')) ?>
        					</td>
        					<td <?= ($i == 0) ? 'style="width: 25px"' : '' ?>>
        					    <?php if ($i != 0): ?>
        					    <a href="#" class="remove_field">remove</a>
        					    <?php endif ?>
        				    </td>
        				</tr>
        				<?php if ($i == 0): ?>
        				<tr>
        					<td rowspan="<?= count($PhoneNumbersForm->PhoneNumberForms) + 2 ?>">
        					    <?= $PhoneNumbersForm->PhoneNumberForms[1]['number']->renderLabel() ?>
    					    </td>
        				</tr>
        				<?php endif ?>
					<?php endforeach ?>
    				<tr>
    					<td class="center"><a href="#" class="add_field">Add more</a></td>
    					<td colspan="2">&nbsp;</td>
    				</tr>
    					    
    					    <?php /* ?>
            				<?php foreach ($PhoneNumberForm as $i => $Field): ?>
            				<tr>
                                <?php if ($i == 0): ?>
            					<td class="span-4">
            					    <?= $Field->renderLabel() ?>
        					    </td>
                                <?php endif ?>
            					<td>
            					    <?= $Field['number'] ?>
            				    </td>
            					<td <?= ($i == 0) ? 'width: 25px' : '' ?>>
            						<a href="#" class="disable_field"><?= @$Field->disabled ? 'enable' : 'disable' ?></a>
            						<?= $Field['disabled'] ?>
            					</td>
            					<td <?= ($i == 0) ? 'width: 25px' : '' ?>>
            					    <?php if ($i != 0): ?>
            					    <a href="#" class="remove_field">remove</a>
            					    <?php endif ?>
            					    &nbsp;
            				    </td>
            				</tr>
            				<?php if ($i == 0): ?>
            				<tr>
            					<td rowspan="<?= count($PhoneNumbersForm->PhoneNumberForms) + 2 ?>">
            					    <label for="field_phone_number_1">Additional</label>
        					    </td>
            				</tr>
            				<?php endif ?>
            				<?php endforeach ?>
            				<tr>
            					<td class="center"><a href="#" class="add_field">Add more</a></td>
            					<td colspan="2">&nbsp;</td>
            				</tr>
            			    <?php //*/ ?>
				</table>
			</fieldset>
		</div>
	</div>
	<div class="actions center">
		<input name="action[save]" accesskey="s" type="submit" value="Save Changes">
	</div>