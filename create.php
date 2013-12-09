<?php
    $lang = array();
    $lang["js_accept_rule"]         = __("Only lowercase letters (a-z) are allowed", 'osclasscom');
    $lang["js_name_required"]       = __("Please enter your name", 'osclasscom');
    $lang["js_email_required"]      = __("Please enter your email", 'osclasscom');
    $lang["js_email_valid"]         = __("Please enter a valid email", 'osclasscom');
    $lang["js_company_required"]    = __("Please enter your company name", 'osclasscom');
    $lang["js_password_required"]   = __("Please enter your password", 'osclasscom');
    $lang["js_domain_required"]     = __("Please enter your custom address", 'osclasscom');
    $lang["js_domain_length"]       = __("Please enter no more than 14 characters", 'osclasscom');
    $lang["js_domain_exists"]       = __("Sorry, that site already exists!", 'osclasscom');
    $lang["js_site_exists"]         = __("Sorry, that site does not already exists!", 'osclasscom');
    $lang["js_sending"]             = __("Sending...", 'osclasscom');
    $lang["js_submit"]              = __("Sign up for free!", 'osclasscom');
    $lang["js_language_required"]   = __("Please select your language", 'osclasscom');
    $lang["js_api_key_required"]    = __("Please enter your api key", 'osclasscom');

    $ajax = array();
    $ajax["domain"]         = "https://osclass.com/api/site_exist";
    $ajax["exist_domain"]   = "https://osclass.com/api/site_domain_exist";
    $ajax["create_new"]     = "https://osclass.com/api/site/create_new";
?>
<script>
    var osclasscom = {};
    osclasscom.langs = <?php echo json_encode($lang); ?>;
    osclasscom.ajax  = <?php echo json_encode($ajax); ?>;
</script>
<div class="wrapper-box-container">
    <div id="header">
        <div class="wrapper">
            <span id="logo">
                <strong>Osclass</strong>
            </span>
        </div>
        <?php if( !osclass_is_bind() ) { ?>
        <div class="control-group show_menu_div">
            <button id="show_menu" type="submit" class="btn btn-large" style=" width: auto;"><?php _e('Show menu', 'osclasscom'); ?></button>
        </div>
        <?php } ?>
    </div>
<?php if( osclass_is_bind() ) {
    require_once(dirname(__FILE__) . '/views/main.php');
} else {
    require_once(dirname(__FILE__) . '/views/create.php');
} ?>
</div>