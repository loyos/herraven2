<div class = "menu">
<ul>
	<li>
		Menu 1
		<ul>
			<li>Sub menu 1</li>
			<li>Sub menu 2</li>
			<li>Sub menu 3</li>
		</ul>
	</li>
	<li>
		Menu 2
		<ul>
			<li>Sub menu 2.1</li>
			<li>Sub menu 2.2</li>
			<li>Sub menu 2.3</li>
		</ul>
	</li>
	<li>Menu 3</li>
	<li>Menu 4</li>
</ul>
</div>

<script>
	
	$('li').click(function() {
		$('li').children().fadeOut();
		$(this).find('ul').fadeIn();
    });
		
</script>