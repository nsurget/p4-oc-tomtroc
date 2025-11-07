
USE `p4-nsurget-tomtroc`;


INSERT INTO `users` (`email`, `password`, `pseudo`) 
VALUES 
('jean.dupont@email.com', 'password123', 'JeanD');


INSERT INTO `authors` (`last_name`, `first_name`) 
VALUES 
('Hugo', 'Victor'), 
('Tolkien', 'J.R.R.');


INSERT INTO `books` (`title`, `description`, `availability`, `url_image`, `author_id`, `user_id`) 
VALUES 
(
    'Les Misérables', 
    'Un roman historique et social sur la vie à Paris au 19e siècle.', 
    'available',
    'https://example.com/images/miserables.jpg',
    1,
    1
),
(
    'Le Seigneur des Anneaux : La Communauté de l\'Anneau', 
    'Le début du voyage de Frodon pour détruire l\'Anneau Unique.', 
    'unavailable',
    'https://example.com/images/lotr1.jpg',
    2,
    1
);