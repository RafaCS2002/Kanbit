void quantidadePatient(){
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
        client.println("GET /arduino.php?qnt=1 HTTP/1.0");
        client.println();
        in = false;
      }
      //RECEBE MENSAGEM, REALIZA AÇOES E DISCONECTA
      if(client.available()){
        /*if(msg02[0]!=0){
          Serial.println("Entrou");
          long j = 0;
          while(j<159){
            Serial.print(String(j) + " ");
            msg02[j] = 0;
            j++;
          }
        }*/

        
        int i = 0;
        char c[190];
        while(client.available()){
            if(i<187){
              c[i] = client.read();
            }else{
              msg02[i-188] = client.read();
            }
            i++;
        }
        Serial.println(msg02);
        client.stop();
        if (!client.connected()) {
          a++;
        } 
      }
      
    }  
    // FIM LOOP

    const char* input = msg02;
    StaticJsonDocument<256> doc;
    DeserializationError err = deserializeJson(doc, input);

    if(err){
      Serial.print("Error: ");
      Serial.println(err.c_str());
    }
    byte qnt = 0;
    qnt = doc["quantidade"];

    rowsmenu = qnt + 1;
}
