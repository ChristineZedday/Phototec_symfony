<?php
namespace App\Service;

use Doctrine\Persistence\ObjectManager;

class FouilleDossier 
{
	function selectionnerDossier():string 
	{
		return "Pas encore implémentée";
	}


	function reconnaitPhoto(string $file):boolean 
	{
		if (pathinfo($file, PATHINFO_EXTENSION) === 'jpeg' || pathinfo($file, PATHINFO_EXTENSION)=== 'jpg') {
			return 1;
		}
		else {return 0;}
	}

	function chargePhotos(string $dossier, objectManager $manager)
	{
		//enregistre toutes les photos du dossier dans la base
		$nb_fichiers = 0;
		
        if ($dossier = opendir("$dossier"))
        {
            while(false !== ($fichier = readdir($dossier)))
            {
                if(reconnaitPhoto($fichier))
                {
                   $nb_fichiers++;
                    $photo = new Photo();
                    $photo->setNom($fichier);
                   
                    $manager->persist($photo);
                   
                }
                    
            }
            $manager->flush();
        }
        else { dd('pas bon le chemin');}
	}
}