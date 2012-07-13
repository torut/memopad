<h2>Viewing #<?php echo $memo->id; ?></h2>


<?php echo Html::anchor('memos/edit/'.$memo->id, 'Edit'); ?> |
<?php echo Html::anchor('memos', 'Back'); ?>