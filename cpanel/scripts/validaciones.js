function autofitIframe(id){
    if(document.getElementById)
    {
        parent.document.getElementById(id).style.height=this.document.body.scrollHeight+"px";
    }
    else{
        parent.document.getElementById(id).style.height=this.document.body.offsetHeight+"px";
    }
}

var defaultEmptyOK = false
var checkNiceness = true;
var digits = "0123456789";
var lowercaseLetters = "abcdefghijklmnopqrstuvwxyz������� "
var uppercaseLetters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ������ "
var whitespace = " \t\n\r";
var phoneChars = "()-+ ";
var mMessage = "Error: no puede dejar este espacio vacio"
var pPrompt = "Error: ";
var pAlphanumeric = "ingrese un texto que contenga solo letras y/o numeros";
var pAlphabetic   = "ingrese un texto que contenga solo letras";
var pInteger = "ingrese un numero entero";
var pNumber = "ingrese un numero";
var pPhoneNumber = "ingrese un n�mero de tel�fono";
var pEmail = "ingrese una direcci�n de correo electr�nico v�lida";
var pName = "ingrese un texto que contenga solo letras, numeros o espacios";
var pNice = "no puede utilizar comillas aqui";

function makeArray(n) {
    for (var i = 1; i <= n; i++) {
        this[i] = 0
    }
    return this
}

function isEmpty(s)
{
    return ((s == null) || (s.length == 0))
}

function isWhitespace (s)
{
    var i;
    if (isEmpty(s)) return true;
    for (i = 0; i < s.length; i++)
    {   
        var c = s.charAt(i);
        // si el caracter en que estoy no aparece en whitespace,
        // entonces retornar falso
        if (whitespace.indexOf(c) == -1) return false;
    }
    return true;
}


function stripCharsInBag (s, bag)
{
    var i;
    var returnString = "";

    // Buscar por el string, si el caracter no esta en "bag", 
    // agregarlo a returnString
    
    for (i = 0; i < s.length; i++)
    {
        var c = s.charAt(i);
        if (bag.indexOf(c) == -1) returnString += c;
    }

    return returnString;
}


function stripCharsNotInBag (s, bag)
{
    var i;
    var returnString = "";
    for (i = 0; i < s.length; i++)
    {   
        var c = s.charAt(i);
        if (bag.indexOf(c) != -1) returnString += c;
    }

    return returnString;
}


function stripWhitespace (s)
{
    return stripCharsInBag (s, whitespace)
}

function charInString (c, s)
{
    for (i = 0; i < s.length; i++)

    {
        if (s.charAt(i) == c) return true;
    }
    return false
}

function stripInitialWhitespace (s)
{
    var i = 0;
    while ((i < s.length) && charInString (s.charAt(i), whitespace))
        i++;
    return s.substring (i, s.length);
}

function isLetter (c)
{
    return( ( uppercaseLetters.indexOf( c ) != -1 ) ||
        ( lowercaseLetters.indexOf( c ) != -1 ) )
}

function isDigit (c)
{
    return ((c >= "0") && (c <= "9"))
}

function isLetterOrDigit (c)
{
    return (isLetter(c) || isDigit(c))
}

function isInteger (s)
{
    var i;
    if (isEmpty(s)) 
        if (isInteger.arguments.length == 1) return defaultEmptyOK;
        else return (isInteger.arguments[1] == true);
    
    for (i = 0; i < s.length; i++)
    {   
        var c = s.charAt(i);
        if( i != 0 ) {
            if (!isDigit(c)) return false;
        } else { 
            if (!isDigit(c) && (c != "-") || (c == "+")) return false;
        }
    }
    return true;
}


