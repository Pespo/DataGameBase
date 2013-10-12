<?php echo  form_open_multipart('game_manager/add_game')?>
	<div class="game">
		<div class="title">
			<label for="logo">Titre : </label>
			<input type="file" name="logo"/>
		</div>
		<div class="info">
			<ul>
				<li>
					<label for="title"> Jeu : </label> <br>
					<input type="text" name="title" value="<?php echo set_value('title'); ?>" />
					<?php echo form_error('title'); ?>
				</li>
				<li>
					<label for="genres"> Genre : </label>
					<input id="genres" type="text" name="genres" value="<?php echo set_value('genres'); ?>" />
					<?php echo form_error('genres'); ?>
				</li>
				<li>
					<label for="publishers"> Editeur : </label>
					<input id="publishers" type="text" name="publishers" value="<?php echo set_value('publishers'); ?>" />
					<?php echo form_error('publishers'); ?>
				</li>
				<li>
					<label for="developers"> Developpeur : </label>
					<input id="developers" type="text" name="developers" value="<?php echo set_value('developers'); ?>" />
					<?php echo form_error('developers'); ?>
				</li>
				<li>
					<label for="universes"> Univers : </label>
					<input id="universes" type="text" name="universes" value="<?php echo set_value('universes'); ?>" />
					<?php echo form_error('universes'); ?>
				</li>
				<li>
					<label for="console"> Console : </label><br>
					<select id="console" type="text" name="console" >
							<option selected value="">Choisir</option>
						<?php foreach($consoles as $console) : ?>
							<option <?php if($console->id == set_value('console')) echo 'selected'; ?> value="<?php echo $console->id; ?>"><?php echo $console->nom; ?></option>
						<?php endforeach; ?>
					</select>
					<?php echo form_error('console'); ?>
				</li>
				<li>
					<input type="checkbox" name="boite" id="boite" checked /> <label for="boite">Boite</label>
					<input type="checkbox" name="manuel" id="manuel" checked  /> <label for="manuel">Manuel</label><br />
				</li>
			</ul>
		</div>
		<div class="cover">
			<label for="cover">Pochette : </label>
			<input type="file" name="cover"/>
		</div>
	</div>
 
    <input type="submit" value="Valider" />
<?php echo form_close();?>


<script>
	$(function() {
		var availableGenres = [ <?php foreach($genres as $genre) echo '"'.$genre->nom.'",'; ?> ];
		var availableEditeurs = [ <?php foreach($publishers as $publisher) echo '"'.$publisher->nom.'",'; ?> ];
		var availableDeveloppeurs = [ <?php foreach($developers as $developer ) echo '"'.$developer->nom.'",'; ?> ];
		var availableUnivers = [ <?php foreach($universes as $universe) echo '"'.$universe->nom.'",'; ?> ];
		
		function split(val) {
			return val.split(/,\s*/);
		}
		function extractLast(term) {
			return split(term).pop();
		}
		$("#genres")
		.bind("keydown", function(event) {
			if (event.keyCode === $.ui.keyCode.TAB &&
			$(this).data("ui-autocomplete").menu.active) {
				event.preventDefault();
			}
		})
		.autocomplete({
			minLength: 0,
			source: function(request, response) {
				response($.ui.autocomplete.filter(availableGenres, extractLast(request.term)));
			},
			focus: function() {
				return false;
			},
			select: function(event, ui) {
				var terms = split(this.value);
				terms.pop();
				terms.push(ui.item.value);
				terms.push("");
				this.value = terms.join(", ");
				return false;
			}
		});
		$("#publishers")
		.bind("keydown", function(event) {
			if (event.keyCode === $.ui.keyCode.TAB &&
			$(this).data("ui-autocomplete").menu.active) {
				event.preventDefault();
			}
		})
		.autocomplete({
			minLength: 0,
			source: function(request, response) {
				response($.ui.autocomplete.filter(availableEditeurs, extractLast(request.term)));
			},
			focus: function() {
				return false;
			},
			select: function(event, ui) {
				var terms = split(this.value);
				terms.pop();
				terms.push(ui.item.value);
				terms.push("");
				this.value = terms.join(", ");
				return false;
			}
		});
		$("#developers")
		.bind("keydown", function(event) {
			if (event.keyCode === $.ui.keyCode.TAB &&
			$(this).data("ui-autocomplete").menu.active) {
				event.preventDefault();
			}
		})
		.autocomplete({
			minLength: 0,
			source: function(request, response) {
				response($.ui.autocomplete.filter(availableDeveloppeurs, extractLast(request.term)));
			},
			focus: function() {
				return false;
			},
			select: function(event, ui) {
				var terms = split(this.value);
				terms.pop();
				terms.push(ui.item.value);
				terms.push("");
				this.value = terms.join(", ");
				return false;
			}
		});
		$("#universes")
		.bind("keydown", function(event) {
			if (event.keyCode === $.ui.keyCode.TAB &&
			$(this).data("ui-autocomplete").menu.active) {
				event.preventDefault();
			}
		})
		.autocomplete({
			minLength: 0,
			source: function(request, response) {
				response($.ui.autocomplete.filter(availableUnivers, extractLast(request.term)));
			},
			focus: function() {
				return false;
			},
			select: function(event, ui) {
				var terms = split(this.value);
				terms.pop();
				terms.push(ui.item.value);
				terms.push("");
				this.value = terms.join(", ");
				return false;
			}
		});
	});
</script>
