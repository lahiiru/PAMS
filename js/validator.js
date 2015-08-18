/* 
 * @author: Lahiru
 * @description:
 * JS real time validator plugin for FieldValidator.php
 * If any fields are to be validated using this plugin, follow the steps
 * include validator.js
 * include tags <script> attachValidator(\'#DivIdOfContainerWhichContainsFormElements\'); </script>
 * make your form in following format. vData stores tempral data for validation
 <div id="DivIdOfContainerWhichContainsFormElements">
 <input type="hidden" class="Data" modalid="" errflag="" pendingReq="0"/>
 <div class="form-group">
 <label>title1</label><input type="text">
 </div>
 <div class="form-group">
 <label>title2</label>
 <input>
 </div>
 </div>
 * if you are using modal to show your form, and if updateField() will call when submit button pressed,
 * validateModal
 * function updateField(){
 if(!validateModal('#DivIdOfContainerWhichContainsFormElements','yourModalName')){
 return;
 }
 else{
 //code when successfull. modal will be closed automatically
 }
 *
 * @modofied:
 * 
 */

function attachValidator(id) {
    window.validatorDivID = id;   //sets global variable
    $(id).focusout(showWarnings);
}

function showWarnings() {
    var id = window.validatorDivID;                               //initially set invalid tag
    console.log(id)
    if ($(id+' .vData').length < 1) {
        $(id).append('<input type="hidden" class="vData" modalid="" errflag="" pendingReq="0"/>'); //vdata temporal storage 
    }
    var vDataObj = $(id + ' .vData');
    vDataObj.attr('errflag', 'v');
    vDataObj.attr('pendingreq', $('.form-group', $(id)).length);                   //track sending requests
    console.log('.form-group', $(id)[0]);
    $('.form-group', $(id)[0]).each(function (i, obj) {

        $(obj).attr('id', 'valid_' + id.split('#')[1] + '_' + i);
        $.ajax({
            async: vDataObj.attr('modalid') == '',
            type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url: '../Classes/validateRequestHandler.php', // the url where we want to POST
            data: {title: $($('label', obj)[0]).text(), value: $('input', obj)[0].value, objId: 'valid_' + id.split('#')[1] + '_' + i}, // our data object
            success: function (data, textStatus, jqXHR)
            {
                if (data) {
                    var elementID = data.toString().split(":")[0];
                    var errorText = data.toString().split(":")[1];
                    var image = 'valid';
                    var id = elementID.split('_')[1];
                    var vDataObj = $('#' + id + ' .vData');
                    if (errorText.trim().length > 1) {
                        image = 'invalid';
                        vDataObj.attr('errflag', 'iv');          //set error flag
                    }
                    $('#' + elementID + ' .help-inline').remove();
                    $('#' + elementID).append('<div class="help-inline" style="color: #b94a48;"><img src=../images/' + image + '.png> ' + errorText + '</div>');
                    vDataObj.attr('pendingreq', vDataObj.attr('pendingreq') - 1);      //request completed
                    modalID = vDataObj.attr('modalid');
                    if (vDataObj.attr('pendingreq') == '0' && modalID != '') {
                        if (vDataObj.attr('errflag') == 'v') {
                            $('#' + modalID).modal('hide');
                        }
                        vDataObj.attr('modalid', '');
                    }
                }

            }
        });
    });
}

function validateModal(id, modalID) {   //set modal id if you want to close it if valid
    window.validatorDivID = id;

    var vData = $(id + ' .vData');
    vData.attr('modalid', modalID);
    vData.attr('errflag', 'v');
    showWarnings();
    if (vData.attr('errflag') == 'v') {
        return true;       //no errors
    }
    return false;
}