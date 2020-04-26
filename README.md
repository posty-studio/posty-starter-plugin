# Posty Starter Plugin

An opinionated starter plugin for WordPress.

## Installation

Clone or copy the contents of the repository, then run `npm install` or `yarn install` to get started.

There's a few placeholders that need to be replaced. Please note that these are case-sensitive. For example. if your plugin is named `lion-king-quote-generator`, you'd rename like this:

| Original                 | Replacement                   | Used For                         |
|--------------------------|-------------------------------|----------------------------------|
| posty-starter-plugin.php | lion-king-quote-generator.php | The base plugin file             |
| Posty_Starter_Plugin     | Lion_King_Quote_Generator     | PHP classes namespace            |
| posty-starter-plugin     | lion-king-quote-generator     | Textdomain and block name prefix |
| POSTY_STARTER_PLUGIN     | LION_KING_QUOTE_GENERATOR     | Constants                        |
| postyStarterTheme        | LionKingQuoteGenerator        | JavaScript l10n variable*        |

*\*This is the `$object_name` variable when [localizing a script](https://developer.wordpress.org/reference/functions/wp_localize_script/) in the `Assets` class.*

## Development

Run `npm run start` to start developing. Webpack will automatically process style and script changes.

## Build

Run `npm run build` to compile and minify all assets.