<!-- View footer -->
<div class="col-lg-12">
	<nav class="navbar navbar-default navbar-static-top foot font" style=" margin-bottom: 0px !important;" role="navigation">
		<div class="collapse navbar-collapse navbar-ex1-collapse">
			<ul class="nav navbar-nav">
				<li>
					<a><?=$info_config->getTitle()?><br />
						Phiên Bản <?=$info_config->getVersion()?><br />
						<?=$info_config->getRelease()?></a>
						<a><?=$info_config->getCopyright()?></a>
					</li>
				</ul>
				<!-- Kết thúc thông tin phiên bản -->
				<ul class="nav navbar-nav navbar-right" style="margin-right: 15px">
					<li><a><?=$info_config->getContributes()?></a></li>
				</ul>
				<!-- Kết thúc thông tin nhóm thực hiện -->
			</div>
		</nav>
	</div>
	<!-- Kết thúc footer -->
</body>
</html>