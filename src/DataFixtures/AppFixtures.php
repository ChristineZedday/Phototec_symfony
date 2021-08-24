<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\DossierPhotos;

define ("RACINE", "D:/Photos");

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $chemin = RACINE;
        chargeDossier($manager, $chemin);
      
}

}
function chargeDossier(ObjectManager $manager, String $chemin)
{
    $nb_dossiers = 0;
   
    if ($racine = @opendir($chemin))
    {
        echo $racine;
        while(false !== ($dossier = @readdir($racine)))
        {
            
            
            if($dossier != '.' && $dossier != '..' )
            {
                $nb_dossiers++;
               
                   $dossierNouveau = New DossierPhotos();
                $dossierNouveau->setNom($dossier) ;
                $dossierNouveau->setChemin($chemin) ;
                $manager->persist($dossierNouveau);
                // chargeDossier($manager, $dossier);
               
                
                
            }
            $manager->flush();
            closedir($racine);
    }
  echo ('dossier non accessible ou fichier');
   
}

}