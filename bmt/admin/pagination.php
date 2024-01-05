<?php
/**
 * @author 		Mohsen Movahed <l3iidak@yahoo.com>
 * @copyright	2014 Mohsen Movahed
 * @date		19 May 2014 - 1393/2/28
 * @version		1.0
 * @license		GPL
 * @link        http://www.bidakplus.ir
 */
class Pagination
{
	private $items;
	private $output;

	/**
	 * construct method
	 */
	public function __construct($params = null)
	{
		$this->items = array(
				'items_per_page' => 10,         // Records per page to display
				'total_records' => 0,          // Total records in database
				'total_pages' => 0,            // Total number of pages
				'url_address' => '',           // For example: http://www.mysite.com/?page=
				'concat_to_url' => '',         // This comes after page value - [optional]
				'current_page' => 1,           // Number of current page
				'page_num_per_section' => 10,   // Total number of pages to display - for example CurrentPage=16 :=> [first][next]...,14,15,[16],17,18,...[prev][last]  
				'mode' => false,               // Mode = true or anything => Display::  1,...,14,15,[16],17,18,...,20
		);

		// set values
		if (isset($params) && count($params) > 0)
		{
			if (is_array($params))
			{
				foreach ($params as $key => $value)
				{
					if (!empty($value))
					{
						$this->$key = $value;
					}
				}
			}
		}

		// run paginate method
		$this->paginate();
	}

	/**
	 * get values
	 * @param  string $key Must be index of items array
	 * @return mixed|boolean if there is $key, returns array value otherwise returns false. 
	 */
	public function __get($key)
	{
		if (isset($this->items[$key]))
		{
			return $this->items[$key];
		}
		return false;
	}

	/**
	 * set values
	 * @param string $key Index of items array
	 * @param mixed $value a value for set
	 */
	public function __set($key, $value)
	{
		if (isset($this->items[$key]))
		{
			$this->items[$key] = $value;
		}
	}

	/**
	 * get total pages
	 * @return integer Return the total pages
	 */
	private function getTotalPages()
	{
		$this->items_per_page = ($this->items_per_page <= 0 ? 1 : $this->items_per_page);

		$total = ceil($this->total_records / $this->items_per_page);
		if ($total <= 0)
		{
			$total = abs($total) + 1;
		}
		return $total;
	}

	/**
	 * this manages to display pagination
	 */
	private function paginate()
	{
		$this->total_pages = $this->getTotalPages(); // set total pages
		$check = $this->checkItems(); // check item values and page number 

		if ($check)
		{
			// start of section
			$start = $this->current_page - floor($this->page_num_per_section / 2);
			// maximum start
			$max = $this->total_pages - floor($this->page_num_per_section / 2);
			if($start <= 0 || $start > $max)
			{
				if ($start > $max)
					$this->current_page = 1;
				$start = 1;
			}

			// end of section
			$end = $start + $this->page_num_per_section - 1;
			if($end > $this->total_pages)
			{
				$end = $this->total_pages;
			}


			$this->output .= '<ul class="paging">' . PHP_EOL;

			// print first page button
			if ($this->mode == false && $this->current_page != 1)
			{
				$this->output .= '<li><a href="'. $this->url_address . 1 . $this->concat_to_url .'">نخست</a></li>' . PHP_EOL;
			}

			// print next page button
			if ($this->current_page < $this->total_pages && $this->mode == false)
			{
				$this->output .= '<li><a href="'. $this->url_address . $this->nextPage() . $this->concat_to_url .'">بعدی</a></li>' . PHP_EOL;
			}

			// print page number
			for ($i = $start; $i <= $end ; $i++)
			{
				// print dots in right
				if ($i == $start && $start > 1 && $i != 1)
				{
					// print page one
					if ($this->mode)
					{
						$this->output .= '<li><a href="'. $this->url_address . 1 . $this->concat_to_url .'">1</a></li>' . PHP_EOL;
					}
					$this->output .= '<li class="dot-paginator">...</li>' . PHP_EOL;
				}

				// print pages number
				$this->output .= '<li><a class="'. ($i == $this->current_page ? 'current-page' : '') .'" href="'. $this->url_address . $i .'">'. $i .'</a></li>' . PHP_EOL;
				
				// print dots in left
				if ($i <= $this->total_pages && $i == $end && $i != $this->total_pages)
				{
					$this->output .= '<li class="dot-paginator">...</li>' . PHP_EOL;
				}
			}

			// print prev page button
			if ($this->current_page > 1 && $this->mode == false)
			{
				$this->output .= '<li><a href="'. $this->url_address . $this->prevPage() . $this->concat_to_url .'">قبلی</a></li>' . PHP_EOL;
			}

			// print last page number
			if ($this->mode && $this->total_pages != $this->current_page && $this->total_pages != $end)
			{	
				$this->output .= '<li><a href="'. $this->url_address . $this->total_pages . $this->concat_to_url .'">'. $this->total_pages .'</a></li>' . PHP_EOL;
			}

			// print last page button
			if ($this->mode == false && $this->current_page != $this->total_pages)
			{
				$this->output .= '<li><a href="'. $this->url_address . $this->total_pages . $this->concat_to_url .'">آخرین</a></li>' . PHP_EOL;
			}
			
			$this->output .= '</ul><br>' . PHP_EOL;
		}
	}

