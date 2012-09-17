<div>
    <label><?php echo elgg_echo("Category Name"); ?></label><br />
    <?php echo elgg_view('input/text',array('name' => 'cat_name')); ?>
</div>
<div>
    <label><?php echo elgg_echo("Category Description"); ?></label><br />
    <?php echo elgg_view('input/longtext',array('name' => 'cat_desc')); ?>
</div>

<div>
    <?php echo elgg_view('input/submit', array('value' => elgg_echo('save'))); ?>
</div>