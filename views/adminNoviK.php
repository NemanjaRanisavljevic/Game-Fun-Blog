<section id="content_area">
    <div class="clearfix wrapper main_content_area">

        <div class="clearfix main_content floatleft">


            <div class="clearfix content">
                <div class="content_title"><h2>Dodaj novog korisnika</h2></div>
                <div class="contact_us">

                    <form>
                    <p><input type="text" class="wpcf7-text" id="ime" name="ime" placeholder="Ime*"/></p> 
                        <span class="spanovi" id="imeS">Morate uneti ime! Prvo veliko slovo.</span>

                        <p><input type="text" class="wpcf7-text" id="prezime" name="prezime" placeholder="Prezime*"/></p>
                        <span class="spanovi" id="prezimeS">Morate uneti prezime! Prvo veliko slovo.</span>

                        <p><select id="listaPol" name="listaPol" class="wpcf7-select">
                                <option value="0">Izaberi pol</option>
                                <?php
                                
                                $upit ="Select * FROM pol";
                                $rez2 = $kon->query($upit)->fetchAll(); 
                                foreach($rez2 as $p):
                                ?>
                                <option value="<?= $p->id ?>"><?= $p->nazivP?></option>
                                <?php endforeach; ?>

                        </select>
                        </p>
                        <span class="spanovi" id="polS">Morate izabrati pol!</span>

                        <p>
                        <select id="ddlAktivan" class="wpcf7-select">
                            <option value="1">Aktivan</option>
                            <option value="0">Nije aktivan</option>
                        </select>
                        </p>

                        <p><select id="ddlUloga" name="ddlUloga" class="wpcf7-select">
                                <option value="0">Izaberi ulogu</option>
                                <?php
                                
                                $upit ="Select * FROM uloga";
                                $rez3 = $kon->query($upit)->fetchAll(); 
                                foreach($rez3 as $x):
                                ?>
                                <option value="<?= $x->id ?>"><?= $x->naziv?></option>
                                <?php endforeach; ?>

                        </select>
                        </p>
                        <span class="spanovi" id="ulogaS">Morate izabrati ulogu!</span>

                        <p><input type="text" id="email" class="wpcf7-email" name="email" placeholder="Email*"/></p>
                        <span class="spanovi" id="emailS">Morate uneti email! Mora da bude gmail.com</span>

                        <p><input type="password" id="sifra" class="wpcf7-text" name="sifra" placeholder="Sifra*"/></p>
                        <span class="spanovi" id="sifraS">Morate uneti sifru! Mora poceti velikim slovom i imati 6 karaktera.</span>

                        <p><input type="hidden" id="poljeZaid" class="wpcf7-text" name="poljeZaid" values =""/></p>

                        <p><input type="button" id="noviK" name="noviK" class="wpcf7-submit" value="Izmeni"/></p>
                    </form>

                </div>

            </div>

        </div>