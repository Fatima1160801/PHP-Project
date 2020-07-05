
        $('#wizardGoal').bootstrapWizard({
            'tabClass': 'nav nav-pills',
            'nextSelector': '.btn-next',
            'previousSelector': '.btn-previous',

            onNext: function (tab, navigation, index) {

                var $valid = $('#wizardGoal form').valid();
                if (!$valid) {
                    $validator.focusInvalid();
                    return false;
                } else {
                    return true;
                }

            },

            onInit: function (tab, navigation, index) {
                //check number of tabs and fill the entire row
                var $total = navigation.find('li').length;
                var $wizard = navigation.closest('#wizardGoal');

                $first_li = navigation.find('li:first-child a').html();
                $moving_div = $('<div class="moving-tab-goals">' + $first_li + '</div>');
                $('#wizardGoal .wizard-navigation').append($moving_div);

                refreshAnimationGoal($wizard, index);

                $('.moving-tab-goals').css('transition', 'transform 0s');
            },

            onTabClick: function (tab, navigation, index) {
                return false;
            },
            onTabShow: function (tab, navigation, index) {
                var $total = navigation.find('li').length;
                var $current = index + 1;

                var $wizard = navigation.closest('#wizardGoal');

                // If it's the last tab then hide the last button and show the finish instead
                if ($current >= $total) {
                    $($wizard).find('.btn-next').hide();
                    $($wizard).find('.btn-finish').show();
                } else {
                    $($wizard).find('.btn-next').show();
                    $($wizard).find('.btn-finish').hide();
                }

                button_text = navigation.find('li:nth-child(' + $current + ') a').html();

                setTimeout(function () {
                    $('.moving-tab-goals').text(button_text);
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

                refreshAnimationGoal($wizard, index);
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
            wizard = $(this).closest('#wizardGoal');
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
            $('#wizardGoal').each(function () {
                $wizard = $(this);

                index = $('#wizardGoal').bootstrapWizard('currentIndex');
                refreshAnimationGoal($wizard, index);

                $('.moving-tab-goals').css({
                    'transition': 'transform 0s'
                });
            });
        });

        function refreshAnimationGoal($wizard, index) {

            $total = $('#wizardGoal').find('.nav li').length;

            $li_width = 100 / $total;

            total_steps = $('#wizardGoal').find('.nav li').length;

            move_distance = $('#wizardGoal').width() / total_steps;


            if (parseInt(index) < 0) {
                index = 0;
            }
            index_temp = index;

            vertical_level = 0;

            mobile_device = $(document).width() < 600 && $total > 3;


            if (mobile_device) {
                move_distance = $('#wizardGoal').width() / 2;
                index_temp = index % 2;
                $li_width = 50;
            }

            $('#wizardGoal').find('.nav li').css('width', $li_width + '%');

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


            $('#wizardGoal').find('.moving-tab-goals').css('width', step_width);
            $('.moving-tab-goals').css({
                'transform': 'translate3d(' + move_distance + 'px, ' + vertical_level + 'px, 0)',
                'transition': 'all 0.5s cubic-bezier(0.29, 1.42, 0.79, 1)'

            });
        }
