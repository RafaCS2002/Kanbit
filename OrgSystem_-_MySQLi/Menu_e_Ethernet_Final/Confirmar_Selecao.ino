void confirmSelect(){
   if(sw==LOW){
      if(menu>10){
        atualizar();
      }
      switch(menu){
          case 0:
            switch(opcmenu){
                case 1:
                  menu = 1;
                  quantidadePatient();
                  idIni = 1;
                  break;
                case 2:
                  lcd.clear();
                  lcd.setCursor(1,0);
                  lcd.print("Suspendendo...");
                  delay("2000");
                  //ADD CODIGO PRA SUSPENSÃO
                  
                  break;
                default:
                  break;
            }
            break;
          //Lista de Pacientes
          case 1:
            menu = 10;
            for(int i=1;i<rowsmenu;i++){
              if(opcmenu == i){
                    menu += i;
                    Paciente = i;
                    rowsmenu = 3;
                }
              } 
            break;
          default:
            break;
      }
      if(opcmenu == rowsmenu && menu != 0){
        menu = 0;
        rowsmenu = 2;
      }
      opcmenu = 1;
      exibir = 1;
  }
}
