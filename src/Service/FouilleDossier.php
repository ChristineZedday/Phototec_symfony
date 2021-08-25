<?php
namespace App\Service;

use Doctrine\Persistence\ObjectManager;
use App\Entity\Photo;
use App\Entity\DossierPhotos;

class FouilleDossier 
{
	

	public function chargePhotos(DossierPhotos $dossier, objectManager $manager)
	{
		//enregistre toutes les photos du dossier dans la base
		// $fichiers = glob( '*.{jpg,jpeg,JPG,JPEG}',GLOB_BRACE);
		
		$nb_fichiers = 0;
		$dirpath =$dossier->getChemin().'/'.$dossier->getNom();
		
        if ($dir = opendir("$dirpath"))
        {
            while(false !== ($fichier = readdir($dir)))
            {
                if (FouilleDossier::is_photo($fichier)) {
                   $nb_fichiers++;
                    $photo = new Photo();
                    $photo->setNom($fichier);
					$photo->setDossier($dossier);
                   
                    $manager->persist($photo);
                   
				}
                    
            }
            $manager->flush();
        }
        else { dd('pas bon le chemin');}
	}

	static function is_photo(string $file):bool
	{
		if (pathinfo($file, PATHINFO_EXTENSION) === 'jpeg' || pathinfo($file, PATHINFO_EXTENSION)=== 'jpg' || pathinfo($file, PATHINFO_EXTENSION) === 'JPEG' || pathinfo($file, PATHINFO_EXTENSION)=== 'JPG') {
			return true;
		}
		else {return false;}
	}
}

