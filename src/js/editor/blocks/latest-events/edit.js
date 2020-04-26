/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { withSelect } from '@wordpress/data';
import { Fragment } from '@wordpress/element';

/**
 * Internal dependencies
 */
import ExampleSharedComponent from '@components/example-shared-component';

const applyWithSelect = withSelect(select => ({
    events: select('core').getEntityRecords('postType', 'posty-event', {
        per_page: 3
    })
}));

export default applyWithSelect(({ className, events }) => {
    if (!events) {
        return <Fragment />;
    }

    return (
        <div className={className}>
            <ExampleSharedComponent />
            {events.map(event => (
                <h2>{event.title.rendered}</h2>
            ))}
        </div>
    );
});
