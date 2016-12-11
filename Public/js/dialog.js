var dialog = {
	error:function (messsage){
		layer.open({
			content:messsage,
			icon:2,
			title:"error",
		});
	},
	success:function (messsage,url){
		layer.open({
			content:messsage,
			icon:1,
			yes:function(){
				location.href=url;
			},
		});
	},

	confirm:function(messsage,url){
		layer.open({
			content:messsage,
			icon:3,
			btn:['yes','no'],
			yes:function(){
				location.href=url;
			},
		});
	},

	toconfirm:function(messsage){
		layer:open({
			content:messsage,
			icon:3,
			btn:['yes'],
		});
	},
}