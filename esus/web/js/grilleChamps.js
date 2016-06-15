function grilleCalques(nom, idDestination, nombreColonnes, nombreLignes, largeur, hauteur) {
	this.grille = new Array();
	if(largeur == undefined) { largeur = (nombreColonnes * 50) + ((nombreColonnes * 2));}
	if(hauteur == undefined) { hauteur = (nombreLignes * 50) + ((nombreLignes * 2));}
	largeurCase = Math.round((largeur - ((nombreColonnes * 2))) / nombreColonnes);
	hauteurCase = Math.round((hauteur - ((nombreLignes * 2))) / nombreLignes);
	var calqueConteneur = document.createElement('div');
	calqueConteneur.id = nom;
	calqueConteneur.style.width = largeur + 'px';
	calqueConteneur.style.height = hauteur + 'px';
	calqueConteneur.style.border = '1px solid black';
	calqueConteneur.style.display = 'inline-block';
	calqueConteneur.style.overflow = 'hidden';
	document.getElementById(idDestination).appendChild(calqueConteneur);
	for(var i = 1; i <= nombreLignes; i++) {
		for(var j = 1; j <= nombreColonnes; j++) {
			var calque = document.createElement('div');
			calque.id = calqueConteneur.id + 'L' + i + 'C' + j;
			calque.style.width = largeurCase + 'px';
			calque.style.height = hauteurCase + 'px';
			calque.style.border = '1px solid black';
			calque.style.display = 'inline-block';
			calque.style.verticalAlign = 'top';
			calque.style.boxSizing = 'border-box';
			calque.style.margin = '1px';
			calque.style.overflow = 'hidden';
			document.getElementById(calqueConteneur.id).appendChild(calque);
			this.grille[j + ((i - 1) * nombreColonnes)] = '-';
		}
	}
	this.affiche = function(idDestination) {
		var chaine = "";
		for(var i = 1; i <= nombreLignes; i++) {
			for(var j = 1; j <= nombreColonnes; j++) {
				chaine += this.grille[j + ((i - 1) * nombreColonnes)];
				if(i * j != this.grille.length - 1) {
					chaine += ', ';
				}
			}
			chaine += '<br/>';
		}
		document.getElementById(idDestination).innerHTML = chaine;
	}
}

function grilleChamps(nom, idDestination, nombreColonnes, nombreLignes, largeur, hauteur) {
	grilleCalques.call(this, nom, idDestination, nombreColonnes, nombreLignes, largeur, hauteur);
	parentThis = this;
	for(var i = 1; i <= nombreLignes; i++) {
		for(var j = 1; j <= nombreColonnes && i*j < (nombreLignes * nombreColonnes) - 1; j++) {
			var largeurBoucle = largeur;
			var champ = document.createElement('input');
			champ.id = 'champL' + i + 'C' + j;
			champ.name = 'champL' + i + 'C' + j;
			champ.type = 'text';
			champ.readOnly = true;
			champ.valeur = j + ((i - 1) * nombreLignes);
			champ.style.width = largeurCase + 'px';
			champ.style.height = hauteurCase / 2 + 'px';
			champ.style.fontSize = '20px';
			champ.style.paddingLeft = '0px';
			champ.style.position = 'relative';
			champ.style.left = '-4px';
			champ.style.textAlign = 'center';
			champ.style.paddingTop = (hauteurCase / 50 * 11) + 'px';
			champ.style.paddingBottom = (hauteurCase / 50 * 11) + 'px';
			champ.style.background = '#CFC';
			champ.onmouseover = function() {
				this.style.cursor = "pointer";
			};
			champ.onclick = function() {
				var index1 = (this.id).indexOf('L');
				var index2 = (this.id).indexOf('C');
				var ligne = parseInt((this.id).substr(parseInt(index1) + 1, parseInt(index2) - parseInt(index1) - 1));
				var colonne = parseInt((this.id).substr(parseInt(index2) + 1));
				if(parentThis.grille[colonne + ((ligne - 1) * nombreColonnes)] == 0 || parentThis.grille[colonne + ((ligne - 1) * nombreColonnes)] == '-') {
					parentThis.grille[colonne + ((ligne - 1) * nombreColonnes)] = 1;
					parentThis.affiche('informations');
					if(document.getElementById(this.id).value != '' && colonne != 7) {
						this.style.background = "#FFC";
						this.select();
						this.focus();
					}
				}
				else {
					parentThis.grille[colonne + ((ligne - 1) * nombreColonnes)] = 0;
					parentThis.affiche('informations');
					this.style.background = '#CFC';
					this.blur();
				}
			};
			document.getElementById(nom + 'L' + i + 'C' + j).appendChild(champ);
		}
	}
	var calque = document.createElement('div');
	calque.id = 'calqueL' + nombreLignes + 'C' + nombreColonnes;
	calque.style.display = 'inline-block';
	calque.style.verticalAlign = 'middle';
	calque.style.height = '100%';
	document.getElementById(nom + 'L' + nombreLignes + 'C' + nombreColonnes).appendChild(calque);
	document.getElementById(nom + 'L' + nombreLignes + 'C' + nombreColonnes).style.background = '#EEF';
	document.getElementById(nom + 'L' + nombreLignes + 'C' + nombreColonnes).style.textAlign = 'center';
	//document.getElementById(nom + 'L' + nombreLignes + 'C' + nombreColonnes).style.borderTop = '3px solid #666666';
	var bouton = document.createElement('input');
	bouton.type = 'button';
	bouton.value = 'Valider';
	bouton.onclick = function() {validation();}
	bouton.id = 'boutonL' + nombreLignes + 'C' + nombreColonnes;
	bouton.style.verticalAlign = 'middle';
	bouton.style.cursor = "pointer";
	document.getElementById(nom + 'L' + nombreLignes + 'C' + nombreColonnes).appendChild(bouton);
}