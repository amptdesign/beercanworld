<?php $icon = jaw_template_get_var('icon','icon-circle-small'); ?>
<li class="<?php echo ($icon == 'number' ? $icon : '');  ?>"><i class="<?php echo $icon; ?>"></i><?php echo do_shortcode(jaw_template_get_var('list','')); ?></li>