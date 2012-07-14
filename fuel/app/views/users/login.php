<h2>Login User</h2>
<br>

<?php $fields = Fieldset::instance('user'); ?>
<?php echo Form::open(array('class' => 'form-stacked')); ?>

	<fieldset>
	  <table>
<?php echo $fields->field('username'); ?>
<?php echo $fields->field('password'); ?>
	  </table>

		<div class="actions">
			<?php echo Form::submit('submit', 'Login', array('class' => 'btn primary')); ?>
			<a href="<?php echo Uri::create('users/create'); ?>" class="btn success">Regist Now</a>
		</div>
	</fieldset>
<?php echo Form::close(); ?>
