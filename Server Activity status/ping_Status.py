# from flask import Flask, render_template, request
# from pythonping import ping

# app = Flask(__name__)

# def ping_ip(target_ip):
#     status=0
#     try:
#         response_list = ping(target_ip, count=4) 
#         results = []
#         for response in response_list:
#             if response.success:
#                 results.append(f"Success: {target_ip} is reachable ")
#                 print(response)
#                 status=1
#             else:
#                 results.append(f"Failure: {target_ip} is not reachable")
#                 status=0
#                 break
#         return results
#     except Exception as e:
#         return [str(e)]

# @app.route('/', methods=['GET', 'POST'])
# def index():
#     results = []
    
#     if request.method == 'POST':
#         target_ip = request.form.get('ip_address')
#         results = ping_ip(target_ip)

#     return render_template('index.html', results=results)

# if __name__ == '__main__':
#     app.run(debug=True)

from flask import Flask, render_template, request
from pythonping import ping

app = Flask(__name__)

# Function to ping an IP address
def ping_ip(target_ip):
    try:
        response_list = ping(target_ip, count=1)  # Send 4 ICMP echo requests
        results = []
        for response in response_list:
            if response.success:
                results.append(f"Success: {target_ip} is reachable ({response.time_elapsed} ms)")
            else:
                results.append(f"Failure: {target_ip} is not reachable")
        return results
    except Exception as e:
        return [str(e)]

@app.route('/')
def index():
    return render_template('index.html')

@app.route('/ping', methods=['POST'])
def ping_server():
    target_ip = request.form.get('target_ip')  # Get the selected IP address from the form
    results = ping_ip(target_ip)
    return render_template('index.html', results=results)

if __name__ == '__main__':
    app.run(debug=True)