	/**
	 * check item values
	 * @return boolean The result true if item values is not empty, false otherwise
	 */
	private function checkItems()
	{
		foreach ($this->items as $key => $value)
		{
			if (empty($value))
			{
				settype($key, 'string');
				switch ($key)
				{
					case 'current_page':
						$this->$key = 1; // not required beacause by default equal to 1
						break;
					case 'concat_to_url':
						break;
					case 'mode':
						break;
					default:
						return false;
						break;
				}
			}
		}

		if ($this->total_pages == 1)
		{
			return false;
		}

		$this->checkPageNumber();
		return true;
	}

	/**
	 * check page number
	 */
	private function checkPageNumber()
	{
		$this->current_page = intval($this->current_page);
		if ($this->current_page > $this->total_pages)
		{
			$this->current_page = $this->total_pages;
		}
		elseif ($this->current_page <= 0)
		{
			$abs = abs($this->current_page);
			$this->current_page = ($this->current_page < 0 ? $abs : $abs + 1);
		}
	}

	/**
	 * previous page
	 * @return integer
	 */
	private function prevPage()
	{
		return $this->current_page - 1;
	}

	/**
	 * next page
	 * @return integer
	 */
	private function nextPage()
	{
		return $this->current_page + 1;
	}

	/**
	 * show part of the records => for example: 1 - 10 of 200
	 */
	public function recordsInfo()
	{
		$sectionEnd = $this->current_page * $this->items_per_page;
		$sectionStart = $sectionEnd - $this->items_per_page + 1;
		//echo 'Results ' . $sectionStart . ' - ' . $sectionEnd . ' of ' . $this->total_records;
		echo $this->total_records;
	}

	/**
	 * show current page of all pages
	 */
	public function pagesInfo()
	{
		//echo 'Page ' . $this->current_page . ' of ' . $this->total_pages;
		echo $this->total_pages;
	}

	/**
	 * get query limit
	 * @return array Return start and end section for query limit
	 */
	public function limit()
	{
		$start = $this->items_per_page * ($this->current_page - 1);
		$limit = $this->items_per_page;
		return array('start' => $start, 'limit' => $limit);
	}

	/**
	 * show paging
	 */
	public function display()
	{
		echo $this->output;
	}
}





