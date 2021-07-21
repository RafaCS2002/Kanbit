void menuPrint(){
  if(exibir == 1){
    switch(menu){
      //MENU PRINCIPAL
      case 0:
        lcd.clear();
        lcd.setCursor(5,0);
        lcd.print("KanBit");
        switch(opcmenu){
          case 1:
             lcd.setCursor(0,1);
             lcd.print("Lista Pacientes");
             lcd.noCursor();
            break;
          case 2:
             lcd.setCursor(0,1);
             lcd.print("Desligar");
             lcd.noCursor();
            break;
        }
        break;
        
      // LISTA DE PACIENTES - SUBMENU OPÇÃO 1
      case 1:
          for(int i=1;i<rowsmenu;i++){
            if(opcmenu == i){
                idIni = i;
                patient();
              } 
            }
            if(opcmenu == rowsmenu){
              lcd.clear();
              lcd.setCursor(0,0);
              lcd.print("Lista Pacientes");
              lcd.setCursor(0,1);
              lcd.print("Voltar");
              lcd.noCursor();
            }
          
          break;
    }

    //Pacientes
    if(menu>10){
        lcd.clear();
        lcd.print("Paciente " + String(Paciente));
        
       for(int i=1;i<rowsmenu;i++){
          if(opcmenu == 1){
              lcd.setCursor(0,1);
              lcd.print("Andamento");
              lcd.noCursor();
          } 
          if(opcmenu == 2){
              lcd.setCursor(0,1);
              lcd.print("Alta");
              lcd.noCursor();
          } 
        }
          
          if(opcmenu == rowsmenu){
           lcd.setCursor(0,1);
           lcd.print("Voltar");
           lcd.noCursor();
          }
    }
    
    exibir = 0;
    delay(250);
  }
}
