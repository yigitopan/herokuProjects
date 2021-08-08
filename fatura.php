<?php
ob_start();

//Olası hataları görmek için 0'ları 1 yapın.
//ini_set('display_errors', '1');
//ini_set('display_startup_errors', '1');

//Olası hataları görmek için alttaki yorumu kaldırın
//error_reporting(E_ALL);

//SHOPIFY APP SECRET kodunu değişkene aktarıyoruz.
define('SHOPIFY_APP_SECRET', '9d5d59255d460d099c8caaffc63205a6');

//Shopify dokümantasyonlarından alınan kod bloğundaki fonksiyonu kullanıyoruz. Burayı değiştirmeyin.
function verify_webhook($data, $hmac_header)
{
    $calculated_hmac = base64_encode(hash_hmac('sha256', $data, SHOPIFY_APP_SECRET, true));
    return hash_equals($hmac_header, $calculated_hmac);
}

$hmac_header = $_SERVER['HTTP_X_SHOPIFY_HMAC_SHA256'];
$data = file_get_contents('php://input');
$verified = verify_webhook($data, $hmac_header);

//Mail listesine eklenen kullanıcının verilerinden bir dizi yaratıyoruz
$gelenVeri = json_decode($data, true);

/*
$myfile = fopen("logs.txt", "w") or die("Unable to open file!");
fwrite($myfile, $data);
fclose($myfile);
*/


