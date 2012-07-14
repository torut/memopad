<h2>Viewing #<?php echo $memo->id; ?></h2>

<p>
 <?php echo nl2br(e($memo->text)); ?>
</p>

<?php echo Html::anchor('memos/edit/'.$memo->id, 'Edit'); ?> |
<?php echo Html::anchor('memos', 'Back'); ?>