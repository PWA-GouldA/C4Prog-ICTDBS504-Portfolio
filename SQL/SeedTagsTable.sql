INSERT IGNORE INTO tags
    (id, tag, description, created_at, updated_at)
VALUES (1, 'TAFE', 'Technical And Further Education', DATE_SUB(NOW(), INTERVAL 20 DAY),
        DATE_SUB(NOW(), INTERVAL 20 DAY));

INSERT IGNORE INTO tags
    (id, tag, description, created_at, updated_at)
VALUES (2, 'ECMAScript', '', DATE_SUB(NOW(), INTERVAL 19 DAY), DATE_SUB(NOW(), INTERVAL 19 DAY));

INSERT IGNORE INTO tags
    (id, tag, description, created_at, updated_at)
VALUES (3, 'PHP', '', DATE_SUB(NOW(), INTERVAL 17 DAY), DATE_SUB(NOW(), INTERVAL 17 DAY)),
       (4, 'MySQL', '', DATE_SUB(NOW(), INTERVAL 15 DAY), DATE_SUB(NOW(), INTERVAL 15 DAY)),
       (5, 'Database', '', DATE_SUB(NOW(), INTERVAL 15 DAY), DATE_SUB(NOW(), INTERVAL 15 DAY)),
       (6, 'Bootstrap', 'Web front end framework', DATE_SUB(NOW(), INTERVAL 15 DAY), DATE_SUB(NOW(), INTERVAL 15 DAY)),
       (7, 'JavaScript', 'Web front-end and back-end programming language, also correctly known as ECMAScript',
        NOW(), NOW()),
       (8, 'AJAX', 'Asynchronous JavaScript and XML', NOW(), NOW()),
       (9, 'LMS', 'Initialism for Learning Management System', NOW(), NOW()),
       (10, 'Object Oriented Programming', '', NOW(), NOW()),
       (11, 'OOP', 'Object Oriented Programming', NOW(), NOW()),
       (12, 'Class', '', NOW(), NOW());

INSERT INTO tags
VALUES (50, "HTML", "Hyper Text Markup Language");
INSERT INTO tags
VALUES (51, "HEAD", "The head, or prologue, of the HTML document");
INSERT INTO tags
VALUES (52, "BODY", "All the other content in the HTML document");
INSERT INTO tags
VALUES (54, "TITLE", "The title of the document");
INSERT INTO tags
VALUES (55, "P", "Paragraph");
INSERT INTO tags
VALUES (null, "BR", "Line Break");
INSERT INTO tags
VALUES (null, "HR", "Horizontal Rule");
INSERT INTO tags
VALUES (null, "A", "Links the current HTML file to another file.");
INSERT INTO tags
VALUES (null, "HR", "Horizontal Rule 2"),
(null, "A", "Links the current HTML file to another file."),
(null, "BODYLINE", "All the other content in the HTML document");
INSERT INTO tags
VALUES (null, "password", "a phrase or word used to help secure data");
