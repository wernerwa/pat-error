<?php
/**
 * custom patErrorManager handler for the callback error handling mode
 *
 * Provides the pat-teams favourite error handlers.
 *
 * $Id: patErrorHandlerDebug.php 40 2005-05-07 08:30:24Z argh $
 *
 * @access		public
 * @package		patError
 * @subpackage	Debug
 */
 
 $GLOBALS['_pat_errorsCounter'] = 0;
 $GLOBALS['_pat_errorStylesPrinted'] = false;

/**
 * custom patErrorManager handler for the callback error handling mode
 *
 * @package		patErrorManager
 * @subpackage	Debug
 * @author		gERD Schaufelberger <gerd@php-tools.net>
 * @author		Stephan Schmidt <schst@php-tools.net>
 * @author 		Sebastian 'The Argh' Mordziol <argh@php-tools.net>
 * @version		0.1
 * @license		LGPL
 * @link		http://www.php-tools.net
 */
class   patErrorHandlerDebug
{
	/**
	* niceDie - outputs a nicely formatted version of the traditional die()
	*
	* @static
	* @access	public
	* @param	string	$error	The error message to display
	*/
    function niceDie( $error )
    {
		echo	'<html>
					<body bgcolor="#ffffff" text="#000000">
					<div style="padding:20px;">
						<div style="font-family:tahoma;font-size:12px;font-weight:bold;margin-bottom:10px;">critical Error encountered [patDebugErrorHandler]</div>
						<table cellpadding="0" cellspacing="0" border="0">
							<tr valign="top">
								<td>Error details</td>
								<td>&nbsp;:&nbsp;</td>
								<td>
									<pre>';
										print_r( $error );
		echo	'					</pre>
								</td>
							</tr>
						</table>
					</div>
					</body>
					</html>';
					
		exit();
    }

   /**
	* error handler that outputs nice debugging HTML
	*
	* Displays:
	* - Error level
	* - Error Message
	* - Error info
	* - Error file
	* - Error line
	* - plus the call stack that lead to the error
	*
	* The output has been inspired by Derick Rethan's xDebug.
	*
	* @author	Stephan Schmidt <schst@php-tools.net>
	* @access	public
	* @static
	* @param	object		error object
	* @return	object		error object
	* @todo		console output (no HTML)
	*/
	function &schstDebug( &$error )
	{
		echo	'<div style="backgound-color:#ffffff;">';
		printf(
				'<strong>%s:</strong> %s (Userinfo: %s) in %s on line %s<br />',
				patErrorManager::translateErrorLevel( $error->getLevel() ),
				$error->getMessage(),
				$error->getInfo(),
				$error->getFile(),
				$error->getLine()
			);

		$backtrace	=	$error->getBacktrace();
		if( is_array( $backtrace ) )
		{
			$j	=	1;
			echo	'<table border="1" cellpadding="2" cellspacing="1" style="border-width:1px; border-style:solid; border-color:#000000;">';
			echo	'	<tr>';
			echo	'		<td colspan="3" align="center"><strong>Call stack</strong></td>';
			echo	'	</tr>';
			echo	'	<tr>';
			echo	'		<td><strong>#</strong></td>';
			echo	'		<td><strong>Function</strong></td>';
			echo	'		<td><strong>Location</strong></td>';
			echo	'	</tr>';
			for( $i = count( $backtrace )-1; $i >= 0 ; $i-- )
			{
				echo	'	<tr>';
				echo	"		<td>{$j}</td>";
				if( isset( $backtrace[$i]['class'] ) )
				{
					echo	"	<td>{$backtrace[$i]['class']}{$backtrace[$i]['type']}{$backtrace[$i]['function']}()</td>";
				}
				else
				{
					echo	"	<td>{$backtrace[$i]['function']}()</td>";
				}
				if( isset( $backtrace[$i]['file'] ) )
				{
					echo	"		<td>{$backtrace[$i]['file']}:{$backtrace[$i]['line']}</td>";
				}
				else
				{
					echo	"		<td>&nbsp;</td>";
				}
				echo	'	</tr>';
				$j++;
			}
			echo	'</table>';
		}
		echo	'</div>';
		
		$level	=	$error->getLevel();
		
		if( $level != E_ERROR )
			return	$error;
			
		exit();
	}

