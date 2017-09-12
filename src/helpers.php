<?php
/**
 * In this file, we are defining all the necessary information, 
 * for connection to database.
 * 
 * PHP version 7.1
 *
 * @category  Financial_Apllication
 * @package   RTW_System
 * @author    Ricardo Tobias <ricardosantostobias@yahoo.com.br>
 * @copyright 2017 Ricardo Tobias Ltd
 * @license   https://www.gnu.org/licenses/gpl-3.0.en.html GPL
 * @link      https://cryptic-hollows-97873.herokuapp.com Heroku Application
 */

/** 
 * Função para  gravar imagem em diretório
 * 
 * @param string $date Date of month
 * 
 * @return string
 */ 
function dateParse($date) 
{
    $dateArray = explode('/', $date);
    $dateArray = array_reverse($dateArray);
    return implode('-', $dateArray);
}

/** 
 * Função para  gravar imagem em diretório
 * 
 * @param int $number contain int number
 * 
 * @return object
 */ 
function numberParse($number) 
{
    $newNumber = str_replace('.', '', $number);
    $newNumber = str_replace(',', '.', $newNumber);
    return $newNumber;
}
