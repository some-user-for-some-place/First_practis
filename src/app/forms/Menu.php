<?php
namespace app\forms;

use std, gui, framework, app;

global $password;
$password = 1;

class Menu extends AbstractForm
{
    /**
     * @event button.action 
     */
    function doButtonAction(UXEvent $e = null)
    {   
        $directory = new File('Tests/');
        $list = [];
        foreach ($directory->findFiles() as $one) 
        {
            if ($one->isDirectory()) 
            { 
                $list[] = $one;
            }
        }
        
        $this -> form(TestList) -> listView -> items -> clear();
        
        for ($worker = 0; $worker < count($list); $worker++)
        {
            $this -> form(TestList) -> listView -> items -> add($list[$worker]);
        } 
        
        $this -> form('TestList') -> button3 -> enabled = false;
        $this -> form('TestList') -> button3 -> color = "black";
        
        $this -> form('TestList') -> show();
        $this -> form('Menu') -> hide();
    }

    /**
     * @event buttonAlt.action 
     */
    function doButtonAltAction(UXEvent $e = null)
    {  
        global $password;
        
        if (fs::exists("password.txt") != true)
        {
            Stream::putContents("password.txt", "VGhpc1Bhc3N3b3JkSXNVc2VkSW5DYXNlT2ZMb3NzT2ZUaGVQYXNzd29yZEZpbGU=");
            pre("Файл password.txt не был обнаружен. Он был создан вновь - новый пароль можете узнать из одноимённого файла в корневой директории.");
        }
        
        if($password == 1)
        {  
            $this -> form('Autorization') -> labelAlt -> visible = false;  
            $this -> form('Autorization') -> show();
        }
        
        if($password == 0)
        {    
            $this -> form('AdminOffis') -> show();
            $this -> form('Menu') -> hide();
        }
    }

    /**
     * @event button3.action 
     */
    function doButton3Action(UXEvent $e = null)
    {    
        global $password;
        $password = 1;
        
        $this -> label -> visible = false;
        $this -> separator -> visible = false;
        $this -> button3 -> visible = false;
        $this -> form('Menu') -> button3 -> enabled = false;
    }

    /**
     * @event button4.action 
     */
    function doButton4Action(UXEvent $e = null)    //Выход из программы (модуль)
    {    
        
    }

    /**
     * @event button5.action 
     */
    function doButton5Action(UXEvent $e = null)
    {   
         $this -> form('style') -> buttonAlt -> enabled = false;
         $this -> form('style') -> buttonAlt -> color = "black";
         $this -> form('style') -> show();
         $this -> form('Menu') -> hide();
    }

    /**
     * @event show 
     */
    function doShow(UXWindowEvent $e = null)
    {    
        global $color;
        
        if (fs::exists("color.txt") == true)
        {
            $this -> labelAlt -> text = Stream::getContents("color.txt");
            $color_pre = $this -> labelAlt -> text;
            $color_pre = (int)$color_pre;
            $color = $color_pre;
            if ($color == 1)
            {
                $this -> label -> textColor = "black"; 
                $this -> button -> color = "6680e6";
                $this -> buttonAlt -> color = "6680e6";
                $this -> button3 -> color = "1a3399";
                $this -> button4 -> color = "1a3399";
                $this -> button5 -> color = "1a3399";
                $this -> layout -> style = '-fx-background-color: white';
            }
            if ($color == 2)
            {
                $this -> label -> textColor = "white";
                $this -> button -> color = "663366";
                $this -> buttonAlt -> color = "663366";
                $this -> button3 -> color = "4d1a4d";
                $this -> button4 -> color = "4d1a4d";
                $this -> button5 -> color = "4d1a4d";
                $this -> layout -> style = '-fx-background-color: #333333';
            }
        }
    }




}
