<?php
require_once("module/FormPageModule.class.php");
require_once("validator/Validator.class.php");
require_once("util/ImageUtil.class.php");

class AdminMainCategoryListPage extends FormPageModule {
		
	public function doBeforeOutput(){
		$this->Authenticate();
		
		$this->template->assign("tinymce", 1);
                $this->template->assign('unit', "main_category");
	}
	
	
	public function doFormInit(){
		
		$query = $this->conn->newStatement("SELECT id, name, main FROM category WHERE active=1 AND parent_id=0 ORDER BY name");
	        $data_category = $query->getAllRecords();
                if ($data_category)
                {
                    foreach ($data_category as $key=>$value)
                    {
                        $query = $this->conn->newStatement("SELECT id, name, main FROM category WHERE active=1 AND parent_id=:id: ORDER BY name");
                        $query->setInteger('id', $value['id']);
                        $data_sub_category = $query->getAllRecords();
                        if ($data_sub_category){
                            $data_category[$key]['subcategory'] = $data_sub_category;
                        }
                    }
                }
		$this->template->assign('data_category', $data_category);
		$this->response->write($this->renderTemplate('admin/admin_main_category_list.tpl'));
	}
	
	public function doFormValid() {
		$mass_cat = $this->formData;
                $num = 0;
                $query = $this->conn->newStatement("UPDATE category SET main=:main:");
                $query->setInteger('main', 0);
                $query->execute();
                foreach ($mass_cat as $key=>$value)
                {
                    $pos = substr_count($key, 'cat');
                    if ($pos)
                    {
                        $num = $num+1;
                        $query = $this->conn->newStatement("UPDATE category SET main=:main: WHERE id=:id:");
                        $query->setInteger('main', $num);
                        $query->setVarChar('id', $value);
                        $query->execute();
                    }
                }
                $query = $this->conn->newStatement("SELECT id, name, main FROM category WHERE active=1 AND parent_id=0 ORDER BY name");
	        $data_category = $query->getAllRecords();
                if ($data_category)
                {
                    foreach ($data_category as $key=>$value)
                    {
                        $query = $this->conn->newStatement("SELECT id, name, main FROM category WHERE active=1 AND parent_id=:id: ORDER BY name");
                        $query->setInteger('id', $value['id']);
                        $data_sub_category = $query->getAllRecords();
                        if ($data_sub_category){
                            $data_category[$key]['subcategory'] = $data_sub_category;
                        }
                    }
                }
		$this->template->assign('data_category', $data_category);
		$this->template->assign("errors", "Информация сохранена");
		
		$this->response->write($this->renderTemplate("admin/admin_main_category_list.tpl"));
		//$this->response->redirect("/admin/main_category/list/");
	}
	
	
	public function doFormInvalid(){
		$this->template->assign('data', $this->formData);
		$this->response->write($this->renderTemplate("admin/admin_main_category_list.tpl"));
	}
	
	
	function doValidation(){		
		$rules = array(
			//new EmptyFieldRule("name", 'Название'),
		);
		
		$validator = new Validator($this->formData);
		
		if (!$validator->validate($rules)) {
			$this->template->assign('errors', $validator->getErrorList());
			return false;
		}
		else return true;
	}	
}
?>