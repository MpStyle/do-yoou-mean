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

namespace mpstyle\doyoumean\test\helper;

class DbHelper
{
    /**
     * @return \PDO
     */
    public static function getConnection()
    {
        $phinxConfiguration = include __DIR__ . '/../../../../phinx.php';

        $connection = new \PDO(
            sprintf(
                'mysql:host=%s;dbname=%s',
                $phinxConfiguration['environments']['testing']['host'],
                $phinxConfiguration['environments']['testing']['name']
            ),
            $phinxConfiguration['environments']['testing']['user'],
            $phinxConfiguration['environments']['testing']['pass']
        );

        return $connection;
    }
}