var crudModal;
window.ready(()=>{
    document.getElementById('control_CRUD').addEventListener('hidden.bs.modal',clearWorkingArea);
    crudModal = new bootstrap.Modal(document.getElementById('control_CRUD'));
    document.querySelectorAll('button.outlet_CRUD').forEach((elm)=>{
        elm.addEventListener('click',(e)=>{
            if (this.getAttribute('outlet-target').length > 0) {
                showCRUD(this.getAttribute('outlet-target'));
            }
        })
    });
});

function hideCRUD(callback) {
    crudModal.hide();
    if (typeof (callback) == 'function') {
        callback();
    }
}

function clearWorkingArea() {
    document.getElementById('control_CRUD').querySelectorAll('.LF_CRUD').forEach((elm)=>{
        elm.classList.remove('show');
    });
    document.querySelectorAll('#control_CRUD input:not([type="radio"],[type="checkbox"]), #control_CRUD textarea, #control_CRUD select').forEach((elm)=>{
        elm.value="";
        elm.classList.remove('checked');
    });
    document.querySelectorAll('#control_CRUD input[type="radio"],#control_CRUD input[type="checkbox"]').forEach((elm)=>{
        elm.classList.remove('checked');
    });
}

function showCRUD(tar, preload = false) {
    document.querySelectorAll('#control_CRUD .'+tar).forEach((elm)=>{
        elm.classList.add('show');
    })
    if (preload) {
        document.querySelector('#control_CRUD .loading').classList.add('show');
    } else {
        document.querySelector('#control_CRUD .loading').classList.remove('show');
    }
    crudModal.show();
}

function buildData(tar, callback) {
    var data = {};
    tar.querySelectorAll('.form-control').forEach((elm)=>{
        data[elm['name']] = elm['value'];
    });
    if (typeof (callback) === 'function') {
        callback(data);
    }
    return data;
}

export default {
    showCRUD,
    hideCRUD,
    clearWorkingArea,
    buildData
}