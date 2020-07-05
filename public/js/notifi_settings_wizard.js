
notifiWizard = {

    initMaterialWizard: function () {

        $('#wizardNotification').bootstrapWizard({
            'tabClass': 'nav nav-pills',
            'nextSelector': '.btn-next',
            'previousSelector': '.btn-previous',

            onNext: function (tab, navigation, index) {
                /*var $valid = $('#wizardNotification form').valid();
                if (!$valid) {
                    $validator.focusInvalid();
                    return false;
                }*/
                if(index == 1){

                    //loadComments();
                }
                if(index == 2){
                    //loadLoghour();
                }
                if(index == 3){
                    //loadLoghour();
                }
            },

            onInit: function (tab, navigation, index) {
                //check number of tabs and fill the entire row
                var $total = navigation.find('li').length;
                var $wizard = navigation.closest('#wizardNotification');

                $first_li = navigation.find('li:first-child a').html();
                $moving_div = $('<div class="moving-tab-project">' + $first_li + '</div>');
                $('#wizardNotification .wizard-navigation').append($moving_div);

                refreshAnimationwizardNotification($wizard, index);

                $('.moving-tab-project').css('transition', 'transform 0s');
            },

            onTabClick: function (tab, navigation, index) {
               /* var $valid = $('#wizardNotification form').valid();

                if (!$valid) {
                    return false;
                } else {
                    return true;
                }*/

            },

            onTabShow: function (tab, navigation, index) {
                var $total = navigation.find('li').length;
                var $current = index + 1;

                var $wizard = navigation.closest('#wizardNotification');

                // If it's the last tab then hide the last button and show the finish instead
                if ($current >= $total) {
                    $($wizard).find('.btn-next').hide();
                    $($wizard).find('.btn-finish').show();
                } else {
                    $($wizard).find('.btn-next').show();
                    $($wizard).find('.btn-finish').hide();
                }
                if(index == 1){
                    //loadAssignedTo();
                    //loadComments();
                }
                if(index == 2){
                    //loadLoghour();
                }
                if(index == 3){
                    //loadLoghour();
                }
                button_text = navigation.find('li:nth-child(' + $current + ') a').html();

                setTimeout(function(){
                    $('.moving-tab-project').text(button_text);
                }, 150);

                var checkbox = $('.footer-checkbox');

                if (!index == 0) {
                    $(checkbox).css({
                        'opacity': '0',
                        'visibility': 'hidden',
                        'position': 'absolute'
                    });
                } else {
                    $(checkbox).css({
                        'opacity': '1',
                        'visibility': 'visible'
                    });
                }

                refreshAnimationwizardNotification($wizard, index);
                // var container2 = document.querySelector('.main-panel');
                // container2.scrollTop = 0;
                $('.main-panel').scrollTop(0);
            }
        });


        // Prepare the preview for profile picture
        $("#wizard-picture").change(function () {
            readURL(this);
        });

        $('[data-toggle="wizard-radio"]').click(function () {
            wizard = $(this).closest('#wizardNotification');
            wizard.find('[data-toggle="wizard-radio"]').removeClass('active');
            $(this).addClass('active');
            $(wizard).find('[type="radio"]').removeAttr('checked');
            $(this).find('[type="radio"]').attr('checked', 'true');
        });

        $('[data-toggle="wizard-checkbox"]').click(function () {
            if ($(this).hasClass('active')) {
                $(this).removeClass('active');
                $(this).find('[type="checkbox"]').removeAttr('checked');
            } else {
                $(this).addClass('active');
                $(this).find('[type="checkbox"]').attr('checked', 'true');
            }
        });

        $('.set-full-height').css('height', 'auto');

        //Function to show image before upload

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $(window).resize(function () {
            $('#wizardNotification').each(function () {
                $wizard = $(this);

                index = $wizard.bootstrapWizard('currentIndex');
                refreshAnimationwizardNotification($wizard, index);

                $('.moving-tab-project').css({
                    'transition': 'transform 0s'
                });
            });
        });

        function refreshAnimationwizardNotification($wizard, index) {
            //$total = $wizard.find('#wizardNotification .nav li').length;
            $total_wizardNotification = $('#wizardNotification').find(' .nav li').length;
            // $total_wizardIndicators = $('#wizardIndicators').find(' .nav li').length;
            //  $total = parseInt($total_wizardNotification) - parseInt($total_wizardIndicators);
            $li_width = 100 / $total_wizardNotification;

            $total_steps_wizardNotification = $('#wizardNotification').find('.nav li').length;
            //   $total_wizardIndicators = $('#wizardIndicators').find('.nav li').length
            //total_steps = parseInt($total_steps_wizardNotification) - parseInt($total_wizardIndicators)
            total_steps =$total_steps_wizardNotification;
            move_distance = $('#wizardNotification').width() / total_steps;

            index_temp = index;

            vertical_level = 0;


            mobile_device = $(document).width() < 600 && $total > 3;

            if (mobile_device) {
                move_distance = $('#wizardNotification').width() / 2;
                index_temp = index % 2;
                $li_width = 50;
            }

            $('#wizardNotification').find('.nav li').css('width', $li_width + '%');

            step_width = move_distance;
            move_distance = move_distance * index_temp;

            $current = index + 1;

            if ($current == 1 || (mobile_device == true && (index % 2 == 0))) {
                move_distance -= 8;
            } else if ($current == total_steps || (mobile_device == true && (index % 2 == 1))) {
                move_distance += 8;
            }

            if (mobile_device) {
                vertical_level = parseInt(index / 2);
                vertical_level = vertical_level * 38;
            }

            $('#wizardNotification').find('.moving-tab-project').css('width', step_width);
            $('.moving-tab-project').css({
                'transform': 'translate3d(' + move_distance + 'px, ' + vertical_level + 'px, 0)',
                'transition': 'all 0.5s cubic-bezier(0.29, 1.42, 0.79, 1)'

            });
        }
    },
};