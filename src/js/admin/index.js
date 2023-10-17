import { registerBlockStyle } from '@wordpress/blocks';
import latestEvents from './blocks/latest-events';

latestEvents();

registerBlockStyle('core/group', {
    name: 'fancy-quote',
    label: 'Fancy Quote',
});
