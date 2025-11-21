<?php
/**
 * Affichage de la page d'accueil.
 */



Utils::getTemplatePart('text-image', [
    'title' => 'Rejoignez nos lecteurs passionnés',
    'text' => 'Donnez une nouvelle vie à vos livres en les échangeant avec d\'autres amoureux de la lecture. Nous croyons en la magie du partage de connaissances et d\'histoires à travers les livres.',
    'button' => 'Découvrir',
    'button-url' => '?action=showBooks',
    'image' => '/uploads/hamza-nouasria.png',
    'image-legend' => 'Hamza'
]);



Utils::getTemplatePart('last-books', [
    'title' => 'Rejoignez nos lecteurs passionnés',
    'recentBooks' => $recentBooks,
    'button' => 'Découvrir',
    'button-url' => '?action=showBooks',
]);


Utils::getTemplatePart('faq', [
    'title' => 'Comment ça marche ?',
    'text' => 'Échanger des livres avec TomTroc c\'est simple et amusant ! Suivez ces étapes pour commencer :',
    'faq' => [
        [
            'answer' => 'Inscrivez-vous gratuitement sur notre plateforme.',
        ],
        [
            'answer' => 'Ajoutez les livres que vous souhaitez échanger à votre profil.',
        ],
        [
            'answer' => 'Parcourez les livres disponibles chez d\'autres membres.',
        ],
        [
            'answer' => 'Proposez un échange et discutez avec d\'autres passionnés de lecture.',
        ],
    ],
    'button' => 'Voir tous les livres',
    'button-url' => '?action=showBooks',
]);


Utils::getTemplatePart('image-full-width', [
    'image' => '/uploads/clay-banks.png',
    'alt' => 'Image d\'une bibliothèque remplie de livre - Clay Banks'
]);


Utils::getTemplatePart('text-center', [
    'title' => 'Nos valeurs',
    'text' => 'Chez Tom Troc, nous mettons l\'accent sur le partage, la découverte et la communauté. Nos valeurs sont ancrées dans notre passion pour les livres et notre désir de créer des liens entre les lecteurs. Nous croyons en la puissance des histoires pour rassembler les gens et inspirer des conversations enrichissantes. Notre association a été fondée avec une conviction profonde : chaque livre mérite d\'être lu et partagé. Nous sommes passionnés par la création d\'une plateforme conviviale qui permet aux lecteurs de se connecter, de partager leurs découvertes littéraires et d\'échanger des livres qui attendent patiemment sur les étagères.',
    'text-legend' => 'L\'équipe Tom Troc',
]);


?>