<?php
if(!defined('COUNT_PAGE')) define('COUNT_PAGE', 10);
if(!defined('SEPARATOR')) define('SEPARATOR', "&nbsp;");
//require_once("util/SqlQueryCache.class.php");
/**
 * class Pager
 * @name Pager
 * @example $pager = new Pager();
 * 					$stringLinks = $pager->getPagerString($page_id, $model, $filter);
 * 					$PageData = $pager->getPageData();
 */

class Pager {

	private $data = null;

	static private $delimiter = SEPARATOR;

	private $countRecords = null;

	/**
	 * model
	 *
	 * @var ActiveRecord
	 */
	private $model = null;

	/**
	 *
	 * @param int $page					-	пїЅпїЅпїЅпїЅпїЅ пїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅ пїЅпїЅпїЅпїЅпїЅпїЅ пїЅпїЅпїЅпїЅпїЅпїЅ
	 * @param ActiveRecord $model 		- пїЅпїЅпїЅ пїЅпїЅпїЅпїЅпїЅпїЅпїЅ
	 * @param string $filter 		- пїЅпїЅпїЅпїЅпїЅпїЅпїЅ пїЅпїЅпїЅпїЅпїЅпїЅпїЅ пїЅпїЅпїЅпїЅпїЅпїЅпїЅ (WHERE)
	 * @param int $start	  		- пїЅпїЅпїЅпїЅпїЅ пїЅпїЅпїЅпїЅпїЅпїЅ пїЅ пїЅпїЅпїЅпїЅпїЅпїЅпїЅ пїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅ пїЅпїЅпїЅпїЅпїЅпїЅ
	 * @param $orderBy					- пїЅпїЅпїЅпїЅ, пїЅпїЅпїЅпїЅ пїЅпїЅпїЅ пїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅ
	 * @param $href							-	пїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅ пїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅ пїЅ пїЅпїЅпїЅпїЅпїЅпїЅ
	 * @param string $ajaxFunction
	 */
	public function getPagerString($pageNumber, $model, $filter = '', $orderBy = '', $href = '', $ajaxFunction='', $fullQuery = '') {
		if ($pageNumber) {
			$page = $pageNumber;
		} else {
			$page = 1;
		}

		//	пїЅпїЅпїЅпїЅпїЅ пїЅ пїЅпїЅпїЅпїЅпїЅпїЅпїЅ пїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅ пїЅпїЅпїЅпїЅпїЅпїЅ
//		$offset = COUNT_PAGE * ($page - 1);

		$this->model = $model;

		$this->countRecords = $this->countRecords($model, $filter);

		if ($this->countRecords) {
			$countPages = ceil($this->countRecords / COUNT_PAGE);
			
			if ($page > $countPages) {
				$page = $countPages;
			}
			$offset = COUNT_PAGE * ($page - 1);
			
			if ($fullQuery=='') {
				$this->data = $this->model->findByCondition($filter, $orderBy, $offset, COUNT_PAGE);
//				$this->data = SqlQueryCache::getFromCache($this->model,$filter, $orderBy, $offset, COUNT_PAGE);
			}
			else {
				$conn = DbFactory::getConnection();
				$query = $conn->newStatement("{$fullQuery} LIMIT {$offset}, ".COUNT_PAGE);
				$data = $query->getAllRecords();
				$this->data = array();
				foreach ($data as $elem){
					$class = get_class($model);
					$this->model = new $class();
					$this->model->loadById($elem["id"]);
					$this->data[] = $this->model;
				}
			}
			if ($this->countRecords < COUNT_PAGE) {
				return false;
			}
		} else {
			return false;
		}
	


		//	пїЅпїЅпїЅпїЅпїЅпїЅ пїЅпїЅпїЅпїЅпїЅпїЅ Pager'a
		$linkPages = array();

		//	пїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅ пїЅпїЅпїЅпїЅпїЅпїЅ пїЅпїЅпїЅпїЅпїЅпїЅ
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

		if ($page!=1) {
			if (!empty($href)) {
				$linkPages[0] = "<a class=\"left\" href=\"{$href}{$prev}\">← назад</a>";
			} else {
				$ajaxFunctionMod = ereg_replace(":pageId:", "{$prev}", $ajaxFunction);
				$linkPages[0] = "<a class=\"left\" onclick=\"{$ajaxFunctionMod}\">← назад</a>";
			}
		}
		if($flagFirst){
			if (!empty($href)) {
				$linkPages[1] = "<a href=\"{$href}1/\"><span>1</span></a>";
			} else {
				$ajaxFunctionMod = ereg_replace(":pageId:", "1", $ajaxFunction);
				$linkPages[1] = "<a onclick=\"{$ajaxFunctionMod}\"><span>1</span></a>";
			}
			$linkPages[2] = '...';
		}
		for ($i; $i <= $j; $i++) {
			if (!empty($href)) {
				$linkPages[$i] = "<a href=\"{$href}{$i}/\"><span>{$i}</span></a>";
			} else {
				$ajaxFunctionMod = ereg_replace(":pageId:", "{$i}", $ajaxFunction);
				$linkPages[$i] = "<a onclick=\"{$ajaxFunctionMod}\"><span>{$i}</span></a>";
			}
			//	пїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅ пїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅ пїЅпїЅпїЅпїЅпїЅпїЅ
			if ($i == $page) {
				if (!empty($href)) {
					$linkPages[$i] = "<span>{$i}</span>";
				} else {
					$ajaxFunctionMod = ereg_replace(":pageId:", "{$i}", $ajaxFunction);
					$linkPages[$i] = "<span>{$i}</span>";
				}
			}
		}
		$ajaxFunctionMod = ereg_replace(":pageId:", "{$i}", $ajaxFunction);
		if($flagLast){
			$linkPages[$countPages-1] = '...';
			if (!empty($href)) {
				$linkPages[$countPages] = "<a href=\"{$href}{$countPages}/\"><span>{$countPages}</span></a>";
			} else {
				$ajaxFunctionMod = ereg_replace(":pageId:", "{$countPages}", $ajaxFunction);
				$linkPages[$countPages] = "<a onclick=\"{$ajaxFunctionMod}\"><span>{$countPages}</span></a>";
			}
		}
		if ($page != $countPages) {
			if (!empty($href)) {
				$linkPages []= "<a class=\"right\" href=\"{$href}{$next}\">вперед →</a>";
			} else {
				$ajaxFunctionMod = ereg_replace(":pageId:", "{$next}", $ajaxFunction);
				$linkPages []= "<a class=\"right\" onclick=\"{$ajaxFunctionMod}\">вперед →</a>";
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

	public function getPagerStringFromArray($pageNumber, $data, $href = '', $ajaxFunction='') {
		if ($pageNumber) {
			$page = $pageNumber;
		} else {
			$page = 1;
		}

		//	пїЅпїЅпїЅпїЅпїЅ пїЅ пїЅпїЅпїЅпїЅпїЅпїЅпїЅ пїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅ пїЅпїЅпїЅпїЅпїЅпїЅ
//		$offset = COUNT_PAGE * ($page - 1);

		$this->countRecords = count($data);

		if ($this->countRecords) {
			$countPages = ceil($this->countRecords / COUNT_PAGE);
			
			if ($page > $countPages) {
				$page = $countPages;
			}
			$offset = ($page - 1);

			$data = array_chunk($data, COUNT_PAGE);
			$this->data = $data[$offset];
//			$this->data = SqlQueryCache::getFromCache($this->model,$filter, $orderBy, $offset, COUNT_PAGE);
			if ($this->countRecords < COUNT_PAGE) {
				return false;
			}
		} else {
			return false;
		}
	


		//	пїЅпїЅпїЅпїЅпїЅпїЅ пїЅпїЅпїЅпїЅпїЅпїЅ Pager'a
		$linkPages = array();

		//	пїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅ пїЅпїЅпїЅпїЅпїЅпїЅ пїЅпїЅпїЅпїЅпїЅпїЅ
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

		if ($page!=1) {
			if (!empty($href)) {
				$linkPages[0] = "<a class=\"left\" href=\"{$href}{$prev}/\">← назад</a>";
			} else {
				$ajaxFunctionMod = ereg_replace(":pageId:", "{$prev}", $ajaxFunction);
				$linkPages[0] = "<a class=\"left\" onclick=\"{$ajaxFunctionMod}\">← назад</a>";
			}
		}
		if($flagFirst){
			if (!empty($href)) {
				$linkPages[1] = "<a href=\"{$href}1/\"><span>1</span></a>";
			} else {
				$ajaxFunctionMod = ereg_replace(":pageId:", "1", $ajaxFunction);
				$linkPages[1] = "<a onclick=\"{$ajaxFunctionMod}\"><span>1</span></a>";
			}
			$linkPages[2] = '...';
		}
		for ($i; $i <= $j; $i++) {
			if (!empty($href)) {
				$linkPages[$i] = "<a href=\"{$href}{$i}/\"><span>{$i}</span></a>";
			} else {
				$ajaxFunctionMod = ereg_replace(":pageId:", "{$i}", $ajaxFunction);
				$linkPages[$i] = "<a onclick=\"{$ajaxFunctionMod}\"><span>{$i}</span></a>";
			}
			//	пїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅ пїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅ пїЅпїЅпїЅпїЅпїЅпїЅ
			if ($i == $page) {
				if (!empty($href)) {
					$linkPages[$i] = "<span>{$i}</span>";
				} else {
					$ajaxFunctionMod = ereg_replace(":pageId:", "{$i}", $ajaxFunction);
					$linkPages[$i] = "<span>{$i}</span>";
				}
			}
		}
		$ajaxFunctionMod = ereg_replace(":pageId:", "{$i}", $ajaxFunction);
		if($flagLast){
			$linkPages[$countPages-1] = '...';
			if (!empty($href)) {
				$linkPages[$countPages] = "<a href=\"{$href}{$countPages}/\"><span>{$countPages}</span></a>";
			} else {
				$ajaxFunctionMod = ereg_replace(":pageId:", "{$countPages}", $ajaxFunction);
				$linkPages[$countPages] = "<a onclick=\"{$ajaxFunctionMod}\"><span>{$countPages}</span></a>";
			}
		}
		if ($page != $countPages) {
			if (!empty($href)) {
				$linkPages []= "<a class=\"right\" href=\"{$href}{$next}/\">вперед →</a>";
			} else {
				$ajaxFunctionMod = ereg_replace(":pageId:", "{$next}", $ajaxFunction);
				$linkPages []= "<a class=\"right\" onclick=\"{$ajaxFunctionMod}\">вперед →</a>";
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
	private function countRecords($model, $where = '') {
		return $model->countRecords($where);

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
	 * @param string $delimiter -  пїЅпїЅпїЅпїЅпїЅпїЅ-пїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅ
	 */
	public function setDelimiter($delimiter) {
		$this->delimiter = $delimiter;
	}
}


?>