<div class="wrap">
	<div id="icon-options-general" class="icon32"></div>
	<h2><?php echo template_wp::$plugin_name; ?> Settings</h2>
	<form action="options.php" method="post">
		<?php settings_fields(template_wp::$option_group); ?>
		<table class="form-table">
			<tbody>
				<!-- My Option -->
				<?php
					$name 	= template_wp::option_name("my_option");
					$id		= template_wp::option_name("my_option");
					$value	= template_wp::get_option("my_option");
				?>
				<tr valign="top">
					<th>
						<label for="<?php echo $id; ?>">My Option</label>
					</th>
					<td>
						<input name="<?php echo $name; ?>" value="<?php echo $value; ?>" id="iha_service_provder_id" type="text" class="regular-text" />
					</td>
				</tr><!-- End My Option -->

			</tbody>
		</table>
		<p class="submit"><input type="submit" class="button-primary" name="submit" value="Save Changes" /></p>
	</form>
</div><!-- End wrap -->
