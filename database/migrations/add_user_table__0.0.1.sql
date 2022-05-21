CREATE TABLE USERS
(
    id          INT PRIMARY KEY AUTO_INCREMENT,
    first_name  VARCHAR(255)                             NOT NULL,
    second_name VARCHAR(255)                             NOT NULL,
    email       VARCHAR(255) UNIQUE                      NOT NULL,
    passwd      VARCHAR(255)                             NOT NULL,
    u_role      ENUM ('admin', 'ordinary', 'instructor') NOT NULL
);

INSERT INTO USERS(first_name, second_name, email, passwd, u_role)
VALUES ('Администратор', '', 'admin@mail.com', 'protectedpassword', 'admin');
