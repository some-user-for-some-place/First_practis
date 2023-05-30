<?php
namespace app\forms;

use std, gui, framework, app;

global $a;                    // Переменная счётчика вопросов
$a = 1;
global $del_info;            // Логическая переменная, разрешающая (или нет) кнопке "<< Назад" удалить свежесозданный файл, если он не был сохранён
$del_info = 0;

class CreateTest extends AbstractForm
{ 
    /**
     * @event button4.action 
     */
    function doButton4Action(UXEvent $e = null)                     // Кнопка "Готово 1"
    {    
        global $del_info;
        global $Test_list_proc;
        
        $tema_testa = $this -> edit -> text;                       //Получаем данные из "Укажите тему теста" в переменную tema_testa
        
        if ($tema_testa == "")
        {
            $this -> label12 -> visible = true;
        }
        
        else 
        {
            $this -> label12 -> visible = false;
            fs::makeDir("Tests/$tema_testa");
        
            $del_info = 1;
  
            $this -> button5 -> enabled = !$this -> button4 -> selected;  //Разблокируем кнопку "Готово 2"
            
            global $color;
            if ($color == 2)
            {$this -> button5 -> color = "#663366";}
            else 
            {$this -> button5 -> color = "#6680e6";}
            
            $this -> numberField -> enabled = !$this -> button4 -> selected;  //Разблокируем поле ввода кнопки "Готово 2"
            $this -> edit -> enabled = $this -> button4 -> selected;      //Блокируем поле ввода   
            $this -> button4 -> enabled = $this -> button4 -> selected;   //Блокируем кнопку
            $this -> button4 -> color = "black";
        }
        
        $Test_list_proc = 0;
    }
    
    

        /**
     * @event button5.action 
     */
    function doButton5Action(UXEvent $e = null)                    // Кнопка "Готово 2"
    {    
        $col_vopr = $this -> numberField -> value;
        
        $this -> numberField -> enabled = $this -> button5 -> selected;    //Блокируем поле ввода
        $this -> button5 -> enabled = $this -> button5 -> selected;    //Блокируем кнопку
        $this -> button5 -> color = "black";
            
        $this -> edit3 -> enabled = !$this -> button5 -> selected;    //Разблокируем все оставшиеся поля ввода в форме
        $this -> numberFieldAlt -> enabled = !$this -> button5 -> selected;    //
        $this -> edit5 -> enabled = !$this -> button5 -> selected;    //
        $this -> edit6 -> enabled = !$this -> button5 -> selected;    //
        $this -> edit7 -> enabled = !$this -> button5 -> selected;    //
        $this -> edit8 -> enabled = !$this -> button5 -> selected;    //      
        $this -> checkbox -> enabled = true;                        //
        $this -> checkboxAlt -> enabled = true;                    //
        $this -> checkbox3 -> enabled = true;                    //                                
        $this -> checkbox4 -> enabled = true; 
        
        $this -> label4 -> visible = !$this -> button3 -> selected;  // Делаем видимым счётчик вопросов

    }

        /**
     * @event button3.action 
     */
    function doButton3Action(UXEvent $e = null)                    // Кнопка "Вопрос готов"
    {     
        $this -> label15 -> visible = false;
        $this -> label16 -> visible = false;
        $this -> label18 -> visible = false;
        $this -> label17 -> visible = false;
        $this -> label19 -> visible = false;
            
        $vopros = $this -> edit3 -> text;                      // Раскидываем данные по переменным
        $ball = $this -> numberFieldAlt -> value;            //
        $ball = base64_encode($ball);
        $otv1 = $this -> edit5 -> text;                        //
        $otv2 = $this -> edit6 -> text;                        //
        $otv3 = $this -> edit7 -> text;                        //
        $otv4 = $this -> edit8 -> text;  
        
        $vern_otv_one = $this -> edit5 -> text; 
        $vern_otv_two = $this -> edit6 -> text;
        $vern_otv_three = $this -> edit7 -> text;
        $vern_otv_four = $this -> edit8 -> text;      
        
        $vern_otv_one = base64_encode($vern_otv_one);
        $vern_otv_two = base64_encode($vern_otv_two);
        $vern_otv_three = base64_encode($vern_otv_three);
        $vern_otv_four = base64_encode($vern_otv_four);
        
        if ($vopros == "" || $otv1 == "" || $otv2 == "" || $otv3 == "" || $otv4 == "")
        {
            if ($vopros == "")
            {
                $this -> label15 -> visible = true;
            }
            
            if ($otv1 == "")
            {
                $this -> label16 -> visible = true;
            }
            
            if ($otv2 == "")
            {
                $this -> label18 -> visible = true;
            }
            
            if ($otv3 == "")
            {
                $this -> label17 -> visible = true;
            }
            
            if ($otv4 == "")
            {
                $this -> label19 -> visible = true;
            }
        }
        
        else 
        {
            $this -> label15 -> visible = false;
            $this -> label16 -> visible = false;
            $this -> label18 -> visible = false;
            $this -> label17 -> visible = false;
            $this -> label19 -> visible = false;
            
            global $a;
            $a = $a+1;  
        
            $col_vopr = $this -> numberField -> value; 
        
            $this -> label4 -> text = "Вопрос номер: $a";
            
            if ($a > $col_vopr)
            {
                $this -> button3 -> enabled = $this -> button3 -> selected;    //Блокируем кнопку
                $this -> button3 -> color = "black";
                $this -> edit3 -> enabled = $this -> button3 -> selected;    //Заблокируем все оставшиеся поля ввода в форме
                $this -> numberFieldAlt -> enabled = $this -> button3 -> selected;    //
                $this -> edit5 -> enabled = $this -> button3 -> selected;    //
                $this -> edit6 -> enabled = $this -> button3 -> selected;    //
                $this -> edit7 -> enabled = $this -> button3 -> selected;    //
                $this -> edit8 -> enabled = $this -> button3 -> selected;    //
                
                $this -> checkbox -> enabled = false;
                $this -> checkboxAlt -> enabled = false;
                $this -> checkbox3 -> enabled = false;
                $this -> checkbox4 -> enabled = false;
            
                $this -> label4 -> text = "Все вопросы созданны";
                pre("Создание теста завершено. Вы можете его сохранить, нажав на кнопку 'Сохранить и закончить'");
                $this -> buttonAlt -> enabled = !$this -> button3 -> selected;    //Разблокируем кнопку
                global $color;
                if ($color == 2)
                {$this -> buttonAlt -> color = "#663366";}
                else 
                {$this -> buttonAlt -> color = "#6680e6";}
            }    
            
            $tema_testa = $this -> edit -> text;                        //Запись данных по вопросам
            $d = $a;
            $d = $d-1;
            if ($d >= 10)
            {
                fs::makeDir("Tests/$tema_testa/zvop$d");
                Stream::putContents("Tests/$tema_testa/zvop$d/vopr.txt", "$vopros");
                Stream::putContents("Tests/$tema_testa/zvop$d/ball.txt", "$ball");
                Stream::putContents("Tests/$tema_testa/zvop$d/otv1.txt", "$otv1");
                Stream::putContents("Tests/$tema_testa/zvop$d/otv2.txt", "$otv2");
                Stream::putContents("Tests/$tema_testa/zvop$d/otv3.txt", "$otv3");
                Stream::putContents("Tests/$tema_testa/zvop$d/otv4.txt", "$otv4");
                
                if ($this -> checkbox -> selected == true)
                {
                    Stream::putContents("Tests/$tema_testa/zvop$d/vern_otv_one.txt", "$vern_otv_one");
                }                    
                
                if ($this -> checkboxAlt -> selected == true)
                {
                   Stream::putContents("Tests/$tema_testa/zvop$d/vern_otv_two.txt", "$vern_otv_two");
                }  
                
                if ($this -> checkbox3 -> selected == true)
                {
                   Stream::putContents("Tests/$tema_testa/zvop$d/vern_otv_three.txt", "$vern_otv_three");
                }
                
                if ($this -> checkbox4 -> selected == true)
                {
                   Stream::putContents("Tests/$tema_testa/zvop$d/vern_otv_four.txt", "$vern_otv_four");
                } 
            }
            else 
            {
                fs::makeDir("Tests/$tema_testa/vop$d");
                Stream::putContents("Tests/$tema_testa/vop$d/vopr.txt", "$vopros");
                Stream::putContents("Tests/$tema_testa/vop$d/ball.txt", "$ball");
                Stream::putContents("Tests/$tema_testa/vop$d/otv1.txt", "$otv1");
                Stream::putContents("Tests/$tema_testa/vop$d/otv2.txt", "$otv2");
                Stream::putContents("Tests/$tema_testa/vop$d/otv3.txt", "$otv3");
                Stream::putContents("Tests/$tema_testa/vop$d/otv4.txt", "$otv4");
                
                if ($this -> checkbox -> selected == true)
                {
                    Stream::putContents("Tests/$tema_testa/vop$d/vern_otv_one.txt", "$vern_otv_one");
                }                    
                
                if ($this -> checkboxAlt -> selected == true)
                {
                   Stream::putContents("Tests/$tema_testa/vop$d/vern_otv_two.txt", "$vern_otv_two");
                }  
                
                if ($this -> checkbox3 -> selected == true)
                {
                   Stream::putContents("Tests/$tema_testa/vop$d/vern_otv_three.txt", "$vern_otv_three");
                }
                
                if ($this -> checkbox4 -> selected == true)
                {
                   Stream::putContents("Tests/$tema_testa/vop$d/vern_otv_four.txt", "$vern_otv_four");
                } 
            }
            
            $this -> edit3 ->clear();                                // Чистка полей от прошлых значений
            $this -> numberFieldAlt -> initial = 5;
            $this -> edit5 ->clear();
            $this -> edit6 ->clear();
            $this -> edit7 ->clear();
            $this -> edit8 ->clear();
            
            $this -> checkbox -> selected = false;
            $this -> checkboxAlt -> selected = false;
            $this -> checkbox3 -> selected = false;  
            $this -> checkbox4 -> selected = false;
            
            $this -> button3 -> enabled = false;
            $this -> button3 -> color = "black";
        }
        
    }
    
    
    
        /**
     * @event buttonAlt.action 
     */
    function doButtonAltAction(UXEvent $e = null)            // Кнопка сохранить и закончить
    {     
        global $del_info;
        $del_info = 0;
        global $a;
        $a = 1;
        $this -> numberField -> enabled = $this -> buttonAlt -> selected;
        
        $this -> edit ->clear();
        $this -> numberField ->initial = 10;
        
        $this -> label4 -> text = "Вопрос номер: 1";
        $this -> label4 -> visible = $this -> buttonAlt -> selected;
        
        $this -> edit -> enabled = !$this -> buttonAlt -> selected;
        $this -> button4 -> enabled = !$this -> buttonAlt -> selected;         //Разблокируем кнопку
        global $color;
        if ($color == 2)
        {$this -> button4 -> color = "#663366";}
        else 
        {$this -> button4 -> color = "#6680e6";}
        
        $this -> buttonAlt -> enabled = $this -> buttonAlt -> selected;        //Заблокируем кнопку
        $this -> buttonAlt -> color = "black";
        $this -> numberField -> enabled = $this -> buttonAlt -> selected;
        $this -> edit3 -> enabled = $this -> buttonAlt -> selected;
        $this -> numberFieldAlt -> enabled = $this -> buttonAlt -> selected;
        $this -> edit5 -> enabled = $this -> buttonAlt -> selected;
        $this -> edit6 -> enabled = $this -> buttonAlt -> selected;
        $this -> edit7 -> enabled = $this -> buttonAlt -> selected;
        $this -> edit8 -> enabled = $this -> buttonAlt -> selected;
        $this -> button3 -> enabled = $this -> buttonAlt -> selected;        //Заблокируем кнопку
        $this -> button3 -> color = "black";
        
        $this -> checkbox -> selected = false;                                //
        $this -> checkboxAlt -> selected = false;                            //
        $this -> checkbox3 -> selected = false;                            //                                
        $this -> checkbox4 -> selected = false;                            //
                
        $this -> checkbox -> enabled = false;                        
        $this -> checkboxAlt -> enabled = false;                    
        $this -> checkbox3 -> enabled = false;                                                    
        $this -> checkbox4 -> enabled = false;
        
        $this -> edit3 -> clear();
        $this -> numberFieldAlt -> initial = 5;
        $this -> edit5 -> clear();
        $this -> edit6 -> clear();
        $this -> edit7 -> clear();
        $this -> edit8 -> clear();
        
        $this -> label12 -> visible = false;
        
        $this -> label15 -> visible = false;
        $this -> label16 -> visible = false;
        $this -> label18 -> visible = false;
        $this -> label17 -> visible = false;
        $this -> label19 -> visible = false;     
        
        $this -> form('Menu') -> show();
        $this -> form('CreateTest') -> hide();

    }
    
    

    /**
     * @event button.action 
     */
    function doButtonAction(UXEvent $e = null)    // Кнопка "<< Назад"
    {   
        global $a;
        $a = 1;
        global $del_info;
        
        if ( $del_info == 1 )
        {
            $tema_testa = $this -> edit -> text;
            fs::clean("Tests/$tema_testa");
            fs::delete("Tests/$tema_testa");
        }
        
        $del_info = 0;
        
        $this -> edit ->clear();
        $this -> numberField -> initial = 10;
        
        $this -> label4 -> text = "Вопрос номер: 1";
        $this -> label4 -> visible = $this -> button -> selected;
        
        $this -> edit -> enabled = !$this -> button -> selected;
        $this -> button4 -> enabled = !$this -> button -> selected;            //Разблокируем кнопку
        global $color;
        if ($color == 2)
        {$this -> button4 -> color = "#663366";}
        else 
        {$this -> button4 -> color = "#6680e6";}
        
        $this -> buttonAlt -> enabled = $this -> button -> selected;            //Заблокируем кнопку
        $this -> buttonAlt -> color = "black";
        $this -> numberField -> enabled = $this -> button -> selected;
        $this -> edit3 -> enabled = $this -> button -> selected;
        $this -> numberFieldAlt -> enabled = $this -> button -> selected;
        $this -> edit5 -> enabled = $this -> button -> selected;
        $this -> edit6 -> enabled = $this -> button -> selected;
        $this -> edit7 -> enabled = $this -> button -> selected;
        $this -> edit8 -> enabled = $this -> button -> selected;
        $this -> button3 -> enabled = $this -> button -> selected;            //Заблокируем кнопку
        $this -> button3 -> color = "black";
        
        $this -> edit3 -> clear();
        $this -> numberFieldAlt -> initial = 5;
        $this -> edit5 -> clear();
        $this -> edit6 -> clear();
        $this -> edit7 -> clear();
        $this -> edit8 -> clear();
        
        $this -> label12 -> visible = false;
        
        $this -> label15 -> visible = false;
        $this -> label16 -> visible = false;
        $this -> label18 -> visible = false;
        $this -> label17 -> visible = false;
        $this -> label19 -> visible = false;
        
        $this -> checkbox -> enabled = false;                        
        $this -> checkboxAlt -> enabled = false;                    
        $this -> checkbox3 -> enabled = false;                                                    
        $this -> checkbox4 -> enabled = false;
         
        $this -> checkbox -> selected = false;                        
        $this -> checkboxAlt -> selected = false;                    
        $this -> checkbox3 -> selected = false;                                                    
        $this -> checkbox4 -> selected = false;
        
        $this -> form('AdminOffis') -> show();
        $this -> form('CreateTest') -> hide();
        
    }

    /**
     * @event checkbox.click-Left 
     */
    function doCheckboxClickLeft(UXMouseEvent $e = null)    // Флаг на отв.1
    {    
        if ($this -> checkbox -> selected == true || $this -> checkboxAlt -> selected == true || $this -> checkbox3 -> selected == true || $this -> checkbox4 -> selected == true)
        {
            $this -> button3 -> enabled = true;
            global $color;
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
    function doCheckboxAltClickLeft(UXMouseEvent $e = null)    // Флаг на отв.2
    {    
        if ($this -> checkbox -> selected == true || $this -> checkboxAlt -> selected == true || $this -> checkbox3 -> selected == true || $this -> checkbox4 -> selected == true)
        {
            $this -> button3 -> enabled = true;
            global $color;
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
    function doCheckbox3ClickLeft(UXMouseEvent $e = null)    // Флаг на отв.3
    {    
        if ($this -> checkbox -> selected == true || $this -> checkboxAlt -> selected == true || $this -> checkbox3 -> selected == true || $this -> checkbox4 -> selected == true)
        {
            $this -> button3 -> enabled = true;
            global $color;
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
    function doCheckbox4ClickLeft(UXMouseEvent $e = null)    // Флаг на отв.4
    {    
        if ($this -> checkbox -> selected == true || $this -> checkboxAlt -> selected == true || $this -> checkbox3 -> selected == true || $this -> checkbox4 -> selected == true)
        {
            $this -> button3 -> enabled = true;
            global $color;
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
           $this -> label6 -> textColor = "white";
           $this -> label7 -> textColor = "white";
           $this -> label8 -> textColor = "white";
           $this -> label9 -> textColor = "white";
           $this -> label5 -> textColor = "white";
           $this -> label4 -> textColor = "white";
           $this -> checkbox -> textColor = "white";
           $this -> checkboxAlt -> textColor = "white";
           $this -> checkbox3 -> textColor = "white";
           $this -> checkbox4 -> textColor = "white";
           $this -> button4 -> color = "663366";
           $this -> button -> color = "663366";
           
           $this -> edit -> style = '-fx-background-color: black; -fx-text-fill: white';
           $this -> edit3 -> style = '-fx-background-color: black; -fx-text-fill: white';
           $this -> edit5 -> style = '-fx-background-color: black; -fx-text-fill: white';
           $this -> edit6 -> style = '-fx-background-color: black; -fx-text-fill: white';
           $this -> edit7 -> style = '-fx-background-color: black; -fx-text-fill: white';
           $this -> edit8 -> style = '-fx-background-color: black; -fx-text-fill: white';
           
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
           $this -> label6 -> textColor = "black";
           $this -> label7 -> textColor = "black";
           $this -> label8 -> textColor = "black";
           $this -> label9 -> textColor = "black";
           $this -> label5 -> textColor = "black";
           $this -> label4 -> textColor = "black";
           $this -> checkbox -> textColor = "black";
           $this -> checkboxAlt -> textColor = "black";
           $this -> checkbox3 -> textColor = "black";
           $this -> checkbox4 -> textColor = "black";
           $this -> button4 -> color = "6680e6";
           $this -> button -> color = "6680e6";
           
           $this -> edit -> style = '-fx-background-color: #e6e6e6; -fx-text-fill: black';
           $this -> edit3 -> style = '-fx-background-color: #e6e6e6; -fx-text-fill: black';
           $this -> edit5 -> style = '-fx-background-color: #e6e6e6; -fx-text-fill: black';
           $this -> edit6 -> style = '-fx-background-color: #e6e6e6; -fx-text-fill: black';
           $this -> edit7 -> style = '-fx-background-color: #e6e6e6; -fx-text-fill: black';
           $this -> edit8 -> style = '-fx-background-color: #e6e6e6; -fx-text-fill: black';
           
            $this -> checkbox -> style = '-fx-text-fill: black';
            $this -> checkboxAlt -> style = '-fx-text-fill: black';
            $this -> checkbox3 -> style = '-fx-text-fill: black';
            $this -> checkbox4 -> style = '-fx-text-fill: black';
           
           $this -> layout -> style = '-fx-background-color: white';
        }
        
        //Адаптируем под экран
        $screen = UXScreen::getPrimary();
        $width  = $screen->bounds['width'];
        $height = $screen->bounds['height'];
    }




}
