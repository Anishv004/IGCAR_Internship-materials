from flask import Flask, render_template,jsonify
from pythonping import ping
import threading
import time
import datetime
import mysql.connector
from mysql.connector import Error

app = Flask(__name__)

query="INSERT INTO server_status (ip,date,hrs,min,status) VALUES (%s,%s,%s,%s,%s)"
query1="Select count(*) from server_status where ip=%s"
# rows=[()]
# rows

def database_access(target_ip,status):
    db_config = {
        "host": "localhost",
        "user": "root",
        "password": "",
        "database": "server_log"
    }

    connection = mysql.connector.connect(**db_config)
    cursor = connection.cursor()

    ct = datetime.datetime.now()
    try:
        if status==2:
            cursor.execute(query1,(target_ip,))
            rows=cursor.fetchone()
            if rows[0]==0:
                return True
            return False
        else:
            cursor.execute(query,(target_ip,ct.strftime("%Y-%m-%d"),ct.strftime("%H"),ct.strftime("%M"),status))
        
        connection.commit()
    except Error as e:
        print("Error insertion")
        print(e)

    connection.close()

ping_results = {}
ip_addresses = ['10.29.1.10', '10.29.1.11', '10.29.1.12', '10.29.1.153', '10.29.1.13', '10.29.1.165','10.29.1.152','10.29.1.154'] 

server_image_links = [
    'https://www.freepnglogos.com/uploads/server-png/sneaker-server-19.png',
    'https://www.computerhope.com/jargon/s/server.png',
    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQXIfF4nI-7kotALdFMZCiKv_thrq-V_ePiVy94kmBOZ4PDmqUNMGMkipuu3NAJmu-ryag&usqp=CAU',
    "https://img.freepik.com/free-photo/server-racks-computer-network-security-server-room-data-center-dark-blue-generative-ai_1258-150857.jpg",
    'https://t4.ftcdn.net/jpg/02/67/08/33/360_F_267083342_Dw7NvtP2oy0JfO2qTjDlWePOaxoCJgxM.jpg',
    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR-B8vKgn1KQHIInIZ7yyr0zFiNZHkSxz6m96BU6J9XX8vWWhbo66GZS8Q6YdRm5Jj6fes&usqp=CAU',
    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSiG_MTUrDaB3Id3Pcsfx-6_lv_oyFwEkr5ffH_PMYwVLwGpagY6S0UgqJJLj6Panm9Gno&usqp=CAU',
    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR_t0jNGysgOUO9gX4QgsLzc3KtmM04X_TtQuDiMqv6OMzx29W6EY9yvwxW5yEr2glFyUs&usqp=CAU'
]

def ping_ip(target_ip):
    flag=[0]*len(ip_addresses)
    while True:
        try:
            response_list = ping(target_ip, count=1)

            ping_results[target_ip] = []
            for response in response_list:
                if response.success:
                    ping_results[target_ip].append(f"Success: {target_ip} is reachable")
                    if(flag[ip_addresses.index(target_ip)]==0):
                        database_access(target_ip,1)
                        flag[ip_addresses.index(target_ip)]=1
                        
                else:
                    ping_results[target_ip].append(f"Failure: {target_ip} is not reachable")
                    if(flag[ip_addresses.index(target_ip)]==1):
                        database_access(target_ip,0)
                        
                    else:
                       
                        if database_access(target_ip,2):
                            database_access(target_ip,0)
                            
                    flag[ip_addresses.index(target_ip)]=0


        except Exception as e:
            ping_results[target_ip] = [str(e)]
        # time.sleep(600) 
        time.sleep(20)

ping_threads = []
for ip in ip_addresses:
    thread = threading.Thread(target=ping_ip, args=(ip,))
    thread.start()
    ping_threads.append(thread)

@app.route('/')
def index():
    return render_template('index.html', ping_results=ping_results, server_image_links=server_image_links)

@app.route('/ping_data')
def ping_data():
    html_data = {}
    for ip, results in ping_results.items():
        html_data[ip] = "<ul>"
        for result in results:
            html_data[ip] += f"<li>{result}</li>"
        html_data[ip] += "</ul>"
    return jsonify(html=html_data)
@app.route('/current_time')
def current_time():
    current_time = datetime.datetime.now().strftime("%Y-%m-%d %H:%M")
    return current_time

if __name__ == '__main__':
    app.run(debug=True)
    

