<?php

/**
 * PDO Cache Handler with GZIP support
 * Example usage :
 *      $cnx    =   new PDO("mysql:host=localhost;dbname=mydb", "username", "password");
 *      $Smarty->setCachingType('pdo_gzip');
 *      $Smarty->loadPlugin('Smarty_CacheResource_Pdo_Gzip');
 *      $Smarty->registerCacheResource('pdo_gzip', new Smarty_CacheResource_Pdo_Gzip($cnx, 'smarty_cache'));
 *
 * @require Smarty_CacheResource_Pdo class
 * @author  Beno!t POLASZEK - 2014
 */
require_once 'cacheresource.pdo.php';

class Smarty_CacheResource_Pdo_Gzip extends Smarty_CacheResource_Pdo
{

    /* 
     * Encodes the content before saving to database 
     * 
     * @param string $content 
     * @return string $content 
     * @access protected 
     */
    protected function inputContent($content)
    {
        return gzdeflate($content);
    }

    /* 
     * Decodes the content before saving to database 
     * 
     * @param string $content 
     * @return string $content 
     * @access protected 
     */
    protected function outputContent($content)
    {
        return gzinflate($content);
    }
} 
 