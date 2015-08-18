<?php

/*
 * @author: Lahiru
 * This class used Stratergy design pattern to validate different scenarios.
 */

//$vc=new FieldValidator("EMP No",")");
//echo $vc->getError();

class FieldValidator {              //Context, where different stratergies includes. Has-A relation

    private $title;
    private $strategy;
    private $userText;

    public function __construct($title, $userText) {
        $this->title = $title;
        $this->userText = $userText;
        /*
         * Updated by Niroshan
         *  Added new Email , Numerivc value validation class
         *  Added cases for all title column
         * */

        switch (strtolower($title)) {
            case "emp no":$this->strategy = new DigitsOnly($userText, 8);
                break;
            case "epf no":$this->strategy = new DigitsOnly($userText, 8);
                break;

            case "number of days":$this->strategy = new DigitsOnly($userText, 8);
                break;
            case "name":$this->strategy = new AlphaOnly($userText, 50);
                break;
            case "other name":$this->strategy = new AlphaOnly($userText, 50);
                break;
            case "full name":$this->strategy = new AlphaOnly($userText, 150);
                break;
            case "destination":$this->strategy = new AlphaOnly($userText, 100);
                break;
            case "company":$this->strategy = new AlphaOnly($userText, 10);
                break;
            case "department":$this->strategy = new AlphaOnly($userText, 20);
                break;
            case "bu/department":$this->strategy = new AlphaOnly($userText, 20);
                break;
            case "corporate title":$this->strategy = new AlphaOnly($userText, 15);
                break;
            case "dialog deductions":$this->strategy = new NumericOnly($userText, 10);
                break;
            case "mobitel deductions":$this->strategy = new NumericOnly($userText, 10);
                break;
            case "amount":$this->strategy = new NumericOnly($userText, 10);
                break;
            case "basic salary":$this->strategy = new NumericOnly($userText, 15);
                break;
            case "vehicle loan":$this->strategy = new NumericOnly($userText, 15);
                break;
            case "mobile bills":$this->strategy = new NumericOnly($userText, 15);
                break;
            case "festival advance":$this->strategy = new NumericOnly($userText, 15);
                break;
            case "other":$this->strategy = new NumericOnly($userText, 15);
                break;

            case "normal ot (hrs.)":$this->strategy = new NumericOnly($userText, 15);
                break;
            case "double ot (hrs.)":$this->strategy = new NumericOnly($userText, 15);
                break;
            case "tripple ot (hrs.)":$this->strategy = new NumericOnly($userText, 15);
                break;
            case "total ot hours":$this->strategy = new NumericOnly($userText, 15);
                break;

            case "br allowance":$this->strategy = new NumericOnly($userText, 15);
                break;
            case "travelling allowance":$this->strategy = new NumericOnly($userText, 15);
                break;
            case "attendance & meal allowance":$this->strategy = new NumericOnly($userText, 15);
                break;
            case "cashier allowance":$this->strategy = new NumericOnly($userText, 15);
                break;
            case "sport club":$this->strategy = new AlphaOnly($userText, 20);
                break;  // some can be changed
            case "recreation club":$this->strategy = new AlphaOnly($userText, 20);
                break;  // some can be changed
            case "benevelent fund":$this->strategy = new AlphaOnly($userText, 20);
                break;  // some can be changed
            case "resignation effective date":$this->strategy = new AlphaOnly($userText, 20);
                break;  // some can be changed
            case "type (resignation/hold)":$this->strategy = new AlphaOnly($userText, 20);
                break;  // some can be changed

            case "employee name":$this->strategy = new AlphaOnly($userText, 50);
                break;
            case "nic no":$this->strategy = new AlphaOnly($userText, 10);
                break;
            case "contract no":$this->strategy = new DigitsOnly($userText, 10);
                break;
            case "monthly rental":$this->strategy = new NumericOnly($userText, 15);
                break;
            case "no of instalments":$this->strategy = new DigitsOnly($userText, 50);
                break;
            case "execution date":$this->strategy = new AlphaOnly($userText, 50);
                break;    // must be change
            case "settlement date":$this->strategy = new AlphaOnly($userText, 50);
                break; // must be changed
            case "start date":$this->strategy = new AlphaOnly($userText, 50);
                break; // must be changed
            case "emp type":$this->strategy = new AlphaOnly($userText, 10);
                break;
            case "sal grade":$this->strategy = new AlphaOnly($userText, 10);
                break;
            case "branch":$this->strategy = new AlphaOnly($userText, 20);
                break;
            case "bank name":$this->strategy = new AlphaOnly($userText, 20);
                break;
            case "bank branch":$this->strategy = new AlphaOnly($userText, 20);
                break;
            case "e-mail":$this->strategy = new EmailOnly($userText, 30);
                break;
            case "account no":$this->strategy = new AlphaOnly($userText, 20);
                break;


            case "bu category":$this->strategy = new AlphaOnly($userText, 10);
                break;

            default : $this->strategy = new DefaultValidator($userText, 10);
                break;
        }
    }

