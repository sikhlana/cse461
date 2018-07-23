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
        'Content-type': 'application/x-www-form-urlencoded',
        'Cache-control': 'no cache',
        'Accept': 'application/json',
        'Authorization': 'Bearer ' + os.getenv('API_KEY'),
        'User-agent': 'Mozilla/5.0 (X11; U; Linux i686) Gecko/20071127 Firefox/2.0.0.11',
    }
