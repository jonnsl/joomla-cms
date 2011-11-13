<?php
/**
 * @version		$Id$
 * @package		Joomla.Administrator
 * @subpackage	com_contact
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;

jimport('joomla.form.formfield');

/**
 *
 *
 * @package		Joomla.Administrator
 * @subpackage	com_contact
 * @since		1.6
 */
class JFormFieldLinks extends JFormField
{
	/**
	 * The form field type.
	 *
	 * @var	string
	 */
	protected $type = 'Links';

	/**
	 * Method to get the field input markup.
	 *
	 * @return	string
	 */
	protected function getInput()
	{
		$links = (array) $this->value;
		// Show at least one empty link
		if(empty($links)) $links = array(array('label'=>'','url'=>''));

		$labelLabel = JText::_('COM_CONTACT_FIELD_LINKS_LABEL_LABEL');
		$labelTip = $labelLabel.'::'.JText::_('COM_CONTACT_FIELD_LINKS_LABEL_DESC');

		$urlLabel = JText::_('COM_CONTACT_FIELD_LINKS_URL_LABEL');
		$urlTip = $urlLabel.'::'.JText::_('COM_CONTACT_FIELD_LINKS_URL_DESC');

		// Add Javascript
		JHtml::_('script', 'contacts/links.js', false, true);
		// Load the javascript language strings
		JText::script('COM_CONTACT_FIELD_LINKS_LEGEND');
		JText::script('COM_CONTACT_FIELD_LINKS_LABEL_LABEL');
		JText::script('COM_CONTACT_FIELD_LINKS_LABEL_DESC');
		JText::script('COM_CONTACT_FIELD_LINKS_URL_LABEL');
		JText::script('COM_CONTACT_FIELD_LINKS_URL_DESC');
		JText::script('COM_CONTACT_FIELD_LINKS_REMOVE_LINK');
		?>
		<script type="text/javascript">
			window.addEvent('domready', function() {
				new Links('<?php echo $this->name; ?>', document.id('links'), document.id('add-link'));
			});
		</script>
		<button type="button" id="add-link"><?php echo JText::_('COM_CONTACT_FIELD_LINKS_ADD_LINK'); ?></button>
		<div style="clear:both;"></div>
		<div id="links">
		<?php foreach ($links as $i => $link) : ?>
			<fieldset class="adminForm contact-link">
				<legend><?php echo JText::sprintf('COM_CONTACT_FIELD_LINKS_LEGEND', $i+1); ?></legend>
				<label for="label" class="hasTip" title="<?php echo $labelTip;?>" ><?php echo $labelLabel; ?></label>
				<input type="text" name="<?php echo $this->name.'['.$i.'][label]'; ?>" value="<?php echo $link['label']; ?>" />
				<label for="url" class="hasTip" title="<?php echo $urlTip;?>" ><?php echo $urlLabel; ?></label>
				<input type="text" name="<?php echo $this->name.'['.$i.'][url]'; ?>" value="<?php echo $link['url']; ?>" />
				<button type="button" class="remove-link"><?php echo JText::_('COM_CONTACT_FIELD_LINKS_REMOVE_LINK'); ?></button>
			</fieldset>
		<?php endforeach; ?>
		</div>

		<?php

		return '';
	}
}
