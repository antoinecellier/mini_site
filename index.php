<?php

define('SQUELETTE', "ui/pages/squelette.html");
define('HEADER', "ui/fragments/header.frg.html");
define('FOOTER', "ui/fragments/footer.frg.html");

$content = "";

if(isset($_GET['page']))
{
	$paramPage = $_GET['page'];
}else{
	$paramPage = "accueil";
}


switch ($paramPage) {
	case "accueil":
		$content = file_get_contents("informations/accueil.frg.html");
		$titlePage = "Accueil";
		break;

	case "casting":
		$content = file_get_contents("informations/casting.frg.html");
		$titlePage = "Casting";
		break;

	case "page_news":
		$content = file_get_contents("informations/news_page.frg.html");
		$titlePage = "Actualités";
		break;

	case "photos":
		$content = file_get_contents("informations/photos.frg.html");
		$titlePage = "Photos";
		break;

	case "news":

		if(isset($_GET['id']))
		{
			$id = $_GET['id'];

			$filename = "informations/news/n".$id.".frg.html";

			if(file_exists($filename))
			{
				$content = file_get_contents($filename);
				$titlePage = "Actualité";			
			}else{
				header('Location: index.php?page=erreur');	
			}

		}else{
			header('Location: index.php?page=erreur');	
		}
		
		
		break;
	
	case "erreur":
		$content = file_get_contents("ui/fragments/error.frg.html");
		$titlePage = "Erreur 404";
		break;

	default:
		header('Location: index.php?page=erreur');	
		break;
}


$header = file_get_contents(HEADER);
$footer = file_get_contents(FOOTER);

ob_start();
	$title = $titlePage;
	require_once(SQUELETTE);
	$html = ob_get_contents();
ob_end_clean();

	echo $html;

?>