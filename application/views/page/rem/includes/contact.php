<h1><?php echo $title; ?></h1>
<div class="contact-left">
	<?php echo $content; ?>	
</div>
<div class="contact-right">
	<?php echo contact_form(); ?>
</div>

<div class="contact-map clear">
	<?php echo @custom_block('extra_content', $id); ?>
</div>

<?php echo edit_post_link(array('id' => $id)); ?>