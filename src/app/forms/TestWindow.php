<?php
namespace app\forms;

use std, gui, framework, app;
use php\gui\UXScreen;

global $vibor;
global $schetchic;
$schetchic = 0;
global $give_ball;
$give_ball = 0;
global $Num_vop;
$Num_vop = 1;

class TestWindow extends AbstractForm
{
    /**
     * @event textArea.construct 
     */
    function doTextAreaConstruct(UXEvent $e = null)                // Окно вопроса
    {                                                                            
        global $vibor;
        global $schetchic;
        
        $directory = new File($vibor);
        $list = [];
        foreach ($directory->findFiles() as $one) 
        {
            if ($one->isDirectory()) 
            { 
                $list[] = $one;
            }
        }
        
        $vopr = Stream::getContents("$list[$schetchic]/vopr.txt");
        $this -> textArea -> text = $vopr;
        
        $otv1 = Stream::getContents("$list[$schetchic]/otv1.txt");
        $otv2 = Stream::getContents("$list[$schetchic]/otv2.txt");
        $otv3 = Stream::getContents("$list[$schetchic]/otv3.txt");
        $otv4 = Stream::getContents("$list[$schetchic]/otv4.txt");
        $col_bal = Stream::getContents("$list[$schetchic]/ball.txt");
        $col_bal = base64_decode($col_bal);
        $this -> label9 -> text = "$col_bal";

        
        $swotch = rand(1, 4);
        
        $worker = 0;
        
        switch ($swotch)
        {
            case 1: {$this -> textAreaAlt -> text = $otv1; $worker = 1; break;}
            case 2: {$this -> textAreaAlt -> text = $otv2; $worker = 2; break;}
            case 3: {$this -> textAreaAlt -> text = $otv3; $worker = 3; break;}
            case 4: {$this -> textAreaAlt -> text = $otv4; $worker = 4; break;}
        }
        
        if ($this -> textAreaAlt -> text != "")
        {
            if ($worker == 1 || $worker == 2)
            {
                $swotch = rand(1, 2);
                switch ($swotch)
                {
                    case 1: {$this -> textArea4 -> text = $otv3; break;}
                    case 2: {$this -> textArea4 -> text = $otv4; break;}
                }
            }   
                    
            if ($worker == 3 || $worker == 4)
            {
                $swotch = rand(1, 2);
                switch ($swotch)
                {
                    case 1: {$this -> textArea4 -> text = $otv1; break;}
                    case 2: {$this -> textArea4 -> text = $otv2; break;}
                }
            }
            
            if ($this -> textArea4 -> text == "$otv3" || $this -> textArea4 -> text == "$otv4")
            {
                if ($worker == 1)
                {
                    $this -> textArea3 -> text = $otv2;
                }
                
                if ($worker == 2)
                {
                    $this -> textArea3 -> text = $otv1;
                }
            }
            
            if ($this -> textArea4 -> text == "$otv1" || $this -> textArea4 -> text == "$otv2")
            {
                if ($worker == 3)
                {
                    $this -> textArea3 -> text = $otv4;
                }
                
                if ($worker == 4)
                {
                    $this -> textArea3 -> text = $otv3;
                }
            }
            
            if ($this -> textAreaAlt -> text != "$otv1" && $this -> textArea4 -> text != "$otv1" && $this -> textArea3 -> text != "$otv1")
            {
                $this -> textArea5 -> text = $otv1;
            }
            if ($this -> textAreaAlt -> text != "$otv2" && $this -> textArea4 -> text != "$otv2" && $this -> textArea3 -> text != "$otv2")
            {
                $this -> textArea5 -> text = $otv2;
            }
            if ($this -> textAreaAlt -> text != "$otv3" && $this -> textArea4 -> text != "$otv3" && $this -> textArea3 -> text != "$otv3")
            {
                $this -> textArea5 -> text = $otv3;
            }
            if ($this -> textAreaAlt -> text != "$otv4" && $this -> textArea4 -> text != "$otv4" && $this -> textArea3 -> text != "$otv4")
            {
                $this -> textArea5 -> text = $otv4;
            }
            
        }
        
        
    }
    
    
    
