<?php
namespace itemsviewer;

class core_itemfunctions
{
	function get_item_by_name($item_name)
	{
		$item = Itv_Item::where('itv_item_name', '=', $item_name);
		return $item;
	}


}

?>