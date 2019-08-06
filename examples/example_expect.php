<?php
/**
 * Simple example for patError and patErrorManager
 *
 * $Id: example_expect.php 21 2004-04-17 20:27:33Z schst $
 *
 * @author		gERD Schaufelberger <gerd@php-tools.net>
 * @copyright	PHP Application Tools
 * @license		LGPL, see license.txt for details
 *
 * @see		http://www.php-tools.net
 */

    /**
     * patErrorManager class
     */
    include_once '../patErrorManager.php';

    // setup handler for each error-level
    patErrorManager::setErrorHandling(E_ERROR, 'verbose');
    patErrorManager::setErrorHandling(E_WARNING, 'verbose');
    patErrorManager::setErrorHandling(E_NOTICE, 'echo');

    echo 'Sometimes errors will be expected.<br>';
    patErrorManager::pushExpect(array('ex_123', 'ex_456'));
    patErrorManager::pushExpect(array('ex_55', 'ex_66', 'ex_77', 'ex_88', 'ex_99'));
    patErrorManager::pushExpect(111);

    $expects = patErrorManager::getExpect();
    echo '<pre><b>expects</b><br>';
    print_r($expects);
    echo '</pre>';

    $e = patErrorManager::raiseNotice(
        'notExpected_111',
        'This is just a notice.',
        'Care for it, or leave it.'
    );

    if (patErrorManager::isError($e)) {
        echo 'This error was not expected<br>';
    }

    $some_thing_serious = false;
    if ($some_thing_serious) {
        $e = patErrorManager::raiseError(
            'ex_99',
            'This is an error.',
            'Someting serious error has happend.'
        );
    } else {
        patErrorManager::popExpect();
    }

    $expects = patErrorManager::getExpect();
    echo '<pre><b>expects</b><br>';
    print_r($expects);
    echo '</pre>';

    exit;
