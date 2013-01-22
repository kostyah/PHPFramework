<?php

	echo "Home";
	
	echo "<h1>List of recipes</h1>";
	
	$listRecipes = Recipe::getListRecipe();
	
	echo "<div>";
	foreach( $listRecipes as $recipe ){
		echo "<span>". var_dump( $recipe ) ."</span>";
	}
	echo "</div>";
?>