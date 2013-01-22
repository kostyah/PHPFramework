<?php


	$recipeId = $_REQUEST['recipe_id'];

	var_dump( Recipe::getRecipe( $recipeId ) );
	
	


?> 