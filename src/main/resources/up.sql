# This file is part of Do you mean... library.
#
# Do you mean... is free software: you can redistribute it and/or modify
# it under the terms of the LGNU Lesser General Public License as published by
# the Free Software Foundation, either version 3 of the License, or
# (at your option) any later version.
#
# Do you mean... is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# LGNU Lesser General Public License for more details.
#
# You should have received a copy of the LGNU Lesser General Public License
# along with Do you mean... .  If not, see <http://www.gnu.org/licenses/>.
#
# @author  Michele Pagnin

# dym_distance
CREATE FUNCTION dym_distance(s1 VARCHAR(255), s2 VARCHAR(255))
  RETURNS INT
DETERMINISTIC
  BEGIN
    DECLARE s1_len, s2_len, i, j, c, c_temp, cost INT;
    DECLARE s1_char CHAR;
    -- max strlen=255
    DECLARE cv0, cv1 VARBINARY(256);
    SET s1_len = CHAR_LENGTH(s1), s2_len = CHAR_LENGTH(s2), cv1 = 0x00, j = 1, i = 1, c = 0;
    IF s1 = s2
    THEN
      RETURN 0;
    ELSEIF s1_len = 0
      THEN
        RETURN s2_len;
    ELSEIF s2_len = 0
      THEN
        RETURN s1_len;
    ELSE
      WHILE j <= s2_len DO
        SET cv1 = CONCAT(cv1, UNHEX(HEX(j))), j = j + 1;
      END WHILE;
      WHILE i <= s1_len DO
        SET s1_char = SUBSTRING(s1, i, 1), c = i, cv0 = UNHEX(HEX(i)), j = 1;
        WHILE j <= s2_len DO
          SET c = c + 1;
          IF s1_char = SUBSTRING(s2, j, 1)
          THEN
            SET cost = 0;
          ELSE SET cost = 1;
          END IF;
          SET c_temp = CONV(HEX(SUBSTRING(cv1, j, 1)), 16, 10) + cost;
          IF c > c_temp
          THEN SET c = c_temp; END IF;
          SET c_temp = CONV(HEX(SUBSTRING(cv1, j + 1, 1)), 16, 10) + 1;
          IF c > c_temp
          THEN
            SET c = c_temp;
          END IF;
          SET cv0 = CONCAT(cv0, UNHEX(HEX(c))), j = j + 1;
        END WHILE;
        SET cv1 = cv0, i = i + 1;
      END WHILE;
    END IF;
    RETURN c;
  END;

# Dictionary table
CREATE TABLE IF NOT EXISTS dym_dictionary (
  lang VARCHAR(10)  NOT NULL,
  word VARCHAR(200) NOT NULL,
  PRIMARY KEY (lang, word)
);