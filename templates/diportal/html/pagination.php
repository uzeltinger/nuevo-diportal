<?php

/**

 * @package     Joomla.Site

 * @subpackage  Templates.protostar

 *

 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.

 * @license     GNU General Public License version 2 or later; see LICENSE.txt

 */



defined('_JEXEC') or die;



/**

 * This is a file to add template specific chrome to pagination rendering.

 *

 * pagination_list_footer

 * 	Input variable $list is an array with offsets:

 * 		$list[limit]		: int

 * 		$list[limitstart]	: int

 * 		$list[total]		: int

 * 		$list[limitfield]	: string

 * 		$list[pagescounter]	: string

 * 		$list[pageslinks]	: string

 *

 * pagination_list_render

 * 	Input variable $list is an array with offsets:

 * 		$list[all]

 * 			[data]		: string

 * 			[active]	: boolean

 * 		$list[start]

 * 			[data]		: string

 * 			[active]	: boolean

 * 		$list[previous]

 * 			[data]		: string

 * 			[active]	: boolean

 * 		$list[next]

 * 			[data]		: string

 * 			[active]	: boolean

 * 		$list[end]

 * 			[data]		: string

 * 			[active]	: boolean

 * 		$list[pages]

 * 			[{PAGE}][data]		: string

 * 			[{PAGE}][active]	: boolean

 *

 * pagination_item_active

 * 	Input variable $item is an object with fields:

 * 		$item->base	: integer

 * 		$item->link	: string

 * 		$item->text	: string

 *

 * pagination_item_inactive

 * 	Input variable $item is an object with fields:

 * 		$item->base	: integer

 * 		$item->link	: string

 * 		$item->text	: string

 *

 * This gives template designers ultimate control over how pagination is rendered.

 *

 * NOTE: If you override pagination_item_active OR pagination_item_inactive you MUST override them both

 */



/**

 * Renders the pagination footer

 *

 * @param   array   $list  Array containing pagination footer

 *

 * @return  string         HTML markup for the full pagination footer

 *

 * @since   3.0

 */

function pagination_list_footer($list)

{

	$html = "<div class=\"pagination\">\n";

	$html .= $list['pageslinks'];

	$html .= "\n<input type=\"hidden\" name=\"" . $list['prefix'] . "limitstart\" value=\"" . $list['limitstart'] . "\" />";

	$html .= "\n</div>";



	return $html;

}



/**

 * Renders the pagination list

 *

 * @param   array   $list  Array containing pagination information

 *

 * @return  string         HTML markup for the full pagination object

 *

 * @since   3.0

 */

function pagination_list_render($list)

{

			// Reverse output rendering for right-to-left display.

		$html = '<ul class="pagination">';

		$html .= '<li class="pagination-start page-link">' . $list['start']['data'] . '</li>';

		$html .= '<li class="pagination-prev page-link">' . $list['previous']['data'] . '</li>';



		foreach ($list['pages'] as $page)

		{
//print_r($list);
			$html .= '<li class="page-link'.($page["active"]==1?"":" active").'">' . $page['data'] . '</li>';

		}
//'.($page["active"]==1?" active":"").'


		$html .= '<li class="pagination-next page-link">' . $list['next']['data'] . '</li>';

		$html .= '<li class="pagination-end page-link">' . $list['end']['data'] . '</li>';

		$html .= '</ul>';



		return $html;

}



/**

 * Renders an active item in the pagination block

 *

 * @param   JPaginationObject  $item  The current pagination object

 *

 * @return  string                    HTML markup for active item

 *

 * @since   3.0

 */





/**

 * Renders an inactive item in the pagination block

 *

 * @param   JPaginationObject  $item  The current pagination object

 *

 * @return  string  HTML markup for inactive item

 *

 * @since   3.0

 */

function pagination_item_inactive(&$item)

{

	// Check for "Start" item

	if ($item->text == JText::_('JLIB_HTML_START'))

	{

		return '<li class="disabled"><a><span class="icon-first"></span></a></li>';

	}



	// Check for "Prev" item

	if ($item->text == JText::_('JPREV'))

	{

		return '<li class="disabled"><a><span class="icon-previous"></span></a></li>';

	}



	// Check for "Next" item

	if ($item->text == JText::_('JNEXT'))

	{

		return '<li class="disabled"><a><span class="icon-next"></span></a></li>';

	}



	// Check for "End" item

	if ($item->text == JText::_('JLIB_HTML_END'))

	{

		return '<li class="disabled"><a><span class="icon-last"></span></a></li>';

	}



	// Check if the item is the active page

	if (isset($item->active) && ($item->active))

	{

		return '<li class="active hidden-phone"><a>' . $item->text . '</a></li>';

	}



	// Doesn't match any other condition, render a normal item

	return '<li class="disabled hidden-phone"><a>' . $item->text . '</a></li>';

}

