CREATE TABLE USERS
(
    id          INT PRIMARY KEY AUTO_INCREMENT,
    first_name  VARCHAR(255)                             NOT NULL,
    second_name VARCHAR(255)                             NOT NULL,
    email       VARCHAR(255) UNIQUE                      NOT NULL,
    passwd      VARCHAR(255)                             NOT NULL,
    u_role      ENUM ('admin', 'ordinary', 'instructor') NOT NULL
);
