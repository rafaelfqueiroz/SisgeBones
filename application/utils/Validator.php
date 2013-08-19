<?php

    class Validator {
        public static function validate($condicao, $mensagem) {
            if ($condicao) {
                if (!isset($_SESSION["error"])) {
                    $_SESSION["error"] = array();
                }
                array_push($_SESSION["error"], $mensagem);                
            }
        }
        
        public static function onErrorRedirectTo($url) {
            if (isset($_SESSION["error"])) {
                header("location: " . $url);
                exit();
            }
        }
        
        public static function showError() {
            $error = "";
            if (isset($_SESSION["error"])) {
                $error .= "<div id=\"divErrorValidation\" class=\"row-fluid\">";
                    $error .= "<div class=\"span12\">";
                        $error .= "<div class=\"alert alert-error\">";
                            $error .= "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>";
                            foreach ($_SESSION["error"] as $message) {
                                $error .= $message . "<br>";
                            }
                        $error .= "</div>";
                    $error .= "</div>";
                $error .= "</div>";
                unset($_SESSION["error"]);
            }
            echo $error;
        }
    }

?>
