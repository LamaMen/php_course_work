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