   /**
	* Error handler that outputs pretty debugging HTML
	*
	* Displays:
	* - Error level
	* - Error Message
	* - Error info
	* - Error file
	* - Error line
	* - plus the call stack that lead to the error
	*
	* The output has been inspired by Schst's debug, updated for a
	* designer's eye.
	*
	* @author	Sebastian Mordziol <argh@php-tools.net>
	* @access	public
	* @static
	* @param	object		error object
	* @return	object		error object
	*/
	function &arghDebug( &$error )
	{
		$GLOBALS['_pat_errorsCounter'] = $GLOBALS['_pat_errorsCounter'] + 1;
		$prefix = 'arghDebug';
		$errorColors = array(
			E_NOTICE => 'F6F6F6',
			E_WARNING => 'FEFCF3',
			E_ERROR => 'FFE3CA',
		);
		
		// display the styles definition, but only once
		if( !$GLOBALS['_pat_errorStylesPrinted'] ) {
			echo '<style>';
			echo '.'.$prefix.'Frame{';
			echo '	background-color:#'.$errorColors[E_ERROR].';';
			echo '	padding:8px;';
			echo '	border:solid 1px #000000;';
			echo '	margin-top:13px;';
			echo '	margin-bottom:25px;';
			echo '	width:100%;';
			echo '}';
			echo '.'.$prefix.'Frame'.E_NOTICE.'{';
			echo '	background-color:#'.$errorColors[E_NOTICE].';';
			echo '}';
			echo '.'.$prefix.'Frame'.E_WARNING.'{';
			echo '	background-color:#'.$errorColors[E_WARNING].';';
			echo '}';
			echo '.'.$prefix.'Frame'.E_ERROR.'{';
			echo '	background-color:#'.$errorColors[E_ERROR].';';
			echo '}';
			echo '.'.$prefix.'Table{';
			echo '	border-collapse:collapse;';
			echo '	margin-top:13px;';
			echo '	width:100%;';
			echo '  display:none;';
			echo '}';
			echo '.'.$prefix.'TD{';
			echo '	padding:3px;';
			echo '	padding-left:5px;';
			echo '	padding-right:5px;';
			echo '	border:solid 1px #999999;';
			echo '}';
			echo '.'.$prefix.'Type{';
			echo '	background-color:#cc0000;';
			echo '	color:#ffffff;';
			echo '	font-weight:bold;';
			echo '	padding:3px;';
			echo '}';
			echo '.'.$prefix.'BakLink{';
			echo '  cursor:pointer;';
			echo '  text-decoration:underline;';
			echo '  color:#990000;';
			echo '  margin-top:6px;';
			echo '}';
			echo '.'.$prefix.'Text{';
			echo '  font:normal 10pt Verdana,Arial,Tahoma,Helvetica,sans-serif,monospace;';
			echo '}';
			echo '</style>';
			echo '<script language="javascript" type="text/javascript">';
			echo 'function '.$prefix.'DisplayBacktrace( errorID ) {';
			echo '  var btnEl = document.getElementById( \''.$prefix.'Backtrace\' + errorID + \'Link\' );';
			echo '  var bakEl = document.getElementById( \''.$prefix.'Backtrace\' + errorID );';
			echo '  btnEl.style.display = \'none\';';
			echo '  bakEl.style.display = \'block\';';
			echo '}';
			echo '</script>';
			
			$GLOBALS['_pat_errorStylesPrinted'] = true;
		}
	
		echo	'<div class="'.$prefix.'Frame '.$prefix.'Frame'.$error->getLevel().'">';
		printf(
				'<div style="margin-bottom:8px;" class="'.$prefix.'Text"><span class="'.$prefix.'Type">%s:</span> %s in %s on line %s</div>',
				patErrorManager::translateErrorLevel( $error->getLevel() ),
				$error->getMessage(),
				$error->getFile(),
				$error->getLine()
			);

		echo '<div class="'.$prefix.'Text">Details: ';
		$details = $error->getInfo();
		if( !empty( $details ) ) {
			echo $details;
		} else {
			echo '<i>no additional info available</i>';
		}
		echo '</div>';
		echo '<div id="'.$prefix.'Backtrace'.$GLOBALS['_pat_errorsCounter'].'Link" onclick="'.$prefix.'DisplayBacktrace( \''.$GLOBALS['_pat_errorsCounter'].'\' );" class="'.$prefix.'BakLink '.$prefix.'Text">Display full backtrace &raquo;</div>';


		$backtrace	=	$error->getBacktrace();
		if( is_array( $backtrace ) )
		{
			$j	=	1;
			echo	'<table border="0" cellpadding="0" cellspacing="0" class="'.$prefix.'Table '.$prefix.'Text" id="'.$prefix.'Backtrace'.$GLOBALS['_pat_errorsCounter'].'">';
			echo	'	<tr>';
			echo	'		<td class="'.$prefix.'TD"><strong>#</strong></td>';
			echo	'		<td class="'.$prefix.'TD"><strong>Function</strong></td>';
			echo	'		<td class="'.$prefix.'TD"><strong>Location</strong></td>';
			echo	'	</tr>';
			for( $i = count( $backtrace )-1; $i >= 0 ; $i-- )
			{
				echo	'	<tr>';
				echo	'		<td class="'.$prefix.'TD">'.$j.'</td>';
				if( isset( $backtrace[$i]['class'] ) )
				{
					echo	'	<td class="'.$prefix.'TD">'.$backtrace[$i]['class'].$backtrace[$i]['type'].$backtrace[$i]['function'].'()</td>';
				}
				else
				{
					echo	'	<td class="'.$prefix.'TD">'.$backtrace[$i]['function'].'()</td>';
				}
				if( isset( $backtrace[$i]['file'] ) )
				{
					echo	'		<td class="'.$prefix.'TD">'.$backtrace[$i]['file'].':'.$backtrace[$i]['line'].'</td>';
				}
				else
				{
					echo	'		<td class="'.$prefix.'TD">&nbsp;</td>';
				}
				echo	'	</tr>';
				$j++;
			}
			echo	'</table>';
		}
		echo	'</div>';
		
		$level	=	$error->getLevel();
		
		if( $level != E_ERROR )
			return	$error;
			
		exit();
	}
}
?>