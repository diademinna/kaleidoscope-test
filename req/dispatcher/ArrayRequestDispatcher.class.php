<?php
require_once('dispatcher/RequestDispatcher.class.php');

class ArrayRequestDispatcher extends RequestDispatcher {

	var $resourceMap;
	var $httpResponse;
	var $subdomain = null;

	function ArrayRequestDispatcher(&$httpRequest,&$httpResponse){
		$this->httpResponse =& $httpResponse;
		parent::RequestDispatcher($httpRequest);				
		$this->resourceMap = $this->_defineResourceMap();
	}
	
	function _defineResourceMap() {
		return array(
			'/' 		=> 		array('moduleName' => 'IndexPage', 'moduleType' => 'module'),
			'/404/' 	=> array('moduleName' => 'common/404error.tpl', 'moduleType' => 'template'),
			'/index_ie/'=> array('moduleName' => 'common/index_ie.tpl', 'moduleType' => 'template'), // ie6, ie7 заглушка
			'/kcaptcha/'=> array('moduleName' => 'common/Captcha', 'moduleType' => 'module'), // капча
			'/parser/' 		=> array('moduleName' => 'ParserPage', 'moduleType' => 'module'),
			// PAGES CLASS
			'/company/' 		=> array('moduleName' => 'PagesPage', 'moduleType' => 'module', 'id' => '1'),
			// PAGES CLASS
			
			'/content/(.+?)/'	=> array('moduleName' => 'ContentPage', 'moduleType' => 'module', 'url'=>'$1'),
						
			'/feedback/'		=> array('moduleName' => 'FeedbackPage', 'moduleType' => 'module'),
			'/callback/' 		=> array('moduleName' => 'CallbackPage', 'moduleType' => 'module'),
				
			'/contacts/' 		=> array('moduleName' => 'ContactsPage', 'moduleType' => 'module'),
			
			'/news/' 			=> array('moduleName' => 'NewsPage', 'moduleType' => 'module'),
			'/news/page/(\d+)/' => array('moduleName' => 'NewsPage', 'moduleType' => 'module', 'page' => '$1'),
			'/news/(\d+)/' 		=> array('moduleName' => 'NewsPage', 'moduleType' => 'module', 'id' => '$1'),
				
			
			'/faqs/' 			=> array('moduleName' => 'FaqsPage', 'moduleType' => 'module'),
			'/faqs/(\d+)/' 		=> array('moduleName' => 'FaqsPage', 'moduleType' => 'module', 'page' => '$1'),
			
			
			'/gallery/' 			=> array('moduleName' => 'GalleryPage', 'moduleType' => 'module'),
			'/gallery/page/(\d+)/' => array('moduleName' => 'GalleryPage', 'moduleType' => 'module', 'page' => '$1'),
			'/gallery/(\d+)/' 		=> array('moduleName' => 'GalleryPage', 'moduleType' => 'module', 'id' => '$1'),
			
			
			'/vacancy/'				=> array('moduleName' => 'VacancyPage', 'moduleType' => 'module'),
			'/vacancy/page/(\d+)/'  => array('moduleName' => 'VacancyPage', 'moduleType' => 'module', 'page' => '$1'),
					
			
			'/article/' 			=> array('moduleName' => 'ArticlePage', 'moduleType' => 'module'),
			'/article/page/(\d+)/'	=> array('moduleName' => 'ArticlePage', 'moduleType' => 'module', 'page' => '$1'),
			'/article/(\d+)/' 		=> array('moduleName' => 'ArticlePage', 'moduleType' => 'module', 'id' => '$1'),
				
			
			
			'/login/'			 =>	array('moduleName' => 'user/LoginPage', 'moduleType' => 'module'),
			'/logout/'			 =>	array('moduleName' => 'user/LogoutPage', 'moduleType' => 'module'),
			'/registration/' 	 => array('moduleName'  => 'user/RegistrationPage', 'moduleType' => 'module'),
			'/success_registration/' => array('moduleName' => 'user/SuccessRegistrationPage', 'moduleType' => 'module'),
			'/activate/' 		 => array('moduleName'  => 'user/ActivatePage', 'moduleType' => 'module'),
			'/restore_password/' => array('moduleName' => 'user/RestorePasswordPage', 'moduleType' => 'module'),
			'/user/(\d+)/'       => array('moduleName' => 'user/UserPage', 'moduleType' => 'module', 'id' => '$1'),
			'/user_info/(\d+)/'  => array('moduleName' => 'user/UserInfoPage', 'moduleType' => 'module', 'id' => '$1'),
			'/change_password/'  => array('moduleName' => 'user/ChangePasswordPage', 'moduleType' => 'module'),
                        '/cart/'			 =>	array('moduleName' => 'user/CartPage', 'moduleType' => 'module'),
			
			'/category/'		=> array('moduleName' => 'CategoryPage', 'moduleType' => 'module'),
			'/category/(\d+)/'	=> array('moduleName' => 'CategoryPage', 'moduleType' => 'module', 'id_category' => '$1'),
                        '/category/page/(\d+)/' => array('moduleName' => 'CategoryPage', 'moduleType' => 'module', 'page' => '$1'),
                        '/category/(\d+)/page/(\d+)/' => array('moduleName' => 'CategoryPage', 'moduleType' => 'module', 'id_category' => '$1', 'page' => '$2'),
			'/product/(\d+)/'	=> array('moduleName' => 'ProductPage', 'moduleType' => 'module', 'id_product' => '$1'),
			
			
			'/section/(\w+)/'	=> array('moduleName' => 'SectionPage', 'moduleType' => 'module', 'url_1' => '$1'),
			'/section/(\w+)/(\w+)/'	=> array('moduleName' => 'SectionPage', 'moduleType' => 'module', 'url_1' => '$1', 'url_2' => '$2'),		
			
			
			'/blog/tag/(\d+)/'			=> array('moduleName' => 'BlogPage', 'moduleType' => 'module', 'id_blog_tag' => '$1'),
			'/blog/tag/(\d+)/(\d+)/'	=> array('moduleName' => 'BlogPage', 'moduleType' => 'module', 'id_blog_tag' => '$1', 'page'=>'$2'),
			'/blog/(\w+)/'				=> array('moduleName' => 'BlogPage', 'moduleType' => 'module', 'url_1' => '$1'),
			'/blog/(\w+)/page/(\d+)/'	=> array('moduleName' => 'BlogPage', 'moduleType' => 'module', 'url_1' => '$1', 'page'=>'$2'),
			'/blog/(\w+)/(\w+)/'		=> array('moduleName' => 'BlogPage', 'moduleType' => 'module', 'url_1' => '$1', 'url_2' => '$2'),	
			
			'/tags/'					=>	array('moduleName' => 'TagsPage', 'moduleType' => 'module'),
			
			
			'/sort_product/' => array('moduleName' => 'ajax/SortProductPage', 'moduleType' => 'module'), 
			'/filtr_parameter/' => array('moduleName' => 'ajax/FiltrParameterPage', 'moduleType' => 'module'), 
			'/filtr_price_product/' => array('moduleName' => 'ajax/FiltrPriceProductPage', 'moduleType' => 'module'), 
			'/add_forma_comm/' => array('moduleName' => 'ajax/AddFormaCommPage', 'moduleType' => 'module'), 
			'/send_comment/' => array('moduleName' => 'ajax/SendCommentPage', 'moduleType' => 'module'), 
			'/get_comment/' => array('moduleName' => 'ajax/GetCommentPage', 'moduleType' => 'module'), 
			'/check_captcha/' => array('moduleName' => 'ajax/CheckCaptchaPage', 'moduleType' => 'module'), 
			'/check_email/' => array('moduleName' => 'ajax/CheckEmailPage', 'moduleType' => 'module'), 
			'/registration_user/' => array('moduleName' => 'ajax/RegistrationUserPage', 'moduleType' => 'module'), 
                        '/add_product/' => array('moduleName' => 'ajax/AddProductPage', 'moduleType' => 'module'), 
                        '/add_one_product/' => array('moduleName' => 'ajax/AddOneProductPage', 'moduleType' => 'module'), 
                        '/remove_product/' => array('moduleName' => 'ajax/RemoveProductPage', 'moduleType' => 'module'), 
                        '/remove_one_product/' => array('moduleName' => 'ajax/RemoveOneProductPage', 'moduleType' => 'module'), 
                        '/add_order/' => array('moduleName' => 'ajax/AddOrderPage', 'moduleType' => 'module'), 
                        '/add_review/' => array('moduleName' => 'ajax/AddReviewPage', 'moduleType' => 'module'), 
                        '/admin_change_category/' => array('moduleName' => 'ajax/AdminChangeCategoryPage', 'moduleType' => 'module'), 
                        '/add_respond/' => array('moduleName' => 'ajax/AddRespondPage', 'moduleType' => 'module'), 
                    
                        '/search/'=> array('moduleName' => 'SearchPage', 'moduleType' => 'module', 'word' => '$1'), // поиск
			
			
			
			/* DEVELOPER CODE */
			
			/*АКЦИИ*/
                        '/actions/' 			=> array('moduleName' => 'ActionsPage', 'moduleType' => 'module'),
			'/actions/page/(\d+)/' => array('moduleName' => 'ActionsPage', 'moduleType' => 'module', 'page' => '$1'),
			'/actions/(\d+)/' 		=> array('moduleName' => 'ActionsPage', 'moduleType' => 'module', 'id' => '$1'),
			
			
                        '/review/' 		=> array('moduleName' => 'ReviewPage', 'moduleType' => 'module'),
                        '/review/(\d+)/' 	=> array('moduleName' => 'ReviewPage', 'moduleType' => 'module', 'page' => '$1'),
                    
                        /*Портфолио*/
                        '/portfolio/' 			=> array('moduleName' => 'PortfolioPage', 'moduleType' => 'module'),
			'/portfolio/page/(\d+)/' => array('moduleName' => 'PortfolioPage', 'moduleType' => 'module', 'page' => '$1'),
			'/portfolio/(\d+)/' 		=> array('moduleName' => 'PortfolioPage', 'moduleType' => 'module', 'id' => '$1'),
                    
                    
                        '/services/' 			=> array('moduleName' => 'ServicesPage', 'moduleType' => 'module'),
			'/services/page/(\d+)/' => array('moduleName' => 'ServicesPage', 'moduleType' => 'module', 'page' => '$1'),
			'/services/(\d+)/' 		=> array('moduleName' => 'ServicesPage', 'moduleType' => 'module', 'id' => '$1'),
			
			/* CRON */
			
			
			
			
			
			/***************	АДМИНКА	*****************/
			'/admin/' 					=> array('moduleName' => 'admin/AdminPage', 'moduleType' => 'module'),
			'/admin/help/' 		=> array('moduleName' => 'admin/AdminHelpPage', 'moduleType' => 'module'),
			
						
			
			'/admin/pages/(\d+)/' 		=> array('moduleName' => 'admin/AdminPagesPage', 'moduleType' => 'module', 'id' => '$1'),
			
			
			'/admin/content/list/'					=> array('moduleName' => 'admin/AdminContentListPage', 'moduleType' => 'module'),
			'/admin/content/list/(\d+)/delete/'	=> array('moduleName' => 'admin/AdminContentListPage', 'moduleType' => 'module', 'id' => '$1', 'action' => 'delete'),
			'/admin/content/add/'					=> array('moduleName' => 'admin/AdminContentAddPage', 'moduleType' => 'module'),
			'/admin/content/add/(\d+)/edit/'	=> array('moduleName' => 'admin/AdminContentAddPage', 'moduleType' => 'module', 'id' => '$1', 'action' => 'edit'), 
				
			
			'/admin/contacts/list/'	=> array('moduleName' => 'admin/AdminContactsListPage', 'moduleType' => 'module'),

			'/admin/contacts/list/(\d+)/'	=> array('moduleName' => 'admin/AdminContactsListPage', 'moduleType' => 'module', 'page' => '$1'),


			'/admin/contacts/list/(\d+)/delete/(\d+)/'	=> array('moduleName' => 'admin/AdminContactsListPage', 'moduleType' => 'module', 'page' => '$1', 'action' => 'delete', 'id' => '$2'),			

			'/admin/contacts/add/'	=> array('moduleName' => 'admin/AdminContactsAddPage', 'moduleType' => 'module'),

			'/admin/contacts/add/(\d+)/edit/(\d+)/'		=> array('moduleName' => 'admin/AdminContactsAddPage', 'moduleType' => 'module', 'page' => '$1', 'action' => 'edit', 'id' => '$2'),	
				
			
			'/admin/news/list/'						=> array('moduleName' => 'admin/AdminNewsListPage', 'moduleType' => 'module'),
			'/admin/news/list/(\d+)/'				=> array('moduleName' => 'admin/AdminNewsListPage', 'moduleType' => 'module', 'page' => '$1'),
			'/admin/news/list/(\d+)/delete/(\d+)/'	=> array('moduleName' => 'admin/AdminNewsListPage', 'moduleType' => 'module', 'page' => '$1', 'action' => 'delete', 'id' => '$2'),
			'/admin/news/add/'						=> array('moduleName' => 'admin/AdminNewsAddPage', 'moduleType' => 'module'),
			'/admin/news/add/(\d+)/edit/(\d+)/'		=> array('moduleName' => 'admin/AdminNewsAddPage', 'moduleType' => 'module', 'page' => '$1', 'action' => 'edit', 'id' => '$2'),
			'/admin/news_photo/add/(\d+)/(\d+)/'		=> array('moduleName' => 'admin/AdminNewsPhotoAddPage', 'moduleType' => 'module', 'page' => '$1', 'id' => '$2'),
                    
                        /*Акции*/
                        '/admin/actions/list/'						=> array('moduleName' => 'admin/AdminActionsListPage', 'moduleType' => 'module'),
			'/admin/actions/list/(\d+)/'				=> array('moduleName' => 'admin/AdminActionsListPage', 'moduleType' => 'module', 'page' => '$1'),
			'/admin/actions/list/(\d+)/delete/(\d+)/'	=> array('moduleName' => 'admin/AdminActionsListPage', 'moduleType' => 'module', 'page' => '$1', 'action' => 'delete', 'id' => '$2'),
			'/admin/actions/add/'						=> array('moduleName' => 'admin/AdminActionsAddPage', 'moduleType' => 'module'),
			'/admin/actions/add/(\d+)/edit/(\d+)/'		=> array('moduleName' => 'admin/AdminActionsAddPage', 'moduleType' => 'module', 'page' => '$1', 'action' => 'edit', 'id' => '$2'),
			
			
			
			'/admin/faqs/list/' 				 	=> array('moduleName' => 'admin/AdminFaqsListPage', 'moduleType' => 'module'),
			'/admin/faqs/list/(\d+)/' 			 	=> array('moduleName' => 'admin/AdminFaqsListPage', 'moduleType' => 'module', 'page' => '$1'),
			'/admin/faqs/list/(\d+)/delete/(\d+)/'	=> array('moduleName' => 'admin/AdminFaqsListPage', 'moduleType' => 'module', 'page' => '$1', 'action' => 'delete', 'id' => '$2'),
			'/admin/faqs/add/' 					 	=> array('moduleName' => 'admin/AdminFaqsAddPage', 'moduleType' => 'module'),
			'/admin/faqs/add/(\d+)/edit/(\d+)/'  	=> array('moduleName' => 'admin/AdminFaqsAddPage', 'moduleType' => 'module', 'page' => '$1', 'action' => 'edit', 'id' => '$2'),
			
								
			
			'/admin/gallery/list/'						=> array('moduleName' => 'admin/AdminGalleryListPage', 'moduleType' => 'module'),
			'/admin/gallery/list/(\d+)/'				=> array('moduleName' => 'admin/AdminGalleryListPage', 'moduleType' => 'module', 'page' => '$1'),
			'/admin/gallery/list/(\d+)/delete/(\d+)/'	=> array('moduleName' => 'admin/AdminGalleryListPage', 'moduleType' => 'module', 'page' => '$1', 'action' => 'delete', 'id' => '$2'),			
			'/admin/gallery/add/'						=> array('moduleName' => 'admin/AdminGalleryAddPage', 'moduleType' => 'module'),
			'/admin/gallery/add/(\d+)/edit/(\d+)/'		=> array('moduleName' => 'admin/AdminGalleryAddPage', 'moduleType' => 'module', 'page' => '$1', 'action' => 'edit', 'id' => '$2'),			
			'/admin/gallery_photo/add/(\d+)/(\d+)/'		=> array('moduleName' => 'admin/AdminGalleryPhotoAddPage', 'moduleType' => 'module', 'page' => '$1', 'id' => '$2'),
			
			
			
			'/admin/user/list/'						=> array('moduleName' => 'admin/AdminUserListPage', 'moduleType' => 'module'),
			'/admin/user/list/(\d+)/'				=> array('moduleName' => 'admin/AdminUserListPage', 'moduleType' => 'module', 'page' => '$1'),
			'/admin/user/list/(\d+)/delete/(\d+)/'	=> array('moduleName' => 'admin/AdminUserListPage', 'moduleType' => 'module', 'page' => '$1', 'action' => 'delete', 'id'=> '$2'),
			'/admin/user/add/(\d+)/'				=> array('moduleName' => 'admin/AdminUserAddPage', 'moduleType' => 'module', 'page' => '$1'),
			'/admin/user/add/(\d+)/edit/(\d+)/'		=> array('moduleName' => 'admin/AdminUserAddPage', 'moduleType' => 'module', 'page' => '$1', 'action' => 'edit', 'id' => '$2'),
                    //заказы///
                        '/admin/orders/list/'						=> array('moduleName' => 'admin/AdminOrdersListPage', 'moduleType' => 'module'),
			 
			
	
			'/admin/vacancy/list/'						=> array('moduleName' => 'admin/AdminVacancyListPage', 'moduleType' => 'module'),
			'/admin/vacancy/list/(\d+)/'				=> array('moduleName' => 'admin/AdminVacancyListPage', 'moduleType' => 'module', 'page' => '$1'),
			'/admin/vacancy/list/(\d+)/delete/(\d+)/'	=> array('moduleName' => 'admin/AdminVacancyListPage', 'moduleType' => 'module', 'page' => '$1', 'action' => 'delete', 'id' => '$2'),
			'/admin/vacancy/add/'						=> array('moduleName' => 'admin/AdminVacancyAddPage', 'moduleType' => 'module'),
			'/admin/vacancy/add/(\d+)/edit/(\d+)/'		=> array('moduleName' => 'admin/AdminVacancyAddPage', 'moduleType' => 'module', 'page' => '$1', 'action' => 'edit', 'id' => '$2'),

			'/admin/vacancy_user/list/'						=> array('moduleName' => 'admin/AdminVacancyUserListPage', 'moduleType' => 'module'),
			'/admin/vacancy_user/list/(\d+)/'				=> array('moduleName' => 'admin/AdminVacancyUserListPage', 'moduleType' => 'module', 'page' => '$1'),
			'/admin/vacancy_user/list/(\d+)/delete/(\d+)/'	=> array('moduleName' => 'admin/AdminVacancyUserListPage', 'moduleType' => 'module', 'page' => '$1', 'action' => 'delete', 'id' => '$2'),
			
			
			
			
			'/admin/article/list/'						=> array('moduleName' => 'admin/AdminArticleListPage', 'moduleType' => 'module'),
			'/admin/article/list/(\d+)/'				=> array('moduleName' => 'admin/AdminArticleListPage', 'moduleType' => 'module', 'page' => '$1'),
			'/admin/article/list/(\d+)/delete/(\d+)/'	=> array('moduleName' => 'admin/AdminArticleListPage', 'moduleType' => 'module', 'page' => '$1', 'action' => 'delete', 'id' => '$2'),			
			'/admin/article/add/'						=> array('moduleName' => 'admin/AdminArticleAddPage', 'moduleType' => 'module'),
			'/admin/article/add/(\d+)/edit/(\d+)/'		=> array('moduleName' => 'admin/AdminArticleAddPage', 'moduleType' => 'module', 'page' => '$1', 'action' => 'edit', 'id' => '$2'),
			'/admin/article_photo/add/(\d+)/(\d+)/'		=> array('moduleName' => 'admin/AdminArticlePhotoAddPage', 'moduleType' => 'module', 'page' => '$1', 'id' => '$2'),
			
			
			
			
			'/admin/callback_user/list/'					=> array('moduleName' => 'admin/AdminCallbackUserListPage', 'moduleType' => 'module'),
			'/admin/callback_user/list/(\d+)/'				=> array('moduleName' => 'admin/AdminCallbackUserListPage', 'moduleType' => 'module', 'page' => '$1'),
			'/admin/callback_user/list/(\d+)/delete/(\d+)/'	=> array('moduleName' => 'admin/AdminCallbackUserListPage', 'moduleType' => 'module', 'page' => '$1', 'action' => 'delete', 'id' => '$2'),
			
						
			
			'/admin/category/list/'						=> array('moduleName' => 'admin/AdminCategoryListPage', 'moduleType' => 'module'),
			'/admin/category/list/(\d+)/'				=> array('moduleName' => 'admin/AdminCategoryListPage', 'moduleType' => 'module', 'id_category' => '$1'),
			'/admin/category/list/(\d+)/delete/(\d+)/'	=> array('moduleName' => 'admin/AdminCategoryListPage', 'moduleType' => 'module', 'id_category' => '$1', 'action' => 'delete', 'id' => '$2'),
						
			'/admin/category/add/(\d+)/'				=> array('moduleName' => 'admin/AdminCategoryAddPage', 'moduleType' => 'module', 'parent_id' => '$1'),
			'/admin/category/add/(\d+)/edit/(\d+)/'		=> array('moduleName' => 'admin/AdminCategoryAddPage', 'moduleType' => 'module', 'parent_id' => '$1', 'action' => 'edit', 'id_category' => '$2'),
                    
                        ///параметры
			'/admin/parameter/list/'						=> array('moduleName' => 'admin/AdminParameterListPage', 'moduleType' => 'module'),
			'/admin/parameter/list/(\d+)/'				=> array('moduleName' => 'admin/AdminParameterListPage', 'moduleType' => 'module', 'id_parameter' => '$1'),
			'/admin/parameter/list/(\d+)/delete/(\d+)/'	=> array('moduleName' => 'admin/AdminParameterListPage', 'moduleType' => 'module', 'id_parameter' => '$1', 'action' => 'delete', 'id' => '$2'),
						
			'/admin/parameter/add/(\d+)/'				=> array('moduleName' => 'admin/AdminParameterAddPage', 'moduleType' => 'module', 'parent_id' => '$1'),
			'/admin/parameter/add/(\d+)/edit/(\d+)/'		=> array('moduleName' => 'admin/AdminParameterAddPage', 'moduleType' => 'module', 'parent_id' => '$1', 'action' => 'edit', 'id_parameter' => '$2'),
                        
			
                    
			
			'/admin/product/list/'	=> array('moduleName' => 'admin/AdminProductListPage', 'moduleType' => 'module'),
                        '/admin/product/list/(\d+)/'				=> array('moduleName' => 'admin/AdminProductListPage', 'moduleType' => 'module', 'page' => '$1'),
                        '/admin/product/list/(\d+)/delete/(\d+)/'	=> array('moduleName' => 'admin/AdminProductListPage', 'moduleType' => 'module', 'page' => '$1', 'action' => 'delete', 'id' => '$2'),
			
						
			'/admin/product/add/'				=> array('moduleName' => 'admin/AdminProductAddPage', 'moduleType' => 'module'),
			'/admin/product/add/(\d+)/edit/(\d+)/'		=> array('moduleName' => 'admin/AdminProductAddPage', 'moduleType' => 'module', 'page' => '$1', 'action' => 'edit', 'id' => '$2'),
			
			
			'/admin/product_photo/add/(\d+)/'		=> array('moduleName' => 'admin/AdminProductPhotoAddPage', 'moduleType' => 'module', 'id' => '$1'),
			
                        '/admin/main_category/list/'						=> array('moduleName' => 'admin/AdminMainCategoryListPage', 'moduleType' => 'module'),
                    
			'/admin/brand/list/'					=> array('moduleName' => 'admin/AdminBrandListPage', 'moduleType' => 'module'),
			'/admin/brand/list/(\d+)/'				=> array('moduleName' => 'admin/AdminBrandListPage', 'moduleType' => 'module', 'page' => '$1'),
			'/admin/brand/list/(\d+)/delete/(\d+)/'	=> array('moduleName' => 'admin/AdminBrandListPage', 'moduleType' => 'module', 'page' => '$1', 'action' => 'delete', 'id' => '$2'),			
			'/admin/brand/add/'						=> array('moduleName' => 'admin/AdminBrandAddPage', 'moduleType' => 'module'),			
			'/admin/brand/add/(\d+)/edit/(\d+)/'	=> array('moduleName' => 'admin/AdminBrandAddPage', 'moduleType' => 'module', 'page' => '$1', 'action' => 'edit', 'id' => '$2'),
			
			
						
			'/admin/section/list/'				=> array('moduleName' => 'admin/AdminSectionListPage', 'moduleType' => 'module'),
			'/admin/section/list/(\d+)/'			=> array('moduleName' => 'admin/AdminSectionListPage', 'moduleType' => 'module', 'id_section' => '$1'),
			'/admin/section/list/(\d+)/delete/(\d+)/'	=> array('moduleName' => 'admin/AdminSectionListPage', 'moduleType' => 'module', 'id_section' => '$1', 'action' => 'delete', 'id' => '$2'),	
			'/admin/section/add/(\d+)/'			=> array('moduleName' => 'admin/AdminSectionAddPage', 'moduleType' => 'module', 'parent_id' => '$1'),
			'/admin/section/add/(\d+)/edit/(\d+)/'		=> array('moduleName' => 'admin/AdminSectionAddPage', 'moduleType' => 'module', 'parent_id' => '$1', 'action' => 'edit', 'id_section' => '$2'),
			'/admin/section_photo/add/(\d+)/(\d+)/'		=> array('moduleName' => 'admin/AdminSectionPhotoAddPage', 'moduleType' => 'module', 'parent_id' => '$1', 'id' => '$2'),
			
			
			
			
			
			'/admin/blog/list/'			=> array('moduleName' => 'admin/AdminBlogListPage', 'moduleType' => 'module'),
			'/admin/blog/list/(\d+)/'	=> array('moduleName' => 'admin/AdminBlogListPage', 'moduleType' => 'module', 'parent_id' => '$1'),
			'/admin/blog/list/(\d+)/page/(\d+)/'	=> array('moduleName' => 'admin/AdminBlogListPage', 'moduleType' => 'module', 'parent_id' => '$1', 'page' => '$2'),
			'/admin/blog/list/(\d+)/delete/(\d+)/page/(\d+)/'	=> array('moduleName' => 'admin/AdminBlogListPage', 'moduleType' => 'module', 'parent_id' => '$1', 'action' => 'delete', 'id' => '$2', 'page' => '$3'),
			
			
			'/admin/blog/add/(\d+)/'			=> array('moduleName' => 'admin/AdminBlogAddPage', 'moduleType' => 'module', 'parent_id' => '$1'),
			'/admin/blog/add/(\d+)/edit/(\d+)/page/(\d+)/'		=> array('moduleName' => 'admin/AdminBlogAddPage', 'moduleType' => 'module', 'parent_id' => '$1', 'action' => 'edit', 'id' => '$2', 'page' => '$3'),
			'/admin/blog_photo/add/(\d+)/edit/(\d+)/page/(\d+)/'		=> array('moduleName' => 'admin/AdminBlogPhotoAddPage', 'moduleType' => 'module', 'parent_id' => '$1', 'id_blog' => '$2', 'page' => '$3'),
			
			'/admin/blog/ajax/autocomplete/' =>array('moduleName' => 'admin/AdminBlogAjaxAutocompletePage', 'moduleType' => 'module'),
			
			
			'/admin/blog_comment/list/'						=> array('moduleName' => 'admin/AdminBlogCommentListPage', 'moduleType' => 'module'),
			'/admin/blog_comment/list/(\d+)/'				=> array('moduleName' => 'admin/AdminBlogCommentListPage', 'moduleType' => 'module', 'page' => '$1'),
			'/admin/blog_comment/list/(\d+)/delete/(\d+)/'	=> array('moduleName' => 'admin/AdminBlogCommentListPage', 'moduleType' => 'module', 'page' => '$1', 'action' => 'delete', 'id'=> '$2'),
			'/admin/blog_comment/add/(\d+)/'				=> array('moduleName' => 'admin/AdminBlogCommentAddPage', 'moduleType' => 'module', 'page' => '$1'),
			'/admin/blog_comment/add/(\d+)/edit/(\d+)/'		=> array('moduleName' => 'admin/AdminBlogCommentAddPage', 'moduleType' => 'module', 'page' => '$1', 'action' => 'edit', 'id' => '$2'),
			 
			/*ОТЗЫВЫ*/
                        '/admin/review/list/'				=> array('moduleName' => 'admin/AdminReviewListPage', 'moduleType' => 'module'),
                        '/admin/review/list/(\d+)/' 			=> array('moduleName' => 'admin/AdminReviewListPage', 'moduleType' => 'module', 'page' => '$1'),
                        '/admin/review/list/(\d+)/delete/(\d+)/'	=> array('moduleName' => 'admin/AdminReviewListPage', 'moduleType' => 'module', 'page' => '$1', 'action' => 'delete', 'id' => '$2'),
                        '/admin/review/add/' 				=> array('moduleName' => 'admin/AdminReviewAddPage', 'moduleType' => 'module'),
                        '/admin/review/add/(\d+)/edit/(\d+)/'  		=> array('moduleName' => 'admin/AdminReviewAddPage', 'moduleType' => 'module', 'page' => '$1', 'action' => 'edit', 'id' => '$2'),
			
                    
                        /*ПОРТФОЛИО*/
                        '/admin/portfolio/list/'						=> array('moduleName' => 'admin/AdminPortfolioListPage', 'moduleType' => 'module'),
			'/admin/portfolio/list/(\d+)/'				=> array('moduleName' => 'admin/AdminPortfolioListPage', 'moduleType' => 'module', 'page' => '$1'),
			'/admin/portfolio/list/(\d+)/delete/(\d+)/'	=> array('moduleName' => 'admin/AdminPortfolioListPage', 'moduleType' => 'module', 'page' => '$1', 'action' => 'delete', 'id' => '$2'),			
			'/admin/portfolio/add/'						=> array('moduleName' => 'admin/AdminPortfolioAddPage', 'moduleType' => 'module'),
			'/admin/portfolio/add/(\d+)/edit/(\d+)/'		=> array('moduleName' => 'admin/AdminPortfolioAddPage', 'moduleType' => 'module', 'page' => '$1', 'action' => 'edit', 'id' => '$2'),			
			'/admin/portfolio_photo/add/(\d+)/(\d+)/'		=> array('moduleName' => 'admin/AdminPortfolioPhotoAddPage', 'moduleType' => 'module', 'page' => '$1', 'id' => '$2'),
			
                    
                    
                    
                        /*Услуги*/
                        '/admin/services/list/'						=> array('moduleName' => 'admin/AdminServicesListPage', 'moduleType' => 'module'),
			'/admin/services/list/(\d+)/'				=> array('moduleName' => 'admin/AdminServicesListPage', 'moduleType' => 'module', 'page' => '$1'),
			'/admin/services/list/(\d+)/delete/(\d+)/'	=> array('moduleName' => 'admin/AdminServicesListPage', 'moduleType' => 'module', 'page' => '$1', 'action' => 'delete', 'id' => '$2'),
			'/admin/services/add/'						=> array('moduleName' => 'admin/AdminServicesAddPage', 'moduleType' => 'module'),
			'/admin/services/add/(\d+)/edit/(\d+)/'		=> array('moduleName' => 'admin/AdminServicesAddPage', 'moduleType' => 'module', 'page' => '$1', 'action' => 'edit', 'id' => '$2'),
                    
                    
                    
                        /*Заявки на услуги*/
                        '/admin/respond/list/'						=> array('moduleName' => 'admin/AdminRespondListPage', 'moduleType' => 'module'),
			'/admin/respond/list/(\d+)/'				=> array('moduleName' => 'admin/AdminRespondListPage', 'moduleType' => 'module', 'page' => '$1'),
			'/admin/respond/list/(\d+)/delete/(\d+)/'	=> array('moduleName' => 'admin/AdminRespondListPage', 'moduleType' => 'module', 'page' => '$1', 'action' => 'delete', 'id'=> '$2'),
			'/admin/respond/add/(\d+)/'				=> array('moduleName' => 'admin/AdminRespondAddPage', 'moduleType' => 'module', 'page' => '$1'),
			'/admin/respond/add/(\d+)/edit/(\d+)/'		=> array('moduleName' => 'admin/AdminRespondAddPage', 'moduleType' => 'module', 'page' => '$1', 'action' => 'edit', 'id' => '$2'),
                    
                    
                        ///популярные товары
                        '/admin/popular_product/list/'						=> array('moduleName' => 'admin/AdminPopularProductListPage', 'moduleType' => 'module'),
                        '/admin/buy_product/list/'						=> array('moduleName' => 'admin/AdminBuyProductListPage', 'moduleType' => 'module'),
			/* DEVELOPER CODE  */
			
			
			

		);
	}

