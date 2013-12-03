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
    $lang["js_sending"]             = __("Sending...", 'osclasscom');
    $lang["js_submit"]              = __("Sign up for free!", 'osclasscom');
    $lang["js_language_required"]   = __("Please select your language", 'osclasscom');

    $ajax = array();
    $ajax["domain"]     = "https://osclass.com/api/site_exist";
    $ajax["create_new"] = "https://osclass.com/api/site/create_new";
?>
<script>
    var langs = <?php echo json_encode($lang); ?>;
    var ajax  = <?php echo json_encode($ajax); ?>;
</script>

<link href="<?php echo plugins_url('osclasscom/css/style.css'); ?>" rel="stylesheet" type="text/css"/>
<style>
    #wpcontent #logo {
        background-image: url(<?php echo plugins_url('osclasscom/images/logo@1x.png'); ?>);
        background-size: 255px 138px;
    }
    .spinner-wrapper {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        margin: 0;
        padding: 0;
    }
    .spinner {
        z-index: 2;
        display: block;
        opacity: 1;
    }
    .spinner i {
        margin-top: -100px;
    }
    .spinner-wrapper span {
        position: absolute;
        text-align: center;
        top: 50%;
        font-size: 2em;
        width: 100%;
        z-index: 3;
    }
</style>
<div class="wrapper-box-container">
<div id="header">
    <div class="wrapper">
        <span id="logo">
            <strong>Osclass</strong>
        </span>
    </div>
