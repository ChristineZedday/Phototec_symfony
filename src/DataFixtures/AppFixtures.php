<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Dossier;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $nb_dossiers = 0;
        if ($racine = opendir("D:\Photos"))
        {
            while(false !== ($dossier = readdir($racine)))
            {
                if($dossier != '.' && $dossier != '..' && $dossier != 
'index.php')
                {
                    $nb_fichiers++;
                    $dossier = New Dossier();
                    $dossier->setNom($dossier) ;
                    $manager->persist($dossier);
                }
            }
        $manager->flush();
    }
}
}
