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

namespace mpstyle\doyoumean\test\api;

use mpstyle\doyoumean\api\DoYouMean;
use mpstyle\doyoumean\entity\DictionarySentence;
use mpstyle\doyoumean\entity\DictionaryWord;
use mpstyle\doyoumean\entity\SentenceRequest;
use mpstyle\doyoumean\repository\factory\MySQLRepositoryFactory;
use mpstyle\doyoumean\test\helper\DbHelper;

/**
 * Class DoYouMeanTest tests the code in the README.md file.
 *
 * @package mpstyle\doyoumean\test\api
 */
class DoYouMeanTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \PDO
     */
    private $connection;

    public function test_setRepository()
    {
        $doYouMeanAPI = new DoYouMean(
            new MySQLRepositoryFactory(
                DbHelper::getConnection()
            )
        );

        $this->assertTrue( $doYouMeanAPI instanceof DoYouMean );
    }

    public function test_addWord()
    {
        $doYouMeanAPI = new DoYouMean(
            new MySQLRepositoryFactory(
                $this->connection
            )
        );

        $word = new DictionaryWord();
        $word->setLanguage( 'it' )
            ->setWord( 'ciao' );
        $this->assertTrue( $doYouMeanAPI->getDictionaryBook()->addWord( $word ) );
    }

    public function test_addWords()
    {
        $doYouMeanAPI = new DoYouMean(
            new MySQLRepositoryFactory(
                $this->connection
            )
        );

        $sentence = new DictionarySentence();
        $sentence->setLanguage( 'it' )
            ->setSentence( 'ciao mondo' );
        $doYouMeanAPI->getDictionaryBook()->addSentence( $sentence );

        $this->assertEquals(
            2, count( $this->connection->query( 'SELECT * FROM `dym_dictionary`' )->fetchAll() )
        );
    }

    public function test_SearchSimilarWords()
    {
        $doYouMeanAPI = new DoYouMean(
            new MySQLRepositoryFactory(
                $this->connection
            )
        );

        $sentence = new SentenceRequest( 'it', 'ciao mondo' );
        $result = $doYouMeanAPI->getDoYouMeanBook()->compute( $sentence );

        $this->assertNull( $result->getWords()[0]->getComputed()->getWord() );
    }

    protected function setUp()
    {
        parent::setUp();

        $this->connection = DbHelper::getConnection();
        $this->connection->exec( 'DELETE FROM `dym_dictionary`' );
    }
}