        /**
     * @event button.action 
     */
    function doButtonAction(UXEvent $e = null)                    // "Подтвердить ответ"
    {    
        global $vibor;
        global $schetchic;
        global $give_ball;
        global $Num_vop;
        $Num_vop = $Num_vop + 1;
        $this -> label -> text = "Вопрос №$Num_vop";
        
        $directory = new File($vibor);
        $list = [];
        foreach ($directory->findFiles() as $one) 
        {
            if ($one->isDirectory()) 
            { 
                $list[] = $one;
            }
        }
            $ball = $this -> label9 -> text;
            $ball = (int)$ball;
            
            $vern_otv_one_proc = 0;
            $vern_otv_two_proc = 0;
            $vern_otv_three_proc = 0;
            $vern_otv_four_proc = 0;
            
            if (fs::exists("$list[$schetchic]/vern_otv_one.txt") == true)
            {
                $vern_otv_one = Stream::getContents("$list[$schetchic]/vern_otv_one.txt");
                $vern_otv_one = base64_decode($vern_otv_one);
                $vern_otv_one_proc = 1;
            } else {$vern_otv_one_proc = 0;}
            
            if (fs::exists("$list[$schetchic]/vern_otv_two.txt") == true)
            {
                $vern_otv_two = Stream::getContents("$list[$schetchic]/vern_otv_two.txt");
                $vern_otv_two = base64_decode($vern_otv_two);
                $vern_otv_two_proc = 1;
            } else {$vern_otv_two_proc = 0;}
            
            if (fs::exists("$list[$schetchic]/vern_otv_three.txt") == true)
            {    
                $vern_otv_three = Stream::getContents("$list[$schetchic]/vern_otv_three.txt");
                $vern_otv_three = base64_decode($vern_otv_three);
                $vern_otv_three_proc = 1;
            } else {$vern_otv_three_proc = 0;}
            
            if (fs::exists("$list[$schetchic]/vern_otv_four.txt") == true)
            {
                $vern_otv_four = Stream::getContents("$list[$schetchic]/vern_otv_four.txt");
                $vern_otv_four = base64_decode($vern_otv_four);
                $vern_otv_four_proc = 1;
            } else {$vern_otv_four_proc = 0;}
            
            $pre_just = $vern_otv_one_proc + $vern_otv_two_proc + $vern_otv_three_proc +  $vern_otv_four_proc;
            $just = 0;
            
            if ($this -> checkbox -> selected == true)
            {     
                if ($this -> textAreaAlt -> text == $vern_otv_one || $this -> textAreaAlt -> text == $vern_otv_two || $this -> textAreaAlt -> text == $vern_otv_three || $this -> textAreaAlt -> text == $vern_otv_four)
                {
                    $just = $just + 1;
                }
                else 
                {
                   $just = $just - 1; 
                }
            }
            
            if ($this -> checkboxAlt -> selected == true)
            {               
                if ($this -> textArea4 -> text == $vern_otv_one || $this -> textArea4 -> text == $vern_otv_two || $this -> textArea4 -> text == $vern_otv_three || $this -> textArea4 -> text == $vern_otv_four)
                {
                    $just = $just + 1;
                }
                else
                {
                   $just = $just - 1; 
                }
            }
            
            if ($this -> checkbox3 -> selected == true)
            {
                if ($this -> textArea3 -> text == $vern_otv_one || $this -> textArea3 -> text == $vern_otv_two || $this -> textArea3 -> text == $vern_otv_three || $this -> textArea3 -> text == $vern_otv_four)
                {
                    $just = $just + 1;
                }
                else
                {
                   $just = $just - 1; 
                }
            }
            
            if ($this -> checkbox4 -> selected == true)
            {
                if ($this -> textArea5 -> text == $vern_otv_one || $this -> textArea5 -> text == $vern_otv_two || $this -> textArea5 -> text == $vern_otv_three || $this -> textArea5 -> text == $vern_otv_four)
                {
                    $just = $just + 1;
                }
                else
                {
                   $just = $just - 1; 
                }
            }
            
            if ($just == $pre_just)
            {
                $give_ball = $give_ball + $ball;
            }
            
            $schetchic = $schetchic + 1;
        
        if ($schetchic == count($list))
        {    
            global $give_ball;
            $schetchic = 0;
            
            $this -> form(TestEnd) -> doLabelAltConstruct();
            
            $this -> button -> enabled = false;
            $this -> button -> color = "black";
            
            $this -> checkbox -> selected = false;
            $this -> checkboxAlt -> selected = false;
            $this -> checkbox3 -> selected = false;
            $this -> checkbox4 -> selected = false;
           
            $this -> form('TestEnd') -> show();
            $this -> form('TestWindow') -> hide();
        }
        
        if ($schetchic < count($list))
        {
            $this -> button -> enabled = false;
            $this -> button -> color = "black";
            
            $this -> checkbox -> selected = false;
            $this -> checkboxAlt -> selected = false;
            $this -> checkbox3 -> selected = false;
            $this -> checkbox4 -> selected = false;
            
            $vopr = Stream::getContents("$list[$schetchic]/vopr.txt");
            $this -> textArea -> text = $vopr;
        
            $otv1 = Stream::getContents("$list[$schetchic]/otv1.txt");
            $otv2 = Stream::getContents("$list[$schetchic]/otv2.txt");
            $otv3 = Stream::getContents("$list[$schetchic]/otv3.txt");
            $otv4 = Stream::getContents("$list[$schetchic]/otv4.txt");
            $col_bal = Stream::getContents("$list[$schetchic]/ball.txt");
            $col_bal = base64_decode($col_bal);
            $this -> label9 -> text = "$col_bal";
            
            $swotch = rand(1, 4);
        
            $worker = 0;
        
            switch ($swotch)
            {
                case 1: {$this -> textAreaAlt -> text = $otv1; $worker = 1; break;}
                case 2: {$this -> textAreaAlt -> text = $otv2; $worker = 2; break;}
                case 3: {$this -> textAreaAlt -> text = $otv3; $worker = 3; break;}
                case 4: {$this -> textAreaAlt -> text = $otv4; $worker = 4; break;}
            }
        
            if ($this -> textAreaAlt -> text != "")
            {
                if ($worker == 1 || $worker == 2)
                {
                    $swotch = rand(1, 2);
                    switch ($swotch)
                    {
                        case 1: {$this -> textArea4 -> text = $otv3; break;}
                        case 2: {$this -> textArea4 -> text = $otv4; break;}
                    }
                }           
                if ($worker == 3 || $worker == 4)
                {
                    $swotch = rand(1, 2);
                    switch ($swotch)
                    {
                        case 1: {$this -> textArea4 -> text = $otv1; break;}
                        case 2: {$this -> textArea4 -> text = $otv2; break;}
                    }
                }
                
                if ($this -> textArea4 -> text == "$otv3" || $this -> textArea4 -> text == "$otv4")
                {
                    if ($worker == 1)
                    {
                        $this -> textArea3 -> text = $otv2;
                    }
                    
                    if ($worker == 2)
                    {
                        $this -> textArea3 -> text = $otv1;
                    }
                }
                
                if ($this -> textArea4 -> text == "$otv1" || $this -> textArea4 -> text == "$otv2")
                {
                    if ($worker == 3)
                    {
                        $this -> textArea3 -> text = $otv4;
                    }
                    
                    if ($worker == 4)
                    {
                        $this -> textArea3 -> text = $otv3;
                    }
                }
                
                if ($this -> textAreaAlt -> text != "$otv1" && $this -> textArea4 -> text != "$otv1" && $this -> textArea3 -> text != "$otv1")
                {
                    $this -> textArea5 -> text = $otv1;
                }
                if ($this -> textAreaAlt -> text != "$otv2" && $this -> textArea4 -> text != "$otv2" && $this -> textArea3 -> text != "$otv2")
                {
                    $this -> textArea5 -> text = $otv2;
                }
                if ($this -> textAreaAlt -> text != "$otv3" && $this -> textArea4 -> text != "$otv3" && $this -> textArea3 -> text != "$otv3")
                {
                    $this -> textArea5 -> text = $otv3;
                }
                if ($this -> textAreaAlt -> text != "$otv4" && $this -> textArea4 -> text != "$otv4" && $this -> textArea3 -> text != "$otv4")
                {
                    $this -> textArea5 -> text = $otv4;
                }
            
            }
        }

        
    }
    
    
    
