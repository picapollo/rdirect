<?php
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');
?>
{
	"old_progress": {
		"score": 0.85,
		"criteria": {
			"has_name": true,
			"has_room_type": true,
			"has_bedrooms": true,
			"description_at_least_200_chars": false,
			"has_nightly_price": true,
			"has_photos": true,
			"has_person_capacity": true
		}
	},
	"next_steps": {
		"description_at_least_200_chars": {
			"weight": 0.15,
			"url": "/rooms/179452/edit?fragment=multilingual_description_container",
			"description": "Write a description at least 200 letters long"
		}
	},
	"prompt": "Your listing is 85% of the way to being active.",
	"progress": {
		"score": 0.85,
		"criteria": {
			"has_name": true,
			"has_room_type": true,
			"has_bedrooms": true,
			"description_at_least_200_chars": false,
			"has_nightly_price": true,
			"has_photos": true,
			"has_person_capacity": true
		}
	},
	"result": "success",
	"available": false
}