<?php

use Posty_Starter_Plugin\Custom_Post_Types\Event;

$attributes = Posty_Starter_Plugin\get_template_var('attributes');
$content = Posty_Starter_Plugin\get_template_var('content'); // InnerBlocks Content
$class = Posty_Starter_Plugin\get_template_var('class');
$events = Event::latest();
?>

<div class="<?php echo esc_attr($class); ?>">
    <?php foreach ($events as $event) : ?>
        <?php echo $event->post_title; ?>
    <?php endforeach; ?>
</div>
