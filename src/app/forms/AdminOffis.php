<?php
namespace app\forms;

use std, gui, framework, app;
use php\io\Stream;
use php\util\Scanner;
use php\io\IOException;

class AdminOffis extends AbstractForm
{

    /**
     * @event button.action 
     */
    function doButtonAction(UXEvent $e = null)    // Создать тест
    {    
        fs::makeDir("Tests");
             
        $this -> form('CreateTest') -> show();
        $this -> form('AdminOffis') -> hide();
    }

    /**
     * @event buttonAlt.action 
     */
    function doButtonAltAction(UXEvent $e = null)
    {    
        $this -> form('Menu') -> show();
        $this -> form('AdminOffis') -> hide();
    }

    /**
     * @event button3.action 
     */
    function doButton3Action(UXEvent $e = null)    // Поменять пароль
    {    
        $this -> form('repass') -> show();
    }

    /**
     * @event button4.action 
     */
    function doButton4Action(UXEvent $e = null)
    {    
        $this -> form('TestEndListing') -> textArea -> clear();
        
        if (fs::exists("FIOinfo.txt") == true)
        {
            try 
            {
                $file = Stream::of('FIOinfo.txt');
                $scanner = new Scanner($file);
            
                $lines = [];
            
                while ($scanner->hasNextLine()) 
                {
                     $line = $scanner->nextLine();
                     $lines[] = $line;
                }
            
                $file->close();
            } 
            catch (IOException $e) 
            {
                alert('Ошибка чтения файла');
            }
            
            for ($worker = 0; $worker < count($lines); $worker++)
            {
                $lines[$worker] = base64_decode($lines[$worker]);
            }
            
            for ($worker = 0; $worker < count($lines); $worker++)
            {
                $decadance = $lines[$worker];
                $this -> form('TestEndListing') -> textArea -> appendText("$decadance \n");
            }
            
            $this -> form('TestEndListing') -> show();
            $this -> form('AdminOffis') -> hide();
        }
        else 
        {
            $this -> form('TestEndListing') -> show();
            $this -> form('AdminOffis') -> hide();
        }
        
    }

    /**
     * @event button5.action 
     */
    function doButton5Action(UXEvent $e = null)        //"Редактировать тест"
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
        
        $this -> form('TestRed') -> listView -> items -> clear();
        
        for ($worker = 0; $worker < count($list); $worker++)
        {
            $this -> form('TestRed') -> listView -> items -> add($list[$worker]);
        } 
        
        $this -> form(TestRed) -> buttonAlt -> enabled = false;
        $this -> form(TestRed) -> buttonAlt -> color = "black";
        $this -> form(TestRed) -> button3 -> enabled = false;
        $this -> form(TestRed) -> button3 -> color = "black";
        $this -> form(TestRed) -> button4 -> enabled = false;
        $this -> form(TestRed) -> button4 -> color = "black";
        
        $this -> form('TestRed') -> show();
        $this -> form('AdminOffis') -> hide();
    }

    /**
     * @event button6.action 
     */
    function doButton6Action(UXEvent $e = null)
    {  
        if (fs::exists("Tests/") == true)
        {
            open("Tests/");
        }
        else 
        {
            pre("Дириктория не была обнаружена. Она будет автоматически создана.");
            fs::makeDir("Tests");
            open("Tests/");
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
            $this -> buttonAlt -> color = "663366";
            $this -> button3 -> color = "663366";
            $this -> button4 -> color = "663366";
            $this -> button5 -> color = "663366";
            $this -> button6 -> color = "663366";
            $this -> layout -> style = '-fx-background-color: #333333'; 
        }
        else
        {
            $this -> label -> textColor = "black";
            $this -> button -> color = "6680e6";
            $this -> buttonAlt -> color = "6680e6";
            $this -> button3 -> color = "6680e6";
            $this -> button4 -> color = "6680e6";
            $this -> button5 -> color = "6680e6";
            $this -> button6 -> color = "6680e6";
            $this -> layout -> style = '-fx-background-color: white';
        }
    }


}
