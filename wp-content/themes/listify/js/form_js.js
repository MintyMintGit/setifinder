jQuery(document).ready(function() {



    jQuery('body').on('click','a.input_a_enter_one_blocks_all',function(event){


            //отменяем стандартную обработку нажатия по ссылке
            event.preventDefault();

            //забираем идентификатор бока с атрибута href
            var id  = jQuery(this).attr('href'),

                //узнаем высоту от начала страницы до блока на который ссылается якорь
                top = jQuery(id).offset().top;

            //анимируем переход на расстояние - top за 1500 мс
        jQuery('body,html').animate({scrollTop: top}, 1500);


    });


    jQuery('body').on('click','.next_step_one',function(){
        jQuery('.form_custom_all_one_add_dop').hide();
        jQuery('.center_blocking_stepone').hide();
        jQuery('.center_blocking_steptwo').show();

        jQuery('.line_prg_all_green_step2').css('background','green');
        jQuery('.line_prg_all_greenback_bttnext').removeClass('next_step_one');
        jQuery('.line_prg_all_greenback_bttnext').addClass('next_step_two');

    });

    jQuery('body').on('click','.next_step_two',function(){

        jQuery('.center_blocking_steptwo').hide();
        jQuery('.center_blocking_stepthree').show();


        jQuery('.line_prg_all_green_step3').css('background','green');

        jQuery('.line_prg_all_greenback_bttnext').removeClass('next_step_two');
        jQuery('.line_prg_all_greenback_bttnext').addClass('next_step_three');


    });
    jQuery('body').on('click','.next_step_three',function(){

        jQuery('.center_blocking_stepthree').hide();
        jQuery('.center_blocking_stepfour').show();

        jQuery('.line_progress').hide();
        jQuery('.line_prg_all_green_step3').css('background','green');

        jQuery('.line_prg_all_greenback_bttnext').removeClass('next_step_two');
        jQuery('.line_prg_all_greenback_bttnext').addClass('next_step_three');

        jQuery('.line_prg_all_greenback_bttnextnext_step_fin').css('display','block !important');
        jQuery('.line_prg_all_greenback_bttnext.next_step_two').css('display','none !important');

        jQuery('.line_progress').css('display','none !important');

    });

    jQuery('body').on('click','.input_a_enter_one_blocks_all',function(){


        if( jQuery(this).attr("rref") == 'House' || jQuery(this).attr("rref") == 'Mansion' ){

            jQuery('.line_prg_all_greenback_bttnext').addClass("next_step_onettnext");
            jQuery('.line_prg_all_greenback_bttnext').removeClass("next_step_one");

        }
    });

    jQuery('body').on('click','.next_step_onettnext',function(){

        jQuery('.center_blocking_stepone').hide();
        jQuery('.form_custom_all_one_add_dop').show();
        jQuery('#temp').show();
        jQuery('.line_prg_all_greenback_bttnext').addClass("next_step_one");
        jQuery('.line_prg_all_greenback_bttnext').removeClass("next_step_onettnext");

    });






    jQuery('body').on('click','.hover_none',function(){

        jQuery('.line_prg_all_greenback_bttnext').css('visibility','visible');
        jQuery('.line_prg_all_greenback_bttnext').css('opacity','1');

        jQuery(this).css('border-color','#ef3652');

        jQuery('.line_prg_all_greenback_bttnext').css('opacity','1');

        jQuery(this).addClass("hover_once");
        jQuery(this).removeClass("hover_none");
    });

    jQuery('body').on('click','.hover_once',function(){

        jQuery('.line_prg_all_greenback_bttnext').css('visibility','visible');
        jQuery('.line_prg_all_greenback_bttnext').css('opacity','1');

        jQuery(this).css('border-color','rgba(128, 128, 128, 0.52)');

        jQuery('.line_prg_all_greenback_bttnext').css('opacity','1');

        jQuery(this).addClass("hover_none");
        jQuery(this).removeClass("hover_once");
    });

    jQuery('body').on('click','.input_select_self_blocks_grey',function(){
        jQuery('.input_select_self_blocks_grey').css('background','grey');
        jQuery('.input_select_self_blocks_grey').css('color','white');

        jQuery('.input_select_self_blocks_green').css('background','transparent');
        jQuery('.input_select_self_blocks_green').css('color','black');

    });
    jQuery('body').on('click','.input_select_self_blocks_green',function(){
        jQuery('.input_select_self_blocks_green').css('background','green');
        jQuery('.input_select_self_blocks_green').css('color','white');

        jQuery('.input_select_self_blocks_grey').css('background','transparent');
        jQuery('.input_select_self_blocks_grey').css('color','black');

    });

    jQuery('body').on('click','.input_a_enter_title_selected_residential',function(){
        jQuery('.input_a_enter_title_selected_residential').addClass("hover_block");
        jQuery('.input_a_enter_title_selected_commercial').removeClass("hover_block");

        jQuery('.goinput_a_enter_one_blocks').show();
	jQuery('#temp').hide();

        jQuery('.goinput_a_enter_two_blocks').hide();

    });

    jQuery('body').on('click','.input_a_enter_title_selected_commercial',function(){

        jQuery('.input_a_enter_title_selected_commercial').addClass("hover_block");
        jQuery('.input_a_enter_title_selected_residential').removeClass("hover_block");
	jQuery('#temp').hide();
        jQuery('.goinput_a_enter_two_blocks').show();

        jQuery('.goinput_a_enter_one_blocks').hide();

    });

});