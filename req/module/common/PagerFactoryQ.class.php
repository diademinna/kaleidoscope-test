<?php
if(!defined('MAX_PAGE')) define('MAX_PAGE', 5);
if(!defined('COUNT_PAGE')) define('COUNT_PAGE', 10);

// Аналог пейджера PagerFactory, только этот со знаками вопросов в URL  (/news/?page=1)
class PagerFactoryQ {
	private $data = array();
	private $conn = null;
	private $countRecords = null;
	var $countPage = COUNT_PAGE;
	static private $delimiter = '&nbsp;';
	private $block_back = "<"; // символ выводиться в блоке НАЗАД
	private $block_next = ">"; // символ выводиться в блоке ВПЕРЕД
	
	public function setCountPage($countPage) {
		$this->countPage = $countPage;
	}
	
	public function __construct() {
		if (!$this->conn) {
			require_once("db/DbFactory.class.php");
			$this->conn =& DbFactory::getConnection();
		}
	}
	public function getPagerString($page, $fullQuery = '', $fromWhereCnt = '', $href = '', $ajaxFunction='') {
		$page = $page > 1 ? $page : 1;
		$this->setCountRecords($this->countRecords($fromWhereCnt));
		if ($this->countRecords) {
			$countPages = ceil($this->countRecords / $this->countPage);
			if ($page > $countPages) {
				$page = $countPages;
			}
			$offset = $this->countPage * ($page - 1);
			$query = $this->conn->newStatement("{$fullQuery} LIMIT {$offset}, ".$this->countPage);
			$this->data = $query->getAllRecords();
			if ($this->countRecords < $this->countPage) {
				return false;
			}
		} else {
			return false;
		}
		return $this->getSPages($page, $href, $ajaxFunction);
	}
	public function getSPages($page, $href = '', $ajaxFunction='') {
		$countPages = ceil($this->countRecords/$this->countPage);
		$page = $page>1?$page:1;
		
		$linkPages = array();
		$flagFirst = false;
		$flagLast = false;
		$i = 1;
		$j = $countPages;
		if($page > MAX_PAGE) {
			$flagFirst = true;
			$i = $page - MAX_PAGE;
		}
		if(($countPages - $page) > MAX_PAGE) {
			$j = $page + MAX_PAGE;
			$flagLast = true;
		}
		$prev = $page - 1;
		if ($prev < 1) $prev = 1;
		$next = $page + 1;
		if ($next > $countPages) $next = $countPages;
		
		/* разбивка урл */
		$link = explode("?", $href, 2);
		$href = $link[0];
		if ($link[1]) {
			$params = explode('&', $link[1]);
			foreach ($params as $key=>$current_par) {
				if (strpos($current_par, "age=")) {
					unset($params[$key]);
				}
			}
			$link[1] = join("&", $params);
			$param = "&{$link[1]}";
		}
		/* разбивка урл */
		if ($page!=1) {
			if (!empty($href)) {
				$linkPages[0] = "<a class=\"back\" href=\"{$href}?page={$prev}{$param}\">{$this->block_back}</a>";
			} else {
				$ajaxFunctionMod = str_replace(":pageId:", $prev, $ajaxFunction);
				$linkPages[0] = "<a class=\"back\" onclick=\"{$ajaxFunctionMod}\">{$this->block_back}</a>";
			}
		}
		if($flagFirst) {
			if (!empty($href)) {
				$linkPages[1] = "<a href=\"{$href}?page=1{$param}\">1</a>";
			} else {
				$ajaxFunctionMod = str_replace(":pageId:", 1, $ajaxFunction);
				$linkPages[1] = "<a onclick=\"{$ajaxFunctionMod}\">1</a>";
			}
			$linkPages[2] = ' ... ';
		}
		for ($i; $i <= $j; $i++) {
			if (!empty($href)) {
				$linkPages[$i] = "<a href=\"{$href}?page={$i}{$param}\">{$i}</a>";
			} else {
				$ajaxFunctionMod = str_replace(":pageId:", $i, $ajaxFunction);
				$linkPages[$i] = "<a onclick=\"{$ajaxFunctionMod}\">{$i}</a>";
			}
//	пїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅ пїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅ пїЅпїЅпїЅпїЅпїЅпїЅ
			if ($i == $page) {
				if (!empty($href)) {
					$linkPages[$i] = "<div class=\"cur\">{$i}</div>";
				} else {
					$ajaxFunctionMod = str_replace(":pageId:", $i, $ajaxFunction);
					$linkPages[$i] = "<div class=\"cur\">{$i}</div>";
				}
			}
		}
		$ajaxFunctionMod = str_replace(":pageId:", $i, $ajaxFunction);
		if($flagLast) {
			$linkPages[$countPages-1] = ' ... ';
			if (!empty($href)) {
				$linkPages[$countPages] = "<a href=\"{$href}?page={$countPages}{$param}\">{$countPages}</a>";
			} else {
				$ajaxFunctionMod = str_replace(":pageId:", $countPages, $ajaxFunction);
				$linkPages[$countPages] = "<a onclick=\"{$ajaxFunctionMod}\">{$countPages}</a>";
			}
		}
		if ($page != $countPages) {
			if (!empty($href)) {
				$linkPages []= "<a class=\"next\" href=\"{$href}?page={$next}{$param}\">{$this->block_next}</a>";
			} else {
				$ajaxFunctionMod = str_replace(":pageId:",$next, $ajaxFunction);
				$linkPages []= "<a class=\"next\" onclick=\"{$ajaxFunctionMod}\">{$this->block_next}</a>";
			}
		}
		if (count($linkPages) > 1) {
			$stringLinks = implode(self::$delimiter, $linkPages);
		} else {
			$stringLinks = '';
		}
		return $stringLinks;
	}
	private function countRecords($fromWhere = '') {
		$sql = "SELECT COUNT(id) FROM ".$fromWhere;
		$query = $this->conn->newStatement($sql);
		return $query->getOneValue();
	}
	public function getPageData() {
		return $this->data;
	}
	public function getCountRecords() {
		return $this->countRecords;
	}
	public function setCountRecords($countRecords) {
		$this->countRecords = $countRecords;
	}
	public function setDelimiter($delimiter) {
		$this->delimiter = $delimiter;
	}
}