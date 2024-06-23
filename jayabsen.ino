#include <ESP8266WiFi.h>
#include <LiquidCrystal_I2C.h>
#include <MFRC522.h>
#include <ESP8266HTTPClient.h>
#include <ESP8266WebServer.h>

const char* ssid = "WAHYU";
const char* password = "wjayadana";

const char *host = "192.168.1.2";
const int httpPort = 80;

LiquidCrystal_I2C lcd = LiquidCrystal_I2C(0x27, 16, 2); 

MFRC522 kartu(2, 0); // 2 = D4, 0 = D3

WiFiClient client;
HTTPClient http;

const unsigned int buzzer = 15;
const int pushButton = 16;

const String secretKey = "Ug5htraGsEL7RFtE";
const String deviceId = "9c52d65a-4e1c-4af0-a2f5-c7d31a59eea9";
void wifiConnection()
{
  Serial.begin(9600);
  WiFi.mode(WIFI_AP_STA);
  WiFi.begin(ssid, password);
  Serial.println("");
  Serial.print("Connecting");
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  
  Serial.println("");
  Serial.print("Connected to ");
  Serial.println(ssid);
  Serial.print("IP address: ");
  Serial.println(WiFi.localIP());
}

void setLcd() {
  lcd.begin(16,2);
  lcd.init();
  lcd.backlight();
  lcd.setCursor(2, 0);
  lcd.print("JAYABSEN V1");
  lcd.setCursor(1, 1);
  lcd.print("SMKN TUGUMULYO.");

  delay(2000);
  lcd.clear();
  lcd.setCursor(1, 0);
  lcd.print("SILAKAN TEMPEL");
  lcd.setCursor(0, 1);
  lcd.print("KARTU AKSES ANDA.");
}

void setup() {
  wifiConnection();
  setLcd();
  SPI.begin();
  kartu.PCD_Init();
  pinMode(pushButton, OUTPUT);
}

void loop() {

  deviceMode();

  if(!kartu.PICC_IsNewCardPresent()) {
    return;
  }

  if(! kartu.PICC_ReadCardSerial()) {
    return;
  }

  String idTag = "";
  for(byte i = 0; i < kartu.uid.size; i++) {
    idTag += kartu.uid.uidByte[i];
  }

  Serial.println(idTag);

  storeAbsensi(idTag);

  delay(1000);
  lcd.clear();
  lcd.setCursor(1, 0);
  lcd.print("SILAKAN TEMPEL");
  lcd.setCursor(0, 1);
  lcd.print("KARTU AKSES ANDA.");
}

void toneSuccess() {
  tone(buzzer, 2000); 
  delay(1000);      
  noTone(buzzer);  
}

void toneFailed() {
  tone(buzzer, 2000); 
  delay(100);
  tone(buzzer, 1000); 
  delay(100);
  tone(buzzer, 2000); 
  delay(200);
  noTone(buzzer); 
}

void deviceMode()
{
  if(digitalRead(pushButton) == 1) {  //ditekan
    while(digitalRead(pushButton) == 1); //menahan proses sampai tombol dilepas
    if(!client.connect(host, httpPort)) {
      toneFailed();
      lcd.clear();
      lcd.setCursor(3, 0);
      lcd.print("CONNECTION");
      lcd.setCursor(5, 1);
      lcd.print("FAILED");
      Serial.println("connection failed");
      return;
    }

    String url = "http://192.168.1.2/jayabsen/public/api/devices/mode?secret_key=" + secretKey + "&device_id=" + deviceId;
    http.begin(client, url.c_str());

    int httpResponseCode = http.GET();

    if (httpResponseCode > 0) {
      String payload = http.getString();

      if(payload == "SECRET_KEY_TIDAK_DITEMUKAN") {
        toneFailed();
        lcd.clear();
        lcd.setCursor(3, 0);
        lcd.print("SECRET-KEY");
        lcd.setCursor(2, 1);
        lcd.print("TIDAK SESUAI");
      }

      if(payload == "DEVICE_TIDAK_DITEMUKAN") {
        toneFailed();
        lcd.clear();
        lcd.setCursor(3, 0);
        lcd.print("DEVICE-ID");
        lcd.setCursor(2, 1);
        lcd.print("TIDAK SESUAI");
      }

      if(payload == "PEMBACA_KARTU" || payload == "ABSENSI") {
        toneSuccess();
        lcd.clear();
        lcd.setCursor(1, 0);
        lcd.print("DEVICE CHANGED");
        if(payload == "ABSENSI") {
          lcd.setCursor(2, 1);
          lcd.print("MODE ABSENSI.");
        } else {
          lcd.setCursor(1, 1);
          lcd.print("MODE PEMBACA.");
        }
      }
      
    } else {
      toneFailed();
      Serial.printf("[HTTP] ... failed, error: %s\n", http.errorToString(httpResponseCode).c_str());
    }

    http.end();
  }
}

void storeAbsensi(String kartu)
{
  if(!client.connect(host, httpPort)) {
    toneFailed();
    lcd.clear();
    lcd.setCursor(3, 0);
    lcd.print("CONNECTION");
    lcd.setCursor(5, 1);
    lcd.print("FAILED");
    Serial.println("connection failed");
    return;
  }

  String url = "http://192.168.1.2/jayabsen/public/api/absensi/send?secret_key=" + secretKey + "&device_id=" + deviceId + "&kartu=" + kartu;
  http.begin(client, url.c_str());

  int httpResponseCode = http.GET();
  if (httpResponseCode > 0) {
    String payload = http.getString();

    Serial.printf("[HTTP] ... code: %d\n", httpResponseCode);
    Serial.println(payload);

    if(payload == "KARTU_REGISTERED") {
      lcd.clear();
      lcd.setCursor(0, 0);
      lcd.print("KODE KARTU SUKSES");
      lcd.setCursor(2, 1);
      lcd.print("DI DAFTARKAN");
      toneSuccess();
    }

    if(payload == "ABSEN_MASUK_DISIMPAN") {
      lcd.clear();
      lcd.setCursor(0, 0);
      lcd.print("ABSEN MASUK BERHASIL");
      lcd.setCursor(1, 1);
      lcd.print("SELAMAT DATANG.");\
      toneSuccess();
    }

    if(payload == "ABSEN_KELUAR_DISIMPAN") {
      lcd.clear();
      lcd.setCursor(0, 0);
      lcd.print("ABSEN KELUAR BERHASIL");
      lcd.setCursor(1, 1);
      lcd.print("SELAMAT JALAN.");\
      toneSuccess();
    }

    if(payload == "SECRET_KEY_TIDAK_DITEMUKAN") {
      lcd.clear();
      lcd.setCursor(3, 0);
      lcd.print("SECRET-KEY");
      lcd.setCursor(2, 1);
      lcd.print("KEY SALAH");
      toneFailed();
    }

    if(payload == "DEVICE_TIDAK_DITEMUKAN") {
      lcd.clear();
      lcd.setCursor(3, 0);
      lcd.print("DEVICE-ID");
      lcd.setCursor(2, 1);
      lcd.print("PERANGKAT BERMASALAH");
      toneFailed();
    }

    if(payload == "KARTU_NOT_FOUND") {
      lcd.clear();
      lcd.setCursor(3, 0);
      lcd.print("kartu ANDA");
      lcd.setCursor(0, 1);
      lcd.print("TIDAK TERDAFTAR.");
      toneFailed();
    }
  } else {
    toneFailed();
    Serial.printf("[HTTP] ... failed, error: %s\n", http.errorToString(httpResponseCode).c_str());
  }

  http.end();
}