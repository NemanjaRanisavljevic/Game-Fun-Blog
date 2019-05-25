<section id="content_area">
			<div class="clearfix wrapper main_content_area">
			
				<div class="clearfix main_content floatleft">
				
					<div class="clearfix slider">
					<ul class="pgwSlider">
					<?php 
					
					$upit = "SELECT * FROM post ORDER BY idPost DESC LIMIT 3";
					$rez= $kon->query($upit)->fetchAll();
					
					foreach($rez as $slajder):
					?>
						
							

							<li>
								<img src="<?= $slajder->slika ?>" alt="<?= $slajder->naslov ?>" data-large-src="<?= $slajder->slika ?>" data-description="Najnovije objave">
							</li>
					<?php endforeach ?>


						</ul>
					</div>