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

namespace mpstyle\doyoumean\api;

use mpstyle\doyoumean\book\DictionaryBook;
use mpstyle\doyoumean\book\DoYouMeanBook;
use mpstyle\doyoumean\repository\factory\RepositoryFactory;

/**
 * Class DoYouMean is the entry point of the library.
 * You can use this class to modify the dictionary and to require a suggested word.
 *
 * @package mpstyle\doyoumean\api
 */
class DoYouMean
{
    /**
     * @var DictionaryBook
     */
    private $dictionaryBook;

    /**
     * @var DoYouMeanBook
     */
    private $doYouMeanBook;

    /**
     * DoYouMean constructor.
     *
     * @param RepositoryFactory $factory
     */
    public function __construct( RepositoryFactory $factory )
    {
        $this->dictionaryBook = new DictionaryBook( $factory->getRepositoryContainer()->getDictionaryRepository() );
        $this->doYouMeanBook = new DoYouMeanBook( $factory->getRepositoryContainer()->getDoYouMeanRepository() );
    }

    /**
     * @return DictionaryBook
     */
    public function getDictionaryBook()
    {
        return $this->dictionaryBook;
    }

    /**
     * @return DoYouMeanBook
     */
    public function getDoYouMeanBook()
    {
        return $this->doYouMeanBook;
    }

}