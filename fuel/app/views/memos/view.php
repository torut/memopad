<h2>Viewing #<?php echo $memo->id; ?></h2>

<p>
 <?php echo nl2br(e($memo->text)); ?>
</p>

<p>
Tags:
<?php foreach ($memo->tags as $tag): ?><span><?php echo e($tag->tag); ?></span>
<?php endforeach ?>
<br />
Created: <?php echo e($memo->created_at); ?>
<br />
Updated: <?php echo e($memo->updated_at); ?>
</p>

<?php echo Html::anchor('memos/edit/'.$memo->id, 'Edit'); ?> |
<?php echo Html::anchor('memos', 'Back'); ?>
