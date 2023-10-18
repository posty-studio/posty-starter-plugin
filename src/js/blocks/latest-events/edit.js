import { useSelect } from '@wordpress/data';
import { useBlockProps } from '@wordpress/block-editor';

const Edit = () => {
	const events = useSelect( ( select ) => {
		return select( 'core' ).getEntityRecords( 'postType', 'posty-event', {
			per_page: 3,
		} );
	} );

	return (
		<div { ...useBlockProps() }>
			{ ! events && 'Loading...' }
			{ events &&
				events.map( ( event ) => (
					<h2 key={ event.id }>{ event.title.rendered }</h2>
				) ) }
		</div>
	);
};

export default Edit;
