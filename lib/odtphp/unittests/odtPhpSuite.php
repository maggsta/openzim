<?php
/* Copyright (C) 2010 Laurent Destailleur  <eldy@users.sourceforge.net>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA 02111-1307, USA.
 */

/**
 *      This file is a test suite to run all unit tests
 */
print "PHP Version: ".phpversion()."\n";
print "Memory: ". ini_get('memory_limit')."\n";

require_once 'PHPUnit/Framework.php';


/**
 * Class for the All test suite
 */
class odtPHPSuite
{
	public static function suite()
    {
		$suite = new PHPUnit_Framework_TestSuite('PHPUnit Framework');

        require_once dirname(__FILE__).'/odfTest.php';
		$suite->addTestSuite('OdfTest');

        require_once dirname(__FILE__).'/pclZipProxyTest.php';
        $suite->addTestSuite('PclZipProxyTest');

        require_once dirname(__FILE__).'/phpZipProxyTest.php';
        $suite->addTestSuite('PhpZipProxyTest');

        return $suite;
    }
}

?>