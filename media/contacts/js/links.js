var Links = new Class({
	n: 0,

	fieldName: '',
	
	container: '',
	
	addLinkButton: 'add-link',

	initialize: function(fieldName, container, addLinkButton) {
		this.fieldName = fieldName;
		if(container) this.container = container;
		this.n = $$('.contact-link').length;
		
		// Add event to the "Add Link" button
		addLinkButton.addEvent('click', this.addLink.bind(this));
		this.addLinkButton = addLinkButton;
		
		// FIX for the panel
		addLinkButton.getParent('div').setStyle('height', '100%');
		
		// Add event to any "Remove Link" button that already exists
		var cls = this;
		$$('.remove-link').each(function(e){
			e.addEvent('click', cls.removeLink.bind(cls, e));
		});
	},

	addLink: function() {
		// Create the link container
		var fieldset = new Element('fieldset', {'class': 'contact-link'});
		new Element('legend', {html:(Joomla.JText._('COM_CONTACT_FIELD_LINKS_LEGEND')).replace('%s', this.n + 1)}).inject(fieldset);

		// Create the label and the input for the label
		var input = new Element('input', {
				type: 'text',
				'name': this.fieldName+'['+this.n+'][label]'
			});
		var label = new Element('label', {
			'for': input.name,
			html: Joomla.JText._('COM_CONTACT_FIELD_LINKS_LABEL_LABEL'),
			title: Joomla.JText._('COM_CONTACT_FIELD_LINKS_LABEL_LABEL')+'::'+Joomla.JText._('COM_CONTACT_FIELD_LINKS_LABEL_DESC'),
			'class': 'hasTip'
			}).inject(fieldset);
		input.inject(fieldset);

		// Create the label and the input for the url
		var input = new Element('input', {
				type: 'url',
				'name': this.fieldName+'['+this.n+'][url]'
			});
		var label = new Element('label', {
			'for': input.name,
			html: Joomla.JText._('COM_CONTACT_FIELD_LINKS_URL_LABEL'),
			title: Joomla.JText._('COM_CONTACT_FIELD_LINKS_URL_LABEL')+'::'+Joomla.JText._('COM_CONTACT_FIELD_LINKS_URL_DESC'),
			'class': 'hasTip'
			}).inject(fieldset);
		input.inject(fieldset);

		// Create the "Remove Link" button
		var button = new Element('button', {
			type: 'button',
			html: Joomla.JText._('COM_CONTACT_FIELD_LINKS_REMOVE_LINK'),
			'class': 'remove-link'
		});
		button.addEvent('click', this.removeLink.bind(this, button));
		button.inject(fieldset);
		fieldset.inject(this.container);

		// Update the number for the next link
		this.n++;
	},

	removeLink: function(button) {
		// fade and destroy
		button.getParent('fieldset').nix({duration: 250, onChainComplete: function(){this.updateNumbers();}.bind(this)}, true);
		// update the number
		this.n--;
	},
	
	updateNumbers: function() {
		var n = 1;
		$$('.contact-link').each(function(e, k) {
			var legend = e.getChildren('legend')[0];
			var text = Joomla.JText._('COM_CONTACT_FIELD_LINKS_LEGEND').replace('%s', n);
			n++;
			legend.set('html', text);
		});
	}
});