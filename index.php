<?php

require_once 'app/Laravel.php';

$laravel = new Laravel();
$laravel_versions = $laravel->getVersions();
rsort($laravel_versions);

?>
<!DOCTYPE html>
<html lang="en">
<head>

	<?php include_once 'includes/head.php'; ?>
	
</head>
<body>
	<?php include_once 'includes/navbar.php'; ?>
	
	<div class="section no-pad-bot">
		<div class="container">
			<br><br>
			
			<?php include_once 'includes/logo.php'; ?>
			
			<div class="row center">
				<div class="col s12">
					<div class="card">
						<div class="card-content">
							<span class="card-title">
								Laravel Server Requirements Checker
							</span>
							<br>
							<form action="results.php" method="POST">
								<div class="row">
									<div class="input-field col s12 m6 offset-m3">
										<select id="version" name="v">
											<option disabled selected>Select Version...</option>
											<?php foreach($laravel_versions as $versions): ?>
												<option value="<?php echo $versions ?>"><?php echo $versions ?></option>
											<?php endforeach; ?>
										</select>
										<label>Laravel Version</label>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			
			<?php include_once 'includes/copyright.php'; ?>
		</div>
	</div>
	
	<script src="asset/js/jquery-3.3.1.min.js"></script>
	<script src="asset/js/materialize.min.js"></script>
	<script src="asset/js/app.js"></script>
	<script>
		$('select#version').on('change', function() {
			$(this).closest('form').trigger('submit');
		});
	</script>
</body>
</html>