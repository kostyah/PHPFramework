<?php

	/**
	 * Pages management class
	 */
class Page {
	const NO_TEMPLATE_MSG = 		"This page does not exist";
	const TEMPLATE_EXTENSION = 		'.tpl.php';
	
	const DEFAULT_RUBRIC_ID = 		1;
	const DEFAULT_TEMPLATE_NAME =   "home";
	
	const RECIPE_DISPLAY =	2;
	
	
	/** HERE ALL RUBRIC ID'S
	 * Example : 
	 *
	 * const RECIPES			=	2
	 * 
	 * Must have an entry in database of id 2
	 * 
	 */

	private static $templatePathes = array( TEMPLATES_INC );
	
	protected static $instance;
	
	protected $id;
	protected $templateName;
	protected $pageTitle;
	
	/**
	 * Tells if a script is executed in Ajax or not
	 * @return isAjaxRequest
	 */
	public static function isAjaxRequest() {
		return ( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && $_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest" ); 
	}
	
	/**
	 * Returns an instance of Page
	 * @return Page page
	 */
	public static function getInstance() {
		if( !isset(self::$instance) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}
	
	/**
	 * Page constructor
	 */
	protected function __construct() {
		$this->selectTemplateName();
		$this->processPageTitle();
	}
	
	/**
	 * Generates html
	 */
	public function toHtml() {
		$mainContent = $this->makeHtmlContent();
		$this->getHeaderHtml();
		echo $mainContent;
		$this->getFooterHtml();
	}
	
	/**
	 * Accessor id (rubric)
	 * @return int $id
	 */
	public function getId() {
		return $this->id;
	}
	
	/**
	 * Gets page Title ( PAGE_TITLE )
	 * @return string $pageTitle
	 */
	public function getPageTitle() {
		return $this->pageTitle;
	}
	
	/**
	 * Accessor template name
	 * @return string $templateName
	 */
	public function getTemplateName() {
		return $this->templateName;
	}
	
	/**
	 * Returns template name from id (rubric)
	 * url shall be built : page.php?id={id}
	 */
	protected function selectTemplateName() {
		if( isset($_GET['id']) ) {
			$this->id = $_GET['id'];
		} else {
			$this->id = self::DEFAULT_RUBRIC_ID;
		}
		// Retrieve template from Db
		$templateName = $this->getTemplateNameFromDb();
		
		$this->setTemplateName( $templateName );
	
	}
	
	/**
	 * Sets template name
	 * @param string $tplName template name
	 */
	public function setTemplateName( $tplName ) {
		$this->templateName = $tplName;
	}
	
	
	/**
	 * Gets template from database
	 * @return string $templateName
	 */
	//@TODO get template from database
	//Requires Rubric table in database
	
	protected function getTemplateNameFromDb() {
	
		$query = 'SELECT template.name FROM template AS template
		INNER JOIN rubric AS rubric
		ON rubric.template_id = template.id
		WHERE rubric.id = '.$this->id;
		
		$result = Db::getInstance()->getRow( $query );
		
		if( $result !== false ) {
			return $result['name'];
		}
	
		return false;
	}
	
	
	
	/**
	 * Creates the page title
	 * @TODO : Pattern : " PAGE_TITLE / TEMPLATE_NAME "
	 */
	protected function processPageTitle() {
		$this->pageTitle = PAGE_TITLE." / ".$this->templateName;
	}
	
	/**
	 * includes header
	 */
	protected function getHeaderHtml() {
		include LAYOUTS_INC."header.php";
	
	}
	
	/**
	 * includes footer
	 */
	protected function getFooterHtml() {
		include LAYOUTS_INC."footer.php";
	}
	
	/**
	 * Creates html from template
	 * @return string $htmlContent
	 */
	protected function makeHtmlContent() {
		$pathFile = TEMPLATES_INC;
		$fileName = $this->templateName.'.tpl.php';
	
		ob_start();
	
		if( is_file( $pathFile.$fileName ) ) {
			include( $pathFile.$fileName );
		} else {
			?>
	<br /><h3><?php echo self::NO_TEMPLATE_MSG ?></h3><br /><br /><br />
	<?php
	}
	$htmlContent = ob_get_contents();
	ob_end_clean();
	return $htmlContent;
	}
	
	/**
	 * Tests if a page is of type admin
	 */
	protected function isAdmin(){
		//@TODO : Decide how the back-office will be designed
		return 0;	
	}
}
?>