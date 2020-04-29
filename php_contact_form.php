<?php

  //Message variables
  $msg = '';
  $msgClass = '';

  if(filter_has_var(INPUT_POST, 'submit')){
    // get form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    //check required fields
    if(!empty($name) && !empty($email) && !empty($message)){
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $msg = "Please enter a valid email address";
        $msgClass = "alert-danger";
      }else {
        $toEmail = 'mr.samiul.salehin@gmail.com';
        $subject = 'Contact request from ' .$name;
        $body = '
        <h2>Contact Request</h2>
        <h4>Name</h4> <p>'.$name.'</p>
        <h4>Email</h4> <p>'.$email.'</p>
        <h4>Message</h4> <p>'.$message.'</p>
        ';
        //Email Headers
        $headers = "MIME-Version: 1.0"."\r\n";
        $headers .= "Content-Type:text/html;charset:UTF-8"."\r\n";

        //Additional Headers
        $headers .= "From: " .$name. "<".$email.">"."\r\n";

        if(mail($toEmail, $subject, $body, $headers)){
            $msg = "Your email has been sent";
            $msgClass = 'alert-success';
        }else {
          $msg = "Your email was not sent";
          $msgClass = 'alert-danger';
        }
      }
    }else {
      $msg = 'Please fill up all the fields.';
      $msgClass = 'alert-danger';
    }
  }

 ?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>My PHP Contact Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.4.1/slate/bootstrap.min.css">
  </head>

  <body>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <!-- Navbar block starts-->
      <nav class="navbar navbar-inverse">
        <div class="container-fluid">
          <div class="navbar-header">
            <a class="navbar-brand" href="php_contact_form.php">WebSiteName</a>
          </div>
        </div>
      </nav>
    <!-- Navbar block ends-->


    <!-- Form block starts-->
    <div class="container">
      <?php if ($msg != ''): ?>
        <div class="alert <?php echo $msgClass; ?>">
          <?php echo $msg; ?>
        </div>
      <?php endif; ?>
    	<div class="row justify-content-center">
    		<div class="col-12 col-md-8 col-lg-6 pb-5">

          <!--Form with header-->
          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
              <div class="card border-primary rounded-0">
                  <div class="card-header p-0">
                      <div class="bg-info text-white text-center py-2">
                          <h3><i class="fa fa-envelope"></i> Contact Us</h3>
                          <p class="m-0">Please fill up the informations below</p>
                      </div>
                  </div>
                  <div class="card-body p-3">

                      <!--Body-->
                      <div class="form-group">
                          <div class="input-group mb-2">
                              <div class="input-group-prepend">
                                  <div class="input-group-text"><i class="fa fa-user text-info"></i></div>
                              </div>
                              <!-- required -->
                              <input type="text" name="name" class="form-control" id="nombre" placeholder="Type your name" value="<?php echo isset($_POST['name'])? $name : ''; ?>" >
                          </div>
                      </div>

                      <div class="form-group">
                          <div class="input-group mb-2">
                              <div class="input-group-prepend">
                                  <div class="input-group-text"><i class="fa fa-envelope text-info"></i></div>
                              </div>
                              <!-- type="email" required -->
                              <input name="email" class="form-control" id="nombre" placeholder="Type@your.email" value=""<?php echo isset($_POST['email'])? $email : ''; ?>"" >
                          </div>
                      </div>

                      <div class="form-group">
                          <div class="input-group mb-2">
                              <div class="input-group-prepend">
                                  <div class="input-group-text"><i class="fa fa-comment text-info"></i></div>
                              </div>
                              <!-- required -->
                              <textarea name="message" class="form-control" placeholder="Type your message"><?php echo isset($_POST['message'])? $message : ''; ?></textarea>
                          </div>
                      </div>

                      <div class="text-center">
                          <button type="submit" name="submit" class="btn btn-info btn-block rounded-0 py-2">Submit</button>
                      </div>
                  </div>

              </div>
          </form>
          <!--Form with header-->

          </div>
    	</div>
    </div>
    <!-- Form block ends-->


  </body>
</html>
