void selecionar(){
  ValA = digitalRead(clkoutput);
  ValB = digitalRead(dtoutput);
  sw = digitalRead(swoutput);
  while(ValA == 0 && ValB == 0){
      ValA = digitalRead(clkoutput);
      ValB = digitalRead(dtoutput);
      if(ValA == 1 && ValB == 0){
        PosiAtual++;
      }
      if(ValA == 0 && ValB == 1){
        PosiAtual--;      
      }

  }
  if(PosiAtual > PosiAnt){
      opcmenu++;
      if(opcmenu > rowsmenu){
          opcmenu = 1;
      }
      PosiAnt = PosiAtual;
      exibir = 1;
  } 
  if(PosiAtual < PosiAnt){
      opcmenu--;
      if(opcmenu <= 0){
          opcmenu = rowsmenu;
      }
      PosiAnt = PosiAtual;
      exibir = 1;
  }
}
