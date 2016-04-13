/* 
 Author: Jason B. Smith
 Date: 2/17/16
 Managed Solution
 */
$(document).click(function (e) {
    if($(e.target).is('nav')){
            e.preventDefault();
            return;
        }
    show('page', false);
    show('loading', true);

});

$(window).load(function () {
    show('page', true);
    show('loading', false);
})
//Password check
function validate() {
    var password1 = $("#password").val();
    var password2 = $("#confirmPass").val();
    var pass = document.getElementById("password");
    var re = new RegExp(/^(?=.*[A-Za-z])(?=.*\d)(?=.*[$@$!%*#?&])[A-Za-z\d$@$!%*#?&]{8,}$/);
    var regNum = new RegExp(/[\d]{1}/);
    var regUpper = new RegExp(/[A-Z]{1}/);
    var regLower = new RegExp(/[a-z]{1}/);
    var regSpecial = new RegExp(/[$&+,*!#%^():;=?@#|]/);

    if (password1.length < 8 && !password1.match(regNum) && !password1.match(regUpper) && !password1.match(regSpecial)) {
        pass.setCustomValidity("Your password must have 8 characters, 1 upper case, 1 lowercase, 1 number, and 1 special character!");
        return;
    } else if (!password1.match(regNum)) {
        pass.setCustomValidity("You must have at least 1 number!");
        return;
    } else if (!password1.match(regUpper)) {
        pass.setCustomValidity("You must have at least 1 upper case letter!");
        return;
    } else if (!password1.match(regLower)) {
        pass.setCustomValidity("You must have at least one lower case letter!")
    } else if (!password1.match(regSpecial)) {
        pass.setCustomValidity("You must have at least one special character!")
    } else {
        pass.setCustomValidity("");
    }
}
//checks to make sure passes match on registration
function passMatch() {
    var password1 = $("#password").val();
    var password2 = $("#confirmPass").val();
    var pass = document.getElementById("confirmPass");

    if (password1 != password2) {
        pass.setCustomValidity("Passwords do not match!");
    } else {
        pass.setCustomValidity("");
    }
}
//puts focus on the first invalid field
function focus() {
    var firstInvalid = document.getForm().items.find(function (f) {
        return !f.isValid();
    });
    if (firstInvalid) {
        firstInvalid.focus();
    }
}
//validates zip code for the united states: TODO NEED TO FIND VALIDATION FOR OTHER COUNTRIES!
function validateZip() {
    var regUs = new RegExp(/^[0-9]{5}(-[0-9]{4})?$/);
    var loc = $("#country").val();
    var zipStr = $("#zip").val();

    var zip = document.getElementById("zip");

    if (loc == "United States of America")
    {
        if (!zipStr.match(regUs)) {
            zip.setCustomValidity("Invalid Zip Code");
        } else {
            zip.setCustomValidity("");
        }
    } else {
        zip.setCustomValidity("");
    }
}
function validateFname() {
    var text = document.getElementById("billing-address-first-name");
    var reg = /^[a-zA-Z._-\s{1}\u00C6\u00D0\u018E\u018F\u0190\u0194\u0132\u014A\u0152\u1E9E\u00DE\u01F7\u021C\u00E6\u00F0\u01DD\u0259\u025B\u0263\u0133\u014B\u0153\u0138\u017F\u00DF\u00FE\u01BF\u021D\u0104\u0181\u00C7\u0110\u018A\u0118\u0126\u012E\u0198\u0141\u00D8\u01A0\u015E\u0218\u0162\u021A\u0166\u0172\u01AFY\u0328\u01B3\u0105\u0253\u00E7\u0111\u0257\u0119\u0127\u012F\u0199\u0142\u00F8\u01A1\u015F\u0219\u0163\u021B\u0167\u0173\u01B0y\u0328\u01B4\u00C1\u00C0\u00C2\u00C4\u01CD\u0102\u0100\u00C3\u00C5\u01FA\u0104\u00C6\u01FC\u01E2\u0181\u0106\u010A\u0108\u010C\u00C7\u010E\u1E0C\u0110\u018A\u00D0\u00C9\u00C8\u0116\u00CA\u00CB\u011A\u0114\u0112\u0118\u1EB8\u018E\u018F\u0190\u0120\u011C\u01E6\u011E\u0122\u0194\u00E1\u00E0\u00E2\u00E4\u01CE\u0103\u0101\u00E3\u00E5\u01FB\u0105\u00E6\u01FD\u01E3\u0253\u0107\u010B\u0109\u010D\u00E7\u010F\u1E0D\u0111\u0257\u00F0\u00E9\u00E8\u0117\u00EA\u00EB\u011B\u0115\u0113\u0119\u1EB9\u01DD\u0259\u025B\u0121\u011D\u01E7\u011F\u0123\u0263\u0124\u1E24\u0126I\u00CD\u00CC\u0130\u00CE\u00CF\u01CF\u012C\u012A\u0128\u012E\u1ECA\u0132\u0134\u0136\u0198\u0139\u013B\u0141\u013D\u013F\u02BCN\u0143N\u0308\u0147\u00D1\u0145\u014A\u00D3\u00D2\u00D4\u00D6\u01D1\u014E\u014C\u00D5\u0150\u1ECC\u00D8\u01FE\u01A0\u0152\u0125\u1E25\u0127\u0131\u00ED\u00ECi\u00EE\u00EF\u01D0\u012D\u012B\u0129\u012F\u1ECB\u0133\u0135\u0137\u0199\u0138\u013A\u013C\u0142\u013E\u0140\u0149\u0144n\u0308\u0148\u00F1\u0146\u014B\u00F3\u00F2\u00F4\u00F6\u01D2\u014F\u014D\u00F5\u0151\u1ECD\u00F8\u01FF\u01A1\u0153\u0154\u0158\u0156\u015A\u015C\u0160\u015E\u0218\u1E62\u1E9E\u0164\u0162\u1E6C\u0166\u00DE\u00DA\u00D9\u00DB\u00DC\u01D3\u016C\u016A\u0168\u0170\u016E\u0172\u1EE4\u01AF\u1E82\u1E80\u0174\u1E84\u01F7\u00DD\u1EF2\u0176\u0178\u0232\u1EF8\u01B3\u0179\u017B\u017D\u1E92\u0155\u0159\u0157\u017F\u015B\u015D\u0161\u015F\u0219\u1E63\u00DF\u0165\u0163\u1E6D\u0167\u00FE\u00FA\u00F9\u00FB\u00FC\u01D4\u016D\u016B\u0169\u0171\u016F\u0173\u1EE5\u01B0\u1E83\u1E81\u0175\u1E85\u01BF\u00FD\u1EF3\u0177\u00FF\u0233\u1EF9\u01B4\u017A\u017C\u017E\u1E93]+$/;
    var x = $("#billing-address-first-name").val();

    if (!x.match(reg)) {
        text.setCustomValidity("Invalid Name");
    } else {
        text.setCustomValidity("");
    }
    return reg.test(fname);
}
function validateLname() {
    var text = document.getElementById("billing-address-last-name");
    var reg = /^[a-zA-Z._-\s{1}\u00C6\u00D0\u018E\u018F\u0190\u0194\u0132\u014A\u0152\u1E9E\u00DE\u01F7\u021C\u00E6\u00F0\u01DD\u0259\u025B\u0263\u0133\u014B\u0153\u0138\u017F\u00DF\u00FE\u01BF\u021D\u0104\u0181\u00C7\u0110\u018A\u0118\u0126\u012E\u0198\u0141\u00D8\u01A0\u015E\u0218\u0162\u021A\u0166\u0172\u01AFY\u0328\u01B3\u0105\u0253\u00E7\u0111\u0257\u0119\u0127\u012F\u0199\u0142\u00F8\u01A1\u015F\u0219\u0163\u021B\u0167\u0173\u01B0y\u0328\u01B4\u00C1\u00C0\u00C2\u00C4\u01CD\u0102\u0100\u00C3\u00C5\u01FA\u0104\u00C6\u01FC\u01E2\u0181\u0106\u010A\u0108\u010C\u00C7\u010E\u1E0C\u0110\u018A\u00D0\u00C9\u00C8\u0116\u00CA\u00CB\u011A\u0114\u0112\u0118\u1EB8\u018E\u018F\u0190\u0120\u011C\u01E6\u011E\u0122\u0194\u00E1\u00E0\u00E2\u00E4\u01CE\u0103\u0101\u00E3\u00E5\u01FB\u0105\u00E6\u01FD\u01E3\u0253\u0107\u010B\u0109\u010D\u00E7\u010F\u1E0D\u0111\u0257\u00F0\u00E9\u00E8\u0117\u00EA\u00EB\u011B\u0115\u0113\u0119\u1EB9\u01DD\u0259\u025B\u0121\u011D\u01E7\u011F\u0123\u0263\u0124\u1E24\u0126I\u00CD\u00CC\u0130\u00CE\u00CF\u01CF\u012C\u012A\u0128\u012E\u1ECA\u0132\u0134\u0136\u0198\u0139\u013B\u0141\u013D\u013F\u02BCN\u0143N\u0308\u0147\u00D1\u0145\u014A\u00D3\u00D2\u00D4\u00D6\u01D1\u014E\u014C\u00D5\u0150\u1ECC\u00D8\u01FE\u01A0\u0152\u0125\u1E25\u0127\u0131\u00ED\u00ECi\u00EE\u00EF\u01D0\u012D\u012B\u0129\u012F\u1ECB\u0133\u0135\u0137\u0199\u0138\u013A\u013C\u0142\u013E\u0140\u0149\u0144n\u0308\u0148\u00F1\u0146\u014B\u00F3\u00F2\u00F4\u00F6\u01D2\u014F\u014D\u00F5\u0151\u1ECD\u00F8\u01FF\u01A1\u0153\u0154\u0158\u0156\u015A\u015C\u0160\u015E\u0218\u1E62\u1E9E\u0164\u0162\u1E6C\u0166\u00DE\u00DA\u00D9\u00DB\u00DC\u01D3\u016C\u016A\u0168\u0170\u016E\u0172\u1EE4\u01AF\u1E82\u1E80\u0174\u1E84\u01F7\u00DD\u1EF2\u0176\u0178\u0232\u1EF8\u01B3\u0179\u017B\u017D\u1E92\u0155\u0159\u0157\u017F\u015B\u015D\u0161\u015F\u0219\u1E63\u00DF\u0165\u0163\u1E6D\u0167\u00FE\u00FA\u00F9\u00FB\u00FC\u01D4\u016D\u016B\u0169\u0171\u016F\u0173\u1EE5\u01B0\u1E83\u1E81\u0175\u1E85\u01BF\u00FD\u1EF3\u0177\u00FF\u0233\u1EF9\u01B4\u017A\u017C\u017E\u1E93]+$/;
    var x = $("#billing-address-last-name").val();

    if (!x.match(reg)) {
        text.setCustomValidity("Invalid Name");
    } else {
        text.setCustomValidity("");
    }
    return reg.test(fname);
}
function validateEmail() {
    var text = document.getElementById("billing-address-email");
    var reg = /^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i;
    var x = $("#billing-address-email").val();

    if (!x.match(reg)) {
        text.setCustomValidity("Invalid Email");
    } else {
        text.setCustomValidity("");
    }
}
function validatePhone() {
    var text = document.getElementById("billing-address-phone");
    var reg = /(?:(?:\+?1\s*(?:[.-]\s*)?)?(?:(\s*([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9]‌​)\s*)|([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9]))\s*(?:[.-]\s*)?)([2-9]1[02-9]‌​|[2-9][02-9]1|[2-9][02-9]{2})\s*(?:[.-]\s*)?([0-9]{4})/;
    var x = $("#billing-address-phone").val();
    if (!x.match(reg)) {
        text.setCustomValidity("Invalid Phone\nEX: 555-555-5555");
    } else {
        text.setCustomValidity("");
    }
}
function validateCardNumber() {
    var text = document.getElementById("billing-cc-number");
    var x = $("#billing-cc-number").val();
    var visa = /(?:4[0-9]{12}(?:[0-9]{3})?)$/;
    var amex = /(?:3[47][0-9]{13})$/;
    var master = /^(?:5[1-5][0-9]{14})$/;
    var discover = /^(?:6(?:011|5[0-9][0-9])[0-9]{12})$/;
    var dinersClub = /^(?:3(?:0[0-5]|[68][0-9])[0-9]{11})$/;

    if (x.match(visa) || x.match(amex) || x.match(master) || x.match(discover) || x.match(dinersClub))
    {
        text.setCustomValidity("");
        return true;
    } else
    {
        text.setCustomValidity("Not a valid Visa, American Express, Mastercard, Discover, or Diners Club  credit card number!");
        return false;
    }
}
function validateCardDate() {
    var text = document.getElementById("billing-cc-exp");
    var x = $("#billing-cc-exp").val();
    var date_array = x.split('/');
    var month = date_array[0] - 1;
    var year = date_array[1];

    source_date = new Date();
    source_date.getFullYear();

    if (year >= source_date.getFullYear()) {
        if (month >= source_date.getMonth()) {
            text.setCustomValidity("");
        } else {
            text.setCustomValidity("Not a valid Expiration Date! \nEX:MM/YYYY");
        }
    } else {
        text.setCustomValidity("Not a valid Expiration Date!");
    }
}


//redirects to php controller remove-from-cart.php to remove selected Item from cart
$(document).ready(function () {
    $(".removeCart").click(function () {
        var $row = $(this).closest("tr");    // Find the row
        var $text = $row.find(".nr").text(); // Find the text

        // Let's test it out
        alert($text);
    });
});