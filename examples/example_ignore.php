<?php
/**
 * Simple example for patError and patErrorManager
 *
 * @author      gERD Schaufelberger <gerd@php-tools.net>
 * @copyright   PHP Application Tools
 * @license     LGPL, see license.txt for details
 *
 * @see     http://www.php-tools.net
 */

    /**
     * patErrorManager class
     */
    include_once '../patErrorManager.php';

    // setup handler for each error-level
    patErrorManager::setErrorHandling(E_ERROR, 'verbose');
    patErrorManager::setErrorHandling(E_WARNING, 'verbose');
    patErrorManager::setErrorHandling(E_NOTICE, 'echo');

    echo 'Add some error Code that will be ignored permanently.<br>';
    patErrorManager::addIgnore('ignore_111');
    patErrorManager::addIgnore('ignore_222');
    patErrorManager::addIgnore(array('ig_44', 'ig_55', 'ig_66', 'ig_77'));

    $ignores = patErrorManager::getIgnore();
    echo '<pre><b>ignores:</b>';
    print_r($ignores);
    echo '</pre>';

    patErrorManager::raiseNotice(
        'ignore_111',
        'This is just a notice.',
        'Care for it, or leave it.'
    );

    echo 'Remove some error Code from ignore-list.<br>';
    patErrorManager::removeIgnore('ignore_222');
    patErrorManager::removeIgnore(array('ig_55', 'ig_66'));

    $ignores = patErrorManager::getIgnore();
    echo '<pre><b>ignores:</b><br>';
    print_r($ignores);
    echo '</pre>';

    patErrorManager::raiseWarning(
        'ignore_333',
        'If you are a developer, take care for this warning!',
        'Something wants to warn you.'
    );

    patErrorManager::addIgnore('ignore_333');

    patErrorManager::raiseWarning(
        'ignore_333',
        'If you are a developer, take care for this warning!',
        'Something wants to warn you.'
    );

    echo 'Empty ignore-list.<br>';
    patErrorManager::clearIgnore();
    $ignores = patErrorManager::getIgnore();
    echo '<pre><b>ignores:</b><br>';
    print_r($ignores);
    echo '</pre>';

    patErrorManager::raiseNotice(
        'ignore_111',
        'This is just a notice.',
        'Care for it, or leave it.'
    );

    exit;