/*
Default style ::
.paging
{
	margin: 65px auto;
	padding: 0;
	list-style: none;
}

.paging li
{
	float: right;
	margin-right: 10px;
}

.paging li a
{
	display: block;
	text-decoration: none;
	color: #717171;
	font-family: tahoma;
	font-size: 9pt;
	text-shadow: 0px 1px white;
	padding: 5px 8px;

	-webkit-border-radius: 3px;
	-moz-border-radius: 3px;
	border-radius: 3px;

	-webkit-box-shadow: 0px 1px 3px 0px rgba(0,0,0,0.35);
	-moz-box-shadow: 0px 1px 3px 0px rgba(0,0,0,0.35);
	box-shadow: 0px 1px 3px 0px rgba(0,0,0,0.35);
	background-color: #e5e5e5;

	background: -webkit-linear-gradient(top, #e5e5e5 0%, #e8e8e8 100%);
	background: -moz-linear-gradient(top, #e5e5e5 0%, #e8e8e8 100%);
	background: -o-linear-gradient(top, #e5e5e5 0%, #e8e8e8 100%);
	background: -ms-linear-gradient(top, #e5e5e5 0%, #e8e8e8 100%);
	background: linear-gradient(top, #e5e5e5 0%, #e8e8e8 100%);
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#e5e5e5', endColorstr='#e8e8e8',GradientType=0 );
}

.paging li a.current-page
{
	color: white;
	text-shadow: 0px 1px #3f789f;

	-webkit-box-shadow: 0px 1px 2px 0px rgba(0,0,0,0.8);
	-moz-box-shadow: 0px 1px 2px 0px rgba(0,0,0,0.8);
	box-shadow: 0px 1px 2px 0px rgba(0,0,0,0.8);
	background: #7cb9e5;

	background: -webkit-linear-gradient(top, #7cb9e5 0%, #57a1d8 100%);
	background: -moz-linear-gradient(top, #7cb9e5 0%, #57a1d8 100%);
	background: -o-linear-gradient(top, #7cb9e5 0%, #57a1d8 100%);
	background: -ms-linear-gradient(top, #7cb9e5 0%, #57a1d8 100%);
	background: linear-gradient(top, #7cb9e5 0%, #57a1d8 100%);
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#7cb9e5', endColorstr='#57a1d8',GradientType=0 );
}

.paging li a:hover
{
	-webkit-box-shadow: 0px 1px 3px 0px rgba(0,0,0,0.55);
	-moz-box-shadow: 0px 1px 3px 0px rgba(0,0,0,0.55);
	box-shadow: 0px 1px 3px 0px rgba(0,0,0,0.55);
	background: #fff;

	background: -webkit-linear-gradient(top, #fff 0%, #e8e8e8 100%);
	background: -moz-linear-gradient(top, #fff 0%, #e8e8e8 100%);
	background: -o-linear-gradient(top, #fff 0%, #e8e8e8 100%);
	background: -ms-linear-gradient(top, #fff 0%, #e8e8e8 100%);
	background: linear-gradient(top, #fff 0%, #e8e8e8 100%);
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fff', endColorstr='#e8e8e8',GradientType=0 );
}

.paging li a:active, .paging li a.current-page:active
{
	-webkit-box-shadow: inset 0px 1px 3px 0px rgba(0,0,0,0.5), 0px 1px 1px 0px rgba(255,255,255,1) !important;
	-moz-box-shadow: inset 0px 1px 3px 0px rgba(0,0,0,0.5), 0px 1px 1px 0px rgba(255,255,255,1) !important;
	box-shadow: inset 0px 1px 3px 0px rgba(0,0,0,0.5), 0px 1px 1px 0px rgba(255,255,255,1) !important;
}

.paging li a.current-page:hover
{
	-webkit-box-shadow: 0px 1px 2px 0px rgba(0,0,0,0.9);
	-moz-box-shadow: 0px 1px 2px 0px rgba(0,0,0,0.9);
	box-shadow: 0px 1px 2px 0px rgba(0,0,0,0.9);
	background: #99cefc;

	background: -webkit-linear-gradient(top, #99cefc 0%, #57a1d8 100%);
	background: -moz-linear-gradient(top, #99cefc 0%, #57a1d8 100%);
	background: -o-linear-gradient(top, #99cefc 0%, #57a1d8 100%);
	background: -ms-linear-gradient(top, #99cefc 0%, #57a1d8 100%);
	background: linear-gradient(top, #99cefc 0%, #57a1d8 100%);
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#99cefc', endColorstr='#57a1d8',GradientType=0 );
}
 */




/*
*************************
*         USAGE         *
*************************
For Example:


mysql_connect('localhost', 'root', '');
mysql_select_db('pagination');
mysql_query('set names \'utf8\'');
$total = mysql_query('select count(*) as `total` from posts');
$result = mysql_fetch_assoc($total);

***********************************************************************************
*       $paging = new Pagination(                                                 *
*       	array(                                                                *
*       		'items_per_page' => 5,   // Records per page to display           *
*       		'total_records' => $result['total'],                              *
*       		'url_address' => 'http://mysite.com/?page=',                      *
*       		'current_page' => (isset($_GET['page']) ? $_GET['page'] : 1),     *
*       		)                                                                 *
*       	);                                                                    *
***********************************************************************************

$section = $paging->limit();
 
$start = $section['start'];
$limit = $section['limit'];

$result = mysql_query("select * from posts LIMIT $start, $limit");
while($row = mysql_fetch_assoc($result))
{
	echo '<strong>' . $row['title'] . '</strong><hr>';
}

$paging->display();
//------------------------//
$paging->recordsInfo();
//------------------------//
$paging->pagesInfo();

 */