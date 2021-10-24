<!-- Nicolò Lelli, corso B
     Esercizio: formattare la pagina per visualizzare le recnsioni dei film richiesti
	 Contenuto: informazioni da visualizzare sulla pagina senza formattazione
-->
<!DOCTYPE html>
	
	<head>
		<title>TMNT - Rancid Tomatoes</title>

		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link href="http://www.cs.washington.edu/education/courses/cse190m/11sp/homework/2/rotten.gif" type="image/gif" rel="shortcut icon">
		<link href="movie.css" type="text/css" rel="stylesheet">
	</head>

	<body>
		<div id="banner">
			<img src="http://www.cs.washington.edu/education/courses/cse190m/11sp/homework/2/banner.png" alt="Rancid Tomatoes">
		</div>

        <?php
            $movie=$_GET["film"];

			list($title, $year, $rating) = file("$movie/info.txt"); 
        ?>

		<h1><?=trim($title)?> (<?=trim($year)?>)</h1>
		
		<div id="main"> <!-- tag main per contenere le componenti detsra e sinistra del layout -->
			<div id="generalOverview"> <!-- tag contenuto destro del layout -->
				<div> <!-- tag per inserire l'immagine del film -->
					<img src="<?=$movie?>/overview.png" alt="general overview">
				</div> <!-- chiusura tag per l'immagine del film -->

				<dl> <!-- tag per la lista di definizioni del contenuto destro del layout -->

				<?php
					//lettura del file 'overview.txt del film
					$overview = file("$movie/overview.txt");
					
					for($i=0; $i<count($overview); $i++){

						$dt_overview = substr($overview[$i], 0, strpos($overview[$i], ":"));
						$dd_overview = substr($overview[$i], strpos($overview[$i], ":")+1, strlen($overview[$i]));
				?>
						<!-- stampa lista di definizioni del contenuto destro del layout -->
						<dt><?=$dt_overview?></dt>
						<dd><?=$dd_overview?></dd>

				<?php
					}
				?>

				</dl> <!-- chiusura del tag per la lista di definizioni del contenuto destro del layout -->
			</div> <!-- chiusura del tag per il contenuto destro del film -->
			
			<div id="rotten"> <!-- tag contenuto sinistro del layout -->
				<div id="rottenImage"> <!-- tag per inserire l'immagine rotten -->
					<?php
						//scelta dell'immagine rotten se il rating è minore o uguale del 60%
						if($rating<=60){
					?>
							<!-- Immagine da inserire se il rating è minore o uguale del 60% -->
							<img id="image" src="http://www.cs.washington.edu/education/courses/cse190m/11sp/homework/2/rottenbig.png" alt="Rotten">
					<?php	
						//scelta dell'immagine rotten se il rating è maggiore del 60%	
						}else{
					?>
							<!-- Immagine da inserire se il rating è maggiore del 60% -->
							<img id="image" src="http://www.cs.washington.edu/education/courses/cse190m/11sp/homework/2/freshbig.png" alt="Freshbig">
					<?php
						}
					?>	
					<!-- titolo della pagina -->
					<span id="rottenTitle"><?=$rating?>%</span>
				</div>
				
				<?php
					$review=glob("$movie/review*.txt"); //array contenente i nomi deii file delle review
					$num_review=count($review); //numero di review del film (corrisponde alla lunghezza dell'array)
					$num_in_column=$num_review/2; //numero di recensioni che devono stare in una colonna del contenuto sinistro del layout
					$start=0; //numero di recensione da cui partire
					$i=0; //conteggio delle colonne del contenuto sinistro del layout
					do{
				?>
						<div class="column"> <!-- tag per la colonna del contenuto sinistro del layout -->

							<?php	
								//lettura delle recensioni di un film
								for($j=$start; $j<10&&$j<$num_in_column; $j++){
									list($review_text, $review_type, $review_author, $author_type)=file($review[$j]);
							?>
							
									<p class="review"> <!-- tag per il contenuto della recensione di un film -->

										<?php
											//controllo se la recensione è di tipo 'rotten'
											if(trim($review_type)=="ROTTEN"){
										?>	
												<!-- inserimento dell'immagine per le recensioni di tipo 'rotten' -->
												<img src="http://www.cs.washington.edu/education/courses/cse190m/11sp/homework/2/rotten.gif" alt="Rotten">
											
										<?php
											//altrimenti la recensione è di tipo 'fresh'
											}else{
										?>
												<!-- inserimento dell'immagine per le recensioni di tipo 'fresh' -->
												<img src="http://www.cs.washington.edu/education/courses/cse190m/11sp/homework/2/fresh.gif" alt="Fresh">
											
										<?php
											}
										?>	

										<!-- inserimento della review -->
										<q><?=$review_text?></q>

									</p> <!-- chiusura del tag per il contenuto della recensione di un film -->

									<p class="name"> <!-- tag per inserire il nome e per chi lavora il recensore -->
										
										<!-- immagine del recensore -->
										<img src="http://www.cs.washington.edu/education/courses/cse190m/11sp/homework/2/critic.gif" alt="Critic">
										<!-- nome del recensore -->
										<?=$review_author?><br>
										<!-- per chi lavora il recensore -->
										<?=$author_type?>

									</p> <!-- chiusura del tag per inserire il nome e per chi lavora il recensore -->
							<?php
								}
							?>

						</div> <!-- chiusura del tag per la colonna del contenuto sinistro del layout -->
				<?php	
						$i++;
						$start=$j;
						$num_in_column=$num_review;
					}while($i<2);
				?>	
					
			</div>  <!-- chiusura del tag contenuto sinistro del layout -->

			<p id="bar">(1-<?=$num_review?>) of <?=$num_review?></p>

		</div>
			
		<div id="convalidator"> <!-- tag per l'inserimento delle immagini HTML validator e CSS validator -->
				<a href="http://validator.w3.org/check/referer"> <!-- tag per l'inserimento dell'immagine HTML validator -->
					<!-- immagine HTML validator -->
					<img width="88" src="https://upload.wikimedia.org/wikipedia/commons/b/bb/W3C_HTML5_certified.png" alt="Valid HTML5!">
				</a> <!-- chiusura del tag per l'inserimento dell'immagine HTML validator -->
				<br>
				<a href="http://jigsaw.w3.org/css-validator/check/referer"> <!-- tag per l'inserimento dell'immagine CSS validator -->
					<!-- immagine CSS validator -->
					<img src="http://jigsaw.w3.org/css-validator/images/vcss" alt="Valid CSS!">
				</a> <!-- chiusura del tag per l'inserimento dell'immagine CSS validator -->
		</div> <!-- chiusura del tag per l'inserimento delle immgini HTML validator e CSS validator -->
	</body>
</html>
