import Noty from 'noty';

function Notify(message, type, position, container, confirm, method) {
    type=(message.error||message.isAxiosError)?'error':((message.data?message.data.status:type)||'success');
    message=message.response?message.response.data : (message.data||message);
    message=message.success || message.error|| message.errors || message.message || message ;
    if(Array.isArray(message)){
        Array.from(message).forEach(element => {
            message=(element.message || element)+'<br/>';
        });
    }else if((typeof message == 'object') && Array.isArray(Object.keys(message))){
        Object.keys(message).forEach((key)=>{
            message.message=(message.message||'')+'<div><h5>'+key+'</h5><p>'+message[key].join('<br/>')+'</p></div>';
        })
    }
    message=message.message || message;

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
    if(message){
        new Noty({
            text: message,
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
}

function BuildFormControls(control, value){
    if (control.type){
        value = ((value == undefined || value == null) ? (control.default ? control.default:''):value);
        switch (control.type){
            case 'select':
                var options='';
                (control.options||[]).forEach((elm)=>{
                    options += '<option value="' + elm + '" ' + (elm == value ? 'selected=selected default' : '')+'>'+elm+'</option>';
                });
                return '<select class=""form-control form-select"" name="' + control.name + '">' + options +'</select >';
            case 'radio':
                var options = '';
                (control.options||[]).forEach((elm)=>{
                    options +=`
                        <div class="form-check-inline me-2">
                            <input value="${elm}" class="form-check-input form-control" ${(elm.trim() == value ? 'checked' : '')} type="radio" name="${control.name}">
                            <label class="form-check-label">
                                ${elm}
                            </label>
                        </div>
                    `;
                });
                return options;
            case 'switch':
                return `
                        <div class="form-check-inline form-switch me-2">
                            <input class="form-check-input form-control" type="checkbox" toggle ${((control.options||'false') == 'false' ? '' : 'checked')} name="${control.name}" >
                        </div>
                    `;
            case 'checkbox':
                var options = '';
                (control.options||[]).forEach((elm)=>{
                    options +=`
                        <div class="form-check-inline me-2">
                            <input class="form-check-input form-control" ${(elm == value ? 'checked' : '')} type="checkbox" value="${elm}" name="${control.name}">
                            <label class="form-check-label">${elm}</label>
                        </div>
                    `;
                });
                return options;
            default:
                return `
                    <div class="prepend-icon">
                        <input class="form-control form-white" type = "${control.type}" name = "${control.name}" value = "${(control.value||value||"")}" >
                        <i class="fa fa-indent"></i>
                    </div>
                `;
        }
    }
    return '';
} 

function serialize(root,defaultVal=false){
    var data = {};
    root.querySelectorAll('.form-control:not([type="radio"]):not([type="checkbox"])').forEach((elm)=>{
        data[elm['name']] = elm['value'];
    });
    root.querySelectorAll('.form-control[type="radio"]:checked').forEach((elm)=>{
        data[elm['name']] = elm['value'];
    });
    root.querySelectorAll('.form-control[type="checkbox"]:checked').forEach((elm)=>{
        (data[elm['name']]=(Array.isArray(data[elm['name']]) === true)?data[elm['name']]:[]).push(elm['value']);
    });
    root.querySelectorAll('.form-control[type="checkbox"]:not(:checked)').forEach((elm)=>{
        if (!(elm.getAttribute('name') in data)) {
            data[elm.getAttribute('name')] = defaultVal;
        }
    });
    return data;
}

export default {
    Notify:Notify,
    BuildFormControls:BuildFormControls,
    serialize
}