<?php

namespace Tools;


/**
 * Class FormGenerator
 * @package Tools
 */
class FormGenerator {

	public function initialize( $name, $class, $type, $value = null, $options = null ) {
		$this->setName( $name );
		$this->setClass( $class );
		$this->setValue( $value );
		$this->setOptions( $options );
		$this->setType( $type );
	}

	private $_generatedElement;

	public $name;
	public $class;
	public $typeElement;
	public $type;
	public $value;
	public $options;

	/**
	 * @return mixed
	 */
	public function getOptions() {
		return $this->options;
	}

	/**
	 * @param mixed $options
	 */
	public function setOptions( $options ) {
		$this->options = $options;
	}


	/**
	 * @return mixed
	 */
	public function getValue() {
		return $this->value;
	}

	/**
	 * @param mixed $value
	 */
	public function setValue( $value ) {
		$this->value = $value;
	}

	/**
	 * @return mixed
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * @param mixed $type
	 */
	public function setType( $type ) {
		if ( ! $type ) {
			throw new \Error( "Type can't be null" );
		}
		$this->type = $type;
	}

	/**
	 * @return mixed
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @param mixed $name
	 */
	public function setName( $name ) {
		$this->name = $name;
	}

	/**
	 * @return mixed
	 */
	public function getClass() {
		return $this->class;
	}

	/**
	 * @param mixed $class
	 */
	public function setClass( $class ) {
		$this->class = $class;
	}

	/**
	 * @return mixed
	 */
	public function getTypeElement() {
		return $this->typeElement;
	}

	/**
	 * @param mixed $typeElement
	 */
	public function setTypeElement( $typeElement ) {
		$this->typeElement = $typeElement;
	}

	//HTML ELEMENT
	static $input = 'input';
	static $select = 'select';
	static $option = 'option';

	//HTML PROPS
	static $checkbox = 'checkbox';
	static $radio = 'radio';
	static $hidden = 'hidden';
	static $text = 'text';
	static $password = 'password';
	//TAG HTML ELEMENT
	/**
	 * @var string
	 */
	private $tagInput = '<input>';
	/**
	 * @var string
	 */
	private $tagSelect = '<select>';
	/**
	 * @var string
	 */
	private $tagOption = '<option>';

	public function defineType() {
		$type = $this->getType();
		if ( $type == self::$text ||
		     $type == self::$checkbox ||
		     $type == self::$radio ||
		     $type == self::$hidden ||
		     $type == self::$password ) {
			return self::$input;
		}
		if ( $type == self::$select || $type == self::$option ) {
			return self::$select;
		}

	}
	//generate <input type="text"/>
	//generate <input type="checkbox"/>
	//generate <input type="radio"/>
	//generate <select><option></option></select>
	//generate <input type="checkbox"/>

	public function generate() {
		$elementHtml   = $this->defineType();
		$name          = $this->getName();
		$class         = $this->getClass();
		$type          = $this->getType();
		$value         = $this->getValue();
		$options       = $this->getOptions();
		$elementResult = null;
//	    @TODO clean code below
		if ( $elementHtml == self::$input ) {
			$elementResult = $name ? substr_replace( $this->tagInput, ' name="' . $name . '"', - 1, 0 ) : $elementResult;
			$elementResult = $class ? substr_replace( $elementResult ? $elementResult : $this->tagInput, ' class="' . $class . '"', - 1, 0 ) : $elementResult;
			$elementResult = $type ? substr_replace( $elementResult ? $elementResult : $this->tagInput, ' type="' . $type . '"', - 1, 0 ) : $elementResult;
			$elementResult = $value ? substr_replace( $elementResult ? $elementResult : $this->tagInput, ' value="' . $value . '"', - 1, 0 ) : $elementResult;
			$elementResult = $type ? substr_replace( $elementResult ? $elementResult : $this->tagInput, ' /', - 1, 0 ) : $elementResult;
		}
		if ( $elementHtml == self::$select ) {
			$elementResult = $name ? substr_replace( $this->tagSelect, ' name="' . $name . '"', - 1, 0 ) : $elementResult;
			$elementResult = $class ? substr_replace( $elementResult ? $elementResult : $this->tagInput, ' class="' . $class . '"', - 1, 0 ) : $elementResult;
			if ( is_array( $options ) ) {
				$generatedOptions = null;
				foreach ( $options as $option ) {
					$optionTag        = substr_replace( $this->tagOption, ' value="' . $option['value'] . '"', - 1, 0 );
					$optionCloseTag   = substr_replace( $this->tagOption, '/', 1, 0 );
					$optionTagName    = substr_replace( $optionCloseTag, $option['name'], 0, 0 );
					$generatedOptions .= $optionTag . $optionTagName;
				}
			}
			$selectCloseTag = substr_replace( $this->tagSelect, '/', 1, 0 );
			$elementResult = $elementResult.$generatedOptions.$selectCloseTag;
		}

		$this->_generatedElement = $elementResult;
	}

	//return a final result of element that already generated
	public function result() {
		$this->generate();
		return $this->_generatedElement;
	}

}

?>