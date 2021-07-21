void patient(){
    boolean in = true;
    byte a = 0;
    while(a == 0){
      //CHECA CONEXAO
      while(!client.connected()){
        if (client.connect(server, 80)) {
        }else{
          lcd.clear();
          lcd.setCursor(0,0);
          lcd.print("Erro, conectando");
          delay(1000);
        }
      }
      //ENVIA PEDIDO
      if(in == true){
        lcd.clear();
        lcd.setCursor(1,0);
        lcd.print("Carregando...");
        client.println("GET /arduino.php?idIni=" + String(idIni) + " HTTP/1.0");
        client.println();
        in = false;
      }
      //RECEBE MENSAGEM, REALIZA AÇOES E DISCONECTA
      if(client.available()){
        /*if(msg01[0]!=0){
          Serial.println("Entrou");
          long j = 0;
          while(j<159){
            Serial.print(String(j) + " ");
            msg01[j] = 0;
            j++;
          }
        }*/

        
        int i = 0;
        char c[190];
        while(client.available()){
            if(i<187){
              c[i] = client.read();
            }else{
              msg01[i-188] = client.read();
            }
            i++;
        }
        
        client.stop();
        if (!client.connected()) {
          a++;
        } 
      }
      
    }  
    // FIM LOOP

    const char* input = msg01;
    Serial.println();
    Serial.print(input);
    StaticJsonDocument<256> doc;
    DeserializationError err = deserializeJson(doc, input);

    if(err){
      Serial.print("Error: ");
      Serial.println(err.c_str());
    }
    ID = doc["id"];
    sobrenome = doc["sobrenome"];
    
    lcd.clear();
    lcd.setCursor(0,0);
    lcd.print("Lista Pacientes");
    lcd.setCursor(0,1);
    lcd.print(String(sobrenome)+" "+String(ID));
    lcd.noCursor();
   
}
