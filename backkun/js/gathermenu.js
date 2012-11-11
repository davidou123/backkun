//     廣力電腦股份有限公司      電話 :(04)2227-0525   
//地址 :台中市西區中華路一段九號 傳真 :(04)2222-0996

function change(id){ 

     for (i=1; i<100; i++) {
	    ID = document.getElementById(i); 
        if(i!=id) {
            ID.style.display = "none"; 
		}
        else {
		if (ID.style.display==""){
			ID.style.display="none";
		}else{
			ID.style.display = ""; 
			}
			}
	 }
 }
/*
for (i=2; i<10; i++) {
if(i==3){}else{
	ID = document.getElementById(i);
	ID.style.display = "none";}
}*/

//     廣力電腦股份有限公司      電話 :(04)2227-0525   
//地址 :台中市西區中華路一段九號 傳真 :(04)2222-0996