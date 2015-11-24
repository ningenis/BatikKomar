function rupiah(number) {
	if (isNaN(number)) return "";
	var str = new String(number);
	var result = "", len = str.length;
	for(var i = len - 1; i >= 0; i--) {
		if ((i+1)%3 == 0 && i+1 != len) result += ".";
		result += str.charAt(len-1-i);
	}
	return 'Rp ' + result;
}