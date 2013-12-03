jQuery(document).ready(function(){

    jQuery.validator.addMethod("accept", function(value, element, param) {
        if(value.match(new RegExp("" + param + "$"))){
            return true;
        }
        return false;
    }, langs.js_accept_rule);


    jQuery.validator.addMethod("valueNotEquals", function(value, element, param) {
        return value != param;
    }, langs.js_language_required);

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
            'micro[domain]': {
                accept:"^[a-z]+$",
                maxlength: 14,
                required: true,
                remote: {
                    url: ajax.domain,
                    type: "post",
                    dataType:"json",
                    data: {
                        domain: function() {
                            return jQuery("input[name='micro[domain]']").val();
                        }
                    }
                }
            }
        },
        messages: {
            'micro[company]': langs.js_company_required,
            'micro[email]': {
                required: langs.js_email_required,
                email: langs.js_email_valid
            },
            'micro[password]': langs.js_password_required,
            'micro[domain]': {
                required: langs.js_domain_required,
                maxlength: langs.js_domain_length,
                remote: langs.js_domain_exists
            }
        },
        errorElement: 'div',
        submitHandler: function(form) {
            jQuery('button[type="submit"]').html(langs.js_sending);
            if( typeof jQuery.prop === 'function' ) {
                jQuery('button[type="submit"]').prop('disabled', true);
            } else {
                jQuery('button[type="submit"]').attr('disabled', 'disabled');
            }
            jQuery('.spinner-wrapper').show();

            jQuery.ajax({
                url: ajax.create_new,
                type: 'post',
                data: jQuery('#form').serialize(),
                dataType: 'json',
                success:function(json){
                    // ajax binding
                    ajax_osclass(json);
                },
                error:function(){
                    jQuery('button[type="submit"]').html(langs.js_submit);
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