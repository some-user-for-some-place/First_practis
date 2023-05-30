<?php
namespace app\forms;

use std, gui, framework, app;

global $give_ball;
global $max_ball;
global $vibor;
global $Num_vop;
global $schetchic;

class EnterFIO extends AbstractForm
{

    /**
     * @event buttonAlt.action 
     */
    function doButtonAltAction(UXEvent $e = null)    //"Подтвердить"
    {    
       global $vibor;
        
        $index = $this -> form('TestList') -> listView -> focusedIndex;
        $vibor = $this -> form('TestList') -> listView -> items[$index];
        
        if (fs::exists("FIOinfo.txt") == true)
        {
            if ($this -> edit -> text != "" && $this -> editAlt -> text != "" && $this -> edit3 -> text != "")
            {
                $fd = fopen("FIOinfo.txt", 'a') or die("не удалось создать файл");
                $str1 = $this -> edit -> text;
                $str1 = base64_encode($str1);
                $str2 = $this -> editAlt -> text;
                $str2 = base64_encode($str2);
                $str3 = $this -> edit3 -> text;
                $str3 = base64_encode($str3);
                $str4 = $vibor;
                $str4 = base64_encode($str4);
                $time = Time::now();
                $time = base64_encode($time);
                $tx_1 = "Дата&Время прохождения:";
                $tx_1 = base64_encode($tx_1);
                $tx_2 = "Имя&Фамилия:";
                $tx_2 = base64_encode($tx_2);
                $tx_3 = "Класс:";
                $tx_3 = base64_encode($tx_3);
                $tx_4 = "|";
                $tx_4 = base64_encode($tx_4);
                $tx_5 = ",";
                $tx_5 = base64_encode($tx_5);
                
                fputs($fd, "$tx_1 $time $tx_4 ");
                fputs($fd, "$str4 $tx_4 ");
                fputs($fd, "$tx_2 $str1 $tx_5 ");
                fputs($fd, "$str2 $tx_4 ");
                fputs($fd, "$tx_3 $str3 $tx_4 ");
                fclose($fd);
                
                $this -> edit -> enabled = false;
                $this -> editAlt -> enabled = false;
                $this -> edit3 -> enabled = false;
                
                $this -> buttonAlt -> enabled = false;
                $this -> buttonAlt -> color = "black";
                
                $this -> label12 -> visible = false;
                $this -> label13 -> visible = false;
                $this -> label14 -> visible = false;
                
                $this -> button3 -> enabled = false;
                $this -> button3 -> color = "black";
                
                $this -> button -> enabled = true;
                global $color;
                if ($color == 2)
                {$this -> button -> color = "663366";}
                else 
                {$this -> button -> color = "6680e6";}
            }
            
            else 
            {
                if ($this -> edit -> text == "") {$this -> label12 -> visible = true;}
                else {$this -> label12 -> visible = false;}
                if ($this -> editAlt -> text == "") {$this -> label13 -> visible = true;}
                else {$this -> label13 -> visible = false;}
                if ($this -> edit3 -> text == "") {$this -> label14 -> visible = true;}
                else {$this -> label14 -> visible = false;}
            }
        }
        
        else 
        {
            Stream::putContents("FIOinfo.txt", "");
            if ($this -> edit -> text != "" && $this -> editAlt -> text != "" && $this -> edit3 -> text != "")
            {
                $fd = fopen("FIOinfo.txt", 'a') or die("не удалось создать файл");
                $str1 = $this -> edit -> text;
                $str1 = base64_encode($str1);
                $str2 = $this -> editAlt -> text;
                $str2 = base64_encode($str2);
                $str3 = $this -> edit3 -> text;
                $str3 = base64_encode($str3);
                $str4 = $vibor;
                $str4 = base64_encode($str4);
                $time = Time::now();
                $time = base64_encode($time);
                $tx_1 = "Дата&Время прохождения:";
                $tx_1 = base64_encode($tx_1);
                $tx_2 = "Имя&Фамилия:";
                $tx_2 = base64_encode($tx_2);
                $tx_3 = "Класс:";
                $tx_3 = base64_encode($tx_3);
                $tx_4 = "|";
                $tx_4 = base64_encode($tx_4);
                $tx_5 = ",";
                $tx_5 = base64_encode($tx_5);
                
                fputs($fd, "$tx_1 $time $tx_4 ");
                fputs($fd, "$str4 $tx_4 ");
                fputs($fd, "$tx_2 $str1 $tx_5 ");
                fputs($fd, "$str2 $tx_4 ");
                fputs($fd, "$tx_3 $str3 $tx_4 ");
                fclose($fd);
                
                $this -> edit -> enabled = false;
                $this -> editAlt -> enabled = false;
                $this -> edit3 -> enabled = false;
                
                $this -> buttonAlt -> enabled = false;
                $this -> buttonAlt -> color = "black";
                
                $this -> label12 -> visible = false;
                $this -> label13 -> visible = false;
                $this -> label14 -> visible = false;
                
                $this -> button -> enabled = true;
                global $color;
                if ($color == 2)
                {$this -> button -> color = "663366";}
                else 
                {$this -> button -> color = "6680e6";}
            }
            
            else 
            {
                if ($this -> edit -> text == "") {$this -> label12 -> visible = true;}
                else {$this -> label12 -> visible = false;}
                if ($this -> editAlt -> text == "") {$this -> label13 -> visible = true;}
                else {$this -> label13 -> visible = false;}
                if ($this -> edit3 -> text == "") {$this -> label14 -> visible = true;}
                else {$this -> label14 -> visible = false;}
            }
            
        }
        
         
    }

