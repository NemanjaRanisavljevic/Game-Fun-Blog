<div class="clearfix content">
						<div class="content_title"><h2>Objave</h2></div>

						<?php
                            // PAGINACIJA
                            $x = $_GET['x'];
							$upit = "SELECT * FROM post WHERE idKategorija=:x";

							
                            $rez= $kon->prepare($upit);
                            $rez->bindParam(":x",$x);

							try{
                                $obj = $rez->execute();
                                
								
							}catch(PDOException $e){$e->getMessage();}

							$brojPoStrani=3;
                            $brojStrana=ceil($rez->rowCount()/$brojPoStrani);
                            
                       
                        	$strana=isset($_GET['type'])? $_GET['type']:1;
                            $odKogKrece =($strana-1)*$brojPoStrani;
                            
							$upit2="SELECT * FROM post p INNER JOIN korisnik k ON p.idKorisnik = p.idKorisnik INNER JOIN kategorije ka ON p.idKategorija=ka.id where id=$x 
							GROUP BY idPost LIMIT $odKogKrece,$brojPoStrani";
							$proizvodi=$kon->query($upit2)->fetchAll();
                        	
							
							foreach($proizvodi as $post):
						?>
						
						<div class="clearfix single_content">
							<div class="clearfix post_date floatleft">
								<div class="date">
								<?php 
									$timespamp= time($post->vreme); 
									$v1 = date("d",$timespamp);
									echo("<h3>$v1</h3>");
									$v2 = date("F",$timespamp);
									echo("<p>$v2</p>");
									?>
								</div>
							</div>
							<div class="clearfix post_detail">
								<h2><a href="index.php?page=singlePost&token=<?= $post->idPost?>"><?= $post->naslov?></a></h2>
								<div class="clearfix post-meta">
									<p><span><i class="fa fa-user"></i><?= " ".$post->ime ." ".$post->prezime?></span> <span><i class="fa fa-clock-o"></i>
									<?php 
									$vreme = date("d-m-Y",$timespamp);
									echo(" ". $vreme);?></span> <span><i class="fa fa-folder"></i><?= " ". $post->naziv ?></span></p>
								</div>
								<div class="clearfix post_excerpt">
									<a id="single_image" data-fancybox="group" data-caption="<?= $post->naslov?>" href="<?= $post->slika ?>">
									<img src="<?= $post->slika ?>" alt="slika <?= $post->naziv?>"/></a>
									<p><?php 
									$tekst = $post->opis;
									
									$skracenT= substr($tekst,0,356);
									echo($skracenT ."...");
									 ?></p>
								</div>
								<a href="index.php?page=singlePost&token=<?= $post->idPost?>">Komentarisi</a>
							</div>
						</div>
							<?php  endforeach;?>
						
						
								
					</div>
					
					<div class="pagination">
						<nav>
							<ul>
							<?php for($i=1;$i<$brojStrana+1;$i++): ?>
                        	<li><a href="index.php?page=sviPostoviKategorije&x=<?= $x ?>&type=<?= $i?>"><?=$i?></a></li>
                    		<?php endfor;?>
							</ul>
						</nav>
					</div>
				</div>