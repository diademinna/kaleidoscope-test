<?php
require_once("db/DbFactory.class.php");

if(!defined('COUNT_PAGE')) define('COUNT_PAGE', 10);
if(!defined('SEPARATOR')) define('SEPARATOR', "&nbsp;");

/*
	----------ПРИМЕР---------
	$pager = new PagerFactory();
	$page = $this->request->getValue ('page');
	if(!$page){
		$page=1;
	}
	$sql = "SELECT * FROM news WHERE active=1 ORDER BY date DESC, id DESC";
	$fromWhereCnt = "news WHERE active=1";
	$href = "/news/page/";
	$pagerString = $pager->getPagerString($page, $sql, $fromWhereCnt, $href);
	$data = $pager->getPageData();
 */

class PagerFactory {
	
	private $block_back = "<"; // символ выводиться в блоке НАЗАД
	private $block_next = ">"; // символ выводиться в блоке ВПЕРЕД

	private $data = null;
	private $conn = null;
	private $countRecords = null;
	static private $delimiter = SEPARATOR;
	
	public function __construct(){
		if (!$this->conn){
			$this->conn =& DbFactory::getConnection();
		}
	}

	/**
	 *
	 * @param int $page		- номер страницы
	 * @param $fullQuery	- запрос
	 * @param $fromWhereCnt - запрос для подсчета кол-ва страниц
	 * @param $href			- URL
	 * @param string $ajaxFunction - ????
	 */	
	public function getPagerString($page, $fullQuery = '', $fromWhereCnt = '', $href = '', $ajaxFunction='') {
		if (!$page) {
			$page = 1;
		}

		$this->countRecords = $this->countRecords($fromWhereCnt);

		if ($this->countRecords) {
			$countPages = ceil($this->countRecords / COUNT_PAGE);
			
			if ($page > $countPages) {
				$page = $countPages;
			}
			$offset = COUNT_PAGE * ($page - 1);
			
			$query = $this->conn->newStatement("{$fullQuery} LIMIT {$offset}, ".COUNT_PAGE);
//			$data = $query->getAllRecords();
			$this->data = $query->getAllRecords();
			
			if ($this->countRecords < COUNT_PAGE) {
				return false;
			}
		} 
		else {
			return false;
		}
	
		//
		$linkPages = array();

		//
		$flagFirst = false;
		$flagLast = false;
		$i = 1;
		$j = $countPages;
		if($page > 5){
			$flagFirst = true;
			$i = $page - 5;
		}
		if(($countPages - $page) > 5){
			$j = $page + 5;
			$flagLast = true;
		}

		$prev = $page - 1;
		if ($prev < 1) {
			$prev = 1;
		}
		$next = $page + 1;
		if ($next > $countPages) {
			$next = $countPages;
		}

		/* разбивка урл */
		$link = explode("#", $href, 2);
		$href = $link[0];
		if ($link[1]) $ancor = "#{$link[1]}";

		$link = explode("?", $href, 2);
		$href = $link[0];
		if ($link[1]) $param = "?{$link[1]}";
		/* разбивка урл */

		if ($page!=1) {
			if (!empty($href)) {
				$linkPages[0] = "<a id=\"leftPage\" class=\"back\" href=\"{$href}{$prev}/{$param}{$ancor}\">{$this->block_back}</a>";
			}
			else {
				$ajaxFunctionMod = ereg_replace(":pageId:", "{$prev}", $ajaxFunction);
				$linkPages[0] = "<a id=\"leftPage\" class=\"back\" onclick=\"{$ajaxFunctionMod}\">{$this->block_back}</a>";
			}
		}
		if($flagFirst){
			if (!empty($href)) {
				$linkPages[1] = "<a href=\"{$href}1/{$param}{$ancor}\">1</a>";
			} 
			else {
				$ajaxFunctionMod = ereg_replace(":pageId:", "1", $ajaxFunction);
				$linkPages[1] = "<a onclick=\"{$ajaxFunctionMod}\">1</a>";
			}
			$linkPages[2] = ' ... ';
		}
		for ($i; $i <= $j; $i++) {
			if (!empty($href)) {
				$linkPages[$i] = "<a href=\"{$href}{$i}/{$param}{$ancor}\">{$i}</a>";
			} else {
				$ajaxFunctionMod = ereg_replace(":pageId:", "{$i}", $ajaxFunction);
				$linkPages[$i] = "<a onclick=\"{$ajaxFunctionMod}\">{$i}</a>";
			}
			//	
			if ($i == $page) {
				if (!empty($href)) {
					$linkPages[$i] = "<div class=\"cur\">{$i}</div>";
				} else {
					$ajaxFunctionMod = ereg_replace(":pageId:", "{$i}", $ajaxFunction);
					$linkPages[$i] = "<div class=\"cur\">{$i}</div>";
				}
			}
		}
		$ajaxFunctionMod = ereg_replace(":pageId:", "{$i}", $ajaxFunction);
		if($flagLast){
			$linkPages[$countPages-1] = ' ... ';
			if (!empty($href)) {
				$linkPages[$countPages] = "<a href=\"{$href}{$countPages}/{$param}{$ancor}\">{$countPages}</a>";
			} else {
				$ajaxFunctionMod = ereg_replace(":pageId:", "{$countPages}", $ajaxFunction);
				$linkPages[$countPages] = "<a onclick=\"{$ajaxFunctionMod}\">{$countPages}</a>";
			}
		}
		if ($page != $countPages) {
			if (!empty($href)) {
				$linkPages []= "<a id=\"rightPage\" class=\"next\" href=\"{$href}{$next}/{$param}{$ancor}\">{$this->block_next}</a>";
			} else {
				$ajaxFunctionMod = ereg_replace(":pageId:", "{$next}", $ajaxFunction);
				$linkPages []= "<a id=\"rightPage\" class=\"next\" onclick=\"{$ajaxFunctionMod}\">{$this->block_next}</a>";
			}
		}
		if (count($linkPages) > 1) {
			$stringLinks = implode(self::$delimiter, $linkPages);
		}
		else {
			$stringLinks = '';
		}
		return $stringLinks;
	}

	/**
	 * countRecords
	 *
	 * @param ActiveRecord $model
	 * @param string $where
	 * @return int
	 */
	private function countRecords($fromWhere = '') {
		$sql = "SELECT COUNT(id) AS `cnt` FROM ".$fromWhere;
		$query = $this->conn->newStatement($sql);
		$records = $query->getFirstRecord();
		return $records['cnt'];
	}
	
	public function getPageData() {
		if ($this->data) {
			return $this->data;
		}
		return array();
	}

	public function getCountRecords() {
		return $this->countRecords;
	}
	
	/**
	 * @param string $delimiter - 
	 */
	public function setDelimiter($delimiter) {
		$this->delimiter = $delimiter;
	}
}
?>