function isNumber (s)
{
    var i;
    var dotAppeared;
    dotAppeared = false;
    if (isEmpty(s))
        if (isNumber.arguments.length == 1) return defaultEmptyOK;
        else return (isNumber.arguments[1] == true);

    for (i = 0; i < s.length; i++)
    {
        var c = s.charAt(i);
        if( i != 0 ) {
            if ( c == "." ) {
                if( !dotAppeared )
                    dotAppeared = true;
                else
                    return false;
            } else
            if (!isDigit(c)) return false;
        } else {
            if ( c == "." ) {
                if( !dotAppeared )
                    dotAppeared = true;
                else
                    return false;
            } else
            if (!isDigit(c) && (c != "-") || (c == "+")) return false;
        }
    }
    return true;
}
function isDecimal (s)
{
    sepdecimal=",";
    sepmiles=".";
    num=s.split(sepdecimal);
    entero=num[0];
    decimal=(num[1]?num[1]:0);
    if(!isNumber(entero.split(sepmiles).join("")))
        return false;
    else{
        cont=1;
        i=parseInt(entero.length)-1;
        while(i>=0){
            digit=entero.charAt(i);
            if(cont<=3 && !isDigit(digit))
                return false;
            
            if(cont==4 && digit!=sepmiles)
                return false;
            if(cont==4)
                cont=0;
            
            cont++;
            i--;
        }
    }
    return true;
}

function isAlphabetic (s)
{
    var i;

    if (isEmpty(s)) 
        if (isAlphabetic.arguments.length == 1) return defaultEmptyOK;
        else return (isAlphabetic.arguments[1] == true);
    for (i = 0; i < s.length; i++)
    {   
        // Check that current character is letter.
        var c = s.charAt(i);

        if (!isLetter(c))
            return false;
    }
    return true;
}

function isAlphanumeric (s)
{
    var i;

    if (isEmpty(s)) 
        if (isAlphanumeric.arguments.length == 1) return defaultEmptyOK;
        else return (isAlphanumeric.arguments[1] == true);

    for (i = 0; i < s.length; i++)
    {   
        var c = s.charAt(i);
        if (! (isLetter(c) || isDigit(c) ) )
            return false;
    }

    return true;
}


function isNamex (s)
{
    if (isEmpty(s)) 
        if (isNamex.arguments.length == 1) return defaultEmptyOK;
        else return (isAlphanumeric.arguments[1] == true);
    
    return( isAlphanumeric( stripCharsInBag( s, whitespace ) ) );
}

function isPhoneNumber (s)
{
    var modString;
    if (isEmpty(s)) 
        if (isPhoneNumber.arguments.length == 1) return defaultEmptyOK;
        else return (isPhoneNumber.arguments[1] == true);
    modString = stripCharsInBag( s, phoneChars );
    return (isInteger(modString))
}

function isEmail (s)
{
    if (isEmpty(s)) 
        if (isEmail.arguments.length == 1) return defaultEmptyOK;
        else return (isEmail.arguments[1] == true);
    if (isWhitespace(s)) return false;
    var i = 1;
    var sLength = s.length;
    while ((i < sLength) && (s.charAt(i) != "@"))
    {
        i++
    }

    if ((i >= sLength) || (s.charAt(i) != "@")) return false;
    else i += 2;

    while ((i < sLength) && (s.charAt(i) != "."))
    {
        i++
    }

    if ((i >= sLength - 1) || (s.charAt(i) != ".")) return false;
    else return true;
}

function sonEmail (s)
{
    var co;
    var sLength;
    var cadena = s.replace(/;/g, ",");
    var correos = cadena.split(",");
    for(a=0;a<correos.length;a++)
    {

        i = 1;
        co=correos[a];
        sLength = co.length;
	
        while ((i < sLength) && (co.charAt(i) != "@"))
        {
            i++
        }
	
        if ((i >= sLength) || (co.charAt(i) != "@")) return false;
        else i += 2;
	
        while ((i < sLength) && (co.charAt(i) != "."))
        {
            i++
        }
	
        if ((i >= sLength - 1) || (co.charAt(i) != ".")) return false;
		
    }
    return true;
}





function isNice(s)
{
    var i = 1;
    var sLength = s.length;
    var b = 1;
    while(i<sLength) {
        if( (s.charAt(i) == "\"") || (s.charAt(i) == "'" ) ) b = 0;
        i++;
    }
    return b;
}

function statBar (s)
{
    window.status = s
}

function warnEmpty (theField)
{
    theField.focus()
    alert(mMessage)
    statBar(mMessage)
    return false
}

function warnInvalid (theField, s)
{
    theField.focus()
    theField.select()
    alert(s)
    statBar(pPrompt + s)
    return false
}


function checkField (theField, theFunction, emptyOK, s)
{   
    var msg;
    if (checkField.arguments.length < 3) emptyOK = defaultEmptyOK;
    if (checkField.arguments.length == 4) {
        msg = s;
    } else {
        if( theFunction == isAlphabetic ) msg = pAlphabetic;
        if( theFunction == isAlphanumeric ) msg = pAlphanumeric;
        if( theFunction == isInteger ) msg = pInteger;
        if( theFunction == isNumber ) msg = pNumber;
        if( theFunction == isEmail ) msg = pEmail;
        if( theFunction == isPhoneNumber ) msg = pPhoneNumber;
        if( theFunction == isName ) msg = pName;
    }
    
    if ((emptyOK == true) && (isEmpty(theField.value))) return true;

    if ((emptyOK == false) && (isEmpty(theField.value))) 
        return warnEmpty(theField);

    if ( checkNiceness && !isNice(theField.value))
        return warnInvalid(theField, pNice);

    if (theFunction(theField.value) == true) 
        return true;
    else
        return warnInvalid(theField,msg);

}
function esDigito(sChr){
    var sCod = sChr.charCodeAt(0);
    return ((sCod > 47) && (sCod < 58));
}

function valSep(oTxt){
    var bOk = false;
    var sep1 = oTxt.charAt(2);
    var sep2 = oTxt.charAt(5);
    bOk = bOk || ((sep1 == "-") && (sep2 == "-"));
    bOk = bOk || ((sep1 == "/") && (sep2 == "/"));
    return bOk;
}

function finMes(oTxt){
    var nMes = parseInt(oTxt.substr(3, 2), 10);
    var nAno = parseInt(oTxt.substr(6), 10);
    var nRes = 0;
    switch (nMes){
        case 1:
            nRes = 31;
            break;
        case 2:
            nRes = 28;
            break;
        case 3:
            nRes = 31;
            break;
        case 4:
            nRes = 30;
            break;
        case 5:
            nRes = 31;
            break;
        case 6:
            nRes = 30;
            break;
        case 7:
            nRes = 31;
            break;
        case 8:
            nRes = 31;
            break;
        case 9:
            nRes = 30;
            break;
        case 10:
            nRes = 31;
            break;
        case 11:
            nRes = 30;
            break;
        case 12:
            nRes = 31;
            break;
    }
    return nRes + (((nMes == 2) && (nAno % 4) == 0)? 1: 0);
}

function valDia(oTxt){
    var bOk = false;
    var nDia = parseInt(oTxt.substr(0, 2), 10);
    bOk = bOk || ((nDia >= 1) && (nDia <= finMes(oTxt)));
    return bOk;
}

function valMes(oTxt){
    var bOk = false;
    var nMes = parseInt(oTxt.substr(3, 2), 10);
    bOk = bOk || ((nMes >= 1) && (nMes <= 12));
    return bOk;
}

function valAno(oTxt){
    var bOk = true;
    var nAno = oTxt.substr(6);
    bOk = bOk && ((nAno.length == 2) || (nAno.length == 4));
    if (bOk){
        for (var i = 0; i < nAno.length; i++){
            bOk = bOk && esDigito(nAno.charAt(i));
        }
    }
    return bOk;
}
