<div class="box-container box-osclasscom">
    <div class="form-horizontal t-reset menu_buttons white">
        <h1 class="t-thin"><?php _e('Get free recruiting software for your company!', 'osclasscom'); ?></h1>
        <div class="mgn-top-50">
            <a href="#" id="btn_create_div" class="btn btn-large btn-secondary" style="width: auto;"><?php _e('Sign up', 'osclasscom'); ?></a></label>
        </div>
        <div class="mgn-top-50">
            <?php _e('Or, do you already have a job board in Osclass.com?', 'osclasscom') ?> <a id="btn_connect_div" class="white" href="#"><?php _e('Import your job offers into your site.', 'osclasscom'); ?></a>
        </div>
    </div>
    <div id="create_div" class="step">
        <div class="step-header">
        </div>
        <div class="step-content">
            <div class="wrapper">
                <h2 class="t-thin white"><?php _e('Create new job board', 'osclasscom'); ?></h2>
            </div>
            <form action="" method="post" accept-charset="utf-8" class="form-horizontal t-reset" id="form">
                <div class="wrapper">
                    <input name="micro[wp_url]" type="hidden" value="<?php echo home_url(); ?>" class="">
                    <input name="micro[wp_url_admin]" type="hidden" value="<?php echo $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] ?>" class="">
                    <div class="control-group">
                        <label class="control-label t-white" for="inputCompany"><?php _e('Company', 'osclasscom'); ?></label>
                        <div class="controls">
                            <input name="micro[company]" type="text" id="inputCompany" placeholder="" class="">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label t-white" for="inputEmail"><?php _e('Email', 'osclasscom'); ?></label>
                        <div class="controls">
                            <input name="micro[email]" type="email" id="inputEmail" placeholder="<?php echo esc_attr( __('E-mail', 'osclasscom')); ?>" value="<?php echo get_option('admin_email', 'youremail@example.com'); ?>" class="valid">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label t-white" for="inputPassword"><?php _e('Password', 'osclasscom'); ?></label>
                        <div class="controls">
                            <input name="micro[password]" type="password" id="inputPassword" placeholder="<?php echo esc_attr( __('Password', 'osclasscom')); ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label t-white" for="inputDomain"><?php _e('Domain name', 'osclasscom'); ?></label>
                        <div class="controls subdomain-suffix">
                            <div class="relative"><input name="micro[domain]" type="text" id="inputDomain" value="">
                                <span class="suffix">.osclass.com</span></div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label t-white" for="inputLanguage"><?php _e('Select your language', 'osclasscom'); ?></label>
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
                </div>
            </form>
        </div>
    </div>
    <div id="connect_div" class="step">
        <div class="step-content">
            <div class="wrapper">
                <h2 class="t-thin white"><?php _e('Connect with your Osclass job board', 'osclasscom'); ?></h2>
            </div>
            <form action="" method="post" accept-charset="utf-8" class="form-horizontal t-reset" id="form_bind">
                <div class="wrapper">
                    <div class="wrapper white" style="padding-top: 0px; margin: 0px auto; max-width: 490px;">
                        <p><?php _e('If you already have an osclass.com job board');?></p>
                        <p><?php _e('You need to enter into your admin panel and copy your Api key located under <br/>Settings -> Api key', 'osclasscom'); ?></p>
                    </div>
                    <input name="micro[wp_url]" type="hidden" value="<?php echo home_url(); ?>" class="">
                    <input name="micro[wp_url_admin]" type="hidden" value="<?php echo $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] ?>" class="">

                    <div class="control-group">
                        <label class="control-label t-white" for="inputDomain"><?php _e('Your domain name', 'osclasscom'); ?></label>
                        <div class="controls subdomain-suffix">
                            <div class="relative"><input class="js-connect-domain" name="micro[domain]" type="text" id="inputDomain" value="">
                                <span class="suffix">.osclass.com</span></div>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label t-white" for="inputApi"><?php _e('You api key', 'osclasscom'); ?></label>
                        <div class="controls">
                            <input class="js-connect-api-key"  name="micro[api_key]" type="text" id="inputApi" placeholder="">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label"></label>
                        <div class="controls t-left">
                            <button type="submit" class="btn btn-secondary btn-block-rsp-640"><?php _e('Connect now!', 'osclasscom'); ?></button>
                        </div>
                    </div>
               </div>
            </form>
        </div>
    </div>
</div>
<div class="spinner-wrapper" style="display: none;">
    <div class="spinner">
        <i></i>
    </div>
    <span class="white"><?php _e('This could take a while', 'osclasscom'); ?></span>
</div>
<script>
    jQuery('#btn_create_div').click(function(){
        jQuery('.step-content .wrapper').hide();
        jQuery('#create_div').find('.step-content .wrapper').each(function(){ jQuery(this).toggle(); });
        jQuery('.menu_buttons').hide();
        jQuery('.show_menu_div').show();
    });
    jQuery('#btn_connect_div').click(function(){
        jQuery('.step-content .wrapper').hide();
        jQuery('#connect_div').find('.step-content .wrapper').each(function(){ jQuery(this).toggle(); });
        jQuery('.menu_buttons').hide();
        jQuery('.show_menu_div').show();
    });

    jQuery('#show_menu').click(function(){
        jQuery('.step-content .wrapper').hide();
        jQuery('.menu_buttons').show();
        jQuery('.show_menu_div').hide();
    });

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
    jQuery('#form, #form_bind').submit(function(e) {
        return false;
    });
</script>
<script type="application/javascript" src="https://osclass.com/api/get_languages?jsoncallback=setLanguages"></script>