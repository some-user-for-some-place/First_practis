<?php
namespace app\forms;

use std, gui, framework, app;

global $vibor_red;
global $schetchic_two;
$schetchic_two = 0;

class TestRedPostList extends AbstractForm
{

    /**
     * @event buttonAlt.action 
     */
    function doButtonAltAction(UXEvent $e = null)                //"<< Назад"
    {    
        $this -> textArea -> enabled = false;
        $this -> textAreaAlt -> enabled = false;
        $this -> textArea3 -> enabled = false;
        $this -> textArea4 -> enabled = false;
        $this -> textArea5 -> enabled = false;
        $this -> button3 -> enabled = false;
        $this -> button3 -> color = "black";
        $this -> checkbox -> selected = false;
        $this -> checkboxAlt -> selected = false;
        $this -> checkbox3 -> selected = false;
        $this -> checkbox4 -> selected = false;
        
        $this -> textArea -> clear();
        $this -> textAreaAlt -> clear();
        $this -> textArea3 -> clear();
        $this -> textArea4 -> clear();
        $this -> textArea5 -> clear();
        $this -> numberFieldAlt -> value = 0;
        $this -> numberField -> value = 1;
        
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
        
        $this -> form('TestRed') -> buttonAlt -> enabled = false;
        $this -> form('TestRed') -> buttonAlt -> color = "black";
        $this -> form('TestRed') -> button3 -> enabled = false;
        $this -> form('TestRed') -> button3 -> color = "black";
        $this -> form('TestRed') -> button4 -> enabled = false;
        $this -> form('TestRed') -> button4 -> color = "black";
        $this -> textArea6 -> clear();
    
        $this -> form('AdminOffis') -> show();
        $this -> form('TestRedPostList') -> hide();
    }

    /**
     * @event button.action 
     */
    function doButtonAction(UXEvent $e = null)        //"Подтвердить"
    {    
        global $schetchic_two;
        global $vibor_red;
                
        $directory = new File($vibor_red);
        $list = [];
        foreach ($directory->findFiles() as $one) 
        {
            if ($one->isDirectory()) 
            { 
                $list[] = $one;
            }
        }
        
        $schetchic_two = $this -> numberField -> value;
        $schetchic_two = $schetchic_two - 1;
        
        $this -> checkbox -> selected = false;
        $this -> checkboxAlt -> selected = false;
        $this -> checkbox3 -> selected = false;
        $this -> checkbox4 -> selected = false;
        
        $this -> checkbox -> enabled = true;
        $this -> checkboxAlt -> enabled = true;
        $this -> checkbox3 -> enabled = true;
        $this -> checkbox4 -> enabled = true;
              
        $vopr = Stream::getContents("$list[$schetchic_two]/vopr.txt");
        $otv1 = Stream::getContents("$list[$schetchic_two]/otv1.txt");
        $otv2 = Stream::getContents("$list[$schetchic_two]/otv2.txt");
        $otv3 = Stream::getContents("$list[$schetchic_two]/otv3.txt");
        $otv4 = Stream::getContents("$list[$schetchic_two]/otv4.txt");
            
        $ball_pre = Stream::getContents("$list[$schetchic_two]/ball.txt");
        $ball_pre = base64_decode($ball_pre);
        $this -> label9 -> text = $ball_pre;
        $ball = $this -> label9 -> text;
        $ball = (int)$ball;
         
        if (fs::exists("$list[$schetchic_two]/vern_otv_one.txt") == true)   
        {$decadanceOne = Stream::getContents("$list[$schetchic_two]/vern_otv_one.txt"); $decadanceOne = base64_decode($decadanceOne); $this -> label4 -> text = $decadanceOne; $vern_otv_one = $this -> label4 -> text;}
        
        if (fs::exists("$list[$schetchic_two]/vern_otv_two.txt") == true)
        {$decadanceTwo = Stream::getContents("$list[$schetchic_two]/vern_otv_two.txt"); $decadanceTwo = base64_decode($decadanceTwo); $this -> label5 -> text = $decadanceTwo; $vern_otv_two = $this -> label5 -> text;}
        
        if (fs::exists("$list[$schetchic_two]/vern_otv_three.txt") == true)
        {$decadanceThree = Stream::getContents("$list[$schetchic_two]/vern_otv_three.txt"); $decadanceThree = base64_decode($decadanceThree); $this -> label6 -> text = $decadanceThree; $vern_otv_three = $this -> label6 -> text;}
        
        if (fs::exists("$list[$schetchic_two]/vern_otv_four.txt") == true)
        {$decadanceFour = Stream::getContents("$list[$schetchic_two]/vern_otv_four.txt"); $decadanceFour = base64_decode($decadanceFour); $this -> label7 -> text = $decadanceFour; $vern_otv_four = $this -> label7 -> text;}   /// Допили редачку
                
        $this -> textArea -> text = $vopr;
        $this -> textAreaAlt -> text = $otv1;
        $this -> textArea3 -> text = $otv2;
        $this -> textArea4 -> text = $otv3;
        $this -> textArea5 -> text = $otv4;
        $this -> numberFieldAlt -> value = $ball;
            
        if ($this -> textAreaAlt -> text == $vern_otv_one || $this -> textAreaAlt -> text == $vern_otv_two || $this -> textAreaAlt -> text == $vern_otv_three || $this -> textAreaAlt -> text == $vern_otv_four)
        {
            $this -> checkbox -> selected = true;
        }
            
        if ($this -> textArea3 -> text == $vern_otv_one || $this -> textArea3 -> text == $vern_otv_two || $this -> textArea3 -> text == $vern_otv_three || $this -> textArea3 -> text == $vern_otv_four)
        {
            $this -> checkboxAlt -> selected = true;
        }
            
        if ($this -> textArea4 -> text == $vern_otv_one || $this -> textArea4 -> text == $vern_otv_two || $this -> textArea4 -> text == $vern_otv_three || $this -> textArea4 -> text == $vern_otv_four)
        {
            $this -> checkbox3 -> selected = true;
        }
            
        if ($this -> textArea5 -> text == $vern_otv_one || $this -> textArea5 -> text == $vern_otv_two || $this -> textArea5 -> text == $vern_otv_three || $this -> textArea5 -> text == $vern_otv_four)
        {
            $this -> checkbox4 -> selected = true;
        }
            
        $this -> textArea -> enabled = true;
        $this -> textAreaAlt -> enabled = true;
        $this -> textArea3 -> enabled = true;
        $this -> textArea4 -> enabled = true;
        $this -> textArea5 -> enabled = true;
            
        $this -> numberFieldAlt -> enabled = true;
    }

