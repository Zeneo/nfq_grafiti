<?php echo $this->element('admin/page_name'); ?>

<div class='admin-form'>

	<?php echo $this->Form->create(null, array('type' => 'file')); ?>

	<?php echo $this->Form->inputs(array_merge($fields, array('legend' => false, 'fieldset' => false))); ?>

	<?php echo $this->Form->submit(__('Add')); ?>

	<?php echo $this->Form->end(); ?>
	
</div>