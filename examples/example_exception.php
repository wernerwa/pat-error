<?php
/**
 * Simple example for patError and patErrorManager
 * @author      Stephan Schmidt <schst@php-tools.net
 * @copyright   PHP Application Tools
 * @package     patError
 * @subpackage  Examples
 * @license     LGPL, see license.txt for details
 * @link        http://www.php-tools.net
 */

/**
 * patErrorManager class
 */
include_once '../patErrorManager.php';

/**
 * Exception class for notices
 */
class NoticeException extends Exception
{
}

patErrorManager::setErrorHandling(E_ALL, 'exception');
patErrorManager::setErrorHandling(E_NOTICE, 'exception', 'NoticeException');

// throw and catch a notice
try {
    // raise some errors and warnings
    patErrorManager::raiseNotice(
        'example_111',
        'This is just a notice.',
        'Care for it, or leave it.'
    );
} catch (Exception $e) {
    echo $e;
}

echo "<p><b>Raise an error</b></p>";
// throw and catch a real exception
try {
    // raise some errors and warnings
    patErrorManager::raiseError(
        'example_112',
        'This is a real error',
        'A different exception class will be used.'
    );
} catch (Exception $e) {
    echo $e;
}
