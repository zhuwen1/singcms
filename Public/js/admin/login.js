var login ={
	check:function (){
		//get password and username
		var username = $('input[name="username"]').val();
		var password = $('input[name="password"]').val();
		// console.log(username,password);
		if(!username){
			dialog.error("username could not null");
		}
		if(!password){
			dialog.error("password could not null");
		}
		var url ="index.php?m=admin&c=login&a=check";
		console.log(url)
		var data ={'username':username,'password':password};
		$.post(url,data,function(result){
			if(result.status===0){
				return dialog.error(result.message);
			}
			console.log(result);
			if(result.status===1){
				return dialog.success(result.message,'admin.php')
			}
		},'JSON');
	}
}