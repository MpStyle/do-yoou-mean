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
 * Class DictionaryWord wraps a localized dictionary word.
 *
 * @package mpstyle\doyoumean\entity
 */
class DictionaryWord implements Word
{
    /**
     * @var string
     */
    private $language;

    /**
     * @var string
     */
    private $word;

    /**
     * DictionaryWord constructor.
     *
     * @param string $language
     * @param string $word
     */
    public function __construct( $language=null, $word=null )
    {
        $this->language = $language;
        $this->word = $word;
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
     * @return DictionaryWord
     */
    public function setLanguage( $language )
    {
        $this->language = $language;

        return $this;
    }

    /**
     * @return string
     */
    public function getWord()
    {
        return $this->word;
    }

    /**
     * @param string $word
     * @return DictionaryWord
     */
    public function setWord( $word )
    {
        $this->word = $word;

        return $this;
    }
}