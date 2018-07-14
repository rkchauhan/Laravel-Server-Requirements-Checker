<?php

require_once 'app/Laravel.php';

$version = (isset($_POST['v']) && !empty($_POST['v'])) ? $_POST['v'] : null;

$laravel = new Laravel($version);
$requirements = $laravel->getRequirements();

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
			
			<div class="row">
				<div class="col s12">
					<div class="card">
						<div class="card-content">
							<span class="card-title center">
								Laravel Version <a href="https://laravel.com/docs/<?php echo $laravel->getVersion(); ?>"><?php echo $laravel->getVersion(); ?></a>
							</span>
							
							<?php if(!empty($laravel->version_notice)) : ?>
								<div class="row">
									<div class="col s12">
										<blockquote>
											<?php echo $laravel->version_notice; ?>
										</blockquote>
									</div>
								</div>
							<?php endif; ?>
							
							<div class="row">
								<div class="col s12">
									<table class="responsive-table">
										<thead>
											<tr>
												<th>Requirement</th>
												<th class="right-align">Compatible</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach($requirements as $requirement): ?>
												<tr>
													<td><?php echo $requirement['requirement']; ?></td>
													<td class="right-align">
														<?php if($requirement['compatible']) : ?>
															<span class="green-text darken-4"><i class="material-icons dp48">check</i></span>
														<?php else : ?>
															<span class="red-text darken-4"><i class="material-icons dp48">close</i></span>
														<?php endif; ?>
													</td>
												</tr>
											<?php endforeach; ?>
										</tbody>
									</table>
								</div>
							</div>
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
</body>
</html>