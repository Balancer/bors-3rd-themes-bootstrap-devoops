<?php

class bors_themes_devoops extends bors_themes_bootstrap3
{
	function render($object)
	{
		$object->set_attr('layout_class', 'bors_layouts_devoops');

		return bors_templaters_php::fetch(__DIR__.'/devoops.tpl.php', array_merge(array('self' => $object), $object->page_data()));
	}
}
