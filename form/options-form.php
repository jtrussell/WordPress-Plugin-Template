<div class="wrap">
  <div id="icon-options-general" class="icon32"></div>
  <h2><?php echo template_wp::$plugin_name; ?> Settings</h2>
  <form action="options.php" method="post">
    <?php settings_fields(template_wp::$option_group); ?>
    <table class="form-table">
      <tbody>
        <!-- My Option -->
        <?php
          $option = "my_option";
          $label = "My Option";
          $title = "title text";
          $name = template_wp::option_name($option);
          $id = template_wp::option_name($option);
          $value = template_wp::get_option($option);
        ?>
        <tr valign="top" title="<?php echo $title ?>">
          <th>
            <label for="<?php echo $id; ?>"><?php echo $label ?></label>
          </th>
          <td>
            <input name="<?php echo $name; ?>" value="<?php echo $value; ?>" id="<?php echo $id ?>" type="text" class="regular-text" />
          </td>
        </tr><!-- End My Option -->

      </tbody>
    </table>
    <p class="submit"><input type="submit" class="button-primary" name="submit" value="Save Changes" /></p>
  </form>
</div>
