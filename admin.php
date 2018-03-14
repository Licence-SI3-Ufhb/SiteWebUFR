<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<meta charset="latin1_swedish_ci"/>
		<title>UFR-MATH INFO</title>
		<link rel="stylesheet" href="css/mi_css.css"/>
		<link rel="stylesheet" type="text/css" href="css/admin_css.css">
	</head>
	<?php
		function printAdmin($nom,$prenom,$titre,$bureau,$role,$email,$pathImg)
		{
			echo '<div class="admin_div">
					  <figure class="admin_img"><img class="img_admin" src="'.$pathImg.'" alt="image du Doyen" ></figure> 
					  <h1 class="h1Leger" >'.$nom.' '.$prenom.'</h1>
					  <p>
					  	Titre: '.$titre.'<br>
					  	Bureau: '.$bureau.'<br>
					  	Rôle: '.$role.'<br><br><br>
					  	E-mail: <a href="mailto:'.$email.'">'.$email.'</a>
					  </p>
					</div>';
		}

		try
		{
			$bdd=new PDO('mysql:host=localhost;dbname=ufrmi','root','ValiDiom001');
		}
		catch (Exception $e)
		{
			die('Erreur'.$e->getMessage());
		}
	?>

	<body>
		<div id="page">
			<?php
				include("prototypes/header.html");

				$table_Admin=$bdd->query('select * from Personnel');	

			?>

			<section id="main_section">
				<?php
					
					while ($data=$table_Admin->fetch()) {
						printAdmin($data['Nom'],$data['Prenoms'],$data['Titre'],$data['Bureau'],$data['Role'],$data['Contacts'],$data['PathImg']);
					}
				?>
				<!--<div id="texte_zone">
					<div class="admin_div">
					  <figure class="admin_img"><img src="#" alt="image du Doyen" ></figure> 
					  <h1>Assohoun ADJE</h1>
					  <p>
					  	Titre: Doyen<br>
					  	Bureau: X<br>
					  	Rôle: le Doyen a pour rôle de X<br>
					  	E-mail: ooo@pp.q
					  </p>
					</div>

					<div class="admin_div">
					  <figure class="admin_img"><img src="#" alt="image du Vice-Doyen" ></figure> 
					  <h1>Nom du Vice-Doyen</h1>
					  <p>
					  	Titre: Vice-Doyen<br>
					  	Bureau: X<br>
					  	Rôle: le Doyen a pour rôle de X<br>
					  	E-mail: ooo@pp.q
					  </p>
					</div>
					<div class="admin_div">
					  <figure class="admin_img"><img src="#" alt="image du Doyen" ></figure> 
					  <h1>Nom du Directeur Général</h1>
					  <p>
					  	Titre: Directeur Général<br>
					  	Bureau: X<br>
					  	Rôle: le Doyen a pour rôle de X<br>
					  	E-mail: ooo@pp.q
					  </p>
					</div>

					<div class="admin_div">
					  <figure class="admin_img"><img src="#" alt="image Scretaire Principal" ></figure> 
					  <h1>Nom du SP</h1>
					  <p>
					  	Titre: Secrétaire Principal<br>
					  	Bureau: X<br>
					  	Rôle: le Doyen a pour rôle de X<br>
					  	E-mail: ooo@pp.q
					  </p>
					</div>
					<div class="admin_div">
					  <figure class="admin_img"><img src="#" alt="image Prof" ></figure> 
					  <h1>Nom du Prof</h1>
					  <p>
					  	Titre: Professeur de X<br>
					  	Statut: Titulaire de cours X<br>
					  	Bureau: X<br>
					  	Rôle: le Doyen a pour rôle de X<br>
					  	E-mail: ooo@pp.q
					  </p>
					</div>

				</div>-->
				
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