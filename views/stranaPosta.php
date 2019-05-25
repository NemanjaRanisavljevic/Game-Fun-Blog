<section id="content_area">
			<div class="clearfix wrapper main_content_area">
			<?php
				if(isset($_GET['token'])):
				
					require_once("php/konekcija.php");
					$idPosta =$_GET['token'];
					$upit = "SELECT * 
							 FROM post p INNER JOIN korisnik k
							 ON p.idKorisnik = k.idKorisnik
							 WHERE idPost = :id";
					$rez = $kon->prepare($upit);
					$rez->bindParam(":id",$idPosta);
					
					$rez->execute();
					$jedan = $rez->fetch();
					if($jedan == true):
					?>

<div class="clearfix main_content floatleft">
				
					
				<div class="clearfix content">
					<div class="content_title"><h2><?= $jedan->naslov?></h2></div>
					<div class="single_work_page clearfix">
						<div class="work_single_page_feature"><img src="<?= $jedan->slika?>" alt ="slika <?= $jedan->naslov?>"/></div>
						<div class="work_meta clearfix">
							<p class="floatleft"><span><i class="fa fa-clock-o"></i>
							<?php 
								$secemo = substr($jedan->vreme,0,10);
								$datumNiz=explode("-",$secemo);
								
								$timespamp= mktime(0,0,0,$datumNiz[1],$datumNiz[2],$datumNiz[0]);
								$vreme = date("d F Y",$timespamp);
								echo(" ". $vreme);
								?>
							</span><span><i class="fa fa-user"></i><?= " ".$jedan->ime ." ".$jedan->prezime?></span>
							</p>
					<?php if(isset($_SESSION['korisnik']) &&  $_SESSION['korisnik']->naziv=="admin"): ?>
						<p><a class="izmeniPost" href="index.php?page=adminIzmenaPosta&id=<?= $idPosta ?>" >Izmeni</a>
						<a class="floatright brPosta" href="index.php?page=index" data-id="<?= $idPosta?>">Obrisi</a> 
						 </p>
					
							
					<?php endif; ?>
						</div>
						<div class="single_work_page_content">
							<p><?= $jedan->opis?></p>
							
							<br/>
							
						</div>
						
					</div>
					
						<div id="more_works" class="more_works">
							<h2><i class="fa fa-comment"></i> Komentari</h2>
							
					<?php 
// OVDE ISPISUJEMO KOMENTARE ZA POST
					$upit	=	"SELECT * 
						FROM komentari kom INNER JOIN korisnik k 
						ON kom.korisnikId=k.idKorisnik INNER JOIN post p ON kom.postId=p.idPost WHERE postId=:p";
					
					$rez = $kon->prepare($upit);
					$rez->bindParam(":p",$idPosta);
					
					try {
						$rez->execute();
						$sviKom=$rez->fetchAll();
					} catch (PDOException $e) {
						$e->getMessage();
					}

					foreach($sviKom as $k):
					?>
							<div class="clearfix single_content">
							<div class="clearfix post_date floatleft">
								<div class="date">
								<?php 
									$secemo = substr($k->vreme_komentara,0,10);
									$datumNiz=explode("-",$secemo);
									
									$timespamp= mktime(0,0,0,$datumNiz[1],$datumNiz[2],$datumNiz[0]);
									$v1 = date("d",$timespamp);
									echo("<h3>$v1</h3>");
									$v2 = date("F",$timespamp);
									echo("<p>$v2</p>");
									?>
									
									
								</div>
							</div>
							<div id="post_detail" class="clearfix post_detail">
							
								<div class="clearfix post-meta">
									<p><span><i class="fa fa-user"></i><?= " ".$k->ime." ".$k->prezime ?></span>
									<span><i class="fa fa-clock-o"></i>
								
									
									
									<?php 
									$secemo = substr($k->vreme_komentara,11,19);
									$datumNiz=explode(":",$secemo);
									
									$timespamp= mktime($datumNiz[0],$datumNiz[1],0,0,0,0);
									$vreme = date("H:i",$timespamp);
									
									echo(" ".$vreme);
									?></span>
					<?php if(isset($_SESSION['korisnik']) &&  $_SESSION['korisnik']->naziv=="admin"): ?>
					
									<a class="floatright brKom" href="#more_works" data-id="<?= $k->id ?>">Obrisi</a>
					<?php endif;?>
									</p>
									
								</div>
								<div class="clearfix post_excerpt">
									
									<p><?= $k->sadrzaj ?></p>
								</div>
								
							</div>
							
						</div>
					<?php endforeach; ?>
					<div id="radi" class="clearfix"></div>
					
		
							<div class="contact_us">
							<?php 
							 if(isset($_SESSION['korisnik'])): ?>
							<div class="content_title"><h2>Ostavi svoj komentar</h2></div>
							<form>
								<p><input type="hidden" id="komKorisnika" name="komKorisnika" value="<?= $_SESSION['korisnik']->idKorisnik ?>"/></p>
								<p><input type="hidden" id="postId" name="postId" value="<?= $idPosta ?>"/></p>
								<p><input type="hidden" id="katId" name="katId" value="<?= $jedan->idKategorija ?>"/></p>
								<p><textarea class="wpcf7-textarea" id ="komentarV" placeholder="Komentar*"></textarea></p>
								<span id="komS">Morate uneti komentar objave! Minimum 10 karaktera.</span>
								<p><input type="button" id="postavi" name="postavi" class="wpcf7-submit" value="Postavi"/></p>
							</form>
							
					<?php include("php/komentar.php"); endif;?>
						</div>
						</div>
				</div>
				
			</div>
			<?php 
				else:
					header("Location: index.php?page=index");
				endif;
				endif;
			?>
				