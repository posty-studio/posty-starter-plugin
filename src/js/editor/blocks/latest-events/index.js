/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { registerBlockType } from '@wordpress/blocks';

/**
 * Internal dependencies
 */
import edit from './edit';

export default () => {
    registerBlockType('posty-starter-plugin/latest-events', {
        title: __('Latest Events', 'posty-starter-plugin'),
        description: __('Shows the latest events', 'posty-starter-plugin'),
        icon: {
            src: 'calendar'
        },
        category: 'widgets',
        edit,
        save: () => {}
    });
};
