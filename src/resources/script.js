document.addEventListener('DOMContentLoaded', function () {
	const queryElement = document.getElementById('address-query'),
		resultElement = document.getElementById('address-result');

	// Create an autocomplete instance.
	const autocomplete = new PostcodeNl.AutocompleteAddress(queryElement, {
		autocompleteUrl: '/postcode-eu/autocomplete',
		addressDetailsUrl: '/postcode-eu/address',
	});

    // TODO: switch based on country select field
    autocomplete.setCountry('nld');


	// Add an event handler to show the selected address.
	queryElement.addEventListener('autocomplete-select', function (e) {
		if (e.detail.precision === 'Address')
		{
			autocomplete.getDetails(e.detail.context, function (result) {
				resultElement.innerHTML = result.mailLines.join('<br>');
			});
		}
	});

    // TODO: add postcode event handler
});