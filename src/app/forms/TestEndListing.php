<?php
namespace app\forms;

use std, gui, framework, app;


class TestEndListing extends AbstractForm
{

    /**
     * @event button.action 
     */
    function doButtonAction(UXEvent $e = null)
    {    
        $this -> textArea -> clear();
        $this -> form('AdminOffis') -> show();
        $this -> form('TestEndListing') -> hide();
    }

    /**
     * @event buttonAlt.action 
     */
    function doButtonAltAction(UXEvent $e = null)
    {    
        $fd = fopen("FIOinfo.txt", 'w') or die("не удалось создать файл");
        $str = "";
        fputs($fd, $str);
        fclose($fd);
        
        $this -> textArea -> text = Stream::getContents("FIOinfo.txt");
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
            $this -> buttonAlt -> color = "663366";
            $this -> layout -> style = '-fx-background-color: #333333'; 
        }
        else
        {
            $this -> button -> color = "6680e6";
            $this -> buttonAlt -> color = "6680e6";
            $this -> layout -> style = '-fx-background-color: white';
        }
    }


}
