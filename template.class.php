<?php
/*
	Template Class Provided by That Blogger - http://thatblogger.co
*/

/*
######## USAGE ########
return CurlyVariables::Replace(array(
									'name' => $name,
									'email' => $email,
									'viewonline' => $viewonline,
									'unsubscribe' => $unsubscribe
									), $string, true);
*/

if(!class_exists('CurlyVariables')){
	
class CurlyVariables {

  private static $_matchable = array();
  private static $_caseInsensitive = true;

  private static function var_match($matches)
  {
    $match = $matches[1];

    if (self::$_caseInsensitive) {
      $match = strtolower($match);
    }

    if (isset(self::$_matchable[$match]) && !is_array(self::$_matchable[$match])) {
      return self::$_matchable[$match];
    }

    return '';
  }

  public static function Replace($needles, $haystack, $caseInsensitive = true) {
    if (is_array($needles)) {
      self::$_matchable = $needles;
    }

    if ($caseInsensitive) {
      self::$_caseInsensitive = true;
      self::$_matchable = array_change_key_case(self::$_matchable);
    }
    else {
      self::$_caseInsensitive = false;
    }

    $out = preg_replace_callback("/{(\w+)}/", array(__CLASS__, 'var_match'), $haystack);

    self::$_matchable = array();

    return $out;
  }
  
}
}