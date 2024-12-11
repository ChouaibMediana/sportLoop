( function( api ) {

	// Extends our custom "physique" section.
	api.sectionConstructor['physique'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );