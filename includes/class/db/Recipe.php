<?php

class Recipe { 

	
	 public static $TB_NAME = 'recipe';
	
	 protected $id;
	 protected $name;
	 protected $preparationTime;
	 protected $bakingTime;
	 protected $difficulty;
	 protected $description;
	 protected $typeRecipeId;
	 protected $isPublished;
	 protected $userId;
	 protected $dateCreation;
	 
	 
	 /**
	  * Recipe constructor
	  * @param int $id
	  * @param string $name
	  * @param int $preparationTime
	  * @param int $bakingTime
	  * @param int $difficulty
	  * @param string $description
	  * @param int $typeRecipeId
	  * @param int $isPublished
	  * @param int $userId
	  * @param datetime $dateCreation
	  * @return Recipe int
	  */
	public function __contruct( $id, $name, $preparationTime, $bakingTime, $difficulty, $description, $typeRecipeId, $isPublished, $userId, $dateCreation ){
		$this->id = $id;
		$this->name = $name;
		$this->preparationTime = $preparationTime;
		$this->bakingTime = $bakingTime;
		$this->difficulty = $difficulty;
		$this->description = $description;
		$this->typeRecipeId = $typeRecipeId;
		$this->isPublished = $isPublished;
		$this->userId = $userId;
		$this->dateCreation = $dateCreation;
		
		return $this;
	}
	 
	/** 
	 * returns a Recipe with it id
	 * @param int $id
	 * @return Recipe recipe
	 */
	public static function getRecipe( $id ){
		$result = Db::getInstance()->getRow( 'SELECT * FROM '. self::$TB_NAME.' WHERE id= '. $id );
		
		if( $result !== false ){
			return $result;
		}
		
		return false;
	}
	
	/**
	 * Returns a list of recipes 
	 * 
	 */
	public static function getListRecipe( $categoryId = "" ){
		$query = 'SELECT * FROM recipe';
		
		$result = Db::getInstance()->getRows( $query );
		
		if( $result !== false && count( $result ) > 0 ){
			return $result;
		}
		
		return false;
	}
	
} 

?>