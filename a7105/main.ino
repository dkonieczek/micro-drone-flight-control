/*
    Modified by: Dennis Konieczek @dkonieczek
                 Nikolas Spendik @nspendik22
    Repository: https://github.com/dkonieczek/micro-drone-flight-control
*/
#include <SoftwareSerial.h>

SoftwareSerial bluetooth(8, 9);
int testled = 7;
int BluetoothData;

int startTime;
int analogPin = A4;
int val = 0;

const int ledPin = 9;
int waitTime, finishTime, hubsanWait;

uint8_t throttle2 = 0;    //0xA0 101 00000
uint8_t forward = 0;     //0x20 001 00000
uint8_t backward = 0;    //0x40 010 00000
uint8_t left = 0;        //0x60 011 00000
uint8_t right = 0;       //0x80 100 00000



void setup() {
  Serial.begin(9600);
  bluetooth.begin(9600);
  A7105_Setup();

  //delay(2000);  // gives two seconds to open serial monitor to see chip id
  //uint8_t chipID[4];
  //A7105_ReadChipID(chipID);
  //Serial.print("Chip ID: ");
  //for (int i = 0; i < 4; ++i) {
  // Serial.print(chipID[i]);
  // Serial.print("\t");
  //}
  //Serial.println();
  initialize();

  pinMode(ledPin, OUTPUT);
  pinMode(analogPin, INPUT);
  pinMode(testled, OUTPUT); //bt test
  throttle = rudder = aileron = elevator = 0;
}

void loop() {
  startTime = micros();
  if (bluetooth.available()) {

    BluetoothData = bluetooth.read();
    if (BluetoothData <= 190) {
      //delay(5);

      if ((BluetoothData & 0xA0) == 0xA0) {
        throttle2 = BluetoothData & 0x1f;

      }
      if ((BluetoothData & 0x20) == 0x20 && (BluetoothData & 0xA0) != 0xA0 && (BluetoothData & 0x60) != 0x60) {
        forward = BluetoothData & 0x1f;
      }
      if ((BluetoothData & 0x40) == 0x40 && (BluetoothData & 0x60) != 0x60) {
        backward = BluetoothData & 0x1f;
      }
      if ((BluetoothData & 0x60) == 0x60) {
        left = BluetoothData & 0x1f;
      }
      if ((BluetoothData & 0x80) == 0x80 && (BluetoothData & 0xA0) != 0xA0) {
        right = BluetoothData & 0x1f;
      }
    }

    throttle2 *= 8;
    throttle = throttle2;

    left *= 4;
    right *= 4;
    forward *= 4;
    backward *= 4;

    rudder = 0x7F; //not implemented

    if (left > 0) {
      aileron = 127 + left;
    } else if (right > 0) {
      aileron = 127 - right;
    }

    if (forward > 0) {
      elevator = 127 + forward;
    } else if (backward > 0) {
      elevator = 127 - backward;
    }


    left = 0;
    right = 0;
    forward = 0;
    backward = 0;
  }
  // bt not avail
  else {
    throttle = (byte)0;
    rudder = (byte)0;
    aileron = (byte)0;
    elevator = (byte)0;
  }
  Serial.println(throttle);
  delayMicroseconds(hubsan_cb());
}

