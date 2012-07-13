<?php $fields = Fieldset::instance('user'); ?>
<?php echo Form::open(array('class' => 'form-stacked')); ?>

	<fieldset>
	  <table>
<?php echo $fields->field('username'); ?>
<?php echo $fields->field('password'); ?>
<?php echo $fields->field('email'); ?>
	  </table>

		<div class="actions">
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn primary')); ?>

		</div>
	</fieldset>
<?php echo Form::close(); ?>
