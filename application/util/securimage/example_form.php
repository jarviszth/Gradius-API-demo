<?php
session_start(); // this MUST be called prior to any output including whitespaces and line breaks!

$GLOBALS['DEBUG_MODE'] = 1;
// CHANGE TO 0 TO TURN OFF DEBUG MODE
// IN DEBUG MODE, ONLY THE CAPTCHA CODE IS VALIDATED, AND NO EMAIL IS SENT

$GLOBALS['ct_recipient']   = 'YOU@EXAMPLE.COM'; // Change to your email address!  Make sure DEBUG_MODE above is 0 for mail to send!
$GLOBALS['ct_msg_subject'] = 'Securimage Test Contact Form';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
  <title>Securimage Example Form</title>
  <style type="text/css">
  <!--
  div.error { display: block; color: #f00; font-weight: bold; font-size: 1.2em; }
  span.error { display: block; color: #f00; font-style: italic; }
  .success { color: #00f; font-weight: bold; font-size: 1.2em; }
  form label { display: block; font-weight: bold; }
  fieldset { width: 90%; }
  legend { font-size: 24px; }
  .note { font-size: 18px;
  -->
  </style>
</head>
<body>

<fieldset>
<legend>Example Form</legend>



<?php

process_si_contact_form(); // Process the form, if it was submitted

if (isset($_SESSION['ctform']['error']) &&  $_SESSION['ctform']['error'] == true): /* The last form submission had 1 or more errors */ ?>
<div class="error">There was a problem with your submission.  Errors are displayed below in red.</div><br />
<?php elseif (isset($_SESSION['ctform']['success']) && $_SESSION['ctform']['success'] == true): /* form was processed successfully */ ?>
<div class="success">The captcha was correct and the message has been sent!  The captcha was solved in <?php echo $_SESSION['ctform']['timetosolve'] ?> seconds.</div><br />
<?php endif; ?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI'] . $_SERVER['QUERY_STRING']) ?>" id="contact_form">
  <input type="hidden" name="do" value="contact" />

  

  <p>
    <?php
      // show captcha HTML using Securimage::getCaptchaHtml()
      require_once 'securimage.php';
      $options = array();
      $options['input_name'] = 'ct_captcha'; // change name of input element for form post

      if (!empty($_SESSION['ctform']['captcha_error'])) {
        // error html to show in captcha output
        $options['error_html'] = $_SESSION['ctform']['captcha_error'];
      }

      echo Securimage::getCaptchaHtml($options);
    ?>
  </p>

  <p>
    <br />
    <input type="submit" value="Submit Message" />
  </p>

</form>
</fieldset>

</body>
</html>

<?php

// The form processor PHP code
function process_si_contact_form()
{
  $_SESSION['ctform'] = array(); // re-initialize the form session data

  if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$_POST['do'] == 'contact') {
  	// if the form has been submitted



  
    $captcha = @$_POST['ct_captcha']; // the user's entry for the captcha code


    $errors = array();  // initialize empty error array

    

    // Only try to validate the captcha if the form has no errors
    // This is especially important for ajax calls
    if (sizeof($errors) == 0) {
      require_once dirname(__FILE__) . '/securimage.php';
      $securimage = new Securimage();

      if ($securimage->check($captcha) == false) {
        echo 'Incorrect security code entered<br />';
      }
    }

    
  } // POST
}

$_SESSION['ctform']['success'] = false; // clear success value after running
