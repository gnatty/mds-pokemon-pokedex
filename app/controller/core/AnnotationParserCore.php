<?php

namespace App\Controller\Core;

Class AnnotationParserCore {

  /**
   * @expected 
   * @<attr>
   * @<attr>(<name>="<value>")
   * @<attr>(<name>="<value>", <name>="<value>", <name>="<value>")
   */
  const REGEX_PARSER = '/(@(?<attr>[\w]+))|((?<name>[\w]+)="(?<value>[\w]+)"[, ]?)/';

  /**
   * Class name 
   */
  private $_className;

  /**
   * ReflectionClass object
   */
  private $_classReflector;

  /**
   * Is the class name exist
   */
  private $_isClassFound = false;

  /**
   * Array(
   *  'class' => [],
   *  'properties' => [],
   *  'methods' => []
   * )
   */
  private $_comments = [];

  public function __construct($className) {
    $this->_className = $className;
    $this->init();
  }

  public function getClassName() {
    return $this->_className;
  }
  public function getIsClassFound() {
    return $this->_isClassFound;
  }
  public function setIsClassFound($state) {
    $this->_isClassFound = $state;
  }
  public function getClassReflector() {
    return $this->_classReflector;
  }
  public function setClassReflector($classReflector) {
    $this->_classReflector = $classReflector;
  }
  public function setComment($name, $data) {
    $this->_comments[ $name ] = $data;
  }
  public function getComments() {
    return $this->_comments;
  }
  public function getCommentsProperties() {
    return $this->getComments()['properties'];
  }
  public function getCommentsMethods() {
    return $this->getComments()['methods'];
  }
  public function getCommentsClass() {
    return $this->getComments()['class'];
  }
  public function getCommentsProperty($propertyName, $commentName = null) {
    return $this->getCommentsSpecific(
      $this->getCommentsProperties(), $propertyName, $commentName);
  }
  public function getCommentsMethod($methodName, $commentName = null) {
    return $this->getCommentsSpecific(
      $this->getCommentsMethods(), $methodName, $commentName);
  }

  public function getCommentsSpecific($type, $name, $commentName = null) {
    switch(true) {
      case empty($type[$name]):
        return null;
      break;
      case is_null($commentName):
        return $type[$name];
      break;
      case !empty($type[$name][$commentName]);
        return $type[$name][$commentName];
      break;
      default:
        return null;
    }
  }

  /**
   * INIT
   */
  public function init() {
    try {
      $classReflector = new \ReflectionClass($this->getClassName());
      $this->setClassReflector($classReflector);
      $this->setIsClassFound(true);
      $this->initComment('class', $this->getClassReflector()->getDocComment());
      // $this->initComment('constants', $this->getClassReflector()->getConstants());
      $this->initComment('properties', $this->getClassReflector()->getProperties());
      $this->initComment('methods', $this->getClassReflector()->getMethods());
    } catch(\Exception $e) {
      // --- TODO : no class found handler.
    }
  }

  public function filterBlankData($val) {
    return !empty($val);
  }

  /**
   * PARSE COMMENT.
   */
  public function parseComment($comment) {
    $response = [];
    $res = preg_match_all(self::REGEX_PARSER, $comment, $ouput);

    $attr = $ouput['attr'];
    $name = $ouput['name'];
    $value = $ouput['value'];

    // --- attribut
    if( empty($attr) ) {
      return null;
    }
    $attr = array_values( array_filter($attr) );

    // --- Name
    if( !empty($name) ) {
      $curKey;
      $i = -1;
      foreach ($name as $index => $val) {
        if( empty($val) ) {
          $i++;
          $curKey = $attr[0];
          unset($attr[0]);
          $attr = array_values($attr);
          $response[$i][ $curKey ] = [];
          continue;
        } 
        $n = $val;
        $v = !empty($value[$index]) ? $value[$index] : null;
        $response[$i][$curKey][$n] = $v;
      }
    }
    return $response;
  }

  /**
   *  INIT COMMENTS.
   */
  public function initComment($field, $data) {
    $response = [];
    // -- no data
    if( empty($data) ) {
      $this->setComment($field, null);
      return true;
    }

    // -- single comment
    if( !is_array($data) ) {
      $this->setComment($field, $this->parseComment($data));
      return true;
    }

    // multi data
    foreach ($data as $dataItem) {
      $name = $dataItem->getName();
      $comment = $dataItem->getDocComment();
      // -- if no comment
      if( empty($comment) ) {
        $response [ $name ] = null;
      }
      // -- if comment parse it
      $response [ $name ] = $this->parseComment($comment);
    }

    $this->setComment($field, $response);
  }

}