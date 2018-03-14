<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>UFR-MATH INFO</title>
		<link rel="stylesheet" href="css/mi_css.css"/>
	</head>

	<body>
		<div id="page">
			<?php
				include("prototypes/header.html");
			?>

			<?php
				function lireDossier($doss)
				{
					$echg=true;
					echo '<ul>';
					if($dossier = opendir($doss))
					{
						while(false !== ($fichier = readdir($dossier)))
						{
							if($fichier != '.' && $fichier != '..')
								{
									
									if(is_dir($doss.'/'.$fichier))
									{
										echo '<strong>'.$fichier.'</strong>';
										lireDossier($doss.'/'.$fichier);
									}
									else
									{
										if($echg)
										{
											echo '<li ><a style="color:rgb(111,0,55);" href="'.$doss .'/'. $fichier . '">' . $fichier . '</a></li>';
											$echg=false;
										}
										else
										{
											echo '<li ><a style="color:rgb(22,241,231);" href="'.$doss .'/'. $fichier . '">' . $fichier . '</a></li>';
											$echg=true;
										}
										
										
									}
								}
							
						}
					}
					echo '</ul><br />';
				}
			?>

			<section id="main_section">
				<div id="texte_zone">
					<p>
						<div id="div_float">
											<ul>
												<li><a href="espaceetudiant.php">Index</a></li>
												<li><a href="cours.php">Cours</a></li>
												<li><a href="exercices.php">Exercices</a></li>
											</ul>
										</div>
						<h1>Téléchargement de cours</h1><br>

						<?php
							lireDossier('files/cours');
						?>
					</p>


				</div>
				
				
			</section>

			<?php
				include("prototypes/aside.html");
			?>

			<?php
				include("prototypes/footer.html");
			?>
		</div>
	</body>
	
</html>