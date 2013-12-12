<?php
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
                        <label class="control-label t-white" for="inputCompany">
                            <a target="_blank" href="<?php echo $ocadmin_addjob_url; ?>" class="btn btn-secondary btn-block-rsp-640"><?php _e('Add new vacancy', 'osclasscom'); ?></a></label>
                        <div class="controls t-left white"><?php _e('Add a new vacancy, add killer questions and share it on social networks', 'osclasscom'); ?></div>
                    </div>
                    <div class="control-group">
                        <label class="control-label t-white" for="inputCompany">
                            <a target="_blank" href="<?php echo $dashboard_url; ?>" class="btn  btn-block-rsp-640"><?php _e('View your jobboard', 'osclasscom'); ?></a></label>
                        <div class="controls t-left white"><?php _e('The applicants access your job board and apply to the vacancies available. See how it looks and manage all the settings. Make sure it looks good!', 'osclasscom'); ?></div>
                    </div>
                    <div class="control-group">
                        <label class="control-label t-white" for="inputCompany">
                            <a target="_blank" href="<?php echo $ocadmin_dashboard_url; ?>" class="btn  btn-block-rsp-640"><?php _e('Dashboard', 'osclasscom'); ?></a></label>
                        <div class="controls t-left white"><?php _e('Manage easily all the vacancies, filter candidates\' profiles, add notes from your Dashboard. Customize the design to adapt it to your needs in a few clicks.', 'osclasscom'); ?></div>
                    </div>
                    <div class="control-group">
                        <label class="control-label t-white" for="inputCompany">
                            <a target="_blank" href="<?php echo $ocadmin_applicants_url; ?>" class="btn  btn-block-rsp-640"><?php _e('Manage applicants', 'osclasscom'); ?></a></label>
                        <div class="controls t-left white"><?php _e('View the candidates\' profiles, filter them, contact them or send an email. You can also import already exisiting profiles manually.', 'osclasscom'); ?></div>
                    </div>
                    <div class="control-group">
                        <label class="control-label t-white" for="inputCompany">
                            <a target="_blank" href="<?php echo $ocadmin_vacancies_url; ?>" class="btn  btn-block-rsp-640"><?php _e('Manage vacancies', 'osclasscom'); ?></a></label>
                        <div class="controls t-left white"><?php _e('Add new vacancies, modify, delete already existing ones or see which have received most visits. You can also set extra questions to be answered during the application process.', 'osclasscom'); ?></div>
                    </div>
                    <div class="control-group">
                        <label class="control-label t-white" for="inputCompany">
                            <a target="_blank" href="<?php echo $ocadmin_settings_url; ?>" class="btn  btn-block-rsp-640"><?php _e('Manage settings', 'osclasscom'); ?></a></label>
                        <div class="controls t-left white"><?php _e('Manage settings to adapt job board to your needs. Customize the design, change your domain name, enable spontanoues applications, your contact details and more.', 'osclasscom'); ?></div>
                    </div>
                    <?php if( get_option('osclasscom_pageid') ) { ?>
                    <div class="control-group">
                        <label class="control-label t-white" for="inputCompany">
                            <a target="_blank" href="<?php echo get_page_link(get_option('osclasscom_pageid')); ?>" class="btn  btn-block-rsp-640"><?php _e('Jobs page', 'osclasscom'); ?></a></label>
                        <div class="controls t-left white"><?php _e('View your vacancies page in your wordpress site.', 'osclasscom'); ?></div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>