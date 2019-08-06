<?php
/**
 * patError error object used by the patFormsError manager as error messages
 * container for precise error management.
 *
 *	$Id: patError.php 45 2008-07-19 17:08:08Z schst $
 */

/**
 * patError error object used by the patFormsError manager as error messages
 * container for precise error management.
 *
 * $Id: patError.php 45 2008-07-19 17:08:08Z schst $
 *
 * @version       0.3
 *
 * @author        gERD Schaufelberger <gerd@php-tools.net>
 * @author        Sebastian Mordziol <argh@php-tools.net>
 * @author        Stephan Schmidt <schst@php-tools.net>
 * @license       LGPL
 *
 * @see          http://www.php-tools.net
 */
class patError
{
    /**
     * stores the error level for this error
     *
     * @var string
     */
    protected $level = null;

    /**
     * stores the code of the error
     *
     * @var string
     */
    protected $code = null;

    /**
     * stores the error message - this is the message that can also be shown the
     * user if need be.
     *
     * @protected        string
     */
    protected $message = null;

    /**
     * additional info that is relevant for the developer of the script (e.g. if
     * a database connect fails, the dsn used) and that the end-user should not
     * see.
     *
     * @protected        string
     */
    protected $info = '';

    /**
     * stores the filename of the file the error occurred in.
     *
     * @protected        string
     */
    protected $file = '';

    /**
     * stores the line number the error occurred in.
     *
     * @protected        integer
     */
    protected $line = 0;

    /**
     * stores the name of the method the error occurred in
     *
     * @protected        string
     */
    protected $function = '';

    /**
     * stores the name of the class (if any) the error occurred in.
     *
     * @protected        string
     */
    protected $class = '';

    /**
     * stores the type of error, as it is listed in the error backtrace
     *
     * @protected        string
     */
    protected $type = '';

    /**
     * stores the arguments the method that the error occurred in had received.
     *
     * @protected        array
     */
    protected $args = array();

    /**
     * stores the complete debug backtrace (if your PHP version has the
     * debug_backtrace function)
     *
     * @protected        mixed
     */
    protected $backtrace = false;

    /**
     * constructor - used to set up the error with all needed error details.
     *
     * @param int    $level The error level (use the PHP constants E_ALL, E_NOTICE etc.).
     * @param string $code  The error code from the application
     * @param string $msg   The error message
     * @param string $info  optional: The additional error information
     */
    public function __construct($level, $code, $msg, $info = null)
    {
        static $raise = array('raise',
                              'raiseerror',
                              'raisewarning',
                              'raisenotice',
                             );

        $this->level = $level;
        $this->code = $code;
        $this->message = $msg;

        if ($info != null) {
            $this->info = $info;
        }

        $this->backtrace = debug_backtrace();

        for ($i = count($this->backtrace) - 1; $i >= 0; --$i) {
            if (in_array($this->backtrace[$i]['function'], $raise)) {
                ++$i;
                if (isset($this->backtrace[$i]['file'])) {
                    $this->file = $this->backtrace[$i]['file'];
                }
                if (isset($this->backtrace[$i]['line'])) {
                    $this->line = $this->backtrace[$i]['line'];
                }
                if (isset($this->backtrace[$i]['class'])) {
                    $this->class = $this->backtrace[$i]['class'];
                }
                if (isset($this->backtrace[$i]['function'])) {
                    $this->function = $this->backtrace[$i]['function'];
                }
                if (isset($this->backtrace[$i]['type'])) {
                    $this->type = $this->backtrace[$i]['type'];
                }
                $this->args = false;
                if (isset($this->backtrace[$i]['args'])) {
                    $this->args = $this->backtrace[$i]['args'];
                }
                break;
            }
        }
    }

    /**
     * returns the error level of the error - corresponds to the PHP
     * error levels (E_ALL, E_NOTICE...)
     *
     * @return int $level    The error level
     *
     * @see        $level
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * retrieves the error message
     *
     * @return string $msg    The stored error message
     *
     * @see        $message
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * retrieves the additional error information (information usually
     * only relevant for developers)
     *
     * @return mixed $info    The additional information
     *
     * @see        $info
     */
    public function getInfo()
    {
        return $this->info;
    }

    /**
     * recieve error code
     *
     * @return string|int error code (may be a string or an integer)
     *
     * @see        $code
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * get the backtrace
     *
     * This is only possible, if debug_backtrace() is available.
     *
     * @return array backtrace
     *
     * @see       $backtrace
     */
    public function getBacktrace()
    {
        return $this->backtrace;
    }

    /**
     * get the filename in which the error occured
     *
     * This is only possible, if debug_backtrace() is available.
     *
     * @return string filename
     *
     * @see       $file
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * get the line number in which the error occured
     *
     * This is only possible, if debug_backtrace() is available.
     *
     * @return int line number
     *
     * @see        $line
     */
    public function getLine()
    {
        return $this->line;
    }
}
