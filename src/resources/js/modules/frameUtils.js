import Noty from 'noty';

function Notify(content, type, position, container, confirm, method) {
    type = type || 'success';
    position = position || 'topCenter';
    container = container || '';
    confirm = confirm || false;
    method = method || 3000;
    let openAnimation = 'animate__animated animate__bounceIn';
    let closeAnimation = 'animate__animated animate__bounceOut';
    if (position == 'bottom') {
        openAnimation = 'animate__animated animate__fadeInUp';
        closeAnimation = 'animate__animated animate__fadeOutDown';
    }
    else if (position == 'top' || container.length > 1) {
        openAnimation = 'animate__animated animate__fadeIn';
        closeAnimation = 'animate__animated animate__fadeOut';
    }
    new Noty({
        text: content,
        type: type,
        layout: position,
        timeout: method,
        container: container,
        theme: 'bootstrap-v4',
        dismissQueue: true,
        closeWith: ['click'],
        maxVisible: 10,
        progressBar: true,
        animation: {
            open: openAnimation,
            close: closeAnimation,
            easing: 'swing',
            speed: 70
        },
        buttons: confirm ? [
            Noty.button('Ok', 'btn btn-primary', function ($noty) {
                $noty.close();
                confirm = false;
            }, { id: 'button1', 'data-status': 'ok' })
        ] : '',
        callback: {
            onShow: function () {
                if (container == '') {
                    leftNotfication = $('.sidebar').width();
                    if ($('body').hasClass('rtl')) {
                        if (position == 'top' || position == 'bottom') {
                            $('#noty_layout_top').css('margin-right', leftNotfication).css('left', 0);
                            $('#noty_layout_bottom').css('margin-right', leftNotfication).css('left', 0);
                        }
                        if (position == 'topRight' || position == 'centerRight' || position == 'bottomRight') {
                            $('#noty_layout_centerRight').css('right', leftNotfication + 20);
                            $('#noty_layout_topRight').css('right', leftNotfication + 20);
                            $('#noty_layout_bottomRight').css('right', leftNotfication + 20);
                        }
                    }
                    else {
                        if (position == 'top' || position == 'bottom') {
                            $('#noty_layout_top').css('margin-left', leftNotfication).css('right', 0);
                            $('#noty_layout_bottom').css('margin-left', leftNotfication).css('right', 0);
                        }
                        if (position == 'topLeft' || position == 'centerLeft' || position == 'bottomLeft') {
                            $('#noty_layout_centerLeft').css('left', leftNotfication + 20);
                            $('#noty_layout_topLeft').css('left', leftNotfication + 20);
                            $('#noty_layout_bottomLeft').css('left', leftNotfication + 20);
                        }
                    }
                }
            }
        }
    }).show();
}

export default {
    Notify:Notify
}