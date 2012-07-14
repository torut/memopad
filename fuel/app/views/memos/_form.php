<?php $fields = Fieldset::instance('memo'); ?>
<?php echo Form::open(array('class' => 'form-stacked')); ?>

	<fieldset>
	  <table>
<?php echo $fields->field('text'); ?>
<?php echo $fields->field('tag'); ?>
<tr>
  <td>タグ一覧</td>
  <td><?php foreach ($tags as $tag): ?><span class="span1"><a href="javascript:addTag('<?php echo e($tag); ?>')"><?php echo e($tag); ?></a></span><?php endforeach ?></td>
</tr>
	  </table>

		<div class="actions">
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn primary')); ?>

		</div>
	</fieldset>
<?php echo Form::close(); ?>
<script type="text/javascript">
//<![CDATA[
$(function() {
	$('#form_tag').tagsInput({
		width: '480px',
	});
});
function addTag(tag) {
	$('#form_tag').addTag(tag);
}
//]]>
</script>
