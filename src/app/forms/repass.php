<?php
namespace app\forms;

use std, gui, framework, app;


class repass extends AbstractForm
{

    /**
     * @event button.action 
     */
    function doButtonAction(UXEvent $e = null)
    {
       $this -> passwordField -> clear();
       $this -> passwordField ->commitValue();
       $this -> form('repass') -> hide();
    }

    /**
     * @event passwordField.globalKeyUp-Enter 
     */
    function doPasswordFieldGlobalKeyUpEnter(UXKeyEvent $e = null)
    {    
        $repass = base64_encode($this -> passwordField -> text);
        $fd = fopen("password.txt", 'w') or die("не удалось создать файл");
        $str = $repass;
        fputs($fd, $str);
        fclose($fd);
        
        $this -> passwordField -> clear();
        $this -> passwordField ->commitValue();
        $this -> form('repass') -> hide();
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
