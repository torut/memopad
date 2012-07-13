<h2>Editing Memo</h2>
<br>

<?php echo render('memos/_form'); ?>
<p>
	<?php echo Html::anchor('memos/view/'.$memo->id, 'View'); ?> |
	<?php echo Html::anchor('memos', 'Back'); ?></p>
