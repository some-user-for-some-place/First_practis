<?php
namespace app\forms;

use std, gui, framework, app;
use php\io\File;

global $vibor_red;

class TestRed extends AbstractForm
{

    /**
     * @event button.action 
     */
    function doButtonAction(UXEvent $e = null)    // "<< Назад"
    {    
        $this -> button3 -> enabled = false;
        $this -> button3 -> color = "black";
        
        $this -> listView -> enabled = true;
        
        $this -> buttonAlt -> enabled = false;
        $this -> buttonAlt -> color = "black";
        
        $this -> button4 -> enabled = false;
        $this -> button4 -> color = "black";
        
        $this -> listView -> items -> clear();
    
        $this -> form('AdminOffis') -> show();
        $this -> form('TestRed') -> hide();
    }

    /**
     * @event buttonAlt.action 
     */
    function doButtonAltAction(UXEvent $e = null)             // "Редактировать"
    {    
        global $vibor_red;
        
        $index = $this -> listView -> focusedIndex;
        $vibor_red = $this -> listView -> items[$index];        // Запоминаем выбранный тест
        
        $this -> form(TestRedPostList) -> doNumberFieldConstruct();
        
        $this -> form(TestRedPostList) -> textArea -> enabled = false;
        $this -> form(TestRedPostList) -> textAreaAlt -> enabled = false;
        $this -> form(TestRedPostList) -> textArea3 -> enabled = false;
        $this -> form(TestRedPostList) -> textArea4 -> enabled = false;
        $this -> form(TestRedPostList) -> textArea5 -> enabled = false;
        $this -> form(TestRedPostList) -> checkbox -> enabled = false;
        $this -> form(TestRedPostList) -> checkboxAlt -> enabled = false;
        $this -> form(TestRedPostList) -> checkbox3 -> enabled = false;
        $this -> form(TestRedPostList) -> checkbox4 -> enabled = false;
        
        $this -> form(TestRedPostList) -> numberFieldAlt -> enabled = false;
            
        $this -> button3 -> enabled = false;
        $this -> button3 -> color = "black";
        
        $this -> button4 -> enabled = false;
        $this -> button4 -> color = "black";
        
        $this -> listView -> enabled = true;
        
        $this -> buttonAlt -> enabled = false;
        $this -> buttonAlt -> color = "black";
        
        $this -> form('TestRedPostList') -> show();
        $this -> form('TestRed') -> hide();
    }

    /**
     * @event button3.action 
     */
    function doButton3Action(UXEvent $e = null)        //Подтвердить
    {    
        $this -> buttonAlt -> enabled = true;
        global $color;
        if ($color == 2)
        {$this -> buttonAlt -> color = "663366";}
        else
        {$this -> buttonAlt -> color = "6680e6";}
        
        $this -> button4 -> enabled = true;
        global $color;
        if ($color == 2)
        {$this -> button4 -> color = "663366";}
        else 
        {$this -> button4 -> color = "6680e6";}
        
        $this -> listView -> enabled = false;
    
        $this -> button3 -> enabled = false;
        $this -> button3 -> color = "black";
    }

    /**
     * @event listView.action 
     */
    function doListViewAction(UXEvent $e = null)
    {    
        $this -> button3 -> enabled = true;
        global $color;
        if ($color == 2)
        {$this -> button3 -> color = "663366";}
        else 
        {$this -> button3 -> color = "6680e6";}
    }

    /**
     * @event button4.action 
     */
    function doButton4Action(UXEvent $e = null)                //"Удалить"
    {    
        global $vibor_red;
        $index = $this -> listView -> focusedIndex;
        $vibor_red = $this -> listView -> items[$index];        // Запоминаем выбранный тест
        
        fs::clean("$vibor_red");
        fs::delete("$vibor_red");
        
        $directory = new File('Tests/');
        $list = [];
        foreach ($directory->findFiles() as $one) 
        {
            if ($one->isDirectory()) 
            { 
                $list[] = $one;
            }
        }
        
        $this -> listView -> items -> clear();
        
        for ($worker = 0; $worker < count($list); $worker++)
        {
            $this -> listView -> items -> add($list[$worker]);
        } 
        
        pre("Тест удалён.");
        
        $this -> buttonAlt -> enabled = false;
        $this -> buttonAlt -> color = "black";
        $this -> button3 -> enabled = false;
        $this -> button3 -> color = "black";
        $this -> button4 -> enabled = false;
        $this -> button4 -> color = "black";
        $this -> listView -> enabled = true;
          
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
            $this -> button -> color = "6680e6";
            $this -> layout -> style = '-fx-background-color: white';
            $this -> listView -> style = '-fx-background-color: white';
        }
    }





}
