<?php $locate="story";?>
<?php require dirname(__FILE__) . '/include/header.php';?>
<div class="container">
	
	<div class="col-md-9">
		<div class="list-group">
			
			<div class="list-group-item" style="border: 0;">
				<a href="#" style="color: #0F0F0F;"><h4>【神秘客315特别策划】哪家航空公司最让你泪流满面</h4></a>
				<p class="text-muted">
					<small>发布时间:2015-2-11</small>	
					<small class="pull-right">
						点击量:<span class="badge">20</span>
					</small>
				</p>
				<p class="text-muted">
					从2014年12个月投诉率平均值来看，从高到低依次是东方航空、中国国航、南方航空和海南航空。
海航2月份投诉率创造了四大航最高点。2月恰似去年春节客运高峰期，海航抗压能力有点差哦。
从投诉率波动来看，海南航空、南方航空投诉率波动较大；国际航空、东方航空投诉率波动较小
				</p>
				<p>
				  <span class="badge">率波动</span>	<span class="badge">国际航空</span>	<span class="badge">海南航空</span>	
				</p>
			</div>
			<div style="border: 1px dashed #ddd;"></div>
			
			<div class="text-center">
				<ul class="pagination">
					<li><a href="#">&laquo;</a></li>
					<li><a href="#">1</a></li>
					<li><a href="#">2</a></li>
					<li><a href="#">3</a></li>
					<li><a href="#">4</a></li>
					<li><a href="#">&raquo;</a></li>
				</ul>
			</div>
			
		</div>
	</div>
	
	
	<div class="col-md-3">
		<div class="panel panel-default">
			<div class="panel-heading">
				推荐新闻
			</div>
			<div class="panel-body">
				<strong class="panel-title" ><a href="#" class="text-muted">1111111133333333</a></strong>
				<p>依次是东方航空、中国国航、南方航空和海南航空。 海航2月份投诉率创造了四大航最高点。2月恰似去年春节客运高峰期，海航抗压能力有点差哦。 从投诉率波</p>
			</div>
		</div>
		
		<div class="panel panel-default">
			<div class="panel-heading">
				推荐新闻
				<a href="#" class="text-muted pull-right">>>></a>
			</div>
			<div class="list-group">
				<?php  for($i=0;$i<8;$i++){?>
				<li class="list-group-item" style="border:0px">
					<a href="#" class="text-muted">1111111133333333</a>
				</li>
				<?php } ?>
			</div>
		</div>
		
		<div class="panel panel-primary">
			<div class="panel-heading">
				推荐视频
				<a href="#" class="text-danger pull-right">>>></a>
			</div>
			<ul class="media-list"	syle="margin-left:5px;margin-top:5px;"	>
				<?php for($i=0;$i<4;$i++){?>
				<li>
					<div class="media">
						<div class="media-left">
							<img src="img/1.png" class="media-object" style="height:42px ;"/>
						</div>
						<div class="media-body">
							<strong class="media-heading" >大力发展互联网</strong>
							<p>依次是东方航空、中国国航、南方航空和海南航空</p>
						</div>
					</div>
				</li>
				<?php } ?>
			</ul>
		</div>
		
	</div>
	
</div>

<?php require dirname(__FILE__) . '/include/footer.php';?>


















