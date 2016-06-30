(function ($) {
	//FeaturedIconView	
    window.luxuryvillaVcFeaturedIconView = vc.shortcode_view.extend( {
        changeShortcodeParams:function (model) {
            window.luxuryvillaVcFeaturedIconView.__super__.changeShortcodeParams.call(this, model);
            var params = model.get('params');
            if (_.isObject(params)) {
                this.$el.find('.wpb_element_wrapper .vc_element-icon, .wpb_element_wrapper i').remove();
                this.$el.find('.wpb_element_wrapper').prepend( '<i class="' + params.featured_icon +' ' + params.align + '"></i>' );
                if( params.align == 'pull-center' ) {
                    this.$el.find('.wpb_element_wrapper').css( {'text-align': 'center'});
                }
            }
        }
    });
    window.VcCallToActionView = vc.shortcode_view.extend({
        changeShortcodeParams:function (model) {
            var params = model.get('params');
            window.VcCallToActionView.__super__.changeShortcodeParams.call(this, model);
            if (_.isObject(params) && _.isString(params.position)) {
                this.$el.find('> .wpb_element_wrapper').removeClass(_.values(this.params.position.value).join(' ')).addClass(params.position);
            }
        }
    });
    //SingleIconView  
    window.luxuryvillaVcSingleIconView = vc.shortcode_view.extend( {
        changeShortcodeParams:function (model) {
            window.luxuryvillaVcSingleIconView.__super__.changeShortcodeParams.call(this, model);
            var params = model.get('params');
            if (_.isObject(params)) {
                this.$el.find('.wpb_element_wrapper .vc_element-icon, .wpb_element_wrapper i').remove();
                this.$el.find('.wpb_element_wrapper').prepend( '<i class="' + params.single_icon +' ' + params.align + '"></i>' );
                if( params.align == 'pull-center' ) {
                    this.$el.find('.wpb_element_wrapper').css( {'text-align': 'center'});
                }
            }

        }
    });
    //FeaturedImageView
    window.luxuryvillaVcFeaturedImageView = vc.shortcode_view.extend( {
        changeShortcodeParams:function (model) {
            window.luxuryvillaVcFeaturedImageView.__super__.changeShortcodeParams.call(this, model);
            var params = model.get('params');
            if (_.isObject(params)) {
                if( !_.isEmpty( params.image ) ) {
                    var element = this.$el;
                    $.ajax({
                        type: 'POST',
                        url: window.ajaxurl,
                        data:{
                            action: 'wpb_single_image_src',
                            content: params.image,
                            size: 'thumbnail'
                        },
                        dataType:'html'
                    }).done(function (url) {
                        element.find('.vc_element-icon').css( {
                            'background-image': 'url(' + url + ')',
                            'background-size': '32px 32px',
                            'background-position': '0 0'
                        });
                    });
                }
            }
        }
    });
	
	//TitleSubtitleView
	window.luxuryvillaVcTitleSubtitleView = vc.shortcode_view.extend( {
        changeShortcodeParams:function (model) {
            window.luxuryvillaVcTitleSubtitleView.__super__.changeShortcodeParams.call(this, model);
            var params = model.get('params');
            if (_.isObject(params)) {
                this.$el.find('.wpb_element_wrapper').empty();

                var box = $('<div style="text-align: '+ params.align +'" />');
                if( !_.isEmpty( params.title ) ) {
                    var title = $('<' + params.title_type + ' style="margin-top:10px;">' + params.title + '</' + params.title_type + '>');
                }
                if( !_.isEmpty( params.subtitle ) ) {
                    var subtitle = $('<p>' + params.subtitle + '</p>');
                }

                this.$el.find('.wpb_element_wrapper').wrap(box).prepend(title, subtitle);

            }
        }
    });

    //TestimonialView
    window.luxuryvillaVcTestimonialView = vc.shortcode_view.extend( {
        changeShortcodeParams:function (model) {
            window.luxuryvillaVcTestimonialView.__super__.changeShortcodeParams.call(this, model);
            var params = model.get('params');
            if (_.isObject(params)) {
                if( !_.isEmpty( params.image ) ) {
                    var element = this.$el;
                    $.ajax({
                        type: 'POST',
                        url: window.ajaxurl,
                        data:{
                            action: 'wpb_single_image_src',
                            content: params.image,
                            size: 'thumbnail'
                        },
                        dataType:'html'
                    }).done(function (url) {
                        element.find('.wpb_element_wrapper').css( {
                            'background-image': 'url(' + url + ')',
                            'background-size': '42px 42px',
                            'padding-left': '72px'
                        });
                    });
                }
            }
        }
    });

	//TeamMemberView
    window.luxuryvillaVcTeamMemberView = vc.shortcode_view.extend( {
        changeShortcodeParams:function (model) {
            window.luxuryvillaVcTeamMemberView.__super__.changeShortcodeParams.call(this, model);
            var params = model.get('params');
            if (_.isObject(params)) {
                if( !_.isEmpty( params.image ) ) {
                    var element = this.$el;
                    $.ajax({
                        type: 'POST',
                        url: window.ajaxurl,
                        data:{
                            action: 'wpb_single_image_src',
                            content: params.image,
                            size: 'thumbnail'
                        },
                        dataType:'html'
                    }).done(function (url) {
                        element.find('.wpb_element_wrapper').css( {
                            'background-image': 'url(' + url + ')',
                            'background-size': '42px 42px',
                            'padding-left': '72px'
                        });
                    });
                }
            }
        }
    });

    //BlockquoteView
    window.luxuryvillaVcBlockquoteView = vc.shortcode_view.extend( {
        changeShortcodeParams:function (model) {
            window.luxuryvillaVcBlockquoteView.__super__.changeShortcodeParams.call(this, model);
            var params = model.get('params');
            if (_.isObject(params)) {
                this.$el.find('.wpb_element_wrapper').empty();

                var box = $('<div />');

                if( !_.isEmpty( params.quote ) ) {
                    var quote = $('<blockquote>' + params.quote +' <br /> <cite>' + params.cite + '</cite></blockquote>');
                }
                
                this.$el.find('.wpb_element_wrapper').wrap(box).prepend(quote);

            }
        }
    });
})(window.jQuery);