<?php
require_once("module/AbstractPageModule.class.php");

// Это фактически код из BlogPage 
// Вызываем после добавления комента
class GetCommentPage extends AbstractPageModule {

	var $comm_block;
	
	function doContent(){
		
		$data_item['id'] = (int) $this->request->getValue('id_blog');
		//$id_user = $this->user['id'];
		
						
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
		
				
		echo json_encode(array('data_ajax'=>$this->comm_block)); 
		die();	
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