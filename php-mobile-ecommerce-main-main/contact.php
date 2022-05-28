
  <?php



function url(){
   return sprintf(
      "%s://%s",
      isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
      $_SERVER['SERVER_NAME']
   );
}

if(isset($_POST["sendmessage"]) && ($_POST["sendmessage"] == 'Send Message')) {


   $to = 'yousefalhindawe@gmail.com';

   $name = trim(stripslashes($_POST['name']));
   $from = trim(stripslashes($_POST['email']));
   $subject = "Contact mail";
   $message = trim(stripslashes($_POST['message']));
   $headers = "From: $from";



   


   // Set Message
  //  $message .= "Email from: " . $name . "<br />";
	//  $message .= "Email address: " . $email . "<br />";
  //  $message .= "Message: <br />";
  //  $message .= nl2br($contact_message);
  //  $message .= "<br /> ----- <br /> This email was sent from your site " . url() . " contact form. <br />";

   // Set From: header
  //  $from =  $name . " <" . $email . ">";

   // Email Headers
	// $headers = "From: " . $from . "\r\n";
	// $headers .= "Reply-To: ". $email . "\r\n";
 	// $headers .= "MIME-Version: 1.0\r\n";
	// $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

 
  // ini_set("sendmail_from", $to); // for windows server
   $mail = mail($to, $subject, $message, $headers);

	if ($mail) { 
    echo ' <div id="form-message-warning " ></div> 
    <div id="form-message-success" class = " mt-4 bg-success p-3 rounded-3 text-light h5 text-center " style ="width: 370px ; margin: 0 auto;" >
      Your message was sent, thank you!
    </div>'; 
  }
   else { echo "Something went wrong. Please try again."; }

  }

?>

  <div class="content mt-5">
    
    <div class="container">
      <div class="row align-items-stretch no-gutters contact-wrap">
        <div class="col-md-12">
          <div class="form h-100">
            <h3>Get In Touch</h3>
            <form class="mb-5" method="POST" acttion ="" id="contactForm" name="contactForm">
              <div class="row">
                <div class="col-md-6 form-group mb-3">
                  <label for="" class="col-form-label">Name *</label>
                  <input type="text" class="form-control" name="name" id="name" placeholder="Your name">
                </div>
                <div class="col-md-6 form-group mb-3">
                  <label for="" class="col-form-label">Email *</label>
                  <input type="text" class="form-control" name="email" id="email"  placeholder="Your email">
                </div>
              </div>

              
              

              <div class="row">
                <div class="col-md-12 form-group mb-3">
                  <label for="message" class="col-form-label">Message *</label>
                  <textarea class="form-control" name="message" id="message" cols="30" rows="4"  placeholder="Write your message"></textarea>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 form-group">
                  <input type="submit" name="sendmessage" value="Send Message" class="btn btn-primary rounded-0 py-2 px-4">
                  <span class="submitting"></span>
                </div>
              </div>
            </form>

            

          </div>
        </div>
      </div>
    </div>

  </div>
    
    
  
    <!-- <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/main.js"></script>

  </body>
</html> -->