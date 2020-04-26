/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { render } from '@wordpress/element';

/**
 * Internal dependencies
 */
import ExampleSharedComponent from '@components/example-shared-component';

console.log(__('This is the frontend.js', 'posty-starter-plugin'));
render(<ExampleSharedComponent />, document.body.querySelector('div'));
