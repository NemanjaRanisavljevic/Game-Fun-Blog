<div class="clearfix sidebar">
						<div class="clearfix single_sidebar">
							<div class="popular_post">
								<div class="sidebar_title"><h2>najpopularnije objave</h2></div>
								<ul>
								<?php
								$upitBest="SELECT *, count(*) as najvise FROM komentari k INNER JOIN post p ON k.postId=p.idPost GROUP BY postId ORDER BY count(*) DESC LIMIT 4";
								$best=$kon->query($upitBest)->fetchAll();
								foreach($best as $naslovi):
								?>
									<li><a href="index.php?page=singlePost&token=<?= $naslovi->idPost?>"><?= $naslovi->naslov?></a></li>
									
								<?php endforeach;?>	
								</ul>
							</div>
							</div>
						<div class="clearfix single_sidebar category_items">
							<h2>Kategorije</h2>
							<ul>
							<?php 
								
								$upit=("SELECT * from kategorije");
								$rez=$kon->query($upit);
								try{
									$rez=$kon->query($upit)->fetchAll();
								}catch(PDOException $e)
								{
									$e->getMessage();
								}
								foreach($rez as $kategorija):
							?>
								<li class="cat-item"><a href="index.php?page=sviPostoviKategorije&x=<?= $kategorija->id?>"><?= $kategorija->naziv?></a><i class="fa fa-folder"></i></li>
							<?php endforeach;?>
							</ul>
						</div>
						
					</div>
				</div>
			</div>
		</section>