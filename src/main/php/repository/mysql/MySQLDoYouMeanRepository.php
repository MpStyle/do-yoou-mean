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

use mpstyle\doyoumean\entity\AlternativeWord;
use mpstyle\doyoumean\entity\NoAlternativeWord;
use mpstyle\doyoumean\entity\Word;
use mpstyle\doyoumean\repository\DoYouMeanRepository;
use mpstyle\doyoumean\repository\Repository;

class MySQLDoYouMeanRepository extends Repository implements DoYouMeanRepository
{
    public function __construct( \PDO $connection )
    {
        parent::__construct( $connection );
    }

    /**
     * @param Word $word
     * @return AlternativeWord|null
     */
    public function getAlternativeWord( Word $word )
    {
        $stmt = $this->getConnection()->prepare( "
            SELECT `word`, dym_distance(`word`, ?) AS `distance`
            FROM `dym_dictionary`
            WHERE `lang`=?
            ORDER BY `distance` ASC
            LIMIT 0, 1
        " );

        $stmt->bindParam( 1, $word->getWord() );
        $stmt->bindParam( 2, $word->getLanguage() );

        $stmt->execute();

        $resultSet = $stmt->fetchAll();

        if( count( $resultSet ) == 0 )
        {
            $alternativeWord = new NoAlternativeWord( $word->getLanguage() );
        }
        else
        {
            $alternativeWord = new AlternativeWord(
                $word->getLanguage(),
                $resultSet[0]['word'],
                $resultSet[0]['distance'] );
        }

        return $alternativeWord;
    }
}