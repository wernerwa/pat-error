<?php
/**
 * patErrorManager example
 *
 * This example demonstrates how to add custom error levels
 *
 * @access      public
 * @package     patError
 * @subpackage  Examples
 * @author      Stephan Schmidt <argh@php-tools.net>
 * @license     LGPL, see license.txt for details
 * @link        http://www.php-tools.net
 */
    /**
     * patErrorManager class
     */
    include('../patErrorManager.php');

    patErrorManager::registerErrorLevel(E_USER_ERROR, 'User Error');

    echo    '<pre>';
    print_r($GLOBALS['_pat_errorHandling']);
    echo    '</pre>';

    patErrorManager::setErrorHandling(E_ALL, 'die');

    patErrorManager::raise(E_USER_ERROR, 500, 'This is an error with a custom error level.');
?>
</body>
</html>
