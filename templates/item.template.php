<?php for ($i = 0; $i < count($itemArray); $i++) { ?>

	<li class="item <?php print $itemArray[$i][$classesArray]; ?>" data-category="<?php print $itemArray[$i][$sourceArray]; ?>" data-postdate="<?php print $itemArray[$i][$timevarArray]; ?>">
		<?php if ($itemArray[$i][$sourceArray] != 'promotejs'): ?>
			<img src="img/<?php print $itemArray[$i][$sourceArray]; ?>.png" alt="<?php print $itemArray[$i][$sourceArray]; ?>" width="32" height="32" class="sourceicon" />
		<?php endif; ?>
		<?php if ( isset( $itemArray[$i][$titleArray] ) ): ?>
			<h3><?php print $itemArray[$i][$titleArray]; ?></h3>
		<?php endif; ?>
		<?php print $itemArray[$i][$contentArray]; ?>
		<?php if ( isset( $itemArray[$i][$directlinkArray] ) ): ?>
			<p class="datetime"><a href="<?php print $itemArray[$i][$directlinkArray]; ?>"><?php print $itemArray[$i][$displaytimeArray]; ?></a></p>
		<?php endif; ?>
	</li>

<?php } ?>