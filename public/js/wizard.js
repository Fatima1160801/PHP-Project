
indicatorsWizard = {
    initMaterialWizard: function () {
        // Code for the Validator

        // Wizard Initialization


        $('#wizardIndicators').bootstrapWizard({
            'tabClass': 'nav nav-pills',
            'nextSelector': '.btn-next',
            'previousSelector': '.btn-previous',

            onNext: function (tab, navigation, index) {

                if (!is_valid_form($('#wizardIndicators form'))) {
                    $('#wizardIndicators form').focusInvalid();
                    return false;
                }
                // var $valid = $('#wizardIndicators form').valid();
                // if (!$valid) {
                //     $valid.focusInvalid();
                //     return false;
                // } else {
                //     return true;
                // }

            },

            onInit: function (tab, navigation, index) {

                //check number of tabs and fill the entire row
                var $total = navigation.find('li').length;
                var $wizard = navigation.closest('#wizardIndicators');

                $first_li = navigation.find('li:first-child a').html();
                $moving_div = $('<div class="moving-tab-goals">' + $first_li + '</div>');
                $('#wizardIndicators .wizard-navigation').append($moving_div);

                refreshAnimationGoal($wizard, index);

                $('.moving-tab-goals').css('transition', 'transform 0s');
            },

            onTabClick: function (tab, navigation, index) {

                if ($("input[name=tab_flag_result]").val() == 1) {
                    return true;
                }
                if ($("input[name=tab_flag_indict]").val() == 1) {
                    return true;
                }
                return false;

                //    return checktab($('#wizardIndicators').bootstrapWizard('previous'));

            }

            ,
            onTabShow: function (tab, navigation, index) {

                var $total = navigation.find('li').length;
                var $current = index + 1;

                var $wizard = navigation.closest('#wizardIndicators');

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
            wizard = $(this).closest('#wizardIndicators');
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
            $('#wizardIndicators').each(function () {
                $wizard = $(this);

                index = $('#wizardIndicators').bootstrapWizard('currentIndex');

                refreshAnimationGoal($wizard, index);

                $('.moving-tab-goals').css({
                    'transition': 'transform 0s'
                });
            });
        });

        function refreshAnimationGoal($wizard, index) {

            $total = $('#wizardIndicators').find('.nav-project li').length;

            $li_width = 100 / $total;

            total_steps = $('#wizardIndicators').find('.nav-project li').length;

            move_distance = $('#wizardIndicators').width() / total_steps;


            if (parseInt(index) < 0) {
                index = 0;
            }
            index_temp = index;

            vertical_level = 0;

            mobile_device = $(document).width() < 600 && $total > 3;


            if (mobile_device) {
                move_distance = $('#wizardIndicators').width() / 2;
                index_temp = index % 2;
                $li_width = 50;
            }

            $('#wizardIndicators').find('.nav-project li').css('width', $li_width + '%');

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


            $('#wizardIndicators').find('.moving-tab-goals').css('width', step_width);
            $('.moving-tab-goals').css({
                'transform': 'translate3d(' + move_distance + 'px, ' + vertical_level + 'px, 0)',
                'transition': 'all 0.5s cubic-bezier(0.29, 1.42, 0.79, 1)'

            });
        }
    },
}


projectWizard = {
    initMaterialWizard: function () {
        // Code for the Validator


        // Wizard Initialization
        $('#wizardProject').bootstrapWizard({
            'tabClass': 'nav nav-pills',
            'nextSelector': '.btn-next',
            'previousSelector': '.btn-previous',

            onNext: function (tab, navigation, index) {


                /* check project id is not null before complete project*/
                if(index == 1){
                    if($('#formProjectMain #id').val() == ''){
                        return false;
                    }
                }

                var $valid = $('#wizardProject form').valid();
                if (!$valid) {
                   // $validator.focusInvalid();
                    $validator.focusInvalid();
                    return false;
                }

            },

            onInit: function (tab, navigation, index) {
                //check number of tabs and fill the entire row
                var $total = navigation.find('li').length;
                var $wizard = navigation.closest('#wizardProject');

                $first_li = navigation.find('li:first-child a').html();
                $moving_div = $('<div class="moving-tab-project">' + $first_li + '</div>');
                $('#wizardProject .wizard-navigation').append($moving_div);

                refreshAnimationWizardProject($wizard, index);

                $('.moving-tab-project').css('transition', 'transform 0s');
            },

            onTabClick: function (tab, navigation, index) {
                var $valid = $('#wizardProject form').valid();

                if (!$valid) {
                    return false;
                } else {
                    return true;
                }
            },

            onTabShow: function (tab, navigation, index) {
if(index == 6){
    project_files()
}
                var $total = navigation.find('li').length;
                var $current = index + 1;
                 $wizard = navigation.closest('#wizardProject');

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

                refreshAnimationWizardProject($wizard, index);
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
            wizard = $(this).closest('#wizardProject');
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
            $('#wizardProject').each(function () {
                $wizard = $(this);

                index = $wizard.bootstrapWizard('currentIndex');
                refreshAnimationWizardProject($wizard, index);

                $('.moving-tab-project').css({
                    'transition': 'transform 0s'
                });
            });
        });

        function refreshAnimationWizardProject($wizard, index) {
            //$total = $wizard.find('#wizardProject .nav-project li').length;
            $total_wizardProject = $('#wizardProject').find(' .nav-project li').length;
           // $total_wizardIndicators = $('#wizardIndicators').find(' .nav-project li').length;
          //  $total = parseInt($total_wizardProject) - parseInt($total_wizardIndicators);
            $li_width = 100 / $total_wizardProject;

            $total_steps_wizardProject = $('#wizardProject').find('.nav-project li').length;
         //   $total_wizardIndicators = $('#wizardIndicators').find('.nav-project li').length
            //total_steps = parseInt($total_steps_wizardProject) - parseInt($total_wizardIndicators)
            total_steps =$total_steps_wizardProject;
            move_distance = $('#wizardProject').width() / total_steps;

            index_temp = index;

            vertical_level = 0;


            mobile_device = $(document).width() < 600 && $total > 3;

            if (mobile_device) {
                move_distance = $('#wizardProject').width() / 2;
                index_temp = index % 2;
                $li_width = 50;
            }

            $('#wizardProject').find('.nav-project li').css('width', $li_width + '%');

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

            $('#wizardProject').find('.moving-tab-project').css('width', step_width);
            $('.moving-tab-project').css({
                'transform': 'translate3d(' + move_distance + 'px, ' + vertical_level + 'px, 0)',
                'transition': 'all 0.5s cubic-bezier(0.29, 1.42, 0.79, 1)'

            });
        }
    },
}


donorsWizard = {
    initMaterialWizard: function () {
        // Code for the Validator

        // Wizard Initialization


        $('#wizardDonors').bootstrapWizard({
            'tabClass': 'nav nav-pills',
            'nextSelector': '.btn-next',
            'previousSelector': '.btn-previous',

            onNext: function (tab, navigation, index) {
                if ( $('#formEditDonor #id').val() != "" ) {
                    return true;
                }else{
                    return false;
                }

                // var $valid = $('#wizardDonors form').valid();
                // if (!$valid) {
                //     $validator.focusInvalid();
                //     return false;
                // } else {
                //     return true;
                // }

            },

            onInit: function (tab, navigation, index) {

                //check number of tabs and fill the entire row
                var $total = navigation.find('li').length;
                var $wizard = navigation.closest('#wizardDonors');

                $first_li = navigation.find('li:first-child a').html();
                $moving_div = $('<div class="moving-tab-goals">' + $first_li + '</div>');
                $('#wizardDonors .wizard-navigation').append($moving_div);

                refreshAnimationGoal($wizard, index);

                $('.moving-tab-goals').css('transition', 'transform 0s');
            },

            onTabClick: function (tab, navigation, index) {
                if ($('#formEditDonor  #id').val() != null ||  $('#formEditDonor  #id').val() != "" ) {
                  return true;
                }else{
                    return false;
                }

            }

            ,
            onTabShow: function (tab, navigation, index) {

                var $total = navigation.find('li').length;
                var $current = index + 1;

                var $wizard = navigation.closest('#wizardDonors');

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
            wizard = $(this).closest('#wizardDonors');
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
            $('#wizardDonors').each(function () {
                $wizard = $(this);

                index = $('#wizardDonors').bootstrapWizard('currentIndex');

                refreshAnimationGoal($wizard, index);

                $('.moving-tab-goals').css({
                    'transition': 'transform 0s'
                });
            });
        });

        function refreshAnimationGoal($wizard, index) {

            $total = $('#wizardDonors').find('.nav-pills li').length;

            console.log($total)
            $li_width = 100 / $total;

            total_steps = $('#wizardDonors').find('.nav-pills li').length;

            move_distance = $('#wizardDonors').width() / total_steps;


            if (parseInt(index) < 0) {
                index = 0;
            }
            index_temp = index;

            vertical_level = 0;

            mobile_device = $(document).width() < 600 && $total > 3;


            if (mobile_device) {
                move_distance = $('#wizardDonors').width() / 2;
                index_temp = index % 2;
                $li_width = 50;
            }

            $('#wizardDonors').find('.nav-pills li').css('width', $li_width + '%');

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
            $('#wizardDonors').find('.moving-tab-goals').css('width', step_width);
            $('.moving-tab-goals').css({
                'transform': 'translate3d(' + move_distance + 'px, ' + vertical_level + 'px, 0)',
                'transition': 'all 0.5s cubic-bezier(0.29, 1.42, 0.79, 1)'
            });
        }
    },
}


wizardActivity = {
    initMaterialWizard: function () {
        // Code for the Validator

        // Wizard Initialization


        $('#wizardActivity').bootstrapWizard({
            'tabClass': 'nav nav-pills',
            'nextSelector': '.btn-next',
            'previousSelector': '.btn-previous',

            onNext: function (tab, navigation, index) {
                if ( ($('#formActivityMainAdd #id').val() != null && $('#formActivityMainAdd #id').val() != "") ||
                    ($('#formSubActivity #id').val() != null && $('#formSubActivity #id').val() !="")) {

                    return true;
                }else{

                    return false;
                }

                // var $valid = $('#wizardActivity form').valid();
                // if (!$valid) {
                //     $validator.focusInvalid();
                //     return false;
                // } else {
                //     return true;
                // }

            },

            onInit: function (tab, navigation, index) {

                //check number of tabs and fill the entire row
                var $total = navigation.find('li').length;
                var $wizard = navigation.closest('#wizardActivity');

                $first_li = navigation.find('li:first-child a').html();
                $moving_div = $('<div class="moving-tab-goals">' + $first_li + '</div>');
                $('#wizardActivity .wizard-navigation').append($moving_div);

                refreshAnimationGoal($wizard, index);

                $('.moving-tab-goals').css('transition', 'transform 0s');
            },

            onTabClick: function (tab, navigation, index) {
                if ( ($('#formActivityMainAdd #id').val() != null && $('#formActivityMainAdd #id').val() != "") ||
                    ($('#formSubActivity #id').val() != null && $('#formSubActivity #id').val() !="")) {
                    return true;
                }else{
                    return false;
                }
            }

            ,
            onTabShow: function (tab, navigation, index) {

                var $total = navigation.find('li').length;
                var $current = index + 1;

                var $wizard = navigation.closest('#wizardActivity');

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
            wizard = $(this).closest('#wizardActivity');
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
            $('#wizardActivity').each(function () {
                $wizard = $(this);

                index = $('#wizardActivity').bootstrapWizard('currentIndex');

                refreshAnimationGoal($wizard, index);

                $('.moving-tab-goals').css({
                    'transition': 'transform 0s'
                });
            });
        });

        function refreshAnimationGoal($wizard, index) {

            $total = $('#wizardActivity').find('.nav-project li').length;

            $li_width = 100 / $total;

            total_steps = $('#wizardActivity').find('.nav-project li').length;

            move_distance = $('#wizardActivity').width() / total_steps;


            if (parseInt(index) < 0) {
                index = 0;
            }
            index_temp = index;

            vertical_level = 0;

            mobile_device = $(document).width() < 600 && $total > 3;


            if (mobile_device) {
                move_distance = $('#wizardActivity').width() / 2;
                index_temp = index % 2;
                $li_width = 50;
            }

            $('#wizardActivity').find('.nav-project li').css('width', $li_width + '%');

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


            $('#wizardActivity').find('.moving-tab-goals').css('width', step_width);
            $('.moving-tab-goals').css({
                'transform': 'translate3d(' + move_distance + 'px, ' + vertical_level + 'px, 0)',
                'transition': 'all 0.5s cubic-bezier(0.29, 1.42, 0.79, 1)'

            });
        }
    },
}


wizardStrategic = {
    initMaterialWizard: function () {
        // Code for the Validator

        // Wizard Initialization


        $('#strategicWizard').bootstrapWizard({
            'tabClass': 'nav nav-pills',
            'nextSelector': '.btn-next',
            'previousSelector': '.btn-previous',

            onNext: function (tab, navigation, index) {
                if ( $('#formEditDonor #id').val() != "" ) {
                    return true;
                }else{
                    return false;
                }

                // var $valid = $('#strategicWizard form').valid();
                // if (!$valid) {
                //     $validator.focusInvalid();
                //     return false;
                // } else {
                //     return true;
                // }

            },

            onInit: function (tab, navigation, index) {

                //check number of tabs and fill the entire row
                var $total = navigation.find('li').length;
                var $wizard = navigation.closest('#strategicWizard');

                $first_li = navigation.find('li:first-child a').html();
                $moving_div = $('<div class="moving-tab-goals">' + $first_li + '</div>');
                $('#strategicWizard .wizard-navigation').append($moving_div);

                refreshAnimationGoal($wizard, index);

                $('.moving-tab-goals').css('transition', 'transform 0s');
            },

            onTabClick: function (tab, navigation, index) {
                if ($('#formEditDonor  #id').val() != null ||  $('#formEditDonor  #id').val() != "" ) {
                    return true;
                }else{
                    return false;
                }

            }

            ,
            onTabShow: function (tab, navigation, index) {

                var $total = navigation.find('li').length;
                var $current = index + 1;

                var $wizard = navigation.closest('#strategicWizard');

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
            wizard = $(this).closest('#strategicWizard');
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
            $('#strategicWizard').each(function () {
                $wizard = $(this);

                index = $('#strategicWizard').bootstrapWizard('currentIndex');

                refreshAnimationGoal($wizard, index);

                $('.moving-tab-goals').css({
                    'transition': 'transform 0s'
                });
            });
        });

        function refreshAnimationGoal($wizard, index) {

            $total = $('#strategicWizard').find('.nav-pills li').length;

            console.log($total)
            $li_width = 100 / $total;

            total_steps = $('#strategicWizard').find('.nav-pills li').length;

            move_distance = $('#strategicWizard').width() / total_steps;


            if (parseInt(index) < 0) {
                index = 0;
            }
            index_temp = index;

            vertical_level = 0;

            mobile_device = $(document).width() < 600 && $total > 3;


            if (mobile_device) {
                move_distance = $('#strategicWizard').width() / 2;
                index_temp = index % 2;
                $li_width = 50;
            }

            $('#strategicWizard').find('.nav-pills li').css('width', $li_width + '%');

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
            $('#strategicWizard').find('.moving-tab-goals').css('width', step_width);
            $('.moving-tab-goals').css({
                'transform': 'translate3d(' + move_distance + 'px, ' + vertical_level + 'px, 0)',
                'transition': 'all 0.5s cubic-bezier(0.29, 1.42, 0.79, 1)'
            });
        }
    },
}



