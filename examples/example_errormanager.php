<?php
/**
 * patErrorManager example
 *
 * This example demonstrates how to set the error handling for
 * different error levels.
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

    patErrorManager::setErrorHandling(E_ALL, 'die');

    echo    '<pre>';
    print_r($GLOBALS['_pat_errorHandling']);
    echo    '</pre>';

    patErrorManager::setErrorHandling(E_NOTICE | E_WARNING, 'echo');

    echo    '<pre>';
    print_r($GLOBALS['_pat_errorHandling']);
    echo    '</pre>';

    patErrorManager::setErrorHandling(E_ALL ^ E_NOTICE, 'verbose');

    echo    '<pre>';
    print_r($GLOBALS['_pat_errorHandling']);
    echo    '</pre>';
?>
</body>
</html>
