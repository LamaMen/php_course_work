CREATE TABLE PLACE
(
    id          INT PRIMARY KEY AUTO_INCREMENT,
    title       VARCHAR(255) NOT NULL,
    description TEXT         NOT NULL,
    ownerId     INT          NOT NULL,
    FOREIGN KEY (ownerId) REFERENCES USERS (id)
);

CREATE TABLE EXCURSION
(
    id            INT PRIMARY KEY,
    excursionDate DATETIME     NOT NULL,
    destination   VARCHAR(255) NOT NULL,
    peopleNumber  INT          NOT NULL,
    price         INT          NOT NULL,
    FOREIGN KEY (id) REFERENCES PLACE (id)
);

CREATE VIEW ORDINARY_PLACE AS
SELECT id, title, description, ownerId, get_place_rating(id) as rating
FROM PLACE p
WHERE id not in (SELECT id FROM EXCURSION);

CREATE TABLE IMAGE
(
    id      INT PRIMARY KEY AUTO_INCREMENT,
    path    VARCHAR(255) NOT NULL,
    placeId INT          NOT NULL,
    FOREIGN KEY (placeId) REFERENCES PLACE (id)
);

CREATE TABLE COMMENT
(
    id          INT PRIMARY KEY AUTO_INCREMENT,
    userId      INT  NOT NULL,
    placeId     INT  NOT NULL,
    commentText TEXT NOT NULL,
    rating      INT  NOT NULL,
    FOREIGN KEY (userId) REFERENCES USERS (id),
    FOREIGN KEY (placeId) REFERENCES PLACE (id)
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
    WHERE c.placeId = placeId
    GROUP BY c.placeId;

    RETURN result;
END $$;
