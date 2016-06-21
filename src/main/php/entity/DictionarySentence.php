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
 * Class DictionarySentence wraps a localized dictionary sentence.
 *
 * @package mpstyle\doyoumean\entity
 */
class DictionarySentence implements Sentence
{
    /**
     * @var string
     */
    private $sentence;

    /**
     * @var string
     */
    private $language;

    /**
     * @return string
     */
    public function getSentence()
    {
        return $this->sentence;
    }

    /**
     * @param string $sentence
     * @return DictionarySentence
     */
    public function setSentence( $sentence )
    {
        $this->sentence = $sentence;

        return $this;
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
     * @return DictionarySentence
     */
    public function setLanguage( $language )
    {
        $this->language = $language;

        return $this;
    }


}