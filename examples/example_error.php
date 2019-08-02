<?php
/**
 * Simple example for patError and patErrorManager
 * @author      gERD Schaufelberger <gerd@php-tools.net>
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
     * patErrorManagerDebug - just an example
     */
    include_once 'patErrorHandlerDebug.php';
    $errorHandler   =   new patErrorHandlerDebug;

    // setup handler for each error-level
    patErrorManager::setErrorHandling(E_ERROR, 'callback', array( $errorHandler, 'schstDebug' ));
    patErrorManager::setErrorHandling(E_WARNING, 'verbose');
    patErrorManager::setErrorHandling(E_NOTICE, 'echo');

    // raise some errors and warnings
    patErrorManager::raiseNotice(
        'example_111',
        'This is just a notice.',
        'Care for it, or leave it.'
    );

    patErrorManager::raiseWarning(
        'example_333',
        'If you are a developer, take care for this warning!',
        'Something wants to warn you.'
    );

    patErrorManager::setErrorHandling(E_WARNING, 'trigger');

    patErrorManager::raiseWarning(
        'example_333',
        'If you are a developer, take care for this warning!',
        'Something wants to warn you.'
    );

    $bar = foo();

    echo    '<pre>';
    print_r($bar);
    echo    '</pre>';

    exit;

   /**
    * foo function raises an error
    *
    */
    function foo()
    {
        return patErrorManager::raiseError(
            'example_666',
            'A fatal Error occured',
            'Don\'t mind at all, this is just an example'
        );
    }