    /**
     * @event buttonAlt.action 
     */
    function doButtonAltAction(UXEvent $e = null)                // "<< Назад"
    {    
        global $schetchic;
        global $give_ball;
        $schetchic = 0;
        $give_ball = 0;
        
        $this -> button -> enabled = false;  
        $this -> button -> color = "black";
        
        $this -> form('TestList') -> button3 -> enabled = false;
        $this -> form('TestList') -> button3 -> color = "black";
        
        $this -> checkbox -> selected = false;
        $this -> checkboxAlt -> selected = false;
        $this -> checkbox3 -> selected = false;
        $this -> checkbox4 -> selected = false;
        
        $this -> checkbox -> enabled = true;
        $this -> checkboxAlt -> enabled = true;
        $this -> checkbox3 -> enabled = true;
        $this -> checkbox4 -> enabled = true;
        
        $this -> textAreaAlt -> enabled = true;
        $this -> textArea4 -> enabled = true;
        $this -> textArea3 -> enabled = true;
        $this -> textArea5 -> enabled = true;
        
        $this -> form('TestList') -> listView -> items -> clear();
        
        $fd = fopen("FIOinfo.txt", 'a') or die("не удалось создать файл");
        $str = "Тест был прерван \n";
        $str = base64_encode($str);
        fputs($fd, $str);
        fputs($fd, "\n");
        fclose($fd);
        
        $this -> form('Menu') -> show();
        $this -> form('TestWindow') -> hide();
    }

