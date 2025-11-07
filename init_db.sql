CREATE DATABASE IF NOT EXISTS `p4-nsurget-tomtroc`
CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE `p4-nsurget-tomtroc`;



-- // --------------------------------------------------------
-- // Table `users`
-- // --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `users` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `email` VARCHAR(255) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL, -- // hashed password
    `pseudo` VARCHAR(100) NOT NULL UNIQUE,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



-- // --------------------------------------------------------
-- // Table `authors`
-- // --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `authors` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `last_name` VARCHAR(255) NOT NULL,
    `first_name` VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



-- // --------------------------------------------------------
-- // Table `books`
-- // --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `books` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `title` VARCHAR(255) NOT NULL,
    `description` TEXT DEFAULT NULL,
    `availability` VARCHAR(255) NOT NULL DEFAULT 'unavailable',
    `url_image` VARCHAR(255) DEFAULT NULL,
    
    -- // Foreign Keys 
    `author_id` INT NOT NULL, -- // Relation (1..1) to Author
    `user_id` INT NOT NULL,   -- // Relation (1..1) to User

    -- // Foreign Key Constraints
    CONSTRAINT `fk_book_author`
        FOREIGN KEY (`author_id`) 
        REFERENCES `authors`(`id`)
        ON DELETE RESTRICT, -- // Prevents deleting an author if they still have books
       
    
    CONSTRAINT `fk_book_user`
        FOREIGN KEY (`user_id`) 
        REFERENCES `users`(`id`)
        ON DELETE CASCADE -- // If a user deletes their account, their books are also deleted
        
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- // --------------------------------------------------------
-- // Table `discussions`
-- // --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `discussions` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `user_1_id` INT NOT NULL,
    `user_2_id` INT NOT NULL,
    `last_message_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    -- // Foreign Key Constraints
    CONSTRAINT `fk_discussion_user_1`
        FOREIGN KEY (`user_1_id`) 
        REFERENCES `users`(`id`),
        
    CONSTRAINT `fk_discussion_user_2`
        FOREIGN KEY (`user_2_id`) 
        REFERENCES `users`(`id`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- // --------------------------------------------------------
-- // Table `messages`
-- // --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `messages` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `discussion_id` INT NOT NULL,
    `user_id` INT NOT NULL,
    `content` TEXT NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    -- // Foreign Key Constraints
    CONSTRAINT `fk_message_discussion`
        FOREIGN KEY (`discussion_id`) 
        REFERENCES `discussions`(`id`)
        ON DELETE CASCADE, -- // If a discussion is deleted, its messages are also deleted
        
    
    CONSTRAINT `fk_message_user`
        FOREIGN KEY (`user_id`) 
        REFERENCES `users`(`id`)
        
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
