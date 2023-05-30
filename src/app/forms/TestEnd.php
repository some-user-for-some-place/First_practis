<?php
namespace app\forms;

use std, gui, framework, app;
use php\time\Time;

global $give_ball;
global $max_ball;
global $vibor;

class TestEnd extends AbstractForm
{

    /**
     * @event labelAlt.construct 
     */
    function doLabelAltConstruct(UXEvent $e = null)
    {    
        global $give_ball;
        global $max_ball;
        
        $this -> labelAlt -> text = "Вы набрали $give_ball баллов из $max_ball";
        
        $ocenka_five = ($max_ball/100)*80;
        $ocenka_four = ($max_ball/100)*75;
        $ocenka_three = ($max_ball/100)*65;
        $ocenka_two = ($max_ball/100)*50;
           
        $this -> label4 -> text = "Оценка 5 - минимум $ocenka_five балла(ов).";
        $this -> label5 -> text = "Оценка 4 - минимум $ocenka_four балла(ов).";  
        $this -> label6 -> text = "Оценка 3 - минимум $ocenka_three балла(ов).";
        $this -> label7 -> text = "Оценка 2 - $ocenka_two балла(ов) или меньше.";
        
        if ($give_ball == $ocenka_five || $give_ball > $ocenka_five)    
        {
            $this -> label3 -> text = "Ваша оценка: 5";
        }  
        
        if ($give_ball < $ocenka_five && $give_ball >= $ocenka_four)    
        {
            $this -> label3 -> text = "Ваша оценка: 4";
        }    
        
        if ($give_ball < $ocenka_four && $give_ball >= $ocenka_three)    
        {
            $this -> label3 -> text = "Ваша оценка: 3";
        }    
        
        if ($give_ball < $ocenka_three && $give_ball >= $ocenka_two)    
        {
            $this -> label3 -> text = "Ваша оценка: 2";
        } 
        
        if ($give_ball < $ocenka_two)    
        {
            $this -> label3 -> text = "Ваша оценка: 2";
        }    
           
    }

    /**
     * @event button.action 
     */
    function doButtonAction(UXEvent $e = null)                            //"Вернуться в меню"
    {
        global $give_ball;
        global $max_ball;
        
        $fd = fopen("FIOinfo.txt", 'a') or die("не удалось создать файл");
        $str1 = "Получено $give_ball баллов из $max_ball";
        $str1 = base64_encode($str1);
        
        if ($this -> label3 -> text == "Ваша оценка: 5")
        {
            $str2 = "Оценка: 5";
            $str2 = base64_encode($str2);
            
        }
        
        if ($this -> label3 -> text == "Ваша оценка: 4")
        {
            $str2 = "Оценка: 4";
            $str2 = base64_encode($str2);
        }
        
        if ($this -> label3 -> text == "Ваша оценка: 3")
        {
            $str2 = "Оценка: 3";
            $str2 = base64_encode($str2);
        }
        
        if ($this -> label3 -> text == "Ваша оценка: 2")
        {
            $str2 = "Оценка: 2";
            $str2 = base64_encode($str2);
        }
        
        $tx_4 = "|";
        $tx_4 = base64_encode($tx_4);
        fputs($fd, "$str1 $tx_4");
        fputs($fd, "$str2");
        fputs($fd, "\n");
        fclose($fd);
        
        $give_ball = 0;
        $max_ball = 0;
        
        $this -> form(TestList) -> listView -> items -> clear();
        
        $this -> form('Menu') -> show();
        $this -> form('TestEnd') -> hide();
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
            $this -> labelAlt -> textColor = "white";
            $this -> label4 -> textColor = "white";
            $this -> label5 -> textColor = "white";
            $this -> label6 -> textColor = "white";
            $this -> label7 -> textColor = "white";
            $this -> label3 -> textColor = "white";
            $this -> button -> color = "663366";
            $this -> layout -> style = '-fx-background-color: #333333'; 
        }
        else
        {
            $this -> label -> textColor = "black";
            $this -> labelAlt -> textColor = "black";
            $this -> label4 -> textColor = "black";
            $this -> label5 -> textColor = "black";
            $this -> label6 -> textColor = "black";
            $this -> label7 -> textColor = "black";
            $this -> label3 -> textColor = "black";
            $this -> button -> color = "6680e6";
            $this -> layout -> style = '-fx-background-color: white';
        }
        
        $screen = UXScreen::getPrimary();
        $width  = $screen->bounds['width'];
        $height = $screen->bounds['height'];
        $this->fullScreen = true;
         
        $this -> button -> leftAnchor = $width*(40/100);
        $this -> button -> topAnchor = $height*(80/100); // Под вопросом
        $this -> button -> width = $width*(20/100);
        $this -> button -> height = $width*(5/100);
        
        $this -> label -> topAnchor = $height*(25/100);
        $this -> labelAlt -> topAnchor = $height*(35/100);
        $this -> label4 -> topAnchor = $height*(45/100);
        $this -> label5 -> topAnchor = $height*(50/100);
        $this -> label6 -> topAnchor = $height*(55/100);
        $this -> label7 -> topAnchor = $height*(60/100);
        $this -> label3 -> topAnchor = $height*(70/100);
        
    }


    

}
