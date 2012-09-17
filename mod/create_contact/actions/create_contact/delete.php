<?php
/**
 * Delete a contact
 *
 * @package contact
 */

$guid = get_input('guid');
$contact = get_entity($guid);

if (elgg_instanceof($contact, 'object', 'create_contact') && $contact->canEdit()) {
	$container = $contact->getContainerEntity();
	if ($contact->delete()) {
		system_message(elgg_echo("Contact Deleted"));
		if (elgg_instanceof($container, 'group')) {
			forward("create_contact/all");
		} else {
			forward("create_contact/all");
		}
	}
}

register_error(elgg_echo("Unable to Delete"));
forward(REFERER);
