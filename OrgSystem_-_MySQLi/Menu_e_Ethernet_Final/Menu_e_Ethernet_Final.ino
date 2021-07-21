#include <ArduinoJson.h>
#include <LiquidCrystal.h>
#include <Ethernet.h>
#include <SPI.h>

LiquidCrystal lcd(44, 45, 34, 36, 38, 40);
#define clkoutput 24
#define dtoutput 26
#define swoutput 28

byte mac[] = { 0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED };
byte server[] = { 192, 168, 25, 154};
int PosiAnt = 0;
int PosiAtual = 0;
int ValA;
int ValB;
int sw;
byte opcmenu = 1;
byte menu = 0;
byte sair = 0;
byte rowsmenu = 2;
byte exibir = 1;
int Paciente=0;
byte idIni;
char msg01[256];
char msg02[256];
int ID;
const char* sobrenome;



EthernetClient client;

void setup() {
   pinMode(clkoutput,INPUT);
   pinMode(dtoutput,INPUT);
   pinMode(swoutput,INPUT_PULLUP);
   
   Serial.begin(9600);
   
   lcd.begin(16,2);
   lcd.clear();
   delay(200);
   lcd.setCursor(2,0);
   lcd.print("Iniciando...");
   
   if(Ethernet.begin(mac) == 0){
       lcd.clear();
       lcd.setCursor(1,0);
       lcd.print("Erro, Reinicie"); 
       for(;;);
    }
    
   lcd.clear();
   lcd.setCursor(0,0);
   lcd.print("Conectado no ip:");
   lcd.setCursor(0,1);
   lcd.print(Ethernet.localIP());
   lcd.noCursor();
   
   delay(2500);

   msg01[0]=0;
   msg02[0]=0;
   
   lcd.clear();
   lcd.setCursor(6,0);
   lcd.print("Kan");
   lcd.setCursor(7,1);
   lcd.print("Bit");
   delay(4000);
   
}

void loop() {
// Seleciona
  
selecionar();

// Confirma Seleção *************** 
confirmSelect();
  
// Menu
menuPrint();
}
