<!DOCTYPE html>
<html>
  <head>
    <title>Calendrier de l'Avent - Gagne ton chocolat !</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
	<script src="js/modernizr-2.6.1-respond-1.1.0.min.js"></script>
    <script src="https://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </head>
  <body>
	<div id="static-snow"></div>
	<div class="container content">
    <div class="row main">
        <div class="span12 pull-center">
            <header>
                <p><img src="img/merry_christmas_transparent.png" alt="Merry Christmas" class="merry"></p>
            </header>
			<div id="res">
				<?php
					include_once("classes/BddPDO.php");
					
					$bdd = new BddPDO("localhost", 3336, "epinoel", "epinoel", "Cx6~gX}(vW67");
					$winner = $bdd->checkWinner();
					if ($winner == "")
					{
						?>
						<br />
						<form class="form-inline" role="form">
							<div class="form-group">
								<label class="sr-only" for="login">login</label>
								<input type="text" class="form-control" id="login" name="login" placeholder="login">
							</div>
							<button type="button" class="btn btn-danger" onsubmit="searchAjax();" onclick="searchAjax();">Je veux gagner un chocolat !</button>
						</form>
						<?php
					} else if ($winner == "error") {
						?>
						<h1>ERROR</h1>
						<?php
					} else {
						?>
						<h1><span style="color: #FF0000;"><?php echo $winner; ?></span> a gagné aujourd'hui !<br />
						<?php
							if (date('d') != '24')
							{
								?>
								Retente ta chance demain :)
								<?php
							}
						?>
						</h1>
						<?php
					}
				?>
			</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		function searchAjax() {
			if ($('input[name="login"]').val() != '') {
				var research = $('input[name="login"]').val();
				jQuery.ajax({
					type: 'GET',
					url: 'randmzr.php',
					dataType: 'json',
					data: {rs: research},
					success: function(data, textStatus, jqXHR) {
						if (data.msg == 'GAGNE') {
							$('#res').html('').html("<h1><span style='color: #FF0000;'>GAGNE !</span></h1><br />Bouffe ton chocolat (et te trompe pas de date) !");
						} else if (data.msg == 'PERDU') {
							$('#res').html('').html("<h1><span style='color: #FF0000;'>PERDU !</span></h1><br />Ton nombre : " + data.nombre + " !<br />T'es nul, mais tu peux rejouer dans 5 secondes...");
						} else {
							$('#res').html('').html("<h1><span style='color: #FF0000;'>LOGIN INCONNU !</span></h1><br />Tu peux rejouer dans 5 secondes (avec ton vrai login)...");
						}
					},
					error: function(jqXHR, textStatus, errorThrown) {
						$('#res').html('').html("Erreur... c'est bizarre. Tant pis.");
					}
				});
			} else {
				$('#res').html('').html("<h1>C'est pas bien de cliquer sur OK sans remplir le champ.</h1><br />Tu peux rejouer dans 5 secondes...");
			}
			setTimeout(function(){
			   window.location.reload(1);
			}, 5000);
		}
	</script>
  </body>
</html>
