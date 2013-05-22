<!-- app/View/Users/add.ctp -->
<ul id="breadcrumbs">
	<li><?php echo $this->Html->link('Back to Home', array('controller'=>'users','action'=>'admin_welcome'))?></li>
	<li id="ctl00_ContentPlaceHolder1_Breadcrum1_lifour">Dashboard</li>
</ul>

<article>
	<header>
		<h2 style="cursor: s-resize;">Dashboard</h2>                        
	</header>
</article>





<div class="clearfix"></div>


<article style="float:left;" class="half-block nested clearrm">
	<div  class="article-container">
		<header><h2 style="cursor: s-resize;">Message </h2></header>
		<section>
			<div class="table-form">
				<div>
					<table cellspacing="0" cellpadding="0" border="1" style="border-collapse:collapse;" id="grdcontent" rules="all">
						<tbody>
							<tr>
								<th scope="col"></th>
								<th>SNo</th>
								<th>Title</th>
								<th>Actions</th>
							</tr>
							<?php $i=1; foreach($messages as $Message){ ?>
							
							<tr>
								<td></td>
								<td><?php echo $i;?></td>
								<td><?php echo $Message['Message']['name'];?></td>
								<td>
									<ul class="actions">
									<li><?php echo $this->Html->link('edit', array('controller'=>'messages', 'action' => 'edit',$Message['Message']['id']), array('escape' => false,'class'=>'edit','title'=>'Edit Item','rel'=>'tooltip'));?></li>
									</ul>
								</td>
							</tr>
							
							<?php $i++; } ?>
						</tbody>
					</table>
				</div>
			</div>
		</section>
		
		<footer>
			<p><?php echo $this->Html->link('View all', array('controller'=>'messages', 'action' => 'index'), array('escape' => false));?></p>
			</footer>
	</div>
</article>

<article style="float:right;" class="half-block nested clearrm">
	<div  class="article-container">
		<header><h2 style="cursor: s-resize;">Content </h2></header>
		<section>
			<div class="table-form">
				<div>
					<table cellspacing="0" cellpadding="0" border="1" style="border-collapse:collapse;" id="grdrecipe" rules="all">
						<tbody>
							<tr>
								<th scope="col"></th>
								<th>SNo</th>
								<th> Title</th>
								<th>Actions</th>
							</tr>
							
							<?php  $i=1;  foreach($pages as $Page){?>
							
							<tr>
								<td></td>
								<td><?php echo $i;?></td>
								<td><?php echo $Page['Page']['name'];?></td>
								<td>
									<ul class="actions">
									<li><?php echo $this->Html->link('edit', array('controller'=>'pages', 'action' => 'edit',$Page['Page']['id']), array('escape' => false,'class'=>'edit','title'=>'Edit Page','rel'=>'tooltip'));?></li>
									</ul>
								</td>
							</tr>
							
							<?php  $i++; }  ?>
						</tbody>
					</table>
				</div>
			</div>
		</section>
		
		<footer>
				<p><?php echo $this->Html->link('View all', array('controller'=>'pages', 'action' => 'index'), array('escape' => false));?></p>
		</footer>
	</div>
</article>




