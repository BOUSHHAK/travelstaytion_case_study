CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) UNIQUE,
    password VARCHAR(255)
);

INSERT INTO users (username, password) VALUES
('user1', 'pass1'), ('user2', 'pass2'), ('user3', 'pass3'), ('user4', 'pass4'), ('user5', 'pass5'),
('user6', 'pass6'), ('user7', 'pass7'), ('user8', 'pass8'), ('user9', 'pass9'), ('user10', 'pass10'),
('user11', 'pass11'), ('user12', 'pass12'), ('user13', 'pass13'), ('user14', 'pass14'), ('user15', 'pass15'),
('user16', 'pass16'), ('user17', 'pass17'), ('user18', 'pass18'), ('user19', 'pass19'), ('user20', 'pass20'),
('user21', 'pass21'), ('user22', 'pass22'), ('user23', 'pass23'), ('user24', 'pass24'), ('user25', 'pass25'),
('user26', 'pass26'), ('user27', 'pass27'), ('user28', 'pass28'), ('user29', 'pass29'), ('user30', 'pass30'),
('user31', 'pass31'), ('user32', 'pass32'), ('user33', 'pass33'), ('user34', 'pass34'), ('user35', 'pass35'),
('user36', 'pass36'), ('user37', 'pass37'), ('user38', 'pass38'), ('user39', 'pass39'), ('user40', 'pass40'),
('user41', 'pass41'), ('user42', 'pass42'), ('user43', 'pass43'), ('user44', 'pass44'), ('user45', 'pass45'),
('user46', 'pass46'), ('user47', 'pass47'), ('user48', 'pass48'), ('user49', 'pass49'), ('user50', 'pass50');


CREATE TABLE movies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255),
    description TEXT,
    dateOfPublication DATETIME DEFAULT CURRENT_TIMESTAMP,
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

INSERT INTO movies (title, description, dateOfPublication, user_id) VALUES 
('movie1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ', '2025-01-11',4), 
('movie2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ', '2024-12-25', 8), 
('movie3', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ', '2021-01-15', 2), 
('movie4', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ', '1999-03-22', 23), 
('movie5', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ', '2024-11-30', 49), 
('movie6', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ', '2005-04-05', 18), 
('movie7', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ', '2022-10-18', 33), 
('movie8', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ', '2025-02-14', 11), 
('movie9', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ', '2024-09-01', 40), 
('movie10', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ', '2015-05-01', 37);

CREATE TABLE opinions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    movie_id INT,
    type ENUM('like','hate'),
    UNIQUE(user_id, movie_id),
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (movie_id) REFERENCES movies(id)
);

INSERT INTO opinions (user_id, movie_id, type) VALUES 
(1, 3, 'like'), (1, 7, 'hate'), (2, 5, 'like'), (2, 9, 'hate'),
(3, 1, 'hate'), (3, 4, 'like'), (4, 2, 'like'), (4, 8, 'hate'),
(5, 6, 'hate'), (5, 10, 'like'), (6, 3, 'like'), (6, 7, 'hate'),
(7, 1, 'like'), (7, 5, 'hate'), (8, 2, 'hate'), (8, 9, 'like'),
(9, 4, 'like'), (9, 6, 'hate'), (10, 8, 'hate'), (10, 10, 'like'),
(11, 1, 'like'), (11, 3, 'hate'), (12, 2, 'hate'), (12, 7, 'like'),
(13, 4, 'like'), (13, 5, 'hate'), (14, 6, 'hate'), (14, 9, 'like'),
(15, 8, 'like'), (15, 10, 'hate'), (16, 1, 'hate'), (16, 4, 'like'),
(17, 2, 'like'), (17, 3, 'hate'), (18, 5, 'hate'), (18, 7, 'like'),
(19, 6, 'like'), (19, 9, 'hate'), (20, 8, 'hate'), (20, 10, 'like'),
(21, 1, 'like'), (21, 2, 'hate'), (22, 3, 'hate'), (22, 4, 'like'),
(23, 5, 'like'), (23, 6, 'hate'), (24, 7, 'hate'), (24, 9, 'like'),
(25, 8, 'like'), (25, 10, 'hate'), (26, 1, 'hate'), (26, 2, 'like'),
(27, 3, 'like'), (27, 5, 'hate'), (28, 4, 'hate'), (28, 7, 'like'),
(29, 6, 'like'), (29, 8, 'hate'), (30, 9, 'hate'), (30, 10, 'like'),
(31, 1, 'like'), (31, 3, 'hate'), (32, 2, 'hate'), (32, 4, 'like'),
(33, 5, 'like'), (33, 6, 'hate'), (34, 7, 'hate'), (34, 8, 'like'),
(35, 9, 'like'), (35, 10, 'hate'), (36, 1, 'hate'), (36, 2, 'like'),
(37, 3, 'like'), (37, 4, 'hate'), (38, 5, 'hate'), (38, 7, 'like'),
(39, 6, 'like'), (39, 9, 'hate'), (40, 8, 'hate'), (40, 10, 'like'),
(41, 1, 'like'), (41, 2, 'hate'), (42, 3, 'hate'), (42, 5, 'like'),
(43, 4, 'like'), (43, 6, 'hate'), (44, 7, 'hate'), (44, 8, 'like'),
(45, 9, 'like'), (45, 10, 'hate'), (46, 1, 'hate'), (46, 3, 'like'),
(47, 2, 'like'), (47, 4, 'hate'), (48, 5, 'hate'), (48, 6, 'like'),
(49, 7, 'like'), (49, 9, 'hate'), (50, 8, 'hate'), (50, 10, 'like');
