<div class="clearfix sidebar_container floatright">
				
					<div class="clearfix newsletter">

						<?php if(isset($_SESSION['greske'])):
							unset($_SESSION['greske']);	
						?>
						<h1>Niste dobro uneli email ili lozinku!</h1>
						

						<?php endif;?>

						<?php if(isset($_SESSION['korisnik'])): ?>
						<h2>Dobrodosli <?= $_SESSION['korisnik']->ime  ?>  </h2>

					<!-- ANKETA -->
						
						<?php 
						
							$upit1="SELECT * FROM anketa Where aktivna= 1 ";
							$ankete = $kon->query($upit1)->fetchAll();
							foreach($ankete as $a):
						?>
						<h3><?= $a->pitanje ?><h3>
							<?php
							$id=$a->id_a;
							$upit2="SELECT * FROM anketa_odgovori ao INNER JOIN anketa a ON ao.idAnketa=a.id_a WHERE id_a=:id";
							$rez2 = $kon->prepare($upit2);
							$rez2->bindParam(":id",$id);
							$rez2->execute();
							$odgovori = $rez2->fetchAll();
							
							?>
						<form>
						<select id="selectA<?= $a->id_a?>">
						<option value="0">Izaberite odgovor</option>
							<?php foreach($odgovori as $o):?>
							<option value="<?= $o->id_od?>"><?= $o->odgovor?></option>
							<?php  endforeach;?>
						</select>
						
						<input type="button" name="btnAnketa" class="btnAnketa" value="Potvrdi"  data-id="<?= $a->id_a?>"/>
						</form>

						 

						<?php endforeach; else: ?>
						<form method="POST" action="php/logovanjeS.php" onSubmit="return proveraLogovanja();">
							<h2>Prijavi se</h2>
							<input type="text" name="emailLog" placeholder="Email*" id="mce-EMAIL"/>
							<span id="emailL">Morate uneti email! Mora da bude gmail.com</span>
							<input type="password" name="sifraLog" placeholder="Sifra*" id="mce-TEXT"/>
							<span id="sifraL">Morate uneti sifru! Mora poceti velikim slovom i imati 6 karaktera.</span>
							<input type="submit" name="logDugme" value="Prijava" id="mc-embedded-subscribe"/>

						</form>
						<?php endif;?>
					</div>