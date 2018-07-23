import os
import time
import signal
from http.client import HTTPSConnection

import __lcd__ as lcd
import __support__ as support
from __rc522__ import MFRC522

lcd.lcd_init()
rfc = MFRC522()
conn = HTTPSConnection(host='attendance.saifmahmud.name')

time.sleep(1)

lcd.lcd_byte(lcd.LCD_LINE_1, lcd.LCD_CMD)
lcd.lcd_string("Initializing", 2)

signal.signal(signal.SIGINT, support.signal_handler)

time.sleep(1)
lcd.lcd_byte(lcd.LCD_LINE_1, lcd.LCD_CMD)
lcd.lcd_string("Initialized", 2)

default_headers = support.get_headers()

while True:
    time.sleep(1)

    lcd.lcd_byte(lcd.LCD_LINE_1, lcd.LCD_CMD)
    lcd.lcd_string("Waiting for", 2)

    lcd.lcd_byte(lcd.LCD_LINE_2, lcd.LCD_CMD)
    lcd.lcd_string("input", 2)

    (status, TagType) = rfc.MFRC522_Request(rfc.PICC_REQIDL)

    if status == rfc.MI_OK:
        lcd.lcd_byte(lcd.LCD_LINE_1, lcd.LCD_CMD)
        lcd.lcd_string("RfID Tag", 2)

        lcd.lcd_byte(lcd.LCD_LINE_2, lcd.LCD_CMD)
        lcd.lcd_string("Detected", 2)

        (status, uid) = rfc.MFRC522_Anticoll()
        uid = "%02X:%02X:%02X:%02X" % (uid[0], uid[1], uid[2], uid[3])

        try:
            conn.request(method='post', url='/api/devices/record', headers=default_headers, body='rfid=' + uid)
            response = conn.getresponse()
        except:
            response = None
            print('Exception Occurred')

        if not response or response.status != 200:
            message = 'Please try later'

            if response:
                print(response.read())

            lcd.lcd_byte(lcd.LCD_LINE_1, lcd.LCD_CMD)
            lcd.lcd_string("Error:", 3)

            lcd.lcd_byte(lcd.LCD_LINE_2, lcd.LCD_CMD)
            lcd.lcd_string(message, 1)
            continue