    /**
     * @event show 
     */
    function doShow(UXWindowEvent $e = null)
    {   
        global $color;
        
        if ($color == 2)
        {
            $this -> buttonAlt -> color = "663366";
            $this -> label -> textColor = "white";
            $this -> label8 -> textColor = "white";
            $this -> label9 -> textColor = "white";
            $this -> labelAlt -> textColor = "white";
            $this -> label3 -> textColor = "white";
            
            $this -> checkbox -> style = '-fx-text-fill: white';
            $this -> checkboxAlt -> style = '-fx-text-fill: white';
            $this -> checkbox3 -> style = '-fx-text-fill: white';
            $this -> checkbox4 -> style = '-fx-text-fill: white';

            $this -> layout -> style = '-fx-background-color: #333333';
        }
        else
        {
            $this -> buttonAlt -> color = "6680e6";
            $this -> label -> textColor = "black";
            $this -> label8 -> textColor = "black";
            $this -> label9 -> textColor = "black";
            $this -> labelAlt -> textColor = "black";
            $this -> label3 -> textColor = "black";
            
            $this -> checkbox -> style = '-fx-text-fill: black';
            $this -> checkboxAlt -> style = '-fx-text-fill: black';
            $this -> checkbox3 -> style = '-fx-text-fill: black';
            $this -> checkbox4 -> style = '-fx-text-fill: black';
            
            $this -> layout -> style = '-fx-background-color: white';
        }
        
        $screen = UXScreen::getPrimary();
        $width  = $screen->bounds['width'];
        $height = $screen->bounds['height'];
        $this-> fullScreen = true;

        
        // Настраиваем элементы формы на фуллскрин
        
        $this -> label -> height = $height*(10/100);
        
        $this -> textArea -> topAnchor = $height*(10/100);
        $this -> textArea -> height = $height*(25/100);
        
        $this -> label8 -> topAnchor = $height*(35.5/100);    
        $this -> label8 -> height = $height*(4.2/100); 
        
        $this -> label9 -> topAnchor = $height*(35.5/100);
        $this -> label9 -> height = $height*(4.2/100);
        $this -> label9 -> leftAnchor = $this -> label8 -> width + ($this -> label8 -> width/6);
        
        $this -> separator -> topAnchor = $height*(40/100);
        $this -> separator -> height = $height*(2.2/100);
        
        $this -> labelAlt -> topAnchor = $height*(40/100);
        $this -> labelAlt -> height = $height*(10/100);
        
        $this -> label3 -> topAnchor = $height*(46.5/100);
        $this -> label3 -> height = $height*(5/100);
        
        $this -> checkbox -> topAnchor = $height*(51/100);
        $this -> checkbox -> height = $height*(8/100);
        
        $this -> checkboxAlt -> topAnchor = $height*(59.5/100);
        $this -> checkboxAlt -> height = $height*(8/100);
        
        $this -> checkbox3 -> topAnchor = $height*(68/100);
        $this -> checkbox3 -> height = $height*(8/100);
        
        $this -> checkbox4 -> topAnchor = $height*(76.5/100);
        $this -> checkbox4 -> height = $height*(8/100);
        
        $this -> textAreaAlt -> topAnchor = $height*(53/100);
        $this -> textAreaAlt -> height = $height*(3/100);
        $this -> textAreaAlt -> width = $width*(92.5/100);
        
        $this -> textArea4 -> topAnchor = $height*(61/100);
        $this -> textArea4 -> height = $height*(3/100);
        $this -> textArea4 -> width = $width*(92.5/100);
        
        $this -> textArea3 -> topAnchor = $height*(69.5/100);
        $this -> textArea3 -> height = $height*(3/100);
        $this -> textArea3 -> width = $width*(92.5/100);
        
        $this -> textArea5 -> topAnchor = $height*(78/100);
        $this -> textArea5 -> height = $height*(3/100);
        $this -> textArea5 -> width = $width*(92.5/100);
        
        $this -> button -> topAnchor = $height*(92/100);
        $this -> button -> height = $height*(5/100);
        $this -> button -> width = $width*(15/100);
        
        $this -> buttonAlt -> topAnchor = $height*(92/100);
        $this -> buttonAlt -> height = $height*(5/100);
        $this -> buttonAlt -> width = $width*(10/100);
        
    }

