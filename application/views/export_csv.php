<div id="games_list">
<?php
	$index = '{"index":{"_index":"jeux","_type":"jeux","_id":';
	foreach($games as $game):
		echo $index . $game->id . '"}}'."\n";		
		echo '{"nom":"'.$game->title.'",'; 
		echo '"genre":"'.$game->genres.'",'; 
		echo '"editeur":"'.$game->publishers.'",'; 
		echo '"developpeur":"'.$game->developers.'",'; 
		echo '"univers":"'.$game->universes.'",'; 
		echo '"console":"'.$game->console.'"}'."\n"; 
	endforeach; 
?>
</div>