function entities(s) {
    s = s || "";
    str = s.toString();
    var buf = [];
    for (var i=str.length-1;i>=0;i--) {
        buf.unshift(['&#', str[i].charCodeAt(), ';'].join(''));
    }
    return buf.join('');
}

// validate data
function regex(text, datatype){
    datatype = datatype || "";
    switch(datatype){
        case "email":
            var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(text.toLowerCase());
        case "text":
            var re = /^[\w\d!#$%&*+,.:;=?@\[\] ^_{|}~-]*$/i;
            return re.test(text);
        case "class":
            var re = /^at\d{2}[a-zA-Z]$/i;
            return re.test(text.toLowerCase());
        case "username":
            var len = text.length;
            // return (regex(text, "text") and (len >= 3));
            return regex(text, "text") && (len > 2) && (len < 26);
        case "":
            return false;
    }
}
