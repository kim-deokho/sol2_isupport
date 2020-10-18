function alertBox(txt, callbackMethod, jsonData){
    modal({
        type: 'alert',
        title: '알림',
        text: txt,
        callback: function(result){
            if(callbackMethod){
                callbackMethod(jsonData);
            }
        }
    });
}
 
function alertBoxFocus(txt, obj){
    modal({
        type: 'alert',
        title: '알림',
        text: txt,
        callback: function(result){
            obj.focus();
        }
    });
}
 
    
function confirmBox(txt, callbackMethod, jsonData){
    modal({
        type: 'confirm',
        title: '알림',
        text: txt,
        callback: function(result) {
            if(result){
                callbackMethod(jsonData);
            }
        }
    });
}
 
function promptBox(txt, callbackMethod, jsonData){
    modal({
        type: 'prompt',
        title: 'Prompt',
        text: txt,
        callback: function(result) {
            if(result){
                callbackMethod(jsonData);
            }
        }
    });
}
 
function successBox(txt){
    modal({
        type: 'success',
        title: 'Success',
        text: txt
    });
}
 
function warningBox(txt){
    modal({
        type: 'warning',
        title: 'Warning',
        text: txt,
        center: false
    });
}
 
function infoBox(txt){
    modal({
        type: 'info',
        title: 'Info',
        text: txt,
        autoclose: true
    });
}
 
function errorBox(txt){
    modal({
        type: 'error',
        title: 'Error',
        text: txt
    });
}
 
function invertedBox(txt){
    modal({
        type: 'inverted',
        title: 'Inverted',
        text: txt
    });
}
 
function primaryBox(txt){
    modal({
        type: 'primary',
        title: 'Primary',
        text: txt
    });
}