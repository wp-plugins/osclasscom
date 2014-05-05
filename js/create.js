function ajax_osclass(json) {
    var data = {
        action: 'create_bind',
        site: json.site_url,
        key: json.key
    }

    jQuery.post(ajaxurl, data, function(response) {
        if(response.success) {
            /* redirect */
            location.reload(true);
        } else {
            /* error */
        }
    }, 'json');
}

jQuery(document).ready(function(){
    jQuery.validator.addMethod("accept", function(value, element, param) {
        if(value.match(new RegExp("" + param + "$"))){
            return true;
        }
        return false;
    }, osclasscom.langs.js_accept_rule);


    jQuery.validator.addMethod("valueNotEquals", function(value, element, param) {
        return value != param;
    }, osclasscom.langs.js_language_required);

    jQuery("form#form_bind").validate({
        rules: {
            'micro[api_key]': {
                required: true
            },
            'micro[domain]': {
                accept:"^[a-z]+$",
                required: true,
                remote: {
                    url: osclasscom.ajax.exist_domain,
                    type: "post",
                    dataType:"json",
                    data: {
                        domain: function() {
                            return jQuery("form#form_bind input[name='micro[domain]']").val();
                        }
                    }
                }
            }
        },
        messages: {
            'micro[company]': osclasscom.langs.js_api_key_required,
            'micro[domain]': {
                required: osclasscom.langs.js_domain_required,
                remote: osclasscom.langs.js_site_exists
            }
        },
        errorElement: 'div',
        submitHandler: function(form) {
            jQuery('form#form_bind button[type="submit"]').html(osclasscom.langs.js_sending);
            if( typeof jQuery.prop === 'function' ) {
                jQuery('form#form_bind button[type="submit"]').prop('disabled', true);
            } else {
                jQuery('form#form_bind button[type="submit"]').attr('disabled', 'disabled');
            }
            jQuery('.spinner-wrapper').show();

            jQuery.ajax({
                url: ajaxurl,
                type: 'post',
                dataType: 'json',
                data: {
                    'action': 'check_apikey',
                    'data': {
                        'domain': jQuery('.js-connect-domain').val(),
                        'apikey': jQuery('.js-connect-api-key').val()
                    }
                },
                success: function(response){
                    if(response) {
                        var jsonObj = {
                            site_url: 'http://'+jQuery('.js-connect-domain').val()+'.osclass.com',
                            key:      jQuery('.js-connect-api-key').val()
                        };
                        ajax_osclass(jsonObj);
                    } else {
                        jQuery('form#form_bind button[type="submit"]').html(osclasscom.langs.js_connect_now);
                        if( typeof jQuery.prop === 'function' ) {
                            jQuery('form#form_bind button[type="submit"]').prop('disabled', false);
                        } else {
                            jQuery('form#form_bind button[type="submit"]').removeAttr('disabled');
                        }
                        jQuery('.spinner-wrapper').hide();
                        alert(osclasscom.langs.js_connect_error);
                    }
                },
                error:function(){
                    jQuery('form#form_bind button[type="submit"]').html(osclasscom.langs.js_connect_now);
                    if( typeof jQuery.prop === 'function' ) {
                        jQuery('form#form_bind button[type="submit"]').prop('disabled', false);
                    } else {
                        jQuery('form#form_bind button[type="submit"]').removeAttr('disabled');
                    }
                    jQuery('.spinner-wrapper').hide();
                }
            });
        }
    });

    jQuery("form#form").validate({
        rules: {
            'micro[company]': {
                required: true
            },
            'micro[email]':  {
                required: true,
                email: true
            },
            'micro[password]': {
                required: true
            },
            'micro[language]': {
                valueNotEquals: "default"
            },
            'micro[country]': {
                required: true
            },
            'micro[domain]': {
                accept:"^[a-z]+$",
                maxlength: 14,
                required: true,
                remote: {
                    url: osclasscom.ajax.domain,
                    type: "post",
                    dataType:"json",
                    data: {
                        domain: function() {
                            return jQuery("form#form input[name='micro[domain]']").val();
                        }
                    }
                }
            }
        },
        messages: {
            'micro[company]': osclasscom.langs.js_company_required,
            'micro[email]': {
                required: osclasscom.langs.js_email_required,
                email: osclasscom.langs.js_email_valid
            },
            'micro[country]': osclasscom.langs.js_country_required,
            'micro[password]': osclasscom.langs.js_password_required,
            'micro[domain]': {
                required: osclasscom.langs.js_domain_required,
                maxlength: osclasscom.langs.js_domain_length,
                remote: osclasscom.langs.js_domain_exists
            }
        },
        errorElement: 'div',
        submitHandler: function(form) {
            jQuery('button[type="submit"]').html(osclasscom.langs.js_sending);
            if( typeof jQuery.prop === 'function' ) {
                jQuery('button[type="submit"]').prop('disabled', true);
            } else {
                jQuery('button[type="submit"]').attr('disabled', 'disabled');
            }
            jQuery('.spinner-wrapper').show();

            jQuery.ajax({
                url: osclasscom.ajax.create_new,
                type: 'post',
                data: jQuery('#form').serialize(),
                dataType: 'json',
                success:function(json){
                    // ajax binding
                    ajax_osclass(json);
                },
                error:function(){
                    jQuery('button[type="submit"]').html(osclasscom.langs.js_submit);
                    if( typeof jQuery.prop === 'function' ) {
                        jQuery('button[type="submit"]').prop('disabled', false);
                    } else {
                        jQuery('button[type="submit"]').removeAttr('disabled');
                    }
                    jQuery('.spinner-wrapper').hide();
                }
            });
        }

    });
});