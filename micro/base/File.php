<?php /** MicroFile */

namespace Micro\base;

/**
 * MFile io class
 *
 * @author Oleg Lunegov <testuser@mail.linpax.org>
 * @link https://github.com/antivir88/micro
 * @copyright Copyright &copy; 2013 Oleg Lunegov
 * @license /LICENSE
 * @package micro
 * @version 1.0
 * @since 1.0
 */
class File
{
    /**
     * Recursive copy files
     *
     * @access public
     * @param string $src
     * @param string $dst
     * @return void
     */
    public static function recurseCopy($src, $dst)
    {
        $dir = opendir($src);
        @mkdir($dst, 0777);

        while (false !== ($file = readdir($dir))) {
            if (($file != '.') && ($file != '..')) {
                if (is_dir($src . '/' . $file)) {
                    self::recurseCopy($src . '/' . $file, $dst . '/' . $file);
                } else {
                    copy($src . '/' . $file, $dst . '/' . $file);
                    @chmod($dst . '/' . $file, 0666);
                }
            }
        }
        closedir($dir);
    }

    /**
     * Recursive copy files if edited
     *
     * @access public
     * @param string $src
     * @param string $dst
     * @param string $exc
     * @return void
     */
    public static function recurseCopyIfEdited($src = '', $dst = '', $exc = '.php')
    {
        $dir = opendir($src);
        @mkdir($dst, 0777);

        while (false !== ($file = readdir($dir))) {
            if (($file != '.') && ($file != '..')) {
                if (is_dir($src . '/' . $file)) {
                    self::recurseCopyIfEdited($src . '/' . $file, $dst . '/' . $file);
                } else {
                    if (substr($src . '/' . $file, strlen($src . '/' . $file) - strlen($exc)) != $exc) {
                        if (!file_exists($dst . '/' . $file)) {
                            copy($src . '/' . $file, $dst . '/' . $file);
                            @chmod($dst . '/' . $file, 0666);
                        } elseif (filemtime($src . '/' . $file) != filemtime($dst . '/' . $file)) {
                            copy($src . '/' . $file, $dst . '/' . $file);
                            @chmod($dst . '/' . $file, 0666);
                        }
                    }
                }
            }
        }
        closedir($dir);
    }
}