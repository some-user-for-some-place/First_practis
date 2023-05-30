<?php
namespace app\forms;

use std, gui, framework, app;
use php\io\File;

global $vibor;
global $give_ball;
global $max_ball;
global $schetchic;
global $Num_vop;
$Num_vop = 1;

class TestList extends AbstractForm
{    
        /**
     * @event listView.action 
     */
    function doListViewAction(UXEvent $e = null)                    //Выбор из списка
    {   
        $this -> button3 -> enabled = true;
        
        global $color;
        if ($color == 2)
        {$this -> button3 -> color = "663366";}
        else
        {$this -> button3 -> color = "6680e6";}
    }
    
    
    
        /**
     * @event button3.action 
     */
    function doButton3Action(UXEvent $e = null)                    //"Подтвердить выбор"
    {    
        $this -> buttonAlt -> enabled = true;
        
        global $color;
        if ($color == 2)
        {$this -> buttonAlt -> color = "663366";}
        else
        {$this -> buttonAlt -> color = "6680e6";}
        
        $this -> listView -> enabled = false;
    
        $this -> button3 -> enabled = false;
        $this -> button3 -> color = "black";
    }
    
    
    
        /**
     * @event buttonAlt.action                                     
     */
    function doButtonAltAction(UXEvent $e = null)                //"Пройти тест"
    {   
        $this -> form('EnterFIO') -> edit -> enabled = true;
        $this -> form('EnterFIO') -> editAlt -> enabled = true;
        $this -> form('EnterFIO') -> edit3 -> enabled = true;
        
        $this -> form('EnterFIO') -> buttonAlt -> enabled = true;
        global $color;
        if ($color == 2)
        {$this -> form('EnterFIO') -> buttonAlt -> color = "663366";}
        else 
        {$this -> form('EnterFIO') -> buttonAlt -> color = "6680e6";}
        
        $this -> form('EnterFIO') -> button -> enabled = false;
        $this -> form('EnterFIO') -> button -> color = "black";
        
        $this -> form('EnterFIO') -> button3 -> enabled = true;
        global $color;
        if ($color == 2)
        {$this -> form('EnterFIO') -> button3 -> color = "663366";}
        else 
        {$this -> form('EnterFIO') -> button3 -> color = "6680e6";}
     
        $this -> form('EnterFIO') -> show();
        $this -> form('TestList') -> hide();
    }
    
    
    
        /**
     * @event button.action 
     */
    function doButtonAction(UXEvent $e = null)                        //"<< Назад"
    {    
        $this -> button3 -> enabled = false;
        $this -> button3 -> color = "black";
        
        $this -> listView -> enabled = true;
        $this -> listView -> items -> clear();
        
        $this -> buttonAlt -> enabled = false;
        $this -> buttonAlt -> color = "black";
        
        $this -> form('Menu') -> show();
        $this -> form('TestList') -> hide();
    }

    /**
     * @event show 
     */
    function doShow(UXWindowEvent $e = null)
    {    
        global $color;
        
        if ($color == 2)
        {  
            $this -> button -> color = "663366";
            $this -> layout -> style = '-fx-background-color: #333333';
            $this -> listView -> style = '-fx-background-color: black';
        }
        else
        {
            $this -> listView -> style = '-fx-background-color: white';
            $this -> button -> color = "6680e6"; 
            $this -> layout -> style = '-fx-background-color: white';
        }
    }

    
}
