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
use mpstyle\doyoumean\entity\SentenceRequest;
use mpstyle\doyoumean\entity\SentenceResult;
use mpstyle\doyoumean\entity\WordResponse;
use mpstyle\doyoumean\repository\DoYouMeanRepository;

class DoYouMeanBook extends WordBook
{
    /**
     * @var DoYouMeanRepository
     */
    private $repo;

    /**
     * DictionaryBook constructor.
     *
     * @param DoYouMeanRepository $repo
     */
    public function __construct( DoYouMeanRepository $repo )
    {
        $this->repo = $repo;
    }

    /**
     * @param SentenceRequest $request
     * @return SentenceResult
     */
    public function compute( SentenceRequest $request )
    {
        $result = new SentenceResult();
        $result->setRequest( $request );

        $wordsRequest = explode( ' ', $request->getSentence() );
        $wordsResult = array();

        foreach( $wordsRequest as $wordRequest )
        {
            $dictionaryWord = new DictionaryWord();
            $dictionaryWord
                ->setLanguage( $request->getLanguage() )
                ->setWord( $wordRequest );

            $alternativeWord = $this->repo->getAlternativeWord( $dictionaryWord );
            $wordsResult[] = new WordResponse(
                $wordRequest,
                $alternativeWord
            );
        }

        $result->setWords( $wordsResult );

        return $result;
    }
}