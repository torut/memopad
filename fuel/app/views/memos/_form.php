<?php $fields = Fieldset::instance('memo'); ?>
<?php echo Form::open(array('class' => 'form-stacked')); ?>

	<fieldset>
	  <table>
<?php echo $fields->field('text'); ?>
	  </table>

		<div class="actions">
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn primary')); ?>

		</div>
	</fieldset>
<?php echo Form::close(); ?>
