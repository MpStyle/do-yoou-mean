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


class WordResponse
{
    /**
     * @var string
     */
    private $original;

    /**
     * @var AlternativeWord
     */
    private $computed;

    /**
     * WordResponse constructor.
     *
     * @param string $original
     * @param AlternativeWord $computed
     */
    public function __construct( $original, AlternativeWord $computed )
    {
        $this->original = $original;
        $this->computed = $computed;
    }


    /**
     * @return string
     */
    public function getOriginal()
    {
        return $this->original;
    }

    /**
     * @param string $original
     * @return WordResponse
     */
    public function setOriginal( $original )
    {
        $this->original = $original;

        return $this;
    }

    /**
     * @return AlternativeWord
     */
    public function getComputed()
    {
        return $this->computed;
    }

    /**
     * @param AlternativeWord $computed
     * @return WordResponse
     */
    public function setComputed( AlternativeWord $computed )
    {
        $this->computed = $computed;

        return $this;
    }

    /**
     * Returns true if the original word and computed word are equal, otherwise false.
     *
     * @return bool
     */
    public function areEqual()
    {
        return ( $this->original == $this->computed->getWord() );
    }
}