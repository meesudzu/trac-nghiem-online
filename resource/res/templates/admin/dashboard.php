<div class="title-content">
	<span class="title">Tổng Quan</span>
</div>
<div class="block-content overflow scrollbar">
	<div class="content">
		<div class="row">
			<div id="dashboard">
				<?php
				for($i = 0; $i < count($dashboard); $i++) {
					?>
					<div class="col s12 m6 l4 xl4">
						<a href="index.php?action=<?=$dashboard[$i]->actionlink?>">
							<div class="dashboard-inner-item">
								<div class="left-item">
									<i class="fa <?=$dashboard[$i]->icon?> fa-2x"></i>
								</div>
								<div class="right-item">
									<div class="right-item-top">
										<?=$dashboard[$i]->count?>
									</div>
									<div class="right-item-bottom">
										<?=$dashboard[$i]->name?>
									</div>
								</div>
								<div class="clear"></div>
							</div>
						</a>
					</div>
					<?php
				}
				?>
			</div>
		</div>
	</div>
</div>
</div>