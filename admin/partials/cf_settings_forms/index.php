<?php
/**
 * @file
 * This file contains all of the admin functions.
 *
 * For this module this is only the Admin page. For now.
 */

// If our helper function is not yet available, we include the file containing
// it. Make it so that it does not load twice.
if (!function_exists('renderForm')) {
  // Load our required file.
  require_once plugin_dir_path(__FILE__) . 'cf_setting_functions.php';
}

/**
 * Here we define our groups, later on used to render our form "nicely".
 */
$groups = [

  [
    'group' => 'group_set_cf_setting',
    'title' => __('Content Factory Settings', 'mp_cf'),
  ],
 
  [
    'group' => 'actions',
    'title' => __('Actions', 'mp_cf'),
  ],
  
];
/**
 * Here we define a list of our fields.
 *
 * The array exists of 4 indexes; Group, name, info, type, length,
 * required, default.
 * Types: text, password, int, boolean.
 * required: TRUE/FALSE.
 */
$fields = [
  [
    'field_group' => 'group_set_cf_setting',
    'field_title' => __('Guarantee Value (%)', 'mp_cf'),
    'field_name' => 'mp_cf_guarantee_value',
    'field_type'  => 'text',
    'field_length' => 2,
    'field_required' => FALSE,
    'field_default' =>15,
    'field_info' => __('Guarantee value in MPX percent to be given to the requester.', 'mp_cf'),
  ],
  [
    'field_group' => 'group_set_cf_setting',
    'field_title' => __('Minimum MPXR to request content', 'mp_cf'),
    'field_name' => 'mp_cf_min_mpxr_to_request',
    'field_type'  => 'text',
    'field_length' => 2,
    'field_required' => FALSE,
    'field_default' =>1,
    'field_info' => __('Minimum MPXR value for the user to request content.', 'mp_cf'),
  ],
  
  [
    'field_group' => 'actions',
    'field_title' => __('Save settings', 'mp_cf'),
    'field_name' => 'Submit',
    'field_default' => __('Save'),
    'field_type' => 'submit',
  ],
];

/**
 * Frist we check if our form has been submitted.
 *
 * If so, we validate and save the data.
 */
if (form_is_submitted($fields, 'mp_cf_hidden')) {
  // Update options.
  ?>
  <div class="updated">
      <p><strong>Settings: </strong> <?php _e('Data has been saved.', 'mp_cf'); ?> </p>
  </div>
  <?php
}

/**
 * Always show our form.
 */
// Get our field defaults.
$fields = fields_set_default_values($fields);
// Open the form tag.
?>
<form name="mp_cf_settings_form" method="post" action="<?php echo str_replace('%7E', '~', $_SERVER['REQUEST_URI']); ?>">
  <input type="hidden" name="mp_cf_hidden" id="mp_cf_hidden" value="Y" />
  <?php print renderForm($groups, $fields); ?>
</form>
