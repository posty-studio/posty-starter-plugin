<?php

use Posty_Starter_Plugin\Custom_Post_Types\Event;
use Posty_Starter_Plugin\Template;

$attributes = Template::var('attributes');
$content = Template::var('content'); // InnerBlocks Content
$class = Template::var('class');
$events = Event::latest();
?>

<div class="<?php echo esc_attr($class); ?>">
    <?php foreach ($events as $event) : ?>
        <?php echo $event->post_title; ?>
    <?php endforeach; ?>
</div>
