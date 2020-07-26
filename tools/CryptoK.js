var dictionary =  'abcdefghijklmnopqrstuwxyz1234567890';

module.exports = {
    generateRandomASCII(length=32){
        var result = "";
        for(var i = 0; i< length;i++){
            result += dictionary.charAt(Math.floor(Math.random()*dictionary.length));
        }

        return result;
    }

}