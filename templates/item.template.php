<?php for ($i = 0; $i < count($itemArray); $i++) { ?>

	<li class="item <?php print $itemArray[$i][$classesArray]; ?>" data-category="<?php print $itemArray[$i][$sourceArray]; ?>" data-postdate="<?php print $itemArray[$i][$timevarArray]; ?>">
		<?php if ( isset( $itemArray[$i][$titleArray] ) ): ?>
			<h3><?php print $itemArray[$i][$titleArray]; ?></h3>
		<?php endif; ?>
		<?php print $itemArray[$i][$contentArray]; ?>
		<?php if ( isset( $itemArray[$i][$directlinkArray] ) ): ?>
			<p class="datetime"><a href="<?php print $itemArray[$i][$directlinkArray]; ?>"><?php print $itemArray[$i][$displaytimeArray]; ?></a></p>
		<?php endif; ?>
	</li>

<?php } ?>