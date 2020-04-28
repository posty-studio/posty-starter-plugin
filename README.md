# Posty Starter Plugin

An opinionated starter plugin for WordPress.

## Table of Contents

- [Installation](#installation)
- [Development](#development)
- [Build](#build)
- [Features](#features)
  * [Custom Post Types](#custom-post-types)
  * [Taxonomies](#taxonomies)
  * [Assets](#assets)
  * [Blocks](#blocks)
  * [Helpers](#helpers)
- [License](#license)

## Installation

Clone or copy the contents of the repository, then run `npm install` or `yarn install` to get started.

There's a few placeholders that need to be replaced. Please note that these are case-sensitive. For example. if your plugin is named `lion-king-quote-generator`, you'd rename like this:

| Original                   | Replacement                     | Used For                         |
|----------------------------|---------------------------------|----------------------------------|
| `posty-starter-plugin.php` | `lion-king-quote-generator.php` | The base plugin file             |
| `Posty_Starter_Plugin`     | `Lion_King_Quote_Generator`     | PHP classes namespace            |
| `posty-starter-plugin`     | `lion-king-quote-generator`     | Textdomain and block name prefix |
| `POSTY_STARTER_PLUGIN`     | `LION_KING_QUOTE_GENERATOR`     | Constants                        |
| `postyStarterPlugin`       | `LionKingQuoteGenerator`        | JavaScript l10n variable*        |

*\*This is the `$object_name` variable when [localizing a script](https://developer.wordpress.org/reference/functions/wp_localize_script/) in the `Assets` class.*

## Development

Run `npm run start` to start developing. Webpack will automatically process style and script changes.

## Build

Run `npm run build` to compile and minify all assets.

## Features

Posty Starter Plugin has a bunch of features that enable you to get productive right from the start.

### Custom Post Types

To register a new custom post type, you need to extend the `Custom_Post_Types/Base` class like so:

```php
class Event extends Base {
    const NAME = 'posty-event';

    /**
     * Register the custom post type.
     */
    public static function register() {
        $options = [
            'slug' => __('event', 'posty-starter-plugin'),
            'singular' => __('Event', 'posty-starter-plugin'),
            'plural' => __('Events', 'posty-starter-plugin'),
            'args' => [
                'menu_icon' => 'dashicons-calendar'
            ]
        ];

        parent::register_cpt(self::NAME, $options);
    }
}
```

This creates the `posty-event` post type. The `slug`, `singular` and `plural` options are mandatory, and the `args` option allows you to overwrite any option passed to [register_post_type](https://developer.wordpress.org/reference/functions/register_post_type/).

You can also add custom labels like so:

```php
$options = [
    'slug' => __('event', 'posty-starter-plugin'),
    'singular' => __('Event', 'posty-starter-plugin'),
    'plural' => __('Events', 'posty-starter-plugin'),
    'labels' => [
        'add_new' => __('Add a new event', 'posty-starter-plugin')
    ],
    'args' => [
        'menu_icon' => 'dashicons-calendar'
    ]
];
```

The nice thing about registering custom post types like this is that you can extend these classes with any kind of functionality related to the post type. For example, you might want the ability to get the latest three events. You could add it like this:

```php
/**
 * Get the latest events.
 *
 * @return WP_Post[]
 */
public static function latest() {
    return get_posts([
        'post_type' => self::NAME,
        'posts_per_page' => 3
    ]);
}
```

Then, in your code you can use this function to easily display the latest three events:

```php
use Posty_Starter_Plugin\Custom_Post_Types\Event;

$events = Event::latest();

foreach ($events as $event) {
    echo $event->post_title;
}
```

A similar method could be used to implement functionality related to a single event. For example, let's say you have a meta field `event_ticket_price` that contains the price of an event. You could add this code to your `Event` class to easily obtain this price:

```php
/**
 * Get the ticket price of an event.
 *
 * @param WP_Post|int $event
 * @return string
 */
public static function ticket_price($event = null) {
    $event = get_post($event);

    return get_post_meta($event->ID, 'event_ticket_price', true);
}
```

```php
use Posty_Starter_Plugin\Custom_Post_Types\Event;

$ticket_price = Event::ticket_price();

echo $ticket_price;
```

By adding `$event = get_post($event)`, the function defaults to the current event, but also allows you to get the price of a specific event by passing the post ID or a `WP_Post` object.

### Taxonomies

Taxonomies work almost exactly the same as [custom post types](#custom-post-types). One difference is that you can also pass the `object_type` option to link the taxonomy to a specific post type. See the `Event_Category` class for an example.

### Assets

The `Assets` class takes care of registering styles and scripts. The [@wordpress/scripts](https://developer.wordpress.org/block-editor/packages/packages-scripts/) package is used to automatically list the dependencies needed for each scripts.

The code in `editor/index.js` only runs in the Block Editor, and the code in `frontend/index.js` only runs on the frontend of the site. The same principles apply to `editor.css` and `frontend.css`

*Note: if you want to use Sass instead of CSS, install and add [sass-loader](https://github.com/webpack-contrib/sass-loader) to `webpack.config.js`.*

### Blocks

A big focus of the Posty Starter Plugin is making it as easy as possible to register blocks. All blocks can be found in the `src/js/editor/blocks` folder and are initialized in `src/js/editor/index.js`. To render a server-side block, add a template file with the same name as the block to the `templates/blocks` folder.

For more information on developing blocks, please refer to the [Block API Reference](https://developer.wordpress.org/block-editor/developers/block-api/).

### Helpers

In `helpers.php`, you can find a collection of custom helper functions as well as add your own.

#### `classes`

`classes` is similar to the very popular [classNames](https://github.com/JedWatson/classnames) package for JavaScript, and allows you to conditionally add classes to an HTML element. It's based on [classnames-php](https://github.com/cstro/classnames-php).

Use it like this:

```php
Posty_Starter_Plugin\classes('foo'); // 'foo'
Posty_Starter_Plugin\classes(['foo' => true]); // 'foo'
Posty_Starter_Plugin\classes('foo', ['bar' => false, 'baz' => true]); // 'foo baz'
Posty_Starter_Plugin\classes(['foo', 'bar' => true]) // 'foo bar'

// Falsy values get ignored
Posty_Starter_Plugin\classes('foo', null, 0, false, 1); // 'foo 1'
```

#### `get_template` and `get_template_var`

These two functions allow you to render template parts from the `templates` folder with custom parameters. To demonstrate how this works, here's an example. Let's say you have a template part, `templates/hello.php`, that looks like this:

```php
$name = 'Phil';

echo "Hello, my name is {$name}.";
```

This would output *Hello, my name is Phil*. To render this template part, you can use the `get_template` helper function:

```php
echo Posty_Starter_Plugin\get_template('hello');
```

However, you might also want to want to make the name dynamic. To allow this, `get_template` accepts an array of parameters:

```php
echo Posty_Starter_Plugin\get_template('hello', [
    'name' => 'Lindsay'
]);
```

To use the dynamic name, you'd change `templates/hello.php` to this:

```php
$name = Posty_Starter_Plugin\get_template_var('name');

echo "Hello, my name is {$name}.";
```

## License

[GPL 3.0](./LICENSE)