    public function getError() {
        if (empty($this->userText)) {
            return "Empty field not allowed";
        } else {
            return $this->strategy->validate();
        }
    }

}

abstract class Validator {

    public abstract function validate();
}

class DefaultValidator extends Validator {                  //For testing perpose only

    private $userText;
    private $len;

    public function __construct($text, $len) {
        $this->userText = $text;
        $this->len = $len;
    }

    public function validate() {
        preg_match('/^[A-Za-z\.\-\&_\/\\\,\@]*$/', $this->userText, $matches);
        if (!empty($matches)) {
            if (strlen($this->userText) < $this->len) {
                return '';
            } else {
                return 'Allowed characters count exceed';
            }
        } else {
            return 'Restricted charactors found';
        }
    }

}

class DigitsOnly extends Validator {

    private $userText;
    private $len;

    public function __construct($text, $len) {
        $this->userText = $text;
        $this->len = $len;
    }

    public function validate() {
        preg_match('/^[0-9]*$/', $this->userText, $matches);
        if (!empty($matches)) {
            if (strlen($this->userText) <= $this->len) {
                return '';
            } else {
                return 'Allowed characters count exceed';
            }
        } else {
            return 'Please enter only digits';
        }
    }

}

class Alnum extends Validator {

    private $userText;
    private $len;

    public function __construct($text, $len) {
        $this->userText = $text;
        $this->len = $len;
    }

    public function validate() {

        if (ctype_alnum($this->userText)) {
            if (strlen($this->userText) <= $this->len) {
                return '';
            } else {
                return 'Allowed characters count exceed';
            }
        } else {
            return 'Please enter only digits and letters';
        }
    }

}

class NumericOnly extends Validator {

    private $userText;
    private $len;

    public function __construct($text, $len) {
        $this->userText = $text;
        $this->len = $len;
    }

    public function validate() {

        if (is_numeric((float) $this->userText)) {

            if (strlen($this->userText) <= $this->len) {
                return '';
            } else {
                return 'Allowed characters count exceed';
            }
        } else {
            return 'Please enter only numeric data';
        }
    }

}

class AlphaOnly extends Validator {

    private $userText;
    private $len;

    public function __construct($text, $len) {
        $this->userText = $text;
        $this->len = $len;
    }

    public function validate() {
        preg_match('/^[A-Za-z\.\-\&_\/\\\,\@ ]*$/', $this->userText, $matches);
        if (!empty($matches)) {
            if (strlen($this->userText) < $this->len) {
                return '';
            } else {
                return 'Allowed characters count exceed';
            }
        } else {
            return 'Restricted charactors found';
        }
    }

}

class EmailOnly extends Validator {

    private $userText;
    private $len;

    public function __construct($text, $len) {
        $this->userText = $text;
        $this->len = $len;
    }

    public function validate() {
        $pattern = '/^(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){255,})(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){65,}@)(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22))(?:\\.(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-+[a-z0-9]+)*\\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-+[a-z0-9]+)*)|(?:\\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\\]))$/iD';

        $emailaddress = $this->userText;

        if (preg_match($pattern, $emailaddress) === 1) {
            if (strlen($this->userText) < $this->len) {
                return '';
            } else {
                return 'Allowed characters count exceed';
            }
        } else {
            return 'E-mail is not valided';
        }
    }

}

/*
  class Date extends Validator {
  private $userText;
  private $len;
  public function __construct($text) {
  $this->userText = $text;
  $this->len = 10;
  }

  public function validate() {
  preg_match('/[]/', $this->userText,$matches);
  if ( $matches[0]!= '') {
  if(strlen($this->userText)<$len){
  return '';
  }
  else{
  return 'Allowed characters count exceed';
  }
  } else {
  return 'Restricted charactors found';
  }
  }
  }
 */
?>