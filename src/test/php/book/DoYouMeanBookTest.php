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

namespace mpstyle\doyoumean\test\book;

use mpstyle\doyoumean\book\DictionaryBook;
use mpstyle\doyoumean\book\DoYouMeanBook;
use mpstyle\doyoumean\entity\DictionaryWord;
use mpstyle\doyoumean\entity\SentenceRequest;
use mpstyle\doyoumean\repository\factory\MySQLRepositoryFactory;
use mpstyle\doyoumean\test\helper\DbHelper;

class DoYouMeanBookTest extends \PHPUnit_Framework_TestCase
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
     * @var \PDO
     */
    private $connection;

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        parent::setUp();

        $this->connection = DbHelper::getConnection();
        $factory = new MySQLRepositoryFactory( $this->connection );
        $this->dictionaryBook = new DictionaryBook( $factory->getRepositoryContainer()->getDictionaryRepository() );
        $this->doYouMeanBook = new DoYouMeanBook( $factory->getRepositoryContainer()->getDoYouMeanRepository() );

        $this->connection->exec( 'DELETE FROM `dym_dictionary`' );
    }

    public function test_compute()
    {
        $word01 = new DictionaryWord();
        $word01->setLanguage( 'it' )
            ->setWord( 'ciao' );

        $this->assertTrue( $this->dictionaryBook->addWord( $word01 ) );

        $word02 = new DictionaryWord();
        $word02->setLanguage( 'it' )
            ->setWord( 'mondo' );

        $this->assertTrue( $this->dictionaryBook->addWord( $word02 ) );

        $sentence = new SentenceRequest( 'it', 'ciao mondi' );
        $result = $this->doYouMeanBook->compute( $sentence );

        $this->assertEquals( 'ciao', $result->getWords()[0]->getComputed()->getWord() );
        $this->assertEquals( 'mondo', $result->getWords()[1]->getComputed()->getWord() );
    }
}
