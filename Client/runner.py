import time
import json
import signal
import base64
import subprocess

import __lcd__ as lcd
import __support__ as support
from __rc522__ import MFRC522

lcd.lcd_init()
rfc = MFRC522()

time.sleep(1)

lcd.lcd_byte(lcd.LCD_LINE_1, lcd.LCD_CMD)
lcd.lcd_string("Initializing", 2)

signal.signal(signal.SIGINT, support.signal_handler)

time.sleep(1)
lcd.lcd_byte(lcd.LCD_LINE_1, lcd.LCD_CMD)
lcd.lcd_string("Initialized", 2)

default_headers = support.get_headers()


def print_error(msg):
    lcd.lcd_byte(lcd.LCD_LINE_1, lcd.LCD_CMD)
    lcd.lcd_string("Error:", 3)

    lcd.lcd_byte(lcd.LCD_LINE_2, lcd.LCD_CMD)
    lcd.lcd_string(msg, 1)


def print_success(msg):
    lcd.lcd_byte(lcd.LCD_LINE_1, lcd.LCD_CMD)
    lcd.lcd_string("Success:", 3)

    lcd.lcd_byte(lcd.LCD_LINE_2, lcd.LCD_CMD)
    lcd.lcd_string(msg, 1)


def process_response(response):
    data = json.loads(response)

    lcd.lcd_byte(lcd.LCD_LINE_1, lcd.LCD_CMD)
    if data.type == 'error':
        lcd.lcd_string('Error:', 3)
    else:
        lcd.lcd_string('Success:', 3)

    lcd.lcd_byte(lcd.LCD_LINE_2, lcd.LCD_CMD)
    lcd.lcd_string(data.message, 2)


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

        proc = subprocess.Popen(['php', './php/pipe.php', 'rfid', base64.encodebytes(uid)], stdout=subprocess.PIPE)
        (output, err) = proc.communicate()
        process_response(output)
        time.sleep(5)
        continue

