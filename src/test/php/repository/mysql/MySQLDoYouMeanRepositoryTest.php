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

namespace mpstyle\doyoumean\test\repository\mysql;

use mpstyle\doyoumean\entity\DictionaryWord;
use mpstyle\doyoumean\repository\DictionaryRepository;
use mpstyle\doyoumean\repository\DoYouMeanRepository;
use mpstyle\doyoumean\repository\factory\MySQLRepositoryFactory;
use mpstyle\doyoumean\test\helper\DbHelper;

class MySQLDoYouMeanRepositoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var DictionaryRepository
     */
    private $dictionaryRepository;

    /**
     * @var DoYouMeanRepository
     */
    private $doYouMeanRepository;

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
        $this->dictionaryRepository = $factory->getRepositoryContainer()->getDictionaryRepository();
        $this->doYouMeanRepository = $factory->getRepositoryContainer()->getDoYouMeanRepository();

        $this->connection->exec( 'DELETE FROM `dym_dictionary`' );
    }

    /**
     * Same word
     */
    public function test_getAlternativeWord_01()
    {
        $word01 = new DictionaryWord();
        $word01->setLanguage( 'it' )
            ->setWord( 'ciao' );

        $this->assertTrue( $this->dictionaryRepository->addWord( $word01 ) );

        $word02 = new DictionaryWord();
        $word02->setLanguage( 'it' )
            ->setWord( 'buongiorno' );

        $this->assertTrue( $this->dictionaryRepository->addWord( $word02 ) );

        $alternativeWord = $this->doYouMeanRepository->getAlternativeWord( $word01 );

        $this->assertEquals( $word01->getWord(), $alternativeWord->getWord() );
        $this->assertEquals( 0, $alternativeWord->getDistance() );
    }

    public function test_getAlternativeWord_02()
    {
        $word01 = new DictionaryWord();
        $word01->setLanguage( 'it' )
            ->setWord( 'ciao' );

        $this->assertTrue( $this->dictionaryRepository->addWord( $word01 ) );

        $word02 = new DictionaryWord();
        $word02->setLanguage( 'it' )
            ->setWord( 'buongiorno' );

        $this->assertTrue( $this->dictionaryRepository->addWord( $word02 ) );

        $word03 = new DictionaryWord();
        $word03->setLanguage( 'it' )
            ->setWord( 'buonasera' );

        $alternativeWord = $this->doYouMeanRepository->getAlternativeWord( $word03 );

        $this->assertEquals( $word02->getWord(), $alternativeWord->getWord() );
        $this->assertEquals( 5, $alternativeWord->getDistance() );
    }
}
