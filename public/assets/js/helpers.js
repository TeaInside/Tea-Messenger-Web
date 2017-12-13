/**
 * @author Ammar Faizi
 * @license MIT
 */

function strrev(str)
{
    var r = "", i = str.length - 1;
    for (; i >= 0; i--) {
        r += str[i];
    }
    return r;
}

function ord(string)
{
    var str = string + '';
    var code = str.charCodeAt(0);
    if (code >= 0xD800 && code <= 0xDBFF) {
        var hi = code;
        if (str.length === 1) {
            return code;
        }
        var low = str.charCodeAt(1);
        return ((hi - 0xD800) * 0x400) + (low - 0xDC00) + 0x10000;
    }
    if (code >= 0xDC00 && code <= 0xDFFF) {
        return code;
    }
    return code;
}

function chr(codePt)
{
    if (codePt > 0xFFFF) {
        codePt -= 0x10000;
        return String.fromCharCode(0xD800 + (codePt >> 10), 0xDC00 + (codePt & 0x3FF));
    }
    return String.fromCharCode(codePt);
}

function rand(min, max)
{
    var argc = arguments.length;
    if (argc === 0) {
        min = 0;
        max = 2147483647;
    } else if (argc === 1) {
        throw new Error('Warning: rand() expects exactly 2 parameters, 1 given');
    }
    return Math.floor(Math.random() * (max - min + 1)) + min;
}