if($gelenVeri["note_attributes"][0]["name"]=="Additional Invoice") {


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Proposal</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@500&display=swap" rel="stylesheet">
</head>

<style>
    .container {
        max-width: 85rem;
        margin: auto;
        padding-left: 0.5rem;
        padding-right: 0.5rem;
    }


    .link table td {
        padding-top: 1rem;
    }

    body {
        text-transform: uppercase;
        font-family: 'Lora', serif;
        font-size: 0.8rem;
    }


    .address, .link  {
        text-align: right;
    }

    .top td{
        padding-top: 0.5rem;
    }

    a {
        text-decoration: none;
        color: black;
    }

    .link {
        width: 1200px;
        margin-top: 1rem;
        padding-bottom: 5rem;
        font-size: 0.8rem;
    }

    .logo  {
        width: 100%;
        max-width: 300px;
    }

    .container table {
        width: 100%;
    }

    .quote table {
        background-color: #737373;
        color:white;
        width: 100%;
        padding: 0.5rem;
        margin-bottom: 2rem;
        margin-top: 3rem;
        font-size: 0.8rem;
    }

    .list {
        margin-bottom: 2rem;
    }

    .listTd table{
        text-align: left!important;
        background-color: #eee;
        border: 1.5px solid black;
    }

    .listTd {
        padding-bottom: 0.25rem;
    }

    .listTd table {
        margin-bottom: 1rem;
    }

    .listTd table tbody{
        text-align: right;
    }
    .listItem {
        text-align: right;
    }

    .grandTotal, .subtotal {
        text-align: right;
    }

    .subtotal table {
        padding-top: 2.75rem;
    }

    .left {
        text-align: left;
    }

    .center {
        text-align: center;
    }

    .itemPic {
        max-width: 100px;
    }

    @media (max-width:900px) {
        body, .link, .quote table {
            font-size: 0.65rem;
        }

        .quote table td{
            line-height: 1.25rem;
            padding: 0;
        }



        .listItem tbody td {
            vertical-align:top;

        }
    }
</style>


<body>

        <div class="container">
            <table cellpadding="0" cellspacing="0">
                <tbody>
                    <tr class="top">
                        <td>
                            <table>
                                <tbody>
                                    <tr>
                                        <td class=logoContainer width="25%"><img class="logo" src="logo2.jpg" alt=""></td>
                                        <td class="address">
                                             Young Music, LLC
                                            <br>
                                            7 Jaben Drive
                                            <br>
                                            Greenville, SC 2961
                                              <br>  <br>
                                             <b>Customer Information:</b>
                                <br>
                                <?php echo $gelenVeri["customer"]["first_name"]; ?> <?php echo $gelenVeri["customer"]["last_name"]; ?>
                                <br>
                        
              
                                <?php echo $gelenVeri["customer"]["default_address"]["city"]; ?>
                                <?php echo $gelenVeri["customer"]["default_address"]["province"]; ?>
                                <?php echo $gelenVeri["customer"]["default_address"]["country"]; ?>
                                <?php echo $gelenVeri["customer"]["default_address"]["zip"]; ?>
                                <?php echo $gelenVeri["customer"]["default_address"]["address1"]; ?>
                                <?php echo $gelenVeri["customer"]["default_address"]["address2"]; ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>

                    <tr class="link" >
                        <td>
                            <table>
                                <tbody>
                                <tr>
                                    <td><a href="https://prodigies.com">https://prodigies.com</a></td>
                                </tr>
                                </tbody>
                            </table>
                        </td>

                    </tr>


                    <tr class="quote">
                        <td>
                            <table>
                                <tbody>
                                <tr >
                                    <td>
                                        Quote #: <?php echo $gelenVeri["id"]; ?>
                                        <br>
                                        Quote Date:  <?php echo explode("T",$gelenVeri["created_at"])[0]; ?>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>


                    <tr class="list">
                        <td class="listTd">
                            <table>
                                <tbody>
             
                                <tr>
                                    <td width="25%"></td>
                                    <td width="25%" class="left">Product Name</td>
                                    <td width="10%" class="left">Sku</td>
                                    <td width="15%" class="left">Unit Price</td>
                                    <td width="10%" class="left">QTY</td>
                                    <td width="10%" >Subtotal</td>
                                </tr>



                                </tbody>
                            </table>
                        </td>
                    </tr>

                    <tr class="listItem">
                        <td>
                            <table>
                                <tbody>
                                <tr>
                                                            <?php
            
            for($i=0; $i<count($gelenVeri["line_items"]); $i++){
                
                
            ?>
            <?php
                                       
$api_key = "9d5d59255d460d099c8caaffc63205a6";
$api_pass = "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";
$url = "https://$api_key:$api_pass@invoice-pdf-store.myshopify.com/admin/api/2021-04/products/".$gelenVeri["line_items"][$i]["product_id"].".json";
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec ($curl);       
$sonuc = json_decode($result, true);
curl_close($curl);
?>
                                    <td width="25%" class="left"><img class="itemPic" src="<?php echo $sonuc["product"]["images"][0]["src"]; ?>" alt=""></td>
                                    <td width="25%" class="left"><?php echo $gelenVeri["line_items"][$i]["name"]; ?></td>
                                    <td width="10%" class="left"><?php echo $gelenVeri["line_items"][$i]["sku"]; ?></td>
                                    <td width="15%" class="left"><?php echo $gelenVeri["line_items"][$i]["price"]; ?></td>
                                    <td width="10%" class="left"><?php echo $gelenVeri["line_items"][$i]["quantity"]; ?></td>
                                    <td width="10%"><?php
                                    echo $gelenVeri["line_items"][$i]["price"]*$gelenVeri["line_items"][$i]["quantity"]; ?></td>
                                </tr>   <?php 
            
            }
            
            ?>
                                </tbody>
                            </table>
                        </td>
                    </tr>

                    <tr class="subtotal">
                        <td>
                            <table>
                                <tbody>
                                <tr>
                                    <td>Subtotal</td>
                                    <td><?php echo $gelenVeri["current_subtotal_price"]; ?></td>
                                </tr>
                                <tr class="grandTotal">
                                    <td>Grand total</td>
                                    <td><?php echo $gelenVeri["current_total_price"]; ?></td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    
       


                </tbody>
            </table>
        </div>



</body>
</html>


<?php
file_put_contents('faturaz.html', ob_get_contents());

include('pdflayer.class.php');

//Instantiate the class
$html2pdf = new pdflayer();

//set the URL to convert
$html2pdf->set_param('document_url','https://kargo.pinit4web.com/oldwithproposal/faturaz.html');

//start the conversion
$html2pdf->convert();

//save it to disk
$randsayi = rand(0,99999999999999);
$randname = "invoice".$randsayi.".pdf";
file_put_contents($randname, $html2pdf->pdf);
       
	require_once("phpmailer/class.phpmailer.php");

	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->Host = "mail.pinit4web.com";
	$mail->SMTPAuth = true;
	$mail->Username = "yourinvoice@pinit4web.com";
	$mail->Password = "invoice2021.";
	$mail->From = "yourinvoice@pinit4web.com";
	$mail->Fromname = "Invoice Sender";
	$mail->AddAddress($gelenVeri["contact_email"],"Your Invoice");
	$mail->Subject = "Your Invoice";
	$mail->AddAttachment($randname, 'invoice.pdf');

	if(!$mail->Send())
	{
	   //echo '<font color="#F62217"><b>Gönderim Hatası: ' . $mail->ErrorInfo . '</b></font>';
	    if (file_exists($randname)) {
        unlink($randname);
    } 
    if (file_exists("faturaz.html")) {
             unlink("faturaz.html");
    	 }
	   exit;
	}else{
	//echo '<font color="#41A317"><b>Mesaj başarıyla gönderildi.</b></font>';
	 if (file_exists($randname)) {
        unlink($randname);
    } 
    	 if (file_exists("faturaz.html")) {
             unlink("faturaz.html");
    	 }
	}             
}

?>