	function getResoursePath($path){
		foreach ($this->resourceMap as $url => $resource) {  		
			if (preg_match("~^{$url}$~u", $path, $matches)) {
				return array(
					'resource' => $resource,
					'matches' => $matches
				);
			}
		}
		return false;
	}

	function dispatch(){
		$url = $this->httpRequest->url->getPath();
		if (strlen($url) > 0) {
			if ((substr($url, strlen($url) - 1)) != '/' ) {
				$url .= '/';
			}
		}

	    $resourceInfo = $this->getRequestedResource($url);

		if ($resourceInfo === false) {
			$resource = array('moduleName' => 'common/404error.tpl', 'moduleType' => 'template');
			$matches = array();
		} 
		else {
			$resource = $resourceInfo['resource'];
			$matches = $resourceInfo['matches'];
		}

		foreach ($resource as $key => $value) {
			foreach ($matches as $num => $replaceValue) {
				$replaceValue = urldecode($replaceValue);
				$value = str_replace('$' . $num, $replaceValue, $value);
			}
			$this->httpRequest->setValue($key, $value);
		}
		// run module

		switch ($resource['moduleType']) {
			case 'module':
				$moduleName = $resource['moduleName'];
				$this->includeModule($moduleName);
				$moduleClass = end(explode('/', $moduleName));
		
				$module = new $moduleClass($this->httpRequest, $this->httpResponse);
				return $module;
				// check access
		       break;
			case 'template':
				//To my mind, should be this one
				include_once("templatemodule/TemplateRunner.class.php");
				$template = new TemplateRunner($resource['moduleName'], $this->httpRequest, $this->httpResponse);
		  		return $template;
		}
	}

	function handleError404() {
		$this->httpResponse->redirect("/404/");
	}

	function includeModule($moduleName) {
		include_once("module/{$moduleName}.class.php");
	}

	function getRequestedResource($path) {
		// parse url here and return page modules
		// $path = $this->httpRequest->url->getPath();
		$mod_array = $this->getResoursePath($path);
		if (isset($mod_array)) {
			return  $mod_array;
		}
		else {
			return array('moduleName' => 'common/404error.tpl', 'moduleType' => 'template'); // 404 error
		}
	}	

	function handleAccessError() {
		$this->httpResponse->redirect("/");
	}
}

?>