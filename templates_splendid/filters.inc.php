<?php if(empty($_GET['ajax'])) { ?>
				<div style="float: left">
				<div class="filter" id="menu">
					<h4>Zoeken</h4>

					<form id="filterform" action="" onsubmit="return submitSearchForm(this)">
						<?php $search = array_merge(array('type' => 'Titel', 'text' => '', 'tree' => '', 'unfiltered' => ''), $search); ?>
						<input type="hidden" id="search-tree" class="markmark" value="<?php echo $search['tree']; ?>">
						<table border="0" cellpadding="0" cellspacing="0" style="width: 214px;margin-left: 20px">
						  <tr> 
						    <td><input type="radio" name="search[type]" class="radio_type" value="Titel"<?php echo $search['type'] == "Titel" ? ' checked="checked"' : "" ?>>Titel</td>
						    <td><input type="radio" name="search[type]" class="radio_type" value="Poster"<?php echo $search['type'] == "Poster" ? ' checked="checked"' : "" ?>>Afzender</td>
							<td><input type="radio" name="search[type]" class="radio_type" value="Tag"<?php echo $search['type'] == "Tag" ? ' checked="checked"' : "" ?>>Tag</td>
						  </tr>
						  <tr>
						    <td colspan="3" id="search_box">
						      <input class="search_text" type="text" name="search[text]" value="<?php echo htmlspecialchars($search['text']); ?>">
						      <input type="submit" value="Zoek" class="submit">
						    </td>
						  </tr>
						  <tr>
						    <td colspan='3'><a onclick="clearTree()">Reset selectie</a></td>
						  </tr>
						</table>
						
						
						<div id="tree"> 
						  <ul>
						  </ul>
						</div>
						
						
					</form><br />
					
					<h4>Filters</h4><br />
                    
                    <ul class="filterlist">
<?php
    foreach($filters as $filter) {
?>
                        <!--<li<?php if($filter[2]) { echo " class='". $tplHelper->filter2cat($filter[2]) ."'"; } ?>> <a class="filter <?php echo $filter[3]; ?>" href="?search[tree]=<?php echo $filter[2];?>"><img src='<?php echo $filter[1]; ?>'><?php echo $filter[0]; ?></a>-->
                        <li<?php if($filter[2]) { echo " class='". $tplHelper->filter2cat($filter[2]) ."'"; } ?>> <a class="filter <?php echo $filter[3]; ?>" onclick="$('#spots').load('?search[tree]=<?php echo $filter[2];?>&ajax=1');clearTree();"><img src='<?php echo $filter[1]; ?>'><?php echo $filter[0]; ?></a>
<?php
        if (!empty($filter[4])) {
            echo "\t\t\t\t\t\t\t<ul class='filterlist subfilterlist'>\r\n";
            foreach($filter[4] as $subFilter) {
				$strFilter = '?search[tree]=' . $subFilter[2];
?>
            			<!--<li><a class="filter <?php echo $subFilter[3];?>" href="<?php echo $strFilter;?>"><img src='<?php echo $subFilter[1]; ?>'><?php echo $subFilter[0]; ?></a></li>-->
            			<li><a class="filter <?php echo $subFilter[3];?>" onclick="$('#spots').load('<?php echo $strFilter;?>&ajax=1');clearTree();"><img src='<?php echo $subFilter[1]; ?>'><?php echo $subFilter[0]; ?></a></li>
            			
<?php
				if (!empty($subFilter[4])) {
					echo "\t\t\t\t\t\t\t<ul class='filterlist subfilterlist'>\r\n";
					foreach($subFilter[4] as $sub2Filter) {
						$strFilter = '';
		?>
							<!--<li> <a class="filter <?php echo $sub2Filter[3];?>" href="<?php echo $strFilter;?>"><img src='<?php echo $sub2Filter[1]; ?>'><?php echo $sub2Filter[0]; ?></a></li>-->
							<li> <a class="filter <?php echo $sub2Filter[3];?>" onclick="$('#spots').load('<?php echo $strFilter;?>&ajax=1');clearTree();"><img src='<?php echo $sub2Filter[1]; ?>'><?php echo $sub2Filter[0]; ?></a></li>
		<?php
					} # foreach 
					echo "\t\t\t\t\t\t\t</ul>\r\n";
				} # is_array
			
			} # foreach 
            echo "\t\t\t\t\t\t\t</ul>\r\n";
        } # is_array
    } # foreach
?>
                    </ul><br /><br />

					<h4>Maintenance</h4>
					<ul class="filterlist maintenancebox">
						<li class="info"> Laatste update: <?php echo $tplHelper->formatDate($lastupdate, 'lastupdate'); ?> </li>
<?php
	if ($settings['show_updatebutton']) {
?>
						<li> <a href="retrieve.php?output=xml" id="updatespotsbtn" class="big_button updatespotsbtn">Update Spots</a></li>
<?php
	}
?>
<?php
	if ($settings['keep_downloadlist']) {
?>
						<li> <a href="?page=erasedls" id="removedllistbtn" class="big_button erasedlsbtn">Remove history of downloads</a></li>
<?php
	}
?>
						<li> <a href="?page=markallasread" id="markallasreadbtn" class="big_button markallasreadbtn">Mark all as read</a></li>
					</ul>

				</div><br style="clear: both" />
				<img src="templates_splendid/img/menu_end.jpg" width="255" height="24" border="0" />
			</div>

<?php } ?>
