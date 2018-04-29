<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
	<div class="container">
		<a class="navbar-brand" href="#"><strong>Veranstaltungsservice</strong></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNavDropdown">
			<ul class="navbar-nav">
				<?php
					// Define each name associated with an URL
					$urls = array(
						'Events' => 'index.php',
						'Admin' => 'admin.php'
					);

					foreach ($urls as $name => $url) {
						print '<li '.(($currentPage === $name) ? ' class="nav-item active" ': 'nav-item').'><a class="nav-link" href="'.$url.'">'.$name.'</a></li>';
					}
				?>
			</ul>
		</div>
	</div>
</nav>
