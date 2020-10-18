<html>
<head>
	<title>𝐃 𝐀 𝐙 𝐀 𝐈 site</title>
  <link rel="icon" type="png" sizes="16x16" href="favicon.png">
	<link href="style.css" rel="stylesheet" id="bootstrap-css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<style>
body {
  background-image: url('dazaib2.gif');
  background-repeat: no-repeat;
  background-attachment: fixed; 
  background-size: 100% 100%;
}
</style>
</head>
<body text=red>
  <div class="card-body">
<div class="md-form">
  <div class="col-md-12">
<center> 
<h1>𝐃 𝐀 𝐙 𝐀 𝐈</h1>
 <div class="md-form">
    <span style="color:#000000">𝐂𝐕𝐕:</span>&nbsp<span id="cLive" class="badge badge-light">0</span>
    <span style="color:#000000">𝐂𝐂𝐍:</span>&nbsp<span id="cWarn" class="badge badge-light">0</span>
    <span style="color:#000000">𝐃𝐄𝐀𝐃:</span>&nbsp<span id="cDie" class="badge badge-light">0</span><br>
    <span style="color:#000000">𝐂𝐇𝐄𝐂𝐊𝐄𝐃:</span>&nbsp<span id="total" class="badge badge-light">0</span><br>
    <span>𝐓𝐎𝐓𝐀𝐋:</span>&nbsp<span id="carregadas" class="badge badge-light">0</span>
</div><br><textarea type="text" style="text-align: center; border-color: #000000; background-color: transparent; color: white; maxlength="2000" 
placeholder="Enter Cards Here";" id="lista" class="md-textarea form-control" rows="4" placeholder="Enter Cards"></textarea>
 </center>
&nbsp;<br>

</div>
<center>
 <button class="btn btn-dark rainbow_text_animated" style="width: 250px; outline: none;" id="testar" onclick="enviar()" ><b>𝐒𝐓𝐀𝐑𝐓</b></button></center>
</center>
</div>
</div>
</div>
</cenetr>
&nbsp;&nbsp;<br>&nbsp;&nbsp;<br>
<div class="col-md-12">
<div class="card">
<div style="position: absolute;
        top: 0;
        right: 0;">
	<button id="mostra" class="btn btn-light rainbow_text_animated"><b>𝐒𝐇𝐎𝐖</b></button><br>
		</div>
	<div style="position: absolute;
	top: 0;
	left: 0;">
</div>
  <div class="card-body">
    <center><h6 style="font-weight: bold;color:black" class="card-title">𝐂𝐕𝐕<br><span  id="cLive2" class="badge badge-light">0</span></h6></center>
    <div id="bode"><span id=".aprovadas" class="aprovadas"></span>
</div>
  </div>
</div>
</div>
&nbsp;&nbsp;&nbsp;</br>

<div class="col-md-12">
<div class="card">
<div style="position: absolute;
        top: 0;
        right: 0;">
	<button id="mostra3" class="btn btn-light rainbow_text_animated"><b>𝐒𝐇𝐎𝐖</b></button><br>
		</div>
	<div style="position: absolute;
	top: 0;
	left: 0;">
</div>
  <div class="card-body">
    <center><h6 style="font-weight: bold;color:black;" class="card-title">𝐂𝐂𝐍<br><span  id="cWarn2" class="badge badge-light">0</span></h6></center>
    <div id="bode3"><span id=".edrovadas" class="edrovadas"></span>
</div>
  </div>
</div>
</div>
&nbsp;&nbsp;&nbsp;</br>

<div class="col-md-12">
<div class="card">
	<div style="position: absolute;
        top: 0;
        right: 0;">
	<button id="mostra2" class="btn btn-light rainbow_text_animated"><b>𝐒𝐇𝐎𝐖</b></button><br>
	</div>
	<div style="position: absolute;
	top: 0;
	left: 0;">
</div>
  <div class="card-body">

    <center><h6 style="font-weight: bold; color:black;" class="card-title">𝐃𝐄𝐀𝐃<br><span id="cDie2" class="badge badge-light">0</span></h6></center>
    <div id="bode2"><span id=".reprovadas" class="reprovadas"></span>
    </div>
  </div>
</div>
</div>
  </div>
</div>
&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp

</div>
<br>
</center>
<script  src="./script.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.js" type="text/javascript"></script>
<script type="text/javascript">

$(document).ready(function(){

  $("#bode").hide();
  $("#esconde").show();
  
  $('#mostra').click(function(){
  $("#bode").slideToggle();
  });
  
  $('#mostra3').click(function(){
  $("#bode3").slideToggle();
  });
  
   $('#mostra2').click(function(){
  $("#bode2").slideToggle();
  });

});

</script>

<script title="ajax do checker">
    function enviar() {
        var linha = $("#lista").val();
        var linhaenviar = linha.split("\n");
        var total = linhaenviar.length;
        var ap = 0;
        var ed = 0;
        var rp = 0;
        linhaenviar.forEach(function(value, index) {
            setTimeout(
                function() {
                    $.ajax({
                        url: 'api.php?lista=' + value,
                        type: 'GET',
                        async: true,
                        success: function(resultado) {
                            if (resultado.match("#LIVE")) {
                                removelinha();
                                ap++;
                                aprovadas(resultado + "");
                            }else if(resultado.match("#CCN")){
                            	removelinha();
                            ed++;
                                edrovadas(resultado + "");
                             }else {
                                removelinha();
                                rp++;
                                reprovadas(resultado + "");
                            }
                            $('#carregadas').html(total);
                            var fila = parseInt(ap) + parseInt(ed) + parseInt(rp);
                            $('#cLive').html(ap);
                            $('#cWarn').html(ed);
                            $('#cDie').html(rp);
                            $('#total').html(fila);
                            $('#cLive2').html(ap);
                            $('#cWarn2').html(ed);
                            $('#cDie2').html(rp);
                        }
                    });
                }, 1 * index);
        });
    }
    function aprovadas(str) {
        $(".aprovadas").append(str + "<br>");
    }
    function reprovadas(str) {
        $(".reprovadas").append(str + "<br>");
    }
    function edrovadas(str) {
        $(".edrovadas").append(str + "<br>");
    }
    function removelinha() {
        var lines = $("#lista").val().split('\n');
        lines.splice(0, 1);
        $("#lista").val(lines.join("\n"));
    }
</script>
<style>
.rainbow_text_animated {
    background: linear-gradient(to right, #ffffff, #000000 , #ffffff, #000000, #ffffff);
    border-color: #000000;
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
    animation: rainbow_animation 2s ease-in-out infinite;
    background-size: 400% 100%;
}

@keyframes rainbow_animation {
    0%,100% {
        background-position: 0 0;
    }

    50% {
        background-position: 100% 0;
    }
}
</style>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.11/js/mdb.min.js"></script>
</body>

</html>
