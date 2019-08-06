<?php
/**
 * package-config for patTemplate
 *
 * Config to to build PEAR packages
 *
 * $Id$
 *
 * @author      Stephan Schmidt <schst@php-tools.net>
 * @author      gERD Schaufelberger <gerd@php-tools.net>
 * @package     patSessoin
 * @subpackage  Tools
 */

/**
 * package name
 */
$name = 'patError';

/**
 * package summary
 */
$summary = 'Simple and powerful error management package.';

/**
 * current version
 */
$version = '1.2.0';

/**
 * build version appendix
 */
$versionBuild = '';

/**
 * Current API version
 */
$apiVersion = '1.2.0';

/**
 * current state
 */
$state = 'stable';

/**
 * current API stability
 */
$apiStability = 'stable';

/**
 * release notes
 */
$notes = <<<EOT
Changes since 1.1.0:
- Remove PHP4 compatibility (schst)
- Got rid of all E_DEPRECATED and E_NOTICE messages (schst)
- Got rid of all E_STRICT messages (schst)
- Replaced usage of global variables with static class properties (schst)
- Adjusted to PEAR coding guidelines (schst)
EOT;

/**
 * package description
 */
$description = <<<EOT
patError - simple and powerful error managemet system. Inspired by error handling of PEAR.
EOT;

$options    =   array (
    'license'           => 'LGPL',
    'filelistgenerator' => 'svn',
    'ignore'            => array( 'package.php', 'autopackage.php', 'package-config.php', 'package.xml'),
    'simpleoutput'      => true,
    'baseinstalldir'    => 'pat',
    'packagedirectory'  => './',
    'dir_roles'         => array(
                                 'docs' => 'doc',
                                 'examples' => 'doc',
                                 'tests' => 'test',
                                 )
    );

$license    =   array(
        'name'  => 'LGPL',
        'url'   =>  'http://www.gnu.org/copyleft/lesser.txt'
    );

$maintainer     =   array();
$maintainer[]   =   array(
        'role'      => 'lead',
        'handle'    => 'schst',
        'name'      => 'Stephan Schmidt',
        'email'     => 'schst@php-tools.net',
        'active'    => 'yes'
);
$maintainer[]   =   array(
        'role'      => 'lead',
        'handle'    => 'gerd',
        'name'      => 'gERD Schaufelberger',
        'email'     => 'gerd@php-tools.net',
        'active'    => 'yes'
);
$maintainer[]   =   array(
        'role'      => 'developer',
        'handle'    => 'argh',
        'name'      => 'Sebastian Mordziol',
        'email'     => 'argh@php-tools.net',
        'active'    => 'yes'
);

$dependency     =   array();
$channel    =   'pear.php-tools.net';
$require    =   array(
    'php'               =>  '5.0.0',
    'pear_installer'    => '1.4.0'
);
?>