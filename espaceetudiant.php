
<?php
	session_start();
	if(!isset($_SESSION['connected']))
	{
		$_SESSION['connected']=false;
	}

	$_SESSION['byEE']=true;

	$con='connected';
	$nom='nom';
	$prenom='prenom';
	$matr='matr';
	$psd='pseudo';
	$fil='filiere';
	$email='email';
	$mdp1='mdp1';
	$mdp2='mdp2';
	$matrCon='matrCon';
	$mdpCon='mdpCon';
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>UFR-MATH INFO</title>
		<link rel="stylesheet" href="css/mi_css.css"/>
		<link rel="stylesheet" type="text/css" href="css/espaceetudiant_css.css">
	</head>

	<body>
		<div id="page">
			<?php
				include("prototypes/header.html");
			?>

			
					<?php
						if (isset($_POST['deconnexion'])) {
							$_SESSION[$con]=false;

						}
						if(!(isset($_SESSION[$con])))
						{
							header('Location: inscription.php');
						}
						else
						{
							if (!$_SESSION[$con]) {
								header('Location: inscription.php');
							}
							else
							{?>
								<section id="main_section">
									<div id="texte_zone">
										<div id="info_perso">
											<?php
												echo '<span class="libele_info_perso"> Pseudo :</span> <span class="text_info_perso">'.$_SESSION[$psd].'</span><br>';
												echo '<span class="libele_info_perso"> Matricule :</span> <span class="text_info_perso">'.$_SESSION[$matr].'</span><br>';
												echo '<span class="libele_info_perso"> Nom :</span> <span class="text_info_perso">'.$_SESSION[$nom].'</span><br>';
												echo '<span class="libele_info_perso"> Prenoms :</span> <span class="text_info_perso">'.$_SESSION[$prenom].'</span><br>';
											?>
										</div>
										<div id="div_float">
											<ul>
												<li><a href="espaceetudiant.php">Index</a></li>
												<li><a href="cours.php">Cours</a></li>
												<li><a href="exercices.php">Exercices</a></li>
											</ul>
										</div>
										<div id="text_ee">
											<p>Connexion avec succès, vous pouvez maintenant télécharge vos cours et exercices</p>
										</div>

										<form method="post" action="espaceetudiant.php">
											<input type="submit" name="deconnexion" value="DECONNEXION">
										</form>
									</div>
				
								</section>

								<?php
									include("prototypes/aside.html");
								?>

								<?php
									include("prototypes/footer.html");
								?>
							
							<?php
							}
						}
					?>
		</div>
	</body>
	
</html>