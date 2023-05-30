<?php
namespace app\forms;

use std, gui, framework, app;

global $password;
$password = 1;

class Autorization extends AbstractForm
{

    /**
     * @event button.action 
     */
    function doButtonAction(UXEvent $e = null)
    {   
        $this -> passwordField -> clear();
        $this -> labelAlt -> visible = false;
        $this -> form('Autorization') -> hide();
    }

    /**
     * @event passwordField.keyUp-Enter 
     */
    function doPasswordFieldKeyUpEnter(UXKeyEvent $e = null)
    {    
        global $password;
        $pass_enter = $this -> passwordField -> text;
        $pass_file = Stream::getContents("password.txt");
        $pass_file = base64_decode($pass_file);
        
        if ($pass_enter == $pass_file && $pass_enter != "")
        {
            $password = 0;
            $this -> labelAlt -> visible = false;
            $this -> passwordField -> clear();
            $this -> passwordField ->commitValue();
            $this -> form('Menu') -> label -> visible = true;
            $this -> form('Menu') -> separator -> visible = true;
            $this -> form('Menu') -> button3 -> visible = true;
            $this -> form('Menu') -> button3 -> enabled = true;
            $this -> form('AdminOffis') -> show();
            $this -> form('Autorization') -> hide();
            $this -> form('Menu') -> hide();
        }
        
        if ($pass_enter != $pass_file || $pass_enter == "")
        {
            $this -> passwordField -> clear();
            $this -> labelAlt -> visible = true;
        }
    }

    /**
     * @event show 
     */
    function doShow(UXWindowEvent $e = null)
    {    
        global $color;
        
        if ($color == 2)
        {
            $this -> label -> textColor = "white";
            $this -> button -> color = "663366";
            
            $this -> layout -> style = '-fx-background-color: #333333'; 
        }
        else
        {
            $this -> label -> textColor = "black";
            $this -> button -> color = "6680e6";
            $this -> layout -> style = '-fx-background-color: white';
        }
    }


}
