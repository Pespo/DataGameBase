<div id="users_list">
<?php
	foreach($users as $user):
?>
	<div class="user">
		
		<div class="info">
			<div class="photo">
				<img class="photo" src="<?php echo img_url('users', $user->id); ?>/cover_m.png" />
			</div>	
			<ul>
				<li> Nom : </br>
					<span class="info name"><?php echo $user->name; ?></span>
				</li>
				<li> Prénom : </br>
					<span class="info firstname"><?php echo $user->firstname; ?></span>
				</li>
				<li> Surnom : </br>
					<span class="info pseudo"><?php echo $user->pseudo; ?></span>
				</li>
				<li> Téléphone : </br>
					<span class="info phone"><?php echo $user->phone; ?></span>
				</li>
				<li> eMail : </br>
					<span class="info email"><?php echo $user->email; ?></span>
				</li>
			</ul>
		</div>	
	</div>
		
<?php 
	endforeach; 
?>
</div>