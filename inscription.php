
<?php
	session_start();
	if(!isset($_SESSION['connected']))
	{
		$_SESSION['connected']=false;

	}

	if (!isset($_SESSION['byEE'])) {
		$_SESSION['byEE']=false;
	}

	$con='connected';
	$nom='nom';
	$prenom='prenom';
	$matr='matr';
	$psd='pseudo';
	$niv='niv';
	$fil='filiere';
	$email='email';
	$mdp1='mdp1';
	$mdp2='mdp2';
	$matrCon='matrCon';
	$mdpCon='mdpCon';
	$valideCon='valideCon';
	$valideIns='valideIns';
	$valideMdp=false;
	$insertOK=false;

	$byee='byEE';


	$termValid=false;

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>UFR-MATH INFO->Inscription</title>
		<link rel="stylesheet" href="css/mi_css.css"/>
	</head>

	<body>
		<div id="page">

			<?php
				try
				{
					$bdd=new PDO('mysql:host=localhost;dbname=ufrmi','root','ValiDiom001');
				}
				catch (Exception $e)
				{
					die('Erreur'.$e->getMessage());
				}

				function connect($_matr,$_mdp,$_bdd)
				{
					$table_etudiant = $_bdd->prepare('select * from etudiants where Matricule= :Matricule and Mdp=:mdp');

					$table_etudiant->execute(array('Matricule' => $_matr ,
													'mdp' => $_mdp ));
					if($data=$table_etudiant->fetch())
					{
						$_SESSION['nom']=$data['Nom'];
						$_SESSION['pseudo']=$data['Pseudo'];
						$_SESSION['prenom']=$data['Prenoms'];
						$_SESSION['matr']=$data['Matricule'];
						$termValid=true;
						$_SESSION['connected']=true;
					}
					else
					{
						$termValid=false;
						$_SESSION['connected']=false;
						
					}

					return $termValid;

				}

				function inscrire($_matr,$_nom,$_prenom,$_pseudo,$_niveau,$_filiere,$_email,$_mdp,$_bdd)
				{
					$req=$_bdd->prepare('insert into etudiants values(:matr,:nom,:pren,:psd,:niv,:fil,:email,:mdp)');

					$retour=$req->execute(array('matr' => $_matr,
										'nom' => $_nom,
										'pren' => $_prenom,
										'psd' => $_pseudo,
										'niv' => $_niveau,
										'fil' => $_filiere,
										'email' => $_email,
										'mdp' => $_mdp));
					

					return $retour;
				}

				function valid($_ele)
				{
					return isset($_ele) && $_ele!='' && !is_null($_ele);
				}

				if (isset($_POST[$valideCon])) {
					/*Traitement des tremes de connexion*/
					$_SESSION[$byee]=false;
					if($conectOK=connect($_POST[$matrCon],$_POST[$mdpCon],$bdd))
					{
						header('Location: espaceetudiant.php');
					}
				}
				elseif(isset($_POST[$valideIns]))
				{
					/*Traitement des termes de l'inscription*/
					/*echo "ValideIns OK";*/
					$_SESSION[$byee]=false;
					if(valid($_POST[$matr]) && valid($_POST[$nom]) && valid($_POST[$prenom]) && valid($_POST[$psd]) && valid($_POST[$niv]) &&
						valid($_POST[$fil]) &&  valid($_POST[$email]) && valid($_POST[$mdp1]) && valid($_POST[$mdp2]))
					{
						/*echo "ValideIns true";*/
						$valideIns=true;
						if($_POST[$mdp1]===$_POST[$mdp2])
						{	/*echo '$valideMdp true';*/
							$valideMdp=true;
						}
						else
						{
							$valideMdp=false;
							/*echo '$valideMdp false';*/
						}
					}
					else
					{
						/*echo "ValideIns false";*/
						$valideIns=false;
					}

					if($valideIns)
					{
						if($valideMdp)
						{
							$insertOK = inscrire($_POST[$matr],$_POST[$nom],$_POST[$prenom],$_POST[$psd],$_POST[$niv],$_POST[$fil],$_POST[$email],$_POST[$mdp1],$bdd);
							if($insertOK)
							{
								
								if($conectOK=connect($_POST[$matr],$_POST[$mdp1],$bdd))
								{
									header('Location: espaceetudiant.php');
								}
							}else
							{
								/*echo '$inserOK false';*/
							}
							
						}
					}


				}

				include("prototypes/header.html");
			?>

			<section id="main_section">
				

				<div class="inscription_form">
					<h1 class="grand_titre">CONNEXION</h1>
					<?php
					if(isset($conectOK))
					{
						if(!$conectOK && !$_SESSION[$byee])
						{
							echo '<p style="border: 1px solid red; border-radius:3px;" >Connexion échouée<br>Vérifiez vos informations de connexion puis réessayez!<br></p>';
						}
					}
						
					?>
					<form class="formulaire" method="post" action="Inscription.php">
						<label for="matrCon">Matricule </label><input type="text" name="matrCon" id="matrCon"><br>
						<label for="mdpCon">Matricule </label><input type="password" name="mdpCon" id="mdpCon"> <br>
						<input type="submit" name="valideCon" value="Connexion">
					</form>
				</div>
				<div class="inscription_form">
					<h1 class="grand_titre">FORMULAIRE D'INSCRIPTION</h1>
					<?php
						if(!$valideIns && !$_SESSION[$byee])
						{
							echo '<p style="border: 1px solid red; border-radius:3px;" >Connexion échouée<br>Vérifiez vos informations de connexion puis réessayez!<br>';
							if(!$valideMdp)
							{
								echo '<em>Indication</em> : les mots de passe saisis ne corresponde pas.<br>';
							}

							echo '</p>';
						}
					?>
					<form class="formulaire" method="post" action="Inscription.php">
						<label for="matr">Matricule </label><input id="matr" class="inputInfo" type="text" name="matr"><br>
						<label for="nom">Nom </label><input  id="nom" class="inputInfo" type="text" name="nom">
						<label for="prenom">Prenoms </label><input  id="prenom" class="inputInfo" type="text" name="prenom"><br>
						<label for="pseudo">Pseudo </label><input  id="pseudo" class="inputInfo" type="text" name="pseudo"><br>
						<label for="niv">Niveau </label>
						<select id="niv" name="niv">
							<option value="1" selected="selected">Licence 1</option>
							<option value="2">Licence 2</option>
							<option value="3">Licence 3</option>
							<option value="4">Master 1</option>
							<option value="5">Master 2</option>
						</select>

						<label for="filiere">Filière </label>
						<select id="filiere" name="filiere">
							<option value="mi" selected="selected">Mathématique Informatiques</option>
							<option value="sm">Mathématiques et Applications</option>
							<option value="si">Sciences Informatiques</option>
							<option value="spi">Science pour l'Ingénieur</option>
							<option value="edp">EDP</option>
							<option value="fonda">Mathématiques Fondamantales</option>
						</select>
						<br>
						<label for="email">Email </label><input id="email" type="email" name="email" > 
						<label for="mdp1">Mot de passe </label><input id="mdp1" type="password" name="mdp1"> <br>
						<label for="mdp2">Confirmation </label><input id="mdp2" type="password" name="mdp2"> <br>
						<input type="submit" name="valideIns">
					</form>

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