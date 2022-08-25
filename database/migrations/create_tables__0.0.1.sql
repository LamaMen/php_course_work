CREATE TABLE USERS
(
    id          INT PRIMARY KEY AUTO_INCREMENT,
    first_name  VARCHAR(255)                             NOT NULL,
    second_name VARCHAR(255)                             NOT NULL,
    email       VARCHAR(255) UNIQUE                      NOT NULL,
    passwd      VARCHAR(255)                             NOT NULL,
    u_role      ENUM ('admin', 'ordinary', 'instructor') NOT NULL
);

CREATE TABLE ADMIN
(
    id      INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    surname VARCHAR(255),
    FOREIGN KEY (user_id) REFERENCES USERS (id)
);

CREATE TABLE SPECIALIZATION
(
    id   INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255)
);

CREATE TABLE INSTRUCTOR
(
    id                INT PRIMARY KEY AUTO_INCREMENT,
    user_id           INT NOT NULL,
    surname           VARCHAR(255),
    specialization_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES USERS (id),
    FOREIGN KEY (specialization_id) REFERENCES SPECIALIZATION (id)
);



CREATE TABLE PLACE
(
    id          INT PRIMARY KEY AUTO_INCREMENT,
    title       VARCHAR(255) NOT NULL,
    description TEXT         NOT NULL,
    owner_id    INT          NOT NULL,
    FOREIGN KEY (owner_id) REFERENCES USERS (id)
);

CREATE TABLE EXCURSION
(
    id       INT PRIMARY KEY AUTO_INCREMENT,
    place_id INT          NOT NULL,
    address  VARCHAR(255) NOT NULL,
    duration TIME         NOT NULL,
    price    INT          NOT NULL,
    FOREIGN KEY (place_id) REFERENCES PLACE (id)
);

CREATE TABLE SHOWPLACE
(
    id       INT PRIMARY KEY AUTO_INCREMENT,
    place_id INT          NOT NULL,
    address  VARCHAR(255) NOT NULL,
    FOREIGN KEY (place_id) REFERENCES PLACE (id)
);

CREATE TABLE PLACE_IMAGE
(
    id       INT PRIMARY KEY AUTO_INCREMENT,
    photo    TEXT NOT NULL,
    place_id INT  NOT NULL,
    FOREIGN KEY (place_id) REFERENCES PLACE (id)
);

CREATE TABLE COMMENT
(
    id           INT PRIMARY KEY AUTO_INCREMENT,
    user_id      INT  NOT NULL,
    place_id     INT  NOT NULL,
    comment_text TEXT NOT NULL,
    rating       INT  NOT NULL,
    FOREIGN KEY (user_id) REFERENCES USERS (id),
    FOREIGN KEY (place_id) REFERENCES PLACE (id)
);

CREATE TABLE EXCURSION_GROUP
(
    id             INT PRIMARY KEY AUTO_INCREMENT,
    instructor_id  INT      NOT NULL,
    excursion_id   INT      NOT NULL,
    excursion_date DATETIME NOT NULL,
    FOREIGN KEY (instructor_id) REFERENCES INSTRUCTOR (id),
    FOREIGN KEY (excursion_id) REFERENCES EXCURSION (id)
);

CREATE TABLE EXCURSION_ORDER
(
    id       INT PRIMARY KEY AUTO_INCREMENT,
    user_id  INT NOT NULL,
    group_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES USERS (id),
    FOREIGN KEY (group_id) REFERENCES EXCURSION_GROUP (id)
);


CREATE TABLE EXCURSION_INSTRUCTOR
(
    id            INT PRIMARY KEY AUTO_INCREMENT,
    instructor_id INT NOT NULL,
    excursion_id  INT NOT NULL,
    FOREIGN KEY (instructor_id) REFERENCES INSTRUCTOR (id),
    FOREIGN KEY (excursion_id) REFERENCES EXCURSION (id)
);

delimiter $$;
CREATE FUNCTION get_place_rating(placeId INT)
    RETURNS FLOAT
    DETERMINISTIC
BEGIN
    DECLARE result FLOAT DEFAULT 0;

    SELECT avg(c.rating)
    INTO result
    FROM COMMENT c
    WHERE c.place_id = placeId
    GROUP BY c.place_id;

    RETURN result;
END $$;

INSERT INTO USERS(first_name, second_name, email, passwd, u_role)
VALUES ('Администратор', '', 'admin@mail.com', 'protected_password', 'admin');

INSERT INTO ADMIN (user_id, surname)
SELECT id as user_id, '' as surname
FROM USERS
WHERE email = 'admin@mail.com';

INSERT INTO SPECIALIZATION(name)
VALUES ('Гид');
