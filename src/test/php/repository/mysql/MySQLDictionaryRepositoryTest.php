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
use mpstyle\doyoumean\repository\factory\MySQLRepositoryFactory;
use mpstyle\doyoumean\test\helper\DbHelper;

class MySQLDictionaryRepositoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var DictionaryRepository
     */
    private $repository;

    /**
     * @var \PDO
     */
    private $connection;

    public function test_addWord()
    {
        $this->assertTrue(
            count( $this->connection->query( 'SELECT * FROM `dym_dictionary`' )->fetchAll() ) == 0
        );

        $word = new DictionaryWord();
        $word->setLanguage( 'it' )
            ->setWord( 'ciao' );

        $this->assertTrue( $this->repository->addWord( $word ) );

        $this->assertTrue(
            count( $this->connection->query( 'SELECT * FROM `dym_dictionary`' )->fetchAll() ) > 0
        );
    }

    public function test_removeWord()
    {
        $this->assertTrue(
            count( $this->connection->query( 'SELECT * FROM `dym_dictionary`' )->fetchAll() ) == 0
        );

        $word = new DictionaryWord();
        $word->setLanguage( 'it' )
            ->setWord( 'ciao' );

        $this->assertTrue( $this->repository->addWord( $word ) );
        $this->assertTrue( $this->repository->removeWord( $word ) );

        $this->assertTrue(
            count( $this->connection->query( 'SELECT * FROM `dym_dictionary`' )->fetchAll() ) == 0
        );
    }

    public function test_updateWord()
    {
        $this->assertTrue(
            count( $this->connection->query( 'SELECT * FROM `dym_dictionary`' )->fetchAll() ) == 0
        );

        $word01 = new DictionaryWord();
        $word01->setLanguage( 'it' )
            ->setWord( 'ciao' );

        $this->assertTrue( $this->repository->addWord( $word01 ) );

        $word02 = new DictionaryWord();
        $word02->setLanguage( 'it' )
            ->setWord( 'ciao' );

        $this->assertTrue( $this->repository->updateWord( $word01, $word02 ) );

        $array = $this->connection->query( 'SELECT * FROM `dym_dictionary`' )->fetchAll();

        $this->assertEquals(
            $array[0]['lang'], $word02->getLanguage()
        );

        $this->assertEquals(
            $array[0]['word'], $word02->getWord()
        );
    }

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        parent::setUp();

        $this->connection = DbHelper::getConnection();
        $factory = new MySQLRepositoryFactory( $this->connection );
        $this->repository = $factory->getRepositoryContainer()->getDictionaryRepository();

        $this->connection->exec( 'DELETE FROM `dym_dictionary`' );
    }
}
