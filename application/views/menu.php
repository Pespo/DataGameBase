<div class="menu">
	<ul>
		<li><a href="<?php echo site_url('game_manager'); ?>">home</a></li>
		<li><label for="order">Trier par : </label> <input id="order" name="order" type="text" ></li>
		<li>
			<?php echo  form_open_multipart('game_manager/show_search_list')?>
			<label for="search">Recherche : </label> <input id="search" name="search" type="text" ></li>
			<input type="submit" value="Valider" />
			<?php echo form_close();?>
		<li><a href="<?php echo site_url('game_manager/add_game'); ?>">add game</a></li>
		<li><a href="<?php echo site_url('game_manager/add_game'); ?>">add personne</a></li>
	</ul>
</div>

<div class="pre-list"> </div>
