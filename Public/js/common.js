
//phone 正则
function phone(Tel){
    var TEL_REGEXP = /^1([38][0-9]|4[579]|5[0-3,5-9]|6[6]|7[0135678]|9[89])\d{8}$/;
    if(TEL_REGEXP.test(Tel)){
        return true;
    }
    return false;
}

//身份证
function cards(cardNo){
    var idcardReg = /^[1-9]\d{7}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}$|^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}([0-9]|X)$/;
    if(idcardReg.test(cardNo)){
        return true;
    }
    return false;
}

//检测特殊字符
function checkstr(str){
    var myReg = /[~!@#$%^&*()/\|,.<>?"'();:_+-=\[\]{}]/;
    if(myReg.test(str)) {
        return true;
    }
    return false;
}