    /**
     * @event numberField.construct 
     */
    function doNumberFieldConstruct(UXEvent $e = null)    //"Ограничение на забивку номера вопроса"
    {    
        global $vibor_red;
        
        $directory = new File($vibor_red);
        $list = [];
        foreach ($directory->findFiles() as $one) 
        {
            if ($one->isDirectory()) 
            { 
                $list[] = $one;
            }
        }
           
        $this -> numberField -> min = 1;
        $this -> numberField -> max = count($list);
    }

    /**
     * @event button3.action 
     */
    function doButton3Action(UXEvent $e = null)    // Сохранить
    {    
        global $schetchic_two;
        global $vibor_red;
                
        $directory = new File($vibor_red);
        $list = [];
        foreach ($directory->findFiles() as $one) 
        {
            if ($one->isDirectory()) 
            { 
                $list[] = $one;
            }
        }
        
        $schetchic_two = $this -> numberField -> value;
        $schetchic_two = $schetchic_two - 1;
        
        $fd = fopen("$list[$schetchic_two]/vopr.txt", 'w') or die("не удалось создать файл");
        $newVopr = $this -> textArea -> text;
        fputs($fd, $newVopr);
        fclose($fd);
        
        $fd = fopen("$list[$schetchic_two]/otv1.txt", 'w') or die("не удалось создать файл");
        $newOtv1 = $this -> textAreaAlt -> text;
        fputs($fd, $newOtv1);
        fclose($fd);
        
        $fd = fopen("$list[$schetchic_two]/otv2.txt", 'w') or die("не удалось создать файл");
        $newOtv2 = $this -> textArea3 -> text;
        fputs($fd, $newOtv2);
        fclose($fd);
        
        $fd = fopen("$list[$schetchic_two]/otv3.txt", 'w') or die("не удалось создать файл");
        $newOtv3 = $this -> textArea4 -> text;
        fputs($fd, $newOtv3);
        fclose($fd);
        
        $fd = fopen("$list[$schetchic_two]/otv4.txt", 'w') or die("не удалось создать файл");
        $newOtv4 = $this -> textArea5 -> text;
        fputs($fd, $newOtv4);
        fclose($fd);
        
        $fd = fopen("$list[$schetchic_two]/ball.txt", 'w') or die("не удалось создать файл");
        $ball = $this -> numberFieldAlt -> value;
        $ball = base64_encode($ball);
        fputs($fd, $ball);
        fclose($fd);
        
        if (fs::exists("$list[$schetchic_two]/vern_otv_one.txt") == true)
        {fs::delete("$list[$schetchic_two]/vern_otv_one.txt");}
        
        if (fs::exists("$list[$schetchic_two]/vern_otv_two.txt") == true)
        {fs::delete("$list[$schetchic_two]/vern_otv_two.txt");}
        
        if (fs::exists("$list[$schetchic_two]/vern_otv_three.txt") == true)
        {fs::delete("$list[$schetchic_two]/vern_otv_three.txt");}
        
        if (fs::exists("$list[$schetchic_two]/vern_otv_four.txt") == true)
        {fs::delete("$list[$schetchic_two]/vern_otv_four.txt");}
        
        if ($this -> checkbox -> selected == true)
        {
            $vern_otv_one = $this -> textAreaAlt -> text;
            $vern_otv_one = base64_encode($vern_otv_one);
            Stream::putContents("$list[$schetchic_two]/vern_otv_one.txt", "$vern_otv_one");
        }
            
        if ($this -> checkboxAlt -> selected == true)
        {
            $vern_otv_two = $this -> textArea3 -> text;
            $vern_otv_two = base64_encode($vern_otv_two);
            Stream::putContents("$list[$schetchic_two]/vern_otv_two.txt", "$vern_otv_two");
        }
            
        if ($this -> checkbox3 -> selected == true)
        {
            $vern_otv_three = $this -> textArea4 -> text;
            $vern_otv_three = base64_encode($vern_otv_three);
            Stream::putContents("$list[$schetchic_two]/vern_otv_three.txt", "$vern_otv_three");
        }
            
        if ($this -> checkbox4 -> selected == true)
        {
            $vern_otv_four = $this -> textArea5 -> text;
            $vern_otv_four = base64_encode($vern_otv_four);
            Stream::putContents("$list[$schetchic_two]/vern_otv_four.txt", "$vern_otv_four");
        }
        
        pre("Изменение в вопросе теста сохранено.");
        
    }

