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

namespace mpstyle\doyoumean\book;

use mpstyle\doyoumean\entity\Word;

/**
 * Class WordBook is an utility class to compute/play with the {@link Word}.
 *
 * @package mpstyle\doyoumean\book
 */
class WordBook
{
    private $punctuationPattern = "/[^A-Za-z]/";

    /**
     * Controls if the $word is valid.
     * A $word is valid if language and word is not null and empty.
     *
     * @param Word $word
     * @return bool
     */
    public function isValidWord( Word $word )
    {
        preg_match( $this->punctuationPattern, $word->getWord(), $matches );

        return !(
            StringBook::isNullOrEmpty( $word->getLanguage() ) ||
            StringBook::isNullOrEmpty( $word->getWord() ) ||
            count( $matches ) > 0
        );
    }

    /**
     * Removes punctuation from $word.
     *
     * @param string $word
     * @return string
     */
    public function removePunctuation( $word )
    {
        return preg_replace( $this->punctuationPattern, "", $word );
    }
}