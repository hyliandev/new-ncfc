<ul class="model-list"><?php foreach($posts as $post): ?>
	<li>
		<h2>
			<a href="<?=urlForum()?>/showthread.php?tid=<?=$post->Get('tid')?>">
				<?=$post->Get('subject')?>
			</a>
		</h2>
		
		<h3>
			Posted by <?=$post->Author()->Get('username')?>
			on <?=date('F j, Y', $post->Get('dateline'))?>
			at <?=date('g:ia', $post->Get('dateline'))?>
		</h3>
		
		<p>
			<?=$post->Get('message')?>
		</p>
	</li>
<?php endforeach; ?></ul>

<a href="<?=urlForum()?>/forumdisplay.php?fid=<?=$post->Get('fid')?>">
	See More
</a>