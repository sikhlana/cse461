from dotenv import load_dotenv
import RPi.GPIO as GPIO
import os

load_dotenv(dotenv_path="./.env", verbose=True)

def get_serial():
    serial = "0000000000000000"

    try:
        f = open('/proc/cpuinfo', 'r')

        for line in f:
            if line[0:6] == 'Serial':
                serial = line[10:26]
                break

        f.close()
    except:
        serial = "ERROR000000000"

    return serial


def signal_handler(signal, frame):
    GPIO.cleanup()


def get_headers():
    return {
        'Content-Type': 'application/json',
        'Authorization': 'Bearer ' + os.getenv('API_KEY')
    }
