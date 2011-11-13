<?php
/**
 * @version		$Id$
 * @package		Joomla.Site
 * @subpackage	com_contact
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

if ('plain' == $this->params->get('presentation_style')) :
	echo '<h3>'.JText::_('COM_CONTACT_LINKS').'</h3>';
else :
    echo JHtml::_($this->params->get('presentation_style').'.panel', JText::_('COM_CONTACT_LINKS'), 'display-links');
endif;
?>

<div class="contact-links">
	<ul>
		<?php foreach($this->contact->links as $i => $link): ?>
			<li class="contact-link-<?php echo $i + 1; ?>">
				<a href="<?php echo $this->escape($link->url); ?>">
					<?php echo ($link->label ? $this->escape($link->label) : $this->escape($link->url)); ?>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
</div>
