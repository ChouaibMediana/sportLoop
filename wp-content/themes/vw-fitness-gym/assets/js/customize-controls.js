( function( api ) {

	// Extends our custom "vw-fitness-gym" section.
	api.sectionConstructor['vw-fitness-gym'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );