<?php
    class CurrentDate {
        
        private static function getDay() {
            $day = date('d');
            return $day;
        }
        
        private static function getMonth() {
            $month = date('m');
            switch ($month){ 
                case 1: $month = "Janeiro"; break;
                case 2: $month = "Fevereiro"; break;
                case 3: $month = "Março"; break;
                case 4: $month = "Abril"; break;
                case 5: $month = "Maio"; break;
                case 6: $month = "Junho"; break;
                case 7: $month = "Julho"; break;
                case 8: $month = "Agosto"; break;
                case 9: $month = "Setembro"; break;
                case 10: $month = "Outubro"; break;
                case 11: $month = "Novembro"; break;
                case 12: $month = "Dezembro"; break;
            }
            return $month;
        }
        
        private static function getWeek() {
            $week = date('w');
            switch ($week) {
                case 0: $week = "Domingo"; break;
                case 1: $week = "Segunda"; break;
                case 2: $week = "Terça"; break;
                case 3: $week = "Quarta"; break;
                case 4: $week = "Quinta"; break;
                case 5: $week = "Sexta"; break;
                case 6: $week = "Sábado"; break;
            }
            return $week;
        }
        
        private static function getYear() {
            $year = date('Y');
            return $year;
        }
        
        public static function getCurrentDate() {
            return CurrentDate::getWeek() . ", " . CurrentDate::getDay() . " de " . 
                    CurrentDate::getMonth() . " de " . CurrentDate::getYear();
        }
    }
?>
