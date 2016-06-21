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

namespace mpstyle\doyoumean\entity;

/**
 * Class AlternativeWord wraps the suggested word.
 *
 * @package mpstyle\doyoumean\entity
 */
class AlternativeWord extends DictionaryWord
{
    /**
     * @var integer
     */
    private $distance;

    /**
     * AlternativeWord constructor.
     *
     * @param string $language
     * @param string $word
     * @param int $distance
     */
    public function __construct( $language, $word, $distance )
    {
        parent::__construct( $language, $word );
        $this->distance = $distance;
    }

    /**
     * Returns the Levenshtein distance between the searched word and this word.
     *
     * @return int
     */
    public function getDistance()
    {
        return $this->distance;
    }

    /**
     * Stes the Levenshtein distance between the searched word and this word.
     *
     * @param int $distance
     * @return AlternativeWord
     */
    public function setDistance( $distance )
    {
        $this->distance = $distance;

        return $this;
    }


}