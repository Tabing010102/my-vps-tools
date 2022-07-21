function test()
		{
			var x=document.getElementById("inpTelnum").value;
			if(x==""){
				alert("请输入电话号码");
			}
			else if(isNaN(x)){
				alert("请输入正确的电话号码");
			}	
			var pwda=document.getElementById("inpPwd").value;
			var pwdb=document.getElementById("reinpPwd").value;
			if(pwda!=pwdb){alert("两次密码输入不同！");}

		}
function sbtToSer()
		{
			
		}
function work(){
			var t2=test();
			if(!t2)sbtToSer();
		}
function Fun(){
	var tmp=new Date().getSeconds()%5;
	var sens=["澳门皇家赌场","拉斯维加斯皇家赌场","信息中心m家赌场","在线发牌","离线发牌"];
	alert(sens[tmp]);
}