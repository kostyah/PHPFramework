<?php


/** 
 * Class Link
 * Handles an HTMLLink
 */

class Link {
	
	protected $linkParams;
	protected $title;
	protected $htmlId;
	protected $message;
	protected $href;
	
	protected $htmlAttributes = array();
	protected $cssClass = array();
	
	/**
	 * Constructor Link
	 * @param string $message
	 * @param array $linkParams
	 * @param string $htmlId
	 * @param $title
	 * @return Link $this
	 */
	public function __construct( $message = '', $linkParams = array(), $htmlId = '', $title = '' ){
		$this->message = $message;
		$this->linkParams = $linkParams;
		$this->htmlId = $htmlId;
		$this->title = $title;
		return $this;
	} 
	
	/**
	 * Html value of link
	 * @return $htmlContent
	 */
	public function getHtml(){
		$htmlContent = '<a ';
		
		if( $this->title != '' ) {
			$htmlContent .= ' title="'.$this->title.'" ';
		}

		if( $this->htmlId != '' ) {
			$htmlContent .= ' id="'.$this->htmlId.'" ';
		}

		$htmlContent .= $this->getStrCssClasses();
		$htmlContent .= $this->getStrHtmlAttributes();
		$htmlContent .= ' href="'.$this->getUrlRewrited().'" ';
		$htmlContent .= '>'.$this->message.'</a>';

		return $htmlContent;
	}
	
	/**
	 * Setter message
	 * @param string $message
	 * @return HtmlLink $this
	 */
	public function setMessage( $message ) {
		$this->message = $message;
		return $this;
	}
	
	/**
	 * Setter href
	 * @param string $href
	 * @return HtmlLink $this
	 */
	public function setHref( $href ) {
		$this->href = $href;
		return $this;
	}
	
	/**
	 * Setter title
	 * @param string $title
	 * @return HtmlLink $this
	 */
	public function setTitle( $title ) {
		$this->title = $title;
		return $this;
	}
	
	/**
	 * Add a new link param
	 * @param string $paramKey
	 * @param string $paramVal
	 * @return HtmlLink $this
	 */
	public function addLinkParam( $paramKey, $paramVal ) {
		$this->linkParams[$paramKey] = $paramVal;
		return $this;
	}
	
	/**
	 * Setter html id
	 * @param string $htmlId
	 * @return HtmlLink $this
	 */
	public function setHtmlId( $htmlId ) {
		$this->htmlId  = $htmlId;
		return $this;
	}
	
	/**
	 * Add any html attribute to the form element
	 * @param string $attribute
	 * @param string $value
	 * @return HtmlLink $this
	 */
	public function addHtmlAttribute( $attribute, $value ) {
		if( !isset($this->htmlAttributes[$attribute] ) ) {
			$this->htmlAttributes[$attribute] = $value;
		} else {
			throw new Exception( "Error, already defined attribute", -1 );
		}
		return $this;
	}
	
	/**
	 * Allows to add html attributes on input element ( as max="truc" ) Pattern : key = tag, value = value
	 * @param array $allValues
	 * @return HtmlLink $this
	 */
	public function addHtmlAttributes( $allValues ) {
		if( is_array( $allValues ) ) {
			foreach( $allValues as $tag => $value ) {
				$this->addHtmlAttribute( $tag, $value );
			}
		}
		return $this;
	}
	
	/**
	 * Setter css class
	 * @param mixed $cssClass (string/array)
	 * @return HtmlLink $this
	 */
	public function addCssClass( $cssClass ) {
		if( is_array($cssClass) ) {
			foreach( $cssClass as $myClass ) {
				$this->cssClass[] = $myClass;
			}
		} else {
			$this->cssClass[] = $cssClass;
		}
		return $this;
	}
	
	/**
	 * Prepares string including all css classes in the array
	 * @return string $str
	 */
	protected function getStrCssClasses() {
		$str = '';
		if( count($this->cssClass) > 0 ) {
			$str = ' class="';
			foreach( $this->cssClass as $cssClass ) {
				$str .= ' '.$cssClass;
			}
			$str .= '"';
		}
		return $str;
	}
	
	/**
	 * Prepares string including all html attributes
	 * @return string $strHtmlAttributes
	 */
	protected function getStrHtmlAttributes() {
		$str = '';
		if( count($this->htmlAttributes) > 0 ) {
			foreach( $this->htmlAttributes as $tag => $value ) {
				$str .= ' '.$tag.'="'.$value.'" ';
			}
		}
		return $str;
	}
	
	
	/**
	 * Magic Method Returns the html (allows to echo the current object)
	 * @return string $htmlContent
	 */
	public function __toString() {
		return $this->getHtml();
	}
	
	/**
	 * Generates url link
	 * @return string $htmlUrlRewrited
	 */
	protected function getUrlRewrited() {
		if( strlen($this->href) > 0 ) {
			return $this->href;
		}
	
		$attrs = '';
		if( count($this->linkParams) > 0 ) {
			$cpt = 0;
			foreach( $this->linkParams as $paramKey => $paramValue ) {
				$attrs .= ( $cpt > 0 ? "&" : "" ).$paramKey."=".$paramValue;
				$cpt++;
			}
			$rewritedUrl = 'page.php?'.$attrs;
		} else {
			$rewritedUrl = "#";
		}
	
		return $rewritedUrl;
	}
	
}