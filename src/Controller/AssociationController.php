<?php

namespace App\Controller;

class AssociationController extends AbstractController
{
    /**
     * Display partner page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     *
     * @SuppressWarnings(PHPMD)
     */
    public function partner()
    {
        $partners = [
            [
                'name' => 'Fédération Française des échecs',
                'image' => '/assets/images/partners/ffe.jpg',
                'website' => 'http://www.echecs.asso.fr/',
            ],
            [
                'name' => 'Mairie d\'Orléans',
                'image' => '/assets/images/partners/mairie_orleans.jpg',
                'website' => 'https://www.orleans-metropole.fr/',
            ],
            [
                'name' => 'Département du Loiret',
                'image' => '/assets/images/partners/departement_loiret.jpg',
                'website' => 'https://www.loiret.fr/',
            ],
            [
                'name' => 'Région Centre-Val de Loire',
                'image' => '/assets/images/partners/region_cvl.jpg',
                'website' => 'https://www.centre-valdeloire.fr/',
            ],
            [
                'name' => 'Académie d\'Orléans-Tours',
                'image' => '/assets/images/partners/ac_orleans_tours.jpg',
                'website' => 'https://www.ac-orleans-tours.fr/',
            ],
            [
                'name' => 'Comité départemental des jeux d\'Echecs du Loiret',
                'image' => '/assets/images/partners/cdje45.png',
                'website' => 'https://cdje45.fr/',
            ],
            [
                'name' => 'Ligue Centre-Val de Loire du Jeu d\'Echecs',
                'image' => '/assets/images/partners/ligue_cvl_echecs.jpg',
                'website' => 'http://echecscentre-valdeloire.fr/',
            ],
            [
                'name' => 'Label Sport Handicap Centre-Val de Loire',
                'image' => '/assets/images/partners/label_sport_handicap_cvl.jpg',
                'website' => 'https://sport-handicap-centrevaldeloire.fr/',
            ],
            [
                'name' => 'HandiGuide des sports',
                'image' => '/assets/images/partners/handiguide.jpg',
                'website' => 'https://www.handiguide.sports.gouv.fr/',
            ],
            [
                'name' => 'Le mouvement associatif Centre-Val de Loire',
                'image' => '/assets/images/partners/mouvement_asso.png',
                'website' => 'https://lemouvementassociatif-cvl.org/',
            ],
            [
                'name' => 'Profession Sport & Loisirs 45',
                'image' => '/assets/images/partners/prof_sport_loisir.jpg',
                'website' => 'https://loiret.profession-sport-loisirs.fr/',
            ],
            [
                'name' => 'Agence nationale du sport',
                'image' => '/assets/images/partners/agence_sport.jpg',
                'website' => 'https://www.agencedusport.fr/',
            ],
            [
                'name' => 'Comité Départemental Olympique et Sportif du Loiret',
                'image' => '/assets/images/partners/cdos_loiret.jpg',
                'website' => 'https://loiret.franceolympique.com/accueil.php',
            ],
            [
                'name' => 'Caisse d\'Allocations Familiales du Loiret',
                'image' => '/assets/images/partners/caf_loiret.jpg',
                'website' => 'http://www.caf.fr/',
            ],
            [
                'name' => 'Cours St Charles',
                'image' => '/assets/images/partners/stcharles.png',
                'website' => 'http://www.stcharles-orleans.com/',
            ],
            [
                'name' => 'Les amis de l\'université du temps libre d\'Orléans',
                'image' => '/assets/images/partners/utlo.jpg',
                'website' => 'https://www.univ-orleans.fr/fr/utlo',
            ],
            [
                'name' => 'SUAPSE Orléans',
                'image' => '/assets/images/partners/suapse.jpg',
                'website' => 'https://www.univ-orleans.fr/es/suapse',
            ],
            [
                'name' => 'Sainte Croix Sainte Euverte',
                'image' => '/assets/images/partners/scse.png',
                'website' => 'http://www.scse.fr/',
            ],
            [
                'name' => 'Orléans joue',
                'image' => '/assets/images/partners/orleans_joue.png',
                'website' => 'https://orleans-joue.fr/',
            ],
            [
                'name' => 'IDP Informatique',
                'image' => '/assets/images/partners/idp.jpg',
                'website' => 'http://www.i-d-p.fr/',
            ],
            [
                'name' => 'Effet de cerf',
                'image' => '/assets/images/partners/effetdecerf.jpg',
                'website' => 'https://www.effetdecerf.fr/',
            ],
            [
                'name' => 'Eureka',
                'image' => '/assets/images/partners/eureka.jpg',
                'website' => 'http://www.eureka-orleans.fr/fr/',
            ],
            [
                'name' => 'Le Bistrot',
                'image' => '/assets/images/partners/bistrot.jpg',
                'website' => 'https://www.tripadvisor.fr/' .
                    'Restaurant_Review-g187129-d4954884-Reviews-Le_Bistrot-Orleans_Loiret_Centre_Val_de_Loire.html',
            ],
            [
                'name' => 'Clés minute',
                'image' => '/assets/images/partners/cle_minute.jpg',
                'website' => 'https://www.clesminute-orleans.fr/',
            ],
        ];


        return $this->twig->render('Association/partner.html.twig', [
            'partners' => $partners
        ]);
    }
}
