<?php

namespace PTK\Console\Form\Helper;

/**
 * Helpers para o systema operacional
 *
 * @author Everton
 */
class System {
    
    const WINDOWS = 'windows';
    const LINUX = 'linux';
    
    /**
     * 
     * @return string
     */
    public static function getOS()
    {
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            return self::WINDOWS;
        }

        return self::LINUX;
    }
}
