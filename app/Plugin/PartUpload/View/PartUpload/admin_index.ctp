<h1>Part Upload</h1>

<?php echo $this->Form->create(null, array('class' => 'form-horizontal')) ?>

	<?php echo $this->Upload->input('image1', array()); ?>
	
	<?php echo $this->Upload->input('image2', array()); ?>
	
	
	<?php echo $this->Upload->input('image3', array()); ?>
		
<?php echo $this->Form->end('send') ?>