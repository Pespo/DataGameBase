<div id="games_list">
<?php
	foreach($games as $game):
?>
	<div class="game">
		<div class="title">
			<a href="<?php echo site_url("game/index/{$game->id}") ?>"><img src="<?php echo img_url('jeux', $game->title); ?>/logo_s.png" /></a>
		</div>
		<div class="info">
			<!-- <span class="nom"><?php echo $game->title; ?></span>-->
			<ul>
				<li> Genre : </br>
					<span class="info genre"><?php echo $game->genres; ?></span>
				</li>
				<li> Editeur : </br>
					<span class="info editeur"><?php echo $game->publishers; ?></span>
				</li>
				<li> Développeur : </br>
					<span class="info developpeur"><?php echo $game->developers; ?></span>
				</li>
				<li> Univers : </br>
					<span class="info univers"><?php echo $game->universes; ?></span>
				</li>
				<li> Console : </br>
					<span class="info console"><?php echo $game->console; ?></span>
				</li>
			</ul>
		</div>
		<div class="cover">
			<img class="cover" src="<?php echo img_url('jeux', $game->title); ?>/cover_m.png" />
		</div>	
		<?php if(!$game->personne) { ?>
		<p class="available"> Disponible</p>
		<?php } else { ?>
		<p class="unavailable"> Non-disponible</p>
		<?php } ?>
		
	</div>
		
<?php 
	endforeach; 
?>
</div>