<?php
class TagsPage extends AbstractPageModule {

	function doBeforeOutput(){
		$this->doInit();
	}

	function doContent(){
		$this->template->assign('data_blog_tag', Useful::getAllTag());	
		
		$this->response->write($this->renderTemplate('tags.tpl'));
	}
}
?>