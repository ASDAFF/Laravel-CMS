<?php if ($showLabel && $showField): ?>
    <?php if ($options['wrapper'] !== false): ?>
    <div <?= $options['wrapperAttrs'] ?> >
    <?php endif; ?>
<?php endif; ?>

<?php if ($showLabel && $options['label'] !== false && $options['label_show']): ?>
    <?= Form::customLabel(__($name), '', $options['label_attr']) ?>
<?php endif; ?>

<?php if ($showField): ?>
	<div class="input-group">
		<span class="input-group-btn">
			<button class="lfm btn btn-brand" type="button" id="lfm" 
			data-preview="holder<?php echo $name ?>" 
			data-input="<?php echo $options['real_name']; ?>">
				<i class="fa fa-picture-o"></i> Choose Image
			</button>
		</span>
		<?= Form::input('text', $name, $options['value'], $options['attr']) ?>
	</div>
	<?php include 'help_block.php' ?>
	<div class="image-form">
		<?php if ($options['value']): ?>
			<img src="<?php echo asset($options['value']); ?>" alt="image">
		<?php endif; ?>
		<div id="holder<?php echo $name ?>"></div>
	</div>
<?php endif; ?>

<?php include 'errors.php' ?>

<?php if ($showLabel && $showField): ?>
    <?php if ($options['wrapper'] !== false): ?>
    </div>
    <?php endif; ?>
<?php endif; ?>