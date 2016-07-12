<?php

global $OUTPUT, $PAGE;

$html = '<a class="editing_notifications menu-action cm-edit-action" data-action="notifications" role="menuitem" href="'
	. htmlspecialchars(new moodle_url('/local/resourcenotif/resourcenotif.php', array('id' => '123XYZ321')))
	. '" title="' . htmlspecialchars(get_string("notifications")) . '">'
	. $OUTPUT->pix_icon('t/email', get_string("notifications"), 'moodle', array('class' => 'iconsmall', 'title' => ''))
	. '<span class="menu-action-text">' . htmlspecialchars(get_string("notifications")) . '</span>'
	. '</a>';
$enc = json_encode($html);

$PAGE->requires->js_init_code(<<<EOJS
var activities = document.querySelectorAll('.section-cm-edit-actions ul[role="menu"]');
if (activities) {
	for (var i = 0; i < activities.length; i++) {
		var ul = activities[i];
		var owner = ul.parentNode.getAttribute('data-owner');
		if (owner) {
			var id = owner.replace(/^#module-/);
			ul.insertAdjacentHTML('beforeend', $enc.replace('123XYZ321', id));
		}
	}
}
EOJS
, true);
