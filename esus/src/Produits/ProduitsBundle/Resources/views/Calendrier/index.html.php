<!DOCTYPE html>
<html>
    <head>
        <title>Calendrier 2016</title>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<link rel="stylesheet" href="<?php echo $view['assets']->getUrl('css/bootstrap.css') ?>"/>
		<link rel="stylesheet" href="<?php echo $view['assets']->getUrl('css/bootstrap-responsive.css') ?>"/>
		<link rel="stylesheet" href="<?php echo $view['assets']->getUrl('css/style.css') ?>"/>
		<link rel="stylesheet" href="<?php echo $view['assets']->getUrl('css/font-awesome.css') ?>"/>
		<link href="<?php echo $view['assets']->getUrl('css/styleCalendrier.css') ?>" rel="stylesheet" type="text/css" />
    </head>
    <body>
    	<div id="header" class="navbar navbar-inverse navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container">
					<button class="btn btn-navbar" data-target=".nav-collapse" data-toggle="collapse" type="button">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="brand" href="<?php echo $view['router']->generate('accueil_homepage') ?>">L'Atelier 16<br/>production</a>
					<div class="nav-collapse collapse">
						<form id="formRecherche" class="navbar-form form-search pull-right">
							<div class="entretoise"></div><!--
							--><input type="text" id="recherche" name="recherche" placeholder="Rechercher..."/><!--
							--><button id="boutonRecherche"><i class="icon-search"></i></button>
						</form>
					</div>
				</div>
			</div>
		</div>
    	<!-- Utilisateur identification -->
    	<h1>
    		Calendrier Atelier Bois poste 1&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nom utilisateur :
    		<input type="text" name="identification" id="identification" value="<?php echo $utilisateur != 'anon.' ? $utilisateur : 'Non référencé' ?>"/>
    	</h1>
    	<!-- FIN Utilisateur identification -->
    	<!-- Variables et fonctions -->
    	<?php
			$nomMois = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
			$nomJours = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');
		?>
		<script>
			function recapitulation() {
				for(var i = 1; i <= 6; i++) {
					for(var j = 1; j <= 7; j++) {
						if(grille.grille[j + ((i - 1) * 7)] != 0 && grille.grille[j + ((i - 1) * 7)] != '-') {
							var index = (document.getElementById('champL'+i+'C'+j).value).indexOf(' ');
							var nom = (document.getElementById('champL'+i+'C'+j).value).substr(0, parseInt(index));
							var jour = (document.getElementById('champL'+i+'C'+j).value).substr((parseInt(index) + 1));
							document.getElementById('noms').value += (nom + ', ');
							document.getElementById('jours').value += (jour + ', ');
						}
						else if(grille.grille[j + ((i - 1) * 7)] == 0) {
							var index = (document.getElementById('champL'+i+'C'+j).value).indexOf(' ');
							var nomEffaces = (document.getElementById('champL'+i+'C'+j).value).substr(0, parseInt(index));
							var jourEffaces = (document.getElementById('champL'+i+'C'+j).value).substr((parseInt(index) + 1));
							document.getElementById('nomsEffaces').value += (nomEffaces + ', ');
							document.getElementById('joursEffaces').value += (jourEffaces + ', ');
						}
					}
				}
				document.getElementById('conteneur').submit();
			}
			function change() {
				document.getElementById("validation").value = '';
				recapitulation();
			}
			function validation() {
				document.getElementById("validation").value = 'validation';
				recapitulation();
			}
		</script>
		<!-- FIN Variables et fonctions -->
		<!-- DIV -->
		
		<div id="titre"></div>
		<!-- Initialisation -->
		<!-- FIN Initialisation -->
		<!-- Affichage du calendrier -->
		<form name="conteneur" id="conteneur" action="<?php echo $view['router']->generate('produits_calendrier') ?>" method="post">
			<div>
				<select name="moisEnCours" id="moisEnCours" onchange="change()">
					<option value="1">Janvier</option>
					<option value="2">Février</option>
					<option value="3">Mars</option>
					<option value="4">Avril</option>
					<option value="5">Mai</option>
					<option value="6">Juin</option>
					<option value="7">Juillet</option>
					<option value="8">Août</option>
					<option value="9">Septembre</option>
					<option value="10">Octobre</option>
					<option value="11">Novembre</option>
					<option value="12">Décembre</option>
				</select>
			</div>
			<br/>
			<input type="hidden" name="jours" id="jours" value=""/>
			<input type="hidden" name="noms" id="noms" value=""/>
			<input type="hidden" name="joursEffaces" id="joursEffaces" value=""/>
			<input type="hidden" name="nomsEffaces" id="nomsEffaces" value=""/>
			<input type="hidden" name="moisAncien" id="moisAncien" value="<?php echo isset($_POST['moisEnCours']) ? $_POST['moisEnCours'] : intval(date('m')); ?>"/>
			<input type="hidden" name="validation" id="validation" value=""/>
        </form>
        <!-- Définition du mois -->
		<?php
			if(isset($session['moisEnCours']) && $session['moisEnCours'] != '' || isset($session['moisCourant']) && $session['moisCourant'] != '') {
				if(isset($session['moisEnCours']) && $session['moisEnCours'] != '') {
					$moisEnCours = $session['moisEnCours'];
				}
			}
			else {
				$moisEnCours = intval(date('m'));
			}
			echo '<script>document.getElementById("moisEnCours").value = '.$moisEnCours.'</script>';
			//echo '<script>document.getElementById("titre").innerHTML = "<h2>'.$nomMois[intval($moisEnCours) - 1].'</h2>"</script>';
			//if(isset($_POST['moisAncien'])) {
				//echo '$_POST["moisAncien"] = '.$_POST['moisAncien'];
			//}
		?>
		<!-- FIN Définition du mois -->
        <!-- FIN Affichage du calendrier -->
        <!-- Affichage de la grille -->
        <div id="informations" style="padding: 30px"></div>
		<!-- FIN Affichage de la grille -->
		<!-- FIN DIV -->
		<!-- Création du calendrier -->
		<script type="text/javascript" src="<?php echo $view['assets']->getUrl('js/grilleChamps.js') ?>"></script>	
		<script>
			var largeur = 7;
			var hauteur = 6;
			grille = new grilleChamps('grille', 'conteneur', largeur, hauteur, 1050, 500);
		</script>
		<!-- FIN Création du calendrier -->
		<!-- Récupération de la table -->
		
		
		
		<!-- FIN Récupération de la table -->
		<!-- Enregistrement dans la table -->
		
		
		
		
		<!-- FIN Enregistrement dans la table -->
		<!-- Traitement -->
		<?php
			$iteration = 0;
			$compteur = 0;
			$ligne = 1;
			if($moisEnCours < 10) {
				$mois = '0'.$moisEnCours;
			}
			else {
				$mois = ''.$moisEnCours;
			}
			foreach($dates['2016'][$mois] as $jour=>$nom) {
				if($jour == '01') {
					$debut = key($nom);
					$compteur = $debut - 1;
					break;
				}
			}
			foreach($dates['2016'][$mois] as $jour=>$nom) {
				if(($compteur % 7) == 0 && $compteur > 0) {
					$ligne++;
				}
				$compteur ++;
				$decalageCase = (intval($jour) - (($ligne - 1) * 7)) + ($debut - 1);
				if($decalageCase == 8) {
					$decalageCase = 1;
				}
				if($iteration < ($debut - 1)) {
					echo '<script>document.getElementById("champL1C'.($iteration + 1).'").disabled = true;</script>';
					echo '<script>document.getElementById("champL1C'.($iteration + 1).'").style.background = "#EEF";</script>';
					echo '<script>document.getElementById("champL1C'.($iteration + 1).'").onmouseover = function() {
						this.style.cursor = "default";
					};</script>';
				}
				echo '<script>document.getElementById("champL'.$ligne.'C'.$decalageCase.'").value = "'.$nomJours[key($nom) - 1].' '.$jour.'"</script>';
				echo '<script>
					if(document.getElementById("champL'.$ligne.'C'.$decalageCase.'").background == "#FCC"){
						document.getElementById("champL'.$ligne.'C'.$decalageCase.'").onmouseover = function() {
							this.style.cursor = "default";
						};
					}
				</script>';
				if($nom[key($nom)] != '0') {
					if($utilisateur != '' && $utilisateur != 'anon.' && $utilisateur != 'Non référencé') {
						echo '<script>document.getElementById("champL'.$ligne.'C'.$decalageCase.'").style.background = "#FFC";</script>';
						echo '<script>grille.grille['.$decalageCase.' + (('.$ligne.' - 1) * 7)] = 1</script>';
					}
					else {
						echo '<script>document.getElementById("champL'.$ligne.'C'.$decalageCase.'").disabled = true;</script>';
						echo '<script>document.getElementById("champL'.$ligne.'C'.$decalageCase.'").style.background = "#FCC";</script>';
						echo '<script>document.getElementById("champL'.$ligne.'C'.$decalageCase.'").style.color = "black";</script>';
						echo '<script>document.getElementById("champL'.$ligne.'C'.$decalageCase.'").onmouseover = function() {
							this.style.cursor = "default";
						};</script>';
					}
				}
				if($decalageCase == 7) {
					echo '<script>document.getElementById("champL'.$ligne.'C'.$decalageCase.'").disabled = true;</script>';
					echo '<script>document.getElementById("champL'.$ligne.'C'.$decalageCase.'").style.color = "black";</script>';
					echo '<script>document.getElementById("champL'.$ligne.'C'.$decalageCase.'").style.background = "#EEF";</script>';
					echo '<script>document.getElementById("champL'.$ligne.'C'.$decalageCase.'").onmouseover = function() {
						this.style.cursor = "default";
					};</script>';
				}
				$iteration++;
			}
			for($i = $iteration + $debut; $i < 42; $i++) {
				$C = ($i % 7);
				if($C == 0) {$C = 7;}
				echo '<script>document.getElementById("champL'.(floor((($i - 1) / 7) + 1)).'C'.$C.'").disabled = true;</script>';
				echo '<script>document.getElementById("champL'.(floor((($i - 1) / 7) + 1)).'C'.$C.'").style.background = "#EEF";</script>';
				echo '<script>document.getElementById("champL'.(floor((($i - 1) / 7) + 1)).'C'.$C.'").onmouseover = function() {
					this.style.cursor = "default";
				};</script>';
			}
		?>
		<!-- FIN Traitement -->
		<!-- Affichage de la grille -->
		<script>
			grille.affiche('informations');
		</script>
		<!-- FIN Affichage de la grille -->
		<!-- Affichage du tableau calendrier -->
		<pre><?php print_r($_SESSION['datesStockees']); ?></pre>
		<!-- FIN Affichage du tableau calendrier -->
	</body>
</html>