    /**
     * @event button.action 
     */
    function doButtonAction(UXEvent $e = null)        //"Начать тест"
    {    
        global $give_ball;
        global $max_ball;
        global $vibor;
        
        $index = $this -> form('TestList') -> listView -> focusedIndex;
        $vibor = $this -> form('TestList') -> listView -> items[$index];        // Запоминаем выбранный тест
        
        global $give_ball;
        $give_ball = 0;
        global $schetchic;
        $schetchic = 0;
        global $max_ball;
        $max_ball = 0;
        global $Num_vop;
        $Num_vop = 1;
        $this -> form('TestWindow') -> label -> text = "Вопрос №1";
            
        $directory = new File($vibor);
        $list = [];
        foreach ($directory->findFiles() as $one) 
        {
            if ($one->isDirectory()) 
            { 
                $list[] = $one;
            }
        }
        
        for ($worker = 0; $worker < count($list); $worker++)
        {
            $col_bal = Stream::getContents("$list[$worker]/ball.txt");
            $col_bal = base64_decode($col_bal);
            $this -> label -> text = "$col_bal";
            $max_ball_pre = $this -> label -> text;
            $max_ball_pre = (int)$max_ball_pre;
            $max_ball = $max_ball + $max_ball_pre;
        }
        
        $this -> form('TestWindow') -> doTextAreaConstruct();
        
        $this -> form('TestList') -> button3 -> enabled = true;
        global $color;
        if ($color == 2)
        {$this -> form('TestList') -> button3 -> color = "663366";}
        else 
        {$this -> form('TestList') -> button3 -> color = "6680e6";}
        
        $this -> form('TestList') -> listView -> enabled = true;
        
        $this -> form('TestList') -> buttonAlt -> enabled = false;
        $this -> form('TestList') -> buttonAlt -> color = "black";
        
        $this -> edit -> clear();
        $this -> editAlt -> clear();
        $this -> edit3 -> clear();
        
        $this -> buttonAlt -> enabled = true;
        global $color;
        if ($color == 2)
        {$this -> buttonAlt -> color = "663366";}
        else 
        {$this -> buttonAlt -> color = "6680e6";}
        
        $this -> edit -> enabled = true;
        $this -> editAlt -> enabled = true;
        $this -> edit3 -> enabled = true;
        
        $this -> button -> enabled = false;
        $this -> button -> color = "black";
        
        $this -> label12 -> visible = false;
        $this -> label13 -> visible = false;
        $this -> label14 -> visible = false;
        
        $this -> form('TestWindow') -> show();
        $this -> form('TestList') -> hide();
        $this -> form('EnterFIO') -> hide();
    }

    /**
     * @event button3.action 
     */
    function doButton3Action(UXEvent $e = null)
    {    
        $this -> edit -> clear();
        $this -> label12 -> visible = false;
        
        $this -> editAlt -> clear();
        $this -> label13 -> visible = false;
        
        $this -> edit3 -> clear();
        $this -> label14 -> visible = false;
        
        $this -> form('TestList') -> button3 -> enabled = true;
        global $color;
        if ($color == 2)
        {$this -> form('TestList') -> button3 -> color = "663366";}
        else 
        {$this -> form('TestList') -> button3 -> color = "6680e6";}
        
        $this -> form('TestList') -> listView -> enabled = true;
        
        $this -> form('TestList') -> buttonAlt -> enabled = false;
        $this -> form('TestList') -> buttonAlt -> color = "black";
        
        $this -> form('TestList') -> show();
        $this -> form('EnterFIO') -> hide();
    }

    /**
     * @event show 
     */
    function doShow(UXWindowEvent $e = null)
    {    
        global $color;
        
        if ($color == 2)
        {
            $this -> label8 -> textColor = "white";
            $this -> label10 -> textColor = "white";
            $this -> label9 -> textColor = "white";
            $this -> label11 -> textColor = "white";
            $this -> button3 -> color = "663366";
            $this -> buttonAlt -> color = "663366";
            
            $this -> edit -> style = '-fx-background-color: black; -fx-text-fill: white';
            $this -> editAlt -> style = '-fx-background-color: black; -fx-text-fill: white';
            $this -> edit3 -> style = '-fx-background-color: black; -fx-text-fill: white';
            
            $this -> layout -> style = '-fx-background-color: #333333'; 
        }
        else
        {
            $this -> label8 -> textColor = "black";
            $this -> label10 -> textColor = "black";
            $this -> label9 -> textColor = "black";
            $this -> label11 -> textColor = "black";
            $this -> button3 -> color = "6680e6";
            $this -> buttonAlt -> color = "6680e6"; 
            
            $this -> edit -> style = '-fx-background-color: #e6e6e6; -fx-text-fill: black';
            $this -> editAlt -> style = '-fx-background-color: #e6e6e6; -fx-text-fill: black';
            $this -> edit3 -> style = '-fx-background-color: #e6e6e6; -fx-text-fill: black';
            
            $this -> layout -> style = '-fx-background-color: white';
        }
    }
    


}
