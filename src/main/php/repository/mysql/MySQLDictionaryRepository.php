<?php
/*
 * This file is part of Do you mean... library.
 *
 * Do you mean... is free software: you can redistribute it and/or modify
 * it under the terms of the LGNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Do you mean... is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * LGNU Lesser General Public License for more details.
 *
 * You should have received a copy of the LGNU Lesser General Public License
 * along with Do you mean... .  If not, see <http://www.gnu.org/licenses/>.
 *
 * @author  Michele Pagnin
 */

namespace mpstyle\doyoumean\repository\mysql;

use mpstyle\doyoumean\entity\Word;
use mpstyle\doyoumean\repository\DictionaryRepository;
use mpstyle\doyoumean\repository\Repository;

class MySQLDictionaryRepository extends Repository implements DictionaryRepository
{
    /**
     * MySQLDictionaryRepository constructor.
     *
     * @param \PDO $connection
     */
    public function __construct( \PDO $connection )
    {
        parent::__construct( $connection );
    }

    /**
     * @param Word $word
     * @return boolean
     */
    public function addWord( Word $word )
    {
        $this->getConnection()->beginTransaction();

        $stmt = $this->getConnection()->prepare( "
            INSERT INTO dym_dictionary (`lang`, `word`)
            VALUES (?, ?);
        " );
        $stmt->bindParam( 1, $word->getLanguage() );
        $stmt->bindParam( 2, $word->getWord() );

        $result = $stmt->execute();
        if( $result )
        {
            $this->getConnection()->commit();
        }
        else
        {
            $this->getConnection()->rollBack();
        }

        return $result;
    }

    /**
     * @param Word $old
     * @param Word $new
     * @return boolean
     */
    public function updateWord( Word $old, Word $new )
    {
        $this->getConnection()->beginTransaction();

        $stmt = $this->getConnection()->prepare( "
            UPDATE dym_dictionary
            SET `lang`=?, `word`=?
            WHERE `lang`=? AND `word`=?
        " );
        $stmt->bindParam( 1, $new->getLanguage() );
        $stmt->bindParam( 2, $new->getWord() );
        $stmt->bindParam( 3, $old->getLanguage() );
        $stmt->bindParam( 4, $old->getWord() );

        $result = $stmt->execute();
        if( $result )
        {
            $this->getConnection()->commit();
        }
        else
        {
            $this->getConnection()->rollBack();
        }

        return $result;
    }

    /**
     * @param Word $word
     * @return boolean
     */
    public function removeWord( Word $word )
    {
        $this->getConnection()->beginTransaction();

        $stmt = $this->getConnection()->prepare( "
            DELETE FROM dym_dictionary
            WHERE `lang`=? AND `word`=?
        " );
        $stmt->bindParam( 1, $word->getLanguage() );
        $stmt->bindParam( 2, $word->getWord() );

        $result = $stmt->execute();
        if( $result )
        {
            $this->getConnection()->commit();
        }
        else
        {
            $this->getConnection()->rollBack();
        }

        return $result;
    }
}