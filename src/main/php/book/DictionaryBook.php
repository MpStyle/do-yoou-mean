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

use mpstyle\doyoumean\entity\DictionaryWord;
use mpstyle\doyoumean\entity\Sentence;
use mpstyle\doyoumean\entity\Word;
use mpstyle\doyoumean\repository\DictionaryRepository;

/**
 * With DictionaryBook class you can modify the dictionary:
 * <ul>
 *  <li>Add word(s)</li>
 *  <li>Update word</li>
 *  <li>Delete word</li>
 * </ul>
 *
 * @package mpstyle\doyoumean\book
 */
class DictionaryBook extends WordBook
{
    /**
     * @var DictionaryRepository
     */
    private $repo;

    /**
     * DictionaryBook constructor requires a {@link DictionaryRepository} where there are the BL to manage the
     * dictionary and to search a suggested word.
     *
     * @param DictionaryRepository $repo
     */
    public function __construct( DictionaryRepository $repo )
    {
        $this->repo = $repo;
    }

    /**
     * Add a {@link Word} to the dictionary
     *
     * @param Word $word
     * @return bool
     * @throws \Exception
     */
    public function addWord( Word $word )
    {
        if( $this->isValidWord( $word ) === false )
        {
            throw new \Exception( 'Invalid $word, it can not empty or equals to null' );
        }

        return $this->repo->addWord( $word );
    }

    /**
     * Adds all words of {@link Sentence} into the dictionary.
     *
     * @param Sentence $sentence
     * @throws \Exception
     */
    public function addSentence( Sentence $sentence )
    {
        $words = explode( ' ', $sentence->getSentence() );

        foreach( $words as $word )
        {
            $dictionaryWord = new DictionaryWord();
            $dictionaryWord->setWord( $this->removePunctuation( $word ) )
                ->setLanguage( $sentence->getLanguage() );

            $this->addWord( $dictionaryWord );
        }
    }

    /**
     * Remove a {@link Word} from the dictionary.
     *
     * @param Word $word
     * @return bool
     * @throws \Exception
     */
    public function removeWord( Word $word )
    {
        if( $this->isValidWord( $word ) === false )
        {
            throw new \Exception( 'Invalid $word, it can not empty or equals to null' );
        }

        return $this->repo->removeWord( $word );
    }

    /**
     * Update a {@link Word} of the dictionary
     *
     * @param Word $old
     * @param Word $new
     * @return bool
     * @throws \Exception
     */
    public function updateWord( Word $old, Word $new )
    {
        if( $this->isValidWord( $old ) === false || $this->isValidWord( $new ) === false )
        {
            throw new \Exception( 'Invalid $old or $new, they can not empty or equal to null' );
        }

        return $this->repo->updateWord( $old, $new );
    }
}