<?php
namespace app\forms;

use std, gui, framework, app;

global $color;
$color = 0;

class style extends AbstractForm
{


    /**
     * @event buttonAlt.action 
     */
    function doButtonAltAction(UXEvent $e = null)
    {  
        global $color;  
        
        if ($this -> checkbox -> selected == true)
        {
            $this -> layout -> style = '-fx-background-color: white';
            $color = 1;   
            Stream::putContents("color.txt", "$color");
        }
        
        if ($this -> checkboxAlt -> selected == true)
        {
            $this -> layout -> style = '-fx-background-color: #333333';
            $color = 2;
            Stream::putContents("color.txt", "$color");
        }
        
        
        $this -> checkbox -> selected = false;
        $this -> checkboxAlt -> selected = false;
        
        $this -> checkbox -> enabled = true;
        $this -> checkboxAlt -> enabled = true;
        
        $this -> form('Menu') -> show();
        $this -> form('style') -> hide();
    }

    /**
     * @event checkbox.click-Left 
     */
    function doCheckboxClickLeft(UXMouseEvent $e = null)    // C
    { 
        global $color;  
        if($this -> checkbox -> selected == true)
        {
            $color = 1;
            
            $this -> checkboxAlt -> enabled = false;
            $this -> buttonAlt -> enabled = true;
            if ($color == 2)
            {
                $this -> buttonAlt -> color = "663366";
            }
            else
            {
                $this -> buttonAlt -> color = "6680e6";
            }
            
            $this -> label -> textColor = "black";
            $this -> checkbox -> textColor = "black";
            $this -> checkboxAlt -> textColor = "black";
            $this -> layout -> style = '-fx-background-color: white'; 
        }
        else 
        {
            $this -> checkboxAlt -> enabled = true;
            $this -> buttonAlt -> enabled = false;
            $this -> buttonAlt -> color = "black";
            
            $this -> label -> textColor = "black";
            $this -> checkbox -> textColor = "black";
            $this -> checkboxAlt -> textColor = "black";
            $this -> layout -> style = '-fx-background-color: white'; 
        }
    }

    /**
     * @event checkboxAlt.click-Left 
     */
    function doCheckboxAltClickLeft(UXMouseEvent $e = null) // T
    {   
        global $color; 
        if($this -> checkboxAlt -> selected == true)
        {
            $color = 2;
            
            $this -> checkbox -> enabled = false;
            $this -> buttonAlt -> enabled = true;
            
            if ($color == 2)
            {
                $this -> buttonAlt -> color = "663366";
            }
            else
            {
                $this -> buttonAlt -> color = "6680e6";
            }
            $this -> label -> textColor = "white";
            $this -> checkbox -> textColor = "white";
            $this -> checkboxAlt -> textColor = "white";
            $this -> layout -> style = '-fx-background-color: #333333';
        }
        else 
        {
            $color = 0;
            $this -> checkbox -> enabled = true;
            $this -> buttonAlt -> enabled = false;
            $this -> buttonAlt -> color = "black";
            
            $this -> label -> textColor = "black";
            $this -> checkbox -> textColor = "black";
            $this -> checkboxAlt -> textColor = "black";
            $this -> layout -> style = '-fx-background-color: white'; 
        }
    }

    /**
     * @event show 
     */
    function doShow(UXWindowEvent $e = null)
    {    
        global $color;
        
        if ($color == 1)
        {
            $this -> label -> textColor = "black";
            $this -> checkbox -> textColor = "black";
            $this -> checkboxAlt -> textColor = "black";
            $this -> buttonAlt -> color = "black";
            $this -> layout -> style = '-fx-background-color: white'; 
        }
        if ($color == 2)
        {
            $this -> label -> textColor = "white";
            $this -> checkbox -> textColor = "white";
            $this -> checkboxAlt -> textColor = "white";
            $this -> buttonAlt -> color = "black";
            $this -> layout -> style = '-fx-background-color: #333333';
        }
    }


}
