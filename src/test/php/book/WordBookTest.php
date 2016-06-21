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

use mpstyle\doyoumean\book\WordBook;
use mpstyle\doyoumean\entity\DictionaryWord;

class WordBookTest extends \PHPUnit_Framework_TestCase
{
    public function test_isValidWord()
    {
        $correctWord = "ciao";
        $incorrectWord = "ciao!";

        $cw = new DictionaryWord( 'it', $correctWord );
        $iw = new DictionaryWord( 'it', $incorrectWord );

        $book = new WordBook();

        $this->assertTrue( $book->isValidWord( $cw ) );
        $this->assertFalse( $book->isValidWord( $iw ) );
    }

    public function test_removePunctuation()
    {
        $word = "ciao";
        $punctuationWord = "ciao!";

        $book = new WordBook();

        $this->assertEquals( $word, $book->removePunctuation( $punctuationWord ) );
    }
}
