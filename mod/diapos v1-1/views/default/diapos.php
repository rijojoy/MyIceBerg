<?php
/******************************************************************************/
/*                                                                            */
/*                       __        ____                                       */
/*                 ___  / /  ___  / __/__  __ _____________ ___               */
/*                / _ \/ _ \/ _ \_\ \/ _ \/ // / __/ __/ -_|_-<               */
/*               / .__/_//_/ .__/___/\___/\_,_/_/  \__/\__/___/               */
/*              /_/       /_/                                                 */
/*                                                                            */
/*                                                                            */
/******************************************************************************/
/*                                                                            */
/* Titre/title        : affiche des albums photos							  */
/*                      plugin for photos gallery                             */
/* URL          	  : http://www....								          */
/* Auteur/author      : Olivier de Lannoy                                     */
/* Date édition  	  : 01 juin 2012                                          */
/* Website auteur     : http://www.....		                                  */
/*                                                                            */
/******************************************************************************/
// Fichiers include
include('config.inc.php');

?><html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" /> 
    <title>Album photos</title>
	<link rel="stylesheet" type="text/css" href="<?php echo elgg_get_site_url() . "mod/diapos/views/default/diapos.css" ?>" />
</head>
 <body><p>
  
<?php

// test if logged
if ((isset($ElggUser)) && ($ElggUser->guid > 0)){

	// test si le nom de l'album est passé en parametre
	if (!isset($_GET['album'])) {		
	
		// listage des albums uniquement (repertoire)
		//echo elgg_view_title(elgg_echo('diapos:liste')."<hr>");

		$dir_base = $Plugin_path."diapos/views/albums/"; 
		$dir_nom = $dir_base.".";

		// on ouvre le contenu du dossier courant
		$dir = opendir($dir_nom) or die('Erreur de listage : le répertoire des albums n\'existe pas'); 

		// on déclare le tableau contenant le nom des dossiers
		$dossier= array(); 

		// on balaie les répertoires principaux
		while($element = readdir($dir)) {
			if($element != '.' && $element != '..') {
				if (is_dir($dir_nom.'/'.$element)) {$dossier[] = $element;}
			}
		}

		closedir($dir);

		// v1.1 with counter
		echo elgg_view_title(elgg_echo('diapos:liste')." - (".count($dossier).")<hr>");

		if(!empty($dossier)) {
	
			sort($dossier); 

			foreach($dossier as $lien){
		
				// affiche le nom du dossier
				//echo "<p><div id=\"bloc1\"><center>$lien</center></div><p>";

				$dir_nom = $dir_base.$lien ;
				// sauve le répertoire courant
				$repert = $lien;
				// lecture des images
				$dir = opendir($dir_nom) or die('Erreur de listage : le répertoire n\'existe pas '); // on ouvre le contenu du dossier courant
				$fichier= array(); // on déclare le tableau contenant le nom des fichiers
	
				// on balaie les répertoires/dossiers 
				while($element = readdir($dir)) {
			
					$extension = explode(".",$element);
				
					if (in_array(strtolower($extension[1]), $extensions_autorisees) ) {
						if (!is_dir($dir_nom.'/'.$element)) {$fichier[] = $element;}
					}
				}
				
				$tab = array('title' => $lien,'href' => "diapos?album=".$lien,'is_action' => false,'text' => $lien );

				$content = elgg_view('output/url', $tab);
				echo elgg_echo ("<h3>".$content." - (".count($fichier).")</h3>");
				unset($fichier);
				
			}
		
		}
		
		echo "<br>";

	}
	
	else	{
	
	
		// c'est un album, listage du contenu
		$album = $_GET['album'];
	
		$extensions_autorisees = array('png', 'jpg', 'jpeg', 'gif');
		$dir_nom = $Plugin_path."diapos/views/albums/".$album ; 

		// on ouvre le contenu du dossier courant
		$dir = opendir($dir_nom) or die('Erreur de listage : le répertoire des albums n\'existe pas'); 

		echo elgg_echo("<h2>$album</h2>");

		$fichier= array(); // on déclare le tableau contenant le nom des fichiers
		
		// on balaie le répertoire 
		while($element = readdir($dir)) {
			
			$extension = explode(".",$element);
				
			if (in_array(strtolower($extension[1]), $extensions_autorisees) ) {
				if (!is_dir($dir_nom.'/'.$element)) {$fichier[] = $element;}
			}
		}
		
		// listage des fichiers
		if(!empty($fichier)){
		
			sort($fichier);// pour le tri croissant, rsort() pour le tri décroissant
			
			$deb = 0;	// compléter avec DEB et FIN
			if (isset($_GET['deb'])) {$deb = $_GET['deb'];}

			// affiche la barre de navigation en haut
			echo elgg_echo(affiche_navbar($album,$deb,min(count($fichier),$deb+$Max_pictures),$Max_pictures,$fichier))."<hr>";
			
			echo "<div id=\"gallery\" >";	
			echo "<em id=\"thumbs\">";		
			
			for ($i=$deb;$i<min(count($fichier),$deb+$Max_pictures);$i++) {
			
				$UrlImg = elgg_get_site_url() . "mod/diapos/views/albums/".$album."/".$fichier[$i] ;
				echo "<a href=\"#nogo\"><img src=\"".$UrlImg."\" alt=\"".$fichier[$i]."\" title=\"".$fichier[$i]."\"  /></a>";
			
			}
			
			echo "</em>";
			echo "</div>";
			

			// affiche la barre de navigation en bas (la garder ??)
			echo elgg_echo(affiche_navbar($album,$deb,$i,$Max_pictures,$fichier));
			
		}
		
		else {
		
			echo "</em>";
			echo "</div>";
			
			echo "<hr><h3><center>".elgg_echo('diapos:empty')."</center></h3>";
		}

	
	}
	
}

else

	system_message(elgg_echo('diapos:ident')) ;
	
?>

</body>
</html>
