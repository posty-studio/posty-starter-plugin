import { registerBlockStyle } from '@wordpress/blocks';
import '../../css/editor.scss';

registerBlockStyle( 'core/group', {
	name: 'fancy-quote',
	label: 'Fancy Quote',
} );
