<section id="content_area">

			<div class="clearfix wrapper main_content_area">
			
				<div class="clearfix main_content floatleft">
				
					
					<div class="clearfix content">
						
						<div class="contact_us">
                        <div class="content_title"><h2>Izmena postojece objave</h2></div>
                        <h3><?php 
                        if(isset($_SESSION['uspesanPost'])){
                        echo($_SESSION['uspesanPost']);
                        unset($_SESSION['uspesanPost']);
                        }
                        if(isset($_SESSION['greskaPost'])){
                            echo($_SESSION['greskaPost']);
                            unset($_SESSION['greskaPost']); 
                        }
                        ?></h3>
                        
                        <!-- Provera posta pisana u logovanje.js -->
							<form  action="php/izmenaPostaAdmin.php" method="post" onSubmit="return proveraIzmenePosta();" enctype="multipart/form-data">
                            
                                <p>
                                    <!-- Izlistavanje kategorija za igrice -->
                                    <select id="ddlKategorije" name="igricelista" class="wpcf7-select">
                                    <option value="0">Izaberi naziv igrice</option>
                                    <?php
                                        
                                        $upit="SELECT * from kategorije";
                                        $rez = $kon->query($upit);
                                        foreach($rez as $kategorija):
                                    ?>
                                        <option value="<?= $kategorija->id?>"><?= $kategorija->naziv?></option>
                                    <?php endforeach?>
                                    </select>
                                </p>
                                <span id="igricaS">Morate izabrati naziv igrice!</span>
                                
                                <p><input type="text" id="naslovI" name="naslov" class="wpcf7-text" placeholder="Naslov*"/></p>
                                <span id="naslovS">Morate uneli naslov! Mora poceti velikim slovom max 50 karaktera min 5.</span>
                                <p><input id="slika" name="slika" type="file" id="file"/></p>
                                <span id="slikaS">Morate izabrati sliku!</span>
                                
                                <p><textarea id="opisI" name="opis" class="wpcf7-textarea" placeholder="Opis*"></textarea></p>
                                <span id="opisS">Morate uneti opis objave!</span>
                                <p><input type="hidden" name="skivenoID" id="skivenoID"/></p>
								<p><input type="submit" id="postavljenoI" name="postavljenoI" class="wpcf7-submit" value="Izmeni"/></p>
							</form>
							
						</div>
						
					</div>
					
					
				</div>
                <script type="text/javascript" src="javaScript/izmenaPosta.js"></script>
                
