/*jQuery(function($) { jQuery(".form-area").find("form").on("submit", function(e) { this_form = jQuery(this); /*e.preventDefault(); this_form.off("submit"); * /if (this_form.hasClass("enviado")) { return false; } this_form.addClass('enviado'); $("body,input,button,a").css("cursor", "wait"); var email = "", post_values = {}; this_form.find('input[type=text],input[type=email]').each(function() { if (!email) { var nomeAtual = this.name.toLowerCase(); if (nomeAtual.indexOf('email') > -1 || nomeAtual.indexOf('e-mail') > -1) { email = this.value; } } this.name && this.value ? post_values[this.name] = this.value : null; }); jQuery.ajax({ type: "POST", url: "/wp-admin/admin-ajax.php", timeout: 5000, async: false, global: false, data: {action: 'gravar_conversao', post_id: inbound.post_id, email: email, visibleSentData: post_values } });/*.done(function(data) {this_form.parent().append(data);});* / }); });*/