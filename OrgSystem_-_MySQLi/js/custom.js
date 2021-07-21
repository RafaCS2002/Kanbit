var cpf = document.querySelector("#cpf");

cpf.addEventListener("blur", function(){
   if(cpf.value) cpf.value = cpf.value.match(/.{1,3}/g).join(".").replace(/\.(?=[^.]*$)/,"-");
});
function mascara(i){
   
   var v = i.value;
   
   if(isNaN(v[v.length-1])){ // impede entrar outro caractere que não seja número
      i.value = v.substring(0, v.length-1);
      return;
   }
   
   i.setAttribute("maxlength", "14");
   if (v.length == 3 || v.length == 7) i.value += ".";
   if (v.length == 11) i.value += "-";

};

function qntPags(x){
	var qntOrigPags = document.getElementById(x).value;
	return qntOrigPags;
};

function decStart(x,y){
	if(x != 0){
		x = x - 10;
	};
	if(y == 'A'){
		y = 0;
	};
	location.replace(window.location.pathname + '?start=' + x +'&busca='+ y);
};
function addStart(x,tp,y){
	tp = tp*10;
	if(x != tp){
		x = x + 10;
	};
	if(y == 'A'){
		y = 0;
	};
	location.replace(window.location.pathname + '?start=' + x +'&busca='+ y);
};
function logout(){
	location.replace('/index.php');
}