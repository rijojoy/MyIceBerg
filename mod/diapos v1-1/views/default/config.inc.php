<?php
	/**
	 * Elgg diapos plugin
	 *
	 * @package diapos config
	 * @author OLY
	 * @copyright 2012
	 */
	 
// v1.1
// number of picture by page
$Max_pictures = 55.0 ;
// format extension
$extensions_autorisees = array('png', 'jpg', 'jpeg', 'gif');

// v elgg 1.8+
$ElggUser = elgg_get_logged_in_user_entity();
$Plugin_path = elgg_get_plugins_path();

function affiche_navbar($album,$deb,$i,$Max_pictures,$fichier) {
	
	//echo "album=".$album." i=".$i." deb=".$deb;
	
	// navigation bar v1.1
	$content = "<h3>";
	$tab = array ('title' => elgg_echo('diapos:backlist'),'href' => "diapos",'is_action' => false,'text' => elgg_echo('diapos:backlist') );	
	$content .= "[ ".elgg_view('output/url', $tab) ;
	
	// liste des pages accessibles
	$Nb_pages = (int)(count($fichier) / ($Max_pictures+1)) + 1 ;
	
	for ($j=1;$j<=$Nb_pages;$j++) {
		
		if ($deb == (($j-1)*$Max_pictures)) {
			$content .= " | <u>".$j."</u>" ;
		}
		else {
			$tab = array ('title' => elgg_echo('diapos:goto')." ".$j,'href' => "diapos?album=".$album."&deb=".(int)(($j-1)*$Max_pictures),'is_action' => false,'text' => $j );	
			$content .= " | ". elgg_view('output/url', $tab) ;
		}
	}
	
/* 	$tab = array ('title' => elgg_echo('diapos:first'),'href' => "diapos?album=".$album."&deb=0",'is_action' => false,'text' => elgg_echo('diapos:first') );	
	$content .= elgg_view('output/url', $tab)." | " ;
	$tab = array ('title' => elgg_echo('diapos:end'),'href' => "diapos?album=".$album."&deb=".(int)(count($fichier)/$Max_pictures)*$Max_pictures,'is_action' => false,'text' => elgg_echo('diapos:end') );	
	$content .= elgg_view('output/url', $tab) ; */
			
	if ($deb > 0) {
	
		// affiche le bouton previous
		$tab = array('title' => elgg_echo('diapos:previous'),'href' => "diapos?album=".$album."&deb=".(string)($deb-$Max_pictures),'is_action' => false,'text' => elgg_echo('diapos:previous'));		
		$content .= " | << ".elgg_view('output/url', $tab)." " ;
	}
							
	// next 
		
	if (($i < count($fichier)) && (!empty($fichier))) {
			
		// affiche le bouton next
		$tab = array('title' => elgg_echo('diapos:next'),'href' => "diapos?album=".$album."&deb=".(string)($deb+$Max_pictures),'is_action' => false,'text' => elgg_echo('diapos:next'));
		$content .= " | ".elgg_view('output/url', $tab)." >>";
	}
			
	$content .= " ]</h3>";
	
	return $content;
}		
?>