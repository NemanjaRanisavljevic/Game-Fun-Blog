<section id="footer_top_area">
			<div class="clearfix wrapper footer_top">
				<div class="clearfix footer_top_container">
					<div class="clearfix single_footer_top floatleft">
						<h2>Autor</h2>
						<p>Zovem se <a href="https://www.facebook.com/nemanja.ranisavljevic.52">Nemanja Ranisavljević </a>student sam Visoke ICT škole. Rođen sam 27.10.1997. godine u Beogradu živim u Sremskim Mihaljevcima. Završio sam srednju Ekonomsku skolu "Nada Dimić" u Zemunu. Moj broj ideksa je 86/16.</p>
					</div>
					<div class="clearfix single_footer_top floatleft">
						
					<?php
					$upit = "SELECT * FROM post ORDER BY idPost DESC LIMIT 1";
					$rez= $kon->query($upit)->fetchAll();
					
					foreach($rez as $objava):
					?>
					<a href="index.php?page=singlePost&token=<?= $objava->idPost?>"><h2>Poslednja objava</h2></a>
					
					<?php
					$tekst = $objava->opis;
									
					$skracenT= substr($tekst,0,500);
					echo("<p>". $skracenT ."...</p>");
					?>	
					<?php endforeach ?>
						
						
					</div>
					<?php if(isset($_SESSION['korisnik']) && $_SESSION['korisnik']->naziv=="admin"):?>
					<div class="clearfix single_footer_top floatleft">
						<h2>Admin meni</h2>
						<ul>
							<li><a href="index.php?page=adminNoviK">Dodaj novog korisnika</a></li>
							<li><a href="index.php?page=adminPanel">Korisnici</a></li>
							<li><a href="index.php?page=adminDodajKategoriju">Dodaj novu kategoriju</a></li>
							<li><a href="index.php?page=adminKategorije">Trenutne kategorije</a></li>
							<li><a href="index.php?page=adminDodajAnketu">Dodaj novu anketu</a></li>
							<li><a href="index.php?page=adminDodajOdgovorAnketa">Dodaj novi odgovor za anketu</a></li>
							<li><a href="index.php?page=adminAnkete">Sve ankete i odgovori</a></li>
							<li><a href="index.php?page=uvidOdgovoraNaAnketu">Korisnici koji su odgovorili na anketu</a></li>
							
						</ul>
					</div>
					<?php endif;?>
				</div>
			</div>
		</section>
		
		<section id="footer_bottom_area">
			<div class="clearfix wrapper footer_bottom">
				<div class="clearfix copyright floatleft">
					<p> &copy; All rights reserved by <span>Nemanja Ranisavljevic 86/16</span></p>
				</div>
				<div class="clearfix social floatright">
					<ul>
						<li><a class="tooltip" title="Dokumentacija" href="dokumentacija.pdf"><i class="fas fa-file-pdf"></i></a></li>
						<li><a class="tooltip" title="Facebook" href="https://www.facebook.com/nemanja.ranisavljevic.52"><i class="fab fa-facebook-square"></i></i></a></li>
					</ul>
				</div>
			</div>
		</section>
		
		
		  
		  
		<script type="text/javascript" src="js/jquery.tooltipster.min.js"></script>		
		<script type="text/javascript">
			$(document).ready(function() {
				$('.tooltip').tooltipster();
			});
		</script>
		 <script type="text/javascript" src="js/selectnav.min.js"></script>
		<script type="text/javascript">
			selectnav('nav', {
			  label: '-Navigation-',
			  nested: true,
			  indent: '-'
			});
		</script>		
		<script src="js/pgwslider.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$('.pgwSlider').pgwSlider({
					
					intervalDuration: 5000
				
				});
			});
		</script>
		<script type="text/javascript" src="js/placeholder_support_IE.js"></script>
		<script type="text/javascript" src="javaScript/fancybox/dist/jquery.fancybox.min.js"></script>
		<script type="text/javascript" src="javaScript/registracija.js"></script>
		<script type="text/javascript" src="javaScript/logovanje.js"></script>
		<script type="text/javascript" src="javaScript/brisanje.js"></script>
		<script type="text/javascript" src="javaScript/izmena.js"></script>
		
		
		

		
	</body>
</html>
