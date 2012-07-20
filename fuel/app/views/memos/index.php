<h2>Listing Memos</h2>
<br>
<?php if ($memos): ?>
<?php echo $start_item; ?>件目～<?php echo $end_item; ?>件目 / 全<?php echo $total_items;  ?>件
<table class="zebra-striped">
	<thead>
		<tr>
			<th>概要</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($memos as $memo): ?>		<tr>

		<td>
		  <?php echo e(Str::truncate($memo->text, 20)); ?>
		</td>
			<td>
				<?php echo Html::anchor('memos/view/'.$memo->id, 'View'); ?> |
				<?php echo Html::anchor('memos/edit/'.$memo->id, 'Edit'); ?> |
				<?php echo Html::anchor('memos/delete/'.$memo->id, 'Delete', array('onclick' => "return confirm('Are you sure?')")); ?>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php echo Pagination::create_links(); ?>

<?php else: ?>
<p>No Memos.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('memos/create', 'Add new Memo', array('class' => 'btn success')); ?>
	<a href="<?php echo Uri::create('logout'); ?>" class="btn">logout</a>
</p>
