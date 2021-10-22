<!-- Nicolò Lelli, corso B
     Esercizio: formattare la pagina contenente la valutazione del film TMNT
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
		
		<div id="main">
			<div id="generalOverview">
				<div>
					<img src="<?=$movie?>/overview.png" alt="general overview">
				</div>

				<dl>

				<?php
					$overview = file("$movie/overview.txt");
					
					for($i=0; $i<count($overview); $i++){

						$dt_overview = substr($overview[$i], 0, strpos($overview[$i], ":"));
						$dd_overview = substr($overview[$i], strpos($overview[$i], ":")+1, strlen($overview[$i]));
				?>

						<dt><?=$dt_overview?></dt>
						<dd><?=$dd_overview?></dd>

				<?php
					}
				?>

				</dl>
			</div>
			
			<div id="rotten">
				<div id="rottenImage">
					<?php
						if($rating<60){
					?>
							<img id="image" src="http://www.cs.washington.edu/education/courses/cse190m/11sp/homework/2/rottenbig.png" alt="Rotten">
					<?php		
						}else{
					?>
							<img id="image" src="http://www.cs.washington.edu/education/courses/cse190m/11sp/homework/2/freshbig.png" alt="Freshbig">
					<?php
						}
					?>	
					<span id="rottenTitle"><?=$rating?>%</span>
				</div>
				
				<?php
					$review=glob("$movie/review*.txt");
					$num_review=count($review);
					$num_in_column=$num_review/2;
					$start=0;
					$i=0;
					do{
				?>
						<div class="column">

							<?php	
								for($j=$start; $j<10&&$j<$num_in_column; $j++){
									list($review_text, $review_type, $review_author, $author_type)=file($review[$j]);
							?>
							
									<p class="review">

										<?php
											if(trim($review_type)=="ROTTEN"){
										?>
												<img src="http://www.cs.washington.edu/education/courses/cse190m/11sp/homework/2/rotten.gif" alt="Rotten">
											
										<?php
											}else{
										?>

												<img src="http://www.cs.washington.edu/education/courses/cse190m/11sp/homework/2/fresh.gif" alt="Fresh">
											
										<?php
											}
										?>	

										<q><?=$review_text?></q>

									</p>

									<p class="name">

										<img src="http://www.cs.washington.edu/education/courses/cse190m/11sp/homework/2/critic.gif" alt="Critic">
										<?=$review_author?><br>
										<?=$author_type?>

									</p>
							<?php
								}
							?>

						</div>
				<?php	
						$i++;
						$start=$j;
						$num_in_column=$num_review;
					}while($i<2);
				?>	
					
			</div>

			<p id="bar">(1-<?=$num_review?>) of <?=$num_review?></p>

		</div>
			
		<div id="convalidator">
				<a href="http://validator.w3.org/check/referer">
					<img width="88" src="https://upload.wikimedia.org/wikipedia/commons/b/bb/W3C_HTML5_certified.png" alt="Valid HTML5!">
				</a>
				<br>
				<a href="http://jigsaw.w3.org/css-validator/check/referer">
					<img src="http://jigsaw.w3.org/css-validator/images/vcss" alt="Valid CSS!">
				</a>
		</div>
	</body>
</html>
