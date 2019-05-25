<body>
	
		<section id="header_area">
			<div class="wrapper header">
				<div class="clearfix header_top">
					<div class="clearfix logo floatleft">
						<a href="index.php?page=index"><h1><span>Game</span> Fun</h1></a>
					</div>
				</div>
				<div class="header_bottom">
				<nav>
						<ul id="nav">
						<?php
							$upit ="SELECT * FROM meni WHERE roditelj=0";
							$rez = $kon->query($upit)->fetchAll();
							$id = $rez[1]->id;
							
							$upit2="SELECT * FROM kategorije";
							$rez2 = $kon->query($upit2)->fetchAll(); 
							if(!isset($_SESSION['korisnik'])):
						?>
							<li><a href="<?= $rez[0]->putanja?>"><?= $rez[0]->naziv?></a></li>
							<li id="dropdown"><a href=""><?= $rez[1]->naziv?></a>
							<ul>
									<?php foreach($rez2 as $kat): ?>
									
									<li><a href="index.php?page=sviPostoviKategorije&x=<?= $kat->id?>"><?= $kat->naziv?></a></li>
									
							       <?php endforeach;?>
								   </ul>  
							 </li>	
							<li><a href="<?= $rez[4]->putanja?>"><?= $rez[4]->naziv?></a></li>

							<?php else: ?>
								
							<li><a href="<?= $rez[0]->putanja?>"><?= $rez[0]->naziv?></a></li>
							<li id="dropdown"><a href=""><?= $rez[1]->naziv?></a>
									<ul>
									<?php foreach($rez2 as $kat): ?>
									
									<li><a href="index.php?page=sviPostoviKategorije&x=<?= $kat->id?>"><?= $kat->naziv?></a></li>
									
							       	<?php endforeach;?>
								    </ul>  
							 </li>	
							<li><a href="<?= $rez[2]->putanja?>"><?= $rez[2]->naziv?></a></li>
							<li><a href="<?= $rez[5]->putanja?>"><?= $rez[5]->naziv?></a></li>
							<?php if(isset($_SESSION['korisnik']) && $_SESSION['korisnik']->naziv=="admin"): ?>
							<li><a href="index.php?page=adminPanel">Admin panel</a></li>
							<?php endif; ?>
							<li><a href="<?= $rez[3]->putanja?>"><?= $rez[3]->naziv?></a></li>
								
						

							<?php endif; ?>
							
                        </ul>
					</nav>
				</div>
			</div>
		</section>