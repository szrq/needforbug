/* [NeedForBug!] (C)Dianniu From 2010.
   Home应用基础Javascript($)*/

/** 生日设置 */
function showBirthday(){
	var oEl=document.getElementById('userprofile_birthday');
	var sBirthday=oEl.value;

	oEl.length=0;
	oEl.options.add(new Option(D.L('日','Js/Home_Js'),''));
	for(var nI=0;nI<28;nI++){
		oEl.options.add(new Option(nI+1,nI+1));
	}

	if(document.getElementById('userprofile_birthmonth').value!="2"){
		oEl.options.add(new Option(29,29));
		oEl.options.add(new Option(30,30));
		switch(document.getElementById('userprofile_birthmonth').value){
			case "1":
			case "3":
			case "5":
			case "7":
			case "8":
			case "10":
			case "12":{
				oEl.options.add(new Option(31,31));
			}
		}
	}else if(document.getElementById('userprofile_birthyear').value!=""){
		var nBirthyear=document.getElementById('userprofile_birthyear').value;
		if(nBirthyear%400==0 || (nBirthyear%4==0 && nBirthyear%100!=0)){
			oEl.options.add(new Option(29,29));
		}
	}

	oEl.value=sBirthday;
}