    /**
     * @event checkbox.click-Left 
     */
    function doCheckboxClickLeft(UXMouseEvent $e = null) //Проверка первого чекбокса
    {    
        if ($this -> checkbox -> selected == true || $this -> checkboxAlt -> selected == true || $this -> checkbox3 -> selected == true || $this -> checkbox4 -> selected == true)
        {
             $this -> button -> enabled = true;
             global $color;
             if ($color == 2)
             {$this -> button -> color = "663366";}
             else 
             {$this -> button -> color = "6680e6";}
        }
        else 
        {
            $this -> button -> enabled = false;
            $this -> button -> color = "black"; 
        }    
    }

    /**
     * @event checkboxAlt.click-Left 
     */
    function doCheckboxAltClickLeft(UXMouseEvent $e = null)    //Проверка второго чекбокса
    {    
        if ($this -> checkbox -> selected == true || $this -> checkboxAlt -> selected == true || $this -> checkbox3 -> selected == true || $this -> checkbox4 -> selected == true)
        {
            $this -> button -> enabled = true;
            global $color;
            if ($color == 2)
            {$this -> button -> color = "663366";}
            else
            {$this -> button -> color = "6680e6";}    
        }  
        else 
        {
            $this -> button -> enabled = false;
            $this -> button -> color = "black"; 
        } 
    }

    /**
     * @event checkbox3.click-Left 
     */
    function doCheckbox3ClickLeft(UXMouseEvent $e = null)    //Проверка третьего чекбокса
    {    
        if ($this -> checkbox -> selected == true || $this -> checkboxAlt -> selected == true || $this -> checkbox3 -> selected == true || $this -> checkbox4 -> selected == true)
        { 
            $this -> button -> enabled = true;
            global $color;
            if ($color == 2)
            {$this -> button -> color = "663366";}
            else 
            {$this -> button -> color = "6680e6";}
        }  
        else 
        {
            $this -> button -> enabled = false;
            $this -> button -> color = "black";
        } 
    }

    /**
     * @event checkbox4.click-Left 
     */
    function doCheckbox4ClickLeft(UXMouseEvent $e = null) //Проверка четвёртого чекбокса
    {    
        if ($this -> checkbox -> selected == true || $this -> checkboxAlt -> selected == true || $this -> checkbox3 -> selected == true || $this -> checkbox4 -> selected == true)
        {
            $this -> button -> enabled = true;
            global $color;
            if ($color == 2)
            {$this -> button -> color = "663366";}
            else 
            {$this -> button -> color = "6680e6";}
        }  
        else 
        {
            $this -> button -> enabled = false;
            $this -> button -> color = "black";
        } 
    }







}