</div>
<?php if( osclass_is_bind() ) {
    // prepare link to your admin panel
    $dashboard_url = get_option('osclasscom');
    // prepare https
    $ocadmin = str_replace('http', 'https', get_option('osclasscom') );
    $ocadmin_dashboard_url  = $ocadmin . "/oc-admin/index.php?login=true&api_key=" . get_option('osclasscom_key') . "&page=plugins&action=renderplugin&file=jobboard/dashboard.php";
    $ocadmin_applicants_url = $ocadmin . "/oc-admin/index.php?login=true&api_key=" . get_option('osclasscom_key') . "&page=plugins&action=renderplugin&file=jobboard/people.php";
    $ocadmin_vacancies_url  = $ocadmin . "/oc-admin/index.php?login=true&api_key=" . get_option('osclasscom_key') . "&page=items";
    $ocadmin_settings_url   = $ocadmin . "/oc-admin/index.php?login=true&api_key=" . get_option('osclasscom_key') . "&page=plugins&action=renderplugin&file=corporateboardmenu/admin/settings.php";
    $ocadmin_addjob_url     = $ocadmin . "/oc-admin/index.php?login=true&api_key=" . get_option('osclasscom_key') . "&page=items&action=post";

?>
<div class="box-container">
    <div class="wrapper">
        <div class="stage">
            <div>
                <div class="form-horizontal t-reset">
                    <div class="control-group">
                        <label class="control-label" for="inputCompany">
                            <a target="_blank" href="<?php echo $ocadmin_addjob_url; ?>" class="btn btn-secondary btn-block-rsp-640"><?php _e('Add new vacancy', 'osclasscom'); ?></a></label>
                        <div class="controls t-left white"><?php _e('Add a new vacancy, add killer questions and share it on social networks', 'osclasscom'); ?></div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="inputCompany">
                            <a target="_blank" href="<?php echo $dashboard_url; ?>" class="btn  btn-block-rsp-640"><?php _e('View your jobboard', 'osclasscom'); ?></a></label>
                        <div class="controls t-left white"><?php _e('The applicants access your job board and apply to the vacancies available. See how it looks and manage all the settings. Make sure it looks good!', 'osclasscom'); ?></div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="inputCompany">
                            <a target="_blank" href="<?php echo $ocadmin_dashboard_url; ?>" class="btn  btn-block-rsp-640"><?php _e('Dashboard', 'osclasscom'); ?></a></label>
                        <div class="controls t-left white"><?php _e('Manage easily all the vacancies, filter candidates\' profiles, add notes from your Dashboard. Customize the design to adapt it to your needs in a few clicks.', 'osclasscom'); ?></div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="inputCompany">
                            <a target="_blank" href="<?php echo $ocadmin_applicants_url; ?>" class="btn  btn-block-rsp-640"><?php _e('Manage applicants', 'osclasscom'); ?></a></label>
                        <div class="controls t-left white"><?php _e('View the candidates\' profiles, filter them, contact them or send an email. You can also import already exisiting profiles manually.', 'osclasscom'); ?></div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="inputCompany">
                            <a target="_blank" href="<?php echo $ocadmin_vacancies_url; ?>" class="btn  btn-block-rsp-640"><?php _e('Manage vacancies', 'osclasscom'); ?></a></label>
                        <div class="controls t-left white"><?php _e('Add new vacancies, modify, delete already existing ones or see which have received most visits. You can also set extra questions to be answered during the application process.', 'osclasscom'); ?></div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="inputCompany">
                            <a target="_blank" href="<?php echo $ocadmin_settings_url; ?>" class="btn  btn-block-rsp-640"><?php _e('Manage settings', 'osclasscom'); ?></a></label>
                        <div class="controls t-left white"><?php _e('Manage settings to adapt job board to your needs. Customize the design, change your domain name, enable spontanoues applications, your contact details and more.', 'osclasscom'); ?></div>
                    </div>
                    <?php if( get_option('osclasscom_pageid') ) { ?>
                    <div class="control-group">
                        <label class="control-label" for="inputCompany">
                            <a target="_blank" href="<?php echo get_page_link(get_option('osclasscom_pageid')); ?>" class="btn  btn-block-rsp-640"><?php _e('Jobs page', 'osclasscom'); ?></a></label>
                        <div class="controls t-left white"><?php _e('View your vacancies page in your wordpress site.', 'osclasscom'); ?></div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php } else { ?>

<div class="box-container">
    <div class="wrapper">
        <div class="stage">
            <div>
                <h1 class="t-thin white"><?php _e('Create new job board', 'osclasscom'); ?></h1>
                <form action="" method="post" accept-charset="utf-8" class="form-horizontal t-reset" novalidate="novalidate" id="form">
                    <input name="micro[wp_url]" type="hidden" value="<?php echo home_url(); ?>" class="">
                    <input name="micro[wp_url_admin]" type="hidden" value="<?php echo $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] ?>" class="">
                    <div class="control-group">
                        <label class="control-label" for="inputCompany"><?php _e('Company', 'osclasscom'); ?></label>
                        <div class="controls">
                            <input name="micro[company]" type="text" id="inputCompany" placeholder="" class="">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="inputEmail"><?php _e('Email', 'osclasscom'); ?></label>
                        <div class="controls">
                            <input name="micro[email]" type="email" id="inputEmail" placeholder="<?php echo esc_attr( __('E-mail', 'osclasscom')); ?>" value="<?php echo get_option('admin_email', 'youremail@example.com'); ?>" class="valid">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="inputPassword"><?php _e('Password', 'osclasscom'); ?></label>
                        <div class="controls">
                            <input name="micro[password]" type="password" id="inputPassword" placeholder="<?php echo esc_attr( __('Password', 'osclasscom')); ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="inputDomain"><?php _e('Domain name', 'osclasscom'); ?></label>
                        <div class="controls subdomain-suffix">
                            <div class="relative"><input name="micro[domain]" type="text" id="inputDomain" value="">
                                <span class="suffix">.osclass.com</span></div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="inputLanguage"><?php _e('Select your language', 'osclasscom'); ?></label>
                        <div class="controls subdomain-suffix">
                            <select name="micro[language]" id="inputLanguage">
                                <option value="default"><?php _e('Loading languages', 'osclasscom').'...'; ?></option>
                            </select>
                        </div>
                    </div>

                    <div class="control-group" style="margin: 10px 0;">
                        <label class="control-label"></label>
                        <div class="controls" style="text-align: left;">
                            <input id="inputConsultancy" name="micro[b_consultancy]" type="checkbox" value="yes" style="margin-top: 0px; margin-right: 10px;">
                            <label for="inputConsultancy" class="white"><?php _e('Do you work for a HR consultancy?', 'osclasscom'); ?></span>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label"></label>
                        <div class="controls t-left">
                            <p class="t-small t-withe white"><?php _e('By clicking "Sign up" you agree to our', 'osclasscom'); ?> <a href="http://osclass.com/tos" target="_blank" class="t-withe"><?php _e('terms & conditions', 'osclasscom'); ?></a> <?php _e('and', 'osclasscom'); ?> <a href="http://osclass.com/privacy-policy" target="_blank" class="t-withe"><?php _e('privacy policy', 'osclasscom'); ?></a>.</p>
                            <button type="submit" class="btn btn-secondary btn-block-rsp-640"><?php _e('Sign up for free!', 'osclasscom'); ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="spinner-wrapper" style="display: none;">
    <div class="spinner">
        <i></i>
    </div>
    <span class="white">This could take a while</span>
</div>
<script>
    function setLanguages(json) {
        if(Object.keys(json).length>0) {
            jQuery('#inputLanguage option').text('<?php echo esc_js(__('Select your language', 'osclasscom')); ?>');
            jQuery.each(json, function(index, value) {
                jQuery('#inputLanguage').append(jQuery("<option></option>")
                 .attr("value",index)
                 .text(index));
            });
        }
    }
    jQuery('#form').submit(function(e) {
        return false;
    });
</script>

<script type="application/javascript" src="https://osclass.com/api/get_languages?jsoncallback=setLanguages"></script>
<?php } ?>
</div>