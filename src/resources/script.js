document.addEventListener('DOMContentLoaded', function () {
	const queryElement = document.getElementById('address-query'),
		resultElement = document.getElementById('address-result');

	// Create an autocomplete instance.
	const autocomplete = new PostcodeNl.AutocompleteAddress(queryElement, {
		autocompleteUrl: '/actions/address-validation/postcode-eu/autocomplete?context=',
		addressDetailsUrl: '/actions/address-validation/postcode-eu/address?address=',
	});

    // TODO: switch based on country select field
    autocomplete.setCountry('nld');

	// The getSuggestions() method needs some modification to use GET parameters.
	// Fortunately, it is easy to overwrite autocomplete methods.
	autocomplete.getSuggestions = function (context, term, response)
	{
		let url = this.options.autocompleteUrl + encodeURIComponent(context) + '&term=' + encodeURIComponent(term);
		return autocomplete.xhrGet(url, response);
	}

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