    /**
     * @event button4.action 
     */
    function doButton4Action(UXEvent $e = null)    // Подтвердить изменение темы
    {    
        global $vibor_red;    
        $NewTem = $this -> textArea6 -> text;
        
        rename("$vibor_red", "Tests/$NewTem");
        
        $this -> textArea -> enabled = false;
        $this -> textAreaAlt -> enabled = false;
        $this -> textArea3 -> enabled = false;
        $this -> textArea4 -> enabled = false;
        $this -> textArea5 -> enabled = false;
        $this -> button3 -> enabled = false;
        $this -> button3 -> color = "black";
        $this -> checkbox -> selected = false;
        $this -> checkboxAlt -> selected = false;
        $this -> checkbox3 -> selected = false;
        $this -> checkbox4 -> selected = false;
        
        $this -> textArea -> clear();
        $this -> textAreaAlt -> clear();
        $this -> textArea3 -> clear();
        $this -> textArea4 -> clear();
        $this -> textArea5 -> clear();
        $this -> numberFieldAlt -> value = 0;
        $this -> numberField -> value = 1;
        
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
        
        $this -> form('TestRed') -> buttonAlt -> enabled = false;
        $this -> form('TestRed') -> buttonAlt -> color = "black";
        $this -> form('TestRed') -> button3 -> enabled = false;
        $this -> form('TestRed') -> button3 -> color = "black";
        $this -> form('TestRed') -> button4 -> enabled = false;
        $this -> form('TestRed') -> button4 -> color = "black";
        $this -> textArea6 -> clear();
    
        $this -> form('AdminOffis') -> show();
        $this -> form('TestRedPostList') -> hide();
                
        
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
            $this -> label3 -> textColor = "white";
            $this -> label4 -> textColor = "white";
            $this -> label6 -> textColor = "white";
            $this -> label5 -> textColor = "white";
            $this -> label7 -> textColor = "white";
            $this -> label8 -> textColor = "white";
            $this -> label11 -> textColor = "white";
            $this -> label12 -> textColor = "white";
            $this -> label13 -> textColor = "white";
            $this -> label14 -> textColor = "white";
            $this -> button -> color = "663366";
            $this -> buttonAlt -> color = "663366";
            $this -> button4 -> color = "663366";
            
            $this -> checkbox -> style = '-fx-text-fill: white';
            $this -> checkboxAlt -> style = '-fx-text-fill: white';
            $this -> checkbox3 -> style = '-fx-text-fill: white';
            $this -> checkbox4 -> style = '-fx-text-fill: white';
            
            $this -> layout -> style = '-fx-background-color: #333333';
        }
        else
        {
            $this -> label -> textColor = "black";
            $this -> labelAlt -> textColor = "black";
            $this -> label3 -> textColor = "black";
            $this -> label4 -> textColor = "black";
            $this -> label6 -> textColor = "black";
            $this -> label5 -> textColor = "black";
            $this -> label7 -> textColor = "black";
            $this -> label8 -> textColor = "black";
            $this -> label11 -> textColor = "black";
            $this -> label12 -> textColor = "black";
            $this -> label13 -> textColor = "black";
            $this -> label14 -> textColor = "black";
            $this -> button -> color = "6680e6";
            $this -> buttonAlt -> color = "6680e6";
            $this -> button4 -> color = "6680e6";
            
            $this -> checkbox -> style = '-fx-text-fill: black';
            $this -> checkboxAlt -> style = '-fx-text-fill: black';
            $this -> checkbox3 -> style = '-fx-text-fill: black';
            $this -> checkbox4 -> style = '-fx-text-fill: black';
            
            $this -> layout -> style = '-fx-background-color: white';
        }
    }

    /**
     * @event checkbox.click-Left 
     */
    function doCheckboxClickLeft(UXMouseEvent $e = null)
    { 
        global $color;    
        if ($this -> checkbox -> selected == true || $this -> checkboxAlt -> selected == true || $this -> checkbox3 -> selected == true || $this -> checkbox4 -> selected == true)
        {
            $this -> button3 -> enabled = true;
            if ($color == 2)
            {$this -> button3 -> color = "663366";}
            else 
            {$this -> button3 -> color = "6680e6";}
        }
        else 
        {
           $this -> button3 -> enabled = false; 
           $this -> button3 -> color = "black";
        }
    }

    /**
     * @event checkboxAlt.click-Left 
     */
    function doCheckboxAltClickLeft(UXMouseEvent $e = null)
    {  
        global $color;  
        if ($this -> checkbox -> selected == true || $this -> checkboxAlt -> selected == true || $this -> checkbox3 -> selected == true || $this -> checkbox4 -> selected == true)
        {
            $this -> button3 -> enabled = true;
            if ($color == 2)
            {$this -> button3 -> color = "663366";}
            else 
            {$this -> button3 -> color = "6680e6";}
        }
        else 
        {
           $this -> button3 -> enabled = false; 
           $this -> button3 -> color = "black";
        }
    }

    /**
     * @event checkbox3.click-Left 
     */
    function doCheckbox3ClickLeft(UXMouseEvent $e = null)
    { 
        global $color;   
        if ($this -> checkbox -> selected == true || $this -> checkboxAlt -> selected == true || $this -> checkbox3 -> selected == true || $this -> checkbox4 -> selected == true)
        {
            $this -> button3 -> enabled = true;
            if ($color == 2)
            {$this -> button3 -> color = "663366";}
            else 
            {$this -> button3 -> color = "6680e6";}
        }
        else 
        {
           $this -> button3 -> enabled = false; 
           $this -> button3 -> color = "black";
        }
    }

    /**
     * @event checkbox4.click-Left 
     */
    function doCheckbox4ClickLeft(UXMouseEvent $e = null)
    {    
        global $color;
        if ($this -> checkbox -> selected == true || $this -> checkboxAlt -> selected == true || $this -> checkbox3 -> selected == true || $this -> checkbox4 -> selected == true)
        {
            $this -> button3 -> enabled = true;
            if ($color == 2)
            {$this -> button3 -> color = "663366";}
            else 
            {$this -> button3 -> color = "6680e6";}
        }
        else 
        {
           $this -> button3 -> enabled = false; 
           $this -> button3 -> color = "black";
        }
    }



}
