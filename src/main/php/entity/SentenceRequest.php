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

class SentenceRequest
{
    /**
     * @var string
     */
    private $language;

    /**
     * @var string
     */
    private $sentence;

    /**
     * SentenceRequest constructor.
     *
     * @param string $language
     * @param string $sentence
     */
    public function __construct( $language, $sentence )
    {
        $this->language = $language;
        $this->sentence = $sentence;
    }

    /**
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param string $language
     * @return SentenceRequest
     */
    public function setLanguage( $language )
    {
        $this->language = $language;

        return $this;
    }

    /**
     * @return string
     */
    public function getSentence()
    {
        return $this->sentence;
    }

    /**
     * @param string $sentence
     * @return SentenceRequest
     */
    public function setSentence( $sentence )
    {
        $this->sentence = $sentence;

        return $this;
    }


}