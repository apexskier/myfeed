<?php
for ($i = 0; $i < count($titles); $i++) {
?>
<li class="item <?php print $source[$i]; ?>" data-category="<?php print $source[$i]; ?>" data-postdate="<?php print $published[$i]; ?>">
	<h3><?php print $titles[$i]; ?></h3>
	<?php print $content[$i]; ?>
</li>
<?php } ?>