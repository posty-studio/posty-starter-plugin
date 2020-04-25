/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { withSelect } from '@wordpress/data';
import { Fragment } from '@wordpress/element';

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
            {events.map(event => (
                <h2>{event.title.rendered}</h2>
            ))}
        </div>
    );
});
