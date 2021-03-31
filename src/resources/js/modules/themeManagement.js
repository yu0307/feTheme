import axios from "axios";
import anime from 'animejs';

window.ready(()=>{

    document.querySelector('#Theme_Management .btn_themesave').addEventListener('click',()=>{
        var setting = {
            ThemeSelected: document.getElementById('fe_themeSelector').value,
            themeSetting: {}
        };
        var target = document.getElementById('FeThemeSettings');
        setting.themeSetting=window.frameUtil.serialize(target);
        axios.post(target.getAttribute('datatarget'),setting)
        .then((resp)=>{
            window.frameUtil.Notify(resp);
        })
        .catch((e)=>{
            window.frameUtil.Notify(e, 'error');
        });
    });

    document.getElementById('fe_themeSelector').addEventListener('change',function(){
        if(!_.isNull(this.value)){
            axios.get(document.getElementById('FeThemeManagement').getAttribute('datatarget')+ '/load/'+this.value)
            .then((resp)=>{
                if(resp.data.status=='success'){
                    resp=resp.data;
                    anime({
                        targets:'#FeThemeSettings',
                        opacity:0,
                        duration: 300,
                        easing:'linear',
                        complete: function() {
                            document.getElementById('FeThemeSettings').querySelector('.panel-content').innerHTML=renderThemeSettings(resp.settingList, resp.siteDefaults);
                            anime({
                                targets:'#FeThemeSettings',
                                opacity:1,
                                duration: 300,
                                easing:'linear'
                            });
                        }.bind(resp)
                    });
                }else{
                    window.frameUtil.Notify(resp, 'error');
                }
            })
            .catch((error)=>{
                window.frameUtil.Notify(error, 'error');
            });
        }
    });
});

function renderThemeSettings(settingList, defaults, heading) {
    heading = heading ? heading : 3;
    var html = '';
    settingList.forEach((key, settings) => {
        heading = (heading > 5) ? 5 : heading;
        if (settings.type) {
            html +=`
                <div class="ThemeSettings col-md-4 col-sm-12">
                    <div class="ThemeSettingHeading" >
                        <h6>${key}</h6>
                    </div>
                    ${window.frameUtil.BuildFormControls(settings, defaults[settings.name])}
                </div>
            `;
        } else {
            html +=`
                <div class="form-row row">
                    <h${heading}>
                        <strong>${key}</strong>
                    </h${heading}>
                    ${renderThemeSettings(settings, defaults, heading + 1)}
                </div>
            `;
        }
    });
    return html;
}