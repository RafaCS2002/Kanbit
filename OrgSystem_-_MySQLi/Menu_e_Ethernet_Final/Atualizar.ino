void atualizar(){
  String estado = String(10);
 
  if(opcmenu == 1){
    estado = "Andamento"; 
  } 
  if(opcmenu == 2){
    estado = "Alta";
  } 
  if(opcmenu == 3){
    menu = 0;
    rowsmenu = 2;
    estado = "";
  }
  
  boolean in = true;
  if(estado != ""){
    
    byte a = 0;
    while(a == 0){
      while(!client.connected()){
        
        lcd.clear();
        if (client.connect(server, 80)) {
          lcd.setCursor(3,0);
          lcd.print("Conectado");
        }else{
          lcd.setCursor(0,0);
          lcd.print("Erro, conectando");
        }
        delay(500);
        
      }
      
      if(in == true){
        lcd.clear();
        lcd.setCursor(1,0);
        lcd.print("Atualizando...");
        client.println("GET /arduino.php?upd=" + estado + "&id="+ ID +" HTTP/1.0");
        client.println();
        in = false;
      }
      
      if(client.available()){
        /*COMANDO PARA PRINTAR A MENSAGEM DO WEB SERVER *
        while(client.available()){char c = client.read();Serial.print(c);i++;}*/
       
        client.stop();
        if (!client.connected()) {
          lcd.clear();
          lcd.setCursor(3,0);
          lcd.print("Atualizado");
          delay(2000);
          a++;
          menu = 0;
          rowsmenu = 2;
          opcmenu = 1;
        }
      }
    }  
  }
}
