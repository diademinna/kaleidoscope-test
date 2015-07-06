<?php
class BlogPage extends AbstractPageModule {

	var $comm_block;
	
	function doBeforeOutput(){
		$this->doInit();
		
		/* 
		   В Abstruct ДОБАВИТЬ!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
		   ЕСЛИ надо достать разделы блогов

			// все меню. // все блоги
		   $query = $this->conn->newStatement("SELECT id, name, url FROM blog WHERE parent_id=0 AND active=1 ORDER BY id ASC");
		   $query->setInteger('parent_id', $id_category);
		   $data_blog_all = $query->getAllRecords('id');
		   $this->template->assign('data_blog_all', $data_blog_all);
		 
	    */
				
	}
	
	function doContent(){
		$url_1 = $this->request->getValue('url_1'); // URL раздела
		$url_2 = $this->request->getValue('url_2'); // URL подраздела
		
		$id_blog_tag = $this->request->getValue('id_blog_tag'); // когда выбрали отдельный tag
		
		define('COUNT_PAGE', 12);
		require_once 'module/common/PagerFactory.class.php';
		
		if($url_1){
			// достаем корневой раздел.
			$query = $this->conn->newStatement("SELECT * FROM blog WHERE parent_id=0 AND url=:url_1:");
			$query->setVarChar('url_1', $url_1);
			$data_blog = $query->getFirstRecord();
			$this->template->assign('data_blog', $data_blog);
		}
		
		if($id_blog_tag){// ВЫБРАЛИ ОТДЕЛЬНЫЙ TAG  // ЗНАЧИТ ВСЕ БЛОГИ С ОДНИМ ТЕГОМ
			
			$this->template->assign('flag_1ur', 1);
			$this->template->assign('flag_tag', 1);
			
			// текущий тег
			$query = $this->conn->newStatement("SELECT name FROM blog_tag WHERE id=:id_blog_tag:");
			$query->setInteger('id_blog_tag', $id_blog_tag);
			$data_tag_name = $query->getOneValue();
			$this->template->assign('data_tag_name', $data_tag_name);
			
			// получаем id блогов которые относяться к выбранному тегу.
			$query = $this->conn->newStatement("SELECT * FROM blog_to_tag WHERE id_blog_tag=:id_blog_tag: GROUP BY id_blog");
			$query->setInteger('id_blog_tag', $id_blog_tag);
			$data_blog_to_tag = $query->getAllRecords('id_blog');
			
			if($data_blog_to_tag){
				$str_id_blog = implode(",", array_keys($data_blog_to_tag));;
				
				// достаем блоги
				$pager = new PagerFactory();
				$page = $this->request->getValue('page')?$this->request->getValue('page'):1;
				$this->template->assign('page', $page);

				$sql = "SELECT b.*, bp.url AS url_parent 
						FROM blog b
						LEFT JOIN blog bp ON b.parent_id=bp.id
						WHERE b.id IN ($str_id_blog) AND b.active=1 
						ORDER BY b.date DESC, b.id DESC";
				$fromWhereCnt = "blog WHERE id IN ($str_id_blog) AND active=1";
				$href = "/blog/tag/{$id_blog_tag}/";

				$pagerString = $pager->getPagerString($page, $sql, $fromWhereCnt, $href);
				$data_subblog = $pager->getPageData();

				$this->template->assign('pager_string', $pagerString);
				$this->template->assign('data_subblog', $data_subblog);
				
				if($data_subblog){
					// КОЛ_ВО КОММЕНТОВ //////////////////
					$where_id_blog = "";
					foreach($data_subblog AS $key=>$value){ // создаем строку для условия WHERE
						$where_id_blog .= $value['id'].",";
					}
					if(strlen($where_id_blog)>1){
						$where_id_blog = substr($where_id_blog, 0, -1); // обрезаем последний символ
					}
					if($where_id_blog){
						$query = $this->conn->newStatement("SELECT id_blog, COUNT(id) FROM blog_comment WHERE id_blog IN ({$where_id_blog}) GROUP BY id_blog");
						$data_blog_comment_count = $query->getTwoColumnsAsArray();
						$this->template->assign('data_blog_comment_count', $data_blog_comment_count);
					}
				}
				else{
					$this->response->redirect("/");
				}
			}
			else{
				$this->response->redirect("/");
			}
			
		}
		elseif(!$url_2){ //////////////////// ВСЕ НОВОСТИ БЛОГА ////////////////////////////////////
			
			$this->template->assign('flag_1ur', 1);
			
			$pager = new PagerFactory();
			$page = $this->request->getValue('page')?$this->request->getValue('page'):1;
			$this->template->assign('page', $page);

			$sql = "SELECT * FROM blog WHERE parent_id={$data_blog['id']} AND active=1 ORDER BY pos DESC, id DESC";
			$fromWhereCnt = "blog WHERE parent_id={$data_blog['id']} AND active=1";
			$href = "/blog/{$url_1}/page/";

			$pagerString = $pager->getPagerString($page, $sql, $fromWhereCnt, $href);
			$data_subblog = $pager->getPageData();
			$this->template->assign('pager_string', $pagerString);
			$this->template->assign('data_subblog', $data_subblog);

			$this->setPageTitle(($data_blog['title']?$data_blog['title']:$data_blog['name']));
			
			if($data_subblog){
				// КОЛ_ВО КОММЕНТОВ //////////////////
				$where_id_blog = "";
				foreach($data_subblog AS $key=>$value){ // создаем строку для условия WHERE
					$where_id_blog .= $value['id'].",";
				}
				if(strlen($where_id_blog)>1){
					$where_id_blog = substr($where_id_blog, 0, -1); // обрезаем последний символ
				}
				if($where_id_blog){
					$query = $this->conn->newStatement("SELECT id_blog, COUNT(id) FROM blog_comment WHERE id_blog IN ({$where_id_blog}) GROUP BY id_blog");
					$data_blog_comment_count = $query->getTwoColumnsAsArray();
					$this->template->assign('data_blog_comment_count', $data_blog_comment_count);
				}
			}
			else{
				$this->response->redirect("/");
			}
			
		}
		else { ////// ОТДЕЛЬНАЯ НОВОСТЬ В БЛОГЕ //////////////////////
			
			$this->template->assign('flag_2ur', 1);
			
			// достаем текущую новость
			$query = $this->conn->newStatement("SELECT * FROM blog WHERE parent_id=:parent_id: AND url=:url_2:");
			$query->setInteger('parent_id', $data_blog['id']);
			$query->setVarChar('url_2', $url_2);
			$data_item = $query->getFirstRecord();
			$this->template->assign('data_item', $data_item);
			
			$this->setPageTitle(($data_item['title']?$data_item['title']:$data_item['name'])." / {$data_blog['name']}");
			
			// ДОСТАЕМ ГАЛЕРЕЮ.
			$query = $this->conn->newStatement("SELECT * FROM blog_photo WHERE id_blog=:id_blog: ORDER BY pos DESC, id DESC");
			$query->setInteger('id_blog', $data_item['id']);
			$data_photo = $query->getAllRecords();
			
			// сортируем фотки по гориз и вертикали.
			$data_photo_vert = array();
			foreach ($data_photo as $key => $value) {
				if($value['img_position'] == 2){ // вертик
					$data_photo_vert[] = $value;
					unset($data_photo[$key]);
				}
			}
			
			$this->template->assign('data_photo_goriz', $data_photo);
			$this->template->assign('data_photo_vert', $data_photo_vert);
			
			
			// КОММЕНТЫ
			$query = $this->conn->newStatement("
					SELECT bc.*, u.login AS user_login, u.avatar AS user_avatar
					FROM blog_comment bc 
					LEFT JOIN user u ON bc.id_user=u.id	
					WHERE bc.id_blog=:id_blog:
					ORDER BY bc.date ASC, bc.id ASC"
			);
			$query->setInteger('id_blog', $data_item['id']);
			$data_comment = $query->getAllRecords();
			$this->template->assign('data_blog_comment_count', sizeof($data_comment));
			
			if($data_comment){
				// ЕСЛИ ДЕРЕВОМ ВЫВОДИМ, ТО СОЗДАЕМ ДЕРЕВО! 
				//теперь создаем массив в виде дерева
				$tree = array();
				foreach($data_comment as $cur){
					$tree[(int)$cur['parent_id']][] = $cur;
				}

				$this->template->assign("flag_first_ul", 1);
				$this->comm_block .= $this->template->fetch('ajax/get_comment.tpl');
				$this->template->assign("flag_first_ul", 0);
				$this->TreeConstructComm($tree);
				$this->template->assign("flag_last_ul", 1);
				$this->comm_block .= $this->template->fetch('ajax/get_comment.tpl');

				$this->template->assign('blog_comment', $this->comm_block);
			}
					
		}
		
		
		
		/////////////////// ТЕГИ ///////////////////////////////////////////////////////////
		if($id_blog_tag OR !$url_2){// ВЫБРАЛИ ОТДЕЛЬНЫЙ TAG // или // ВСЕ НОВОСТИ БЛОГА
			// ДОСТАЕМ ВСЕ ТЕГИ У ВЫБРАННЫХ НОВОСТЕЙ
			$where_id_subblog = "";
			if($data_subblog){
				foreach($data_subblog AS $key=>$value){ // создаем строку для условия WHERE
					$where_id_subblog .= $value['id'].",";
				}
				if(strlen($where_id_subblog)>1){
					$where_id_subblog = substr($where_id_subblog, 0, -1); // обрезаем последний символ
				}

				// ТЕГИ ДОСТАЕМ
				$query = $this->conn->newStatement("
					SELECT bt.id AS id, bt.name AS name, btot.id_blog
					FROM blog_to_tag btot 
					INNER JOIN blog_tag bt ON btot.id_blog_tag=bt.id
					WHERE btot.id_blog IN ($where_id_subblog)
					ORDER BY btot.id ASC");
				$query->setInteger('id_blog', $data_item['id']);
				$data_blog_tag_temp = $query->getAllRecords();

				if($data_blog_tag_temp){
					$data_blog_tag = array();
					foreach($data_blog_tag_temp AS $key=>$value){ // создаем строку для условия WHERE
						$data_blog_tag[$value['id_blog']][] = $value;
					}
					$this->template->assign('data_blog_tag', $data_blog_tag);
				}
			}
		}
		else { ////// ОТДЕЛЬНАЯ НОВОСТЬ В БЛОГЕ //////////////////////
			// ТЕГИ ДОСТАЕМ
			$query = $this->conn->newStatement("
				SELECT bt.id AS id, bt.name AS name
				FROM blog_to_tag btot 
				INNER JOIN blog_tag bt ON btot.id_blog_tag=bt.id
				WHERE btot.id_blog=:id_blog:
				ORDER BY btot.id ASC");
			$query->setInteger('id_blog', $data_item['id']);
			$data_blog_tag = $query->getAllRecords();
			$this->template->assign('data_blog_tag', $data_blog_tag);
		}
		/////////////////// ТЕГИ - END////////////////////////////////////////////////////////
		
		
		
				
		//////////////////////////////////////////////////////////////	
		// ДОПОЛНИТЕЛЬНАЯ ЧАСТЬ С ФОРМИРОВАНИЕМ СХОЖИХ НОВОСТЕЙ (Советуем почитать)		
		if($id_blog_tag){// ВЫБРАЛИ ОТДЕЛЬНЫЙ TAG  // ЗНАЧИТ ВСЕ БЛОГИ С ОДНИМ ТЕГОМ
			// последние новости из других разделов
			
			$where_str = "";
			foreach($data_subblog AS $value){ // создаем строку для условия WHERE
				$where_str .= $value['id'].",";
			}
			if(strlen($where_str)>1){
				$where_str = substr($where_str, 0, -1); // обрезаем последний символ
			}
			if($where_str){
				$where_str = " AND b.id NOT IN({$where_str})";
			}
						
			$query = $this->conn->newStatement("
				SELECT b.*, bp.url AS url_parent 
				FROM blog b
				LEFT JOIN blog bp ON b.parent_id=bp.id
				WHERE b.parent_id>0 {$where_str} AND b.active=1
				ORDER BY b.date DESC, b.id DESC
				LIMIT 5
			");
			$data_blog_last_news = $query->getAllRecords();
			$this->template->assign('data_blog_last_news', $data_blog_last_news);
		}
		elseif(!$url_2){ //////////////////// ВСЕ НОВОСТИ БЛОГА
			
			// последние новости из других разделов
			$query = $this->conn->newStatement("
				SELECT b.*, bp.url AS url_parent 
				FROM blog b
				LEFT JOIN blog bp ON b.parent_id=bp.id
				WHERE b.parent_id>0 AND b.parent_id<>:parent_id: AND b.active=1
				ORDER BY b.date DESC, b.id DESC
				LIMIT 5
			");
			$query->setInteger('parent_id', $data_blog['id']);
			$data_blog_last_news = $query->getAllRecords();
			$this->template->assign('data_blog_last_news', $data_blog_last_news);
		}
		else { ////// ОТДЕЛЬНАЯ НОВОСТЬ В БЛОГЕ
			
			// новости по тем же тегам что и текущая.
			$where_str = "";
			foreach($data_blog_tag AS $value){ // создаем строку для условия WHERE
				$where_str .= $value['id'].",";
			}
			if(strlen($where_str)>1){
				$where_str = substr($where_str, 0, -1); // обрезаем последний символ
			}
			if($where_str){
				$query = $this->conn->newStatement("
					SELECT b.id, b.name, b.date, b.ext, b.url, bp.url AS url_parent 
					FROM blog_to_tag  bt
					LEFT JOIN blog b ON bt.id_blog=b.id
					LEFT JOIN blog bp ON b.parent_id=bp.id
					WHERE bt.id_blog_tag IN ({$where_str}) AND b.active=1 AND b.id<>:id:
					GROUP BY bt.id_blog 
					ORDER BY b.date DESC, b.id DESC
					LIMIT 5");
				$query->setInteger('id', $data_item['id']);
				$data_blog_last_news = $query->getAllRecords();				
				$this->template->assign('data_blog_last_news', $data_blog_last_news);
			}
		}		
		
		$this->response->write($this->renderTemplate('blog.tpl'));
	}
	
	
	
	//рекурсивная функция для вывода дерева комментов
	function TreeConstructComm($tree, $parent_id=0, $cur_count=0) {
	    if (empty($tree[$parent_id])){
	        return;
	    }
	    $cur_count++;
		
	    foreach($tree[$parent_id] as $key=>$cur){
			$this->template->assign('cur', $cur);
			$this->template->assign('cur_count', $cur_count);
			$this->comm_block .= $this->template->fetch('ajax/get_comment.tpl');
			
	        if(isset($tree[$cur['id']])){ // есть ли у него ответы
	            $this->TreeConstructComm($tree, $cur['id'], $cur_count);
	        }
	    }
	}
	
	
	
	
}
?>